<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use App\Models\Pasien;
use App\Models\Dokter;
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
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        $pendaftaran = Pendaftaran::with('pasien')->get();

        $user = Auth::user();

        $view = match ($user->role) {
            'admin'  => 'admin.pembayaran.create',
            'dokter' => 'dokter.pembayaran.create',
            default  => abort(403),
        };

        return view($view, compact('pasiens', 'dokters', 'pendaftaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id'      => 'required|exists:pasien,id',
            'pendaftaran_id' => 'nullable|exists:pendaftaran,id',
            'dokter_id'      => 'nullable|exists:dokter,id',
            'jumlah'         => 'required|numeric',
            'metode'         => 'required|string',
            'tanggal'        => 'required|date',
            'keterangan'     => 'nullable|string',
        ]);

        $user = Auth::user();
        $pasien = Pasien::find($request->pasien_id);

        $data = [
'pasien_id' => $pasien?->id,
            'pendaftaran_id' => $request->pendaftaran_id,
            'dokter_id'      => $user->role === 'dokter' ? $user->id : $request->dokter_id,
            'jumlah'         => $request->jumlah,
            'metode'         => $request->metode,
            'tanggal'        => $request->tanggal,
            'keterangan'     => $request->keterangan,
            'status'         => 'belum lunas',
        ];

        Pembayaran::create($data);

        return redirect()->route($user->role . '.pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan, menunggu konfirmasi.');
    }

    public function edit(Pembayaran $pembayaran)
    {
        $pasiens = Pasien::all();
        return view('dokter.pembayaran.edit', compact('pembayaran', 'pasiens'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'pasien_id'  => 'required|exists:pasien,id',
            'jumlah'     => 'required|numeric',
            'metode'     => 'required|string',
            'status'     => 'required|string|in:lunas,belum lunas',
            'tanggal'    => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $pasien = Pasien::find($request->pasien_id);

        $pembayaran->update([
            'pasien_id'  => $pasien?->user_id ?? null,
            'jumlah'     => $request->jumlah,
            'metode'     => $request->metode,
            'status'     => $request->status,
            'tanggal'    => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        if ($pembayaran->pendaftaran_id) {
            $pembayaran->pendaftaran->update(['status_pembayaran' => $request->status]);
        }

        return redirect()->route(Auth::user()->role . '.pembayaran.index')
            ->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route(Auth::user()->role . '.pembayaran.index')
            ->with('success', 'Data pembayaran berhasil dihapus.');
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
