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
use \App\Http\Controllers\v4\IT\EPinjam\EPinjamController;
// use \App\Http\Controllers\v4\IT\EPinjam\EPinjamListController;
use \App\Http\Controllers\v4\IT\EPinjam\EPinjamBarangController;
use \App\Http\Controllers\v4\IT\EPinjam\EPinjamAsalController;
use \App\Http\Controllers\v4\IT\EPinjam\EPinjamKategoriController;
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
use \App\Http\Controllers\v4\SDI\ProfilPegawaiController;
use \App\Http\Controllers\v4\SDI\DetailProfilPegawaiController;
use \App\Http\Controllers\v4\SDI\JadwalDinasController;
use \App\Http\Controllers\v4\SDI\PDController;
use \App\Http\Controllers\v4\SDI\SurtugController;
use \App\Http\Controllers\v4\SDI\SpkRkkController;
use \App\Http\Controllers\v4\SDI\Absensi\AbsensiController;
use \App\Http\Controllers\v4\SDI\Absensi\AbsensiDashboardController;
use \App\Http\Controllers\v4\SDI\Absensi\AbsensiDeviceController;
use \App\Http\Controllers\v4\SDI\Rekrutmen\PengumumanController;
use \App\Http\Controllers\v4\SDI\Rekrutmen\RegistrasiController;
use \App\Http\Controllers\v4\SDI\Pengajuan\SurketController;
use \App\Http\Controllers\v4\SDI\Pengajuan\IDCardController;
use \App\Http\Controllers\v4\Publik\IPSRS\PerbaikanIPSRSController;
use \App\Http\Controllers\v4\Pelayanan\Kebidanan\SKLController;
use \App\Http\Controllers\v4\Akreditasi\KecelakaanKerjaController;
use App\Http\Controllers\v4\AI\KlaimBpjsController;

Route::prefix('v4')->middleware(['web','auth'])->group(function () { // SIMRSMU v.4

    // IT
        // PENGAJUAN TIKET
            // PERBAIKAN
                Route::get('it/pengajuan/tiket/table', [TiketController::class, 'table']);
                Route::post('it/pengajuan/tiket/kirim', [HelpdeskController::class, 'kirimTiket']);

        // E-PINJAM
            Route::get('it/epinjam', [EPinjamController::class, 'refresh']);
            Route::get('it/epinjam/loadtambah', [EPinjamController::class, 'loadTambah']);
            Route::post('it/epinjam/simpan', [EPinjamController::class, 'simpan']);
            Route::post('it/epinjam/updatestatus', [EPinjamController::class, 'updateStatus']);
            Route::get('it/epinjam/ubah/{id}', [EPinjamController::class, 'ubah']);
            Route::put('it/epinjam/ubah/{id}/proses', [EPinjamController::class, 'prosesUbah']);
            Route::delete('it/epinjam/hapus/{id}', [EPinjamController::class, 'hapus']);

            // REF BARANG
                Route::get('it/epinjam/ref/barang', [EPinjamBarangController::class, 'table']);
                Route::get('it/epinjam/ref/barang/loadtambah', [EPinjamBarangController::class, 'loadtambah']);
                Route::get('it/epinjam/ref/barang/ubah/{id}', [EPinjamBarangController::class, 'getUbah']);
                Route::put('it/epinjam/ref/barang/ubah', [EPinjamBarangController::class, 'ubah']);
                Route::post('it/epinjam/ref/barang/simpan', [EPinjamBarangController::class, 'simpan']);
                Route::delete('it/epinjam/ref/barang/hapus/{id}', [EPinjamBarangController::class, 'hapus']);
            // REF KATEGORI
                Route::get('it/epinjam/ref/kategori', [EPinjamKategoriController::class, 'table']);
                Route::get('it/epinjam/ref/kategori/ubah/{id}', [EPinjamKategoriController::class, 'getUbah']);
                Route::put('it/epinjam/ref/kategori/ubah', [EPinjamKategoriController::class, 'ubah']);
                Route::post('it/epinjam/ref/kategori/simpan', [EPinjamKategoriController::class, 'simpan']);
                Route::delete('it/epinjam/ref/kategori/hapus/{id}', [EPinjamKategoriController::class, 'hapus']);
            // REF ASAL
                Route::get('it/epinjam/ref/asal', [EPinjamAsalController::class, 'table']);

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

    // STRUKTUR ORGANISASI
        Route::delete('strukturorganisasi/hapus/{id}', [StrukturOrganisasiController::class, 'destroy']);

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
                Route::get('administrasi/berkas/laporan/formverif', [LaporanBulananController::class, 'formVerif']);
                Route::get('administrasi/berkas/laporan/formupload', [LaporanBulananController::class, 'formUpload']);
                Route::get('administrasi/berkas/laporan/table/{id}/verif', [LaporanBulananController::class, 'tableVerif']);
                Route::get('administrasi/berkas/laporan/table/{id}', [LaporanBulananController::class, 'table']);
                Route::post('administrasi/berkas/laporan/store', [LaporanBulananController::class, 'store']);
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
            Route::delete('administrasi/pengadaan/riwayat/{id}/hapus', [PengadaanController::class, 'hapusPengadaan']);
            // Route::get('administrasi/pengadaan/keranjang/{id}/tampil', [PengadaanController::class, 'tampilTambahKeranjang']);
            Route::get('administrasi/pengadaan/keranjang', [PengadaanController::class, 'tampilKeranjang']);
            Route::get('administrasi/pengadaan/tambahkeranjang/{id}', [PengadaanController::class, 'tampilTambahKeranjang']);
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
            Route::get('sdi/profilpegawai/table', [ProfilPegawaiController::class, 'table']);
            Route::get('sdi/profilpegawai/tableall', [ProfilPegawaiController::class, 'tableAll']);
            Route::get('sdi/profilpegawai/{user}/setaktif/{id}', [ProfilPegawaiController::class, 'setAktif']);
            Route::get('sdi/profilpegawai/setnonaktif/{id}', [ProfilPegawaiController::class, 'setNonAktif']);
            Route::get('sdi/profilpegawai/nonaktif', [ProfilPegawaiController::class, 'tableNonaktif']);
            Route::get('sdi/profilpegawai/nonlengkap', [ProfilPegawaiController::class, 'tableNonLengkap']);
            Route::get('sdi/profilpegawai/hapus/{id}/proses', [ProfilPegawaiController::class, 'hapusPegawai']);

            // GRAFIK INTERAKTIF
                Route::get('sdi/profilpegawai/grafik/1', [ProfilPegawaiController::class, 'grafik1']); // Jenis Pegawai
                Route::get('sdi/profilpegawai/grafik/2', [ProfilPegawaiController::class, 'grafik2']); // Jenis Kelamin
                Route::get('sdi/profilpegawai/grafik/3', [ProfilPegawaiController::class, 'grafik3']); // Pendidikan
                Route::get('sdi/profilpegawai/grafik/4', [ProfilPegawaiController::class, 'grafik4']); // Profesi
                Route::get('sdi/profilpegawai/grafik/5', [ProfilPegawaiController::class, 'grafik5']); // Status Pegawai
                Route::get('sdi/profilpegawai/grafik/6', [ProfilPegawaiController::class, 'grafik6']); // Status Perkawinan

            // DATA DIRI
                Route::get('sdi/profilpegawai/datadiri/{id}', [DetailProfilPegawaiController::class, 'getDataDiri']);

            // PENETAPAN
                Route::get('sdi/profilpegawai/penetapan/table/{id}', [DetailProfilPegawaiController::class, 'getPenetapan']);
                Route::post('sdi/profilpegawai/penetapan/tambah', [DetailProfilPegawaiController::class, 'tambahPenetapan']);
                Route::get('sdi/profilpegawai/penetapan/ubah/{id}', [DetailProfilPegawaiController::class, 'showUbahPenetapan']);
                Route::post('sdi/profilpegawai/penetapan/ubah/{id}/proses', [DetailProfilPegawaiController::class, 'ubahPenetapan']);
                Route::delete('sdi/profilpegawai/penetapan/hapus/{id}/proses', [DetailProfilPegawaiController::class, 'hapusPenetapan']);

            // ROTASI
                Route::get('sdi/profilpegawai/rotasi/table/{id}', [DetailProfilPegawaiController::class, 'getRotasi']);
                Route::post('sdi/profilpegawai/rotasi/tambah', [DetailProfilPegawaiController::class, 'tambahRotasi']);
                Route::get('sdi/profilpegawai/rotasi/ubah/{id}', [DetailProfilPegawaiController::class, 'showUbahRotasi']);
                Route::post('sdi/profilpegawai/rotasi/ubah/{id}/proses', [DetailProfilPegawaiController::class, 'ubahRotasi']);
                Route::delete('sdi/profilpegawai/rotasi/hapus/{id}/proses', [DetailProfilPegawaiController::class, 'hapusRotasi']);

            // DOKUMEN
                Route::get('sdi/profilpegawai/dokumen/table/{id}', [DetailProfilPegawaiController::class, 'getDokumen']);

            // KEPEGAWAIAN (NIP, KLASIFIKASI, dan TAT/TMT)
            Route::get('sdi/profilpegawai/kepegawaian/{id}', [DetailProfilPegawaiController::class, 'getKepegawaian']);
            Route::post('sdi/profilpegawai/kepegawaian/nip/simpan', [DetailProfilPegawaiController::class, 'tambahNIP']);
            Route::post('sdi/profilpegawai/kepegawaian/profesi/simpan', [DetailProfilPegawaiController::class, 'tambahProfesi']);
            Route::post('sdi/profilpegawai/kepegawaian/klasifikasi/simpan', [DetailProfilPegawaiController::class, 'tambahKlasifikasi']);
            Route::post('sdi/profilpegawai/kepegawaian/tattmt/simpan', [DetailProfilPegawaiController::class, 'tambahTattmt']);

        // SPK & RKK
            Route::get('sdi/spkrkk/table', [SpkRkkController::class, 'tableSpkRkk']);
            Route::post('sdi/spkrkk/tambah', [SpkRkkController::class, 'tambahSpkRkk']);
            Route::get('sdi/spkrkk/ubah/{id}', [SpkRkkController::class, 'showUbahSpkRkk']);
            Route::post('sdi/spkrkk/ubah/{id}/proses', [SpkRkkController::class, 'ubahSpkRkk']);
            Route::delete('sdi/spkrkk/hapus/{id}/proses', [SpkRkkController::class, 'hapusSpkRkk']);

        // JADWAL DINAS
            Route::get('sdi/jadwaldinas/absensi/riwayat', [JadwalDinasController::class, 'riwayatAbsensi']);
            Route::get('sdi/jadwaldinas/absensi/riwayat/{id}', [JadwalDinasController::class, 'riwayatAbsensiDetail']);

            // ADMIN
                Route::get('sdi/jadwaldinas/table/admin', [JadwalDinasController::class, 'tableAll']);
                Route::get('sdi/jadwaldinas/tambah/admin', [JadwalDinasController::class, 'jokiAdmin']);
                Route::get('sdi/jadwaldinas/table/admin/{month}', [JadwalDinasController::class, 'tableAllMonth']);
                Route::get('sdi/jadwaldinas/{id}/verif', [JadwalDinasController::class, 'verif']);
                // Route::get('sdi/jadwaldinas/{id}/tolak/{user}', [JadwalDinasController::class, 'tolak']);
                Route::get('sdi/jadwaldinas/{id}/batalverif', [JadwalDinasController::class, 'batalVerif']);
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
                Route::get('sdi/jadwaldinas/grafikabsensi', [JadwalDinasController::class, 'grafikAbsensi']);
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
            // DASHBOARD INTERAKTIF
                Route::get('sdi/absensi/dashboard/1', [AbsensiDashboardController::class, 'grafik1']);

            // PERIZINAN PERANGKAT
                Route::get('sdi/absensi/perangkat/table', [AbsensiDeviceController::class, 'table']);
                Route::get('sdi/absensi/perangkat/approve/{id}', [AbsensiDeviceController::class, 'approve']);
                Route::get('sdi/absensi/perangkat/reject/{id}', [AbsensiDeviceController::class, 'reject']);
                Route::get('sdi/absensi/perangkat/aktif/{id}', [AbsensiDeviceController::class, 'aktif']);
                Route::get('sdi/absensi/perangkat/blokir/{id}', [AbsensiDeviceController::class, 'blokir']);

            // REKAPITULASI ABSENSI
                Route::get('sdi/absensi/ijin/checkBulan/{bln}', [AbsensiController::class, 'checkBulan']);
                Route::get('sdi/absensi/ijin/checkJadwal/{id}', [AbsensiController::class, 'checkJadwal']);
                Route::get('sdi/absensi/ijin/checkPegawai/{id}', [AbsensiController::class, 'checkPegawai']);
                Route::post('sdi/absensi/ijin/push', [AbsensiController::class, 'storeIjin']);
                Route::post('sdi/absensi/table/monitoring', [AbsensiController::class, 'tableMonitoring']);
                Route::post('sdi/absensi/table/all', [AbsensiController::class, 'tableAll']);
                Route::get('sdi/absensi/table/coba', [AbsensiController::class, 'cobaJadwal']);
                Route::post('sdi/absensi/table/rekapLinda', [AbsensiController::class, 'tableRekapAbsensi']);
                Route::post('sdi/absensi/table/rekapLindaDetail', [AbsensiController::class, 'tableRekapAbsensiDetail']);
                Route::post('sdi/absensi/table/getCutiPegawai', [AbsensiController::class, 'getCutiPegawai']);
                Route::post('sdi/absensi/table/getMonitoringAbsensiHarian', [AbsensiController::class, 'getMonitoringAbsensiHarian']);
                Route::post('sdi/absensi/table/getBuktifFotoPegawai', [AbsensiController::class, 'getBuktifFotoPegawai']);
                Route::get('sdi/absensi/deteksiperangkat', [AbsensiController::class, 'deteksiPerangkat']);
                Route::get('sdi/absensi/{id}/detail', [AbsensiController::class, 'detail']);
                Route::get('sdi/absensi/{id}/ubah', [AbsensiController::class, 'getUbah']);
                Route::post('sdi/absensi/{id}/ubah/proses', [AbsensiController::class, 'ubah']);
                Route::get('sdi/absensi/{id}/hapus/{user}', [AbsensiController::class, 'hapus']);

        // REKRUTMEN PEGAWAI
            // PENGUMUMAN
                Route::get('sdi/rekrutmen/pengumuman/table', [PengumumanController::class, 'table']);
                Route::get('sdi/rekrutmen/pengumuman/{id}/show', [PengumumanController::class, 'show']);
                Route::post('sdi/rekrutmen/pengumuman/simpan', [PengumumanController::class, 'simpan']);
                Route::post('sdi/rekrutmen/pengumuman/ubah', [PengumumanController::class, 'ubah']);
                Route::delete('sdi/rekrutmen/pengumuman/nonaktif/{id}', [PengumumanController::class, 'nonaktif']);

            // REGISTRASI/LOKER
                Route::get('sdi/rekrutmen/registrasi/table/{id}', [RegistrasiController::class, 'table']);
                Route::post('sdi/rekrutmen/registrasi/hasil', [RegistrasiController::class, 'hasil']);
                // Route::get('sdi/rekrutmen/registrasi/download/{dokumen}/{peserta}', [RegistrasiController::class, 'previewPdf']);

        // PENGAJUAN SDI
            // SURAT KETERANGAN
                // ADMIN
                    Route::get('sdi/pengajuan/surket/table', [SurketController::class, 'tableAdmin']);
                    Route::get('sdi/pengajuan/surket/{id}/verif/{user}', [SurketController::class, 'verif']);
                    Route::get('sdi/pengajuan/surket/{id}/unverif', [SurketController::class, 'unverif']);
                    Route::post('sdi/pengajuan/surket/tolak', [SurketController::class, 'tolak']);
                    Route::get('sdi/pengajuan/surket/{id}/bataltolak', [SurketController::class, 'batalTolak']);
                    Route::post('sdi/pengajuan/surket/proses', [SurketController::class, 'prosesUpload']);
                    Route::get('sdi/pengajuan/surket/{id}/batalproses', [SurketController::class, 'batalProsesUpload']);
                // USER
                    Route::get('sdi/pengajuan/surket/{id}/table', [SurketController::class, 'tableUser']);
                    Route::post('sdi/pengajuan/surket/tambah', [SurketController::class, 'tambah']);
                    Route::delete('sdi/pengajuan/surket/{id}/delete', [SurketController::class, 'hapus']);

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

    // PUBLIK
        // PERBAIKAN IPSRS
            // USER
                Route::get('publik/perbaikan/ipsrs/lokasi', [PerbaikanIPSRSController::class, 'autocompleteLokasi']);
                Route::get('publik/perbaikan/ipsrs/user/table', [PerbaikanIPSRSController::class, 'tableUser']);
                Route::get('publik/perbaikan/ipsrs/user/track/{id}', [PerbaikanIPSRSController::class, 'track']);
                Route::get('publik/perbaikan/ipsrs/user/ubah/{id}', [PerbaikanIPSRSController::class, 'getUbah']);
                Route::post('publik/perbaikan/ipsrs/user/ubah', [PerbaikanIPSRSController::class, 'prosesUbah']);
                Route::delete('publik/perbaikan/ipsrs/user/hapus/{id}', [PerbaikanIPSRSController::class, 'prosesHapus']);
            // ADMIN
                Route::get('publik/perbaikan/ipsrs/admin/diagram/{tahun}', [PerbaikanIPSRSController::class, 'diagram']);
                Route::get('publik/perbaikan/ipsrs/admin/tableAll', [PerbaikanIPSRSController::class, 'tableAdminAll']);
                Route::get('publik/perbaikan/ipsrs/admin/table', [PerbaikanIPSRSController::class, 'tableAdmin']);
                Route::get('publik/perbaikan/ipsrs/admin/lampiran/{id}', [PerbaikanIPSRSController::class, 'lampiranAdmin']);
                Route::post('publik/perbaikan/ipsrs/filter', [PerbaikanIPSRSController::class, 'filter']);
                // DETAIL
                    Route::post('publik/perbaikan/ipsrs/verif/{id}', [PerbaikanIPSRSController::class, 'verif']);
                    Route::post('publik/perbaikan/ipsrs/unverif/{id}', [PerbaikanIPSRSController::class, 'unverif']);
                    Route::post('publik/perbaikan/ipsrs/process/{id}', [PerbaikanIPSRSController::class, 'process']);
                    Route::post('publik/perbaikan/ipsrs/finish/{id}', [PerbaikanIPSRSController::class, 'finish']);
                    Route::get('publik/perbaikan/ipsrs/result/{id}', [PerbaikanIPSRSController::class, 'result']);

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

    // AKREDITASI
            // KECELAKAAN KERJA
                Route::get('akreditasi/kecelakaankerja/data',[KecelakaanKerjaController::class, 'table']);
                Route::get('akreditasi/kecelakaankerja/{id}/hapus',[KecelakaanKerjaController::class, 'destroy']);

            // MANAJEMEN RISIKO
                // Route::get('manrisk/data','\App\Http\Controllers\Mutu\ManriskController@table');
                // Route::get('manrisk/hapus/{id}', '\App\Http\Controllers\Mutu\ManriskController@hapus');

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
