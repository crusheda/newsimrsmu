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
            <div class="col-sm-8">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6>Form <b class="text-primary ">Pengajuan</b></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 mb-3">
                                <div class="alert alert-light shadow-sm" role="alert">
                                    <small>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Isian bertanda <a class="text-danger">*</a> wajib diisi<br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Tidak dapat mengajukan <b>lebih dari 2x</b> apabila masih terdapat pengajuan yang belum Selesai<br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Wajib <b>memperbarui/upload</b> Foto Profil terlebih dahulu sebelum mengajukan ID Card<br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Mohon mengupload Foto Profil formal untuk kelengkapan proses verifikasi pengajuan, foto yang dimaksud <b>BUKAN</b> berfungsi sebagai foto ID Card<br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Isian <b class="text-teal">Nama</b>, <b class="text-teal">NIP</b>, dan <b class="text-teal">Jabatan</b> akan terisi otomatis oleh sistem, apabila ditemukan ketidaksesuaian data mohon segera menghubungi Bagian SDI<br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Proses pengajuan ini terdiri dari 3 tahap yaitu <span class="badge rounded-pill text-bg-primary">Pengajuan</span> ,
                                                                                                                                        <span class="badge rounded-pill text-bg-warning">Dalam Proses</span> ,
                                                                                                                                        <span class="badge rounded-pill text-bg-success">Selesai</span>
                                    </small>
                                </div>
                            </div>
                            <label class="form-label">Pilih Jenis Pengajuan <a class="text-danger">*</a></label>
                            <!-- ID CARD BARU -->
                            <div class="col-xl-6 mb-3">
                                <label for="idcard1" class="w-100">
                                    <div class="form-check payment-card-container mb-0 lh-1 border rounded p-3 cursor-pointer">


                                        <div class="form-check-label w-100">
                                            <div class="d-sm-flex d-block align-items-center gap-3">

                                                <div><span class="avatar avatar-lg avatar-rounded bg-danger-transparent"> <i class="ri-id-card-line fs-5"></i> </span></div>

                                                <div class="saved-card-details pe-5">
                                                    <h6 class="mb-1 fw-medium">Ajukan ID Card <b class="text-danger"><u>Baru</u></b></h6>
                                                    <small class="text-muted d-block">Pengajuan ID Card untuk pertama kali / belum pernah memiliki ID Card</small>
                                                    <h4><span class="badge bg-danger-gradient me-1">Rp 0 ,-</span><span class="badge bg-success-gradient">GRATIS</span></h4>
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

                                                <div><span class="avatar avatar-lg avatar-rounded bg-primary-transparent"> <i class="ri-id-card-line fs-5"></i> </span></div>

                                                <div class="saved-card-details pe-5">
                                                    <h6 class="mb-1 fw-medium">Ganti ID Card <b class="text-primary"><u>Lama</u></b></h6>
                                                    <small class="text-muted d-block">Pengajuan ID Card untuk kartu yang hilang, rusak, dan lain sebagainya</small>
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
                                        <small class="text-muted d-block">Periksa kembali Nama Lengkap dan Gelar Anda</small>
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" class="form-control" placeholder="Terisi Otomatis Oleh Sistem" name="nama" value="{{ $list['user']->nama?$list['user']->nama:$list['user']->name }}" disabled>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" class="form-control" placeholder="Terisi Otomatis Oleh Sistem" name="panggilan" value="{{ $list['user']->nick }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label">Nomor Induk Pegawai (<b class="text-teal">NIP</b>) <a class="text-danger">*</a>
                                        <small class="text-muted d-block">Periksa kembali No. NIP Anda</small>
                                    </label>
                                    <div class="col-lg-8"><input type="text" class="form-control" name="nip" placeholder="Terisi Otomatis Oleh Sistem" value="{{ $list['user']->nip }}" disabled></div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label">Nama Jabatan <a class="text-danger">*</a>
                                        <small class="text-muted d-block">Periksa kembali Jabatan Anda</small>
                                    </label>
                                    <div class="col-lg-8"><input type="text" class="form-control" name="jabatan" placeholder="Terisi Otomatis Oleh Sistem" value="{{ $list['role']->nama_role2?$list['role']->nama_role2:$list['role']->nama_role }}" disabled></div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label">Alasan
                                        <small class="text-muted d-block">Tuliskan alasan Anda mengajukan ID Card</small>
                                    </label>
                                    <div class="col-lg-8"><textarea class="form-control" id="alasan" name="alasan" rows="2" placeholder="Masukkan Alasan Anda disini..."></textarea></div>
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
            <div class="col-sm-4">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6>Riwayat <b class="text-success">Pengajuan</b></h6>
                        <a href="javascript:void(0);" class="btn btn-warning-transparent btn-sm" id="btn-refresh" onclick="showRiwayat()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Segarkan Tabel Riwayat"><i class="ti ti-refresh me-1"></i> Refresh</a>
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
                    <h6 class="modal-title">
                        Form <b class="text-danger">Batal</b> Pengajuan <b class="text-teal">ID Card</b>
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan membatalkan Pengajuan ID Card Saat Ini, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan pembatalan.</p>
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
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
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
            const btn = $('#btn-simpan');

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

            // console.log(save.get('nama'));
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
                            beforeSend: function() {
                                btn.prop('disabled', true);
                                btn.find("i").removeClass("fa-stamp").addClass("fa-sync fa-spin");
                            },
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
                            },
                            complete: function() {
                                btn.prop('disabled', false);
                                btn.find("i").removeClass("fa-sync fa-spin").addClass("fa-stamp");
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
                        beforeSend: function() {
                            btn.prop('disabled', true);
                            btn.find("i").removeClass("fa-stamp").addClass("fa-sync fa-spin");
                        },
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
                        },
                        complete: function() {
                            btn.prop('disabled', false);
                            btn.find("i").removeClass("fa-sync fa-spin").addClass("fa-stamp");
                        }
                    });
                }
            }
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
                            var status = '';
                            var dateStatus = '';
                            if (item.progress == 0) {
                                status = `<a class="text-primary">Pengajuan</a>`;
                                dateStatus = `<a class="text-muted">Diajukan pada ${formatDateTime(item.created_at)}</a>`;
                            } else {
                                if (item.progress == 1) {
                                    status = `<a class="text-warning">Dalam Proses</a>`;
                                    dateStatus = `<a class="text-muted">Diproses pada ${formatDateTime(item.updated_at)}</a>`;
                                } else {
                                    if (item.progress == 2) {
                                        status = `<a class="text-success">Selesai</a>`;
                                        dateStatus = `<a class="text-muted">Selesai pada ${formatDateTime(item.updated_at)}</a>`;
                                    } else {
                                        status = `<a class="text-danger">Ditolak</a>`;
                                        dateStatus = `<a class="text-muted">Ditolak pada ${formatDateTime(item.updated_at)}</a>`;
                                    }
                                }
                            }
                            // DROPDOWN BUTTON
                            var colBtn = '';
                            var dropdown = '';
                            if (input == date) {
                                if (item.progress > 0) {
                                    dropdown = `<a class="dropdown-item disabled" href="javascript:void(0);"><i class="fas fa-trash me-2"></i> Batalkan Pengajuan</a>`;
                                    colBtn = 'danger-transparent';
                                } else {
                                    dropdown = `<a class="dropdown-item text-danger" href="javascript:void(0);" onclick="hapus(${item.id})"><i class="fas fa-trash me-2"></i> Batalkan Pengajuan</a>`;
                                    colBtn = 'teal-transparent';
                                }
                            } else {
                                dropdown = `<a class="dropdown-item disabled" href="javascript:void(0);"><i class="fas fa-trash me-2"></i> Batalkan Pengajuan</a>`;
                                colBtn = 'danger-transparent';
                            }
                            $('#riwayat_pengajuan').append(`
                                <li class="list-group-item" id="list${item.id}">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1 mx-2">
                                            <h6 class="mb-1">${item.pengajuan==0?'Pengajuan ID Card <b class="text-danger">Baru</b>':'Penggantian ID Card <b class="text-primary">Lama</b>'}</h6>
                                            <p class="text-muted text-sm mb-1 fs-12">Status : ${status}</p>
                                            <p class="text-muted text-sm mb-2 fs-12">${dateStatus}</p>
                                            <h6 class="mb-1">
                                                <b>${item.pengajuan==0?'Rp 0,-':'Rp 25.000,-'}</b>
                                            </h6>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-${colBtn} btn-sm btn-wave shadow-sm" data-bs-toggle="dropdown" aria-expanded="false">
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
                    message: 'Mohon menyetujui untuk dilakukan pembatalan pengajuan tersebut',
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
                            message: 'Pengajuan ID Card Anda telah berhasil dibatalkan pada '+formatDateTime(res),
                            position: 'topRight'
                        });
                        $('#modalHapus').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pengajuan ID Card Anda gagal dibatalkan, silahkan coba lagi',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function bersihkan() {
            $('#filex').val('');
            $('#alasan').val('');
            document.querySelectorAll('input[name="pengajuan"]').forEach(function(el) {
                el.checked = false;
            });
            $('#lampiran').prop('hidden', true);
        }

        function formatDateTime(timestamp) {
            var date = new Date(timestamp);

            var bulan = [
                "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
                "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
            ];

            var day = date.getDate();
            var month = bulan[date.getMonth()];
            var year = date.getFullYear();

            var hours = date.getHours().toString().padStart(2, '0');
            var minutes = date.getMinutes().toString().padStart(2, '0');

            return `${day} ${month} ${year}, ${hours}:${minutes} WIB`;
        }
    </script>
@endsection
