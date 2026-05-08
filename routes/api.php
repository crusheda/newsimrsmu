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
use \App\Http\Controllers\v4\Administrasi\Berkas\Surat\DisposisiController;
use \App\Http\Controllers\v4\Administrasi\Berkas\Surat\SuratMasukController;
use \App\Http\Controllers\v4\Administrasi\Berkas\Surat\SuratKeluarController;
use \App\Http\Controllers\v4\Administrasi\Pengadaan\PengadaanController;
use \App\Http\Controllers\v4\Administrasi\Pengadaan\PengadaanBarangController;
use \App\Http\Controllers\v4\Administrasi\Pengadaan\PengadaanRekapController;
use \App\Http\Controllers\v4\Administrasi\ERuang\ERuangController;
use \App\Http\Controllers\v4\SDI\JadwalDinasController;
use \App\Http\Controllers\v4\SDI\PDController;
use \App\Http\Controllers\v4\SDI\SurtugController;
use \App\Http\Controllers\v4\Pelayanan\Kebidanan\SKLController;
use App\Http\Controllers\v4\AI\KlaimBpjsController;

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

            // SURAT
                // DISPOSISI
                Route::get('administrasi/berkas/disposisi/data', [DisposisiController::class, 'apiGet']);
                Route::get('administrasi/berkas/disposisi/data/all', [DisposisiController::class, 'apiGetAll']);
                Route::get('administrasi/berkas/disposisi/data/{id}', [SuratMasukController::class, 'apiGetDisposisi']);
                Route::post('administrasi/berkas/disposisi/simpan', [DisposisiController::class, 'store']);
                Route::delete('administrasi/berkas/disposisi/{id}', [DisposisiController::class, 'hapus']);

                // SURAT MASUK
                Route::get('administrasi/berkas/suratmasuk/data', [SuratMasukController::class, 'apiGet']);
                Route::get('administrasi/berkas/suratmasuk/tambah', [SuratMasukController::class, 'formTambah']);
                Route::get('administrasi/berkas/suratmasuk/filter/{bulan}/{tahun}', [SuratMasukController::class, 'getFilterSurat']);
                Route::get('administrasi/berkas/suratmasuk/data/all', [SuratMasukController::class, 'apiGetAll']);
                Route::get('administrasi/berkas/suratmasuk/data/disposisi/{id}', [SuratMasukController::class, 'apiGetDisposisi']);
                Route::get('administrasi/berkas/suratmasuk/data/{id}', [SuratMasukController::class, 'showChange']);
                Route::post('administrasi/berkas/suratmasuk/ubah', [SuratMasukController::class, 'ubah']);
                // Route::put('administrasi/berkas/suratmasuk/{id}', [SuratMasukController::class, 'update']);
                Route::delete('administrasi/berkas/suratmasuk/{id}', [SuratMasukController::class, 'hapus']);
                Route::get('administrasi/berkas/suratmasuk/cariasal', [SuratMasukController::class, 'acAsal']);
                Route::get('administrasi/berkas/suratmasuk/caritempat', [SuratMasukController::class, 'acTempat']);

                // BRIDGE - SEMENTARA
                Route::get('administrasi/berkas/suratmasuk/pushdata', [SuratMasukController::class, 'changeModelTypeUser']);

                // SURAT KELUAR
                Route::get('administrasi/berkas/suratkeluar/getkode/{id}', [SuratKeluarController::class, 'apiKode']);
                // Route::get('administrasi/berkas/suratkeluar/filter/{id}', [SuratKeluarController::class, 'getFilterSurat']);
                Route::get('administrasi/berkas/suratkeluar/data', [SuratKeluarController::class, 'apiGet']);
                Route::get('administrasi/berkas/suratkeluar/filter/{surat}/{bulan}/{tahun}', [SuratKeluarController::class, 'getFilterSurat']);
                Route::get('administrasi/berkas/suratkeluar/data/all', [SuratKeluarController::class, 'apiGetAll']);
                Route::get('administrasi/berkas/suratkeluar/data/{id}', [SuratKeluarController::class, 'showChange']);
                Route::post('administrasi/berkas/suratkeluar/ubah', [SuratKeluarController::class, 'ubah']);
                Route::delete('administrasi/berkas/suratkeluar/{id}', [SuratKeluarController::class, 'hapus']);

        // PENGADAAN
        // Route::get('administrasi/pengadaan/data/{id}', [PengadaanController::class, 'dataPengadaan']);
        Route::get('administrasi/pengadaan/riwayat', [PengadaanController::class, 'riwayatPengadaan']);
        // Route::delete('administrasi/pengadaan/riwayat/{id}/hapus', [PengadaanController::class, 'hapusRiwayatPengadaan']);
        // Route::get('administrasi/pengadaan/keranjang/{id}/tampil', [PengadaanController::class, 'tampilTambahKeranjang']);
        Route::get('administrasi/pengadaan/keranjang', [PengadaanController::class, 'tampilKeranjang']);
        Route::get('administrasi/pengadaan/keranjang/update/{id}', [PengadaanController::class, 'updateKeranjang']);
        Route::post('administrasi/pengadaan/keranjang/tambah', [PengadaanController::class, 'tambahKeranjang']);
        Route::post('administrasi/pengadaan/checkout', [PengadaanController::class, 'checkoutKeranjang']);
        Route::post('administrasi/pengadaan/copy', [PengadaanController::class, 'copyPengadaan']);
        Route::delete('administrasi/pengadaan/keranjang/{id}/hapus', [PengadaanController::class, 'hapusKeranjang']);
        Route::get('administrasi/pengadaan/barang', [PengadaanController::class, 'getBarangPengadaan']);
        // Route::get('administrasi/pengadaan/barang', [PengadaanController::class, 'loadMore']);
        // Route::get('administrasi/pengadaan/caribarang', [PengadaanController::class, 'getacbarang']);
        Route::get('administrasi/pengadaan/grafik-pengadaan/{num}', [PengadaanController::class, 'grafikPengadaan']);

            // REKAP
            Route::get('administrasi/pengadaan/rekap/{bln}/{thn}/{kategori}', [PengadaanRekapController::class, 'table']);

            // BARANG
            Route::get('administrasi/pengadaan/acbarang', [PengadaanBarangController::class, 'acBarang']);
            Route::get('administrasi/pengadaan/barang/table', [PengadaanBarangController::class, 'table']);
            Route::post('administrasi/pengadaan/barang/tambah', [PengadaanBarangController::class, 'tambah']);
            Route::get('administrasi/pengadaan/barang/ubah/{id}', [PengadaanBarangController::class, 'ubah']);
            Route::post('administrasi/pengadaan/barang/ubah/proses', [PengadaanBarangController::class, 'prosesUbah']);
            Route::delete('administrasi/pengadaan/barang/{id}/hapus', [PengadaanBarangController::class, 'hapus']);

        // E-RUANG
        Route::get('administrasi/eruang', [ERuangController::class, 'table']);
        Route::post('administrasi/eruang/cek', [ERuangController::class, 'cekKetersediaan']);
        Route::post('administrasi/eruang/store', [ERuangController::class, 'store']);
        Route::post('administrasi/eruang/ubah/{id}/proses', [ERuangController::class, 'ubah']);
        Route::post('administrasi/eruang/tolak/{id}', [ERuangController::class, 'tolak']);
        Route::get('administrasi/eruang/ubah/{id}', [ERuangController::class, 'getUbah']);
        Route::get('administrasi/eruang/gizi/verif/{id}', [ERuangController::class, 'verifGizi']);
        Route::get('administrasi/eruang/gizi/verif/edithapus/{id}', [ERuangController::class, 'verifEditHapus']);
        Route::delete('administrasi/eruang/hapus/{id}', [ERuangController::class, 'hapus']);
        Route::get('administrasi/eruang/display', [ERuangController::class, 'display']);

            // DAFTAR RUANGAN
            Route::get('administrasi/eruang/ruangan', [ERuangController::class, 'getRuangan']);
            Route::post('administrasi/eruang/ruangan/store', [ERuangController::class, 'storeRuangan']);
            Route::delete('administrasi/eruang/ruangan/hapus/{id}', [ERuangController::class, 'destroyRuangan']);
            Route::get('administrasi/eruang/ruangan/ubah/{id}', [ERuangController::class, 'getUbahRuangan']);
            Route::post('administrasi/eruang/ruangan/ubah/proses', [ERuangController::class, 'updateRuangan']);

    // SUMBER DAYA INSANI (SDI)
        // PROFIL PEGAWAI

        // JADWAL DINAS
            // ADMIN
                Route::get('sdi/jadwaldinas/table/admin', [JadwalDinasController::class, 'tableAll']);
                Route::get('sdi/jadwaldinas/tambah/admin', [JadwalDinasController::class, 'jokiAdmin']);
                Route::get('sdi/jadwaldinas/table/admin/{month}', [JadwalDinasController::class, 'tableAllMonth']);
                Route::get('sdi/jadwaldinas/{id}/verif/{user}', [JadwalDinasController::class, 'verif']);
                // Route::get('sdi/jadwaldinas/{id}/tolak/{user}', [JadwalDinasController::class, 'tolak']);
                Route::get('sdi/jadwaldinas/{id}/batalverif/{user}', [JadwalDinasController::class, 'batalVerif']);
                // Route::get('sdi/jadwaldinas/{id}/bataltolak/{user}', [JadwalDinasController::class, 'batalTolak']);
            // VERIFIKASI BAWAHAN
                Route::get('sdi/jadwaldinas/bawahan/count', [JadwalDinasController::class, 'countBawahan']);
                Route::get('sdi/jadwaldinas/bawahan/table', [JadwalDinasController::class, 'tableAllBawahan']);
                Route::get('sdi/jadwaldinas/bawahan/table/{month}', [JadwalDinasController::class, 'tableAllBawahanFilter']);
                Route::get('sdi/jadwaldinas/bawahan/{id}/verif', [JadwalDinasController::class, 'verifBawahan']);
                Route::get('sdi/jadwaldinas/bawahan/{id}/tolak', [JadwalDinasController::class, 'tolakBawahan']);
                Route::get('sdi/jadwaldinas/bawahan/{id}/batalverif', [JadwalDinasController::class, 'batalVerifBawahan']);
                Route::get('sdi/jadwaldinas/bawahan/{id}/bataltolak', [JadwalDinasController::class, 'batalTolakBawahan']);
            // DASHBOARD / GRAPH
                Route::get('sdi/jadwaldinas/totalabsensi/{range}', [JadwalDinasController::class, 'totalAbsensi']);
                Route::get('sdi/jadwaldinas/totalcuti', [JadwalDinasController::class, 'totalCuti']);
                Route::get('sdi/jadwaldinas/totalcutiunit', [JadwalDinasController::class, 'totalCutiUnit']);
            // USER
                Route::post('sdi/jadwaldinas/tambah', [JadwalDinasController::class, 'storePengajuan']);
                Route::post('sdi/jadwaldinas/ubah', [JadwalDinasController::class, 'updatePengajuan']);
                // Route::get('sdi/jadwaldinas/shift/{id}/user/{user}', [JadwalDinasController::class, 'cekShift']);
                Route::get('sdi/jadwaldinas/{id}/shift', [JadwalDinasController::class, 'getShift']);
                Route::get('sdi/jadwaldinas/table', [JadwalDinasController::class, 'table']);
                Route::get('sdi/jadwaldinas/jadwal/{id}', [JadwalDinasController::class, 'jadwal']);
                Route::delete('sdi/jadwaldinas/{id}/hapus', [JadwalDinasController::class, 'hapus']);
                Route::get('sdi/dokumentasi/eabsensi', [JadwalDinasController::class, 'dokumentasiAbsensi']);
                Route::get('sdi/dokumentasi/eabsensi/download', [JadwalDinasController::class, 'downloadDokumentasiAbsensi']);
                // REFERENSI SHIFT
                    Route::get('sdi/jadwaldinas/shift/table', [JadwalDinasController::class, 'tableShift']);
                    Route::get('sdi/jadwaldinas/shift/table/all', [JadwalDinasController::class, 'tableShiftAll']);
                    Route::get('sdi/jadwaldinas/shift/{id}', [JadwalDinasController::class, 'showUbahShift']);
                    Route::post('sdi/jadwaldinas/shift/{id}/ubah', [JadwalDinasController::class, 'ubahShift']);
                    Route::post('sdi/jadwaldinas/shift/tambah', [JadwalDinasController::class, 'tambahShift']);
                    Route::delete('sdi/jadwaldinas/shift/{id}/hapus', [JadwalDinasController::class, 'hapusShift']);
                // REFERENSI STAFF
                    Route::get('sdi/jadwaldinas/staf/table', [JadwalDinasController::class, 'tableStaf']);
                    Route::get('sdi/jadwaldinas/staf/table/all', [JadwalDinasController::class, 'tableStafAll']);
                    Route::get('sdi/jadwaldinas/staf/{id}', [JadwalDinasController::class, 'showUbahStaf']);
                    Route::post('sdi/jadwaldinas/staf/{id}/ubah', [JadwalDinasController::class, 'ubahStaf']);
                    Route::post('sdi/jadwaldinas/staf/tambah', [JadwalDinasController::class, 'tambahStaf']);
                    Route::delete('sdi/jadwaldinas/staf/{id}/hapus', [JadwalDinasController::class, 'hapusStaf']);
                    Route::get('sdi/jadwaldinas/staf/{id}/ambilalih', [JadwalDinasController::class, 'ambilAlihStaf']);
                    // ATUR STAF
                        Route::get('sdi/jadwaldinas/staf/atur/{id}', [JadwalDinasController::class, 'showAturStaf']);
                        Route::post('sdi/jadwaldinas/staf/atur/{id}/ubah', [JadwalDinasController::class, 'aturStaf']);
                // REFERENSI LIBUR NASIONAL
                    Route::get('sdi/jadwaldinas/ln/table', [JadwalDinasController::class, 'tableLN']);
                    Route::post('sdi/jadwaldinas/ln/tambah', [JadwalDinasController::class, 'tambahLN']);
                    Route::delete('sdi/jadwaldinas/ln/{id}/hapus', [JadwalDinasController::class, 'hapusLN']);

        // ABSENSI PEGAWAI

        // REKRUTMEN PEGAWAI

        // PENGAJUAN SDI
            // SURAT KETERANGAN

            // IDCARD
                // ADMIN
                    Route::get('sdi/pengajuan/idcard/table', [IDCardController::class, 'table']);
                    Route::post('sdi/pengajuan/idcard/status', [IDCardController::class, 'ubahStatus']);
                // USER
                    Route::post('sdi/pengajuan/idcard/tambah', [IDCardController::class, 'tambahPengajuan']);
                    Route::get('sdi/pengajuan/idcard/riwayat/{id}', [IDCardController::class, 'riwayat']);
                    Route::delete('sdi/pengajuan/idcard/{id}/delete', [IDCardController::class, 'hapusPengajuan']);

        // PERJALANAN DINAS
        Route::get('sdi/pd/table', [PDController::class, 'table']);
        Route::get('sdi/pd/{id}', [PDController::class, 'show']);
        Route::post('sdi/pd/{id}/ubah', [PDController::class, 'update']);
        Route::post('sdi/pd/tambah', [PDController::class, 'tambah']);
        Route::delete('sdi/pd/{id}/hapus', [PDController::class, 'hapus']);
        Route::post('sdi/pd/paid', [PDController::class, 'confirmPaid']);
        Route::post('sdi/pd/unpaid', [PDController::class, 'cancelPaid']);

        // SURAT TUGAS
        Route::post('sdi/surtug/simpan', [SurtugController::class, 'simpan']);
        Route::get('sdi/surtug/{id}/ubah', [SurtugController::class, 'ubah']);
        Route::post('sdi/surtug/{id}/prosesubah', [SurtugController::class, 'prosesUbah']);
        Route::delete('sdi/surtug/{id}/hapus', [SurtugController::class, 'hapus']);
        Route::get('sdi/surtug/table', [SurtugController::class, 'table']);

    // PELAYANAN
        // SKL
        Route::get('pelayanan/skl/get',[SKLController::class, 'apiGet']);
        Route::get('pelayanan/skl/getqueue',[SKLController::class, 'apiGetQueue']);
        Route::post('pelayanan/skl/simpan',[SKLController::class, 'apiSimpan']);
        Route::get('pelayanan/skl/cari/{id}',[SKLController::class, 'filterIbu']);
        Route::get('pelayanan/skl/all',[SKLController::class, 'apiAll']);
        Route::get('pelayanan/skl/getubah/{id}', [SKLController::class, 'getubah']);
        Route::get('pelayanan/skl/hapus/{id}', [SKLController::class, 'hapus']);
        Route::post('pelayanan/skl/ubah/{id}', [SKLController::class, 'ubah']);

        // ANTIGEN
        // Route::get('antigen/all','\App\Http\Controllers\Pelayanan\Lab\antigenController@apiShowAll')->name('antigen.apiall');
        // Route::get('antigen/get','\App\Http\Controllers\Pelayanan\Lab\antigenController@apiGet')->name('antigen.apiget');
        // Route::post('antigen/filter', '\App\Http\Controllers\Pelayanan\Lab\antigenController@apiFilter')->name('antigen.apifilter');
        // Route::post('antigen/ubah/{id}', '\App\Http\Controllers\Pelayanan\Lab\antigenController@ubah')->name('antigen.ubah');
        // Route::get('antigen/getubah/{id}', '\App\Http\Controllers\Pelayanan\Lab\antigenController@getubah')->name('antigen.getubah');
        // Route::get('antigen/hapus/{id}', '\App\Http\Controllers\Pelayanan\Lab\antigenController@hapus')->name('antigen.hapus');
        // Route::get('antigen/getpasien/{id}', '\App\Http\Controllers\Pelayanan\Lab\antigenController@getPasien');

    // AI
        // KLAIM BPJS
        Route::post('ai/bpjs/klaim/coder/kirim', [KlaimBpjsController::class, 'analyze']);
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
