<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    // Tampilkan daftar dokter
    public function index()
    {
        $dokters = Dokter::latest()->get();
        return view('dokter.index', compact('dokters'));
    }

    // Form tambah dokter
    public function create()
    {
        return view('dokter.create');
    }

    // Simpan data dokter baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'alamat'    => 'required|string|max:255',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $dokter = new Dokter();
        $dokter->nama = $validated['nama'];
        $dokter->spesialis = $validated['spesialis'];
        $dokter->alamat = $validated['alamat'];

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/dokter', $filename); // folder sesuai tempat lama
            $dokter->foto = $filename;
        }

        $dokter->save();

        return redirect()->route('dokter.index')
                         ->with('success', 'Data dokter berhasil ditambahkan!');
    }

    // Form edit dokter
    public function edit(Dokter $dokter)
    {
        return view('dokter.edit', compact('dokter'));
    }

    // Update data dokter
    public function update(Request $request, Dokter $dokter)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'alamat'    => 'required|string|max:255',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $dokter->nama = $validated['nama'];
        $dokter->spesialis = $validated['spesialis'];
        $dokter->alamat = $validated['alamat'];

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($dokter->foto && Storage::exists('public/uploads/dokter/' . $dokter->foto)) {
                Storage::delete('public/uploads/dokter/' . $dokter->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/dokter', $filename);
            $dokter->foto = $filename;
        }

        $dokter->save();

        return redirect()->route('dokter.index')
                         ->with('success', 'Data dokter berhasil diperbarui!');
    }

    // Hapus data dokter
    public function destroy(Dokter $dokter)
    {
        // Hapus foto jika ada
        if ($dokter->foto && Storage::exists('public/uploads/dokter/' . $dokter->foto)) {
            Storage::delete('public/uploads/dokter/' . $dokter->foto);
        }

        $dokter->delete();

        return redirect()->route('dokter.index')
                         ->with('success', 'Data dokter berhasil dihapus!');
    }
}
