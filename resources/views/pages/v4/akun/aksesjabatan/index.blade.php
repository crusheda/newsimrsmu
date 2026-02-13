@extends('layouts.v4')

@section('content')
    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0">
                    Pengaturan <b class="text-primary">Akses</b> & <b class="text-pink">Jabatan</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a role="button">Akun Pengguna</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
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
                                        <button class="btn btn-info" onclick="showJabatan()" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="bottom" data-bs-html="true" title="Tambah Jabatan"><i
                                                class="bx bxs-traffic-barrier"></i></button>
                                        <button class="btn btn-outline-warning" onclick="showDaftarJabatan()" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                            title="Lihat Daftar Jabatan"><i class="bx bx-detail"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="formSync">
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="" class ="form-label">Pilih Salah Satu <b>Jabatan</b></label>
                                        <br>
                                        <select class="select2 form-control" id="aksesjabatan-jabatan" style="width: 100%" data-bs-auto-close="outside" required></select>
                                        <br>
                                        <small>Refresh browser apabila tidak ditemukan <kbd>Jabatan</kbd> yang baru saja ditambahkan.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="" class ="form-label">Pilih <b>Akses</b> (Bisa lebih dari satu)</label>
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="selectAll()">Select All</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="deselectAll()">Deselect All</button>
                                        <br>
                                        <select id="aksesjabatan-akses" class="select2 form-control" data-bs-auto-close="outside"
                                            required multiple="multiple" style="width: 100%"></select>
                                        <br>
                                        <small>Refresh browser apabila tidak ditemukan <kbd>Akses</kbd> yang baru saja ditambahkan.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-primary" id="btn-simpan-sync" onclick="tambahAksesJabatan()"><i
                                        class="fa-fw fas fa-save nav-icon"></i> Tambah</button>
                                <button class="btn btn-outline-dark" onclick="syncJabatanAkses(false)"><i
                                        class="fa-fw fas fa-times nav-icon"></i> Sembunyikan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body position-relative text-nowrap">
                        <table id="dttable" class="table dt-responsive table-hover display w-100">
                            <thead>
                                <tr>
                                    <th class="cell-fit">JABATAN</th>
                                    <th>AKSES</th>
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
                                    <th class="cell-fit">JABATAN</th>
                                    <th>AKSES</th>
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
                    <label for="" class ="form-label">Akses</label>
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
                    <label for="" class ="form-label">Jabatan</label>
                    <input type="text" id="inp-jabatan" class="form-control" placeholder="Masukkan nama jabatan"
                        required>
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
                                    <th class="cell-fit">ID</th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">UPDATE</th>
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
                                    <th class="cell-fit">ID</th>
                                    <th class="cell-fit">NAME</th>
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
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                                    <th class="cell-fit">UPDATE</th>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-jabatan">
                                <tr>
                                    <td colspan="9">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit">ID</th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">UPDATE</th>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                </tr>
                            </tfoot>&nbsp;
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
            if (params == true) {
                $('#btn-tampil-sync').prop("disabled",true);
                $('#btn-tampil-sync').toggleClass('btn-primary btn-secondary');
                $(".select2").select2({
                    placeholder: "",
                    allowClear: true
                }).val('').trigger('change');
                $("#formSync").collapse("show");
                // console.log($("#formSync").collapse());
            } else {
                if (params == false) {
                    $('#btn-tampil-sync').toggleClass('btn-secondary btn-primary');
                    $('#btn-tampil-sync').prop("disabled",false);
                    $("#formSync").collapse("hide");
                } else {
                    $('#btn-tampil-sync').removeClass('btn-secondary btn-primary').addClass('btn-primary');
                    $('#btn-tampil-sync').prop("disabled",false);
                    $("#formSync").collapse("hide");
                }
            }
        }

        function refresh() {
            if ($.fn.DataTable.isDataTable('#dttable')) {
                $('#dttable').DataTable().clear().destroy();
            }
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/aksesjabatan/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    res.show.forEach(item => {
                        content = `<tr><td>` + item.name + `</td><td>`;
                        res.selection.forEach(val => {
                            if (val.id_role == item.role_id) {
                                content += `<span class="badge bg-dark">` + val.name_permission + `</span>&nbsp;`;
                            }
                        })
                        content +=
                            `</td><td><center><a href='javascript:void(0);' class='btn btn-danger-light btn-sm' onclick="hapusAksesJabatan(` +
                            item.role_id +
                            `)"><i class="fa-fw fas fa-undo nav-icon"></i> Reset</a></center></td></tr>`;
                        $('#tampil-tbody').append(content);
                    })
                    var table = $('#dttable').DataTable({
                        dom: 'Bfrtip',
                        order: [
                            [0, "asc"]
                        ],
                        columnDefs: [
                            { width: "30%", targets: 0 },
                            { width: "60%", targets: 1 },
                            { width: "10%", targets: 2 },
                        ],
                        displayLength: 15,
                        lengthChange: true,
                        lengthMenu: [15, 25, 50, 75, 100, 300 ,500, 750, 1000, 10000],
                        buttons: ['copy', 'excel', 'pdf', 'colvis'],
                        language: {
                            searchPlaceholder: 'Cari Data...',
                            sSearch: '',
                        },
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }
            })
        }

        function refreshAkses() {
            $("#tampil-tbody-akses").empty().append(
                `<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/aksesjabatan/akses/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-akses").empty();
                    $('#dttable-akses').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = `
                                <tr>
                                    <td>` + item.id + `</td>
                                    <td>` + item.name + `</td>
                                    <td>` + item.updated_at.substring(0, 19).replace('T', ' ') +
                            `</td>
                                    <td><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapusAkses(` +
                            item.id + `)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></td>
                                </tr>
                            `;
                        $('#tampil-tbody-akses').append(content);
                    })
                    var table = $('#dttable-akses').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    table.buttons().container()
                        .appendTo('#dttable-akses_wrapper .col-md-6:eq(0)');

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }
            })
        }

        function refreshJabatan() {
            $("#tampil-tbody-jabatan").empty().append(
                `<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/aksesjabatan/jabatan/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-jabatan").empty();
                    $('#dttable-jabatan').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = `
                                <tr>
                                    <td>` + item.id + `</td>
                                    <td>` + item.name + `</td>
                                    <td>` + item.updated_at.substring(0, 19).replace('T', ' ') +
                            `</td>
                                    <td><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapusJabatan(` +
                            item.id + `)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></td>
                                </tr>
                            `;
                        $('#tampil-tbody-jabatan').append(content);
                    })
                    var table = $('#dttable-jabatan').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    table.buttons().container()
                        .appendTo('#dttable-jabatan_wrapper .col-md-6:eq(0)');

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }
            })
        }

        // $("#tambah").one('submit', function() {
        //     $("#btn-simpan").attr('disabled', 'disabled');
        //     $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
        //     return true;
        // });

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
                    error: function (res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: res.responseJSON.error,
                            position: 'topRight'
                        });
                    }
                });
            }
        }
        function tambahJabatan() {
            var jabatan = $("#inp-jabatan").val();
            var user = '{{ Auth::user()->nama }}';

            if (jabatan == "") {
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
                    error: function (res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: res.responseJSON.error,
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
                    error: function (res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: res.responseJSON.error,
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        // MODAL OPEN
        function showAkses() {
            $('.modal').modal('hide');
            $('#formTambahAkses').modal('show');
        }

        function showJabatan() {
            $('.modal').modal('hide');
            $('#formTambahJabatan').modal('show');
        }

        function showDaftarAkses() {
            syncJabatanAkses();
            $('#daftarAkses').modal('show');
            $.ajax({
                url: "/api/v4/aksesjabatan/akses/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-akses").empty();
                    $('#dttable-akses').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = `
                                <tr>
                                    <td>` + item.id + `</td>
                                    <td>` + item.name + `</td>
                                    <td>` + item.updated_at.substring(0, 19).replace('T', ' ') +
                            `</td>
                                    <td><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapusAkses(` +
                            item.id + `)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></td>
                                </tr>
                            `;
                        $('#tampil-tbody-akses').append(content);
                    })
                    var table = $('#dttable-akses').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    table.buttons().container()
                        .appendTo('#dttable-akses_wrapper .col-md-6:eq(0)');

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }
            })
        }

        function showDaftarJabatan() {
            syncJabatanAkses();
            $('#daftarJabatan').modal('show');
            $.ajax({
                url: "/api/v4/aksesjabatan/jabatan/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-jabatan").empty();
                    $('#dttable-jabatan').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = `
                                <tr>
                                    <td>` + item.id + `</td>
                                    <td>` + item.name + `</td>
                                    <td>` + item.updated_at.substring(0, 19).replace('T', ' ') +
                            `</td>
                                    <td><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapusJabatan(` +
                            item.id + `)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></td>
                                </tr>
                            `;
                        $('#tampil-tbody-jabatan').append(content);
                    })
                    var table = $('#dttable-jabatan').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    table.buttons().container()
                        .appendTo('#dttable-jabatan_wrapper .col-md-6:eq(0)');

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }
            })
        }

        // HAPUS AKSES JABATAN
        function hapusAksesJabatan(id) {
            iziToast.error({
                title: 'Pesan Perhatian!',
                message: 'Maaf, Reset belum tersedia untuk saat ini. Silakan tunggu Update selanjutnya :)',
                position: 'topRight'
            });
            // Swal.fire({
            //     title: 'Apakah anda yakin?',
            //     text: 'Hapus Permanen Akses Jabatan ID : ' + id,
            //     icon: 'warning',
            //     reverseButtons: false,
            //     showDenyButton: false,
            //     showCloseButton: false,
            //     showCancelButton: true,
            //     focusCancel: true,
            //     confirmButtonColor: '#FF4845',
            //     confirmButtonText: `<i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus`,
            //     cancelButtonText: `<i class="fa fa-times me-1" style="font-size:13px"></i>  Batal`,
            //     backdrop: `rgba(26,27,41,0.8)`,
            // }).then((result) => {
            //     if (result.isConfirmed) {
            //         $.ajax({
            //             url: "/api/v4/aksesjabatan/hapus/" + id,
            //             type: 'GET',
            //             dataType: 'json', // added data type
            //             success: function(res) {
            //                 iziToast.success({
            //                     title: 'Sukses!',
            //                     message: 'Hapus Akses Jabatan berhasil pada ' + res,
            //                     position: 'topRight'
            //                 });
            //                 refresh();
            //             },
            //             error: function(res) {
            //                 iziToast.error({
            //                     title: 'Pesan Galat!',
            //                     message: 'Hapus Akses Jabatan gagal!',
            //                     position: 'topRight'
            //                 });
            //             }
            //         });
            //     }
            // })
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
                        error: function(res) {
                            Swal.fire({
                                title: `Gagal di hapus!`,
                                text: 'Pada ' + res,
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
                        error: function(res) {
                            Swal.fire({
                                title: `Gagal di hapus!`,
                                text: 'Pada ' + res,
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
