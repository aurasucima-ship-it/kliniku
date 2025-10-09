<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;

class AdminController extends Controller
{
    public function index()
    {
        $totalAdmin = User::where('role', 'admin')->count();
        $totalDokter = Dokter::count();
        $totalPasien = Pasien::count();

        return view('home.admin', compact('totalAdmin', 'totalDokter', 'totalPasien'));
    }
}
