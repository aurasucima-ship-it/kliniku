<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class DokterNotifikasiController extends Controller
{
public function showPage()
{
    $user = Auth::user();
    $dokter = $user->dokter;

    if (!$dokter) {
        return view('dokter.notifikasi.index', [
            'pendaftaran' => collect(),
            'pembayaran' => collect()
        ]);
    }

    $pendaftaran = Pendaftaran::where('dokter_id', $dokter->id)
                    ->where('status', 'baru')
                    ->get();

    $pembayaran = Pembayaran::whereHas('pendaftaran', function($q) use ($dokter) {
                        $q->where('dokter_id', $dokter->id);
                    })->where('status', 'menunggu')
                      ->get();

    return view('dokter.notifikasi.index', compact('pendaftaran', 'pembayaran'));
}

    public function index() // untuk AJAX
    {
        $dokter = Auth::user();
        $pendaftaranCount = Pendaftaran::where('dokter_id', $dokter->id)
                            ->where('status', 'baru')
                            ->count();
        $pembayaranCount = Pembayaran::whereHas('pendaftaran', function($q) use ($dokter) {
                                $q->where('dokter_id', $dokter->id);
                            })->where('status', 'menunggu')
                              ->count();
        return response()->json([
            'pendaftaran' => $pendaftaranCount,
            'pembayaran' => $pembayaranCount
        ]);
    }

    public function markAsRead($id)
    {
        Notification::where('id', $id)->update(['is_read' => true]);
        return response()->json(['status' => 'success']);
    }
}
