<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="mb-0 card-title flex-grow-1">Dokumen <b class="text-secondary">Pegawai</b></h6>
                <div class="flex-shrink-0">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning-transparent" id="btn-refresh" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Refresh Tabel Dokumen" onclick="refreshDokumen()">
                            <i class="fa-fw fas fa-sync nav-icon me-1"></i>Segarkan</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table dt-responsive table-hover w-100 align-middle" id="dttable-dokumen">
                        <thead>
                            <tr>
                                <th><center>AKSI</center></th>
                                <th>DOKUMEN</th>
                                <th>DESKRIPSI</th>
                                <th><center>STATUS</center></th>
                                <th class="text-end">TERAKHIR DIUBAH</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody-dokumen">
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

<div class="modal fade animate__animated animate__rubberBand" id="ubahDokumen" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Form <b class="text-warning">Ubah Dokumen</b>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="id_edit_dokumen" hidden>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                            <select class="form-control" id="jenis_dokumen_edit"></select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label class="form-label">Nomor Surat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="no_surat_dokumen_edit">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Tgl. Mulai Berlaku <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_mulai_dokumen_edit">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Tgl. Berakhir Surat <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_akhir_dokumen_edit">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea id="deskripsi_dokumen_edit" class="form-control" placeholder="" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Nama File Dokumen</label>
                        <div class="alert alert-secondary">
                            <a id="lampiran_edit"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btn-ubah-dokumen" onclick="prosesUbahDokumen()"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</button>
                <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal animate__animated animate__rubberBand fade" id="hapusDokumen" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Form <b class="text-danger">Hapus Dokumen</b>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="id_hapus_dokumen" hidden>
                <p style="text-align: justify;">Anda akan menghapus berkas dokumen tersebut. Penghapusan berkas akan menyebabkan hilangnya data/dokumen yang terhapus tersebut pada Storage Sistem.
                    Maka dari itu, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapusdokumen">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" id="btn-hapus-dokumen" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapusDokumen()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    });
        function refreshDokumen() {
            const btn = $("#btn-load-dokumen");
            $("#tampil-tbody-dokumen").empty();
            $("#tampil-tbody-dokumen").empty().append(`<tr><td colspan="9" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax(
                {
                    url: `/api/v4/sdi/profilpegawai/dokumen/table/${id_pegawai}`,
                    type: 'GET',
                    dataType: 'json', // added data type
                    beforeSend: function() {
                        btn.prop('disabled', true).empty().append('<i class="fas fa-sync fa-spin me-1"></i> memuat...');
                    },
                    success: function(res) {
                        $("#tampil-tbody-dokumen").empty();
                        $('#dttable-dokumen').DataTable().clear().destroy();
                        res.show.forEach(item => {
                            content = "<tr id='data"+ item.id +"'>";
                            content += `<td><center><div class='dropend'><a href='javascript:void(0);' class='link-${item.status==0?'danger':'success'} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup="true">${item.id}</a><div class='dropdown-menu'>`;
                                if (item.title) {
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v4/sdi/profilpegawai/dokumen/download/`+item.id+`')"><i class='fas fa-download me-1'></i> Download</a>`;
                                } else {
                                    content += `<a href='javascript:void(0);' class='dropdown-item disabled' disabled><i class='fas fa-download me-1'></i> Download</a>`;
                                }
                            content += `</div></center></td>`;
                            content += `<td>
                                            <h6 class="mb-0"><span class="badge me-1" style="font-size: 10px;${item.color?'background-color:'+item.color:''}">${item.nama_ref}</span> ${item.status?item.no_surat:'<s>'+item.no_surat+'</s>'}</h6>`;
                                if (item.tgl_akhir == '' || item.tgl_akhir == null) {
                                    if (item.ref_id == 139) {
                                        content += `<p class="text-muted f-12 mb-0">Masa Berlaku <a class="text-primary">Seumur Hidup</a></p>`;
                                    }
                                } else {
                                    if (item.tgl_mulai == '' || item.tgl_mulai == null) {
                                        content += `<p class="text-muted f-12 mb-0">${item.tgl_akhir}</p>`;
                                    } else {
                                        content += `<p class="text-muted f-12 mb-0">${item.tgl_mulai}&nbsp;<i class="ti ti-arrow-narrow-right text-primary"></i>&nbsp;${item.tgl_akhir}</p>`;
                                    }
                                }
                            content += `</td>
                                        <td style='white-space: normal !important;word-wrap: break-word;'>${item.deskripsi?item.deskripsi:'-'}</td>
                                        <td><center>${item.status?'<span class="badge bg-success">Aktif</span>':'<span class="badge bg-danger">Nonaktif</span>'}</center></td>`;
                            content += "<td>" + new Date(item.updated_at).toLocaleString("sv-SE") + "</td></tr>";
                            $('#tampil-tbody-dokumen').append(content);
                        });
                        var table = $('#dttable-dokumen').DataTable({
                            order: [
                                [4, "desc"]
                            ],
                            bAutoWidth: false,
                            aoColumns : [
                                { sWidth: '5%' },
                                { sWidth: '30%' },
                                { sWidth: '40%' },
                                { sWidth: '10%' },
                                { sWidth: '15%' },
                            ],
                            displayLength: 10,
                        });
                    },
                    error: function(xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat memeriksa data',
                            position: 'topRight'
                        });
                    },
                    complete: function() {
                        btn.prop('disabled', false).empty().html('<i class="ti ti-cloud-download me-2"></i>Dokumen');
                    }
                }
            );
        }
</script>
