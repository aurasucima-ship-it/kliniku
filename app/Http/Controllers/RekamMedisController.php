<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'dokter') {
            $rekamMedis = RekamMedis::with(['pasien', 'dokter'])
                ->where('dokter_id', $user->dokter->id ?? null)
                ->latest('tanggal_pemeriksaan')
                ->get();

            return view('dokter.rekam_medis.index', compact('rekamMedis'));
        }

        if ($user->role === 'pasien') {
            $pasien = Pasien::where('user_id', $user->id)->firstOrFail();

            $rekamMedis = RekamMedis::with('dokter')
                ->where('pasien_id', $pasien->id)
                ->latest('tanggal_pemeriksaan')
                ->get();

            return view('pasien.rekam_medis.index', compact('rekamMedis'));
        }

        $rekamMedis = RekamMedis::with(['pasien', 'dokter'])
            ->latest('tanggal_pemeriksaan')
            ->get();

        return view('admin.rekam_medis.index', compact('rekamMedis'));
    }

    public function create(Request $request)
    {
        $pendaftaran = $request->has('pendaftaran_id')
            ? Pendaftaran::with(['dokter', 'user'])->findOrFail($request->pendaftaran_id)
            : null;

        $pasiens = Pasien::all();

        if (Auth::user()->role === 'dokter') {
            $dokters = null;
            return view('dokter.rekam_medis.create', compact('pasiens', 'dokters', 'pendaftaran'));
        }

        $dokters = Dokter::all();
        return view('admin.rekam_medis.create', compact('pasiens', 'dokters', 'pendaftaran'));
    }

    public function store(Request $request)
    {
        $rules = [
            'pasien_id'           => 'required|exists:pasien,id',
            'keluhan'             => 'required|string',
            'diagnosa'            => 'nullable|string',
            'tindakan'            => 'nullable|string',
            'resep_obat'          => 'nullable|string',
            'catatan'             => 'nullable|string',
            'tanggal_pemeriksaan' => 'required|date',
        ];

        if (Auth::user()->role === 'admin') {
            $rules['dokter_id'] = 'required|exists:dokter,id';
        }

        $validated = $request->validate($rules);

        if (Auth::user()->role === 'dokter') {
            $validated['dokter_id'] = Auth::user()->dokter->id ?? null;
        }

        RekamMedis::create($validated);

        $redirectRoute = Auth::user()->role === 'dokter'
            ? 'dokter.rekam_medis.index'
            : 'admin.rekam_medis.index';

        return redirect()->route($redirectRoute)->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function show($id)
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter'])->findOrFail($id);

        if (Auth::user()->role === 'dokter') {
            return view('dokter.rekam_medis.show', compact('rekamMedis'));
        }

        if (Auth::user()->role === 'admin') {
            return view('admin.rekam_medis.show', compact('rekamMedis'));
        }

        if (Auth::user()->role === 'pasien') {
            $pasien = Pasien::where('user_id', Auth::id())->firstOrFail();

            if ($rekamMedis->pasien_id !== $pasien->id) {
                abort(403);
            }

            return view('pasien.rekam_medis.show', compact('rekamMedis'));
        }

        abort(403);
    }

    public function edit($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $pasiens    = Pasien::all();

        if (Auth::user()->role === 'dokter') {
            $dokters = null;
            return view('dokter.rekam_medis.edit', compact('rekamMedis', 'pasiens', 'dokters'));
        }

        $dokters = Dokter::all();
        return view('admin.rekam_medis.edit', compact('rekamMedis', 'pasiens', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'pasien_id'           => 'required|exists:pasien,id',
            'keluhan'             => 'required|string',
            'diagnosa'            => 'nullable|string',
            'tindakan'            => 'nullable|string',
            'resep_obat'          => 'nullable|string',
            'catatan'             => 'nullable|string',
            'tanggal_pemeriksaan' => 'required|date',
        ];

        if (Auth::user()->role === 'admin') {
            $rules['dokter_id'] = 'required|exists:dokter,id';
        }

        $validated = $request->validate($rules);

        $rekamMedis = RekamMedis::findOrFail($id);

        if (Auth::user()->role === 'dokter') {
            $validated['dokter_id'] = Auth::user()->dokter->id ?? null;
        }

        $rekamMedis->update($validated);

        $redirectRoute = Auth::user()->role === 'dokter'
            ? 'dokter.rekam_medis.index'
            : 'admin.rekam_medis.index';

        return redirect()->route($redirectRoute)->with('success', 'Rekam medis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->delete();

        $redirectRoute = Auth::user()->role === 'dokter'
            ? 'dokter.rekam_medis.index'
            : 'admin.rekam_medis.index';

        return redirect()->route($redirectRoute)->with('success', 'Rekam medis berhasil dihapus.');
    }
}
