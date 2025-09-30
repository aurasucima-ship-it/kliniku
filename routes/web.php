<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes untuk login, logout, home, admin, dokter, pasien, dan profile.
|
*/

// =========================
// ROOT → REDIRECT KE LOGIN
// =========================
Route::get('/', fn() => redirect()->route('login'));

// =========================
// LOGIN & LOGOUT
// =========================
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// =========================
// ROUTES YANG MEMBUTUHKAN LOGIN
// =========================
Route::middleware('auth')->group(function () {

    // =========================
    // HOME → REDIRECT BERDASARKAN ROLE
    // =========================
    Route::get('/home', function () {
        $user = auth()->user();

        return match ($user->role) {
            'admin' => view('home.admin', [
                'totalAdmin'  => User::where('role', 'admin')->count(),
                'totalDokter' => Dokter::count(),
                'totalPasien' => Pasien::count(),
            ]),
            'dokter' => view('home.dokter'),
            'pasien'  => view('home.pasien'),
            default   => abort(403),
        };
    })->name('home');

    // =========================
    // PROFILE ROUTES
    // =========================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // =========================
    // ADMIN ROUTES
    // =========================
    Route::prefix('admin')->middleware('can:isAdmin')->group(function () {

        // ---- DOKTER ----
        Route::prefix('dokter')->group(function () {
            Route::get('/', 'Admin\DokterController@index')->name('admin.dokter.index');
            Route::get('/create', 'Admin\DokterController@create')->name('admin.dokter.create');
            Route::post('/', 'Admin\DokterController@store')->name('admin.dokter.store');
            Route::get('/{id}', 'Admin\DokterController@show')->name('admin.dokter.show');
            Route::get('/{id}/edit', 'Admin\DokterController@edit')->name('admin.dokter.edit');
            Route::put('/{id}', 'Admin\DokterController@update')->name('admin.dokter.update');
            Route::delete('/{id}', 'Admin\DokterController@destroy')->name('admin.dokter.destroy');
        });

        // ---- PASIEN ----
        Route::prefix('pasien')->group(function () {
            Route::get('/', 'Admin\PasienController@index')->name('admin.pasien.index');
            Route::get('/create', 'Admin\PasienController@create')->name('admin.pasien.create');
            Route::post('/', 'Admin\PasienController@store')->name('admin.pasien.store');
            Route::get('/{id}', 'Admin\PasienController@show')->name('admin.pasien.show');
            Route::get('/{id}/edit', 'Admin\PasienController@edit')->name('admin.pasien.edit');
            Route::put('/{id}', 'Admin\PasienController@update')->name('admin.pasien.update');
            Route::delete('/{id}', 'Admin\PasienController@destroy')->name('admin.pasien.destroy');
        });

        // ---- REKAM MEDIS ----
        Route::prefix('rekam_medis')->group(function () {
            Route::get('/', 'Admin\RekamMedisController@index')->name('admin.rekam_medis.index');
            Route::get('/create', 'Admin\RekamMedisController@create')->name('admin.rekam_medis.create');
            Route::post('/', 'Admin\RekamMedisController@store')->name('admin.rekam_medis.store');
            Route::get('/{id}', 'Admin\RekamMedisController@show')->name('admin.rekam_medis.show');
            Route::get('/{id}/edit', 'Admin\RekamMedisController@edit')->name('admin.rekam_medis.edit');
            Route::put('/{id}', 'Admin\RekamMedisController@update')->name('admin.rekam_medis.update');
            Route::delete('/{id}', 'Admin\RekamMedisController@destroy')->name('admin.rekam_medis.destroy');
        });

        // ---- PEMBAYARAN ----
        Route::prefix('pembayaran')->group(function () {
            Route::get('/', 'Admin\PembayaranController@index')->name('admin.pembayaran.index');
            Route::get('/create', 'Admin\PembayaranController@create')->name('admin.pembayaran.create');
            Route::post('/', 'Admin\PembayaranController@store')->name('admin.pembayaran.store');
            Route::get('/{id}', 'Admin\PembayaranController@show')->name('admin.pembayaran.show');
            Route::get('/{id}/edit', 'Admin\PembayaranController@edit')->name('admin.pembayaran.edit');
            Route::put('/{id}', 'Admin\PembayaranController@update')->name('admin.pembayaran.update');
            Route::delete('/{id}', 'Admin\PembayaranController@destroy')->name('admin.pembayaran.destroy');
        });
    });

    // =========================
    // DOKTER ROUTES
    // =========================
    Route::prefix('dokter')->middleware('can:isDokter')->group(function () {

        // ---- PASIEN ----
        Route::prefix('pasien')->group(function () {
            Route::get('/', 'Dokter\PasienController@index')->name('dokter.pasien.index');
            Route::get('/create', 'Dokter\PasienController@create')->name('dokter.pasien.create');
            Route::post('/', 'Dokter\PasienController@store')->name('dokter.pasien.store');
            Route::get('/{id}', 'Dokter\PasienController@show')->name('dokter.pasien.show');
            Route::get('/{id}/edit', 'Dokter\PasienController@edit')->name('dokter.pasien.edit');
            Route::put('/{id}', 'Dokter\PasienController@update')->name('dokter.pasien.update');
            Route::delete('/{id}', 'Dokter\PasienController@destroy')->name('dokter.pasien.destroy');
        });

        // ---- REKAM MEDIS ----
        Route::prefix('rekam_medis')->group(function () {
            Route::get('/', 'Dokter\RekamMedisController@index')->name('dokter.rekam_medis.index');
            Route::get('/create', 'Dokter\RekamMedisController@create')->name('dokter.rekam_medis.create');
            Route::post('/', 'Dokter\RekamMedisController@store')->name('dokter.rekam_medis.store');
            Route::get('/{id}', 'Dokter\RekamMedisController@show')->name('dokter.rekam_medis.show');
            Route::get('/{id}/edit', 'Dokter\RekamMedisController@edit')->name('dokter.rekam_medis.edit');
            Route::put('/{id}', 'Dokter\RekamMedisController@update')->name('dokter.rekam_medis.update');
            Route::delete('/{id}', 'Dokter\RekamMedisController@destroy')->name('dokter.rekam_medis.destroy');
        });

        // ---- PEMBAYARAN ----
        Route::prefix('pembayaran')->group(function () {
            Route::get('/', 'Dokter\PembayaranController@index')->name('dokter.pembayaran.index');
            Route::get('/create', 'Dokter\PembayaranController@create')->name('dokter.pembayaran.create');
            Route::post('/', 'Dokter\PembayaranController@store')->name('dokter.pembayaran.store');
            Route::get('/{id}/edit', 'Dokter\PembayaranController@edit')->name('dokter.pembayaran.edit');
            Route::put('/{id}', 'Dokter\PembayaranController@update')->name('dokter.pembayaran.update');
            Route::delete('/{id}', 'Dokter\PembayaranController@destroy')->name('dokter.pembayaran.destroy');
        });
    });

    // =========================
    // PASIEN ROUTES
    // =========================
    Route::prefix('pasien')->middleware('can:isPasien')->group(function () {

        // ---- PENDAFTARAN ----
        Route::prefix('pendaftaran')->group(function () {
            Route::get('/', 'Pasien\PendaftaranController@index')->name('pasien.pendaftaran.index');
            Route::get('/create', 'Pasien\PendaftaranController@create')->name('pasien.pendaftaran.create');
            Route::post('/', 'Pasien\PendaftaranController@store')->name('pasien.pendaftaran.store');
        });

        // ---- REKAM MEDIS (hanya lihat) ----
        Route::prefix('rekam_medis')->group(function () {
            Route::get('/', 'Pasien\RekamMedisController@index')->name('pasien.rekam_medis.index');
            Route::get('/{id}', 'Pasien\RekamMedisController@show')->name('pasien.rekam_medis.show');
        });

        // ---- PEMBAYARAN ----
        Route::prefix('pembayaran')->group(function () {
            Route::get('/', 'Pasien\PembayaranController@index')->name('pasien.pembayaran.index');
            Route::get('/{id}', 'Pasien\PembayaranController@show')->name('pasien.pembayaran.show');
        });
    });

});
