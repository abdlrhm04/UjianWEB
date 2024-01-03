<?php

namespace App\Http\Controllers;

use App\Models\Penguji;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PengujiController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $errorMessage = session('error');
        $successMessage = session('success');
        $penguji = Penguji::where('user_id', Auth::user()->getAuthIdentifier())->paginate(10);

        return view('penguji.penguji', compact('penguji', 'errorMessage', 'successMessage'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $this->validatePengujiRequest($request);

            $userIdentifier = Auth::user()->getAuthIdentifier();
            $user = User::find($userIdentifier);

            if (!$user) {
                throw new \Exception('Pengguna tidak ditemukan.');
            }

            $waktu = Carbon::createFromFormat('d-m-Y', $request->waktu)->format('Y-m-d');
            $files = $request->file('path_lampiran');
            $pathLampiran = $files->store('public');

            if (!$pathLampiran) {
                throw new \Exception('Terjadi kesalahan saat mengupload file.');
            }

            $files2 = $request->file('path_foto_kegiatan');
            $pathFotoKegiatan = $files2->store('public');

            if (!$pathFotoKegiatan) {
                throw new \Exception('Terjadi kesalahan saat mengupload file.');
            }

            $penguji = Penguji::create([
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'mahasiswa_nama' => $request->mahasiswa_nama,
                'jenis_ujian_akhir' => $request->jenis_ujian_akhir,
                'tahun_ajaran' => $request->tahun_ajaran,
                'posisi_penguji' => $request->posisi_penguji,
                'waktu' => $waktu,
                'no_sk' => $request->no_sk,
                'path_lampiran' => $pathLampiran,
                'path_foto_kegiatan' => $pathFotoKegiatan,
                'user_id' => $user->id,
            ]);

            if (!$penguji) {
                throw new \Exception('Terjadi kesalahan saat menyimpan data.');
            }

            return redirect('/penguji')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    private function validatePengujiRequest(Request $request)
    {
        $this->validate($request, [
            'mahasiswa_nim' => 'string|required',
            'mahasiswa_nama' => 'string|required',
            'jenis_ujian_akhir' => 'string|required',
            'posisi_penguji' => 'string|required',
            'tahun_ajaran' => 'required|min:0',
            'waktu' => 'date|required',
            'no_sk' => 'required|min:0',
            'path_foto_kegiatan' => 'required|max:10000|mimes:pdf,jpg,png,doc,docx',
            'path_lampiran' => 'required|max:10000|mimes:pdf,jpg,png,doc,docx',
        ]);
    }
}
