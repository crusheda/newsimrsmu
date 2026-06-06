@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Perjalanan <b class="text-success link-underline-primary text-decoration-underline">Dinas</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">SDI</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Perjalanan Dinas
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            @can('admin_kepegawaian_kepala')
                <div class="collapse" id="bukaForm" style="">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header d-flex align-items-center justify-content-between py-3">
                                <h6 class="mb-0"><b>Form <b class="text-primary">Tambah</b></b></h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="alert alert-light shadow-sm" role="alert">
                                            <small>
                                                {{-- <i class="ti ti-arrow-narrow-right me-1"></i> <br> --}}
                                                <i class="ti ti-arrow-narrow-right me-1"></i> Isian bertanda (<a class="text-danger">*</a>) berarti wajib diisi
                                                {{-- <br><i class="ti ti-arrow-narrow-right me-1"></i> Batas ukuran file upload maksimal <b class="text-danger">2 mb</b> --}}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Nama Acara <a class="text-danger">*</a></label>
                                            <input type="text" class="form-control" name="acara" id="acara" placeholder="e.g. Upacara Pengibaran Bendera Merah Putih HUT RI Ke-XX">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Waktu Acara <a class="text-danger">*</a></label>
                                            <input type="datetime-local" class="form-control" name="tgl" id="tgl">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Perjalanan Dinas <a class="text-danger">*</a></label>
                                            <select class="form-control" name="jenis" id="jenis">
                                                <option value="">Pilih</option>
                                                <option value="1">Offline</option>
                                                <option value="2">Online</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Kendaraan <a class="text-danger">*</a></label>
                                            <select class="form-control" name="kendaraan" id="kendaraan">
                                                <option value="">Pilih</option>
                                                <option value="1">[Pribadi] Motor</option>
                                                <option value="2">[Pribadi] Mobil</option>
                                                <option value="3">[Rumah Sakit] Mobil</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3" id="showing" hidden>
                                        <div class="form-group">
                                            <label class="form-label">Pemilik Kendaraan Yang Digunakan <a class="text-danger">*</a></label>
                                            <select class="form-select select2" name="kendaraan_pegawai[]" id="kendaraan_pegawai" style="width: 100%" multiple>
                                                @if (count($list['users']) > 0)
                                                    @foreach ($list['users'] as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="multiple-inputs">Lama Dinas <a class="text-danger">*</a></label>
                                        <div class="input-group">
                                            <select class="form-control" name="lama1" id="lama1">
                                                <option value="">Pilih</option>
                                                <option value="1">< 4 Jam (Kurang dari 4 jam)</option>
                                                <option value="2">> 4 Jam (Lebih dari 4 jam)</option>
                                            </select>
                                            <input type="text" placeholder="Perkiraan Waktu (Jam)" class="form-control" name="lama2" id="lama2">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Lokasi Acara <a class="text-danger">*</a></label>
                                            <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="e.g. Alun-alun Satya Negara Kabupaten Sukoharjo">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3" id="slide">
                                        <div class="form-group">
                                            <label class="form-label">Pegawai Pelaksana <a class="text-danger">*</a></label>
                                            <select class="form-select select2" name="pegawai[]" id="pegawai" style="width: 100%" multiple>
                                                @if (count($list['users']) > 0)
                                                    @foreach ($list['users'] as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Deskripsi Perjalanan (<b class="text-warning">Optional</b>)</label>
                                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="2" placeholder="Deskripsikan perjalanan dinas Anda"></textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Upload</label>
                                            <input type="file" class="form-control" id="filex" name="filex" accept="application/pdf">
                                        </div>
                                    </div> --}}
                                    <div class="text-end btn-page mt-2">
                                        <button class="btn btn-link text-dark" id="clear_text" onclick="clearInput()">Kosongkan</button>
                                        <button class="btn btn-primary" id="btn-simpan" onclick="simpan()"><i class="fas fa-save me-1"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        {{-- <h6 class="mb-0"><b>Tabel <b class="text-danger">Riwayat</b></b></h6> --}}
                        @can('admin_kepegawaian_kepala')
                            <button class="btn btn-success-transparent fw-bold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#bukaForm"
                                aria-expanded="false" aria-controls="flush-collapseOne"><i class="ri-file-check-line me-1"></i> Form Tambah Dinas</button>
                        @else
                            <h6 class="mb-0"><b>Tabel</b></h6>
                        @endcan
                        <div class="btn-group">
                            <a href="javascript:void(0);" class="btn btn-warning-transparent btn-sm" id="btn-refresh" onclick="showRiwayat()" data-bs-toggle="tooltip"
                                data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Segarkan Tabel"><i class="ti ti-refresh f-20 me-1"></i> Refresh</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dttable" class="table table-striped dt-responsive align-middle">
                                <thead>
                                    <tr>
                                        <th><center>#ID</center></th>
                                        <th><center>WAKTU</center></th>
                                        <th>ACARA</th>
                                        <th>PEGAWAI PELAKSANA</th>
                                        <th>UPDATE</th>
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
                                        <th><center>#ID</center></th>
                                        <th><center>WAKTU</center></th>
                                        <th>ACARA</th>
                                        <th>PEGAWAI PELAKSANA</th>
                                        <th>UPDATE</th>
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
    <div class="modal fade animate__animated animate__rubberBand" id="modalRincian" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Rincian <b class="text-info">Perjalanan</b>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" name="id_rincian" id="id_rincian" hidden>
                    <div id="status-rincian"></div>
                    <div class="table-responsive">
                        <table class="table dt-responsive align-middle table-borderless">
                            <tbody style="font-size:13px" id="tbody-rincian">
                                <tr>
                                    <td colspan="9">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer" id="keu-only" hidden>
                    <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal"><i class="fas fa-compress-arrows-alt me-1"></i> Tutup</button>
                    @can ('admin_pd_keuangan')
                        <button type="button" class="btn btn-primary" onclick="confirmPaid()" id="btn-confirm" hidden><i class="fas fa-money-bill-wave me-1"></i> Confirm Paid</button>
                        <button type="button" class="btn btn-warning" onclick="cancelPaid()" id="btn-cancel" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Batal Status menjadi <b>UNPAID</b> hanya berlaku <u>hari ini</u> saja!" hidden><i class="fas fa-times-circle me-1"></i> Cancel Paid</button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade animate__animated animate__rubberBand" id="modalUbah" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form <b class="text-warning">Ubah</b>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="row">
                        <div class="col-md-9 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Acara <a class="text-danger">*</a></label>
                                <input type="text" class="form-control" name="acara_edit" id="acara_edit" placeholder="e.g. Upacara Pengibaran Bendera Merah Putih HUT RI Ke-XX">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Waktu Acara <a class="text-danger">*</a></label>
                                <input type="datetime-local" class="form-control" name="tgl_edit" id="tgl_edit">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jenis Perjalanan Dinas <a class="text-danger">*</a></label>
                                <select class="form-control" name="jenis_edit" id="jenis_edit"></select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jenis Kendaraan <a class="text-danger">*</a></label>
                                <select class="form-control" name="kendaraan_edit" id="kendaraan_edit"></select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3" id="showing_edit" hidden>
                            <div class="form-group">
                                <label class="form-label">Pemilik Kendaraan Yang Digunakan <a class="text-danger">*</a></label>
                                <select class="form-select select2" name="kendaraan_pegawai_edit[]" id="kendaraan_pegawai_edit" style="width: 100%" multiple>
                                    @if (count($list['users']) > 0)
                                        @foreach ($list['users'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="multiple-inputs">Lama Dinas <a class="text-danger">*</a></label>
                            <div class="input-group">
                                <select class="form-control" name="lama1_edit" id="lama1_edit"></select>
                                <input type="text" placeholder="Perkiraan Waktu (Jam)" class="form-control" name="lama2_edit" id="lama2_edit">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Lokasi Acara <a class="text-danger">*</a></label>
                                <input type="text" class="form-control" name="lokasi_edit" id="lokasi_edit" placeholder="e.g. Alun-alun Satya Negara Kabupaten Sukoharjo">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3" id="slide_edit">
                            <div class="form-group">
                                <label class="form-label">Pegawai Pelaksana <a class="text-danger">*</a></label>
                                <select class="form-select select2" name="pegawai_edit[]" id="pegawai_edit" style="width: 100%" multiple></select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Deskripsi Perjalanan (<b class="text-warning">Optional</b>)</label>
                                <textarea class="form-control" name="deskripsi_edit" id="deskripsi_edit" rows="1" placeholder="Deskripsikan perjalanan dinas Anda"></textarea>
                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">File Terupload</label>
                                <div id="filex_edit"></div>
                                <small>File yang telah terupload tidak dapat diubah kembali, lakukan penginputan ulang apabila diperlukan</small>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal">Batalkan</button>
                    <button class="btn btn-warning" id="btn-ubah" onclick="prosesUbah()"><i class="fa-fw fas fa-save me-1"></i> Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalHapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form <b class="text-danger">Hapus</b>
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan melakukan penghapusan Berkas Perjalanan Dinas, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
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

            $('#kendaraan').change(function () {
                var i = $(this).val();
                if (i == 1 || i == 2) {
                    var o = $("#kendaraan_pegawai");
                    o.length && o.each(function() {
                        var e = $(this);
                        e.wrap('<div class="position-relative"></div>').select2({
                            placeholder: "Pilih",
                            allowClear: true,
                            dropdownParent: e.parent()
                        })
                    });
                    $('#kendaraan_pegawai').val('').change();
                    $('#showing').prop('hidden',false);
                    $('#slide').removeClass('col-md-6').addClass('col-md-12');
                } else {
                    $('#showing').prop('hidden',true);
                    $('#slide').removeClass('col-md-12').addClass('col-md-6');
                }
            });
            // $('.select2Tambah').select2({
            //     dropdownParent: $('#tambah')
            // });

            showRiwayat();
        });

        function showRiwayat() {
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            const btn = $("#btn-refresh");
            $.ajax({
                url: "/api/v4/sdi/pd/table",
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    btn.find('i').addClass('ti-spin');
                    btn.prop('disabled', true);
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleDateString("sv-SE");
                        var paiddate = new Date(item.tgl_paid).toLocaleDateString("sv-SE");
                        var date = new Date().toLocaleDateString("sv-SE");
                        var userID = @json(Auth::user()->id);
                        var adminID = @json(Auth::user()->can(['admin_kepegawaian']));
                        var superID = @json(Auth::user()->can(['admin_kepegawaian_kepala']));
                        var keuID = @json(Auth::user()->can(['admin_pd_keuangan']));
                        if (item.paid == 0) {
                            statusPaid = `<span class="badge bg-danger ms-2">UNPAID</span>`;
                            color = 'danger';
                        } else {
                            statusPaid = `<span class="badge bg-success ms-2">PAID</span>`;
                            color = 'success';
                        }
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        content += `<td><center><div class='btn-group'>
                                        <a href="javascript:void(0);" class='link-${color} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false' id='btnAct${item.id}'>${item.id}</a>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                                        if (superID == true || adminID == true || keuID == true) {
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-info" onclick="rincian(${item.id})"><i class="fa-fw fas fa-file-signature me-2"></i> Rincian</a></li>`;
                                        }
                                        if (superID == true) {
                                            if (item.paid == 1) {
                                                content += `<li><a href="javascript:void(0);" class="dropdown-item disabled"><i class="fa-fw fas fa-edit me-2"></i> Ubah</a></li>`;
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-trash me-2"></i> Hapus</a></li>`;
                                            } else {
                                                content += `<li><a href="javascript:void(0);" class="dropdown-item text-warning" onclick="ubah(${item.id})"><i class="fa-fw fas fa-edit me-2"></i> Ubah</a></li>`;
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` + item.id + `)"><i class="fa-fw fas fa-trash me-2"></i> Hapus</a></li>`;
                                            }
                                        } else {
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item disabled"><i class="fa-fw fas fa-edit me-2"></i> Ubah</a></li>`;
                                            content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-trash me-2"></i> Hapus</a></li>`;
                                        }
                        content += "</div></center></td>";
                        content += `<td class='text-center'>${new Date(item.tgl).toLocaleString("sv-SE")}</td>`;
                        if (item.kendaraan == 1) {
                            kendaraan = '<b class="text-primary">Motor Pribadi</b>';
                        } else {
                            if (item.kendaraan == 2) {
                                kendaraan = '<b class="text-teal">Mobil Pribadi</b>';
                            } else {
                                kendaraan = '<b class="text-secondary">Mobil Rumah Sakit</b>';
                            }
                        }
                        kendaraan_pegawai = '';
                        if (item.kendaraan_pegawai) {
                            res.users.forEach(is => {
                                JSON.parse(item.kendaraan_pegawai).forEach(val => {
                                    if (val == is.id) {
                                        kendaraan_pegawai += is.nama + `; `;
                                    }
                                })
                            })
                        }
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0 text-wrap fs-15' href="javascript:void(0);" onclick="rincian(${item.id})">
                                                    ${statusPaid}<b class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline ms-2" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Buka Rincian Acara">${item.acara}</b>
                                                </a>
                                                <ul>
                                                    <li><small class='text-wrap text-truncate text-muted'>Bertempat di <b class='text-orange'><u>${item.lokasi}</u></b></small></li>
                                                    <li><small class='text-wrap text-truncate text-muted'>Diselenggarakan secara <u>${item.jenis==1?"<b class='text-info'>Offline</b>":"<b class='text-purple'>Online</b>"}</u> selama ${item.lama1 == 1?'kurang dari 4 jam':'lebih dari 4 jam'}</small></li>
                                                    <li>
                                                        <small class='text-wrap text-truncate text-muted'>
                                                            Menggunakan <b>Transportasi <u>${kendaraan}</u></b>

                                                            ${
                                                                item.kendaraan == 3 ||
                                                                item.kendaraan_pegawai == "[]" ||
                                                                item.kendaraan_pegawai == null ||
                                                                item.kendaraan_pegawai == ""
                                                                ? ``
                                                                : `<br><b class='text-danger'>Milik</b> :
                                                                    (<a href='javascript:void(0);' class='text-wrap'>
                                                                        <b class='text-muted'
                                                                        data-bs-toggle='tooltip'
                                                                        data-bs-placement='bottom'
                                                                        data-bs-html='true'
                                                                        title='Pemilik Kendaraan'>
                                                                            <i>${kendaraan_pegawai}</i>
                                                                        </b>
                                                                    </a>)`
                                                            }
                                                        </small>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>`;
                        var pegawai = null;
                        content += `<td><small><ul class='list-unstyled mt-2'>`;
                        // console.log(JSON.parse(item.pegawai_id));
                        res.users.forEach(us => {
                            JSON.parse(item.pegawai_id).forEach(val => {
                                if (val == us.id) {
                                    content += `<li><i class="ti ti-arrow-narrow-right me-1"></i>` + us.nama + `</li>`;
                                }
                            })
                        })
                        content += `</small></ul></td>`;
                        content += `<td>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0 text-truncate'>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</a>
                                                <small class='text-muted text-wrap'>` + item.nama_user + `</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                        // Showing Tooltip
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger: 'hover'
                        })
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [1, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '8%' },
                            { sWidth: '10%' },
                            { sWidth: '50%' },
                            { sWidth: '20%' },
                            { sWidth: '12%' },
                        ],
                        displayLength: 10,
                    });
                },
                error: function (res) {
                    notifier.show(
                        res.statusText + " (Code " + res.status + ")", res.responseText,
                        "danger", "{{ asset('images/notification/high_priority-48.png') }}", 4e3
                    );
                },
                complete: function() {
                    btn.find("i").removeClass("ti-spin");
                    btn.prop('disabled', false);
                }
            })
        }

        function simpan() {
            const btn = $("#btn-simpan");

            // Definisi
            var save = new FormData();
            // var filesAdded = $('#filex')[0].files;
            save.append('acara',$('#acara').val());
            save.append('tgl',$('#tgl').val());
            save.append('jenis',$('#jenis').val());
            save.append('kendaraan',$('#kendaraan').val());
            save.append('kendaraan_pegawai',JSON.stringify($('#kendaraan_pegawai').val()));
            save.append('lama1',$('#lama1').val());
            save.append('lama2',$('#lama2').val());
            save.append('lokasi',$('#lokasi').val());
            save.append('pegawai',JSON.stringify($('#pegawai').val()));
            save.append('deskripsi',$('#deskripsi').val());
            // if (filesAdded) {
            //     save.append('file',filesAdded[0]);
            // }
            if (
                save.get('acara') == ""     ||
                save.get('tgl') == ""       ||
                save.get('jenis') == ""     ||
                save.get('kendaraan') == "" ||
                save.get('lama1') == ""     ||
                // save.get('lama2') == ""     ||
                save.get('lokasi') == ""    ||
                $('#pegawai').val() == ""
                // || filesAdded.length == 0 // (Jika Tidak Ada File Yang Diupload)
                ) {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian Wajib',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/sdi/pd/tambah",
                    method: 'post',
                    data: save,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        btn.find("i").removeClass("fa-save").addClass("fa-sync fa-spin");
                        btn.prop('disabled', true);
                    },
                    success: function(res) {
                        if (res.code == 200) {
                            notifier.show(
                                "Pesan Sukses!", "Submit Berkas berhasil dilakukan pada "+res.message,
                                "success", "{{ asset('images/notification/ok-48.png') }}", 4e3
                            );
                            showRiwayat();
                            clearInput();
                        } else {
                            notifier.show(
                                "Pesan Galat!", res.message,
                                "warning", "{{ asset('images/notification/medium_priority-48.png') }}", 4e3
                            );
                        }
                    },
                    error: function (res) {
                        notifier.show(
                            res.statusText + " (Code " + res.status + ")", res.responseText,
                            "danger", "{{ asset('images/notification/high_priority-48.png') }}", 4e3
                        );
                    },
                    complete: function() {
                        btn.find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
                        btn.prop('disabled', false);
                    }
                });
            }
        }

        function rincian(id) {
            const btn = $('#btnAct'+id);
            $("#tbody-rincian").empty().append(`<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax(
            {
                url: "/api/v4/sdi/pd/"+id,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    btn.html(`<i class="ti ti-refresh ti-spin"></i>`);
                    btn.prop('disabled', true);
                },
                success: function(res) {
                    $('#tbody-rincian').empty();
                    if (res.show.kendaraan == 1) {
                        kendaraan = '[Pribadi] Motor';
                    } else {
                        if (res.show.kendaraan == 2) {
                            kendaraan = '[Pribadi] Mobil';
                        } else {
                            kendaraan = '[Rumah Sakit] Mobil';
                        }
                    }
                    kendaraan_pegawai = '<ul class="mb-0 ps-3">';
                    if (res.show.kendaraan_pegawai) {
                        res.users.forEach(is => {
                            JSON.parse(res.show.kendaraan_pegawai).forEach(val => {
                                if (val == is.id) {
                                    kendaraan_pegawai += '<li>' + is.nama + '</li>';
                                }
                            })
                        })
                    }
                    kendaraan_pegawai += '</ul>';
                    pegawai = `<ol class="list-group list-group-numbered p-0">`;
                    res.users.forEach(us => {
                        JSON.parse(res.show.pegawai_id).forEach(val => {
                            if (val == us.id) {
                                pegawai += `<li class="list-group-item p-2">` + us.nama + `</li>`;
                            }
                        })
                    })
                    pegawai += `</ol>`;
                    $('#status-rincian').empty().append(`
                        <div class="card custom-card dashboard-main-card warning school-card flex-wrap mb-2">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2 justify-content-between">
                                    <div> <span class="d-block mb-1 text-muted fs-15">Status Pembayaran Dari <b class="text-warning">Bagian Keuangan</b></span>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            ${res.show.paid == 0?'<span class="badge bg-danger-transparent fs-18">BELUM TERBAYARKAN</span>':'<span class="badge bg-success-transparent fs-18">TELAH DIBAYARKAN</span>'}
                                            <div class="fs-12 text-muted">
                                                ${res.show.tgl_paid?`Dibayarkan pada `+new Date(res.show.tgl_paid).toLocaleString("sv-SE"):``}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lh-1"> <span class="avatar avatar-lg bg-warning-transparent svg-warning"> <svg
                                                xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                                viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                                <g>
                                                    <rect fill="none" height="24" width="24"></rect>
                                                </g>
                                                <g>
                                                    <path
                                                        d="M12,2C6.48,2,2,6.48,2,12s4.48,10,10,10s10-4.48,10-10S17.52,2,12,2z M12.88,17.76V19h-1.75v-1.29 c-0.74-0.18-2.39-0.77-3.02-2.96l1.65-0.67c0.06,0.22,0.58,2.09,2.4,2.09c0.93,0,1.98-0.48,1.98-1.61c0-0.96-0.7-1.46-2.28-2.03 c-1.1-0.39-3.35-1.03-3.35-3.31c0-0.1,0.01-2.4,2.62-2.96V5h1.75v1.24c1.84,0.32,2.51,1.79,2.66,2.23l-1.58,0.67 c-0.11-0.35-0.59-1.34-1.9-1.34c-0.7,0-1.81,0.37-1.81,1.39c0,0.95,0.86,1.31,2.64,1.9c2.4,0.83,3.01,2.05,3.01,3.45 C15.9,17.17,13.4,17.67,12.88,17.76z">
                                                    </path>
                                                </g>
                                            </svg> </span> </div>
                                </div>
                            </div>
                        </div>
                    `);
                    $('#tbody-rincian').append(`
                        <tr><th class="text-wrap">Nama Acara</th><td>${res.show.acara} (${res.show.jenis})</td></tr>
                        <tr><th class="text-wrap">Lokasi Acara</th><td>${res.show.lokasi}</td></tr>
                        <tr><th class="text-wrap">Tanggal</th><td>Pada ${formatTanggalIndo(res.show.tgl)} Selama ${res.show.lama1 == 1?'< 4 Jam':'> 4 Jam'}${res.show.lama2?'<br>(Lebih tepatnya selama '+res.show.lama2+' Jam)':''}</td></tr>
                        <tr><th class="text-wrap">Peserta</th><td>${pegawai}</td></tr>
                        <tr><th class="text-wrap">Transportasi</th><td>${kendaraan}</td></tr>
                        ${res.show.kendaraan_pegawai?`<tr><th class="text-wrap">Pemilik Kendaraan</th><td class="text-wrap">`+kendaraan_pegawai+`</td></tr>`:``}
                        <tr><th class="text-wrap">Deskripsi Perjalanan</th><td>${res.show.deskripsi?res.show.deskripsi:''}</td></tr>
                        ${res.show.paid == 1?`<tr><th class="text-danger">Keterangan Pembayaran</th><td>Dibayarkan oleh <b class='text-info'>${res.show.nama_user_paid}</b> pada <b class='text-warning'>${formatTanggalIndo(res.show.tgl_paid)}</b></td></tr>`:``}
                    `);
                    var keuID = @json(Auth::user()->can(['admin_pd_keuangan']));
                    var userID = @json(Auth::user()->id);
                    if (keuID == true) {
                        $('#keu-only').prop('hidden',false);
                    } else {
                        $('#keu-only').prop('hidden',true);
                    }
                    $('#id_rincian').val(res.show.id);
                    if (res.show.paid == 0) {
                        $('#btn-confirm').prop('hidden',false);
                        $('#btn-cancel').prop('hidden',true);
                    } else {
                        haripaid = new Date(res.show.tgl_paid).toLocaleDateString("sv-SE");
                        hariini = new Date().toLocaleDateString("sv-SE");
                        if (haripaid == hariini) {
                            $('#btn-confirm').prop('hidden',true);
                            $('#btn-cancel').prop('hidden',false);
                        } else {
                            $('#btn-confirm').prop('hidden',true);
                            $('#btn-cancel').prop('hidden',true);
                        }
                    }
                    $('#modalRincian').modal('show');
                },
                error: function (res) {
                    notifier.show(
                        res.statusText + " (Code " + res.status + ")", res.responseText,
                        "danger", "{{ asset('images/notification/high_priority-48.png') }}", 4e3
                    );
                },
                complete: function() {
                    btn.html(id);
                    btn.prop('disabled', false);
                }
            })
        }

        function confirmPaid() {
            const btn = $("#btn-confirm");
            // PROSES
            var save = new FormData();
            save.append('id',$("#id_rincian").val());
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/sdi/pd/paid",
                method: 'post',
                data: save,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    btn.find("i").removeClass("fa-money-bill-wave").addClass("fa-sync fa-spin");
                    btn.prop('disabled', true);
                },
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Rincian Perjalanan Dinas telah berhasil dibayarkan pada '+res,
                        position: 'topRight'
                    });
                    $('#modalRincian').modal('hide');
                    showRiwayat();
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Rincian Perjalanan Dinas gagal dibayarkan',
                        position: 'topRight'
                    });
                },
                complete: function() {
                    btn.find("i").removeClass("fa-sync fa-spin").addClass("fa-money-bill-wave");
                    btn.prop('disabled', false);
                }
            });
        }

        function cancelPaid() {
            const btn = $("#btn-cancel");
            // PROSES
            var save = new FormData();
            save.append('id',$("#id_rincian").val());
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/sdi/pd/unpaid",
                method: 'post',
                data: save,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    btn.find("i").removeClass("fa-times-circle").addClass("fa-sync fa-spin");
                    btn.prop('disabled', true);
                },
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Rincian Perjalanan Dinas telah berhasil diselesaikan pembayaran pada '+res,
                        position: 'topRight'
                    });
                    $('#modalRincian').modal('hide');
                    showRiwayat();
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Batal Pembayaran Fee Perjalanan Dinas gagal dilakukan',
                        position: 'topRight'
                    });
                },
                complete: function() {
                    btn.find("i").removeClass("fa-sync fa-spin").addClass("fa-times-circle");
                    btn.prop('disabled', false);
                }
            });
        }

        function ubah(id) {
            const btn = $('#btnAct'+id);
            $.ajax(
            {
                url: "/api/v4/sdi/pd/"+id,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    btn.html(`<i class="ti ti-refresh ti-spin"></i>`);
                    btn.prop('disabled', true);
                },
                success: function(res) {
                    // if (res.show.title) {
                    //     $("#filex_edit").empty().append(`<h6 id="filex_edit" class="text-primary"><a href="javascript:void(0);" onclick="window.open('/kepegawaian/pd/`+res.show.id+`/download')"><u>${res.show.title}</u></a></h6>`);
                    // } else {
                    //     $("#filex_edit").empty().append(`<h6 id="filex_edit" class="text-dark"><a>Tidak ada file terupload</a></h6>`);
                    // }
                    if (res.show.kendaraan == 1 || res.show.kendaraan == 2) {
                        $('#showing_edit').prop('hidden',false);
                        $('#slide_edit').removeClass('col-md-6').addClass('col-md-12');
                    } else {
                        $('#showing_edit').prop('hidden',true);
                        $('#slide_edit').removeClass('col-md-12').addClass('col-md-6');
                    }
                    $('#kendaraan_edit').change(function () {
                        var i = $(this).val();
                        if (i == 1 || i == 2) {
                            var o = $("#kendaraan_pegawai_edit");
                            o.length && o.each(function() {
                                var e = $(this);
                                e.wrap('<div class="position-relative"></div>').select2({
                                    placeholder: "Pilih",
                                    allowClear: true,
                                    dropdownParent: e.parent()
                                })
                            });
                            $('#kendaraan_pegawai_edit').val('').change();
                            $('#showing_edit').prop('hidden',false);
                            $('#slide_edit').removeClass('col-md-6').addClass('col-md-12');
                        } else {
                            $('#showing_edit').prop('hidden',true);
                            $('#slide_edit').removeClass('col-md-12').addClass('col-md-6');
                        }
                    });
                    $('#id_edit').val(res.show.id);
                    $('#acara_edit').val(res.show.acara);
                    $('#tgl_edit').val(res.show.tgl);
                    $('#lokasi_edit').val(res.show.lokasi);
                    $("#jenis_edit").find('option').remove();
                    $("#jenis_edit").append(`
                        <option value="1" ${res.show.jenis==1?"selected":""}>Offline</option>
                        <option value="2" ${res.show.jenis==2?"selected":""}>Online</option>
                    `);
                    $("#kendaraan_edit").find('option').remove();
                    $("#kendaraan_edit").append(`
                        <option value="1" ${res.show.kendaraan==1?"selected":""}>[Pribadi] Motor</option>
                        <option value="2" ${res.show.kendaraan==2?"selected":""}>[Pribadi] Mobil</option>
                        <option value="3" ${res.show.kendaraan==3?"selected":""}>[Rumah Sakit] Mobil</option>
                    `);
                    var up = JSON.parse(res.show.kendaraan_pegawai);
                    $("#kendaraan_pegawai_edit").find('option').remove();
                    res.users.forEach(pouch => {
                        $("#kendaraan_pegawai_edit").append(`
                            <option value="${pouch.id}">${pouch.nama}</option>
                        `);
                    });
                    $("#kendaraan_pegawai_edit").val(up).change();
                    $("#lama1_edit").find('option').remove();
                    $("#lama1_edit").append(`
                        <option value="1" ${res.show.lama1==1?"selected":""}>< 4 Jam (Kurang dari 4 jam)</option>
                        <option value="2" ${res.show.lama1==2?"selected":""}>> 4 Jam (Lebih dari 4 jam)</option>
                    `);
                    $('#lama2_edit').val(res.show.lama2);
                    var un = JSON.parse(res.show.pegawai_id);
                    $("#pegawai_edit").find('option').remove();
                    res.users.forEach(pounch => {
                        $("#pegawai_edit").append(`
                            <option value="${pounch.id}">${pounch.nama}</option>
                        `);
                    });
                    $("#pegawai_edit").val(un).change();
                    $('#deskripsi_edit').val(res.show.deskripsi);
                    $('#modalUbah').modal('show');
                },
                error: function (res) {
                    notifier.show(
                        res.statusText + " (Code " + res.status + ")", res.responseText,
                        "danger", "{{ asset('images/notification/high_priority-48.png') }}", 4e3
                    );
                },
                complete: function() {
                    btn.html(id);
                    btn.prop('disabled', false);
                }
            })
        }

        function prosesUbah() {
            const btn = $("#btn-ubah");

            var save = new FormData();
            var id = $('#id_edit').val();
            save.append('id',id);
            save.append('acara',$('#acara_edit').val());
            save.append('tgl',$('#tgl_edit').val());
            save.append('jenis',$('#jenis_edit').val());
            save.append('kendaraan',$('#kendaraan_edit').val());
            save.append('kendaraan_pegawai',JSON.stringify($('#kendaraan_pegawai_edit').val()));
            save.append('lama1',$('#lama1_edit').val());
            save.append('lama2',$('#lama2_edit').val());
            save.append('lokasi',$('#lokasi_edit').val());
            save.append('pegawai',JSON.stringify($('#pegawai_edit').val()));
            save.append('deskripsi',$('#deskripsi_edit').val());

            if (
                save.get('acara') == ""   ||
                save.get('tgl') == ""     ||
                save.get('jenis') == ""   ||
                save.get('kendaraan') == ""   ||
                save.get('lama1') == ""   ||
                // save.get('lama2') == ""   ||
                save.get('lokasi') == ""  ||
                $('#pegawai_edit').val() == ""
            ) {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian Wajib',
                    position: 'topRight'
                });
            } else {
                // AJAX request
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/sdi/pd/"+id+"/ubah",
                    method: 'post',
                    data: save,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        btn.find("i").removeClass("fa-save").addClass("fa-sync fa-spin");
                        btn.prop('disabled', true);
                    },
                    success: function(res){
                        notifier.show(
                            "Pesan Sukses!", "Perubahan berhasil dilakukan pada "+res.message,
                            "success", "{{ asset('images/notification/ok-48.png') }}", 4e3
                        );
                        if (res) {
                            $('#modalUbah').modal('hide');
                            showRiwayat();
                            clearInput();
                        }
                    },
                    error: function(res){
                        console.log("error : " + JSON.stringify(res) );
                        notifier.show(
                            res.statusText + " (Code " + res.status + ")", res.responseText,
                            "danger", "{{ asset('images/notification/high_priority-48.png') }}", 4e3
                        );
                    },
                    complete: function() {
                        btn.find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
                        btn.prop('disabled', false);
                    }
                });
            }

            $("#btn-ubah").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
            $("#btn-ubah").prop('disabled', false);
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
                    message: 'Mohon menyetujui untuk dilakukan penghapusan berkas tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_hapus").val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/sdi/pd/"+id+"/hapus",
                    type: 'DELETE',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Berkas perjalanan dinas Anda telah berhasil dihapus pada '+res,
                            position: 'topRight'
                        });
                        $('#modalHapus').modal('hide');
                        showRiwayat();
                        clearInput();
                    },
                    error: function (res) {
                        notifier.show(
                            res.statusText + " (Code " + res.status + ")", res.responseText,
                            "danger", "{{ asset('images/notification/high_priority-48.png') }}", 4e3
                        );
                    }
                });
            }
        }

        function clearInput() {
            // $('#filex').val('');
            $('#acara').val('');
            $('#tgl').val('');
            $('#kendaraan').val('');
            $('#kendaraan_pegawai').val('').change();
            $('#lama1').val('');
            $('#lama2').val('');
            $('#jenis').val('');
            $('#lokasi').val('');
            $('#pegawai').val('').change();
            $('#deskripsi').val('');
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

        function formatTanggalIndo(datetime) {
            if (!datetime) return '';

            const bulan = [
                'Januari','Februari','Maret','April','Mei','Juni',
                'Juli','Agustus','September','Oktober','November','Desember'
            ];

            const d = new Date(datetime.replace(' ', 'T'));

            const tgl   = d.getDate().toString().padStart(2, '0');
            const bln   = bulan[d.getMonth()];
            const thn   = d.getFullYear();
            const jam   = d.getHours().toString().padStart(2, '0');
            const menit= d.getMinutes().toString().padStart(2, '0');
            const detik= d.getSeconds().toString().padStart(2, '0');

            return `${tgl} ${bln} ${thn} Pukul ${jam}:${menit}:${detik}`;
        }
    </script>
@endsection
