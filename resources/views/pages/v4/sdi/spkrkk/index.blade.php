@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Berkas <b class="text-primary link-underline-primary text-decoration-underline">SPK</b> & <b class="text-danger link-underline-danger text-decoration-underline">RKK</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">SDI</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        SPK & RKK
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="alert alert-light shadow-sm" role="alert">
                                    <center>
                                        <strong class="mb-0"><i><b class="text-danger">Form ini</b> diisi oleh komite keperawatan, komite nakesla, komite medik, dan Kepegawaian</i></strong>
                                    </center>
                                </div>
                                <div class="alert alert-light shadow-sm" role="alert">
                                    <small>
                                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> SPK adalah Surat Penugasan Klinis dan RKK adalah Rincian Kewenangan Klinis<br>
                                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Batas maksimum ukuran file yang upload sebesar <b class="text-danger">3 mb</b> (<b>PDF</b>)<br>
                                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> SPK / RKK dapat diubah / hapus apabila berstatus <span class="badge bg-success-transparent p-1">Aktif</span>
                                    </small>
                                </div>
                            </div>
                            {{-- <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Jenis Dokumen <span class="text-danger">*</span></label>
                                    <select class="form-control" id="jns">
                                        <option value="" selected hidden>Pilih</option>
                                        <option value="0">SPK & RKK</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl. Masa Berlaku <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tgl_akhir">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Pegawai <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="pegawai" style="width: 100%" required>
                                        <option value="" selected hidden>Pilih</option>
                                        @foreach ($list['users'] as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea id="deskripsi" class="form-control" placeholder="Tuliskan Keterangan (Optional)" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Upload Dokumen <span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col"><input type="file" class="form-control" id="upload" accept="application/pdf"></div>
                                        <div class="col-auto"><button class="btn btn-primary" onclick="prosesTambahSpkRkk()" id="btn-upload-spkrkk"><i class="fas fa-upload me-1"></i> Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row status_false" hidden>
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <h6 class="text-center mb-0">Dimohon untuk melengkapi Data Status Kepegawaian terlebih dahulu pada <mark>Menu Penetapan</mark> , Silakan <a href="javascript:void(0);" onclick="refreshSpkRkk()"><u>Segarkan</u></a> apabila sudah dilakukan</h6>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0 card-title flex-grow-1">Table</h6>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-sm btn-warning-transparent" id="btn-refresh-spkrkk"
                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom"
                                data-bs-html="true" title="Refresh Tabel SPK & RKK" onclick="refreshSpkRkk()">
                            <i class="fa-fw fas fa-sync nav-icon me-1"></i>Segarkan</button>
                        </div>
                    </div>
                    <div class="card-body status_true">
                        <div class="table-responsive">
                            <table class="table mb-0 table-hover" id="dttable-spkrkk">
                                <thead>
                                    <tr>
                                        <th><center>AKSI</center></th>
                                        <th>RECORD</th>
                                        <th>TGL BERAKHIR</th>
                                        <th>DESKRIPSI</th>
                                        <th class="text-end">TERAKHIR DIUBAH</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody-spkrkk">
                                    <tr>
                                        <td colspan="9" style="font-size:13px">
                                            <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal animate__animated animate__rubberBand fade" id="hapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form <b class="text-danger">Hapus</b> SPK / RKK
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan menghapus <strong>Data SPK / RKK</strong> <kbd>ID:<a id="show_id_hapus"></a></kbd> dari database.
                        Penghapusan data akan menghapus data record pada database dan menghapus file pada storage system. Maka dari itu, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penonaktifan.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuhapus">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="modal-footer text-center">
                    <button type="submit" id="btn-hapus-spkrkk" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapusSpkRkk()"><i class="fas fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>

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
            refreshSpkRkk();
        });

        function refreshSpkRkk() {
            const btn = $("#btn-refresh-spkrkk");
            $("#tampil-tbody-spkrkk").empty();
            $("#tampil-tbody-spkrkk").empty().append(`<tr><td colspan="9" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax(
                {
                    url: "/api/v4/sdi/spkrkk/table",
                    type: 'GET',
                    dataType: 'json', // added data type
                    beforeSend: function() {
                        btn.prop('disabled', true);
                        btn.find("i").addClass("fa-spin");
                    },
                    success: function(res) {
                        $("#tampil-tbody-spkrkk").empty();
                        $('#dttable-spkrkk').DataTable().clear().destroy();
                        res.show.forEach(item => {
                            content = "<tr id='data"+ item.id +"'>";
                            content += `<td><center><div class='dropend'>
                                <a href='javascript:void(0);' class='btn btn-light btn-sm text-muted font-size-16 rounded' data-bs-toggle='dropdown' aria-haspopup="true"><i class="ti ti-dots"></i></a>
                                <div class='dropdown-menu dropdown-menu-end'>`;
                                if (item.deleted_at == null) {
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v4/sdi/profilpegawai/spkrkk/download/`+item.id+`')"><i class='fas fa-download me-1'></i> Download</a>`;
                                } else {
                                    content += `<a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-download me-1'></i> Download</a>`;
                                }
                                if (item.status == 0) {
                                    content += `<a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                    content += `<a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-trash me-1'></i> Hapus</a>`;
                                } else {
                                    content += `<a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                    // content += `<a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbahSpkRkk(`+item.id+`)" value="animate__rubberBand"><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-danger' onclick="showHapusSpkRkk(`+item.id+`)" value="animate__rubberBand"><i class='fas fa-trash me-1'></i> Hapus</a>`;
                                }
                            content += `</div></center></td>`;
                            if (item.deleted_at != null) {
                                bgHapus = `<span class="badge bg-danger-transparent p-1">Terhapus</span>`;
                            } else {
                                bgHapus = ``;
                            }
                            if (item.status != 0) {
                                bgStatus = `<span class="badge bg-success-transparent p-1">Aktif</span>`;
                            } else {
                                bgStatus = `<span class="badge bg-secondary-transparent p-1">Nonaktif</span>`;
                            }
                            content += `<td style='white-space: normal !important;word-wrap: break-word;'>`
                                        + `<div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'>`
                                        + `<h6 class='mb-0'><b class="${item.status != 0?'text-primary':'text-secondary'}">${item.jns_dokumen == 0?'SPK & RKK':'Dokumen Lain'}</b>&nbsp;${item.nama_pegawai}&nbsp;&nbsp;` +bgStatus+ `&nbsp;&nbsp;` + bgHapus + `</h6><small class='text-truncate text-muted'>Oleh ` + item.nama_kepegawaian + `</small>`
                                        + `</div></div></td>`;
                            content += `<td>${item.tgl_berakhir?item.tgl_berakhir:'-'}</td>`;
                            content += `<td>${item.deskripsi?item.deskripsi:'-'}</td>`;
                            content += "<td>" + new Date(item.updated_at).toLocaleString("sv-SE") + "</td></tr>";
                            $('#tampil-tbody-spkrkk').append(content);
                        });
                        var table = $('#dttable-spkrkk').DataTable({
                            order: [
                                [4, "desc"]
                            ],
                            bAutoWidth: false,
                            aoColumns : [
                                { sWidth: '5%' },
                                { sWidth: '40%' },
                                { sWidth: '10%' },
                                { sWidth: '30%' },
                                { sWidth: '15%' },
                            ],
                            displayLength: 10,
                        });
                    },
                    error: function(xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat memproses data',
                            position: 'topRight'
                        });
                    },
                    complete: function() {
                        btn.find("i").removeClass("fa-spin");
                        btn.prop('disabled', false);
                    }
                }
            );
        }

        function prosesTambahSpkRkk() {
            // ISIAN FORM WAJIB
            var jns = $('#jns').val();
            var tgl_akhir = $('#tgl_akhir').val();
            var deskripsi = $('#deskripsi').val();
            var filesAdded = $('#upload')[0].files;

            // EXECUTE
            if (jns == '' || tgl_akhir == '' || filesAdded.length == 0) {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Mohon lengkapi semua data (<span class="text-danger">*</span>) terlebih dahulu dan pastikan tidak ada yang kosong',
                    position: 'topRight'
                });
            } else {
                // INISIALISASI
                var fd = new FormData();
                fd.append('jns_dokumen',0); // 0 = SPK & RKK, 1 = Dokumen Lain
                fd.append('deskripsi',deskripsi);
                fd.append('tgl_berakhir',tgl_akhir);
                fd.append('pegawai_id', $('#pegawai').val());
                fd.append('file',filesAdded[0]);

                // AJAX REQUEST
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/sdi/spkrkk/tambah",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $("#btn-upload-spkrkk").prop('disabled', true);
                        $("#btn-upload-spkrkk").find("i").toggleClass("fa-upload fa-sync fa-spin");
                    },
                    success: function(res){
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'SPK & RKK Pegawai berhasil diupload pada '+res,
                            position: 'topRight'
                        });
                        if (res) {
                            refreshSpkRkk();
                        }
                    },
                    error: function(xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat menambah data',
                            position: 'topRight'
                        });
                    },
                    complete: function() {
                        $("#btn-upload-spkrkk").find("i").removeClass("fa-sync fa-spin").addClass("fa-upload");
                        $("#btn-upload-spkrkk").prop('disabled', false);
                    }
                });
            }
        }

        function showHapusSpkRkk(id) {
            $("#id_hapus").val(id);
            $("#show_id_hapus").text(id);
            var inputs = document.getElementById('setujuhapus');
            inputs.checked = false;
            $('#hapus').modal('show');
        }

        function prosesHapusSpkRkk() {
            const btn = $("#btn-hapus-spkrkk");
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuhapus').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan penghapusan data record SPK / RKK tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_hapus").val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/sdi/spkrkk/hapus/"+id+"/proses",
                    type: 'DELETE',
                    beforeSend: function() {
                        btn.prop('disabled', true);
                        btn.find("i").removeClass("fa-trash").addClass("fa-sync fa-spin");
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Data Record Pegawai telah berhasil dihapus pada '+res,
                            position: 'topRight'
                        });
                        $('#hapus').modal('hide');
                        refreshSpkRkk();
                    },
                    error: function(xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat menghapus data',
                            position: 'topRight'
                        });
                    },
                    complete: function() {
                        btn.find("i").removeClass("fa-sync fa-spin").addClass("fa-trash");
                        btn.prop('disabled', false);
                    }
                });
            }
        }
    </script>
@endsection
