<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Models\RekamMedis;
use App\Models\Pembayaran;
use App\Models\Dokter;
use App\Models\Pasien;

Route::get('/', fn() => view('welcome'));

Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/home', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        $totalAdmin = User::where('role', 'admin')->count();
        $totalDokter = Dokter::count();
        $totalPasien = Pasien::count();
        $totalRekamMedis = RekamMedis::count();
        $totalPembayaran = Pembayaran::count();
        return view('home.admin', compact('totalAdmin', 'totalDokter', 'totalPasien', 'totalRekamMedis', 'totalPembayaran'));
    }

    if ($user->role === 'dokter') {
        $totalPasien = Pasien::count();
        $totalRekamMedis = RekamMedis::count();
        $totalPembayaran = Pembayaran::count();
        return view('home.dokter', compact('totalPasien', 'totalRekamMedis', 'totalPembayaran'));
    }

    if ($user->role === 'pasien') {
        $pasien = $user->pasien;
        $myRekamMedis = $pasien ? RekamMedis::where('pasien_id', $pasien->id)->count() : 0;
        $myPembayaran = $pasien ? Pembayaran::where('pasien_id', $pasien->id)->count() : 0;
        return view('home.pasien', compact('myRekamMedis', 'myPembayaran'));
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/pasien', PasienController::class)->names('admin.pasien');
    Route::resource('admin/dokter', DokterController::class)->names('admin.dokter');
    Route::resource('admin/rekam_medis', RekamMedisController::class)->names('admin.rekam_medis');
    Route::resource('admin/pembayaran', PembayaranController::class)->names('admin.pembayaran');
});

Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.dashboard');
    Route::resource('dokter/pasien', PasienController::class)->names('dokter.pasien');
    Route::resource('dokter/rekam_medis', RekamMedisController::class)->names('dokter.rekam_medis');
    Route::resource('dokter/pembayaran', PembayaranController::class)->names('dokter.pembayaran');
});

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->as('pasien.')->group(function () {
    Route::get('/', [PasienController::class, 'index'])->name('dashboard');

    Route::get('pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('pendaftaran/{pendaftaran}/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('pendaftaran/{pendaftaran}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::delete('pendaftaran/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');

    Route::get('pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('pembayaran/{id}/bayar', [PembayaranController::class, 'bayarForm'])->name('pembayaran.form');
    Route::post('pembayaran/{pembayaran}/bayar', [PembayaranController::class, 'bayarProses'])->name('pembayaran.proses');

    Route::get('rekam_medis', [RekamMedisController::class, 'index'])->name('rekam_medis.index');
    Route::get('rekam_medis/{rekamMedis}', [RekamMedisController::class, 'show'])->name('rekam_medis.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
});

require __DIR__ . '/auth.php';
