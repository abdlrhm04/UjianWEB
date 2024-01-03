<?php

namespace App\Http\Controllers;

use App\Models\PengembanganBahanAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PengembanganBahanAjarController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $errorMessage = session('error');
        $successMessage = session('success');
        $pengembangan = PengembanganBahanAjar::where('user_id', Auth::user()->getAuthIdentifier())->paginate(10);

        return view('pengembanganba.pengembanganba', compact('pengembangan', 'errorMessage', 'successMessage'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $this->validatePengembanganBahanAjarRequest($request);

            $userIdentifier = Auth::user()->getAuthIdentifier();
            $user = User::find($userIdentifier);

            if (!$user) {
                throw new \Exception('Pengguna tidak ditemukan.');
            }

            $files = $request->file('path_lampiran');
            $pathLampiran = $files->store('public');

            if (!$pathLampiran) {
                throw new \Exception('Terjadi kesalahan saat mengupload file.');
            }

            $pengembangan = PengembanganBahanAjar::create([
                'jenis_bahan_ajar' => $request->jenis_bahan_ajar,
                'deskripsi_bahan_ajar' => $request->deskripsi_bahan_ajar,
                'hasil_pengembangan' => $pathLampiran,
                'user_id' => $user->id,
            ]);

            if (!$pengembangan) {
                throw new \Exception('Terjadi kesalahan saat menyimpan data.');
            }

            return redirect('/pengembangan-ba')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }   

    private function validatePengembanganBahanAjarRequest(Request $request)
    {
        $this->validate($request, [
            'jenis_bahan_ajar' => 'string|required',
            'deskripsi_bahan_ajar' => 'string|required',
            'path_lampiran' => 'required|max:10000|mimes:pdf,jpg,png,doc,docx',
        ]);
    }
}
