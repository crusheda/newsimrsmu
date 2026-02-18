<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.v4.index');
})->name('v4.portal');

// AUTHENTICATION ROUTES
use App\Http\Controllers\Auth\v4\AuthController;
use \App\Http\Controllers\Auth\v4\LoginController;

Route::group(['prefix' => 'v4', 'as' => ''], function () {
    Route::get('login', [LoginController::class, 'index'])->name('v4.login');
    Route::post('login', [AuthController::class, 'login'])->name('v4.login.process');
});

// PROTECTED ROUTES
use \App\Http\Controllers\v4\Dashboard\DashboardController;
use \App\Http\Controllers\v4\Setting\ProfilController;
use \App\Http\Controllers\v4\Akun\AksesJabatanController;
use \App\Http\Controllers\v4\Akun\StrukturOrganisasiController;
use \App\Http\Controllers\v4\Akun\AkunPenggunaController;

Route::group(['middleware' => ['auth'], 'prefix' => 'v4', 'as' => ''], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('v4.dashboard');
    Route::get('profil', [ProfilController::class, 'index'])->name('v4.profil');

    // MANAJEMEN AKUN
        // AKSES & JABATAN
        Route::get('akun/aksesjabatan', [AksesJabatanController::class, 'index'])->name('v4.akun.aksesjabatan');

        // STRUKTUR ORGANISASI
        Route::get('akun/strukturorganisasi', [StrukturOrganisasiController::class, 'index'])->name('v4.akun.strukturorganisasi');
        Route::get('akun/strukturorganisasi/tambah', [StrukturOrganisasiController::class, 'create'])->name('v4.akun.strukturorganisasi.tambah');
        Route::post('akun/strukturorganisasi', [StrukturOrganisasiController::class, 'store'])->name('v4.akun.strukturorganisasi.simpan');
        Route::get('akun/strukturorganisasi/{id}/ubah', [StrukturOrganisasiController::class, 'edit'])->name('v4.akun.strukturorganisasi.ubah');
        Route::put('akun/strukturorganisasi/{id}', [StrukturOrganisasiController::class, 'update'])->name('v4.akun.strukturorganisasi.update');

        // AKUN PENGGUNA
        Route::resource('akun/pengguna', AkunPenggunaController::class)->names('v4.akun.akunpengguna');

    // LOGOUT ROUTE
    Route::post('logout', [AuthController::class, 'logout'])->name('v4.logout');
});
