@extends('layouts.v4')

@section('content')
    {{-- <style>
        .select2-container{
            z-index:100000;
            width:100%!important;
        }
        .select2-selection { overflow: hidden; }
        .select2-selection__rendered { white-space: normal; word-break: break-all; }
        .btn-group-sm>.btn,.btn-sm {
            --bs-btn-padding-y: 0.05rem;
            --bs-btn-padding-x: 0.5rem;
            --bs-btn-font-size: 0.7109375rem;
            --bs-btn-border-radius: var(--bs-border-radius-sm)
        }
    </style> --}}
    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0">
                    Pengaturan <b class="text-primary link-underline-primary text-decoration-underline">Akun Pengguna</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Manajemen Akun</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Akun Pengguna
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <button class="btn btn-primary btn-wave" onclick="tambah()" id="btn-tambah">
                            <i class="ri-user-add-line me-1"></i> Tambah Akun Pengguna
                        </button>
                        <button class="btn btn-warning btn-wave" onclick="refresh()" id="btn-refresh">
                            <i class="ri-loop-left-line me-1"></i> Segarkan
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dttable" class="table dt-responsive table-hover nowrap w-100" style="font-size:13px">
                                <thead>
                                    <tr>
                                        <th class="cell-fit text-center">ID</th>
                                        <th class="cell-fit">USERNAME</th>
                                        <th>NAMA</th>
                                        <th>EMAIL</th>
                                        <th>ROLE</th>
                                        <th class="cell-fit">TGL. UPDATE</th>
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
                                        <th class="cell-fit text-center">ID</th>
                                        <th class="cell-fit">USERNAME</th>
                                        <th>NAMA</th>
                                        <th>EMAIL</th>
                                        <th>ROLE</th>
                                        <th class="cell-fit">TGL. UPDATE</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="tambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-18">
                        Tambah <b class="text-primary link-underline-primary text-decoration-underline">Akun Pengguna</b>
                    </h4>
                    <button type="button" class="btn-close" onclick="closeModal()" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="mb-3 text-center fs-16">Dimohon untuk membaca <b class="text-danger link-underline-danger text-decoration-underline">Syarat & Ketentuan</b> pembuatan Akun Pengguna!</h5>
                        <div class="col-md-12 mb-3">
                            <div class="alert alert-secondary">
                                <div class="row">
                                    <div class="col">
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Username/Password tidak boleh menggunakan <b>SPASI</b><br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Disarankan untuk menggunakan kombinasi Huruf & Angka
                                    </div>
                                    <div class="col">
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Buat password seunik mungkin agar tidak mudah terbaca oleh orang lain<br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Password akan dienkripsi menggunakan Laravel Bcrypt Hash
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Username <b class="text-danger">*</b></label>
                                <div class="input-group">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Tuliskan Username" required />
                                    <button class="btn btn-outline-primary" type="button" onclick="verifName()">Check</button>
                                </div>
                                <small>Klik tombol <b class="text-primary">Check</b> di atas untuk validasi ketersediaan Username</small>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="defaultFormControlInput" class="form-label">Email <b class="text-danger">*</b></label>
                                <input type="email" name="email" class="form-control" placeholder="Tuliskan Email (xx@xxx.com)" required />
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="defaultFormControlInput" class="form-label">Jabatan <b class="text-danger">*</b></label>
                                <select id="role" name="role[]" class="form-control" data-bs-auto-close="outside"
                                    multiple="multiple" style="width: 100%" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="defaultFormControlInput" class="form-label">Password <b class="text-danger">*</b></label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="password1" minlength="8"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        onpaste="return false" required />
                                    <button class="btn btn-outline-primary" type="button" id="open-password1">
                                        <i class="fas fa-eye-slash" id="icon-password1"></i>
                                    </button>
                                </div>
                                <small>Masukkan password minimal 8 karakter</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="defaultFormControlInput" class="form-label">Retype Password <b class="text-danger">*</b></label>
                                <div class="input-group">
                                    <input type="password" name="repassword" class="form-control" id="password2" minlength="8"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        onpaste="return false" required />
                                    <button class="btn btn-outline-primary" type="button" id="open-password2">
                                        <i class="fas fa-eye-slash" id="icon-password2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex align-items-center justify-content-between">
                    <button class="btn btn-primary" id="btn-simpan" onclick="saveData()" disabled>
                        <i class="fas fa-save fa-md me-1"></i> Simpan Data
                    </button>
                    <button class="btn btn-outline-dark btn-wave" onclick="closeModal()">
                        <i class="fas fa-times me-1"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // $(".select2").select2({
            //     placeholder: "",
            //     allowClear: true
            // }).val('').trigger('change');

            refresh();
        })

        function refresh() {
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );

            const btn = $('#btn-refresh');

            $.ajax({
                url: "/api/v4/akun/pengguna",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function () {
                    btn.prop('disabled', true)
                        .find('i')
                        .addClass('fa-spin');
                },
                success: function(res) {
                    $("#tampil-tbody").empty();

                    res.forEach(item => {

                        /* ======================
                        BADGE
                        ====================== */
                        badges = ``;
                        item.roles.forEach((p, i) => {
                            badges += `<span class="badge rounded-pill bg-primary-transparent me-1">${p.deskripsi}</span>`;
                        })

                        let updated = moment(item.updated_at).local().format('YYYY-MM-DD HH:mm:ss');

                        nama_lengkap = '';
                        if (item.nama_lengkap) {
                            nama_lengkap = item.nama_lengkap;
                        } else if (item.nama) {
                            nama_lengkap = item.nama;
                        } else {
                            nama_lengkap = '-';
                        }

                        let content = `
                            <tr>
                                <td>
                                    <a href="javascript:void(0)" class='link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle'
                                        data-bs-toggle='dropdown' aria-expanded='false'>${item.id}
                                    </a>
                                    <ul class='dropdown-menu dropdown-menu-end'>
                                        <li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="ubah(${item.id})">
                                            <i class="fa-fw fas fa-edit nav-icon me-1"></i> Ubah</a></li>
                                        <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(${item.id})">
                                            <i class="fa-fw fas fa-trash nav-icon me-1"></i> Hapus</a></li>
                                    </ul>
                                </td>
                                <td>${item.name}</td>
                                <td>${nama_lengkap}</td>
                                <td> ${item.email}</td>
                                <td class="text-wrap">${badges}</td>
                                <td class="text-start">${updated}</td>
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
                        language: {
                            searchPlaceholder: 'Cari Data...',
                            sSearch: '',
                        }
                    });
                },
                error: function (xhr) {
                    Swal.fire(
                        'Gagal',
                        xhr.responseJSON?.message ?? 'Terjadi kesalahan / Gagal memanggil Function',
                        'error'
                    );
                },
                complete: function () {
                    // always reset button (baik success maupun error)
                    btn.prop('disabled', false)
                        .find('i')
                        .removeClass('fa-spin');
                }
            })
        }

        function verifName() {
            var name = $("#name").val();
            if (name == '') {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon maaf, isian username wajib terisi',
                    position: 'topRight'
                });
                return;
            }
            $.ajax({
                url: "/api/v4/akun/pengguna/verif/" + name,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    if (res === 1) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Mohon maaf, username sudah ada, silakan coba lagi dengan username yang berbeda',
                            position: 'topRight'
                        });
                        $("#btn-simpan").prop('disabled', true);
                    } else {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Username dapat digunakan',
                            position: 'topRight'
                        });
                        $("#btn-simpan").prop('disabled', false);
                    }
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Mohon maaf, username sudah ada, silakan coba lagi dengan username yang berbeda',
                        position: 'topRight'
                    });
                    $("#btn-simpan").prop('disabled', true);
                }
            });
        }

        function tambah() {
            const btn = $('#btn-tambah');
            $.ajax({
                url: "/api/v4/aksesjabatan/jabatan/data",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function () {
                    btn.prop('disabled', true)
                        .find('i')
                        .addClass('ri-loop-left-line fa-spin')
                        .removeClass('ri-user-add-line');
                },
                success: function(res) {
                    if (res === 1) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Mohon maaf, daftar Role gagal dimuat',
                            position: 'topRight'
                        });
                        $("#btn-simpan").prop('disabled', true);
                        return;
                    }

                    let html = '<option value="">Pilih Jabatan</option>';

                    res.show.forEach(function(item){
                        html += `<option value="${item.id}">${item.deskripsi}</option>`;
                    });

                    $("#role").html(html).select2({
                        placeholder: "Pilih Jabatan",
                        allowClear: true
                    });

                    $('#tambah').modal('show');
                    $('#name').on('keyup', function () {
                        let value = $(this).val();
                        $("#btn-simpan").prop('disabled', true);
                    });
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Mohon maaf, daftar Role gagal dimuat',
                        position: 'topRight'
                    });
                    $("#btn-simpan").prop('disabled', true);
                },
                complete: function () {
                    // always reset button (baik success maupun error)
                    btn.prop('disabled', false)
                        .find('i')
                        .removeClass('ri-loop-left-line fa-spin')
                        .addClass('ri-user-add-line');
                }
            });
        }

        function ubah(id) {

        }

        function hapus(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Hapus Permanen Akun Pengguna ID : ' + id,
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
                        url: "/api/v4/akun/pengguna/hapus/" + id,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Hapus Akun berhasil pada ' + res,
                                position: 'topRight'
                            });
                            window.location.reload();
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
