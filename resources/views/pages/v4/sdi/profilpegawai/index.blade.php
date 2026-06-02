@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Profil <b class="text-success link-underline-success text-decoration-underline">Pegawai</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">SDI</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Profil Pegawai
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12" id="show-card-grafik" hidden>
                <div class="card custom-card">
                    <div class="card-body p-4 pb-1">
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-grow-1">
                                <h6 class="mb-0"><i class="ph-duotone ph-database me-1"></i> Grafik <b class="text-primary">Interaktif</b> <b class="text-success">Pegawai</b> <button class="btn btn-sm btn-outline-danger ms-1" onclick="hideGrafik()">Sembunyikan Grafik</button></h6>
                            </div>
                            <div class="flex-shrink-0 ms-3">
                                <div class="dropdown">
                                    <a class="btn btn-secondary-transparent dropdown-toggle arrow-none" href="#"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ti ti-grid-dots f-18 me-1"></i> Pilihan Grafik
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="showGrafikJenisPegawai()">Jenis Pegawai</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="showGrafikJenisKelamin()">Jenis Kelamin</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="showGrafikPendidikan()">Pendidikan</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="showGrafikProfesi()">Profesi</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="showGrafikStatusPegawai()">Status Pegawai</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="showGrafikStatusKawin()">Status Perkawinan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-7 border-end">
                            <ul class="list-group list-group-flush" id="list-grafik"></ul>
                        </div>
                        <div class="col-md-5 align-items-center">
                            <h6 class="text-center my-2" id="show-name-grafik"></h6>
                            <div id="grafik-show" style="width:100%; min-height:400px; height:100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <div class="btn-group shadow">
                            <button class="btn btn-primary-transparent" onclick="window.location.href='{{ route('v4.akun.akunpengguna.index') }}'" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Pengaturan Akun Pengguna (Tambah/Ubah/Hapus Akun Pegawai)">
                                <i class="fas fa-users-cog me-1"></i> Pengaturan Akun</button>
                            <button class="btn btn-warning-transparent" id="btn-tabel-simpel" onclick="refresh()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Menampilkan Data Simpel Profil Pegawai">
                                <i class="fas fa-sync me-1"></i> Tabel Simpel</button>
                            <button type="button" class="btn btn-danger-transparent" id="btn-tabel-lengkap" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Menampilkan Seluruh Data Profil Pegawai" onclick="showAll()">
                                <i class="fa-fw fas fa-infinity nav-icon me-1"></i> Tabel Lengkap</button>
                            <button class="btn btn-info-transparent" onclick="showGrafikStatusKawin()" id="btn-show-grafik" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Menampilkan Grafik Profil Pegawai">
                                <i class="fas fa-chart-pie me-1"></i> Grafik Interaktif</button>
                        </div>
                        <div class="btn-group">
                            <a href="javascript:void(0);" class="btn btn-secondary-transparent dropdown-toggle arrow-none" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical f-18 me-1"></i> Menu &nbsp;</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="showNonLengkap()">Profil Belum Lengkap</a>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="showNonAktif()">Karyawan Nonaktif</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="alert alert-light shadow-sm" role="alert">
                            <small><i class="fa-fw fas fa-caret-right nav-icon me-1"></i> Refresh browser Anda apabila terjadi Error saat pengambilan data pegawai</small><br>
                            <small><i class="fa-fw fas fa-caret-right nav-icon me-1"></i> Klik pada <u class="text-primary"><b>#ID Pegawai</b></u> untuk melihat Profil</small>
                        </div>
                        <div class="table-responsive" id="table1">
                            <table id="dttable" class="table align-middle dt-responsive table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="cell-fit"><center>#ID</center></th>
                                        <th class="cell-fit">AKUN / USERNAME</th>
                                        <th class="cell-fit">NAMA LENGKAP</th>
                                        <th class="cell-fit">JABATAN</th>
                                        <th class="cell-fit">STATUS PEGAWAI</th>
                                        <th class="cell-fit">TERAKHIR DIPERBARUI</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody">
                                    <tr>
                                        <td colspan="9" style="font-size:13px">
                                            <center><i class="fa fa-spinner fa-spin fa-fw"></i> Menginisialisasi data...</center>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="cell-fit"><center>#ID</center></th>
                                        <th class="cell-fit">AKUN / USERNAME</th>
                                        <th class="cell-fit">NAMA LENGKAP</th>
                                        <th class="cell-fit">JABATAN</th>
                                        <th class="cell-fit">STATUS PEGAWAI</th>
                                        <th class="cell-fit">TERAKHIR DIPERBARUI</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="table-responsive" id="table2" hidden>
                            <table id="dttable-all" class="table align-middle dt-responsive table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="cell-fit">ID</th> {{-- 0 --}}
                                        <th>NIP</th>
                                        <th>NIK</th>
                                        <th>USERNAME</th>
                                        <th>NAMA LENGKAP</th>
                                        <th>PANGGILAN</th>
                                        <th>TMPT/TGL LAHIR</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>STATUS KAWIN</th>
                                        <th>STATUS PEGAWAI</th>
                                        <th>JABATAN</th> {{-- 10 --}}
                                        <th>KLASIFIKASI</th>
                                        <th>MASUK KERJA</th>
                                        <th>URUTAN MASUK</th>
                                        <th>TMT</th>
                                        <th>TAT</th> {{-- 15 --}}
                                        <th>NO.HP</th>
                                        <th>EMAIL</th>
                                        <th>FB</th>
                                        <th>IG</th>
                                        <th>TT</th> {{-- 20 --}}
                                        <th>KELURAHAN (KTP)</th>
                                        <th>KECAMATAN (KTP)</th>
                                        <th>KABUPATEN (KTP)</th>
                                        <th>PROVINSI (KTP)</th>
                                        <th class="cell-fit">ALAMAT (KTP)</th> {{-- 25 --}}
                                        <th>KELURAHAN (DOM)</th>
                                        <th>KECAMATAN (DOM)</th>
                                        <th>KABUPATEN (DOM)</th>
                                        <th>PROVINSI (DOM)</th>
                                        <th class="cell-fit">ALAMAT (DOM)</th> {{-- 30 --}}
                                        <th>SD</th>
                                        <th>SMP</th>
                                        <th>SMA</th>
                                        <th>D1</th>
                                        <th>D2</th> {{-- 35 --}}
                                        <th>D3</th>
                                        <th>D4</th>
                                        <th>S1</th>
                                        <th>S1 PROFESI</th>
                                        <th>S2</th> {{-- 40 --}}
                                        <th>S3</th>
                                        <th class="cell-fit">PENGALAMAN KERJA</th>
                                        <th>RIWAYAT PENYAKIT</th>
                                        <th>RIWAYAT PENYAKIT KELUARGA</th>
                                        <th>RIWAYAT OPERASI</th> {{-- 45 --}}
                                        <th>RIWAYAT PENGGUNAAN OBAT</th>
                                        <th class="cell-fit">UPDATE</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody-all">
                                    <tr>
                                        <td colspan="9" style="font-size:13px">
                                            <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="cell-fit">ID</th>
                                        <th>NIP</th>
                                        <th>NIK</th>
                                        <th>USERNAME</th>
                                        <th>NAMA LENGKAP</th>
                                        <th>PANGGILAN</th>
                                        <th>TMPT/TGL LAHIR</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>STATUS KAWIN</th>
                                        <th>STATUS PEGAWAI</th>
                                        <th>JABATAN</th>
                                        <th>KLASIFIKASI</th>
                                        <th>MASUK KERJA</th>
                                        <th>URUTAN MASUK</th>
                                        <th>TMT</th>
                                        <th>TAT</th>
                                        <th>NO.HP</th>
                                        <th>EMAIL</th>
                                        <th>FB</th>
                                        <th>IG</th>
                                        <th>TT</th>
                                        <th>KELURAHAN (KTP)</th>
                                        <th>KECAMATAN (KTP)</th>
                                        <th>KABUPATEN (KTP)</th>
                                        <th>PROVINSI (KTP)</th>
                                        <th class="cell-fit">ALAMAT (KTP)</th>
                                        <th>KELURAHAN (DOM)</th>
                                        <th>KECAMATAN (DOM)</th>
                                        <th>KABUPATEN (DOM)</th>
                                        <th>PROVINSI (DOM)</th>
                                        <th class="cell-fit">ALAMAT (DOM)</th>
                                        <th>SD</th>
                                        <th>SMP</th>
                                        <th>SMA</th>
                                        <th>D1</th>
                                        <th>D2</th>
                                        <th>D3</th>
                                        <th>D4</th>
                                        <th>S1</th>
                                        <th>S1 PROFESI</th>
                                        <th>S2</th>
                                        <th>S3</th>
                                        <th class="cell-fit">PENGALAMAN KERJA</th>
                                        <th>RIWAYAT PENYAKIT</th>
                                        <th>RIWAYAT PENYAKIT KELUARGA</th>
                                        <th>RIWAYAT OPERASI</th>
                                        <th>RIWAYAT PENGGUNAAN OBAT</th>
                                        <th class="cell-fit">UPDATE</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- NONAKTIF --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="nonaktif" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Daftar Pegawai <b class="text-danger">Nonaktif</b>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive text-nowrap">
                        <table id="dttable-nonaktif" class="table dt-responsive table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="cell-fit"><center>ID</center></th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">NAMA LENGKAP</th>
                                    <th class="cell-fit">TGL NONAKTIF</th>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-nonaktif">
                                <tr>
                                    <td colspan="9" style="font-size:13px">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit"><center>ID</center></th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">NAMA LENGKAP</th>
                                    <th class="cell-fit">TGL NONAKTIF</th>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-link text-dark" href="javascript:void(0);" data-bs-dismiss="modal"><i
                        class="fas fa-chevron-left"></i>&nbsp;&nbsp;Tutup</a>
                    <div class="btn-group">
                        <button class="btn btn-warning" onclick="refreshNonAktif()"><i class='fa-fw fas fa-sync nav-icon'></i>&nbsp;&nbsp;Segarkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TIDAK LENGKAP --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="nonlengkap" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Daftar Profil Pegawai <b class="text-orange">Belum Lengkap</b>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive text-nowrap">
                        <table id="dttable-nonlengkap" class="table dt-responsive table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="cell-fit"><center>ID</center></th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">DITAMBAHKAN</th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-nonlengkap">
                                <tr>
                                    <td colspan="9" style="font-size:13px">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit"><center>ID</center></th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">DITAMBAHKAN</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-link text-dark" href="javascript:void(0);" data-bs-dismiss="modal"><i
                        class="fas fa-chevron-left"></i>&nbsp;&nbsp;Tutup</a>
                    <div class="btn-group">
                        <button class="btn btn-warning" onclick="refreshNonLengkap()"><i class='fa-fw fas fa-sync nav-icon'></i>&nbsp;&nbsp;Segarkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal animate__animated animate__rubberBand fade" id="aktifKaryawan" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Apakah Anda sudah Yakin?
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_aktif_karyawan" hidden>
                    <p style="text-align: justify;">Anda akan mengaktifkan kembali karyawan dengan <kbd>ID : <a id="show_id_aktif_karyawan"></a></kbd> dan/apabila melanjutkan proses Submit, data Anda akan tercatat dalam database.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuaktifkaryawan">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Saya Setuju</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-aktif-karyawan" class="btn btn-danger me-sm-3 me-1" onclick="batalNonAktif()"><i class="ti ti-checkbox me-1" style="font-size:13px"></i> Submit</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close" onclick="hideAktifKaryawan()"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let grafik = null; // INITIALIZE GRPH
        $(document).ready(function() {
            // TABEL PROFIL PEGAWAI INIT
            refresh();
        });

        // FUNCTION-FUNCTION
        const badgeColors = [
            'bg-primary',
            'bg-info',
            'bg-warning',
            'bg-success',
            'bg-danger',
            'bg-secondary'
        ];

        const roleColorMap = {};

        /**
         * Ambil warna badge berdasarkan nama role
         */
        function getBadgeColor(roleName) {

            if (!roleColorMap[roleName]) {

                let index = Object.keys(roleColorMap).length % badgeColors.length;

                roleColorMap[roleName] = badgeColors[index];
            }

            return roleColorMap[roleName];
        }

        /**
         * Generate HTML badge role
         */
        function renderRoleBadges(roles = []) { // PENGGUNAAN = renderRoleBadges(item.roles) => didalan foreach show;

            if (!roles.length) {
                return `<span class="text-muted">-</span>`;
            }

            return roles.map(role => {

                let roleName = role.deskripsi ?? role.name;

                let color = getBadgeColor(roleName);

                return `
                    <span class="badge rounded-pill ${color}-transparent me-1">
                        ${roleName}
                    </span>
                `;

            }).join('');
        }

        function refresh() {
            $('#btn-tabel-simpel').find('i').addClass('fa-spin');
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="9" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/sdi/profilpegawai/table",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = "<tr id='data" + item.id + "'>";
                        colBtn = '';
                        stt = '';
                        if (item.nik) {
                            colBtn = 'primary';
                        } else {
                            colBtn = 'warning';
                        }
                        if (item.status != null || item.deleted_at != null) {
                            stt = `<span class="badge bg-danger-transparent fs-14">Akun Dinonaktifkan</span>`;
                            colBtn = 'danger';
                        } else {
                            stt = `<span class="badge bg-success-transparent fs-14">Akun Aktif</span>`;
                        }
                        content += `<td><center><div class='btn-group'>
                                        <a href='javascript:void(0);' class='link-${colBtn} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</a>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                            content += `<li><a href="/v4/sdi/profilpegawai/${item.id}" class='dropdown-item text-success'><i class="fa-fw fas fa-search nav-icon me-1"></i> Lihat Profil</a></li>`;
                            // content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="nonaktif(` + item.id + `)"><i class="fa-fw fas fa-trash nav-icon me-1"></i> Nonaktif</a></li>`;
                        content += `</div></center></td>`;
                        content += `<td class="text-truncate">${item.name}</td>`;
                        content += `<td class="text-truncate"><b class='text-${colBtn}'>${item.nama?item.nama:'Data Belum Lengkap'}</b></td>`;
                        content += `<td>${renderRoleBadges(item.roles)}</td>`;

                        content += `<td>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0 text-truncate'>${stt}</a>
                                                <small class='text-muted text-wrap ms-1'>${item.nama_penghapus?'Oleh '+item.nama_penghapus:''}</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += '<td>' + new Date(item.updated_at).toLocaleString("sv-SE") + '</td>';
                        content += `</tr>`;
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [4, "asc"],
                            [5, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '10%' },
                            { sWidth: '15%' },
                            { sWidth: '30%' },
                            { sWidth: '20%' },
                            { sWidth: '10%' },
                            { sWidth: '15%' },
                        ],
                        displayLength: 15,
                    });

                    // Set True / False Table
                    $("#table1").prop('hidden',false);
                    $("#table2").prop('hidden',true);
                    $('#btn-tabel-simpel').find('i').removeClass('fa-spin');
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Proses memuat Data Gagal!',
                        position: 'topRight'
                    });
                    $('#btn-tabel-simpel').find('i').removeClass('fa-spin');
                }
            });
        }

        function showAll() {
            $('#btn-tabel-lengkap').find('i').removeClass('fa-infinity').addClass('fa-sync fa-spin');
            $("#tampil-tbody-all").empty().append(
                `<tr><td colspan="20" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/sdi/profilpegawai/tableall",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-all").empty();
                    $('#dttable-all').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        // var us = JSON.parse(res.user);
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        if (item.nik) {
                            colBtn = 'primary';
                        } else {
                            colBtn = 'warning';
                        }
                        if (item.status != null || item.deleted_at != null) {
                            colBtn = 'danger';
                        }
                        content += `<td><center><div class='btn-group'>
                                        <a href='javascript:void(0);' class='link-${colBtn} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</a>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                            content += `<li><a href="/v4/sdi/profilpegawai/${item.id}" class='dropdown-item text-success'><i class="fa-fw fas fa-search nav-icon me-1"></i> Lihat Profil</a></li>`;
                        content += `</div></center></td>`;
                        content += `<td>${item.nip?item.nip:'-'}</td>`;
                        content += `<td>${item.nik?item.nik:'-'}</td>`;
                        content += `<td>${item.name}</td>`;
                        if (item.nama_lengkap) {
                            pNama = item.nama_lengkap;
                        } else {
                            if (item.nama) {
                                pNama = item.nama;
                            } else {
                                pNama = '-';
                            }
                        }
                        content += `<td class="text-${colBtn}">${pNama}</td>`;
                        content += `<td>${item.nick?item.nick:'-'}</td>`;
                        content += `<td>${item.temp_lahir?item.temp_lahir:'-'}${item.tgl_lahir?', '+item.tgl_lahir:''}</td>`;
                        content += `<td>${item.jns_kelamin?item.jns_kelamin:'-'}</td>`;
                        content += `<td>${item.status_kawin?item.status_kawin:'-'}</td>`;
                        content += `<td>${item.status_pegawai?item.status_pegawai:'-'}</td>`;
                        content += `<td>${renderRoleBadges(item.roles)}</td>`;
                        content += `<td>${item.klasifikasi_user?item.klasifikasi_user:'-'}</td>`;
                        content += `<td>${item.masuk_kerja?item.masuk_kerja:'-'}</td>`;
                        content += `<td>${item.urutan_masuk?item.urutan_masuk:'-'}</td>`;
                        content += `<td>${item.tmt?item.tmt:'-'}</td>`;
                        content += `<td>${item.tat?item.tat:'-'}</td>`;
                        content += `<td>${item.no_hp?item.no_hp:'-'}</td>`;
                        content += `<td>${item.email?item.email:'-'}</td>`;
                        content += `<td>${item.fb?item.fb:'-'}</td>`;
                        content += `<td>${item.ig?item.ig:'-'}</td>`;
                        content += `<td>${item.tt?item.tt:'-'}</td>`;
                        content += `<td>${item.ktp_kelurahan?item.ktp_kelurahan:'-'}</td>`;
                        content += `<td>${item.ktp_kecamatan?item.ktp_kecamatan:'-'}</td>`;
                        content += `<td>${item.ktp_kabupaten?item.ktp_kabupaten:'-'}</td>`;
                        content += `<td>${item.ktp_provinsi?item.ktp_provinsi:'-'}</td>`;
                        content += `<td>${item.alamat_ktp?item.alamat_ktp:'-'}</td>`;
                        content += `<td>${item.dom_kelurahan?item.dom_kelurahan:'-'}</td>`;
                        content += `<td>${item.dom_kecamatan?item.dom_kecamatan:'-'}</td>`;
                        content += `<td>${item.dom_kabupaten?item.dom_kabupaten:'-'}</td>`;
                        content += `<td>${item.dom_provinsi?item.dom_provinsi:'-'}</td>`;
                        content += `<td>${item.alamat_dom?item.alamat_dom:'-'}</td>`;
                        content += `<td>${item.sd?item.sd:'-'} ${item.th_sd?' ('+item.th_sd+')':''}</td>`;
                        content += `<td>${item.smp?item.smp:'-'} ${item.th_smp?' ('+item.th_smp+')':''}</td>`;
                        content += `<td>${item.sma?item.sma:'-'} ${item.th_sma?' ('+item.th_sma+')':''}</td>`;
                        content += `<td>${item.d1?item.d1:'-'} ${item.th_d1?' ('+item.th_d1+')':''}</td>`;
                        content += `<td>${item.d2?item.d2:'-'} ${item.th_d2?' ('+item.th_d2+')':''}</td>`;
                        content += `<td>${item.d3?item.d3:'-'} ${item.th_d3?' ('+item.th_d3+')':''}</td>`;
                        content += `<td>${item.d4?item.d4:'-'} ${item.th_d4?' ('+item.th_d4+')':''}</td>`;
                        content += `<td>${item.s1?item.s1:'-'} ${item.th_s1?' ('+item.th_s1+')':''}</td>`;
                        content += `<td>${item.s1_profesi?item.s1_profesi:'-'} ${item.th_s1_profesi?' ('+item.th_s1_profesi+')':''}</td>`;
                        content += `<td>${item.s2?item.s2:'-'} ${item.th_s2?' ('+item.th_s2+')':''}</td>`;
                        content += `<td>${item.s3?item.s3:'-'} ${item.th_s3?' ('+item.th_s3+')':''}</td>`;
                        content += `<td>${item.pengalaman_kerja?item.pengalaman_kerja:'-'}</td>`;
                        content += `<td>${item.riwayat_penyakit?item.riwayat_penyakit:'-'}</td>`;
                        content += `<td>${item.riwayat_penyakit_keluarga?item.riwayat_penyakit_keluarga:'-'}</td>`;
                        content += `<td>${item.riwayat_operasi?item.riwayat_operasi:'-'}</td>`;
                        content += `<td>${item.riwayat_penggunaan_obat?item.riwayat_penggunaan_obat:'-'}</td>`;
                        content += '<td>' + new Date(item.updated_at).toLocaleString("sv-SE") + '</td>';
                        content += `</tr>`;
                        $('#tampil-tbody-all').append(content);
                    });
                    var table = $('#dttable-all').DataTable({
                        order: [
                            [10, "asc"],
                            [47, "desc"],
                            [4, "asc"],
                        ],
                        // bAutoWidth: false,
                        // aoColumns : [
                        //     { sWidth: '10%' },
                        //     { sWidth: '20%' },
                        //     { sWidth: '55%' },
                        //     { sWidth: '15%' },
                        // ],
                        columnDefs: [
                            { visible: false, targets: [5] },
                            { visible: false, targets: [7] },
                            { visible: false, targets: [8] },
                            { visible: false, targets: [11] },
                            { visible: false, targets: [12] },
                            { visible: false, targets: [13] },
                            { visible: false, targets: [14] },
                            { visible: false, targets: [15] },
                            { visible: false, targets: [17] },
                            { visible: false, targets: [18] },
                            { visible: false, targets: [19] },
                            { visible: false, targets: [20] },
                            { visible: false, targets: [21] },
                            { visible: false, targets: [22] },
                            { visible: false, targets: [23] },
                            { visible: false, targets: [24] },
                            { visible: false, targets: [26] },
                            { visible: false, targets: [27] },
                            { visible: false, targets: [28] },
                            { visible: false, targets: [29] },
                            { visible: false, targets: [30] },
                            { visible: false, targets: [31] },
                            { visible: false, targets: [32] },
                            { visible: false, targets: [33] },
                            { visible: false, targets: [34] },
                            { visible: false, targets: [35] },
                            { visible: false, targets: [36] },
                            { visible: false, targets: [37] },
                            { visible: false, targets: [38] },
                            { visible: false, targets: [39] },
                            { visible: false, targets: [40] },
                            { visible: false, targets: [41] },
                            { visible: false, targets: [42] },
                            { visible: false, targets: [43] },
                            { visible: false, targets: [44] },
                            { visible: false, targets: [45] },
                            { visible: false, targets: [46] },
                        ],
                        displayLength: 20,
                    });

                    // Set True / False Table
                    $("#table1").prop('hidden',true);
                    $("#table2").prop('hidden',false);
                    $('#btn-tabel-lengkap').find('i').removeClass('fa-sync fa-spin').addClass('fa-infinity');
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Proses memuat Data Gagal!',
                        position: 'topRight'
                    });
                    $('#btn-tabel-lengkap').find('i').removeClass('fa-sync fa-spin').addClass('fa-infinity');
                }
            });
        }

        function showNonAktif() {
            $('#nonaktif').modal('show');
            $.ajax({
                url: "/api/v4/sdi/profilpegawai/nonaktif",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-nonaktif").empty();
                    $('#dttable-nonaktif').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        let urlShow = `/v4/sdi/profilpegawai/${item.id}`;
                        let content = `
                            <tr>
                                <td><center>${item.id}</center></td>
                                <td>${item.name}</td>
                                <td>${item.nama ? item.nama : '-'}</td>
                                <td>${new Date(item.deleted_at).toLocaleString("sv-SE")}</td>
                                <td>
                                    <center>
                                        <div class='btn-group'>
                                            <a href="${urlShow}" class='btn btn-sm btn-info-transparent'>
                                                <i class='fa-fw fas fa-file-archive nav-icon'></i> Lihat Profil
                                            </a>
                                            <a href='javascript:void(0);' class='btn btn-sm btn-success-transparent' onclick="showAktifKaryawan(${item.id})">
                                                <i class='fa-fw fas fa-user-check nav-icon'></i> Aktifkan
                                            </a>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        `;
                        $('#tampil-tbody-nonaktif').append(content);
                    });
                    var table = $('#dttable-nonaktif').DataTable({
                        order: [
                            [3, "desc"]
                        ],
                        displayLength: 10,
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Proses memuat Data Gagal!',
                        position: 'topRight'
                    });
                }
            })
        }

        function showNonLengkap() {
            $('#nonlengkap').modal('show');
            $.ajax({
                url: "/api/v4/sdi/profilpegawai/nonlengkap",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-nonlengkap").empty();
                    $('#dttable-nonlengkap').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = `<tr>
                                    <td><center>` + item.id + `</center></td>
                                    <td>` + item.name + `</td>
                                    <td>` + new Date(item.created_at).toLocaleString("sv-SE") + `</td></tr>`;
                        $('#tampil-tbody-nonlengkap').append(content);
                    })
                    var table = $('#dttable-nonlengkap').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '15%' },
                            { sWidth: '60%' },
                            { sWidth: '25%' },
                        ],
                        displayLength: 10,
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Proses memuat Data Gagal!',
                        position: 'topRight'
                    });
                }
            })
        }

        function refreshNonAktif() {
            $("#tampil-tbody-nonaktif").empty().append(
                `<tr><td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/sdi/profilpegawai/nonaktif",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-nonaktif").empty();
                    $('#dttable-nonaktif').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = `
                                <tr>
                                    <td><center>` + item.id + `</center></td>
                                    <td>` + item.name + `</td>
                                    <td>` + item.nama + `</td>
                                    <td>` + new Date(item.deleted_at).toLocaleString("sv-SE") +
                            `</td>
                                    <td><center><a href='javascript:void(0);' class='btn btn-sm btn-primary-transparent' onclick="showAktifKaryawan(` +
                            item.id + `)"><i class='fa-fw fas fa-user-check nav-icon'></i> Aktifkan</a></center></td>
                                </tr>
                            `;
                        $('#tampil-tbody-nonaktif').append(content);
                    })
                    var table = $('#dttable-nonaktif').DataTable({
                        order: [
                            [3, "desc"]
                        ],
                        displayLength: 10,
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Proses memuat Data Gagal!',
                        position: 'topRight'
                    });
                }
            })
        }

        function refreshNonLengkap() {
            $("#tampil-tbody-nonlengkap").empty().append(
                `<tr><td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/sdi/profilpegawai/nonlengkap",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-nonlengkap").empty();
                    $('#dttable-nonlengkap').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = `<tr>
                                    <td><center>` + item.id + `</center></td>
                                    <td>` + item.name + `</td>
                                    <td>` + new Date(item.created_at).toLocaleString("sv-SE") + `</td></tr>`;
                        $('#tampil-tbody-nonlengkap').append(content);
                    })
                    var table = $('#dttable-nonlengkap').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '15%' },
                            { sWidth: '60%' },
                            { sWidth: '25%' },
                        ],
                        displayLength: 10,
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Proses memuat Data Gagal!',
                        position: 'topRight'
                    });
                }
            })
        }

        function showAktifKaryawan(id) {
            $("#id_aktif_karyawan").val(id);
            $("#show_id_aktif_karyawan").text(id);
            var inputs = document.getElementById('setujuaktifkaryawan');
            inputs.checked = false;
            $('#nonaktif').modal('hide');
            $('#aktifKaryawan').modal('show');
        }

        function hideAktifKaryawan() {
            $('#nonaktif').modal('show');
            $('#aktifKaryawan').modal('hide');
        }

        function batalNonAktif() {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuaktifkaryawan').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk melakukan pengaktifan karyawan kembali',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_aktif_karyawan").val();
                $.ajax({
                    url: "/api/v4/sdi/profilpegawai/{{ Auth::user()->id }}/setaktif/"+id,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'User ID : '+id+' sukses di Aktifkan kembali pada '+ res,
                            position: 'topRight'
                        });
                        $('#aktifKaryawan').modal('hide');
                        refreshNonAktif();
                        refresh();
                        $('#nonaktif').modal('show');
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Gagal mengaktifkan Pegawai!',
                            position: 'topRight'
                        });
                    }
                })
            }
        }

        // -----------------------   GRAFIK  ------------------------
        function loadGrafik(id, title) {

            $.ajax({
                url: "/api/v4/sdi/profilpegawai/grafik/" + id,
                type: "GET",
                dataType: "json",

                success: function(res) {

                    $('#show-card-grafik').prop('hidden', false);
                    $('#btn-show-grafik').prop('disabled', true);

                    // destroy chart sebelumnya
                    if (grafik) {
                        grafik.destroy();
                    }

                    // total data
                    let total = res.series.reduce((a, b) => a + b, 0);
                    let isManyData = res.series.length > 8;

                    // =========================
                    // APEX RADIAL CUSTOM ANGLE
                    // =========================
                    var options = {

                        series: res.series,

                        chart: {
                            height: 420,
                            type: isManyData ? 'donut' : 'radialBar',
                            animations: {
                                enabled: true,
                                easing: 'easeinout',
                                speed: 800
                            },
                            toolbar: {
                                show: false
                            }
                        },

                        labels: res.labels,

                        colors: [
                            "#4680FF",
                            "#FFB946",
                            "#4BC0C0",
                            "#FF6384",
                            "#9966FF",
                            "#212529",
                            "#FF8BF2",
                            "#3EFF73",
                            "#00C49F",
                            "#F95F53"
                        ],

                        plotOptions: isManyData ? {

                            // =========================
                            // DONUT CHART (DATA BANYAK)
                            // =========================
                            pie: {

                                donut: {
                                    size: '65%',
                                },

                                expandOnClick: true
                            }

                        } : {

                            // =========================
                            // RADIAL BAR (DATA SEDIKIT)
                            // =========================
                            radialBar: {

                                offsetY: 0,

                                startAngle: 0,
                                endAngle: 270,

                                hollow: {
                                    margin: 5,
                                    size: '22%',
                                    background: 'transparent',
                                },

                                track: {
                                    background: "#f2f2f2",
                                    strokeWidth: '90%',
                                    margin: 5,
                                },

                                dataLabels: {

                                    name: {
                                        show: true,
                                        fontSize: '12px',
                                        offsetY: 2
                                    },

                                    value: {
                                        show: true,
                                        fontSize: '14px',
                                        fontWeight: 600,

                                        formatter: function(val) {
                                            return parseInt(val);
                                        }
                                    },

                                    total: {
                                        show: true,
                                        label: 'Total',

                                        formatter: function(w) {
                                            return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                        }
                                    }
                                }
                            }

                        },

                        legend: {

                            show: true,
                            floating: false,
                            fontSize: isManyData ? '11px' : '13px',
                            position: 'bottom',

                            labels: {
                                useSeriesColors: true,
                            },

                            markers: {
                                size: isManyData ? 6 : 10
                            },

                            formatter: function(seriesName, opts) {

                                let value = opts.w.globals.series[opts.seriesIndex];

                                let percent = total > 0
                                    ? ((value / total) * 100).toFixed(1)
                                    : 0;

                                // jika kategori banyak
                                if (isManyData) {
                                    return `${seriesName} (${value})`;
                                }

                                // jika kategori sedikit
                                return `${seriesName}: ${value} Pegawai (${percent}%)`;
                            },

                            itemMargin: {
                                vertical: 4
                            }
                        },

                        responsive: [
                            {
                                breakpoint: 992,
                                options: {
                                    chart: {
                                        height: 360
                                    }
                                }
                            },

                            {
                                breakpoint: 576,
                                options: {

                                    chart: {
                                        height: 300
                                    },

                                    legend: {
                                        position: 'bottom',
                                        fontSize: '11px'
                                    },

                                    plotOptions: {
                                        radialBar: {
                                            dataLabels: {
                                                name: {
                                                    fontSize: '10px'
                                                },
                                                value: {
                                                    fontSize: '11px'
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        ]
                    };

                    // render chart
                    grafik = new ApexCharts(
                        $("#grafik-show")[0],
                        options
                    );

                    grafik.render();

                    // =========================
                    // TITLE
                    // =========================
                    $('#show-name-grafik').html(
                        `${title}
                        ${res.belumMasuk != 0
                            ? '<b class="text-danger">(' + res.belumMasuk + ' pegawai belum diinput)</b>'
                            : '<b class="text-success">(Data Seluruh Pegawai)</b>'
                        }`
                    );

                    // =========================
                    // LIST DETAIL
                    // =========================
                    let chartColors = options.colors;

                    let listHTML = "";

                    res.labels.forEach(function(label, i) {

                        let jumlah = res.series[i];

                        let persen = total > 0
                            ? ((jumlah / total) * 100).toFixed(1)
                            : 0;

                        listHTML += `
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">

                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s">
                                            <i class="ti ti-player-record f-40"
                                            style="color:${chartColors[i]}"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <div class="row g-1">

                                            <div class="col-6">
                                                <h6 class="text-dark mb-1">
                                                    ${label}
                                                </h6>

                                                <a class="text-muted">
                                                    <i>REFID # ${res.refid[i]}</i>
                                                </a>
                                            </div>

                                            <div class="col-6 text-end">

                                                <h6 class="mb-1">
                                                    <b class="text-${jumlah == 0 ? 'dark' : 'danger'}">
                                                        ${jumlah}
                                                    </b>
                                                    Pegawai
                                                </h6>

                                                <a class="text-success mb-0">
                                                    ${persen}%
                                                </a>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </li>
                        `;
                    });

                    $("#list-grafik").html(listHTML);
                }
            });
        }

        function showGrafikJenisPegawai() { loadGrafik(1, "Berdasarkan Jenis Pegawai"); }
        function showGrafikJenisKelamin() { loadGrafik(2, "Berdasarkan Jenis Kelamin"); }
        function showGrafikPendidikan()   { loadGrafik(3, "Berdasarkan Pendidikan"); }
        function showGrafikProfesi()      { loadGrafik(4, "Berdasarkan Profesi"); }
        function showGrafikStatusPegawai(){ loadGrafik(5, "Berdasarkan Status Pegawai"); }
        function showGrafikStatusKawin()  { loadGrafik(6, "Berdasarkan Status Perkawinan"); }

        function hideGrafik() {
            $('#show-card-grafik').prop('hidden', true);
            $('#btn-show-grafik').prop('disabled', false);
        }
    </script>
@endsection
