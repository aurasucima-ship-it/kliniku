<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    /**
     * Daftar rekam medis (admin/dokter)
     */
    public function index()
    {
        if (auth()->user()->role === 'dokter') {
            $rekamMedis = RekamMedis::with(['pasien', 'dokter'])
                ->where('dokter_id', auth()->user()->dokter->id)
                ->latest()
                ->get();

            return view('dokter.rekam_medis.index', compact('rekamMedis'));
        }

        // admin
        $rekamMedis = RekamMedis::with(['pasien', 'dokter'])
            ->latest()
            ->get();

        return view('admin.rekam_medis.index', compact('rekamMedis'));
    }

    /**
     * Form tambah rekam medis
     */
    public function create(Request $request)
    {
        $pendaftaran = $request->has('pendaftaran_id') 
            ? Pendaftaran::with(['dokter', 'user'])->findOrFail($request->pendaftaran_id) 
            : null;

        $pasiens = Pasien::all();

        if (auth()->user()->role === 'dokter') {
            $dokters = null; // dokter otomatis
            return view('dokter.rekam_medis.create', compact('pasiens', 'dokters', 'pendaftaran'));
        }

        // admin
        $dokters = Dokter::all();
        return view('admin.rekam_medis.create', compact('pasiens', 'dokters', 'pendaftaran'));
    }

    /**
     * Simpan rekam medis
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id'           => 'required|exists:pasiens,id',
            'keluhan'             => 'required|string',
            'diagnosa'            => 'nullable|string',
            'tindakan'            => 'nullable|string',
            'resep_obat'          => 'nullable|string',
            'catatan'             => 'nullable|string',
            'tanggal_pemeriksaan' => 'required|date',
        ]);

        if (auth()->user()->role === 'dokter') {
            $validated['dokter_id'] = auth()->user()->dokter->id;
            RekamMedis::create($validated);
            return redirect()->route('dokter.rekam_medis.index')->with('success', 'Rekam medis berhasil ditambahkan.');
        }

        // admin
        $validated['dokter_id'] = $request->validate(['dokter_id' => 'required|exists:dokters,id'])['dokter_id'];
        RekamMedis::create($validated);
        return redirect()->route('admin.rekam_medis.index')->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    /**
     * Detail rekam medis
     */
    public function show($id)
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter'])->findOrFail($id);

        if (auth()->user()->role === 'dokter') {
            return view('dokter.rekam_medis.show', compact('rekamMedis'));
        }

        if (auth()->user()->role === 'admin') {
            return view('admin.rekam_medis.show', compact('rekamMedis'));
        }

        abort(403); 
    }

    /**
     * Form edit rekam medis
     */
    public function edit($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $pasiens = Pasien::all();

        if (auth()->user()->role === 'dokter') {
            $dokters = null;
            return view('dokter.rekam_medis.edit', compact('rekamMedis', 'pasiens', 'dokters'));
        }

        $dokters = Dokter::all();
        return view('admin.rekam_medis.edit', compact('rekamMedis', 'pasiens', 'dokters'));
    }

    /**
     * Update rekam medis
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pasien_id'           => 'required|exists:pasiens,id',
            'keluhan'             => 'required|string',
            'diagnosa'            => 'nullable|string',
            'tindakan'            => 'nullable|string',
            'resep_obat'          => 'nullable|string',
            'catatan'             => 'nullable|string',
            'tanggal_pemeriksaan' => 'required|date',
        ]);

        $rekamMedis = RekamMedis::findOrFail($id);

        if (auth()->user()->role === 'dokter') {
            $validated['dokter_id'] = auth()->user()->dokter->id;
            $rekamMedis->update($validated);
            return redirect()->route('dokter.rekam_medis.index')->with('success', 'Rekam medis berhasil diperbarui.');
        }

        // admin
        $validated['dokter_id'] = $request->validate(['dokter_id' => 'required|exists:dokters,id'])['dokter_id'];
        $rekamMedis->update($validated);
        return redirect()->route('admin.rekam_medis.index')->with('success', 'Rekam medis berhasil diperbarui.');
    }

    /**
     * Hapus rekam medis
     */
    public function destroy($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->delete();

        if (auth()->user()->role === 'dokter') {
            return redirect()->route('dokter.rekam_medis.index')->with('success', 'Rekam medis berhasil dihapus.');
        }

        return redirect()->route('admin.rekam_medis.index')->with('success', 'Rekam medis berhasil dihapus.');
    }

    /**
     * Rekam medis untuk pasien yang login
     */
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
