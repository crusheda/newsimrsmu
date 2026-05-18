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
use \App\Http\Controllers\v4\Administrasi\Berkas\Surat\DisposisiController;
use \App\Http\Controllers\v4\Administrasi\Berkas\Surat\SuratMasukController;
use \App\Http\Controllers\v4\Administrasi\Berkas\Surat\SuratKeluarController;
use \App\Http\Controllers\v4\Administrasi\Pengadaan\PengadaanController;
use \App\Http\Controllers\v4\Administrasi\Pengadaan\PengadaanBarangController;
use \App\Http\Controllers\v4\Administrasi\Pengadaan\PengadaanRekapController;
use \App\Http\Controllers\v4\Administrasi\ERuang\ERuangController;
use \App\Http\Controllers\v4\SDI\ProfilPegawaiController;
use \App\Http\Controllers\v4\SDI\DetailProfilPegawaiController;
use \App\Http\Controllers\v4\SDI\JadwalDinasController;
use \App\Http\Controllers\v4\SDI\PDController;
use \App\Http\Controllers\v4\SDI\SurtugController;
use \App\Http\Controllers\v4\SDI\Absensi\AbsensiController;
use \App\Http\Controllers\v4\SDI\Absensi\AbsensiDashboardController;
use \App\Http\Controllers\v4\SDI\Absensi\AbsensiDeviceController;
use \App\Http\Controllers\v4\SDI\Rekrutmen\PengumumanController as RekrutmenPengumumanController;
use \App\Http\Controllers\v4\SDI\Rekrutmen\RegistrasiController as RekrutmenRegistrasiController;
use \App\Http\Controllers\v4\SDI\Pengajuan\SurketController;
use \App\Http\Controllers\v4\SDI\Pengajuan\IDCardController;
use \App\Http\Controllers\v4\Pelayanan\Kebidanan\SKLController;
use App\Http\Controllers\v4\AI\KlaimBpjsController;

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

            // SURAT
                // DISPOSISI
                    Route::get('administrasi/berkas/disposisi', [DisposisiController::class, 'index'])->name('v4.administrasi.berkas.disposisi');
                    Route::get('administrasi/berkas/disposisi/{id}', [DisposisiController::class, 'show'])->name('v4.administrasi.berkas.disposisi.show');
                // SURAT MASUK
                    Route::get('administrasi/berkas/suratmasuk', [SuratMasukController::class, 'index'])->name('v4.administrasi.berkas.suratmasuk');
                    Route::get('administrasi/berkas/suratmasuk/{id}/download', [SuratMasukController::class, 'download'])->name('v4.administrasi.berkas.suratmasuk.download');
                    Route::post('administrasi/berkas/suratmasuk', [SuratMasukController::class, 'store'])->name('v4.administrasi.berkas.suratmasuk.store');
                // SURAT KELUAR
                    Route::get('administrasi/berkas/suratkeluar', [SuratKeluarController::class, 'index'])->name('v4.administrasi.berkas.suratkeluar');
                    Route::get('administrasi/berkas/suratkeluar/{id}/download', [SuratKeluarController::class, 'download'])->name('v4.administrasi.berkas.suratkeluar.download');
                    Route::post('administrasi/berkas/suratkeluar', [SuratKeluarController::class, 'store'])->name('v4.administrasi.berkas.suratkeluar.store');

        // PENGADAAN
        Route::get('administrasi/pengadaan', [PengadaanController::class, 'index'])->name('v4.administrasi.pengadaan');
            // REKAP
                Route::post('administrasi/pengadaan/rekap', [PengadaanRekapController::class, 'index'])->name('v4.administrasi.pengadaan.rekap');
            // BARANG
                Route::get('administrasi/pengadaan/barang', [PengadaanBarangController::class, 'index'])->name('v4.administrasi.pengadaan.barang');
                Route::get('administrasi/pengadaan/barang/download/{id}', [PengadaanBarangController::class, 'download'])->name('v4.administrasi.pengadaan.barang.download');

        // E-RUANG
            Route::get('administrasi/eruang', [ERuangController::class, 'index'])->name('v4.administrasi.eruang');
            Route::get('administrasi/eruang/ruangan', [ERuangController::class, 'indexRuangan'])->name('v4.administrasi.eruang.ruangan');

    // SUMBER DAYA INSANI (SDI)
        // PROFIL PEGAWAI
        Route::get('profilkaryawan', [ProfilPegawaiController::class, 'index'])->name('v4.sdi.profilpegawai');
        Route::get('profilkaryawan/{id}', [ProfilPegawaiController::class, 'show'])->name('v4.sdi.profilpegawai.show');
        Route::get('profilkaryawan/detail/{id}', [ProfilController::class, 'indexKepegawaian'])->name('v4.sdi.profilpegawai.kepegawaian');
        Route::delete('profilkaryawan/{id}/nonaktif', [ProfilPegawaiController::class, 'destroy'])->name('v4.sdi.profilpegawai.hapus');
        Route::get('profilkaryawan/dokumen/download/{id}', [DetailProfilPegawaiController::class,'downloadDokumen'])->name('v4.sdi.profilpegawai.detail.downloadDokumen');
        Route::get('profilkaryawan/spkrkk/download/{id}', [DetailProfilPegawaiController::class,'downloadSpkRkk'])->name('v4.sdi.profilpegawai.detail.downloadSpkRkk');
        Route::resource('profilkaryawan', '\App\Http\Controllers\Kepegawaian\ProfilKaryawanController');

        // JADWAL DINAS
        Route::get('sdi/jadwaldinas', [JadwalDinasController::class, 'index'])->name('v4.sdi.jadwaldinas');
        Route::get('sdi/jadwaldinas/{id}/cetak',[JadwalDinasController::class, 'cetak'])->name('v4.sdi.jadwaldinas.cetak');
        Route::get('sdi/jadwaldinas/tambah/{id}', [JadwalDinasController::class, 'formTambah'])->name('v4.sdi.jadwaldinas.formTambah');
        Route::get('sdi/jadwaldinas/ubah/{id}', [JadwalDinasController::class, 'formUbah'])->name('v4.sdi.jadwaldinas.formUbah');
        Route::post('sdi/jadwaldinas/tambah/proses', [JadwalDinasController::class, 'prosesTambah'])->name('v4.sdi.jadwaldinas.prosesTambah');
        Route::post('sdi/jadwaldinas/ubah/proses', [JadwalDinasController::class, 'prosesUbah'])->name('v4.sdi.jadwaldinas.prosesUbah');
            // VERIFIKASI JADWAL BAWAHAN
                Route::get('sdi/jadwaldinas/bawahan', [JadwalDinasController::class, 'indexBawahan'])->name('v4.sdi.jadwaldinas.bawahan');
            // REF SHIFT
                Route::get('sdi/jadwaldinas/shift', [JadwalDinasController::class, 'indexShift'])->name('v4.sdi.jadwaldinas.ref.shift');
            // REF STAFF
                Route::get('sdi/jadwaldinas/staf', [JadwalDinasController::class, 'indexStaf'])->name('v4.sdi.jadwaldinas.ref.staf');
            // REF HARI LIBUR NASIONAL
                Route::get('sdi/jadwaldinas/ln', [JadwalDinasController::class, 'indexLN'])->name('v4.sdi.jadwaldinas.ref.ln');

        // ABSENSI
        Route::get('sdi/absensi', [AbsensiController::class, 'index'])->name('v4.sdi.absensi.rekapitulasi');
        Route::get('sdi/absensi/dashboard', [AbsensiDashboardController::class, 'index'])->name('v4.sdi.absensi.dashboard');
        Route::get('sdi/absensi/device', [AbsensiDeviceController::class, 'index'])->name('v4.sdi.absensi.device');

        // REKRUTMEN
            // PENGUMUMAN
            Route::get('sdi/rekrutmen/pengumuman', [RekrutmenPengumumanController::class, 'index'])->name('v4.sdi.rekrutmen.pengumuman');
            // REGISTRASI PESERTA
            Route::get('rekrutmen/registrasi', [RekrutmenRegistrasiController::class, 'index'])->name('v4.sdi.rekrutmen.registrasi');

        // PENGAJUAN
            // SURAT KETERANGAN (SURKET)
            Route::get('sdi/pengajuan/surket', [SurketController::class, 'index'])->name('v4.sdi.pengajuan.surket');
            Route::get('sdi/pengajuan/surket/{id}/download', [SurketController::class, 'download'])->name('v4.sdi.pengajuan.surket.download');
            Route::get('sdi/pengajuan/surket/{id}/generate', [SurketController::class, 'generateFile'])->name('v4.sdi.pengajuan.surket.generate');

            // IDCARD
            Route::get('sdi/pengajuan/idcard', [IDCardController::class, 'index'])->name('v4.sdi.pengajuan.idcard');

        // PERJALANAN DINAS
        Route::get('sdi/pd', [PDController::class, 'index'])->name('v4.sdi.pd');
        Route::get('sdi/pd/{id}/download', [PDController::class, 'download'])->name('v4.sdi.pd.download');

        // SURAT TUGAS
        Route::get('sdi/surtug', [SurtugController::class, 'index'])->name('v4.sdi.surtug');
        Route::get('sdi/surtug/{id}/download', [SurtugController::class, 'download'])->name('v4.sdi.surtug.download');

    // PELAYANAN
         // SKL
            Route::get('pelayanan/skl', [SKLController::class, 'index'])->name('v4.pelayanan.skl');
            // Route::post('kebidanan/skl', [SKLController::class, 'store'])->name('v4.pelayanan.skl.simpan');
            // Route::put('kebidanan/skl', [SKLController::class, 'update'])->name('v4.pelayanan.skl');
            // Route::delete('kebidanan/skl', [SKLController::class, 'destroy'])->name('v4.pelayanan.skl');
            Route::get('pelayanan/skl/{id}/cetak', [SKLController::class, 'cetak'])->name('v4.pelayanan.skl.cetak');
            Route::get('pelayanan/skl/{id}/print', [SKLController::class, 'print'])->name('v4.pelayanan.skl.print');
            // Route::resource('kebidanan/skl', '\App\Http\Controllers\Pelayanan\Kebidanan\sklController');

    // AI
        // KLAIM BPJS
        Route::get('ai/bpjs/klaim/coder', [KlaimBpjsController::class, 'index'])->name('v4.ai.bpjs.klaim.coder');

    // LOGOUT ROUTE
    Route::post('logout', [AuthController::class, 'logout'])->name('v4.logout');
});
