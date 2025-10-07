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

        $pembayaran = match ($user->role) {
            'admin'  => Pembayaran::with(['pasien', 'dokter'])->latest()->get(),
            'dokter' => Pembayaran::where('dokter_id', $user->id)->with(['pasien', 'dokter'])->latest()->get(),
            'pasien' => Pembayaran::where('pasien_id', $user->id)->with(['pasien', 'dokter'])->latest()->get(),
            default  => abort(403),
        };

        return view($user->role . '.pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        $pasiens = User::where('role', 'pasien')->get();
        $pendaftaran = Pendaftaran::with('pasien')->get();

        return view('dokter.pembayaran.create', compact('pasiens', 'pendaftaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id'      => 'nullable|exists:users,id',
            'pendaftaran_id' => 'nullable|exists:pendaftaran,id',
            'jumlah'         => 'required|numeric',
            'metode'         => 'required|string',
            'tanggal'        => 'required|date',
            'keterangan'     => 'nullable|string',
        ]);

        $user = Auth::user();

        $data = [
            'pasien_id'      => $request->pasien_id,
            'pendaftaran_id' => $request->pendaftaran_id,
            'dokter_id'      => $user->role === 'dokter' ? $user->id : null,
            'jumlah'         => $request->jumlah,
            'metode'         => $request->metode,
            'tanggal'        => $request->tanggal,
            'keterangan'     => $request->keterangan,
            'status'         => 'lunas',
        ];

        if (!$data['pasien_id'] && $data['pendaftaran_id']) {
            $pendaftaran = Pendaftaran::find($data['pendaftaran_id']);
            $data['pasien_id'] = $pendaftaran?->pasien_id;
        }

        $pembayaran = Pembayaran::create($data);

        if ($pembayaran->pendaftaran_id) {
            $pembayaran->pendaftaran->update(['status_pembayaran' => 'lunas']);
        }

        return redirect()->route($user->role . '.pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function edit(Pembayaran $pembayaran)
    {
        $pasiens = User::where('role', 'pasien')->get();
        return view('dokter.pembayaran.edit', compact('pembayaran', 'pasiens'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'pasien_id'  => 'required|exists:users,id',
            'jumlah'     => 'required|numeric',
            'metode'     => 'required|string',
            'status'     => 'required|string|in:lunas,belum',
            'tanggal'    => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran->update($request->only(['pasien_id', 'jumlah', 'metode', 'status', 'tanggal', 'keterangan']));

        if ($pembayaran->pendaftaran_id) {
            $pembayaran->pendaftaran->update(['status_pembayaran' => $request->status]);
        }

        return redirect()->route(Auth::user()->role . '.pembayaran.index')->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route(Auth::user()->role . '.pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus.');
    }

    public function bayarForm($id)
    {
        $pembayaran  = Pembayaran::with(['pendaftaran', 'dokter'])->findOrFail($id);
        $pendaftaran = $pembayaran->pendaftaran;
        $dokter      = $pembayaran->dokter;
        $biaya       = $pembayaran->jumlah;
        $pasien      = Auth::user();

        return view('pasien.pembayaran.form', compact('pembayaran', 'pendaftaran', 'dokter', 'biaya', 'pasien'));
    }

    public function bayarProses(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'metode' => 'required|string',
        ]);

        $pembayaran->update([
            'metode'  => $request->metode,
            'status'  => 'lunas',
            'tanggal' => now(),
        ]);

        if ($pembayaran->pendaftaran_id) {
            $pembayaran->pendaftaran->update(['status_pembayaran' => 'lunas']);
        }

        return redirect()->route('pasien.pembayaran.index')->with('success', 'Pembayaran berhasil.');
    }
}
