@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Berkas <b class="text-primary link-underline-primary text-decoration-underline">Rapat</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Administrasi</a>
                    </li>
                    <li class="breadcrumb-item pe-none" aria-current="page">
                        Berkas
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Rapat
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                            <i class="fa-fw fas fa-upload nav-icon me-1"></i> Upload Berkas</button>
                        <div class="btn-group">
                            <button class="btn btn-warning-transparent" id="refreshBtn" onclick="refresh()"><i class="fas fa-sync me-1"></i> 30 Data Terakhir</button>
                            <button class="btn btn-danger-transparent" id="refreshBtnAll" onclick="refreshAll()"><i class="fas fa-sync me-1"></i> Semua Data</button>
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
                                        <th>KEGIATAN</th>
                                        <th>KETUA</th>
                                        <th>WAKTU</th>
                                        <th>LOKASI</th>
                                        <th>KETERANGAN</th>
                                        <th>UPDATE</th>
                                        <th>USER</th>
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
                                        <th>KEGIATAN</th>
                                        <th>KETUA</th>
                                        <th>WAKTU</th>
                                        <th>LOKASI</th>
                                        <th>KETERANGAN</th>
                                        <th>UPDATE</th>
                                        <th>USER</th>
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
    <div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form <b class="text-primary">Upload</b>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-auth-small" name="formTambah" action="{{ route('v4.administrasi.berkas.rapat.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="user_nama" value="{{ Auth::user()->nama }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light shadow-sm mb-3">
                                    <small><i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berupa Dokumen dan bisa lebih dari satu file</small><br>
                                    <small><i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum setiap file adalah <strong>5 mb</strong></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Kegiatan <a class="text-danger">*</a></label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        placeholder="e.g. Rapat Unit IT" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label">Ketua Rapat <a class="text-danger">*</a></label>
                                        <div class="flex-shrink-0" id="switch-str">
                                            <div class="form-check form-switch custom-switch-v1 switch-sm">
                                                <input type="checkbox" class="form-check-input input-primary" id="kepalamanual">
                                                <label class="form-check-label" for="kepalamanual">Isi Manual ?</label>
                                            </div>
                                        </div>
                                    </div>
                                    <select class="select2 form-control" id="kepala" name="kepala" style="width: 100%" required>
                                        <option value="">Pilih</option>
                                        @foreach ($list['users'] as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" id="kepala_manual" name="kepala_manual" placeholder="Isi Manual Nama Ketua Rapat" hidden>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Tanggal & Waktu <a class="text-danger">*</a></label>
                                    <input class="form-control flatpickr" name="tanggal" type="text" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Lokasi Rapat <a class="text-danger">*</a></label>
                                    <input type="text" name="lokasi" id="lokasi" class="form-control"
                                        placeholder="e.g. Ruang IT" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea maxlength="200" rows="3" placeholder="Pengisian keterangan terbatas hanya 200 karakter." class="form-control"
                                name="keterangan" id="keterangan" placeholder="Optional"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Multiple Upload <a class="text-danger">*</a></label>
                            <input type="file" class="form-control form-control-sm mb-2" name="file2[]" id="file2" multiple required>
                        </div>
                </div>
                <div class="modal-footer">

                    <button class="btn btn-primary" id="btn-simpan" onclick="simpan()"><i
                            class="fa-fw fas fa-upload nav-icon"></i> Upload</button>
                    </form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ubah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form <b class="text-secondary">Ubah Berkas</b>&nbsp;<span class="badge bg-warning-transparent align-middle"><a id="show_edit"></a></span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" class="form-control" hidden>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-light shadow-sm mb-3">
                                <small><i class="fa-fw fas fa-caret-right nav-icon"></i> Waktu pengubahan berkas rapat hanya berlaku pada hari saat anda mengupload</small><br>
                                <small><i class="fa-fw fas fa-caret-right nav-icon"></i> Periksa ulang lampiran berkas anda, apabila terdapat kesalahan upload dokumen mohon hapus dan upload ulang</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Kegiatan <a class="text-danger">*</a></label>
                                <input type="text" id="nama_edit" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="form-label">Ketua Rapat <a class="text-danger">*</a></label>
                                    <div class="flex-shrink-0" id="switch-str">
                                        <div class="form-check form-switch custom-switch-v1 switch-sm">
                                            <input type="checkbox" class="form-check-input input-primary" id="kepalamanualedit">
                                            <label class="form-check-label" for="kepalamanualedit">Isi Manual ?</label>
                                        </div>
                                    </div>
                                </div>
                                <select class="form-control select2" id="kepala_edit" style="width: 100%" required></select>
                                <input type="text" class="form-control" id="kepala_manual_edit" name="kepala_manual_edit" placeholder="Isi Manual Nama Ketua Rapat" hidden>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Tanggal & Waktu <a class="text-danger">*</a></label>
                                <input type="text" id="tanggal_edit" class="form-control flatpickr"
                                    placeholder="Tanggal Rapat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Lokasi Rapat <a class="text-danger">*</a></label>
                                <input type="text" id="lokasi_edit" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea  maxlength="200" rows="3" placeholder="Pengisian keterangan hanya 200 karakter." class="form-control" id="keterangan_edit" ></textarea>
                    </div>
                    {{-- <div class="form-group">
                        <label class="form-label">Multiple Upload <a class="text-danger">*</a></label>
                        <input type="file" class="form-control mb-2" id="file2_edit" multiple>
                        <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Biarkan kosong jika tidak ada perubahan file</sub>
                    </div> --}}
                </div>
                <div class="modal-footer d-flex align-items-center justify-content-between">
                    <div>Ditambahkan oleh&nbsp;<a id="user_edit"></a></div>
                    <div>
                        <button class="btn btn-primary" id="submit_edit" onclick="ubah()"><i
                                class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="download" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">File <b class="text-info">Berkas Rapat</b></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th><i class="fa-fw fas fa-sort-numeric-down nav-icon"></i> Nama File</th>
                                    <th>Perkiraan Ukuran</th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-file">
                                <tr>
                                    <td colspan="2" style="font-size:13px">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> File download akan digabungkan dan dikonversikan dalam bentuk <kbd>ZIP FILE</kbd></sub>
                </div>
                <div class="modal-footer d-flex align-items-center justify-content-between">
                    <div>Diupload <a id="tgl_upload"></a></div>
                    <div>
                        <button class="btn btn-primary" id="download_btn"><i
                                class="fa fa-download"></i> Download</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                    </div>
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
                    dropdownParent: e.parent()
                })
            });
            // DATEPICKER
            // DATE
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            const next = new Date(today);
            next.setDate(next.getDate() + 999999);
            var now = moment().locale('id').format('Y-MM-DD HH:mm');
            flatpickr(".flatpickr", {
                enableTime: true,
                defaultDate: now,
                minuteIncrement: 1,
                time_24hr: true,
                // disable: [{
                //     from: tomorrow.toISOString().split("T")[0],
                //     to: next.toISOString().split("T")[0]
                // }]
                disable: [
                    function(date) {
                        return date > today;
                    }
                ]
            });

            // DATETIME
            $('.flatpickrtime').flatpickr({
                enableTime: !0,
                dateFormat: "Y-m-d H:i"
            });
            refresh();
            $('#kepalamanual').change(function () {
                const manual = $(this).is(':checked');

                if (manual) {
                    // reset select2 value
                    $('#kepala').val(null).trigger('change');
                    $('#kepala').prop('required', false);
                    $('#kepala_manual').prop('required', true).prop('hidden', false);

                    // sembunyikan tampilan select2
                    $('#kepala').next('.select2').prop('hidden', true);

                    // reset input manual dulu (optional)
                    $('#kepala_manual').val('');
                } else {
                    // reset input manual
                    $('#kepala_manual').val('');
                    $('#kepala_manual').prop('required', false).prop('hidden', true);

                    // tampilkan kembali select2
                    $('#kepala').next('.select2').prop('hidden', false);
                    $('#kepala').prop('required', true);
                }
            });
        });

        // function getDateTime() {
        //     var now = new Date();
        //     var year = now.getFullYear();
        //     var month = now.getMonth() + 1;
        //     var day = now.getDate();
        //     if (month.toString().length == 1) {
        //         month = '0' + month;
        //     }
        //     if (day.toString().length == 1) {
        //         day = '0' + day;
        //     }
        //     var dateTime = year + '-' + month + '-' + day;
        //     return dateTime;
        // }

        function refresh() {
            $("#refreshBtn").prop('disabled', true);
            $("#refreshBtn").find("i").toggleClass("fa-sync fa-spinner fa-spin");
            if ($.fn.DataTable.isDataTable('#dttable')) {
                $('#dttable').DataTable().clear().destroy();
            }
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/administrasi/berkas/rapat/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    // var date = new Date().toISOString().split('T')[0];
                    var userID = @json(Auth::user()->id);
                    var adminID = @json(Auth::user()->can('admin_rapat'));
                    var date = getDateTime();
                    res.show.forEach(item => {
                        if (item.user_id == userID) {
                            if (updet == date) {
                                colorBtn = 'primary';
                            } else {
                                colorBtn = 'info';
                            }
                        } else {
                            if (adminID == true) {
                                colorBtn = 'primary';
                            } else {
                                colorBtn = 'secondary';
                            }
                        }
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        content += `<td><center><div class='btn-group'>
                                        <a href='javascript:void(0);' class='link-${colorBtn} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</a>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                        if (adminID == true) {
                            content += `<li><a href="javascript:void(0);" class='dropdown-item text-success' onclick="showDownload(` + item.id + `)"><i class="fa-fw fas fa-download nav-icon"></i> Download</a></li>
                                        <li><a href="javascript:void(0);" class='dropdown-item text-warning' onclick="showUbah(` + item.id + `)"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                        <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` + item.id + `)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                        } else {
                            if (item.user_id == userID) {
                                if (updet == date) {
                                    content +=
                                        `<li><a href="javascript:void(0);" class='dropdown-item text-success' onclick="showDownload(` + item.id + `)"><i class="fa-fw fas fa-download nav-icon"></i> Download</a></li>
                                        <li><a href="javascript:void(0);" class='dropdown-item text-warning' onclick="showUbah(` + item.id + `)"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                        <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` + item.id + `)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                } else {
                                    content +=
                                        `<li><a href="javascript:void(0);" class='dropdown-item text-success' onclick="showDownload(` + item.id + `)"><i class="fa-fw fas fa-download nav-icon"></i> Download</a></li>
                                        <li><a href="javascript:void(0);" class='dropdown-item disabled'><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                        <li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                }
                            } else {
                                content += `<li><a href="javascript:void(0);" class='dropdown-item text-success' onclick="showDownload(` + item.id + `)"><i class="fa-fw fas fa-download nav-icon"></i> Download</a></li>
                                            <li><a href="javascript:void(0);" class='dropdown-item disabled'><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                            <li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                            }
                        }
                        content += "</div></center></td>";
                        content += "<td>" + item.nama + "</td><td>" +
                                    (item.nama_kepala_user?item.nama_kepala_user:item.nama_kepala) + "</td><td class='text-start'>" +
                                    item.tanggal + "</td><td>" +
                                    item.lokasi + "</td><td class='text-wrap'>";
                        if (item.keterangan != null) {
                            content += item.keterangan;
                        }
                        content += '</td><td class="text-start">' +
                            new Date(item.updated_at).toLocaleString("sv-SE") + '</td><td>' +
                            (item.nama_user?item.nama_user:'') + '</td>';
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [6, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '20%' },
                            { sWidth: '10%' },
                            { sWidth: '8%' },
                            { sWidth: '10%' },
                            { sWidth: '29%' },
                            { sWidth: '8%' },
                            { sWidth: '10%' },
                        ],
                        displayLength: 10,
                    });
                    $("#refreshBtn").prop('disabled', false);
                    $("#refreshBtn").find("i").removeClass("fa-spinner fa-spin").addClass("fa-sync");
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger : 'hover'
                    })
                }
            });
        }

        function refreshAll() {
            if ($.fn.DataTable.isDataTable('#dttable')) {
                $('#dttable').DataTable().clear().destroy();
            }
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/administrasi/berkas/rapat/dataAll",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    $("#refreshBtnAll").prop('disabled', true);
                    $("#refreshBtnAll").find("i").addClass("fa-spinner fa-spin").removeClass("fa-sync");
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    // var date = new Date().toISOString().split('T')[0];
                    var userID = "{{ Auth::user()->id }}";
                    var adminID = "{{ Auth::user()->can('admin_rapat') }}";
                    var date = getDateTime();
                    res.show.forEach(item => {
                        if (item.user_id == userID) {
                            if (updet == date) {
                                colorBtn = 'primary';
                            } else {
                                colorBtn = 'info';
                            }
                        } else {
                            if (adminID == true) {
                                colorBtn = 'primary';
                            } else {
                                colorBtn = 'secondary';
                            }
                        }
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        content += `<td><center><div class='btn-group'>
                                        <a href='javascript:void(0);' class='link-${colorBtn} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</a>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                        if (adminID == true) {
                            content += `<li><a href="javascript:void(0);" class='dropdown-item text-success' onclick="showDownload(` + item.id + `)"><i class="fa-fw fas fa-download nav-icon"></i> Download</a></li>
                                        <li><a href="javascript:void(0);" class='dropdown-item text-warning' onclick="showUbah(` + item.id + `)"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                        <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` + item.id + `)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                        } else {
                            if (item.user_id == userID) {
                                if (updet == date) {
                                    content +=
                                        `<li><a href="javascript:void(0);" class='dropdown-item text-success' onclick="showDownload(` + item.id + `)"><i class="fa-fw fas fa-download nav-icon"></i> Download</a></li>
                                        <li><a href="javascript:void(0);" class='dropdown-item text-warning' onclick="showUbah(` + item.id + `)"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                        <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` + item.id + `)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                } else {
                                    content +=
                                        `<li><a href="javascript:void(0);" class='dropdown-item text-success' onclick="showDownload(` + item.id + `)"><i class="fa-fw fas fa-download nav-icon"></i> Download</a></li>
                                        <li><a href="javascript:void(0);" class='dropdown-item disabled'><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                        <li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                }
                            } else {
                                content += `<li><a href="javascript:void(0);" class='dropdown-item text-success' onclick="showDownload(` + item.id + `)"><i class="fa-fw fas fa-download nav-icon"></i> Download</a></li>
                                            <li><a href="javascript:void(0);" class='dropdown-item disabled'><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                            <li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                            }
                        }
                        content += "</div></center></td>";
                        content += "<td>" + item.nama + "</td><td>" +
                                    (item.nama_kepala_user?item.nama_kepala_user:item.nama_kepala) + "</td><td class='text-start'>" +
                                    item.tanggal + "</td><td>" +
                                    item.lokasi + "</td><td class='text-wrap'>";
                        if (item.keterangan != null) {
                            content += item.keterangan;
                        }
                        content += '</td><td class="text-start">' +
                            new Date(item.updated_at).toLocaleString("sv-SE") + '</td><td>' +
                            (item.nama_user?item.nama_user:'') + '</td>';
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [6, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '20%' },
                            { sWidth: '10%' },
                            { sWidth: '8%' },
                            { sWidth: '10%' },
                            { sWidth: '29%' },
                            { sWidth: '8%' },
                            { sWidth: '10%' },
                        ],
                        displayLength: 20,
                    });
                }, complete: function() {
                    $("#refreshBtnAll").prop('disabled', false);
                    $("#refreshBtnAll").find("i").removeClass("fa-spinner fa-spin").addClass("fa-sync");
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger : 'hover'
                    })
                }, error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                }
            });
        }

        function simpan() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '/api/v4/administrasi/berkas/rapat/simpan',
                data: new FormData(document.forms.namedItem("formTambah")),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $("#btn-simpan").prop('disabled', true);
                    $("#btn-simpan").find("i").removeClass("fa-upload").addClass("fa-sync fa-spin");
                    iziToast.info({
                        title: 'Pesan Tunggu!',
                        message: 'Sedang memproses data...',
                        position: 'topRight'
                    });
                },
                success: function(res) {
                    if (res) {
                        $('#tambah').modal('hide');
                        refresh();
                    }
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: res,
                        position: 'topRight'
                    });
                }, error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                }, complete: function() {
                    $('#kepala').val(null).trigger('change');
                    document.forms.namedItem("formTambah").reset();
                    $('#kepala_manual').val('');
                    $("#btn-simpan").find("i").removeClass("fa-sync fa-spin").addClass("fa-upload");
                    $("#btn-simpan").prop('disabled', false);
                }
            });
        }

        function showUbah(id) {
            $.ajax({
                url: "/api/v4/administrasi/berkas/rapat/data/" + id,
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    $("#ubah" + id).prop('disabled', true);
                    $("#ubah" + id).find("i").toggleClass("fa-edit fa-sync fa-spin");
                    // iziToast.info({
                    //     title: 'Pesan Tunggu!',
                    //     message: 'Sedang memproses data...',
                    //     position: 'topRight'
                    // });
                },
                success: function(res) {
                    $('#ubah').modal('show');

                    var dt = moment(res.show.tanggal).format('Y-MM-DD HH:mm');
                    document.getElementById('show_edit').innerHTML = "ID : " + res.show.id;
                    document.getElementById('user_edit').innerHTML = res.show.user_nama;
                    $("#id_edit").val(res.show.id);
                    $("#nama_edit").val(res.show.nama);
                    $("#tanggal_edit").val(dt);
                    $("#lokasi_edit").val(res.show.lokasi);
                    $("#keterangan_edit").val(res.show.keterangan);
                    if (res.show.kepala) {
                        // MODE SELECT
                        $('#kepalamanualedit').prop('checked', false);

                        $('#kepala_edit').prop('required', true).prop('hidden', false);
                        $('#kepala_edit').next('.select2').prop('hidden', false);

                        $('#kepala_manual_edit').prop('required', false).prop('hidden', true).val('');

                        $("#kepala_edit").find('option').remove();
                        res.kepala.forEach(item => {
                            $("#kepala_edit").append(`
                                <option value="${item.id}" ${item.id == res.show.kepala ? "selected":""}>
                                    ${item.nama}
                                </option>
                            `);
                        });

                        $('#kepala_edit').trigger('change');

                    } else {
                        // MODE MANUAL
                        $('#kepalamanualedit').prop('checked', true);

                        $('#kepala_edit').prop('required', false);
                        $('#kepala_edit').next('.select2').prop('hidden', true);

                        $('#kepala_manual_edit')
                            .prop('required', true)
                            .prop('hidden', false)
                            .val(res.show.nama_kepala ?? '');
                    }
                    $('#kepalamanualedit').change(function () {
                        const manual = $(this).is(':checked');

                        if (manual) {
                            $("#kepala_edit").find('option').remove();
                            $('#kepala_edit').val(null).trigger('change');
                            $('#kepala_edit').prop('required', false);
                            $('#kepala_manual_edit').prop('required', true).prop('hidden', false);

                            $('#kepala_edit').next('.select2').prop('hidden', true);

                            $('#kepala_manual_edit').val('');
                        } else {
                            $('#kepala_manual_edit').val('');
                            $('#kepala_manual_edit').prop('required', false).prop('hidden', true);

                            $('#kepala_edit').next('.select2').prop('hidden', false);
                            $('#kepala_edit').prop('required', true);
                            $("#kepala_edit").find('option').remove();

                            res.kepala.forEach(item => {
                                $("#kepala_edit").append(`
                                    <option value="${item.id}" ${item.id == res.show.kepala ? "selected":""}>
                                        ${item.nama}
                                    </option>
                                `);
                            });
                        }
                    });
                }, error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                }, complete: function() {
                    $("#ubah" + id).find("i").removeClass("fa-sync fa-spin").addClass("fa-edit");
                    $("#ubah" + id).prop('disabled', false);
                }
            });
        }

        function ubah() {
            var id = $("#id_edit").val();
            var nama = $("#nama_edit").val();
            var kepala = $("#kepala_edit").val();
            var kepala_manual = $("#kepala_manual_edit").val();
            var tanggal = $("#tanggal_edit").val();
            var lokasi = $("#lokasi_edit").val();
            var keterangan = $("#keterangan_edit").val();
            // var file2 = $("#file2_edit").val();

            if (nama == "" || tanggal == "" || lokasi == "") {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon lengkapi form pengisian',
                    position: 'topRight'
                });
                return false;
            }

            if (kepala == null && kepala_manual == "") {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Pengisian ketua rapat wajib diisi',
                    position: 'topRight'
                });
                return false;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '/api/v4/administrasi/berkas/rapat/data/' + id + '/ubah',
                dataType: 'json',
                data: {
                    id: id,
                    nama: nama,
                    kepala: kepala,
                    kepala_manual: kepala_manual,
                    tanggal: tanggal,
                    lokasi: lokasi,
                    keterangan: keterangan,
                },
                beforeSend: function() {
                    $("#submit_edit").prop('disabled', true);
                    $("#submit_edit").find("i").toggleClass("fa-save fa-sync fa-spin");
                    iziToast.info({
                        title: 'Pesan Tunggu!',
                        message: 'Sedang memproses data...',
                        position: 'topRight'
                    });
                },
                success: function(res) {
                    if (res) {
                        $('#ubah').modal('hide');
                        refresh();
                    }
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Berkas Rapat berhasil diubah pada ' + res,
                        position: 'topRight'
                    });
                }, error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                }, complete: function() {
                    $('#kepala_edit').val(null).trigger('change');
                    $('#kepala_manual_edit').val('');
                    $("#submit_edit").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
                    $("#submit_edit").prop('disabled', false);
                }
            });
        }

        function showDownload(id) {
            // $("#ubah"+id).prop('disabled', true);
            // $("#ubah"+id).find("i").toggleClass("fa-edit fa-sync fa-spin");
            $('#download').modal('show');
            $.ajax({
                url: "/api/v4/administrasi/berkas/rapat/data/" + id + "/download",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-file").empty();
                    document.getElementById('tgl_upload').innerHTML = res.tgl_upload;
                    document.getElementById('download_btn').href = "/api/v4/administrasi/berkas/rapat/data/" + res.id + "/zip";
                    content = "";
                    res.file.forEach(item => {
                        content += "<tr style='font-size:13px'>";
                        content += "<td>" + item.nama + "</td>";
                        content += "<td>" + item.size + " Mb</td>";
                        content += "</tr>";
                    });
                    $('#tampil-tbody-file').append(content);
                }
            });
        }

        function hapus(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Ingin menghapus Berkas Rapat ID : ' + id,
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
                        url: "/api/v4/administrasi/berkas/rapat/data/" + id + "/hapus",
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Pesan Sukses!',
                                message: 'Berkas telah berhasil dihapus',
                                position: 'topRight'
                            });
                            // fresh();
                            window.location.reload();
                        },
                        error: function(res) {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: 'Berkas gagal diupload',
                                position: 'topRight'
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection
