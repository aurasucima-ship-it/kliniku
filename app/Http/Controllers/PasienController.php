<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    // Tampilkan daftar pasien
    public function index()
    {
        $pasiens = Pasien::with('dokter')->get();
        return view('pasien.index', compact('pasiens'));
    }

    // Tampilkan form tambah pasien
    public function create()
    {
        $dokters = Dokter::all();
        return view('pasien.create', compact('dokters'));
    }

    // Simpan pasien baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_telp' => 'nullable|string|max:20',
            'keluhan' => 'nullable|string',
            'tanggal_berobat' => 'required|date',
            'dokter_id' => 'nullable|exists:dokter,id',
        ]);

        Pasien::create($data);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    // 🔹 Detail pasien
    public function show(Pasien $pasien)
    {
        $pasien->load('dokter'); // eager load dokter
        return view('pasien.show', compact('pasien'));
    }

    // Form edit pasien
    public function edit(Pasien $pasien)
    {
        $dokters = Dokter::all();
        return view('pasien.edit', compact('pasien', 'dokters'));
    }

    // Update pasien
    public function update(Request $request, Pasien $pasien)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_telp' => 'nullable|string|max:20',
            'keluhan' => 'nullable|string',
            'tanggal_berobat' => 'required|date',
            'dokter_id' => 'nullable|exists:dokter,id',
        ]);

        $pasien->update($data);

        return redirect()->route('pasien.index')->with('success', 'Data pasien diperbarui.');
    }

    // Hapus pasien
    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return redirect()->route('pasien.index')->with('success', 'Pasien dihapus.');
    }
}
