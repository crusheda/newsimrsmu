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
use \App\Http\Controllers\v4\IT\TiketController;
use \App\Http\Controllers\v4\Akun\AksesJabatanController;
use \App\Http\Controllers\v4\Akun\StrukturOrganisasiController;
use \App\Http\Controllers\v4\Akun\AkunPenggunaController;
use \App\Http\Controllers\v4\Administrasi\Berkas\LaporanBulananController;
use \App\Http\Controllers\v4\Administrasi\Berkas\RapatController;
use \App\Http\Controllers\v4\Administrasi\Berkas\RKAController;
use \App\Http\Controllers\v4\Administrasi\Berkas\RegulasiController;

Route::group(['middleware' => ['auth'], 'prefix' => 'v4', 'as' => ''], function () { // SIMRSMU v.4
    Route::get('dashboard', [DashboardController::class, 'index'])->name('v4.dashboard');
    Route::get('profil', [ProfilController::class, 'index'])->name('v4.profil');
    Route::get('tiket/it', [TiketController::class, 'index'])->name('v4.tiket.it');

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

    // ADMINISTRASI
        // BERKAS
            // LAPORAN RUTIN
            Route::get('administrasi/berkas/laporan', [LaporanBulananController::class, 'index'])->name('v4.administrasi.berkas.laporan');
            Route::get('administrasi/berkas/laporan/verif', [LaporanBulananController::class, 'showVerif'])->name('v4.administrasi.berkas.laporan.verif');
            Route::get('administrasi/berkas/laporan/{id}', [LaporanBulananController::class, 'show'])->name('v4.administrasi.berkas.laporan.show');
            Route::post('administrasi/berkas/laporan/store', [LaporanBulananController::class, 'store'])->name('v4.administrasi.berkas.laporan.store');

            // RAPAT
            Route::get('administrasi/berkas/rapat', [RapatController::class, 'index'])->name('v4.administrasi.berkas.rapat');
            // Route::get('administrasi/berkas/rapat/{id}', [RapatController::class, 'show'])->name('v4.administrasi.berkas.rapat.show');
            Route::post('administrasi/berkas/rapat/store', [RapatController::class, 'store'])->name('v4.administrasi.berkas.rapat.store');
            // Route::delete('administrasi/berkas/rapat/{id}/hapus', [RapatController::class, 'destroy'])->name('v4.administrasi.berkas.rapat.destroy');

            // RKA
            Route::get('administrasi/berkas/rka', [RKAController::class, 'index'])->name('v4.administrasi.berkas.rka');
            Route::get('administrasi/berkas/rka/{id}', [RKAController::class, 'show'])->name('v4.administrasi.berkas.rka.show');
            Route::post('administrasi/berkas/rka/store', [RKAController::class, 'store'])->name('v4.administrasi.berkas.rka.store');
            Route::post('administrasi/berkas/rka/fileupload', [RKAController::class, 'fileupload'])->name('v4.administrasi.berkas.rka.fileupload');

            // REGULASI
            Route::get('administrasi/berkas/regulasi', [RegulasiController::class, 'index'])->name('v4.administrasi.berkas.regulasi');
            Route::get('administrasi/berkas/regulasi/{id}/download', [RegulasiController::class, 'download'])->name('v4.administrasi.berkas.regulasi.download');

    // LOGOUT ROUTE
    Route::post('logout', [AuthController::class, 'logout'])->name('v4.logout');
});
