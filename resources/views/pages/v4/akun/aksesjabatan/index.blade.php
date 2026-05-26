@extends('layouts.v4')

@section('content')
    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Pengaturan <b class="text-info link-underline-info text-decoration-underline">Akses</b> & <b class="text-pink link-underline-pink text-decoration-underline">Jabatan</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Setting</a>
                    </li>
                    <li class="breadcrumb-item pe-none" aria-current="page">
                        Manajemen Akun
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Akses & Jabatan
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body p-3 pb-2 text-nowrap">
                        <div class="card-title">
                            <div class="d-flex">
                                <div class="btn-group">
                                    {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formSync"><i
                                            class="bx bxs-magnet"></i>&nbsp;&nbsp;Sinkronisasi <span class="badge bg-light">Jabatan x Akses</span></button> --}}
                                    <button class="btn btn-primary" onclick="syncJabatanAkses(true)" id="btn-tampil-sync"><i
                                            class="bx bxs-magnet"></i>&nbsp;&nbsp;Sinkronisasi <span class="badge bg-light text-dark">Jabatan x Akses</span></button>
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#info" disabled><i
                                            class="bx bxs-info-circle"></i>&nbsp;&nbsp;Kamus Akses</button>
                                    <button type="button" class="btn btn-warning-light btn-wave" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                        data-bs-placement="bottom" data-bs-html="true"
                                        title="<i class='fa-fw fas fa-sync nav-icon'></i> <span>Segarkan</span>" onclick="refresh()">
                                        <i class="fa-fw fas fa-sync nav-icon"></i></button>
                                </div>
                                <div class="hstack gap-3 ms-auto">
                                    <div class="btn-group">
                                        <button class="btn btn-info" onclick="showAkses()" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="bottom" data-bs-html="true" title="Tambah Akses"><i
                                                class="bx bx-key"></i></button>
                                        <button class="btn btn-outline-warning" onclick="showDaftarAkses()" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                            title="Lihat Daftar Akses"><i class="bx bx-spreadsheet"></i></button>
                                    </div>
                                    <div class="vr"></div>
                                    <div class="btn-group">
                                        <button class="btn btn-pink" onclick="showJabatan()" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="bottom" data-bs-html="true" title="Tambah Jabatan"><i
                                                class="bx bxs-traffic-barrier"></i></button>
                                        <button class="btn btn-outline-warning" onclick="showDaftarJabatan()" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                            title="Lihat Daftar Jabatan"><i class="bx bx-detail"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="collapse mb-2" id="formSync">
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">Pilih Salah Satu <b>Jabatan</b></label>
                                        <br>
                                        <select class="select2-jabatan form-control" id="aksesjabatan-jabatan" onchange="loadAksesByJabatan(this.value)" style="width: 100%" data-bs-auto-close="outside" required></select>
                                        <br>
                                        <small>Refresh browser apabila tidak ditemukan <kbd>Jabatan</kbd> yang baru saja ditambahkan.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">Pilih <b>Akses</b> (Bisa lebih dari satu)</label>
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="selectAll()">Select All</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="deselectAll()">Deselect All</button>
                                        <br>
                                        <select id="aksesjabatan-akses" class="select2-akses form-control" data-bs-auto-close="outside"
                                            required multiple="multiple" style="width: 100%"></select>
                                        {{-- <br>
                                        <small>Refresh browser apabila tidak ditemukan <kbd>Akses</kbd> yang baru saja ditambahkan.</small> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-primary" id="btn-simpan-sync" onclick="tambahAksesJabatan()"><i
                                        class="fa-fw fas fa-save nav-icon"></i> Sync</button>
                                <button class="btn btn-outline-dark" onclick="syncJabatanAkses(false)"><i
                                        class="fa-fw fas fa-times nav-icon"></i> Sembunyikan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body position-relative text-nowrap table-responsive">
                        <table id="dttable" class="table table-hover w-100">
                            <thead>
                                <tr>
                                    <th class="cell-fit">IDROLE</th>
                                    <th class="cell-fit">JABATAN</th>
                                    <th>DESKRIPSI</th>
                                    <th>AKSES</th>
                                    <th>USER</th>
                                    <th>TGL. UPDATE</th>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody">
                                <tr>
                                    <td colspan="9">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit">IDROLE</th>
                                    <th class="cell-fit">JABATAN</th>
                                    <th>DESKRIPSI</th>
                                    <th>AKSES</th>
                                    <th>USER</th>
                                    <th>TGL. UPDATE</th>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    {{-- TAMBAH AKSES --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="formTambahAkses" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Tambah Akses
                    </h4>
                    <button type="button" class="btn-close" onclick="closeModal()" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <label for="" class="form-label">Akses</label>
                    <input type="text" id="inp-akses" class="form-control" placeholder="Masukkan nama akses">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-simpan-akses" onclick="tambahAkses()"><i
                            class="fa-fw fas fa-save nav-icon"></i> Tambah</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal()" aria-label="Close"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- TAMBAH JABATAN --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="formTambahJabatan" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Tambah Jabatan
                    </h4>
                    <button type="button" class="btn-close" onclick="closeModal()" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Jabatan (<b class="link-underline-primary text-decoration-underline">Nama Khusus Sistem</b>)</label>
                        <input type="text" id="inp-jabatan" class="form-control" placeholder="e.g. kepala-ruang-xx"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Deskripsi (<b class="link-underline-info text-decoration-underline">Nama Sesuai Struktur Bagian</b>)</label>
                        <input type="text" id="inp-jabatan-deskripsi" class="form-control" placeholder="e.g. Kepala Ruang XXX"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-simpan-jabatan" onclick="tambahJabatan()"><i
                            class="fa-fw fas fa-save nav-icon"></i> Tambah</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal()" aria-label="Close"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- DAFTAR AKSES --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="daftarAkses" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Daftar Akses
                    </h4>
                    <button type="button" class="btn-close" onclick="closeModal()" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive text-nowrap" style="border: 0px">
                        <table id="dttable-akses" class="table dt-responsive table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="cell-fit text-center">ID</th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit"><center>UPDATE</center></th>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-akses">
                                <tr>
                                    <td colspan="9">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit text-center">ID</th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit"><center>UPDATE</center></th>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button class="btn btn-warning" onclick="refreshAkses()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Segarkan"><i
                                class='fa-fw fas fa-sync nav-icon'></i>&nbsp;&nbsp;Segarkan</button>
                        <button class="btn btn-info" onclick="showAkses()" data-bs-toggle="tooltip" data-bs-offset="0,4"
                            data-bs-placement="top" data-bs-html="true" title="Tambah Akses"><i
                                class="bx bxs-plus-square"></i>&nbsp;&nbsp;Tambah Akses</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DAFTAR JABATAN --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="daftarJabatan" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Daftar Jabatan
                    </h4>
                    <button type="button" class="btn-close" onclick="closeModal()" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive text-nowrap" style="border: 0px">
                        <table id="dttable-jabatan" class="table dt-responsive table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="cell-fit">ID</th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">DESKRIPSI</th>
                                    <th class="cell-fit">UPDATE</th>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-jabatan">
                                <tr>
                                    <td colspan="5">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit">ID</th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">DESKRIPSI</th>
                                    <th class="cell-fit">UPDATE</th>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button class="btn btn-warning" onclick="refreshJabatan()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Segarkan"><i
                                class='fa-fw fas fa-sync nav-icon'></i>&nbsp;&nbsp;Segarkan</button>
                        <button class="btn btn-info" onclick="showJabatan()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                            title="Tambah Jabatan"><i class="bx bxs-plus-square"></i>&nbsp;&nbsp;Tambah Jabatan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".select2").select2({
                placeholder: "",
                allowClear: true
            }).val('').trigger('change');

            refresh();
        })

        // MODAL OPEN
        function showAkses() {
            $('.modal').modal('hide');
            $('#formTambahAkses').modal('show');
        }

        function showJabatan() {
            $('.modal').modal('hide');
            $('#formTambahJabatan').modal('show');
        }

        // Select & Deselect All Select2
        function selectAll() {
            $("#aksesjabatan-akses > option").prop("selected", true);
            $("#aksesjabatan-akses").trigger("change");
        }

        function deselectAll() {
            $("#aksesjabatan-akses > option").prop("selected", false);
            $("#aksesjabatan-akses").trigger("change");
        }

        function syncJabatanAkses(params) {

            if (params === true) {

                $('#btn-tampil-sync')
                    .prop("disabled", true)
                    .toggleClass('btn-primary btn-secondary');

                // reset
                $("#aksesjabatan-jabatan").html('<option value="">Loading...</option>');
                $("#aksesjabatan-akses").html('<option value="">Loading...</option>');

                // LOAD JABATAN
                $.ajax({
                    url: '/api/v4/aksesjabatan/jabatan/data',
                    type: 'GET',
                    dataType: 'json',
                    success: function(res){

                        let html = '<option value="">Pilih Jabatan</option>';

                        res.show.forEach(function(item){
                            html += `<option value="${item.id}">${item.name}</option>`;
                        });

                        $("#aksesjabatan-jabatan").html(html).select2({
                            placeholder: "Pilih Jabatan",
                            allowClear: true
                        });
                    }, error: function(xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.error,
                            position: 'topRight'
                        });
                    }
                });

                // LOAD SEMUA AKSES
                $.ajax({
                    url: '/api/v4/aksesjabatan/akses/data',
                    type: 'GET',
                    dataType: 'json',
                    success: function(res){

                        let html = '';

                        res.show.forEach(function(item){
                            html += `<option value="${item.id}">${item.name}</option>`;
                        });

                        $("#aksesjabatan-akses").html(html).select2({
                            placeholder: " Pilih Akses",
                            allowClear: true
                        });
                    }, error: function(xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.error,
                            position: 'topRight'
                        });
                    }
                });

                $("#formSync").collapse("show");

            } else {

                $('#btn-tampil-sync')
                    .toggleClass('btn-secondary btn-primary')
                    .prop("disabled", false);

                $("#formSync").collapse("hide");
            }
        }

        function loadAksesByJabatan(roleId) {

            // loading state
            $("#aksesjabatan-akses").val(null).trigger('change');

            if (!roleId) return;

            $.ajax({
                url: `/api/v4/aksesjabatan/${roleId}/akses`,
                type: 'GET',
                dataType: 'json',
                success: function(res){

                    // reset dulu
                    $("#aksesjabatan-akses option").prop("selected", false);

                    // looping permission yg sudah melekat
                    res.forEach(function(item){
                        $("#aksesjabatan-akses option[value='"+item.id+"']")
                            .prop("selected", true);
                    });

                    // refresh select2
                    $("#aksesjabatan-akses").trigger("change");
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.error,
                        position: 'topRight'
                    });
                }
            });
        }

        function refresh() {
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/aksesjabatan/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();

                    res.forEach(item => {

                        /* ======================
                        PERMISSIONS BADGE
                        ====================== */
                        let badges = '';

                        let colors = [
                            'bg-primary',
                            'bg-info',
                            'bg-warning',
                            'bg-success',
                            'bg-danger',
                            'bg-secondary'
                        ];

                        colors.sort(() => Math.random() - 0.5);

                        item.permissions.forEach((p, i) => {

                            let color = colors[i % colors.length]; // muter warna

                            badges += `<span class="badge rounded-pill ${color}-transparent me-1">${p.name}</span>`;
                        });

                        /* ======================
                        USERS AVATAR
                        ====================== */
                        let avatars = '';
                        let maxShow = 2;
                        let totalUsers = item.users?.length ?? 0;

                        if (totalUsers > 0) {

                            item.users.slice(0, maxShow).forEach(u => {

                                // let foto = u.foto?.filename
                                //     ? `/public/files/foto_profil/${u.foto.filename}`
                                //     : "{{ asset('images/users/user-dummy-img.jpg') }}";
                                let foto = "{{ asset('images/users/user-dummy-img.jpg') }}";

                                let nama = u.nama ?? u.name ?? 'Unknown User';

                                avatars += `
                                    <span class="avatar avatar-rounded avatar-sm bg-light"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        title="${nama}">
                                        <img src="${foto}">
                                    </span>
                                `;
                            });

                            // SISA USER → +X
                            if (totalUsers > maxShow) {

                                let sisa = totalUsers - maxShow;

                                avatars += `
                                    <a class="avatar bg-primary avatar-rounded avatar-sm text-fixed-white"
                                        data-bs-toggle="tooltip"
                                        title="${sisa} user lainnya"
                                        href="javascript:void(0);">
                                        +${sisa}
                                    </a>
                                `;
                            }

                        } else {
                            avatars = '-';
                        }

                        let updated = moment(item.updated_at).local().format('YYYY-MM-DD HH:mm:ss');

                        let content = `
                            <tr>
                                <td>${item.id}</td>
                                <td>${item.name}</td>
                                <td class="text-wrap">${item.deskripsi ?? '-'}</td>
                                <td class="text-wrap">${badges}</td>
                                <td class="text-wrap">
                                    <div class="avatar-list-stacked">
                                        ${avatars}
                                    </div>
                                </td>
                                <td>${updated}</td>
                                <td class="text-center">
                                    <a href="javascript:void(0);"
                                    class="btn btn-danger-light btn-sm"
                                    onclick="hapusAksesJabatan(${item.id})">
                                        Reset
                                    </a>
                                </td>
                            </tr>
                        `;

                        $('#tampil-tbody').append(content);

                        /* TOOLTIP */
                        $('[data-bs-toggle="tooltip"]').tooltip();
                    });

                    $('#dttable').DataTable({
                        destroy: true,
                        order: [[5,"desc"]],
                        displayLength: 15,
                        lengthMenu: [15,25,50,100,300,500],
                    });
                }, error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.error,
                        position: 'topRight'
                    });
                }
            })
        }

        function refreshAkses() {
            if ($.fn.DataTable.isDataTable('#dttable-akses')) {
                $('#dttable-akses').DataTable().clear().destroy();
            }
            $("#tampil-tbody-akses").empty().append(
                `<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/aksesjabatan/akses/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-akses").empty();
                    res.show.forEach(item => {
                        content = `
                                <tr>
                                    <td><center>${item.id}</center></td>
                                    <td>${item.name}</td>
                                    <td><center>${item.updated_at?item.updated_at.substring(0, 19).replace('T', ' '):''}</center></td>
                                    <td><center><a href='javascript:void(0);' class='link-danger' onclick="hapusAkses(${item.id})"><i class="fa-fw fas fa-trash nav-icon me-1"></i> Hapus</a></center></td>
                                </tr>
                            `;
                        $('#tampil-tbody-akses').append(content);
                    })
                    var table = $('#dttable-akses').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        displayLength: 15,
                        lengthChange: true,
                        lengthMenu: [15, 25, 50, 75, 100, 300, 700, 1000]
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.error,
                        position: 'topRight'
                    });
                }
            })
        }

        function refreshJabatan() {
            if ($.fn.DataTable.isDataTable('#dttable-jabatan')) {
                $('#dttable-jabatan').DataTable().destroy();
            }
            $("#tampil-tbody-jabatan").empty().append(
                `<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/aksesjabatan/jabatan/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-jabatan").empty();
                    res.show.forEach(item => {
                        content = `<tr>
                                        <td>${item.id}</td>
                                        <td>${item.name}</td>
                                        <td>${item.deskripsi?item.deskripsi:'-'}</td>
                                        <td>${item.updated_at?item.updated_at.substring(0, 19).replace('T', ' '):''}</td>
                                        <td><center><a href='javascript:void(0);' class='link-danger' onclick="hapusJabatan(${item.id})"><i class="fa-fw fas fa-trash nav-icon me-1"></i> Hapus</a></center></td>
                                    </tr>`;
                        $('#tampil-tbody-jabatan').append(content);
                    })
                    $('#dttable-jabatan').DataTable({
                        order: [[3, "desc"]],
                        displayLength: 15,
                        lengthChange: true,
                        lengthMenu: [15, 25, 50, 75, 100, 300, 700, 1000]
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }, error: function(err) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.error,
                        position: 'topRight'
                    });
                }
            })
        }

        function showDaftarAkses() {
            syncJabatanAkses();
            refreshAkses();
            $('#daftarAkses').modal('show');
        }

        function showDaftarJabatan() {
            syncJabatanAkses();
            refreshJabatan();
            $('#daftarJabatan').modal('show');
        }

        function tambahAkses() {
            var akses = $("#inp-akses").val();
            var user = '{{ Auth::user()->nama }}';

            if (akses == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/v4/aksesjabatan/akses/store',
                    dataType: 'json',
                    data: {
                        akses: akses,
                        user: user,
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Tambah Akses berhasil oleh '+user+' pada '+ res,
                            position: 'topRight'
                        });
                        if (res) {
                            $('.modal').modal('hide');
                            refresh();
                            $("#inp-akses").val('');
                            $('#showDaftarAkses').modal('show');
                            refreshAkses();
                        }
                    },
                    error: function (xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.error,
                            position: 'topRight'
                        });
                    }
                });
            }
        }
        function tambahJabatan() {
            var jabatan = $("#inp-jabatan").val();
            var inp_jabatan_deskripsi = $("#inp-jabatan-deskripsi").val();
            var user = '{{ Auth::user()->nama }}';

            if (jabatan == "" || inp_jabatan_deskripsi == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/v4/aksesjabatan/jabatan/store',
                    dataType: 'json',
                    data: {
                        jabatan: jabatan,
                        deskripsi: inp_jabatan_deskripsi,
                        user: user,
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Tambah Jabatan berhasil oleh '+user+' pada '+ res,
                            position: 'topRight'
                        });
                        if (res) {
                            $('.modal').modal('hide');
                            refresh();
                            $("#inp-jabatan").val('');
                            $('#showDaftarJabatan').modal('show');
                            refreshJabatan();
                        }
                    },
                    error: function (xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.error,
                            position: 'topRight'
                        });
                    }
                });
            }
        }
        function tambahAksesJabatan() {
            var jabatan = $("#aksesjabatan-jabatan").val();
            var akses = $("#aksesjabatan-akses").val();
            var user = '{{ Auth::user()->nama }}';

            if (jabatan == "" || akses == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/v4/aksesjabatan/store',
                    dataType: 'json',
                    data: {
                        jabatan: jabatan,
                        akses: akses,
                        user: user,
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Tambah Akses Jabatan berhasil oleh '+user+' pada '+ res,
                            position: 'topRight'
                        });
                        if (res) {
                            // $('.modal').modal('hide');
                            // $("#aksesjabatan-jabatan").val('').change();
                            // $("#aksesjabatan-akses").val('').change();
                            refresh();
                        }
                    },
                    error: function (xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.error,
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        // HAPUS AKSES JABATAN
        function hapusAksesJabatan(id) {
            // iziToast.error({
            //     title: 'Pesan Perhatian!',
            //     message: 'Maaf, Reset belum tersedia untuk saat ini. Silakan tunggu Update selanjutnya :)',
            //     position: 'topRight'
            // });
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Hapus Permanen Akses Jabatan ID : ' + id,
                icon: 'warning',
                reverseButtons: false,
                showDenyButton: false,
                showCloseButton: false,
                showCancelButton: true,
                focusCancel: true,
                confirmButtonColor: '#FF4845',
                confirmButtonText: `<i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus`,
                cancelButtonText: `<i class="fa fa-times me-1" style="font-size:13px"></i> Batal`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/api/v4/aksesjabatan/hapus/" + id,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Hapus Akses Jabatan berhasil pada ' + res,
                                position: 'topRight'
                            });
                            refresh();
                        },
                        error: function(xhr, status, error) {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: xhr.responseJSON.error,
                                position: 'topRight'
                            });
                        }
                    });
                }
            })
        }

        // HAPUS AKSES
        function hapusAkses(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Hapus Permanen Akses ID : ' + id,
                icon: 'warning',
                reverseButtons: false,
                showDenyButton: false,
                showCloseButton: false,
                showCancelButton: true,
                focusCancel: true,
                confirmButtonColor: '#FF4845',
                confirmButtonText: `<i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus`,
                cancelButtonText: `<i class="fa fa-times me-1" style="font-size:13px"></i>  Batal`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/api/v4/aksesjabatan/akses/hapus/" + id,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Hapus Akses berhasil pada ' + res,
                                position: 'topRight'
                            });
                            refreshAkses();
                            refresh();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: `Gagal di hapus!`,
                                text: xhr.responseJSON.error,
                                icon: `error`,
                                showConfirmButton: false,
                                showCancelButton: false,
                                allowOutsideClick: true,
                                allowEscapeKey: true,
                                timer: 3000,
                                timerProgressBar: true,
                                backdrop: `rgba(26,27,41,0.8)`,
                            });
                        }
                    });
                }
            })
        }

        // HAPUS JABATAN
        function hapusJabatan(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Hapus Permanen Jabatan ID : ' + id,
                icon: 'warning',
                reverseButtons: false,
                showDenyButton: false,
                showCloseButton: false,
                showCancelButton: true,
                focusCancel: true,
                confirmButtonColor: '#FF4845',
                confirmButtonText: `<i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus`,
                cancelButtonText: `<i class="fa fa-times me-1" style="font-size:13px"></i>  Batal`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/api/v4/aksesjabatan/jabatan/hapus/" + id,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Hapus Jabatan berhasil pada ' + res,
                                position: 'topRight'
                            });
                            refreshJabatan();
                            refresh();
                            // $('.modal').modal('hide');
                            // $('#daftarJabatan').modal('show');
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: `Gagal di hapus!`,
                                text: xhr.responseJSON.error,
                                icon: `error`,
                                showConfirmButton: false,
                                showCancelButton: false,
                                allowOutsideClick: true,
                                allowEscapeKey: true,
                                timer: 3000,
                                timerProgressBar: true,
                                backdrop: `rgba(26,27,41,0.8)`,
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection
