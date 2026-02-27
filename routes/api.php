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
use \App\Http\Controllers\v4\IT\TiketController;
use \App\Http\Controllers\Whatsapp\HelpdeskController;
use \App\Http\Controllers\v4\Akun\AksesJabatanController;
use \App\Http\Controllers\v4\Akun\StrukturOrganisasiController;
use \App\Http\Controllers\v4\Akun\AkunPenggunaController;

Route::prefix('v4')->middleware(['web','auth'])->group(function () { // SIMRSMU v.4
    // PROFIL AKUN
    Route::get('provinsi/{id}', [ProfilController::class, 'apiProvinsi']);
    Route::get('kota/{id}', [ProfilController::class, 'apiKota']);
    Route::get('kecamatan/{id}', [ProfilController::class, 'apiKecamatan']);

    Route::get('profil/show', [ProfilController::class, 'show']);
    Route::post('profil/ubah', [ProfilController::class, 'ubahProfil']);
    Route::post('profil/foto/ubah', [ProfilController::class, 'ubahFotoProfil']);
    Route::delete('profil/foto/hapus', [ProfilController::class, 'hapusFotoProfil']);
    Route::post('profil/password',[ProfilController::class,'ubahPassword']);

    Route::get('profil/dokumen/table/{id}', [ProfilController::class, 'tableDokumen']);
    Route::post('profil/dokumen/add', [ProfilController::class, 'tambahDokumen']);
    Route::post('profil/dokumen/ubah/{id}/proses', [ProfilController::class, 'ubahDokumen']);
    Route::delete('profil/dokumen/hapus/{id}/proses', [ProfilController::class, 'hapusDokumen']);
    Route::get('profil/dokumen/ubah/{id}', [ProfilController::class, 'showUbahDokumen']);
    Route::get('profil/spkrkk/table/{id}', [ProfilController::class, 'tableSpkrkk']);

    // TIKET IT
    Route::get('tiket/it/table', [TiketController::class, 'table']);

    // AKSES JABATAN
    Route::get('aksesjabatan/data', [AksesJabatanController::class, 'table']);
    Route::post('aksesjabatan/store', [AksesJabatanController::class, 'storeAksesJabatan']);
    Route::get('aksesjabatan/hapus/{id}', [AksesJabatanController::class, 'hapusAksesJabatan']);
        // AKSES
        Route::get('aksesjabatan/{id}/akses', [AksesJabatanController::class, 'getAkses']);
        Route::get('aksesjabatan/akses/data', [AksesJabatanController::class, 'tableAkses']);
        Route::post('aksesjabatan/akses/store', [AksesJabatanController::class, 'storeAkses']);
        Route::get('aksesjabatan/akses/hapus/{id}', [AksesJabatanController::class, 'hapusAkses']);
        // JABATAN
        Route::get('aksesjabatan/jabatan/data', [AksesJabatanController::class, 'tableJabatan']);
        Route::post('aksesjabatan/jabatan/store', [AksesJabatanController::class, 'storeJabatan']);
        Route::get('aksesjabatan/jabatan/hapus/{id}', [AksesJabatanController::class, 'hapusJabatan']);

    // AKUN PENGGUNA
    Route::get('akun/pengguna', [AkunPenggunaController::class, 'get']);
    Route::get('akun/pengguna/{id}', [AkunPenggunaController::class, 'show']);
    Route::post('akun/pengguna/tambah', [AkunPenggunaController::class, 'store']);
    Route::put('akun/pengguna/ubah/{id}', [AkunPenggunaController::class, 'update']);
    Route::get('akun/pengguna/verif/{id}', [AkunPenggunaController::class, 'verifName']);
    Route::delete('akun/pengguna/hapus/{id}', [AkunPenggunaController::class, 'destroy']);

    // SDI
        // DAFTAR PEGAWAI
        // Route::get('sdi/pegawai/table', [PegawaiController::class, 'table'])->name('tablePegawai');
        // Route::get('sdi/pegawai/tableall', [PegawaiController::class, 'tableAll'])->name('tablePegawaiAll');
        // Route::get('sdi/pegawai/setaktif/{id}', [PegawaiController::class, 'setAktif'])->name('setaktifPegawai');
        // // GRAFIK INTERAKTIF
        // Route::get('sdi/pegawai/grafik/1', [PegawaiController::class, 'grafik1'])->name('apiGrafikSDI1'); // Jenis Pegawai
        // Route::get('sdi/pegawai/grafik/2', [PegawaiController::class, 'grafik2'])->name('apiGrafikSDI2'); // Jenis Kelamin
        // Route::get('sdi/pegawai/grafik/3', [PegawaiController::class, 'grafik3'])->name('apiGrafikSDI3'); // Pendidikan
        // Route::get('sdi/pegawai/grafik/4', [PegawaiController::class, 'grafik4'])->name('apiGrafikSDI4'); // Profesi
        // Route::get('sdi/pegawai/grafik/5', [PegawaiController::class, 'grafik5'])->name('apiGrafikSDI5'); // Status Pegawai
        // Route::get('sdi/pegawai/grafik/6', [PegawaiController::class, 'grafik6'])->name('apiGrafikSDI6'); // Status Perkawinan

    // WHATSAPP API
    // Route::post('whatsapp/send-message', [HelpdeskController::class, 'store']);
    // Route::get('whatsapp/send-message/{id}', [HelpdeskController::class, 'kirim']);

    Route::post('perbaikanit/tiket/kirim', [HelpdeskController::class, 'kirimTiket']);
});

Route::get('perbaikanit/tiket/webhook', [HelpdeskController::class, 'verify']);
Route::post('perbaikanit/tiket/webhook', [HelpdeskController::class, 'handle']);

// WHATSAPP API BAILEYS
// Route::post('perbaikanit/tiket/kirimgroup', [HelpdeskController::class, 'kirimTiketGroup']);
Route::post('perbaikanit/tiket/callback', [HelpdeskController::class, 'callback']);
Route::post('perbaikanit/tiket/{id}/terima', [HelpdeskController::class, 'kirimTerimaTiket']);
Route::post('perbaikanit/tiket/{id}/kerjakan', [HelpdeskController::class, 'kirimKerjakanTiket']);
Route::post('perbaikanit/tiket/{id}/selesai', [HelpdeskController::class, 'kirimSelesaiTiket']);
Route::post('perbaikanit/tiket/{id}/tolak', [HelpdeskController::class, 'kirimTolakTiket']);
