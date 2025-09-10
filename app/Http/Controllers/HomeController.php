<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\RekamMedis;
use App\Models\Pendaftaran;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        switch ($user->role) {
            // ================= ADMIN =================
            case 'admin':
                $totalAdmin   = User::where('role', 'admin')->count();
                $totalDokter  = User::where('role', 'dokter')->count();
                $totalPasien  = User::where('role', 'pasien')->count();

                // hitung jumlah pendaftaran pasien per hari
                $kunjungan = Pendaftaran::selectRaw('COUNT(*) as total, DATE_FORMAT(created_at, "%d/%m") as date')
                    ->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->get();

                return view('home.admin', [
                    'totalAdmin'  => $totalAdmin,
                    'totalDokter' => $totalDokter,
                    'totalPasien' => $totalPasien,
                    'labels'      => $kunjungan->pluck('date')->toArray(),
                    'data'        => $kunjungan->pluck('total')->toArray(),
                ]);

            // ================= DOKTER =================
            case 'dokter':
                $totalPasien = Pasien::count();
                $rekamMedis  = RekamMedis::count();

                return view('home.dokter', [
                    'totalPasien' => $totalPasien,
                    'rekamMedis'  => $rekamMedis,
                ]);

            // ================= PASIEN =================
            case 'pasien':
                $pasien = Pasien::where('user_id', $user->id)->first();
                $rekamMedisSaya = $pasien
                    ? RekamMedis::where('pasien_id', $pasien->id)->get()
                    : collect();

return view('home.pasien', [
    'rekamMedisSaya' => $rekamMedisSaya,
]);


            // ================= DEFAULT =================
            default:
                return redirect('/');
        }
    }
}
