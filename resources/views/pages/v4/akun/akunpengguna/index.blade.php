@extends('layouts.v4')

@section('content')
    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Pengaturan <b class="text-primary link-underline-primary text-decoration-underline">Akun Pengguna</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Setting</a>
                    </li>
                    <li class="breadcrumb-item pe-none" aria-current="page">
                        Manajemen Akun
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
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
                                        <th class="cell-fit">NIP RS</th>
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
                                        <th class="cell-fit">NIP RS</th>
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
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="form-label">Jabatan <b class="text-danger">*</b></label>
                                    <a type="button" class="form-label link-info link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-decoration-underline"
                                        href="{{ route('v4.akun.aksesjabatan') }}"><i>Tidak menemukan Jabatan?</i></a>
                                </div>
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
                    <button class="btn btn-primary" id="btn-simpan" onclick="prosesTambah()" disabled>
                        <i class="fas fa-save fa-md me-1"></i> Simpan Data
                    </button>
                    <button class="btn btn-outline-dark btn-wave" onclick="closeModal()">
                        <i class="fas fa-times me-1"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade animate__animated animate__jackInTheBox" id="modalEdit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Akun Pengguna <span class="badge bg-outline-primary align-middle ms-1" id="edit_id_text"><i class="fas fa-sync fa-spin"></i></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row">

                    <input type="hidden" id="edit_id">

                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label class="form-label">NIP RS <b class="text-danger">*</b></label>
                            <input type="text" id="edit_nip" class="form-control delimiters" placeholder="xx.xx.xxx" required>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="form-label">Username <b class="text-danger">*</b></label>
                            <input type="text" id="edit_name" class="form-control" placeholder="Username Login Pegawai" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">Email <b class="text-danger">*</b></label>
                            <input type="email" id="edit_email" class="form-control" placeholder="Email Aktif Pegawai" required>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label">Jabatan <b class="text-danger">*</b></label>
                                <a type="button" class="form-label link-info link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-decoration-underline"
                                    href="{{ route('v4.akun.aksesjabatan') }}"><i>Tidak menemukan Jabatan?</i></a>
                            </div>
                            <select id="edit_role" class="form-control" multiple="multiple" style="width:100%" required></select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Password (<b class="text-danger link-underline-danger text-decoration-underline">Kosongkan jika tidak diubah</b>)</label>
                            <div class="input-group">
                                <input type="password" id="edit_password" class="form-control" placeholder="Minimal 8 Karakter" minlength="8">
                                <button class="btn btn-outline-primary" type="button" id="open-password3">
                                    <i class="fas fa-eye-slash" id="icon-password3"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer d-flex align-items-center justify-content-between">
                    <button class="btn btn-primary" id="btn-update" onclick="prosesUbah()">
                        <i class="fa fa-edit me-1"></i> Ubah Data
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
            // $('.selectFilterAdd').select2({
            //     dropdownParent: $('#tambah')
            // });
            // $('.selectFilterEdit').select2({
            //     dropdownParent: $('#modalEdit')
            // });

            $('#open-password1').on('click', function () {
                const input = $('#password1');
                const icon = $('#icon-password1');

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });
            $('#open-password2').on('click', function () {
                const input = $('#password2');
                const icon = $('#icon-password2');

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });
            $('#open-password3').on('click', function () {
                const input = $('#edit_password');
                const icon = $('#icon-password3');

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });

            refresh();
        })

        function refresh() {
            if ($.fn.DataTable.isDataTable('#dttable')) {
                $('#dttable').DataTable().clear().destroy();
            }
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
                            badges += `<span class="badge rounded-pill bg-primary-transparent me-1">${p.deskripsi ?? p.name}</span>`;
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
                                    <a href="javascript:void(0);" class='link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle'
                                        data-bs-toggle='dropdown' aria-expanded='false'>${item.id}
                                    </a>
                                    <ul class='dropdown-menu dropdown-menu-end'>
                                        <li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="ubah(${item.id})">
                                            <i class="fa-fw fas fa-edit nav-icon me-1"></i> Ubah</a></li>
                                        <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(${item.id})">
                                            <i class="fa-fw fas fa-trash nav-icon me-1"></i> Hapus</a></li>
                                    </ul>
                                </td>
                                <td>${item.nip ?? '-'}</td>
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
                        order: [[6,"desc"]],
                        displayLength: 15,
                        lengthMenu: [15,25,50,100,300,500]
                    });
                },
                error: function (xhr) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON?.message ?? 'Terjadi kesalahan / Gagal memanggil Function',
                        position: 'topRight'
                    });
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
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON?.message ?? 'Terjadi kesalahan / Gagal memanggil Function',
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
                        dropdownParent: $('#tambah'),
                        placeholder: "Pilih Jabatan",
                        allowClear: true
                    });

                    $('#tambah').modal('show');
                    $('#name').on('keyup', function () {
                        let value = $(this).val();
                        $("#btn-simpan").prop('disabled', true);
                    });
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON?.message ?? 'Terjadi kesalahan / Gagal memanggil Function',
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

        function prosesTambah() {
            var name = $("#name").val();
            var email = $("input[name='email']").val();
            var role = $("#role").val();
            var password = $("#password1").val();
            var repassword = $("#password2").val();
            const btn = $('#btn-simpan');

            if (name == '' || email == '' || role.length == 0 || password == '' || repassword == '') {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon maaf, semua isian wajib terisi',
                    position: 'topRight'
                });
                return;
            }

            if (password !== repassword) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon maaf, password dan retype password tidak cocok',
                    position: 'topRight'
                });
                return;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/akun/pengguna/tambah",
                type: 'POST',
                dataType: 'json',
                data: {
                    name: name,
                    email: email,
                    role: role,
                    password: password
                },
                beforeSend: function () {
                    btn.prop('disabled', true)
                        .find('i')
                        .addClass('fa-sync fa-spin')
                        .removeClass('fa-save');
                },
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: res.message + ' pada ' + res.time,
                        position: 'topRight'
                    });

                    refresh();
                    $('#tambah').modal('hide');
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON?.message ?? 'Terjadi kesalahan / Gagal memanggil Function',
                        position: 'topRight'
                    });
                }, complete: function () {
                    // always reset button (baik success maupun error)
                    btn.prop('disabled', false)
                        .find('i')
                        .removeClass('fa-sync fa-spin')
                        .addClass('fa-save');
                }
            });
        }

        function ubah(id) {
            $.ajax({
                url: "/api/v4/akun/pengguna/" + id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $('#edit_id').val(res.user.id);
                    $('#edit_nip').val(res.user.nip);
                    $('#edit_name').val(res.user.name);
                    $('#edit_email').val(res.user.email);
                    $('#edit_password').val('');

                    let html = '<option value="">Pilih Jabatan</option>';

                    res.roles.forEach(function(item){
                        html += `<option value="${item.id}">${item.deskripsi??item.name}</option>`;
                    });

                    $("#edit_role").html(html).select2({
                        dropdownParent: $('#modalEdit'),
                        placeholder: " Pilih Jabatan",
                        allowClear: true
                    });

                    // set selected role
                    let roleIds = Array.isArray(res.user.roles)
                                ? res.user.roles.map(r => r.id)
                                : [];
                    $('#edit_role').val(roleIds).trigger('change');

                    new Cleave('#edit_nip', {
                        delimiters: ['.', '.'],
                        blocks: [2, 2, 3],
                        // uppercase: true
                        numericOnly: true
                    });

                    $('#modalEdit').modal('show');
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON?.message ?? 'Terjadi kesalahan / Gagal memanggil Function',
                        position: 'topRight'
                    });
                }, complete: function () {
                    $('#edit_id_text').text('ID # '+id);
                }
            });
        }

        function prosesUbah() {

            let id = $('#edit_id').val();
            let nip = $('#edit_nip').val();
            let name = $('#edit_name').val();
            let email = $('#edit_email').val();
            let role = $('#edit_role').val();
            let password = $('#edit_password').val();
            const btn = $('#btn-update');

            if (name === '' || nip === '' || email === '' || role.length === 0) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Semua field wajib diisi',
                    position: 'topRight'
                });
                return;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/akun/pengguna/ubah/" + id,
                type: 'PUT',
                dataType: 'json',
                data: {
                    name: name,
                    nip: nip,
                    email: email,
                    role: role,
                    password: password
                },
                beforeSend: function () {
                    btn.prop('disabled', true)
                        .find('i')
                        .addClass('fa-sync fa-spin')
                        .removeClass('fa-edit');
                },
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: res.message + ' pada ' + res.time,
                        position: 'topRight'
                    });

                    refresh();
                    $('#modalEdit').modal('hide');
                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON?.message ?? 'Terjadi kesalahan',
                        position: 'topRight'
                    });
                },
                complete: function () {
                    btn.prop('disabled', false)
                        .find('i')
                        .removeClass('fa-sync fa-spin')
                        .addClass('fa-edit');
                }
            });
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
                cancelButtonText: `<i class="fa fa-times me-1" style="font-size:13px"></i> Batal`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/api/v4/akun/pengguna/hapus/" + id,
                        type: 'delete',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Pesan Sukses!',
                                message: res.message + ' pada ' + res.time,
                                position: 'topRight'
                            });
                            refresh();
                        },
                        error: function(xhr, status, error) {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: xhr.responseJSON?.message ?? 'Terjadi kesalahan / Gagal memanggil Function',
                                position: 'topRight'
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection
