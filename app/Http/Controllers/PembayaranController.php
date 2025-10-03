<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $pembayarans = Pembayaran::with(['pasien', 'dokter'])->latest()->get();
            return view('admin.pembayaran.index', compact('pembayarans'));
        }

        if ($user->role === 'dokter') {
            $pembayarans = Pembayaran::with('pasien')->where('dokter_id', $user->id)->latest()->get();
            return view('dokter.pembayaran.index', compact('pembayarans'));
        }

        if ($user->role === 'pasien') {
            $pembayarans = Pembayaran::with('dokter')->where('pasien_id', $user->pasien->id ?? 0)->latest()->get();
            return view('pasien.pembayaran.index', compact('pembayarans'));
        }

        abort(403);
    }

    public function create()
    {
        $user = Auth::user();
        $pasiens = Pasien::all();

        if ($user->role === 'admin') {
            $dokter = Dokter::all();
            return view('admin.pembayaran.create', compact('pasiens', 'dokter'));
        }

        if ($user->role === 'dokter') {
            return view('dokter.pembayaran.create', compact('pasiens'));
        }

        if ($user->role === 'pasien') {
            return view('pasien.pembayaran.create');
        }

        abort(403);
    }

    public function pembayaranForm($pendaftaranId)
    {
        $user = Auth::user();

        if ($user->role !== 'pasien') {
            abort(403);
        }

        $pendaftaran = Pendaftaran::with('dokter')->findOrFail($pendaftaranId);
        $dokter = $pendaftaran->dokter;
        $biaya = $pendaftaran->biaya ?? 0;

        return view('pasien.pembayaran.form', compact('dokter', 'biaya', 'pendaftaran'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ];

        if ($user->role === 'admin' || $user->role === 'dokter') {
            $rules['pasien_id'] = 'required|exists:pasien,id';
        }

        if ($user->role === 'admin') {
            $rules['dokter_id'] = 'required|exists:dokter,id';
        }

        if ($user->role === 'pasien') {
            $rules['metode'] = 'required|string';
            $rules['pendaftaran_id'] = 'required|exists:pendaftarans,id';
        }

        $data = $request->validate($rules);

        if ($user->role === 'dokter') {
            $data['dokter_id'] = $user->id;
            $data['status'] = 'belum';
            $data['metode'] = 'offline';
            $data['keterangan'] = $request->keterangan ?? '';
        }

        if ($user->role === 'admin') {
            $data['status'] = 'belum';
            $data['metode'] = 'offline';
            $data['keterangan'] = $request->keterangan ?? '';
        }

        if ($user->role === 'pasien') {
            $data['pasien_id'] = $user->pasien->id;
            $pendaftaran = Pendaftaran::findOrFail($request->pendaftaran_id);
            $data['dokter_id'] = $pendaftaran->dokter_id ?? null;
            $data['status'] = 'lunas';
            $data['keterangan'] = $request->keterangan ?? '';
        }

        Pembayaran::create($data);

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

    public function show(Pembayaran $pembayaran)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.pembayaran.show', compact('pembayaran'));
        }

        if ($user->role === 'dokter' && $pembayaran->dokter_id == $user->id) {
            return view('dokter.pembayaran.show', compact('pembayaran'));
        }

        if ($user->role === 'pasien' && $pembayaran->pasien_id == ($user->pasien->id ?? 0)) {
            return view('pasien.pembayaran.show', compact('pembayaran'));
        }

        abort(403);
    }

    public function edit(Pembayaran $pembayaran)
    {
        $pasiens = Pasien::all();
        $user = Auth::user();

        if ($user->role === 'admin') {
            $dokter = Dokter::all();
            return view('admin.pembayaran.edit', compact('pembayaran', 'pasiens', 'dokter'));
        }

        if ($user->role === 'dokter' && $pembayaran->dokter_id == $user->id) {
            return view('dokter.pembayaran.edit', compact('pembayaran', 'pasiens'));
        }

        abort(403);
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $user = Auth::user();

        $rules = [
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'status' => 'required|string|in:belum,nunggu,lunas',
        ];

        if ($user->role === 'admin' || $user->role === 'dokter') {
            $rules['pasien_id'] = 'required|exists:pasien,id';
        }

        $data = $request->validate($rules);

        if ($user->role === 'dokter') {
            $data['dokter_id'] = $user->id;
            $data['metode'] = 'offline';
            $data['keterangan'] = $request->keterangan ?? '';
        }

        if ($user->role === 'admin') {
            $data['dokter_id'] = $request->dokter_id;
            $data['metode'] = 'offline';
            $data['keterangan'] = $request->keterangan ?? '';
        }

        $pembayaran->update($data);

        if ($user->role === 'admin') {
            return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
        }

        if ($user->role === 'dokter') {
            return redirect()->route('dokter.pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
        }

        abort(403);
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $user = Auth::user();

        if ($user->role === 'admin' || ($user->role === 'dokter' && $pembayaran->dokter_id == $user->id)) {
            $pembayaran->delete();

            if ($user->role === 'admin') {
                return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
            }

            if ($user->role === 'dokter') {
                return redirect()->route('dokter.pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
            }
        }

        abort(403);
    }
}
