<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\PendaftaranController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'));
Route::get('/dashboard', fn () => redirect()->route('home'))->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| Profil (semua user login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Area
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('pasien', PasienController::class);           // CRUD pasien
    Route::resource('dokter', DokterController::class);           // CRUD dokter
    Route::resource('rekam_medis', RekamMedisController::class);  // CRUD rekam medis
});

/*
|--------------------------------------------------------------------------
| Dokter Area
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::resource('rekam_medis', RekamMedisController::class);  // Input rekam medis pasien
});

/*
|--------------------------------------------------------------------------
| Pasien Area
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pasien'])
    ->prefix('pasien')
    ->name('pasien.')
    ->group(function () {
        // Dashboard pasien
        Route::get('/dashboard', fn () => view('pasien.dashboard'))->name('dashboard');

        // Pendaftaran pasien
        Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
        Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
        Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

        // Rekam medis pasien (read-only)
        Route::get('/rekam_medis', [RekamMedisController::class, 'pasienRekamMedis'])->name('rekam_medis');
    });


/*
|--------------------------------------------------------------------------
| Auth (login/register/logout)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
