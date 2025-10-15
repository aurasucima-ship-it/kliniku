<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\RekamMedis;
use App\Models\Pembayaran;

class AdminController extends Controller
{
    public function index()
    {
        $totalAdmin = User::where('role', 'admin')->count();
        $totalDokter = Dokter::count();
        $totalPasien = Pasien::count();
        $totalRekamMedis = RekamMedis::count();
        $totalPembayaran = Pembayaran::count();

        return view('home.admin', compact(
            'totalAdmin', 
            'totalDokter', 
            'totalPasien', 
            'totalRekamMedis', 
            'totalPembayaran'
        ));
    }
}
