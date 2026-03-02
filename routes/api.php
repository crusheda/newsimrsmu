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
use \App\Http\Controllers\v4\Administrasi\Berkas\LaporanBulananController;
use \App\Http\Controllers\v4\Administrasi\Berkas\RapatController;
use \App\Http\Controllers\v4\Administrasi\Berkas\RKAController;
use \App\Http\Controllers\v4\Administrasi\Berkas\RegulasiController;

Route::prefix('v4')->middleware(['web','auth'])->group(function () { // SIMRSMU v.4

    // PERBAIKAN TIKET IT
    Route::post('perbaikanit/tiket/kirim', [HelpdeskController::class, 'kirimTiket']);

    // WHATSAPP API
    // Route::post('whatsapp/send-message', [HelpdeskController::class, 'store']);
    // Route::get('whatsapp/send-message/{id}', [HelpdeskController::class, 'kirim']);

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

    // ADMINISTRASI
        // BERKAS
            // LAPORAN RUTIN
            Route::get('administrasi/berkas/laporan/preview/{id}', [LaporanBulananController::class, 'previewLaporan']);
            Route::get('administrasi/berkas/laporan/catatan/{id}', [LaporanBulananController::class, 'showCatatan']);
            Route::post('administrasi/berkas/laporan/catatan/store', [LaporanBulananController::class, 'storeCatatan']);
            Route::delete('administrasi/berkas/laporan/catatan/{id}/delete', [LaporanBulananController::class, 'deleteCatatan']);
            Route::get('administrasi/berkas/laporan/table/verif/{id}', [LaporanBulananController::class, 'verif']);
            Route::get('administrasi/berkas/laporan/table/verif/{id}/batal', [LaporanBulananController::class, 'batalVerif']);
            Route::get('administrasi/berkas/laporan/table/verif/{id}/user/{user}', [LaporanBulananController::class, 'verifUser']);
            Route::get('administrasi/berkas/laporan/formverif/{id}', [LaporanBulananController::class, 'formVerif']);
            Route::get('administrasi/berkas/laporan/formupload/{id}', [LaporanBulananController::class, 'formUpload']);
            Route::get('administrasi/berkas/laporan/table/{id}/verif', [LaporanBulananController::class, 'tableVerif']);
            Route::get('administrasi/berkas/laporan/table/{id}', [LaporanBulananController::class, 'table']);
            Route::get('administrasi/berkas/laporan/getubah/{id}',[LaporanBulananController::class, 'getUbah']);
            Route::get('administrasi/berkas/laporan/hapus/{id}',[LaporanBulananController::class, 'hapus']);
            Route::post('administrasi/berkas/laporan/ubah/{id}',[LaporanBulananController::class, 'ubah']);

            // RAPAT
            Route::get('administrasi/berkas/rapat/data', [RapatController::class, 'getRapat']);
            Route::get('administrasi/berkas/rapat/dataAll', [RapatController::class, 'getRapatAll']);
            Route::post('administrasi/berkas/rapat/simpan', [RapatController::class, 'simpanRapat']);
            Route::get('administrasi/berkas/rapat/data/{id}', [RapatController::class, 'detailRapat']);
            Route::post('administrasi/berkas/rapat/data/{id}/ubah', [RapatController::class, 'ubah']);
            Route::get('administrasi/berkas/rapat/data/{id}/hapus', [RapatController::class, 'hapusRapat']);
            Route::get('administrasi/berkas/rapat/data/{id}/download', [RapatController::class, 'getFile']);
            Route::get('administrasi/berkas/rapat/data/{id}/zip', [RapatController::class, 'showAll']);

            // RKA
            Route::get('administrasi/berkas/rka/table', [RKAController::class, 'table']);
            Route::delete('administrasi/berkas/rka/hapus/{id}', [RKAController::class, 'hapus']);

            // REGULASI
            Route::get('administrasi/berkas/regulasi/baca/{id}', [RegulasiController::class, 'baca']);
            Route::get('administrasi/berkas/regulasi/cetak/{id}', [RegulasiController::class, 'cetak']);
            Route::get('administrasi/berkas/regulasi/showtambah', [RegulasiController::class, 'showTambah']);
            Route::post('administrasi/berkas/regulasi/tambah', [RegulasiController::class, 'tambah']);
            Route::get('administrasi/berkas/regulasi/showubah/{id}', [RegulasiController::class, 'showUbah']);
            Route::post('administrasi/berkas/regulasi/ubah', [RegulasiController::class, 'ubah']);
            Route::delete('administrasi/berkas/regulasi/{id}', [RegulasiController::class, 'hapus']);
            Route::post('administrasi/berkas/regulasi/filter', [RegulasiController::class, 'cariRegulasi']);
            Route::get('administrasi/berkas/regulasi/totalregulasi', [RegulasiController::class, 'apiTotalRegulasi']);
});

// WHATSAPP API WEBHOOK
Route::get('perbaikanit/tiket/webhook', [HelpdeskController::class, 'verify']);
Route::post('perbaikanit/tiket/webhook', [HelpdeskController::class, 'handle']);

// WHATSAPP API BAILEYS
// Route::post('perbaikanit/tiket/kirimgroup', [HelpdeskController::class, 'kirimTiketGroup']);
Route::post('perbaikanit/tiket/callback', [HelpdeskController::class, 'callback']);
Route::post('perbaikanit/tiket/{id}/terima', [HelpdeskController::class, 'kirimTerimaTiket']);
Route::post('perbaikanit/tiket/{id}/kerjakan', [HelpdeskController::class, 'kirimKerjakanTiket']);
Route::post('perbaikanit/tiket/{id}/selesai', [HelpdeskController::class, 'kirimSelesaiTiket']);
Route::post('perbaikanit/tiket/{id}/tolak', [HelpdeskController::class, 'kirimTolakTiket']);
