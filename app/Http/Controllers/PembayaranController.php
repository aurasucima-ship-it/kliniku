<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $pembayaran = Pembayaran::with(['pasien', 'dokter', 'pendaftaran'])->latest()->get();
            return view('admin.pembayaran.index', compact('pembayaran'));
        }

        if ($user->role === 'dokter') {
            $pembayaran = Pembayaran::where('dokter_id', $user->id)
                ->with(['pasien', 'pendaftaran'])
                ->latest()
                ->get();
            return view('dokter.pembayaran.index', compact('pembayaran'));
        }

        if ($user->role === 'pasien') {
            $pembayaran = Pembayaran::where('pasien_id', $user->id)
                ->with(['dokter', 'pendaftaran'])
                ->latest()
                ->get();
            return view('pasien.pembayaran.index', compact('pembayaran'));
        }

        abort(403);
    }

    public function create()
    {
        $pasiens = User::where('role', 'pasien')->get();
        $pendaftaran = Pendaftaran::with('pasien')->get()->map(function($p) {
            return [
                'id' => $p->id,
                'pasien_id' => $p->pasien_id,
                'nama' => $p->pasien->nama ?? 'Tidak ada nama',
            ];
        });

        return view('dokter.pembayaran.create', compact('pasiens', 'pendaftaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:users,id',
            'jumlah' => 'required|numeric',
            'metode' => 'required|string|in:cash,transfer',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'pendaftaran_id' => 'nullable|exists:pendaftaran,id',
        ]);

        $user = Auth::user();

        $data = [
            'pendaftaran_id' => $request->pendaftaran_id ?? null,
            'pasien_id' => $request->pasien_id,
            'jumlah' => $request->jumlah,
            'metode' => $request->metode,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'status' => 'lunas',
        ];

        if ($user->role === 'dokter') $data['dokter_id'] = $user->id;
        if ($user->role === 'admin') $data['admin_id'] = $user->id;

        $pembayaran = Pembayaran::create($data);

        if ($data['pendaftaran_id']) {
            $pendaftaran = Pendaftaran::find($data['pendaftaran_id']);
            if ($pendaftaran) $pendaftaran->update(['status_pembayaran' => 'lunas']);
        }

        return redirect()->route($user->role.'.pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function edit(Pembayaran $pembayaran)
    {
        $pasiens = User::where('role', 'pasien')->get();
        return view('dokter.pembayaran.edit', compact('pembayaran', 'pasiens'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'pasien_id' => 'required|exists:users,id',
            'jumlah' => 'required|numeric',
            'metode' => 'required|string|in:cash,transfer',
            'status' => 'required|string|in:lunas,nunggu,belum',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $data = [
            'pasien_id' => $request->pasien_id,
            'jumlah' => $request->jumlah,
            'metode' => $request->metode,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ];

        $pembayaran->update($data);

        if ($pembayaran->pendaftaran_id) {
            $pembayaran->pendaftaran->update(['status_pembayaran' => $request->status]);
        }

        $user = Auth::user();
        return redirect()->route($user->role.'.pembayaran.index')->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        $user = Auth::user();
        return redirect()->route($user->role.'.pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus.');
    }
}
