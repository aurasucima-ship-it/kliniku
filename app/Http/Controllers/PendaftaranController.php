<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\Dokter;

class PendaftaranController extends Controller
{
 
    public function index()
    {
        $pendaftarans = Pendaftaran::with('dokter')
            ->where('user_id', Auth::id())
            ->get();

        return view('pasien.pendaftaran.index', compact('pendaftarans'));
    }

   
    public function indexDokter()
    {
        $pendaftarans = Pendaftaran::with('user') 
            ->where('dokter_id', Auth::id())     
            ->get();

        return view('dokter.pendaftaran.index', compact('pendaftarans'));
    }

   
    public function indexAdmin()
    {
        $pendaftarans = Pendaftaran::with(['dokter', 'user'])->get();

        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

 
    public function create()
    {
        $dokters = Dokter::all();
        return view('pasien.pendaftaran.create', compact('dokters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'keluhan'         => 'required|string',
            'no_telp'         => 'required|string|max:20',
            'tanggal_berobat' => 'required|date',
            'jenis_kelamin'   => 'required|in:L,P',
            'alamat'          => 'required|string',
            'dokter_id'       => 'required|exists:dokter,id',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['nama']    = Auth::user()->name;

        Pendaftaran::create($validated);

        return redirect()
            ->route('pasien.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil disimpan.');
    }

 
    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::where('id', $id)
            ->where('user_id', Auth::id()) 
            ->firstOrFail();

        $pendaftaran->delete();

        return redirect()
            ->route('pasien.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil dihapus.');
    }
}
