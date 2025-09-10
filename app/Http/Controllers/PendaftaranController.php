<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\Dokter;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan daftar pendaftaran pasien (dalam bentuk tabel).
     */
    public function index()
{
    // Ambil semua data pendaftaran pasien yang sedang login
    $pendaftarans = Pendaftaran::with('dokter')
        ->where('user_id', Auth::id())
        ->get();

    return view('pasien.pendaftaran.index', compact('pendaftarans'));
}


    /**
     * Tampilkan form pendaftaran pasien.
     */
    public function create()
    {
        // Ambil semua dokter untuk ditampilkan di form pilihan
        $dokters = Dokter::all();
        return view('pasien.pendaftaran.create', compact('dokters'));
    }

    /**
     * Simpan data pendaftaran pasien.
     */
    public function store(Request $request)
    {
        // Validasi input pasien
        $validated = $request->validate([
            'keluhan'         => 'required|string',
            'no_telp'         => 'required|string|max:20',
            'tanggal_berobat' => 'required|date',
            'jenis_kelamin'   => 'required|in:L,P', // ← cukup L dan P
            'alamat'          => 'required|string',
            'dokter_id'       => 'required|exists:dokters,id',
        ]);

        // Tambahkan data otomatis dari user login
        $validated['user_id'] = Auth::id();             // simpan ID user
        $validated['nama']    = Auth::user()->name;     // simpan nama user

        // Simpan ke database
        Pendaftaran::create($validated);

        // Redirect dengan pesan sukses
        return redirect()
            ->route('pasien.pendaftaran.index') // ← arahkan ke halaman tabel
            ->with('success', 'Pendaftaran berhasil disimpan.');
    }
}
