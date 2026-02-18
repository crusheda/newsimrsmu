<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use \App\Http\Controllers\v4\Setting\ProfilController;
use \App\Http\Controllers\Whatsapp\HelpdeskController;
use \App\Http\Controllers\v4\Akun\AksesJabatanController;
use \App\Http\Controllers\v4\Akun\StrukturOrganisasiController;
use \App\Http\Controllers\v4\Akun\AkunPenggunaController;

Route::middleware(['web','auth'])->group(function () {
    // PROFIL AKUN
    Route::get('v4/provinsi/{id}', [ProfilController::class, 'apiProvinsi']);
    Route::get('v4/kota/{id}', [ProfilController::class, 'apiKota']);
    Route::get('v4/kecamatan/{id}', [ProfilController::class, 'apiKecamatan']);

    Route::get('v4/profil/show', [ProfilController::class, 'show']);
    Route::post('v4/profil/ubah', [ProfilController::class, 'ubahProfil']);
    Route::post('v4/profil/foto/ubah', [ProfilController::class, 'ubahFotoProfil']);
    Route::delete('v4/profil/foto/hapus', [ProfilController::class, 'hapusFotoProfil']);
    Route::post('v4/profil/password',[ProfilController::class,'ubahPassword']);

    Route::get('v4/profil/dokumen/table/{id}', [ProfilController::class, 'tableDokumen']);
    Route::post('v4/profil/dokumen/add', [ProfilController::class, 'tambahDokumen']);
    Route::post('v4/profil/dokumen/ubah/{id}/proses', [ProfilController::class, 'ubahDokumen']);
    Route::delete('v4/profil/dokumen/hapus/{id}/proses', [ProfilController::class, 'hapusDokumen']);
    Route::get('v4/profil/dokumen/ubah/{id}', [ProfilController::class, 'showUbahDokumen']);
    Route::get('v4/profil/spkrkk/table/{id}', [ProfilController::class, 'tableSpkrkk']);

    // AKSES JABATAN
    Route::get('v4/aksesjabatan/data', [AksesJabatanController::class, 'table']);
    Route::post('v4/aksesjabatan/store', [AksesJabatanController::class, 'storeAksesJabatan']);
    Route::get('v4/aksesjabatan/hapus/{id}', [AksesJabatanController::class, 'hapusAksesJabatan']);
        // AKSES
        Route::get('v4/aksesjabatan/{id}/akses', [AksesJabatanController::class, 'getAkses']);
        Route::get('v4/aksesjabatan/akses/data', [AksesJabatanController::class, 'tableAkses']);
        Route::post('v4/aksesjabatan/akses/store', [AksesJabatanController::class, 'storeAkses']);
        Route::get('v4/aksesjabatan/akses/hapus/{id}', [AksesJabatanController::class, 'hapusAkses']);
        // JABATAN
        Route::get('v4/aksesjabatan/jabatan/data', [AksesJabatanController::class, 'tableJabatan']);
        Route::post('v4/aksesjabatan/jabatan/store', [AksesJabatanController::class, 'storeJabatan']);
        Route::get('v4/aksesjabatan/jabatan/hapus/{id}', [AksesJabatanController::class, 'hapusJabatan']);

    // AKUN PENGGUNA
    Route::get('v4/akun/pengguna', [AkunPenggunaController::class, 'get']);
    Route::get('v4/akun/pengguna/verif/{id}', [AkunPenggunaController::class, 'verifName']);
    Route::get('v4/akun/pengguna/hapus/{id}', [AkunPenggunaController::class, 'hapus']);

    // SDI
        // DAFTAR PEGAWAI
        // Route::get('v4/sdi/pegawai/table', [PegawaiController::class, 'table'])->name('tablePegawai');
        // Route::get('v4/sdi/pegawai/tableall', [PegawaiController::class, 'tableAll'])->name('tablePegawaiAll');
        // Route::get('v4/sdi/pegawai/setaktif/{id}', [PegawaiController::class, 'setAktif'])->name('setaktifPegawai');
        // // GRAFIK INTERAKTIF
        // Route::get('v4/sdi/pegawai/grafik/1', [PegawaiController::class, 'grafik1'])->name('apiGrafikSDI1'); // Jenis Pegawai
        // Route::get('v4/sdi/pegawai/grafik/2', [PegawaiController::class, 'grafik2'])->name('apiGrafikSDI2'); // Jenis Kelamin
        // Route::get('v4/sdi/pegawai/grafik/3', [PegawaiController::class, 'grafik3'])->name('apiGrafikSDI3'); // Pendidikan
        // Route::get('v4/sdi/pegawai/grafik/4', [PegawaiController::class, 'grafik4'])->name('apiGrafikSDI4'); // Profesi
        // Route::get('v4/sdi/pegawai/grafik/5', [PegawaiController::class, 'grafik5'])->name('apiGrafikSDI5'); // Status Pegawai
        // Route::get('v4/sdi/pegawai/grafik/6', [PegawaiController::class, 'grafik6'])->name('apiGrafikSDI6'); // Status Perkawinan
});

// WHATSAPP API BAILEYS
Route::post('v4/perbaikanit/tiket/kirimgroup', [HelpdeskController::class, 'kirimTiketGroup']);
Route::post('v4/perbaikanit/tiket/callback', [HelpdeskController::class, 'callback']);
Route::post('v4/perbaikanit/tiket/{id}/terima', [HelpdeskController::class, 'kirimTerimaTiket']);
Route::post('v4/perbaikanit/tiket/{id}/kerjakan', [HelpdeskController::class, 'kirimKerjakanTiket']);
Route::post('v4/perbaikanit/tiket/{id}/selesai', [HelpdeskController::class, 'kirimSelesaiTiket']);
Route::post('v4/perbaikanit/tiket/{id}/tolak', [HelpdeskController::class, 'kirimTolakTiket']);
