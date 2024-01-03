<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\KelasAktivitas;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
class AktivitasController extends Controller
{
    public function index()
{
    if (Auth::check()) {
        $errorMessage = session('error');
        $successMessage = session('success');
        $aktivitas = Aktivitas::where('user_id', Auth::user()->getAuthIdentifier())->paginate(10);
        $total_aktivitas = Aktivitas::where('user_id', Auth::user()->getAuthIdentifier())->count();
        $jumlah_sks = Aktivitas::where('user_id', Auth::user()->getAuthIdentifier())->sum('jumlah_volume_kegiatan');
        $jumlah_angka_kredit = Aktivitas::sum(DB::raw('jumlah_volume_kegiatan * angka_kredit'));


        $aktif_aktivitas = Aktivitas::where('user_id', Auth::user()->getAuthIdentifier())->whereDate('tanggal_berakhir', '>=', Carbon::now())->count();

        return view('aktivitas.aktivitas', [
            'aktivitas' => $aktivitas,
            'errorMessage' => $errorMessage,
            'successMessage' =>  $successMessage,
            'total_aktivitas' => $total_aktivitas,
            'jumlah_sks' => $jumlah_sks,
            'jumlah_angka_kredit' => $jumlah_angka_kredit,
            'aktif_aktivitas' => $aktif_aktivitas
        ]);
    } else {
        return redirect('/login');
    }
}


public function store(Request $request): RedirectResponse
{
    try {
        if (Auth::check()) {
            $this->validate($request, [
                'nama_aktivitas'    => 'string|required',
                'tahun_ajaran'      => 'string|required',
                'tanggal_dimulai'   => 'date|required',
                'tanggal_berakhir'  => 'date|required',
                'satuan_hasil'      => 'required|min:0',
                'jumlah_volume'     => 'required|min:0',
                'angka_kredit'      => 'required|min:0',
                'jenis_lampiran'    => 'required',
                'file_input'        => 'required|max:10000|mimes:pdf,jpg,png,doc,docx',
                'no_tugas'          => 'string|required'
            ]);


            if (Carbon::createFromFormat('d-m-Y', $request->tanggal_berakhir)->isPast()) {
                return redirect()->back()->with('error', 'Tanggal berakhir harus di masa depan.');
            }

            // Upload image
            $files = $request->file('file_input');
            $files->storeAs('public', $files->hashName());

            // Create post
            Aktivitas::create([
                'nama_aktivitas'           => $request->nama_aktivitas,
                'tahun_ajaran'             => $request->tahun_ajaran,
                'tanggal_mulai'            => $tanggalDimulai,
                'tanggal_berakhir'         => $tanggalBerakhir,
                'sks_hasil'                => $request->satuan_hasil,
                'jumlah_volume_kegiatan'   => $request->jumlah_volume,
                'angka_kredit'             => $request->angka_kredit,
                'jenis_lampiran'           => $request->jenis_lampiran,
                'path_lampiran'            => $files->hashName(),
                'no_penugasan'             => $request->no_tugas,
                'user_id'                  => Auth::user()->getAuthIdentifier(),
            ]);

            // Redirect to index
            return redirect('/aktivitas')->with(['success' => 'Data Berhasil Disimpan!']);
        }
    } catch (ValidationException $e) {
        return redirect()->back()->with('error', $e->errors());
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }
}

public function update(Request $request): RedirectResponse
{
    try {
        if (Auth::check()) {
            $this->validate($request, [
                'nama_aktivitas'    => 'string|required',
                'tahun_ajaran'      => 'string|required',
                'tanggal_dimulai'   => 'date|required',
                'tanggal_berakhir'  => 'date|required',
                'satuan_hasil'      => 'required|min:0',
                'jumlah_volume'     => 'required|min:0',
                'angka_kredit'      => 'required|min:0',
               'jenis_lampiran'    => 'required',
            ]);

            // Logic berbeda
            if (Carbon::createFromFormat('d-m-Y', $request->tanggal_berakhir)->isPast()) {
                return redirect()->back()->with('error', 'Tanggal berakhir harus di masa depan.');
            }

            $aktivitas = Aktivitas::findOrFail($request->id);

            // Check if the user is authorized to update the aktivitas
            if ($aktivitas->user_id != Auth::user()->getAuthIdentifier()) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengupdate aktivitas ini.');
            }

            // Update the aktivitas
            $aktivitas->nama_aktivitas = $request->nama_aktivitas;
            $aktivitas->tahun_ajaran = $request->tahun_ajaran;
            $aktivitas->tanggal_mulai = $request->tanggal_dimulai;
            $aktivitas->tanggal_berakhir = $request->tanggal_berakhir;
            $aktivitas->sks_hasil = $request->satuan_hasil;
            $aktivitas->jumlah_volume_kegiatan = $request->jumlah_volume;
            $aktivitas->angka_kredit = $request->angka_kredit;
            $aktivitas->jenis_lampiran = $request->jenis_lampiran;
            $aktivitas->no_penugasan = $request->no_tugas;

            // Check if there is a new file
            if ($request->hasFile('file_input')) {
                // Delete the old file
                Storage::delete('public/' . $aktivitas->path_lampiran);

                // Upload the new file
                $files = $request->file('file_input');
                $files->storeAs('public', $files->hashName());
                $aktivitas->path_lampiran = $files->hashName();
            }

            // Save the updated aktivitas
            $aktivitas->save();

            // Redirect to index
            return redirect('/aktivitas')->with(['success' => 'Data Berhasil disimpan!']);
        }
    } catch (ValidationException $e) {
        return redirect()->back()->with('error', $e->errors());
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }
}


public function details($id)
{
    if (Auth::check()) {
        $aktivitas = Aktivitas::findOrFail($id);

        // Check if the user is authorized to view the aktivitas details
        if ($aktivitas->user_id != Auth::user()->getAuthIdentifier()) {
            return redirect('/aktivitas')->with('error', 'Anda tidak memiliki izin untuk melihat detail aktivitas ini.');
        }

        return view('aktivitas.details', ['aktivitas' => $aktivitas]);
    } else {
        return redirect('/login');
    }
}
}
