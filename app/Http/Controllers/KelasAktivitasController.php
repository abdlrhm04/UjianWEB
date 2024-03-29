<?php

namespace App\Http\Controllers;

use App\Models\KelasAktivitas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Aktivitas;

class KelasAktivitasController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        try {
            $this->validateKelasAktivitasRequest($request);

            $aktivitas = Aktivitas::find($request->id_aktivitas);

            if (!$aktivitas) {
                throw new \Exception('Aktivitas tidak ditemukan.');
            }

            $kelasAktivitas = KelasAktivitas::create([
                'kelas_matkul' => $request->nama_matkul,
                'kelas_nama' => $request->nama_kelas,
                'kelas_waktu' => $request->waktu,
                'kelas_sks' => $request->sks,
                'aktivitas_id' => $aktivitas->id,
                'kelas_hari' => $request->hari,
            ]);

            if (!$kelasAktivitas) {
                throw new \Exception('Terjadi kesalahan saat menyimpan data.');
            }

            return redirect('/aktivitas/detail/'.$aktivitas->id)->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    private function validateKelasAktivitasRequest(Request $request)
    {
        $this->validate($request, [
            'nama_matkul' => 'string|required',
            'nama_kelas' => 'string|required',
            'hari' => 'numeric|required',
            'waktu' => 'date_format:H:i|required',
            'sks' => 'numeric|required',
            'id_aktivitas' => 'numeric|required',
        ]);
    }
}
