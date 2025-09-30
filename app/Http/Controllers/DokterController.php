<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    // Halaman dashboard dokter
    public function home()
    {
        $totalDokter = Dokter::count();
        $totalPasien = Pasien::count();

        return view('home.dokter', compact('totalDokter', 'totalPasien'));
    }

    public function index()
    {
        $dokters = Dokter::latest()->get();
        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        return view('admin.dokter.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'alamat'    => 'required|string|max:255',
        ]);

        Dokter::create($validated);

        return redirect()->route('admin.dokter.index')
                         ->with('success', 'Data dokter berhasil ditambahkan!');
    }

    public function edit(Dokter $dokter)
    {
        return view('admin.dokter.edit', compact('dokter'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'alamat'    => 'required|string|max:255',
        ]);

        $dokter->update($validated);

        return redirect()->route('admin.dokter.index')
                         ->with('success', 'Data dokter berhasil diperbarui!');
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();

        return redirect()->route('admin.dokter.index')
                         ->with('success', 'Data dokter berhasil dihapus!');
    }
}
