<?php

namespace App\Http\Controllers;

use App\Models\Seminar;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SeminarController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $errorMessage = session('error');
        $successMessage = session('success');
        $seminar = Seminar::where('user_id', Auth::user()->getAuthIdentifier())->paginate(10);

        return view('seminar.seminar', compact('seminar', 'errorMessage', 'successMessage'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $this->validateSeminarRequest($request);

            $userIdentifier = Auth::user()->getAuthIdentifier();
            $user = User::find($userIdentifier);

            if (!$user) {
                throw new \Exception('Pengguna tidak ditemukan.');
            }

            $waktu = Carbon::createFromFormat('d-m-Y', $request->waktu_seminar)->format('Y-m-d');
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

            $seminar = Seminar::create([
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'mahasiswa_nama' => $request->mahasiswa_nama,
                'tahun_ajaran' => $request->tahun_ajaran,
                'waktu_seminar' => $waktu,
                'no_berita_acara' => $request->no_berita_acara,
                'path_lampiran' => $pathLampiran,
                'path_foto_kegiatan' => $pathFotoKegiatan,
                'user_id' => $user->id,
            ]);

            if (!$seminar) {
                throw new \Exception('Terjadi kesalahan saat menyimpan data.');
            }

            return redirect('/seminar')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    private function validateSeminarRequest(Request $request)
    {
        $this->validate($request, [
            'mahasiswa_nim' => 'string|required',
            'mahasiswa_nama' => 'string|required',
            'waktu_seminar' => 'date|required',
            'tahun_ajaran' => 'required|min:0',
            'no_berita_acara' => 'required|min:0',
            'path_foto_kegiatan' => 'required|max:10000|mimes:pdf,jpg,png,doc,docx',
            'path_lampiran' => 'required|max:10000|mimes:pdf,jpg,png,doc,docx',
        ]);
    }
}
