<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class JabatanController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $userIdentifier = Auth::user()->getAuthIdentifier();
            $jabatan = Jabatan::where('user_id', $userIdentifier)->paginate(10);
            $errorMessage = session('error');
            $successMessage = session('success');

            return view('jabatan.jabatan', compact('jabatan', 'errorMessage', 'successMessage'));
        }

        return redirect('/login');
    }

    public function store(Request $request): RedirectResponse
{
    try {
        $this->validateJabatanRequest($request);

        $awal = Carbon::createFromFormat('d-m-Y', $request->periode_awal)->format('Y-m-d');
        $akhir = Carbon::createFromFormat('d-m-Y', $request->periode_akhir)->format('Y-m-d');

        $files = $request->file('lampiran_jabatan');
        $fileName = $files->hashName();
        $path = $files->storeAs('public', $fileName);

        if (!$path) {
            throw new \Exception('Terjadi kesalahan saat mengupload lampiran.');
        }

        Jabatan::create([
            'jabatan' => $request->jabatan,
            'periode_awal' => $awal,
            'periode_akhir' => $akhir,
            'no_sk' => $request->no_sk,
            'lampiran_jabatan' => $fileName,
            'user_id' => Auth::user()->getAuthIdentifier(),
        ]);

        return redirect('/jabatan')->with(['success' => 'Data Berhasil Disimpan!']);
    } catch (ValidationException $e) {
        return redirect()->back()->with('error', $e->errors());
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }
}

    private function validateJabatanRequest(Request $request)
    {
        $this->validate($request, [
            'jabatan' => 'string|required',
            'periode_awal' => 'date|required',
            'periode_akhir' => 'date|required',
            'no_sk' => 'required|min:0',
            'lampiran_jabatan' => 'required|max:10000|mimes:pdf,jpg,png,doc,docx',
        ]);
    }
}
