@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    <b class="text-pink">Verifikasi</b> Berkas <b class="text-primary link-underline-primary text-decoration-underline">Laporan Rutin Bawahan</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Administrasi</a>
                    </li>
                    <li class="breadcrumb-item pe-none" aria-current="page">
                        Berkas
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a role="button" onclick="window.location.href='{{ route('v4.administrasi.berkas.laporan') }}'">Laporan Rutin</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Bawahan
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card table-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <button class="btn btn-secondary-light btn-sm" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom"
                            data-bs-html="true" title="Kembali ke halaman sebelumnya" onclick="window.location='{{ route('v4.administrasi.berkas.laporan') }}'">
                            <i class="fas fa-chevron-left me-2"></i> Kembali
                        </button>
                        <h6 class="mb-0">Tabel <b class="text-danger">Verifikasi</b> Laporan</h6>
                        <button class="btn btn-warning btn-sm" id="refreshBtn" onclick="refresh()"><i class="fas fa-sync me-1"></i> Segarkan</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dttable" class="table dt-responsive table-hover nowrap w-100 align-middle">
                                <thead>
                                    <tr>
                                        <th class="cell-fit">
                                            <center>AKSI</center>
                                        </th>
                                        <th>NAMA PEGAWAI</th>
                                        <th>UNIT</th>
                                        <th>JUDUL LAPORAN</th>
                                        <th>BLN / THN</th>
                                        <th>KETERANGAN</th>
                                        <th>DIUPDATE</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody">
                                    <tr>
                                        <td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="cell-fit">
                                            <center>AKSI</center>
                                        </th>
                                        <th>NAMA PEGAWAI</th>
                                        <th>UNIT</th>
                                        <th>JUDUL LAPORAN</th>
                                        <th>BLN / THN</th>
                                        <th>KETERANGAN</th>
                                        <th>DIUPDATE</th>
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
    <div class="modal fade animate__animated animate__jackInTheBox" id="verif" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">
                    Verifikasi <b class="text-info">Dokumen</b>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div id="show-action"></div>
                    <hr>
                    <div class="table-responsive text-nowrap">
                        <table id="dttable-verif" class="table dt-responsive table-hover table-bordered nowrap w-100 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>NAMA USER</th>
                                    <th>JABATAN</th>
                                    <th>UPDATE</th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-verif">
                                {{-- <tr>
                                    <td colspan="5" style="font-size:13px"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td>
                                </tr> --}}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>NAMA USER</th>
                                    <th>JABATAN</th>
                                    <th>UPDATE</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="catatan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">
                    Catatan <b class="text-pink">Dokumen</b>&nbsp;<span class="badge rounded-pill text-bg-primary align-middle" id="id_laporan_tx"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="id_laporan" hidden>
                    <textarea class="form-control mb-3" id="catatan_add" rows="3" placeholder="Tuliskan Catatan untuk Dokumen Laporan pegawai terkait"></textarea>
                    <div class="d-flex align-items-center justify-content-between">
                        <button class="btn btn-secondary-light btn-sm" onclick="clearCatatan()"><i class="ri-eraser-line me-1"></i> Kosongkan</button>
                        <div class="btn-group btn-group-sm" role="group">
                            <button class="btn btn-info" id="btnVerifikasi1" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Lihat Informasi Verifikator"><i class="fa-fw fas fa-info-circle me-1 nav-icon"></i> Verifikator</button>
                            <button class="btn btn-warning" id="btnRefreshCatatan" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Refresh Catatan"><i class="fa-fw fas fa-sync nav-icon"></i></button>
                            <button class="btn btn-primary" id="btnSaveCatatan" onclick="storeCatatan()" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Simpan Catatan Baru"><i class="fa-fw fas fa-save me-1 nav-icon"></i> Tambah Catatan</button>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive text-nowrap">
                        <table id="dttable-catatan" class="table table-hover table-bordered nowrap w-100 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>TANGGAL</th>
                                    <th>NAMA USER</th>
                                    <th>DESKRIPSI</th>
                                    <th>SOLVED</th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-catatan">
                                {{-- <tr>
                                    <td colspan="6" style="font-size:13px"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td>
                                </tr> --}}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>TANGGAL</th>
                                    <th>NAMA USER</th>
                                    <th>DESKRIPSI</th>
                                    <th>SOLVED</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="previewWord" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Preview <b class="text-info">Dokumen</b>&nbsp;<span class="badge bg-dark badge-sm"><a id="show_id_dokumen"></a></span>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body" id="tampil-preview-word"></div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="btn-download-preview" disabled><i
                            class="fa-fw fas fa-download nav-icon"></i> Download</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    dropdownParent: e.parent()
                })
            })
            refresh();
        });

        // FUNCTION-FUNCTION
        function formatBulanTahun(bln, thn) {
            const namaBulan = [
                "", // index 0 dikosongkan biar bulan ke-1 = Januari
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            return `${namaBulan[parseInt(bln)]} ${thn}`;
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

        function refresh() {
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/administrasi/berkas/laporan/table/{{ Auth::user()->id }}/verif",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    $("#refreshBtn").prop('disabled', true);
                    $("#refreshBtn").find("i").toggleClass("fa-sync fa-spinner fa-spin");
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    var userID = "{{ Auth::user()->id }}";
                    var adminID = "{{ Auth::user()->can('admin_laporan_bulanan_verifall') }}";
                    if ($.fn.DataTable.isDataTable('#dttable')) {
                        $('#dttable').DataTable().clear().destroy();
                    }
                    var date = getDateTime();
                    res.show.forEach(item => {
                        if (item.unit) {
                            try {
                                var un = JSON.parse(item.unit);
                            } catch (e) {
                                var un = item.unit;
                            }
                        }
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        content = `<tr id="data` + item.id + `">`;
                        var colorBtn = 'info';
                        if (res.verif.length != 0) {
                            res.verif.forEach(valver => {
                                if (valver.lap_id == item.id) {
                                    colorBtn = 'warning'
                                }
                            });
                        }
                        var colorBtnCat = 'secondary';
                        if (item.has_catatan) {
                            colorBtnCat = 'primary';
                        }
                        content += `<td><center><div class="btn-group btn-group-sm" role="group">`;
                                    if (adminID == true) {
                                        content += `<button class='btn btn-danger-light btn-wave' id="btnHapus`+item.id+`" onclick="hapus(` + item.id + `)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Hapus Laporan"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                                    }
                        content += `<button class='btn btn-teal-light btn-wave' onclick="showWordPreview(${item.id})" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Preview Laporan"><i class="fa-fw fas fa-file-archive nav-icon"></i></button>
                                    <button class='btn btn-success-light btn-wave' onclick="window.location.href='{{ url('/v4/administrasi/berkas/laporan/`+item.id+`') }}'" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Unduh Laporan"><i class="fa-fw fas fa-download nav-icon"></i></button>`;
                        content += `<button class='btn btn-`+colorBtn+`-light btn-wave' id="btnVerif`+item.id+`" onclick="showVerif(` + item.id + `)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Informasi Verifikasi Laporan"><i class="fa-fw fas fa-info-circle nav-icon"></i></button>
                                    <button class='btn btn-`+colorBtnCat+`-light btn-wave' id="btnCatatan`+item.id+`" onclick="showCatatan(` + item.id + `)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Daftar Catatan Laporan"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>`;

                        // if(item.tgl_verif != null) {
                        // } else {
                        //   content += `<button class='btn btn-secondary btn-sm' disabled><i class="fa-fw fas fa-check nav-icon"></i></a></li>`;
                        // };
                        content += `</div></center></td>
                        <td style="white-space: normal; word-wrap: break-word; word-break: break-word;">` + item.nama + `</td>
                        <td style="white-space: normal; word-wrap: break-word; word-break: break-word;">` + un + `</td>
                        <td style="white-space: normal; word-wrap: break-word; word-break: break-word;">
                            <a class="text-uppercase link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline" href="javascript:void(0);"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true"
                            title="Preview Laporan ID # ${item.id}" onclick="showWordPreview(${item.id})">${item.judul}</a>
                        </td>
                        <td>${formatBulanTahun(item.bln, item.thn)}</td><td style="white-space: normal; word-wrap: break-word; word-break: break-word;">`;
                        if (item.ket != null) {
                            content += item.ket;
                        }
                        content += `</td><td style="white-space: normal; word-wrap: break-word; word-break: break-word;">` + new Date(item.updated_at).toLocaleString("sv-SE") + `</td></tr>`;
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [6, "desc"]
                        ],
                        displayLength: 20,
                        lengthChange: true,
                        lengthMenu: [20, 35, 50, 75, 100, 300, 500, 1000],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });
                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan System!',
                        message: xhr.responseText,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    $("#refreshBtn").prop('disabled', false);
                    $("#refreshBtn").find("i").removeClass("fa-spinner fa-spin").addClass("fa-sync");
                }
            });
        }

        function showWordPreview(id) {
            // Bersihkan konten sebelumnya
            $('#show_id_dokumen').append('<i class="fa fa-spinner fa-spin fa-fw"></i>');
            $('#tampil-preview-word').empty().append(`
                <div class="text-center p-3 text-muted">
                    <i class="fas fa-spinner fa-spin"></i> Memuat pratinjau dokumen...
                </div>
            `);
            $('#btn-download-preview').prop('disabled',true);
            $('#previewWord').modal('show');

            $.ajax({
                url: `/api/v4/administrasi/berkas/laporan/preview/${id}`,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    let iframe = '';
                    const fileUrl = res.url;
                    const ext = res.ext;

                    if (['pdf'].includes(ext)) {
                        // PDF: langsung tampil
                        iframe = `<iframe src="${fileUrl}" style="width:100%; height:600px; border:none;"></iframe>`;
                    }
                    else if (['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'].includes(ext)) {
                        // Dokumen Office: gunakan Google Docs Viewer
                        const encodedUrl = encodeURIComponent(fileUrl);
                        iframe = `<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=${encodedUrl}&embedded=true" style="width:100%; height:600px;" frameborder="0"></iframe>`;
                    }
                    else if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
                        // Gambar: langsung tampil
                        iframe = `<img src="${fileUrl}" alt="Preview Gambar" class="img-fluid mx-auto d-block">`;
                    }
                    else if (['txt', 'csv'].includes(ext)) {
                        // Text file
                        iframe = `<iframe src="${fileUrl}" style="width:100%; height:600px; border:none;"></iframe>`;
                    }
                    else {
                        // Format lain — tidak bisa di-preview
                        iframe = `<div class="text-center p-3 text-danger">
                            Format <b>.${ext}</b> tidak bisa dipratinjau.
                            <br><button class="btn btn-primary mt-2" onclick="window.location.href='${fileUrl}'">Download</button>
                        </div>`;
                    }

                    // Masukkan iframe ke container
                    $('#tampil-preview-word').empty().html(iframe);
                    $('#show_id_dokumen').empty().text('ID#'+id);
                    $('#btn-download-preview').prop('disabled',false);
                    $('#btn-download-preview').off('click').on('click', function() {
                        window.location.href = `{{ url('berkas/administrasi/berkas/laporan/${id}') }}`;
                    });
                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan System!',
                        message: xhr.responseText,
                        position: 'topRight'
                    });
                    $('#previewWord').modal('hide');
                }
            })
        }

        function saveData() {
            $("#tambah").one('submit', function() {
                $("#btn-simpan").attr('disabled', 'disabled');
                $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
                return true;
            });
        }

        function showVerif(id) {
            $("#btnVerif"+id).prop('disabled', true);
            $("#btnVerif"+id).find("i").toggleClass("fa-info-circle fa-spinner fa-spin");
            $("#tampil-tbody-verif").empty().append(`<tr><td colspan="5" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/v4/administrasi/berkas/laporan/table/verif/" + id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#show-action').empty();
                    if ($.fn.DataTable.isDataTable('#dttable-verif')) {
                        $('#dttable-verif').DataTable().clear().destroy();
                    }
                    $('#tampil-tbody-verif').empty();
                    var verifBtn = false;
                    // TAMPIL TABEL VERIFIKASI
                    var date = getDateTime();
                    res.forEach(item => {
                        content =   `<tr id="data` + item.id + `">`;
                        if (item.user_id == '{{ Auth::user()->id }}') {
                            content += `<td><button class="btn btn-danger btn-sm" id="batalVerif`+item.id+`" onclick="batalVerif(` + item.id +`)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Batal Verifikasi"><i class="fa-fw fas fa-times nav-icon"></i></button></td>`;
                        } else {
                            content += `<td><button class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-times nav-icon"></i></button></td>`;
                        }
                        content += `<td>` + item.queue + `</td>
                                        <td>` + item.user_name + `</td>
                                        <td style="white-space: normal;">` + item.role_name.toString().replaceAll('"', '').replace(',', ', ').replace('-', ' ').replace('[', '').replace(']', '') + `</td>
                                        <td>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</td>
                                    </tr>`;
                        $('#tampil-tbody-verif').append(content);
                        // VALIDASI SUDAH VERIF ATAU KAH BELUM
                        if (item.user_id == '{{ Auth::user()->id }}') {
                            verifBtn = true;
                        }
                    });
                    var tablev = $('#dttable-verif').DataTable({
                        order: [
                            [1, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '8%' },
                            { sWidth: '8%' },
                            { sWidth: '30%' },
                            { sWidth: '34%' },
                            { sWidth: '20%' },
                        ],
                        displayLength: 20,
                        lengthChange: true,
                        lengthMenu: [20, 35, 50, 75, 100, 300, 500, 1000],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    // TAMPIL BUTTON VERIFIKASI
                    actionBtn = '<div class="d-flex align-items-center justify-content-between mb-2">';
                    actionBtn += `<div class="btn-group btn-group-sm" role="group">`;
                    if (verifBtn == true) {
                        actionBtn += `<button type="button" class="btn btn-secondary waves-effect btn-label waves-light" disabled><i class="fas fa-check label-icon me-1"></i> Verifikasi</button>`;
                    } else {
                        actionBtn += `<button type="button" class="btn btn-primary waves-effect btn-label waves-light" id="verifUser(`+id+`)" onclick="verifUser(`+id+`)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Verifikasi Berkas Laporan ini"><i class="fas fa-check label-icon me-1"></i> Verifikasi</button>`;
                    }
                    actionBtn += `<button type="button" class="btn btn-warning waves-effect waves-light" onclick="showVerif(`+id+`)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Segarkan Tabel Verifikator"><i class="fas fa-sync"></i></button>`;
                    // actionBtn += `<div class="collapse" id="tampil-catatan">
                    //                 <div class="form-group mb-2 mt-2">
                    //                     <textarea class="form-control" id="catatan(`+id+`)" placeholder="Tuliskan Catatan Laporan"></textarea>
                    //                 </div>
                    //                 <button class="btn btn-success" id="btn-simpan-catatan" onclick="saveCatatan(`+id+`)">
                    //                     <i class="fa-fw fas fa-save nav-icon"></i> Simpan Catatan
                    //                 </button>
                    //             </div>`;
                    actionBtn += `</div>`;
                    actionBtn += `<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light" onclick="showCatatan(`+id+`)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Daftar Catatan Laporan"><i class="fas fa-sticky-note me-1"></i> Tambahkan Catatan</button>`;
                    actionBtn += `</div>`;
                    $('#show-action').append(actionBtn);
                    $('#catatan').modal('hide');
                    $('#verif').modal('show');
                    $("#btnVerif"+id).prop('disabled', false);
                    $("#btnVerif"+id).find("i").removeClass("fa-spinner fa-spin").addClass("fa-info-circle");
                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger : 'hover'
                    })
                }
            })
        }

        function showCatatan(id) {
            $('#verif').modal('hide');
            $("#btnCatatan"+id).prop('disabled', true);
            $("#btnCatatan"+id).find("i").toggleClass("fa-sticky-note fa-spinner fa-spin");
            if ($.fn.DataTable.isDataTable('#dttable-catatan')) {
                $('#dttable-catatan').DataTable().clear().destroy();
            }
            $("#tampil-tbody-catatan").empty().append(`<tr><td colspan="6" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/v4/administrasi/berkas/laporan/catatan/" + id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#show-action').empty();
                    $('#btnVerifikasi1').attr('onclick', 'showVerif('+id+')');
                    $('#btnRefreshCatatan').attr('onclick', 'showCatatan('+id+')');
                    $('#id_laporan_tx').text('ID#'+id);
                    $('#id_laporan').val(id);
                    $('#tampil-tbody-catatan').empty();
                    res.forEach(item => {
                        content =   `<tr id="data` + item.id + `">`;
                        if (item.user == '{{ Auth::user()->id }}') {
                            content += `<td><button class="btn btn-danger btn-sm" id="btnHapusCatatan`+item.id+`" onclick="hapusCatatan(` + item.id +`)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Hapus Catatan"><i class="fa-fw fas fa-times nav-icon"></i></button></td>`;
                        } else {
                            content += `<td><button class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-times nav-icon"></i></button></td>`;
                        }
                        if (item.solved == 1) {
                            solved = '<span class="badge rounded-pill text-bg-primary">Terselesaikan</span>';
                        } else {
                            solved = '<span class="badge rounded-pill text-bg-secondary">Belum Terselesaikan</span>';
                        }
                        content += `<td>` + item.id + `</td>
                                        <td>` + item.tgl + `</td>
                                        <td>` + item.nama_user + `</td>
                                        <td style="white-space: normal;">` + item.deskripsi + `</td>
                                        <td>` + solved + `</td>
                                    </tr>`;
                        $('#tampil-tbody-catatan').append(content);
                    });
                    var tables = $('#dttable-catatan').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        // bAutoWidth: false,
                        // aoColumns : [
                        //     { sWidth: '10%' },
                        //     { sWidth: '10%' },
                        //     { sWidth: '20%' },
                        //     { sWidth: '20%' },
                        //     { sWidth: '20%' },
                        //     { sWidth: '20%' },
                        // ],
                        displayLength: 10,
                        lengthChange: true,
                        lengthMenu: [10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });
                    $('#catatan').modal('show');
                    $("#btnCatatan"+id).prop('disabled', false);
                    $("#btnCatatan"+id).find("i").removeClass("fa-spinner fa-spin").addClass("fa-sticky-note");
                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger : 'hover'
                    })
                }
            })
        }

        function hapusCatatan(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Hapus Catatan Laporan ID : ' + id,
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
                        url: "/api/v4/administrasi/berkas/laporan/catatan/" + id + "/delete",
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Hapus Catatan Laporan berhasil pada ' + res,
                                position: 'topRight'
                            });
                            showCatatan($('#id_laporan').val());
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
            });
        }

        function storeCatatan() {
            $("#btnSaveCatatan").prop('disabled', true);
            $("#btnSaveCatatan").find("i").removeClass("fa-save").addClass('fa-spinner fa-spin');
            id_laporan = $('#id_laporan').val();
            deskripsi = $('#catatan_add').val();
            user = "{{ Auth::user()->id }}";
            $.ajax(
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/administrasi/berkas/laporan/catatan/store",
                    type: 'POST',
                    dataType: 'json', // added data type
                    data: {
                        id_laporan: id_laporan,
                        deskripsi: deskripsi,
                        user: user,
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Catatan berhasil ditambahkan pada '+res,
                            position: 'topRight'
                        });
                        showCatatan(id_laporan);
                        refresh();
                        clearCatatan();
                        $("#btnSaveCatatan").prop('disabled', false);
                        $("#btnSaveCatatan").find("i").removeClass("fa-spinner fa-spin").addClass('fa-save');
                    }
                }
            )
        }

        function clearCatatan() {
            $('#catatan_add').val('');
        }

        // Proses Verifikasi Laporan oleh User
        function verifUser(id) {
            $("#verifUser"+id).prop('disabled', true);
            $("#verifUser"+id).find("i").toggleClass("fa-check fa-spinner fa-spin");
            $.ajax({
                url: "/api/v4/administrasi/berkas/laporan/table/verif/" + id + "/user/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#verif').modal('hide');
                    iziToast.success({
                        title: 'Sukses!',
                        message: 'Verifikasi dokumen laporan berhasil oleh ' + res.user_name,
                        position: 'topRight'
                    });
                    refresh();
                },
                error: function(res){
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: JSON.stringify(res.responseJSON.message),
                        position: 'topRight'
                    });
                    console.log("error : " + JSON.stringify(res) );
                }
            })
            $("#verifUser"+id).prop('disabled', false);
            $("#verifUser"+id).find("i").removeClass("fa-spinner fa-spin").addClass("fa-check");
        }

        // Hapus Verifikasi oleh User
        function batalVerif(id) {
            $("#batalVerif"+id).prop('disabled', true);
            $("#batalVerif"+id).find("i").toggleClass("fa-times fa-spinner fa-spin");
            $.ajax({
                url: "/api/v4/administrasi/berkas/laporan/table/verif/" + id + "/batal",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#verif').modal('hide');
                    iziToast.success({
                        title: 'Sukses!',
                        message: 'Batal Verifikasi dokumen laporan '+res+' berhasil',
                        position: 'topRight'
                    });
                    refresh();
                }
            })
            $("#batalVerif"+id).prop('disabled', false);
            $("#batalVerif"+id).find("i").removeClass("fa-spinner fa-spin").addClass("fa-times");
        }

        // HAPUS LAPORAN USER
        function hapus(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Hapus Laporan ID : ' + id,
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
                        url: "/api/v4/administrasi/berkas/laporan/hapus/" + id,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Hapus Dokumen Laporan berhasil pada ' + res,
                                position: 'topRight'
                            });
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
    </script>
@endsection
