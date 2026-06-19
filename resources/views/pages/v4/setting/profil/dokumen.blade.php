<div class="card custom-card">
    <div class="card-header fw-bold justify-content-between">
        <div>
            Daftar
            <b class="text-teal">
                Dokumen
            </b>
        </div>
        <div>
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-warning-transparent btn-wave" onclick="loadDokumen()">
                    <i class="fas fa-sync me-1" data-bs-toggle="tooltip"
                        title="Refresh Daftar Dokumen Upload"></i>
                    Refresh Tabel
                </button>
            </div>
        </div>
    </div>
    <div class="card-body pb-0">
        {{-- <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0 flex-grow-1">
                <a class="text-danger">*</a>
                /x
                <small>
                    dokumen wajib sudah
                    terupload.
                </small>
            </h5>
            <div class="flex-shrink-0" id="switch-str" hidden>
                <div class="form-check form-switch custom-switch-v1 switch-sm">
                    <input type="checkbox" class="form-check-input input-primary"
                        id="checkboxseumurhidup" />
                    <label class="form-check-label" htmlFor="checkboxseumurhidup">
                        Seumur Hidup ?
                    </label>
                </div>
            </div>
        </div>
        <hr class="my-2" /> --}}
        <div class="row">
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label">
                        Jenis Surat
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <select class="form-control" id="jenis_dokumen">
                        <option value="" hidden>
                            Pilih Jenis Surat
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label">
                        Tgl. Mulai Berlaku
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <input type="date" class="form-control" id="tgl_mulai_dokumen" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label">
                        Tgl. Berakhir Surat
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <input type="date" class="form-control" id="tgl_akhir_dokumen" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label">
                        Nomor Surat
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <input type="text" class="form-control" id="no_surat_dokumen"
                        placeholder="e.g. III.l23213.AKBV" />
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group mb-3">
                    <label class="form-label">
                        Deskripsi
                    </label>
                    <textarea class="form-control" id="deskripsi_dokumen" placeholder="Tuliskan Keterangan (Optional)" rows="3"></textarea>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group mb-3 d-flex flex-column">
                    <label class="form-label">
                        Upload Dokumen
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <div class="row mb-2">
                        <div class="col">
                            <input type="file" class="form-control form-control-sm"
                                id="upload_dokumen" accept="application/pdf" />
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary" id="btn-upload-dokumen" onclick="prosesTambahDokumen()">
                                <i class="fas fa-upload me-1"></i>
                                Upload
                            </button>
                        </div>
                    </div>
                    <span class="d-block fs-12 text-muted mt-1">
                        Ekstensi Wajib
                        <b class="text-warning">PDF</b>.
                        Maksimal <b class="text-danger">2 Mb</b>.
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mb-0 table-hover text-nowrap w-100 dataTable no-footer"
                id="dttable-dokumen">
                <thead>
                    <tr>
                        <th>
                            <center>
                                AKSI
                            </center>
                        </th>
                        <th>DOKUMEN SURAT</th>
                        <th>DESKRIPSI</th>
                        <th>
                            <center>
                                STATUS
                            </center>
                        </th>
                        <th class="text-end">
                            TERAKHIR DIPERBARUI
                        </th>
                    </tr>
                </thead>
                <tbody id="tampil-tbody-dokumen">
                    <tr>
                        <td colSpan="9" style="font-size: 13px">
                            <center>
                                <i class="fa fa-spinner fa-spin fa-fw"></i>
                                Memproses
                                data...
                            </center>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal animate__animated animate__rubberBand fade" id="hapusDokumen" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Form Hapus Dokumen
                </h4>
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
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var divswitchstr    = $("#switch-str");
        var switchstr       = $("#checkboxseumurhidup");
        var jenis           = $("#jenis_dokumen");
        var tgl_mulai       = $("#tgl_mulai_dokumen");
        var tgl_akhir       = $("#tgl_akhir_dokumen");
        var no_surat        = $("#no_surat_dokumen");
        var deskripsi       = $("#deskripsi_dokumen");
        var upload          = $("#upload_dokumen");

        jenis.change(function() {
            // INIT
            switchstr.prop('checked', false);
            tgl_mulai.prop('disabled',false);
            tgl_akhir.prop('disabled',false);
            no_surat.prop('disabled',false);
            deskripsi.prop('disabled',false);
            upload.prop('disabled',false);

            if (jenis.val() == 139) { // STR
                divswitchstr.prop('hidden',false);
            } else {
                divswitchstr.prop('hidden',true);
            }

            if (jenis.val() == 141 || jenis.val() == 153) { // BTCLS & ACLS
                tgl_mulai.prop('disabled',true);
                no_surat.prop('disabled',true);
                deskripsi.prop('disabled',true);
            } else {
                tgl_mulai.prop('disabled',false);
                no_surat.prop('disabled',false);
                deskripsi.prop('disabled',false);
            }
        })

        switchstr.change(function() {
            // var validateStr = switchstr.is(":checked");
            if (switchstr.is(":checked")) {
                tgl_mulai.prop('disabled',true);
                tgl_akhir.prop('disabled',true);
                deskripsi.prop('disabled',true);
                // upload.prop('disabled',true);
            } else {
                tgl_mulai.prop('disabled',false);
                tgl_akhir.prop('disabled',false);
                deskripsi.prop('disabled',false);
                // upload.prop('disabled',false);
            }
        })
    });

    function loadDokumen() {
        var switchstr       = $("#checkboxseumurhidup");
        var jenis           = $("#jenis_dokumen");
        var tgl_mulai       = $("#tgl_mulai_dokumen");
        var tgl_akhir       = $("#tgl_akhir_dokumen");
        var no_surat        = $("#no_surat_dokumen");
        var deskripsi       = $("#deskripsi_dokumen");
        var upload          = $("#upload_dokumen");
        var userID          = @json(Auth::user()->id);

        // INIT
        switchstr.prop('checked', false);
        jenis.val('');
        tgl_mulai.prop('disabled',false).val('');
        tgl_akhir.prop('disabled',false).val('');
        no_surat.prop('disabled',false).val('');
        deskripsi.prop('disabled',false).val('');
        upload.prop('disabled',false).val('');

        // MULAI TABEL
        $("#tampil-tbody-dokumen").empty();
        $("#tampil-tbody-dokumen").empty().append(`<tr><td colspan="9" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
        $.ajax(
            {
                url: `/api/v4/profil/dokumen/table/${userID}`,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {

                    jenis.find('option').remove();
                    jenis.append(`<option value="" hidden>Pilih Jenis Surat</option>`);
                    res.ref_dokumen.forEach(item => {
                        jenis.append(`
                            <option value="${item.id}">${item.deskripsi}</option>
                        `);
                    });

                    var adminID = @json(Auth::user()->can(['admin_kepegawaian','admin_kepegawaian_kepala']));
                    $("#tampil-tbody-dokumen").empty();
                    $('#dttable-dokumen').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = "<tr id='data"+ item.id +"'>";
                        content += `<td><center><div class='dropend'><a href='javascript:void(0);' class='btn btn-light btn-sm text-muted font-size-16 rounded' data-bs-toggle='dropdown' aria-haspopup="true"><i class="ti ti-dots"></i></a><div class='dropdown-menu'>`;
                            if (item.title) {
                                content += `<a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v4/profil/dokumen/download/`+item.id+`')"><i class='fas fa-download me-1'></i> Download</a>`;
                            } else {
                                content += `<a href='javascript:void(0);' class='dropdown-item disabled' disabled><i class='fas fa-download me-1'></i> Download</a>`;
                            }
                            if (item.status) {
                                if (adminID) {
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbahDokumen(`+item.id+`)" value="animate__rubberBand"><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-danger' onclick="showHapusDokumen(`+item.id+`)" value="animate__rubberBand"><i class='fas fa-trash me-1'></i> Hapus</a>`;
                                } else {
                                    if (item.user_id == userID) {
                                        content += `<a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbahDokumen(`+item.id+`)" value="animate__rubberBand"><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                        content += `<a href='javascript:void(0);' class='dropdown-item text-danger' onclick="showHapusDokumen(`+item.id+`)" value="animate__rubberBand"><i class='fas fa-trash me-1'></i> Hapus</a>`;
                                    } else {
                                        content += `<a href='javascript:void(0);' class='dropdown-item disabled' value="animate__rubberBand" disabled><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                        content += `<a href='javascript:void(0);' class='dropdown-item disabled' value="animate__rubberBand" disabled><i class='fas fa-trash me-1'></i> Hapus</a>`;
                                    }
                                }
                            } else {
                                content += `<a href='javascript:void(0);' class='dropdown-item disabled' value="animate__rubberBand" disabled><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                content += `<a href='javascript:void(0);' class='dropdown-item disabled' value="animate__rubberBand" disabled><i class='fas fa-trash me-1'></i> Hapus</a>`;
                            }
                        content += `</div></center></td>`;
                        content += `<td>
                                        <h6 class="mb-0"><span class="badge me-1" style="font-size: 10px;${item.color?'background-color:'+item.color:''}">${item.nama_ref}</span> ${item.status?item.no_surat:'<s>'+item.no_surat+'</s>'}</h6>`;
                            if (item.tgl_akhir == '' || item.tgl_akhir == null) {
                                if (item.ref_id == 139) {
                                    content += `<p class="text-muted f-10 mb-0">Masa Berlaku <a class="text-primary">Seumur Hidup</a></p>`;
                                }
                            } else {
                                if (item.tgl_mulai == '' || item.tgl_mulai == null) {
                                    content += `<p class="text-muted f-10 mb-0">${item.tgl_akhir}</p>`;
                                } else {
                                    content += `<p class="text-muted f-10 mb-0">${item.tgl_mulai}&nbsp;<i class="ti ti-arrow-narrow-right text-primary"></i>&nbsp;${item.tgl_akhir}</p>`;
                                }
                            }
                        content += `</td>
                                    <td style='white-space: normal !important;word-wrap: break-word;'>${item.deskripsi?item.deskripsi:'-'}</td>
                                    <td><center>${item.status?'<span class="badge bg-success fs-16">Aktif</span>':'<span class="badge bg-danger fs-16">Nonaktif</span>'}</center></td>`;
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
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Dokumen tidak ditemukan.',
                        position: 'topRight'
                    });
                }
            }
        );
    }

    function prosesTambahDokumen() {
        $("#btn-upload-dokumen").prop('disabled', true);
        $("#btn-upload-dokumen").find("i").toggleClass("fa-upload fa-sync fa-spin");

        var user_id         = @json(Auth::user()->id);
        var jenis           = $("#jenis_dokumen").val();
        var tgl_mulai       = $("#tgl_mulai_dokumen").val();
        var tgl_akhir       = $("#tgl_akhir_dokumen").val();
        var no_surat        = $("#no_surat_dokumen").val();
        var deskripsi       = $("#deskripsi_dokumen").val();
        var filex           = $('#upload_dokumen')[0].files.length;
        var switchstr       = $("#checkboxseumurhidup").is(":checked");
        var validasi        = true;

        // PROSES VALIDASI INPUT DOKUMEN
        if (jenis == '') {
            validasi = false;
        } else {
            if (jenis == 139) { // STR
                if (switchstr) { // STR SEUMUR HIDUP
                    if (jenis == '' || no_surat == '' || filex == 0) {
                        validasi = false;
                    }
                } else { // STR BELUM SEUMUR HIDUP
                    if (jenis == '' || tgl_mulai == '' || tgl_akhir == '' || no_surat == '' || filex == 0) {
                        validasi = false;
                    } else {
                        if (tgl_mulai == tgl_akhir) {
                            validasi = false;
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: 'Tanggal Mulai Berlaku tidak diperbolehkan sama dengan Tanggal Berakhir Surat',
                                position: 'topRight'
                            });
                        }
                    }
                }
            } else {
                if (jenis == 141 || jenis == 153) { // BTCLS/ACLS
                    if (jenis == '' || tgl_akhir == '' || filex == 0) {
                        validasi = false;
                    }
                } else { // INPUT JENIS LAINNYA
                    if (jenis == '' || tgl_mulai == '' || tgl_akhir == '' || no_surat == '' || filex == 0) {
                        validasi = false;
                    } else {
                        if (tgl_mulai == tgl_akhir) {
                            validasi = false;
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: 'Tanggal Mulai Berlaku tidak diperbolehkan sama dengan Tanggal Berakhir Surat',
                                position: 'topRight'
                            });
                        }
                    }
                }
            }
        }

        // PROSES SIMPAN DOKUMEN
        if (validasi == false) {
            iziToast.warning({
                title: 'Pesan Ambigu!',
                message: 'Mohon lengkapi semua data (<span class="text-danger">*</span>) terlebih dahulu dan pastikan tidak ada yang kosong',
                position: 'topRight'
            });
        } else {
            var fd = new FormData();

            // Get the selected file
            var files = $('#upload_dokumen')[0].files;

            fd.append('file',files[0]);
            fd.append('user_id',user_id);
            fd.append('jenis',jenis);
            fd.append('tgl_mulai',tgl_mulai);
            fd.append('tgl_akhir',tgl_akhir);
            fd.append('no_surat',no_surat);
            fd.append('deskripsi',deskripsi);

            // AJAX request
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/profil/dokumen/add",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Dokumen bernama berhasil ditambahkan pada '+res,
                        position: 'topRight'
                    });
                    if (res) {
                        loadDokumen();
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON,
                        position: 'topRight'
                    });
                }
            });
        }

        $("#btn-upload-dokumen").find("i").removeClass("fa-sync fa-spin").addClass("fa-upload");
        $("#btn-upload-dokumen").prop('disabled', false);
    }

    function showUbahDokumen(id) {
        $.ajax(
        {
            url: "/api/v4/profil/dokumen/ubah/"+id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#id_edit_dokumen").val(id);
                $("#jenis_dokumen_edit").find('option').remove();
                res.ref_dokumen.forEach(item => {
                    $("#jenis_dokumen_edit").append(`
                        <option value="${item.id}" ${item.id == res.show.ref_id? "selected":""}>${item.deskripsi}</option>
                    `);
                });
                $('#tgl_mulai_dokumen_edit').val(res.show.tgl_mulai);
                $('#tgl_akhir_dokumen_edit').val(res.show.tgl_akhir);
                $('#no_surat_dokumen_edit').val(res.show.no_surat);
                $('#deskripsi_dokumen_edit').val(res.show.deskripsi);
                $('#lampiran_edit').text(res.show.title);
                $('#ubahDokumen').modal('show');
            }
        })
    }

    function prosesUbahDokumen()
    {
        $("#btn-ubah-dokumen").prop('disabled', true);
        $("#btn-ubah-dokumen").find("i").toggleClass("fa-edit fa-sync fa-spin");

        var jenis       = $("#jenis_dokumen_edit").val();
        var tgl_mulai   = $("#tgl_mulai_dokumen_edit").val();
        var tgl_akhir   = $("#tgl_akhir_dokumen_edit").val();
        var no_surat    = $("#no_surat_dokumen_edit").val();
        var deskripsi    = $("#deskripsi_dokumen_edit").val();

        if (jenis == "" || tgl_mulai == "" || tgl_akhir == "" || no_surat == "") {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon lengkapi kolom pengisian wajib *',
                position: 'topRight'
            });
        } else {
            var fd = new FormData();
            var id_edit = $("#id_edit_dokumen").val();

            // Get the selected file
            // if ($("#verifberkas"+id_edit).val() == 1) {
            //     var files = $('#filex'+id_edit)[0].files;
            //     fd.append('file',files[0]);
            // }

            fd.append('id',id_edit);
            fd.append('jenis',jenis);
            fd.append('tgl_mulai',tgl_mulai);
            fd.append('tgl_akhir',tgl_akhir);
            fd.append('no_surat',no_surat);
            fd.append('deskripsi',deskripsi);

            // AJAX request
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/profil/dokumen/ubah/"+id_edit+"/proses",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Dokumen berhasil diperbarui pada '+res,
                        position: 'topRight'
                    });
                    if (res) {
                        $('#ubahDokumen').modal('hide');
                        loadDokumen();
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
                }
            });
        }

        $("#btn-ubah-dokumen").find("i").removeClass("fa-sync fa-spin").addClass("fa-edit");
        $("#btn-ubah-dokumen").prop('disabled', false);
    }

    function showHapusDokumen(id) {
        $("#id_hapus_dokumen").val(id);
        var inputs = document.getElementById('setujuhapusdokumen');
        inputs.checked = false;
        $('#hapusDokumen').modal('show');
    }

    function prosesHapusDokumen() {
        // SWITCH BTN HAPUS
        var checkboxHapusDokumen = $('#setujuhapusdokumen').is(":checked");
        if (checkboxHapusDokumen == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan berkas',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            var id = $("#id_hapus_dokumen").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/profil/dokumen/hapus/"+id+"/proses",
                type: 'DELETE',
                dataType: 'json', // added data type
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Berkas telah berhasil dihapus pada '+res,
                        position: 'topRight'
                    });
                    $('#hapusDokumen').modal('hide');
                    loadDokumen();
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Berkas gagal dihapus',
                        position: 'topRight'
                    });
                }
            });
        }
    }
</script>
