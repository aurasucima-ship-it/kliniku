<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
   
    public function index()
    {
        $totalAdmin = User::where('role', 'admin')->count();
        $totalDokter = User::where('role', 'dokter')->count();
        $totalPasien = User::where('role', 'pasien')->count();

        return view('home.admin', compact('totalAdmin', 'totalDokter', 'totalPasien'));
    }

}
