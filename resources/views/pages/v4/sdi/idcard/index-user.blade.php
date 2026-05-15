@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Pengajuan <b class="text-teal link-underline-primary text-decoration-underline">ID Card</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">SDI</a>
                    </li>
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Pengajuan</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        ID Card
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-9">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6>Form <b class="text-primary ">Pengajuan</b></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 mb-3">
                                <div class="alert alert-light shadow-sm" role="alert">
                                    <small>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Tidak dapat mengajukan <b>lebih dari 2x</b> apabila masih terdapat pengajuan yang belum Selesai<br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Wajib <b>memperbarui/upload</b> Foto Profil terlebih dahulu sebelum mengajukan ID Card<br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Mohon mengupload Foto Profil formal untuk kelengkapan proses verifikasi pengajuan, foto yang dimaksud <b>BUKAN</b> berfungsi sebagai foto ID Card<br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Proses pengajuan ini terdiri dari 3 tahap yaitu <span class="badge rounded-pill text-bg-primary">Pengajuan</span> ,
                                                                                                                                        <span class="badge rounded-pill text-bg-warning">Dalam Proses</span> ,
                                                                                                                                        <span class="badge rounded-pill text-bg-success">Selesai</span>
                                    </small>
                                </div>
                            </div>
                            <label class="form-label">Pilih Jenis Pengajuan</label>
                            <!-- ID CARD BARU -->
                            <div class="col-xl-6 mb-3">
                                <label for="idcard1" class="w-100">
                                    <div class="form-check payment-card-container mb-0 lh-1 border rounded p-3 cursor-pointer">


                                        <div class="form-check-label w-100">
                                            <div class="d-sm-flex d-block align-items-center gap-3">

                                                <span class="avatar avatar-lg avatar-rounded bg-danger-transparent"> <i class="ri-id-card-line fs-5"></i> </span>

                                                <div class="saved-card-details pe-5">
                                                    <h6 class="mb-0 fw-medium">Ajukan ID Card <b class="text-danger"><u>Baru</u></b></h6>
                                                    <h4><span class="badge bg-danger-gradient">Rp 0 ,-</span></h4>
                                                </div>

                                                <input
                                                    id="idcard1"
                                                    name="pengajuan"
                                                    type="radio"
                                                    class="form-check-input"
                                                    value="0"
                                                >

                                            </div>
                                        </div>

                                    </div>
                                </label>
                            </div>

                            <!-- GANTI ID CARD LAMA -->
                            <div class="col-xl-6 mb-3">
                                <label for="idcard2" class="w-100">
                                    <div class="form-check payment-card-container mb-0 lh-1 border rounded p-3 cursor-pointer">

                                        <div class="form-check-label w-100">
                                            <div class="d-sm-flex d-block align-items-center gap-3">

                                                <span class="avatar avatar-lg avatar-rounded bg-primary-transparent"> <i class="ri-id-card-line fs-5"></i> </span>

                                                <div class="saved-card-details pe-5">
                                                    <h6 class="mb-0 fw-medium">Ganti ID Card <b class="text-primary"><u>Lama</u></b></h6>
                                                    <h4><span class="badge bg-primary-gradient">Rp 25.000 ,-</span></h4>
                                                </div>

                                                <input
                                                    id="idcard2"
                                                    name="pengajuan"
                                                    type="radio"
                                                    class="form-check-input"
                                                    value="1"
                                                >

                                            </div>
                                        </div>

                                    </div>
                                </label>
                            </div>
                            <div class="col-xl-12">
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label">Nama Lengkap (<b class="text-teal">+ Gelar</b>) & Panggilan <a class="text-danger">*</a>
                                        <small class="text-muted d-block">Periksa nama lengkap dan gelar Anda</small>
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" value="{{ $list['user']->nama?$list['user']->nama:$list['user']->name }}">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" class="form-control" placeholder="Nama Panggilan" name="panggilan" value="{{ $list['user']->nick }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label">Nomor Induk Pegawai (<b class="text-teal">NIP</b>) <a class="text-danger">*</a>
                                        <small class="text-muted d-block">Konfirmasi kepegawaian apabila nomor <b>NIP</b> kosong</small>
                                    </label>
                                    <div class="col-lg-8"><input type="text" class="form-control" name="nip" placeholder="Tuliskan NIP" value="{{ $list['user']->nip }}" readonly></div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label">Jabatan <a class="text-danger">*</a>
                                        <small class="text-muted d-block">Ubah/Sesuaikan Jabatan Anda</small>
                                    </label>
                                    <div class="col-lg-8"><input type="text" class="form-control" name="jabatan" placeholder="Masukkan Nama Jabatan" value="{{ $list['role']->nama_role2?$list['role']->nama_role2:$list['role']->nama_role }}"></div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label">Alasan
                                        <small class="text-muted d-block">Tuliskan alasan Anda membuat ID Card</small>
                                    </label>
                                    <div class="col-lg-8"><textarea class="form-control" id="alasan" name="alasan" rows="2" placeholder="Masukkan Alasan"></textarea></div>
                                </div>
                                <div class="mb-3 row" id="lampiran" hidden>
                                    <label class="col-lg-4 col-form-label">Lampiran <a class="text-danger">*</a>
                                        <small class="text-muted d-block">Upload bukti pembayaran (<b>Kwitansi</b>) dari Kasir</small>
                                    </label>
                                    <div class="col-lg-8"><input type="file" name="filex" id="filex" class="form-control"></div>
                                </div>
                                <div class="text-end btn-page mb-0 mt-4">
                                    <button class="btn btn-link text-dark" id="clear_text" onclick="bersihkan()">Kosongkan</button>
                                    <button class="btn btn-success" id="btn-simpan" onclick="ajukan()"><i class="fas fa-stamp me-2"></i> Submit Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6>Riwayat <b class="text-success">Pengajuan</b></h6>
                        <div class="btn-group">
                            <a href="javascript:void(0);" class="btn btn-warning-transparent btn-sm" id="btn-refresh" onclick="showRiwayat()" data-bs-toggle="tooltip"
                                data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Segarkan Tabel Riwayat"><i class="ti ti-refresh f-20 me-1"></i> Refresh</a>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 500px;">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush" id="riwayat_pengajuan">
                                <li class="list-group-item"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL START --}}
    <div class="modal animate__animated animate__rubberBand fade" id="modalHapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Hapus Pengajuan
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan menghapus Pengajuan ID Card Saat Ini, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuhapus">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-hapus" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapus()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}

    <script>
        $(document).ready(function() {
            // SELECT2
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    allowClear: true,
                    dropdownParent: e.parent()
                })
            });

            // $('.select2Tambah').select2({
            //     dropdownParent: $('#tambah')
            // });
            showRiwayat();
            $('input[name="pengajuan"]').change(function () {
                var i = $("input[name='pengajuan']:checked").val();
                if (i != 0) {
                    $('#lampiran').prop('hidden', false);
                } else {
                    $('#lampiran').prop('hidden', true);
                }
            });
        });

        function ajukan() {
            $("#btn-simpan").prop('disabled', true);
            $("#btn-simpan").find("i").toggleClass("fa-stamp fa-sync fa-spin");

            // Definisi
            var save = new FormData();
            save.append('pengajuan',$('input[name="pengajuan"]:checked').val());
            save.append('nama',$('input[name="nama"]').val());
            save.append('panggilan',$('input[name="panggilan"]').val());
            save.append('nip',$('input[name="nip"]').val());
            save.append('jabatan',$('input[name="jabatan"]').val());
            save.append('alasan',$('textarea[name=alasan]').val());
            save.append('pegawai','{{ Auth::user()->id }}');
            if ($('input[name="pengajuan"]:checked').val() == 1) {
                var filesAdded = $('#filex')[0].files;
                save.append('file',filesAdded[0]);
            }

            // console.log(save.get('pengajuan'));
            if (
                $('input[name="pengajuan"]:checked').val() == null ||
                save.get('nama') == "" ||
                save.get('panggilan') == "" ||
                save.get('nip') == "" ||
                save.get('jabatan') == ""
                // || filesAdded.length == 0 // (Jika Tidak Ada File Yang Diupload)
            ) {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian Wajib',
                    position: 'topRight'
                });
            } else {
                if ($('input[name="pengajuan"]:checked').val() == 1) {
                    if (filesAdded.length == 0) {
                        iziToast.warning({
                            title: 'Pesan Ambigu!',
                            message: 'Pastikan Anda mengupload kwitansi',
                            position: 'topRight'
                        });
                    } else {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: 'POST',
                            url: '/api/v4/sdi/pengajuan/idcard/tambah',
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            data: save,
                            success: function(res) {
                                if (res.code == 500) {
                                    iziToast.error({
                                        title: 'Pesan Galat!',
                                        message: res.message,
                                        position: 'topRight',
                                        buttons: [
                                            [
                                                '<button>Tutup</button>',
                                                function (instance, toast) {
                                                    instance.hide({
                                                        transitionOut: 'fadeOutUp'
                                                    }, toast);
                                                }
                                            ]
                                        ]
                                    });
                                } else {
                                    iziToast.success({
                                        title: 'Pesan Sukses!',
                                        message: 'Pengajuan ID Card telah berhasil dilakukan pada '+res,
                                        position: 'topRight'
                                    });
                                    bersihkan();
                                    showRiwayat();
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
                } else {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/api/v4/sdi/pengajuan/idcard/tambah',
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        data: save,
                        success: function(res) {
                            if (res.code == 500) {
                                iziToast.error({
                                    title: 'Pesan Galat!',
                                    message: res.message,
                                    position: 'topRight',
                                    buttons: [
                                        [
                                            '<button>Tutup</button>',
                                            function (instance, toast) {
                                                instance.hide({
                                                    transitionOut: 'fadeOutUp'
                                                }, toast);
                                            }
                                        ]
                                    ]
                                });
                            } else {
                                iziToast.success({
                                    title: 'Pesan Sukses!',
                                    message: 'Pengajuan ID Card telah berhasil dilakukan pada '+res,
                                    position: 'topRight'
                                });
                                bersihkan();
                                showRiwayat();
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

            $("#btn-simpan").find("i").removeClass("fa-sync fa-spin").addClass("fa-stamp");
            $("#btn-simpan").prop('disabled', false);
        }

        function showRiwayat() {
            $("#riwayat_pengajuan").empty().append(
                `<li class="list-group-item"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></li>`
            );
            const btn = $('#btn-refresh');
            $.ajax({
                url: "/api/v4/sdi/pengajuan/idcard/riwayat/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.find("i").addClass("ti-spin");
                },
                success: function(res) {
                    $("#riwayat_pengajuan").empty();
                    if (res.length > 0) {
                        res.forEach(item => {
                            var input = new Date(item.created_at).toLocaleDateString('en-ZA');
                            var date = new Date().toLocaleDateString('en-ZA');
                            if (item.progress == 0) {
                                var status = `<a class="text-primary">Pengajuan</a>`;
                            } else {
                                if (item.progress == 1) {
                                    var status = `<a class="text-warning">Dalam Proses</a>`;
                                } else {
                                    if (item.progress == 2) {
                                        var status = `<a class="text-success">Selesai</a>`;
                                    } else {
                                        var status = `<a class="text-danger">Ditolak</a>`;
                                    }
                                }
                            }
                            // DROPDOWN BUTTON
                            var colBtn = '';
                            var dropdown = '';
                            if (input == date) {
                                if (item.progress > 0) {
                                    dropdown = `<a class="dropdown-item disabled" href="javascript:void(0);"><i class="fas fa-trash me-2"></i> Hapus</a>`;
                                    colBtn = 'danger-transparent';
                                } else {
                                    dropdown = `<a class="dropdown-item text-danger" href="javascript:void(0);" onclick="hapus(${item.id})"><i class="fas fa-trash me-2"></i> Hapus</a>`;
                                    colBtn = 'teal-transparent';
                                }
                            } else {
                                dropdown = `<a class="dropdown-item disabled" href="javascript:void(0);"><i class="fas fa-trash me-2"></i> Hapus</a>`;
                                colBtn = 'danger-transparent';
                            }
                            $('#riwayat_pengajuan').append(`
                                <li class="list-group-item" id="list${item.id}">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1 mx-2">
                                            <h6 class="mb-1">${item.pengajuan==0?'Pengajuan ID Card Baru':'Penggantian ID Card Lama'}</h6>
                                            <p class="text-muted text-sm mb-1 fs-12">Status : ${status}</p>
                                            <p class="text-muted text-sm mb-2 fs-12">${new Date(item.created_at).toLocaleString('en-ZA')}</p>
                                            <h6 class="mb-1">
                                                <b>${item.pengajuan==0?'Rp 0,-':'Rp 25.000,-'}</b>
                                            </h6>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-${colBtn}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-list-unordered fs-20"></i>
                                        </a>
                                        <ul class="dropdown-menu" style="">${dropdown}</ul>
                                    </div>
                                </li>
                            `);
                        })
                    } else {
                        $("#riwayat_pengajuan").empty().append(
                            `<li class="list-group-item"><center>Belum ada pengajuan</center></li>`
                        );
                    }
                },
                error: function(res) {
                    $("#riwayat_pengajuan").empty().append(
                        `<li class="list-group-item"><center><i class="fas fa-exclamation-triangle me-2"></i> Gagal memuat data</center></li>`
                    );
                },
                complete: function() {
                    btn.prop('disabled', false);
                    btn.find("i").removeClass("ti-spin");
                }
            })
        }

        function hapus(id) {
            $("#id_hapus").val(id);
            var inputs = document.getElementById('setujuhapus');
            inputs.checked = false;
            $('#modalHapus').modal('show');
        }

        function prosesHapus() {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuhapus').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan penghapusan pengajuan tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_hapus").val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/sdi/pengajuan/idcard/"+id+"/delete",
                    type: 'DELETE',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Pengajuan ID Card Anda telah berhasil dihapus pada '+res,
                            position: 'topRight'
                        });
                        $('#modalHapus').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pengajuan ID Card Anda gagal dihapus',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function bersihkan() {
            $('#filex').val('');
            $('#alasan').val('');
        }

        function getDateTime() {
            var now = new Date();
            var year = now.getFullYear();
            var month = now.getMonth() + 1;
            var day = now.getDate();
            if (month.toString().length == 1) {
                month = '0' + month;
            }
            if (day.toString().length == 1) {
                day = '0' + day;
            }
            var dateTime = year + '-' + month + '-' + day;
            return dateTime;
        }
    </script>
@endsection
