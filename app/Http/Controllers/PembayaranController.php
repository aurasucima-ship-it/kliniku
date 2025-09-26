<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $pembayaran = Pembayaran::with(['dokter', 'pasien'])->get();
        } else { 
            $pembayaran = Pembayaran::with(['dokter', 'pasien'])
                                    ->where('dokter_id', $user->id)
                                    ->get();
        }

        return view('pembayaran.index', compact('pembayaran'));
    }

  
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $dokter = Dokter::all();
            $pasien = Pasien::all();
        } else { // dokter
            $dokter = null;
            $pasien = Pasien::where('dokter_id', $user->id)->get();
        }

        return view('pembayaran.create', compact('dokter', 'pasien'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'layanan'   => 'required|string|max:255',
            'biaya'     => 'required|numeric',
            'tanggal'   => 'required|date',
        ]);

        $dokter_id = $user->role === 'admin' ? $request->dokter_id : $user->id;

        Pembayaran::create([
            'dokter_id' => $dokter_id,
            'pasien_id' => $request->pasien_id,
            'layanan'   => $request->layanan,
            'biaya'     => $request->biaya,
            'tanggal'   => $request->tanggal,
            'status'    => 'belum_lunas',
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'admin') {
            $dokter = Dokter::all();
            $pasien = Pasien::all();
        } else {
            $dokter = null;
            $pasien = Pasien::where('dokter_id', $user->id)->get();
        }

        return view('pembayaran.edit', compact('pembayaran', 'dokter', 'pasien'));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'layanan'   => 'required|string|max:255',
            'biaya'     => 'required|numeric',
            'tanggal'   => 'required|date',
            'status'    => 'required|string',
        ]);

        $dokter_id = Auth::user()->role === 'admin' ? $request->dokter_id : Auth::id();

        $pembayaran->update([
            'dokter_id' => $dokter_id,
            'pasien_id' => $request->pasien_id,
            'layanan'   => $request->layanan,
            'biaya'     => $request->biaya,
            'tanggal'   => $request->tanggal,
            'status'    => $request->status,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diupdate.');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }

    public function indexPasien()
    {
        $pembayaran = Pembayaran::where('pasien_id', Auth::id())->get();
        return view('pasien.pembayaran.index', compact('pembayaran'));
    }

 
    public function formBayar($id)
    {
        $pembayaran = Pembayaran::where('pasien_id', Auth::id())->findOrFail($id);
        return view('pasien.pembayaran.form', compact('pembayaran'));
    }

    public function prosesBayar(Request $request, $id)
    {
        $pembayaran = Pembayaran::where('pasien_id', Auth::id())->findOrFail($id);

        $request->validate([
            'metode' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $pembayaran->update([
            'status' => 'menunggu_konfirmasi',
         
        ]);

        return redirect()->route('pasien.pembayaran.index')
                         ->with('success', 'Pembayaran berhasil diajukan.');
    }
}
