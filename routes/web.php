<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\PendaftaranController;

Route::get('/', fn () => view('welcome'));
Route::get('/dashboard', fn () => redirect()->route('home'))->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:admin,dokter'])->prefix('admin')->group(function () {
    Route::resource('pasien', PasienController::class);   
    Route::resource('dokter', DokterController::class);   
});


Route::middleware(['auth', 'role:admin,dokter'])->group(function () {
    Route::resource('rekam_medis', RekamMedisController::class);
});


Route::middleware(['auth', 'role:pasien,dokter'])
    ->prefix('pendaftaran')
    ->name('pasien.pendaftaran.')
    ->group(function () {
        Route::get('/', [PendaftaranController::class, 'index'])->name('index');
        Route::get('/create', [PendaftaranController::class, 'create'])->name('create');
        Route::post('/', [PendaftaranController::class, 'store'])->name('store');
        Route::delete('/{id}', [PendaftaranController::class, 'destroy'])->name('destroy');

    });


Route::middleware(['auth', 'role:pasien'])
    ->prefix('pasien')
    ->name('pasien.')
    ->group(function () {
     
        Route::get('/dashboard', fn () => view('pasien.dashboard'))->name('dashboard');

        Route::get('/rekam_medis', [RekamMedisController::class, 'pasienRekamMedis'])->name('rekam_medis');
    });


require __DIR__ . '/auth.php';
