<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
  
    public function index()
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter'])
            ->latest()
            ->get();

        return view('rekam_medis.index', compact('rekamMedis'));
    }

   
    public function create(Request $request)
    {
        $pendaftaran = null;

        if ($request->has('pendaftaran_id')) {
            $pendaftaran = Pendaftaran::with(['dokter', 'user'])
                ->findOrFail($request->pendaftaran_id);
        }

        $pasiens = Pasien::all();
        $dokters = Dokter::all();

        return view('rekam_medis.create', compact('pasiens', 'dokters', 'pendaftaran'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id'           => 'required|exists:pasien,id',
            'dokter_id'           => 'required|exists:dokter,id',
            'keluhan'             => 'required|string',
            'diagnosa'            => 'nullable|string',
            'tindakan'             => 'nullable|string',
            'resep_obat'          => 'nullable|string',
            'catatan'             => 'nullable|string',
            'tanggal_pemeriksaan' => 'required|date',
        ]);

        RekamMedis::create($validated);

        return redirect()
            ->route('rekam_medis.index')
            ->with('success', 'Rekam medis berhasil ditambahkan.');
    }

 
    public function show($id)
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter'])->findOrFail($id);
        return view('rekam_medis.show', compact('rekamMedis'));
    }

 
    public function edit($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $pasiens    = Pasien::all();
        $dokters    = Dokter::all();

        return view('rekam_medis.edit', compact('rekamMedis', 'pasiens', 'dokters'));
    }

 
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pasien_id'           => 'required|exists:pasien,id',
            'dokter_id'           => 'required|exists:dokter,id',
            'keluhan'             => 'required|string',
            'diagnosa'            => 'nullable|string',
            'tindakan'             => 'nullable|string',
            'resep_obat'          => 'nullable|string',
            'catatan'             => 'nullable|string',
            'tanggal_pemeriksaan' => 'required|date',
        ]);

        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->update($validated);

        return redirect()
            ->route('rekam_medis.index')
            ->with('success', 'Rekam medis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->delete();

        return redirect()
            ->route('rekam_medis.index')
            ->with('success', 'Rekam medis berhasil dihapus.');
    }

  
    public function pasienRekamMedis()
    {
        $pasien = Pasien::where('user_id', auth()->id())->firstOrFail();

        $rekamMedis = RekamMedis::with('dokter')
            ->where('pasien_id', $pasien->id)
            ->latest()
            ->get();

        return view('pasien.rekam_medis.index', compact('rekamMedis'));
    }
}
