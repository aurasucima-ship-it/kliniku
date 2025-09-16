<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\RekamMedis;
use App\Models\Pendaftaran;
use Carbon\Carbon;

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
                $totalAdmin  = User::where('role', 'admin')->count();
                $totalDokter = Dokter::count();
                $totalPasien = Pasien::count();

                // Ambil data kunjungan per hari
                $kunjungan = Pendaftaran::selectRaw('COUNT(*) as total, DATE(created_at) as date')
                    ->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->get();

                $labels = $kunjungan->pluck('date')
                    ->map(fn($d) => Carbon::parse($d)->format('d/m'))
                    ->toArray();

                $data = $kunjungan->pluck('total')->toArray();

                return view('home.admin', [
                    'totalAdmin'  => $totalAdmin,
                    'totalDokter' => $totalDokter,
                    'totalPasien' => $totalPasien,
                    'labels'      => $labels,
                    'data'        => $data,
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
                    ? $pasien->rekamMedis()->get()
                    : collect();

                return view('home.pasien', [
                    'rekamMedisSaya' => $rekamMedisSaya,
                    'pasien'         => $pasien,
                ]);

            // ================= DEFAULT =================
            default:
                return redirect('/');
        }
    }
}
