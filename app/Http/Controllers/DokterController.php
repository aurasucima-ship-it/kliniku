<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
   
    public function index()
    {
        $dokters = Dokter::latest()->get();
        return view('dokter.index', compact('dokters'));
    }


    public function create()
    {
        return view('dokter.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'alamat'    => 'required|string|max:255',
        ]);

        Dokter::create($validated);

        return redirect()->route('dokter.index')
                         ->with('success', 'Data dokter berhasil ditambahkan!');
    }

    public function edit(Dokter $dokter)
    {
        return view('dokter.edit', compact('dokter'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'alamat'    => 'required|string|max:255',
        ]);

        $dokter->update($validated);

        return redirect()->route('dokter.index')
                         ->with('success', 'Data dokter berhasil diperbarui!');
    }

  
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();

        return redirect()->route('dokter.index')
                         ->with('success', 'Data dokter berhasil dihapus!');
    }
}
