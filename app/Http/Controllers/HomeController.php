<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\RekamMedis;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Dashboard utama berdasarkan role user
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        switch ($user->role) {
            // ======================
            // ADMIN DASHBOARD
            // ======================
            case 'admin':
                $totalAdmin  = User::where('role', 'admin')->count();
                $totalDokter = Dokter::count();
                $totalPasien = Pasien::count();

                // Statistik kunjungan pasien per hari
                $kunjungan = Pendaftaran::selectRaw('COUNT(*) as total, DATE(created_at) as date')
                    ->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->get();

                $labels = $kunjungan->pluck('date')
                    ->map(fn($d) => Carbon::parse($d)->format('d/m'))
                    ->toArray();

                $data = $kunjungan->pluck('total')->toArray();

                return view('home.admin', compact(
                    'totalAdmin',
                    'totalDokter',
                    'totalPasien',
                    'labels',
                    'data'
                ));

            // ======================
            // DOKTER DASHBOARD
            // ======================
            case 'dokter':
                $dokterId = optional($user->dokter)->id; // aman kalau null

                $totalPasien = $dokterId
                    ? Pasien::where('dokter_id', $dokterId)->count()
                    : 0;

                $totalRekamMedis = $dokterId
                    ? RekamMedis::whereHas('pasien', fn($q) => $q->where('dokter_id', $dokterId))->count()
                    : 0;

                $totalPembayaran = $dokterId
                    ? Pembayaran::whereHas('pasien', fn($q) => $q->where('dokter_id', $dokterId))->count()
                    : 0;

                return view('home.dokter', compact(
                    'totalPasien',
                    'totalRekamMedis',
                    'totalPembayaran'
                ));

            // ======================
            // PASIEN DASHBOARD
            // ======================
            case 'pasien':
                $pasien = Pasien::where('user_id', $user->id)->first();

                $rekamMedisSaya = $pasien?->rekamMedis()->get() ?? collect();
                $pembayaranSaya = $pasien?->pembayaran()->get() ?? collect();
                $pendaftaranSaya = $pasien?->pendaftaran()->get() ?? collect();

                return view('home.pasien', compact(
                    'pasien',
                    'rekamMedisSaya',
                    'pembayaranSaya',
                    'pendaftaranSaya'
                ));

            // ======================
            // DEFAULT → LOGIN
            // ======================
            default:
                return redirect()->route('login');
        }
    }
}
