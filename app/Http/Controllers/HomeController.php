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
                $totalAdmin   = User::where('role', 'admin')->count();   // dari tabel users
                $totalDokter  = Dokter::count();                         // dari tabel dokter
                $totalPasien  = Pasien::count();                         // dari tabel pasien

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
                // Ambil pasien sesuai user login
                $pasien = Pasien::where('user_id', $user->id)->first();

                // Ambil rekam medis pasien
                $rekamMedisSaya = $pasien
                    ? $pasien->rekamMedis()->get()
                    : collect();

                return view('home.pasien', [
                    'rekamMedisSaya' => $rekamMedisSaya,
                    'pasien' => $pasien,
                ]);

            // ================= DEFAULT =================
            default:
                return redirect('/');
        }
    }
}
