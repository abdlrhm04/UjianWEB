<?php

namespace App\Http\Controllers;

use App\Models\Pembimbing;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PembimbingController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $errorMessage = session('error');
        $successMessage = session('success');
        $pembimbing = Pembimbing::where('user_id', Auth::user()->getAuthIdentifier())->paginate(10);

        return view('pembimbing.pembimbing', compact('pembimbing', 'errorMessage', 'successMessage'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $this->validatePembimbingRequest($request);

            $waktu = Carbon::createFromFormat('d-m-Y', $request->waktu)->format('Y-m-d');

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

            $pembimbing = Pembimbing::create([
                'nama_kegiatan' => $request->nama_kegiatan,
                'tahun_ajaran' => $request->tahun_ajaran,
                'waktu' => $waktu,
                'no_sk' => $request->no_sk,
                'path_lampiran' => $pathLampiran,
                'path_foto_kegiatan' => $pathFotoKegiatan,
                'user_id' => $user->id,
            ]);

            if (!$pembimbing) {
                throw new \Exception('Terjadi kesalahan saat menyimpan data.');
            }

            return redirect('/pembimbing')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    private function validatePembimbingRequest(Request $request)
    {
        $this->validate($request, [
            'nama_kegiatan' => 'string|required',
            'tahun_ajaran' => 'required|min:0',
            'waktu' => 'date|required',
            'no_sk' => 'required|min:0',
            'path_foto_kegiatan' => 'required|max:10000|mimes:pdf,jpg,png,doc,docx',
            'path_lampiran' => 'required|max:10000|mimes:pdf,jpg,png,doc,docx',
        ]);
    }
}
