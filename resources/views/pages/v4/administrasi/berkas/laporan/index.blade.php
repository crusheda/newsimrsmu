@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Berkas <b class="text-primary link-underline-primary text-decoration-underline">Laporan Rutin</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Administrasi</a>
                    </li>
                    <li class="breadcrumb-item pe-none" aria-current="page">
                        Berkas
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Laporan Rutin
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <div class="btn-group">
                            <button class="btn btn-primary btn-shadow" data-bs-toggle="modal" data-bs-target="#tambah">
                                <i class="ri-git-repository-commits-line me-1"></i> Upload Berkas
                            </button>
                            <button class="btn btn-warning btn-shadow" onclick="refresh()" id="btn-refresh" disabled>
                                <i class="ri-loop-left-line nav-icon"></i></button>
                        </div>
                        <button class="btn btn-info btn-shadow" id="btn-verif" onclick="verif()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Menampilkan Semua Data Laporan Rutin Bawahan">
                            <i class="ri-file-check-line me-1"></i> <span class="align-middle">Verifikasi Laporan Bawahan</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-solid-light shadow-sm">
                            <h6>Baca <b class="text-danger">Saya</b>!</h6>
                            <small>
                                <ul class="mb-0">
                                    <li>Pengubahan atau Penghapusan dokumen laporan hanya berlaku pada <strong class="text-danger">Hari saat Anda mengupload saja</strong></li>
                                    <li>Penghapusan laporan lewat hari hanya dilakukan Oleh Admin Laporan</li>
                                    <li>Tidak ada batasan upload per Bulan, pengguna bebas melakukan upload laporan rutin dengan ketentuan sebagai berikut :
                                        <ul>
                                            <li>File Upload yang disarankan berupa Dokumen PDF <b class="text-pink">(.pdf)</b> dan Word <b class="text-pink">(.doc/.docx)</b></li>
                                            <li>Batas ukuran maksimum dokumen adalah <b class="text-primary">5 mb</b></li>
                                        </ul>
                                    </li>
                                    <li>Laporan yang sudah diverifikasi <b class="text-danger">TIDAK BISA</b> diubah atau dihapus kembali</li>
                                    <li>Catatan dan Verifikator diisi oleh Atasan atau bisa juga oleh Admin</li>
                                </ul>
                            </small>
                        </div>
                        <div class="table-responsive">
                            <table id="dttable" class="table dt-responsive table-hover nowrap w-100 align-middle">
                                <thead>
                                    <tr>
                                        <th class="cell-fit">
                                            <center>#ID</center>
                                        </th>
                                        <th>JUDUL LAPORAN RUTIN</th>
                                        <th>BLN / THN</th>
                                        <th>KETERANGAN</th>
                                        <th>CATATAN</th>
                                        <th>VERIFIKATOR</th>
                                        <th>DIUPDATE</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody">
                                    <tr>
                                        <td colspan="6" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Menginisialisasi data...</center></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="cell-fit">
                                            <center>#ID</center>
                                        </th>
                                        <th>JUDUL LAPORAN RUTIN</th>
                                        <th>BLN / THN</th>
                                        <th>KETERANGAN</th>
                                        <th>CATATAN</th>
                                        <th>VERIFIKATOR</th>
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
    {{-- TAMBAH --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="tambah" data-bs-backdrop="static" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form <b class="text-primary">Tambah</b>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form class="form-auth-small needs-validation" name="formTambah" onsubmit="return saveData()" action="{{ route('v4.administrasi.berkas.laporan.store') }}" method="POST"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert svg-danger alert-danger alert-dismissible fade show custom-alert-icon shadow-sm mb-3">
                                    Pengubahan atau Penghapusan dokumen laporan hanya berlaku pada <strong class="text-danger">Hari saat Anda mengupload saja</strong>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Pilih Bulan <a class="text-danger">*</a></label>
                                    <select class="select2 form-control" name="bln" id="bln-tambah" style="width: 100%" required>
                                        <option value="">Bulan</option>
                                        <?php
                                        $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        $jml_bln = count($bulan);
                                        for ($c = 1; $c < $jml_bln; $c += 1) {
                                            echo "<option value=$c> $bulan[$c] </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Pilih Tahun <a class="text-danger">*</a></label>
                                    <select class="select2 form-control" name="thn" id="thn-tambah" style="width: 100%" required>
                                        <option value="">Tahun</option>
                                        @for ($i = $list['thn']-1; $i <= $list['thn']; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Judul Laporan Rutin <a class="text-danger">*</a></label>
                                    <input type="text" name="judul" class="form-control"
                                        placeholder="Laporan Rutin Unit X" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea rows="3" class="form-control" name="ket" id="ket" placeholder="Optional"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Upload Dokumen <a class="text-danger">*</a></label>
                                    <div class="alert alert-solid-light shadow-sm">
                                        <i class="fa-fw fas fa-caret-right nav-icon"></i> File Upload yang disarankan berupa Dokumen <b><b class="text-pink">PDF</b></b> (<i>.pdf</i>) dan <b><b class="text-pink">Word</b></b> (<i>.doc/.docx</i>)<br>
                                        <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum dokumen adalah <b class="text-primary">5 mb</b>
                                    </div>
                                    <input type="file" name="file" class="form-control" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-simpan"><i
                            class="fa-fw fas fa-save nav-icon me-1"></i> Simpan</button>
                    </form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-fw fas fa-times nav-icon me-1"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- UBAH --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="ubah" data-bs-backdrop="static"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                            Form <b class="text-warning">Ubah</b> <span class="badge bg-warning badge-sm ms-1 align-middle"><a id="show_edit"></a></span>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" class="form-control" hidden>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert svg-danger alert-danger alert-dismissible fade show custom-alert-icon shadow-sm mb-3">
                                Pengubahan atau Penghapusan dokumen laporan hanya berlaku pada <strong class="text-danger">Hari saat Anda mengupload saja</strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Bulan <a class="text-danger">*</a></label>
                                <select class="select2 form-control" id="bln_edit" style="width: 100%" required></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Tahun <a class="text-danger">*</a></label>
                                <select class="select2 form-control" id="thn_edit" style="width: 100%" required></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Judul Laporan Rutin <a class="text-danger">*</a></label>
                                <input type="text" id="judul_edit" class="form-control"
                                    placeholder="Laporan Rutin Unit X" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea rows="3" class="form-control" id="ket_edit" placeholder="Optional"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Dokumen Upload</label>
                                <div id="file_edit"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-simpan-edit" onclick="ubah()"><i
                            class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
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
    {{-- <div class="modal fade animate__animated animate__bounceInRight" id="info" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Informasi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <h5 class="mb-0">Cara Setting PDF Viewer pada browser Google Chrome</h5>
                    <sub>Terdapat 2 cara untuk melihat laporan bulanan PDF tanpa mendownload. Apabila anda menggunakan
                        browser Firefox, silakan abaikan semua langkah di bawah.</sub>
                    <div class="divider text-end">
                        <div class="divider-text">Plugin PDF Viewer</div>
                    </div>
                    <p>
                    <h6>1. Instal plugin untuk Google Chrome dengan membuka Link <a target="_blank"
                            href="https://chrome.google.com/webstore/detail/pdf-viewer/oemmndcbldboiebfnladdacbdfmadadm?hl=in"><u>Disini</u></a>
                    </h6>
                    <h6>2. Klik <strong>Tambahkan ke Chrome</strong></h6>
                    <img src="{{ asset('img/pdf-viewer/1.jpg') }}" class="img-fluid" alt="">
                    <h6>3. Klik <strong>Add extension</strong></h6>
                    <img src="{{ asset('img/pdf-viewer/2.jpg') }}" class="img-fluid" alt="">
                    </p>
                    <div class="divider text-end">
                        <div class="divider-text">Mode Incognito (Private Browser)</div>
                    </div>
                    <p>
                    <h6>1. Masuk ke Menu Chrome dengan cara klik tombol Titik Tiga di Pojok Kanan Atas</h6>
                    <img src="{{ asset('img/pdf-viewer/3.jpg') }}" class="img-fluid mb-3" alt="">
                    <h6>2. Klik tombol <strong>New Incognito Window</strong> atau dengan menekan kombinasi tombol
                        <strong>Ctrl+Shift+N</strong></h6>
                    <h6>3. Masuk/Login <strong>Simrsmu</strong> kembali pada Mode Incognito tersebut dan anda sudah bisa
                        melihat dokumen Laporan Bulanan tanpa harus mendownloadnya terlebih dahulu</h6>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div> --}}

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

        // FUNCTION
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
            if ($.fn.DataTable.isDataTable('#dttable')) {
                $('#dttable').DataTable().clear().destroy();
            }
            $("#tampil-tbody").empty().append(`<tr><td colspan="6" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/v4/administrasi/berkas/laporan/table/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    $("#btn-refresh").prop('disabled', true);
                    $("#btn-refresh").find("i").addClass('fa-spin');
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    var date = getDateTime();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        if (item.has_verified) {
                            colorBtn = 'success';
                        } else {
                            if (updet == date) {
                                colorBtn = 'info';
                            } else {
                                colorBtn = 'secondary';
                            }
                        }
                        content = `<tr id="data` + item.id + `">`;
                        content += `<td><center>
                              <div class='btn-group'>
                                <a href='javascript:void(0);' class='link-${colorBtn} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' id="dropdown-${item.id}" data-bs-toggle='dropdown' aria-expanded='false'>${item.id}</a>
                                <ul class='dropdown-menu dropdown-menu-end'>
                                  <li><a href='javascript:void(0);' class='dropdown-item text-info' onclick="showWordPreview(${item.id})"><i class="fa-fw fas fa-file-archive nav-icon"></i> Preview</a></li>
                                  <li><a href='javascript:void(0);' class='dropdown-item text-success' onclick="window.location.href='{{ url('/v4/administrasi/berkas/laporan/`+item.id+`') }}'"><i class="fa-fw fas fa-download nav-icon"></i> Download</a></li>`;
                        if (updet == date) {
                            if (item.has_verified) {
                                content +=
                                    `<li><a href="javascript:void(0);" class='dropdown-item text-secondary' disabled><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                                    <li><a href='javascript:void(0);' class='dropdown-item text-secondary' disabled><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                            } else {
                                content +=
                                    `<li><a href="javascript:void(0);" class='dropdown-item text-warning' onclick="showUbah(` +
                                    item.id +
                                    `)"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                                    <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` +
                                    item.id +
                                    `)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                            }
                        }
                        content += `</ul></div></center></td>`;
                        content += `<td style="white-space: normal; word-wrap: break-word; word-break: break-word;">` + item.judul + ` `;
                        if (item.has_verified) {
                            content += `<i class="ri-verified-badge-fill text-success ms-1" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Laporan Terverifikasi"></i>`;
                        }
                        if (item.has_catatan) {
                            content += `<i class="ri-sticky-note-fill text-warning ms-1" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Laporan Memiliki Catatan"></i>`;
                        }
                        content += `</td>`;
                        content += `<td>` + formatBulanTahun(item.bln, item.thn) + `</td>
                                    <td style="white-space: normal; word-wrap: break-word; word-break: break-word;">${item.ket?item.ket:''}</td>`;
                        // LIST CATATAN
                        content += `<td>`;
                        if (item.catatan_list && item.catatan_list.length > 0) {
                            content += `<ul>`;
                            item.catatan_list.forEach(cat => {
                                content += `<li style="white-space: normal; word-wrap: break-word; word-break: break-word;">${cat.deskripsi}<br><small><mark>Ditambahkan Oleh</mark> <span class="badge bg-light-warning">${cat.nama_user}</span></small></li>`;
                            })
                            content += `</ul>`;
                        } else {
                            content += `-`;
                        }
                        content += `</td>`;
                        // LIST USERS VERIF
                        content += `<td>`;
                        if (item.verif_list && item.verif_list.length > 0) {
                            content += `<ol>`;
                            item.verif_list.forEach(ver => {
                                content += `<li style="white-space: normal; word-wrap: break-word; word-break: break-word;">${ver.nama_user}</li>`;
                            })
                            content += `</ol>`;
                        } else {
                            content += `-`;
                        }
                        content += `</td>`;
                        content += `<td class='text-start'>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</td>`;
                        content += `</tr>`;
                        $('#tampil-tbody').append(content);

                        // Showing Tooltip
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger : 'hover'
                        })
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [6, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '25%' },
                            { sWidth: '10%' },
                            { sWidth: '15%' },
                            { sWidth: '20%' },
                            { sWidth: '15%' },
                            { sWidth: '10%' },
                        ],
                        displayLength: 10,
                        lengthChange: true,
                        lengthMenu: [10, 25, 50, 75, 100, 500],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan System!',
                        message: xhr.responseText ?? 'Terjadi kesalahan saat memuat data.',
                        position: 'topRight'
                    });
                },
                complete: function() {
                    $("#btn-refresh").prop('disabled', false);
                    $("#btn-refresh").find("i").removeClass("fa-spin");
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
                        window.location.href = `{{ url('/v4/administrasi/berkas/laporan/${id}') }}`;
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

        function tambah() {
            $("#btn-tambah").prop('disabled', true);
            $("#btn-tambah").find("i").toggleClass("fa-plus fa-sync fa-spin");
            $.ajax({
                url: "/api/v4/administrasi/berkas/laporan/formupload/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    if (res === 1) {
                        $('#tambah').modal('show');
                    } else {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Anda tidak memiliki Hak Akses Tambah Laporan Rutin, silakan hubungi IT',
                            position: 'topRight'
                        });
                    }
                    $("#btn-tambah").prop('disabled', false);
                    $("#btn-tambah").find("i").removeClass("fa-sync fa-spin").addClass("fa-plus");
                },
                error: function(res) {}
            });
        }

        function verif() {
            $("#btn-verif").prop('disabled', true);
            $("#btn-verif").find("i").toggleClass("fa-history fa-sync fa-spin");
            $.ajax({
                url: "/api/v4/administrasi/berkas/laporan/formverif/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    if (res === 1) {
                        window.location.href = "./laporan/verif";
                    } else {
                        if (res === 2) {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: 'Anda tidak memiliki Akses untuk Verifikasi Laporan Bawahan atau Akses Laporan Bawahan tidak ditemukan. Silakan hubungi IT.',
                                position: 'topRight'
                            });
                        } else {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: 'Akun Anda tidak ditemukan pada Database Kami. Silakan hubungi IT.',
                                position: 'topRight'
                            });
                        }
                    }
                    $("#btn-verif").prop('disabled', false);
                    $("#btn-verif").find("i").removeClass("fa-sync fa-spin").addClass("fa-history");
                },
                error: function(res) {}
            });
        }

        function saveData() {
            let bln   = $('#bln-tambah').val();
            let thn   = $('#thn-tambah').val();
            let judul = $('input[name="judul"]').val();
            let file  = $('input[name="file"]')[0].files[0];

            if (!bln) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Bulan wajib dipilih',
                    position: 'topRight'
                });
                return false;
            }

            if (!thn) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Tahun wajib dipilih',
                    position: 'topRight'
                });
                return false;
            }

            if (!judul) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Judul wajib diisi',
                    position: 'topRight'
                });
                return false;
            }

            if (!file) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Dokumen wajib diupload',
                    position: 'topRight'
                });
                return false;
            }

            // Validasi ukuran file (5MB = 5242880 bytes)
            if (file.size > 5242880) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Ukuran file maksimal 5 MB',
                    position: 'topRight'
                });
                return false;
            }

            // Validasi tipe file
            let allowed = ['application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

            if (!allowed.includes(file.type)) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'File harus berupa PDF atau Word',
                    position: 'topRight'
                });
                return false;
            }

            // Kalau lolos semua
            $("#btn-simpan").attr('disabled', true);
            $("#btn-simpan").find("i").removeClass("fa-save").addClass("fa-spinner fa-spin");

            return true;
        }

        function showUbah(id) {
            $.ajax({
                url: "/api/v4/administrasi/berkas/laporan/getubah/" + id,
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    $("#dropdown-" + id).empty().append(`<i class="fa fa-spinner fa-spin fa-fw"></i>`);
                    $("#bln_edit").find('option').remove();
                    $("#thn_edit").find('option').remove();
                },
                success: function(res) {
                    // var tgl = res.tgl + 'T' + res.waktu;
                    document.getElementById('show_edit').innerHTML = "ID : " + res.show.id;
                    $("#id_edit").val(res.show.id);
                    $("#judul_edit").val(res.show.judul);
                    $("#ket_edit").val(res.show.ket);
                    for (c = 1; c < res.jml_bulan; c++) {
                        $("#bln_edit").append(`
                            <option value="${c}" ${c == res.show.bln? "selected":""}>` + res.bulan[c] + `</option>
                        `);
                    }
                    let currentYear = new Date().getFullYear();
                    let startYear   = currentYear - 1;
                    for (let i = startYear; i <= currentYear; i++) {
                        $("#thn_edit").append(`
                            <option value="${i}" ${i == res.show.thn ? "selected" : ""}>
                                ${i}
                            </option>
                        `);
                    }
                    $("#file_edit").empty();
                    $("#file_edit").append(`<b>
                                                <u><a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline" href="./laporan/${res.show.id}" data-bs-toggle="tooltip"
                                                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                                        title="Download Berkas ${res.show.judul}"><i>${res.show.title}</i></a></u>
                                                <span class="badge bg-info-transparent ms-1">${res.sizeFile} Mb</span>
                                            </b>`);
                    // document.getElementById('tgl_edit').innerHTML = res.sizeFile;
                    $('#ubah').modal('show');
                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan System!',
                        message: xhr.responseText,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    // Initialize tooltip setelah konten dimuat
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger : 'hover'
                    });
                    $("#dropdown-" + id).empty().text(id);
                }
            });
        }

        function ubah() {
            var id = $("#id_edit").val();
            var judul = $("#judul_edit").val();
            var ket = $("#ket_edit").val();
            var bln = $("#bln_edit").val();
            var thn = $("#thn_edit").val();

            if (!bln) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Bulan wajib dipilih',
                    position: 'topRight'
                });
                return;
            }

            if (!thn) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Tahun wajib dipilih',
                    position: 'topRight'
                });
                return;
            }

            if (!judul) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Judul wajib diisi',
                    position: 'topRight'
                });
                return;
            }

            if (judul.length > 255) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Judul maksimal 255 karakter',
                    position: 'topRight'
                });
                return;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '/api/v4/administrasi/berkas/laporan/ubah/' + id,
                dataType: 'json',
                data: {
                    id: id,
                    judul: judul,
                    ket: ket,
                    bln: bln,
                    thn: thn,
                },
                beforeSend: function() {
                    $("#btn-simpan-edit").attr('disabled', true);
                    $("#btn-simpan-edit").find("i").removeClass("fa-save").addClass("fa-spinner fa-spin");
                },
                success: function(res) {
                    iziToast.success({
                        title: 'Sukses!',
                        message: 'Ubah data laporan ID#' + id + ' berhasil pada ' + res,
                        position: 'topRight'
                    });
                    $('#ubah').modal('hide');
                    refresh();
                },
                error: function(xhr) {

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let pesan = '';

                        $.each(errors, function(key, value) {
                            pesan += value[0] + '\n';
                        });

                        Swal.fire({
                            title: `Gagal diubah!`,
                            text: pesan,
                            icon: `error`,
                            showConfirmButton: false,
                            showCancelButton: false,
                            allowOutsideClick: true,
                            allowEscapeKey: true,
                            timer: 3000,
                            timerProgressBar: true,
                            backdrop: `rgba(26,27,41,0.8)`,
                        });
                    } else {
                        Swal.fire({
                            title: `Gagal diubah!`,
                            text: xhr.responseText,
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
                }, complete: function() {
                    $("#btn-simpan-edit").attr('disabled', false);
                    $("#btn-simpan-edit").find("i").removeClass("fa-spinner fa-spin").addClass("fa-save");
                }
            });
        }

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
                                message: 'Hapus Dokumen Laporan ID#' + id + ' berhasil pada ' + res,
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
