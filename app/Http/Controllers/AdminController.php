<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Tampilkan dashboard admin.
     */
    public function index()
    {
        // Hitung jumlah user berdasarkan role
        $totalAdmin = User::where('role', 'admin')->count();
        $totalDokter = User::where('role', 'dokter')->count();
        $totalPasien = User::where('role', 'pasien')->count();

        // Kirim data ke view
        return view('home.admin', compact('totalAdmin', 'totalDokter', 'totalPasien'));
    }

    // method lainnya biarin kosong dulu kalau belum dipakai
}
