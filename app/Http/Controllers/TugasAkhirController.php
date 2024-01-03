<?php

namespace App\Http\Controllers;


use App\Models\TugasAkhir;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use App\Models\User;


class TugasAkhirController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $errorMessage = session('error');
            $successMessage = session('success');
            $tugasakhir = TugasAkhir::where('user_id', Auth::user()->getAuthIdentifier())->paginate(10);
            return view('tugasakhir.tugasakhir', [
                'tugasakhir' => $tugasakhir,
                'errorMessage' => $errorMessage,
                'successMessage' =>  $successMessage,
            ]);
        }else{
            return redirect('/login');
        }
    }
    public function store(Request $request): RedirectResponse
    {
        try {
            if (!Auth::check()) {
                return redirect('/login');
            }

            $this->validateTugasAkhirRequest($request);

            $userIdentifier = Auth::user()->getAuthIdentifier();
            $user = User::find($userIdentifier);

            if (!$user) {
                throw new \Exception('Pengguna tidak ditemukan.');
            }

            $waktuDimulai = Carbon::createFromFormat('d-m-Y', $request->tanggal_dimulai)->format('Y-m-d');
            $waktuBerakhir = Carbon::createFromFormat('d-m-Y', $request->tanggal_berakhir)->format('Y-m-d');
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

            $tugasAkhir = TugasAkhir::create([
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'mahasiswa_nama' => $request->mahasiswa_nama,
                'jenis_bimbingan' => $request->jenis_bimbingan,
                'tahun_ajaran' => $request->tahun_ajaran,
                'tanggal_dimulai' => $waktuDimulai,
                'tanggal_berakhir' => $waktuBerakhir,
                'jenis_pembimbing' => $request->jenis_pembimbing,
                'no_sk' => $request->no_sk,
                'path_lampiran' => $pathLampiran,
                'path_foto_kegiatan' => $pathFotoKegiatan,
                'user_id' => $user->id,
            ]);

            if (!$tugasAkhir) {
                throw new \Exception('Terjadi kesalahan saat menyimpan data.');
            }

            return redirect('/tugas-akhir')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    private function validateTugasAkhirRequest(Request $request)
    {
        $this->validate($request, [
            'mahasiswa_nim' => 'string|required',
            'mahasiswa_nama' => 'string|required',
            'jenis_bimbingan' => 'string|required',
            'tahun_ajaran' => 'string|required',
            'tanggal_dimulai' => 'date|required',
            'tanggal_berakhir' => 'date|required',
            'jenis_pembimbing' => 'string|required',
            'no_sk' => 'required|min:0',
            'path_foto_kegiatan' => 'required|max:10000|mimes:pdf,jpg,png,doc,docx',
            'path_lampiran' => 'required|max:10000|mimes:pdf,jpg,png,doc,docx',
        ]);
    }
}
