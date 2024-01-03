<?php

namespace App\Http\Controllers;

use App\Models\Pendamping;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PendampingController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $errorMessage = session('error');
        $successMessage = session('success');
        $pendamping = Pendamping::where('user_id', Auth::user()->getAuthIdentifier())->paginate(10);

        return view('pendamping.pendamping', compact('pendamping', 'errorMessage', 'successMessage'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $this->validatePendampingRequest($request);

            $waktuAwal = Carbon::createFromFormat('d-m-Y', $request->tanggal_dimulai)->format('Y-m-d');
            $waktuAkhir = Carbon::createFromFormat('d-m-Y', $request->tanggal_berakhir)->format('Y-m-d');

            $pathLampiran = $request->file('path_lampiran')->store('public');
            $pathFotoKegiatan = $request->file('path_foto_kegiatan')->store('public');

            if (!$pathLampiran || !$pathFotoKegiatan) {
                throw new \Exception('Terjadi kesalahan saat mengupload file.');
            }

            $userIdentifier = Auth::user()->getAuthIdentifier();
            $user = User::find($userIdentifier);

            if (!$user) {
                throw new \Exception('Pengguna tidak ditemukan.');
            }

            $pendamping = Pendamping::create([
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'mahasiswa_nama' => $request->mahasiswa_nama,
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'tanggal_dimulai' => $waktuAwal,
                'tanggal_berakhir' => $waktuAkhir,
                'no_sk' => $request->no_sk,
                'path_lampiran' => $pathLampiran,
                'path_foto_kegiatan' => $pathFotoKegiatan,
                'user_id' => $user->id,
            ]);

            if (!$pendamping) {
                throw new \Exception('Terjadi kesalahan saat menyimpan data.');
            }

            return redirect('/pendamping')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    private function validatePendampingRequest(Request $request)
    {
        $this->validate($request, [
            'mahasiswa_nim' => 'string|required',
            'mahasiswa_nama' => 'string|required',
            'jenis_kegiatan' => 'required|min:0',
            'tanggal_dimulai' => 'date|required',
            'tanggal_berakhir' => 'date|required',
            'no_sk' => 'required|min:0',
            'path_foto_kegiatan' => 'required|max:10000|mimes:pdf,jpg,png,doc,docx',
            'path_lampiran' => 'required|max:10000|mimes:pdf,jpg,png,doc,docx',
        ]);
    }
}
