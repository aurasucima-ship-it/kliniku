<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        $totalDokter = Dokter::count();
        $totalPasien = Pasien::where('dokter_id', $user->dokter->id)->count();
        $totalRekamMedis = RekamMedis::whereHas('pasien', function($q) use ($user) {
            $q->where('dokter_id', $user->dokter->id);
        })->count();
        $totalPembayaran = Pembayaran::whereHas('pasien', function($q) use ($user) {
            $q->where('dokter_id', $user->dokter->id);
        })->count();

        return view('home.dokter', compact('totalDokter', 'totalPasien', 'totalRekamMedis', 'totalPembayaran'));
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
            'no_telp'   => 'nullable|string|max:20',
        ]);

        Dokter::create($validated);

        return redirect()->route('admin.dokter.index')
                         ->with('success', 'Data dokter berhasil ditambahkan!');
    }

    public function show(Dokter $dokter)
    {
        return view('admin.dokter.show', compact('dokter'));
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
            'no_telp'   => 'nullable|string|max:20',
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
