<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    // Daftar semua pembayaran
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $pembayaran = Pembayaran::with('pasien')->latest()->get();
            return view('admin.pembayaran.index', compact('pembayaran'));
        }

        if ($user->role === 'dokter') {
            $pembayaran = Pembayaran::with('pasien')->latest()->get();
            return view('dokter.pembayaran.index', compact('pembayaran'));
        }

        if ($user->role === 'pasien') {
            $pembayaran = Pembayaran::with('pasien')
                            ->where('pasien_id', $user->pasien->id ?? 0)
                            ->latest()->get();
            return view('pasien.pembayaran.index', compact('pembayaran'));
        }

        abort(403);
    }

    // Form create pembayaran
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $pasiens = Pasien::all();
            return view('admin.pembayaran.create', compact('pasiens'));
        }

        if ($user->role === 'dokter') {
            $pasiens = Pasien::all();
            return view('dokter.pembayaran.create', compact('pasiens'));
        }

        if ($user->role === 'pasien') {
            return view('pasien.pembayaran.create');
        }

        abort(403);
    }

    // Simpan pembayaran
    public function store(Request $request)
    {
        $data = $request->validate([
            'pasien_id'   => 'required|exists:pasien,id',
            'jumlah'      => 'required|numeric|min:0',
            'metode'      => 'required|string',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
        ]);

        $pembayaran = Pembayaran::create($data);

        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil disimpan.');
        }

        if ($user->role === 'dokter') {
            return redirect()->route('dokter.pembayaran.index')->with('success', 'Pembayaran berhasil disimpan.');
        }

        if ($user->role === 'pasien') {
            return redirect()->route('pasien.pembayaran.index')->with('success', 'Pembayaran berhasil disimpan.');
        }

        abort(403);
    }

    // Lihat detail pembayaran
    public function show(Pembayaran $pembayaran)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.pembayaran.show', compact('pembayaran'));
        }

        if ($user->role === 'dokter') {
            return view('dokter.pembayaran.show', compact('pembayaran'));
        }

        if ($user->role === 'pasien' && $pembayaran->pasien_id == ($user->pasien->id ?? 0)) {
            return view('pasien.pembayaran.show', compact('pembayaran'));
        }

        abort(403);
    }

    // Form edit pembayaran
    public function edit(Pembayaran $pembayaran)
    {
        $pasiens = Pasien::all();
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.pembayaran.edit', compact('pembayaran', 'pasiens'));
        }

        if ($user->role === 'dokter') {
            return view('dokter.pembayaran.edit', compact('pembayaran', 'pasiens'));
        }

        abort(403);
    }

    // Update pembayaran
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $data = $request->validate([
            'pasien_id'   => 'required|exists:pasien,id',
            'jumlah'      => 'required|numeric|min:0',
            'metode'      => 'required|string',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
        ]);

        $pembayaran->update($data);

        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
        }

        if ($user->role === 'dokter') {
            return redirect()->route('dokter.pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
        }

        abort(403);
    }

    // Hapus pembayaran
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
        }

        if ($user->role === 'dokter') {
            return redirect()->route('dokter.pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
        }

        abort(403);
    }
}
