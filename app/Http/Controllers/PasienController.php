<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    /**
     * Dashboard pasien.
     */
    public function home()
    {
        $user = Auth::user();
        $pasien = $user->pasien; // ambil data pasien login

        $totalKunjungan = $pasien ? $pasien->count() : 0;
        $riwayatPembayaran = $pasien ? $pasien->pembayaran()->latest()->take(5)->get() : [];

        return view('home.pasien', compact('pasien', 'totalKunjungan', 'riwayatPembayaran'));
    }

    /**
     * Tampilkan daftar pasien sesuai role.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'dokter') {
            $dokterId = $user->dokter?->id;
            $pasiens = Pasien::with('pembayaran')->where('dokter_id', $dokterId)->get();
        } elseif ($user->role === 'pasien') {
            $pasiens = Pasien::with('dokter', 'pembayaran')
                             ->where('id', $user->pasien?->id)
                             ->get();
        } else {
            $pasiens = Pasien::with('dokter', 'pembayaran')->get();
        }

        $viewPath = $user->role . '.pasien.index';
        return view($viewPath, compact('pasiens'));
    }

    public function create()
    {
        $user = Auth::user();
        $dokters = $user->role === 'admin' ? Dokter::all() : null;
        $viewPath = $user->role . '.pasien.create';
        return view($viewPath, compact('dokters'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nama'            => 'required|string|max:255',
            'alamat'          => 'nullable|string',
            'jenis_kelamin'   => 'required|in:L,P',
            'no_telp'         => 'nullable|numeric|digits_between:8,15',
            'keluhan'         => 'nullable|string',
            'tanggal_berobat' => 'required|date',
            'dokter_id'       => 'nullable|exists:dokters,id',
        ]);

        if ($user->role === 'dokter') {
            $data['dokter_id'] = $user->dokter->id;
        }

        Pasien::create($data);

        return redirect($this->redirectRoute())->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function show(Pasien $pasien)
    {
        $user = Auth::user();
        $pembayaran = $pasien->pembayaran()->latest()->get();
        return view($user->role . '.pasien.show', compact('pasien', 'pembayaran'));
    }

    public function edit(Pasien $pasien)
    {
        $user = Auth::user();
        $dokters = $user->role === 'admin' ? Dokter::all() : null;
        return view($user->role . '.pasien.edit', compact('pasien', 'dokters'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nama'            => 'required|string|max:255',
            'alamat'          => 'nullable|string',
            'jenis_kelamin'   => 'required|in:L,P',
            'no_telp'         => 'nullable|numeric|digits_between:8,15',
            'keluhan'         => 'nullable|string',
            'tanggal_berobat' => 'required|date',
            'dokter_id'       => 'nullable|exists:dokters,id',
        ]);

        if ($user->role === 'dokter') {
            unset($data['dokter_id']);
        }

        $pasien->update($data);

        return redirect($this->redirectRoute())->with('success', 'Data pasien diperbarui.');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return redirect($this->redirectRoute())->with('success', 'Pasien dihapus.');
    }

    private function redirectRoute()
    {
        $user = Auth::user();
        return match($user->role) {
            'admin'  => route('admin.pasien.index'),
            'dokter' => route('dokter.pasien.index'),
            'pasien' => route('pasien.pasien.index'),
            default  => route('home')
        };
    }
}
