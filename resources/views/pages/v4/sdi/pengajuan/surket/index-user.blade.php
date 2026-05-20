@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Surat <b class="text-success link-underline-success text-decoration-underline">Keterangan</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">SDI</a>
                    </li>
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Pengajuan</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Surat Keterangan
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">Form <b class="text-primary">Pengajuan</b></h6>
                        <div class="btn-group">
                            <button class="btn btn-warning btn-shadow" onclick="refresh()" id="btn-refresh" disabled hidden>
                                <i class="ri-loop-left-line nav-icon"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="alert alert-light shadow-sm" role="alert">
                                    <div class="row">
                                        <h6><center>Mohon Diperhatikan <b class="text-danger">Panduan Di Bawah</b> Sebelum Melakukan Pengisian!</center></h6>
                                        <div class="col-md-6">
                                            <small>
                                                <i class="ti ti-arrow-narrow-right me-1"></i> Tanda (<a class="text-danger">*</a>) berarti pengisian <b class="text-danger">WAJIB</b> diisi / tidak boleh dikosongi<br>
                                                <i class="ti ti-arrow-narrow-right me-1"></i> Proses pengajuan ini terdiri dari 3 tahap yaitu <span class="badge p-1 text-bg-primary">Pengajuan</span> ,
                                                                                                                                                <span class="badge p-1 text-bg-warning">Dalam Proses</span> ,
                                                                                                                                                <span class="badge p-1 text-bg-success">Selesai</span> <br>
                                                                                                                                                <i class="ti ti-arrow-narrow-right me-1"></i> Tidak dapat mengajukan <b>lebih dari 2x</b> pada order yang sama apabila masih terdapat pengajuan/order yang belum diselesaikan<br>
                                                <i class="ti ti-arrow-narrow-right me-1"></i> Pengajuan hanya dapat dihapus/dibatalkan pada hari yang sama saat data diajukan dan masih berstatus Pengajuan
                                            </small>
                                        </div>
                                        <div class="col-md-6">
                                            <small>
                                                <i class="ti ti-arrow-narrow-right me-1"></i> <b class="text-info">TAT</b> Wajib terisi apabila Surat yang dipilih adalah Surat Paklaring<br>
                                                <i class="ti ti-arrow-narrow-right me-1"></i> <b class="text-info">TMK & TAK</b> Wajib terisi apabila Surat yang dipilih adalah Surat Pemenuhan SKP<br>
                                                <i class="ti ti-arrow-narrow-right me-1"></i> Apabila <b class="text-info">TMT</b> <b class="text-danger">Masih Kosong</b>, silakan menghubungi bagian Kepegawaian<br>
                                                <i class="ti ti-arrow-narrow-right me-1"></i> Dokumen Final dapat <b>didownload</b> masing-masing karyawan apabila status telah berubah menjadi <span class="badge p-1 text-bg-success">Selesai</span>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider mb-3"><i class="ri-corner-down-right-fill me-1"></i> <span class="text-warning">Periksa Data Diri <b class="text-pink">Anda</b></span></div>
                            <div class="col-5 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap + Gelar <a class="text-danger">*</a></label>
                                    <input type="text" value="{{ $list['user']->nama }}" class="form-control" disabled>
                                    <input type="text" name="nama" id="nama" value="{{ $list['user']->nama }}" class="form-control" hidden>
                                </div>
                            </div>
                            <div class="col-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tempat, Tanggal Lahir <a class="text-danger">*</a></label>
                                    <input type="text" value="{{ $list['user']->temp_lahir }}, {{ \Carbon\Carbon::parse($list['user']->tgl_lahir)->isoFormat('D MMMM Y') }}" class="form-control" disabled>
                                    <input type="text" name="ttl" id="ttl" value="{{ $list['user']->temp_lahir }}, {{ \Carbon\Carbon::parse($list['user']->tgl_lahir)->isoFormat('D MMMM Y') }}" class="form-control" hidden>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Pendidikan Terakhir <a class="text-danger">*</a></label>
                                    <input type="text" value="{{ $list['pendidikan'] }}" class="form-control" disabled>
                                    <input type="text" name="pendidikan" id="pendidikan" value="{{ $list['pendidikan'] }}" class="form-control" hidden>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Alamat Lengkap <a class="text-danger">*</a></label>
                                    <input type="text" value="{{ $list['user']->alamat_dom?$list['user']->alamat_dom:$list['user']->alamat_ktp }}" class="form-control" disabled>
                                    <input type="text" name="alamat" id="alamat" value="{{ $list['user']->alamat_dom?$list['user']->alamat_dom:$list['user']->alamat_ktp }}" class="form-control" hidden>
                                    <small>Apabila terdapat <b class="text-danger">ketidaksesuaian</b> data, silakan mengubah data diri Anda di menu <b class="text-pink">Profil</b></small>
                                </div>
                            </div>
                            <div class="divider mb-3"><i class="ri-corner-down-right-fill me-1"></i> <span class="text-warning">Konfirmasi Data <b class="text-primary">SDI</b></span></div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Sub Profesi <a class="text-danger">*</a></label>
                                    <input type="text" value="{{ $list['user']->nama_subprofesi }}" class="form-control" placeholder="Apabila masih kosong, silakan hubungi Kepegawaian" disabled>
                                    <input type="text" name="profesi" id="profesi" value="{{ $list['user']->ref_subprofesi }}" class="form-control" hidden>
                                    <small>Apabila terdapat data yang masih <b class="text-danger">kosong</b> / <b class="text-danger">tidak lengkap</b>, silakan menghubungi bagian <b class="text-primary">SDI</b></small>
                                </div>
                            </div>
                            <div class="col-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">TMT (<b class="text-orange">Tanggal Mulai Tugas</b>) <a class="text-danger">*</a></label>
                                    <input type="text" value="{{ $list['user']->tmt }}" class="form-control" disabled>
                                    <input type="text" name="tmt" id="tmt" value="{{ $list['user']->tmt }}" class="form-control" hidden>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">TAT (<b class="text-orange">Tanggal Akhir Tugas</b>) <a class="text-danger" id="mandatory_paklaring" hidden>*</a></label>
                                    <input type="text" value="{{ $list['user']->tat }}" class="form-control" placeholder="Terisi Apabila Telah Pensiun / Purna Tugas" disabled>
                                    <input type="text" name="tat" id="tat" value="{{ $list['user']->tat }}" class="form-control" hidden>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-2 row">
                                    <label class="col-lg-3 col-form-label">Kategori Permintaan Surat <a class="text-danger">*</a>
                                        <small class="text-muted d-block">Silakan order bagi yang berkepentingan</small>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="kategori" id="kategori">
                                            <option value="">Pilih</option>
                                            @if (count($list['kategori']) > 0)
                                                @foreach ($list['kategori'] as $item)
                                                    <option value="{{ $item->id }}">{{ $item->deskripsi }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 row mandatory1" hidden>
                                    <label class="col-lg-3 col-form-label">Masukkan TMK & TAK <a class="text-danger">*</a>
                                        <small class="text-muted d-block">Mohon memasukkan Tanggal kegiatan <br>Sesuai <b class="text-danger">Tahun Terbit SIP</b></small>
                                    </label>
                                    <div class="col-lg-9">
                                        <label class="form-label text-warning">Tanggal Kegiatan Pelayanan</label>

                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="ti ti-calendar"></i>
                                            </span>

                                            <input type="text"
                                                id="daterange"
                                                class="form-control"
                                                placeholder="Pilih rentang tanggal">
                                        </div>

                                        <!-- hidden input -->
                                        <input type="hidden" id="tmk">
                                        <input type="hidden" id="tak">
                                    </div>
                                </div>
                                <div class="text-end btn-page mb-0">
                                    <button class="btn btn-primary" id="btn-simpan" onclick="ajukan()"><i class="fas fa-stamp me-1"></i> Ajukan Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">Daftar <b class="text-danger">Pengajuan</b></h6>
                        <div class="btn-group">
                            <a href="javascript:void(0);" class="btn btn-sm btn-warning-transparent" onclick="showRiwayat()" id="btn-refresh"><i class="ti ti-refresh f-20 me-1"></i> Refresh</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dttable" class="table table-hover dt-responsive align-middle">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>#ID</center>
                                        </th>
                                        <th>KATEGORI PENGAJUAN</th>
                                        <th>IDENTITAS PEGAWAI</th>
                                        <th><center>PROGRESS</center></th>
                                        <th>UPDATE</th>
                                        <th>VERIFIED</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody">
                                    <tr>
                                        <td colspan="9" style="font-size:13px">
                                            <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <center>#ID</center>
                                        </th>
                                        <th>KATEGORI PENGAJUAN</th>
                                        <th>IDENTITAS PEGAWAI</th>
                                        <th><center>PROGRESS</center></th>
                                        <th>UPDATE</th>
                                        <th>VERIFIED</th>
                                    </tr>
                                </tfoot>
                            </table>
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
                    <h5 class="modal-title">
                        Form <b class="text-danger">Hapus</b> / <b class="text-danger">Batalkan</b> <b class="text-primary">Pengajuan</b>
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan melakukan penghapusan Pengajuan Surat Keterangan, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
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
            // const datepicker_range = new DateRangePicker(document.querySelector('#pc-datepicker-5'), {
            //     buttonClass: 'btn',
            //     clearBtn: true
            // });

            // tanggal hari ini
            let today = new Date();

            // tanggal tahun depan
            let nextYear = new Date();

            // FLATPICKR INPUT TMK & TAK
            nextYear.setFullYear(today.getFullYear() + 1);

            flatpickr("#daterange", {
                mode: "range",
                dateFormat: "Y-m-d",
                disableMobile: true,

                defaultDate: [today, nextYear],

                onReady: function(selectedDates, dateStr, instance) {

                    if (selectedDates.length === 2) {

                        let start = instance.formatDate(selectedDates[0], "Y-m-d");
                        let end   = instance.formatDate(selectedDates[1], "Y-m-d");

                        $('#tmk').val(start);
                        $('#tak').val(end);
                    }
                },

                // hanya update value
                onChange: function(selectedDates, dateStr, instance) {

                    if (selectedDates.length === 2) {

                        let start = instance.formatDate(selectedDates[0], "Y-m-d");
                        let end   = instance.formatDate(selectedDates[1], "Y-m-d");

                        if (start !== end) {

                            $('#tmk').val(start);
                            $('#tak').val(end);

                            console.log('TMK:', start);
                            console.log('TAK:', end);
                        }
                    }
                },

                // validasi setelah picker ditutup
                onClose: function(selectedDates, dateStr, instance) {

                    // reset default
                    $('#tmk').val('');
                    $('#tak').val('');

                    // jika belum lengkap
                    if (selectedDates.length !== 2) {

                        $('#daterange').val('');

                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pastikan Tanggal TMK dan TAK terisi lengkap',
                            position: 'topRight'
                        });

                        return;
                    }

                    let start = instance.formatDate(selectedDates[0], "Y-m-d");
                    let end   = instance.formatDate(selectedDates[1], "Y-m-d");

                    // jika tanggal sama
                    if (start === end) {

                        $('#daterange').val('');

                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Tanggal TMK dan TAK tidak boleh sama',
                            position: 'topRight'
                        });

                        return;
                    }

                    // valid
                    $('#tmk').val(start);
                    $('#tak').val(end);
                }
            });

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

            $('#kategori').on('change', function() {
                if (this.value == 159) {
                    $('.mandatory1').prop('hidden',false);
                } else {
                    $('#tmk').val('');
                    $('#tak').val('');
                    $('.mandatory1').prop('hidden',true);
                }

                if (this.value == 160) {
                    $('#mandatory_paklaring').prop('hidden',false);
                } else {
                    $('#mandatory_paklaring').prop('hidden',true);
                }
            });
            showRiwayat();
        });

        function ajukan() {
            // Definisi
            var save = new FormData();
            save.append('nama',$('#nama').val());
            save.append('ttl',$('#ttl').val());
            save.append('pendidikan',$('#pendidikan').val());
            save.append('alamat',$('#alamat').val());
            save.append('profesi',$('#profesi').val());
            save.append('tmt',$('#tmt').val());
            save.append('tat',$('#tat').val());
            save.append('tmk',$('#tmk').val());
            save.append('tak',$('#tak').val());
            save.append('kategori',$('#kategori').val());
            save.append('pegawai','{{ Auth::user()->id }}');
            // INITIALIZE VALIDATION
            var validation = false;
            if (save.get('kategori') == 159) { // PEMENUHAN SKP
                if ($('#nama').val() == "" ||
                    $('#ttl').val() == "" ||
                    $('#pendidikan').val() == "" ||
                    $('#alamat').val() == "" ||
                    $('#profesi').val() == "" ||
                    $('#tmk').val() == "" ||
                    $('#tak').val() == "") {
                    validation = true;
                }
            } else {
                if (save.get('kategori') == 160) { // PAKLARING
                    if ($('#nama').val() == "" ||
                        $('#ttl').val() == "" ||
                        $('#pendidikan').val() == "" ||
                        $('#alamat').val() == "" ||
                        $('#profesi').val() == "" ||
                        $('#tmt').val() == "" ||
                        $('#tat').val() == "") {
                        validation = true;
                    }
                } else {
                    if (save.get('kategori') != '') { // KATEGORI TIDAK BOLEH KOSONG
                        if ($('#nama').val() == "" ||
                            $('#ttl').val() == "" ||
                            $('#pendidikan').val() == "" ||
                            $('#alamat').val() == "" ||
                            $('#profesi').val() == "" ||
                            $('#tmt').val() == "") {
                            validation = true;
                        }
                    } else {
                        validation = true;
                    }
                }
            }

            // CHECKING VALIDATION
            if (validation == true) {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan tidak ada data yang kosong, silakan membaca keterangan pengisian dan periksa data Anda sekali lagi :)',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/v4/sdi/pengajuan/surket/tambah',
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    data: save,
                    beforeSend: function() {
                        $("#btn-simpan").find("i").removeClass("fa-stamp").addClass("fa-sync fa-spin");
                        $("#btn-simpan").prop('disabled', true);
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
                                message: 'Pengajuan Surat Keterangan telah berhasil dilakukan pada '+res,
                                position: 'topRight'
                            });
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
                        $("#btn-simpan").find("i").removeClass("fa-sync fa-spin").addClass("fa-stamp");
                        $("#btn-simpan").prop('disabled', false);
                    }
                });
            }
        }

        function showRiwayat() {
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/v4/sdi/pengajuan/surket/{{ Auth::user()->id }}/table",
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    $('#btn-refresh').prop('disabled', true);
                    $('#btn-refresh').find('i').addClass('ti-spin');
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        // console.log(item.progress);
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        var date = new Date().toLocaleString("sv-SE").substring(0, 10);
                        // PROGRESS
                        if (item.progress == 0) {
                            var status = `<span class="badge rounded-pill text-bg-primary">Pengajuan</span>`;
                        } else {
                            if (item.progress == 1) {
                                var status = `<span class="badge rounded-pill text-bg-warning">Diverifikasi</span>`;
                            } else {
                                if (item.progress == 2) {
                                    var status = `<span class="badge rounded-pill text-bg-info">Dalam Proses</span>`;
                                } else {
                                    if (item.progress == 3) {
                                        var status = `<span class="badge rounded-pill text-bg-success">Selesai</span>`;
                                    } else {
                                        if (item.progress == 4) {
                                            var status = `<span class="badge rounded-pill text-bg-danger">Ditolak</span>`;
                                        } else {
                                            var status = `<span class="badge rounded-pill text-bg-secondary">Dibatalkan/Dihapus</span>`;
                                        }
                                    }
                                }
                            }
                        }
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        if (item.progress == 4) { // Ditolak
                            clrbtn = 'danger';
                            valid = 'Ditolak';
                        } else {
                            if (item.progress == 3) { // Selesai
                                clrbtn = 'success';
                                valid = 'Diselesaikan';
                            } else {
                                if (item.progress == 2) { // Dalam Proses
                                    clrbtn = 'info';
                                    valid = 'Diproses';
                                } else {
                                    if (item.progress == 1) { // Diverifikasi
                                        clrbtn = 'warning';
                                        valid = 'Diverifikasi';
                                    } else {
                                        if (item.progress == 0) { // Pengajuan
                                            clrbtn = 'primary';
                                            valid = 'Diterima';
                                        } else {
                                            clrbtn = 'secondary';
                                            valid = 'Dibatalkan/Dihapus';
                                        }
                                    }
                                }
                            }
                        }
                        content += `<td><center><div class='btn-group'>
                                        <a href="javascript:void(0);"  class='link-${clrbtn} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</a>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                                        if (item.progress == 1) {
                                            content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-download nav-icon me-1"></i> Download Dokumen Final</a></li>`;
                                            if (updet == date) {
                                                if (item.progress == 0) {
                                                    content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` + item.id + `)"><i class="fa-fw fas fa-trash nav-icon me-1"></i> Hapus Pengajuan</a></li>`;
                                                } else {
                                                    content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-trash nav-icon me-1"></i> Hapus Pengajuan</a></li>`;
                                                }
                                            } else {
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-trash nav-icon me-1"></i> Hapus Pengajuan</a></li>`;
                                            }
                                        } else {
                                            if (item.progress == 2) {
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-download nav-icon me-1"></i> Download Dokumen Final</a></li>`;
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-trash nav-icon me-1"></i> Hapus Pengajuan</a></li>`;
                                            } else {
                                                if (item.progress == 3) {
                                                    content += `<li><a href='javascript:void(0);' class='dropdown-item text-success' onclick='downloadFile(${item.id})'><i class="fa-fw fas fa-download nav-icon me-1"></i> Download Dokumen Final</a></li>`;
                                                    content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-trash nav-icon me-1"></i> Hapus Pengajuan</a></li>`;
                                                } else {
                                                    content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-download nav-icon me-1"></i> Download Dokumen Final</a></li>`;
                                                    content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-trash nav-icon me-1"></i> Hapus Pengajuan</a></li>`;
                                                }
                                            }
                                        }
                        content += "</div></center></td>";
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>` + item.kategori + `</h6>
                                                <small class='text-truncate text-muted'>`;
                                                    if (item.ref_id == 159) {
                                                        content += item.pegawai_tmk+' <i class="fas fa-long-arrow-alt-right text-primary"></i> '+item.pegawai_tak;
                                                    } else {
                                                        if (item.ref_id == 160) {
                                                            content += '<b>TMT</b> : '+item.pegawai_tmt+'<br>'+'<b>TAT</b> : '+item.pegawai_tat;
                                                        } else {
                                                            content += '<b>TMT</b> : '+item.pegawai_tmt;
                                                        }
                                                    }
                        content +=              `</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-1 text-${clrbtn}'>${item.pegawai_nama}</h6>
                                                <small class='text-truncate text-muted'>Tempat, Tgl Lahir : <b>${item.pegawai_ttl}</b></small>
                                                <small class='text-truncate text-muted'>Pendidikan Terakhir : <b>${item.pegawai_pendidikan}</b></small>
                                                <small class='text-truncate text-muted'>Alamat : <b>${item.pegawai_alamat}</b></small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += "<td><center>" + status + "</center></td><td>" + new Date(item.updated_at).toLocaleString("sv-SE") + "</td>";
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>${item.valid?'Telah <b class="text-'+clrbtn+'">'+valid+'</b> oleh <b class="text-primary">SDI</b>':'Belum Terverifikasi'}</h6>
                                                <small class='text-truncate text-muted'>${item.tgl_valid?'Pada '+item.tgl_valid:''}</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [4, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '12%' },
                            { sWidth: '45%' },
                            { sWidth: '8%' },
                            { sWidth: '10%' },
                            { sWidth: '20%' },
                        ],
                        displayLength: 10,
                    });
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON.error,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    btn.prop('disabled', false);
                    btn.find("i").removeClass("ti-spin");
                }
            })
        }

        function downloadFile(id) {
            window.open("/v4/sdi/pengajuan/surket/"+id+"/download");
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
                    url: "/api/v4/sdi/pengajuan/surket/"+id+"/delete",
                    type: 'DELETE',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Pengajuan Surat Keterangan Anda telah berhasil dihapus pada '+res,
                            position: 'topRight'
                        });
                        $('#modalHapus').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pengajuan Surat Keterangan Anda gagal dihapus',
                            position: 'topRight'
                        });
                    }
                });
            }
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

        function zeroPad(nr,base){ // 1 => 001 (1,100)
            var  len = (String(base).length - String(nr).length)+1;
            return len > 0? new Array(len).join('0')+nr : nr;
        }
    </script>
@endsection
