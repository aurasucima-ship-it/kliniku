<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pendaftaran;
use App\Models\Dokter;
use App\Models\Pasien;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::with('dokter')
            ->where('user_id', Auth::id())
            ->get();

        return view('pasien.pendaftaran.index', compact('pendaftarans'));
    }

    public function indexDokter()
    {
        $doctor = Auth::user()->dokter;

        $pendaftarans = Pendaftaran::with('pasien')
            ->where('dokter_id', $doctor->id)
            ->get();

        return view('dokter.pendaftaran.index', compact('pendaftarans'));
    }

    public function indexAdmin()
    {
        $pendaftarans = Pendaftaran::with(['dokter', 'user', 'pasien'])->get();

        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    public function create()
    {
        $dokters = Dokter::all();
        return view('pasien.pendaftaran.create', compact('dokters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'            => 'required|string',
            'keluhan'         => 'required|string',
            'no_telp'         => 'required|string|max:20',
            'tanggal_berobat' => 'required|date',
            'jenis_kelamin'   => 'required|in:L,P',
            'alamat'          => 'required|string',
            'dokter_id'       => 'required|exists:dokter,id',
        ]);

        DB::transaction(function() use ($validated) {
            $pasien = Auth::user()->pasien;

            if ($pasien) {
                $pasien->dokter_id       = $validated['dokter_id'];
                $pasien->keluhan         = $validated['keluhan'];
                $pasien->nama            = $validated['nama'];
                $pasien->alamat          = $validated['alamat'];
                $pasien->jenis_kelamin   = $validated['jenis_kelamin'];
                $pasien->no_telp         = $validated['no_telp'];
                $pasien->tanggal_berobat = $validated['tanggal_berobat'];
                $pasien->save();
            } else {
                $pasien = Pasien::create([
                    'user_id'         => Auth::id(),
                    'nama'            => $validated['nama'],
                    'alamat'          => $validated['alamat'],
                    'jenis_kelamin'   => $validated['jenis_kelamin'],
                    'no_telp'         => $validated['no_telp'],
                    'tanggal_berobat' => $validated['tanggal_berobat'],
                    'dokter_id'       => $validated['dokter_id'],
                    'keluhan'         => $validated['keluhan'],
                ]);
            }

            Pendaftaran::create([
                'user_id'        => Auth::id(),
                'pasien_id'      => $pasien->id,
                'dokter_id'      => $validated['dokter_id'],
                'nama'           => $pasien->nama,
                'no_telp'        => $pasien->no_telp,
                'jenis_kelamin'  => $pasien->jenis_kelamin,
                'alamat'         => $pasien->alamat,
                'keluhan'        => $validated['keluhan'],
                'tanggal_berobat'=> $validated['tanggal_berobat'],
            ]);
        });

        return redirect()
            ->route('pasien.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil disimpan.');
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $pendaftaran->delete();

        return redirect()
            ->route('pasien.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil dihapus.');
    }
}
