<div class="row">
    <div class="col-md-12 status-aktif-penetapan" hidden>
        <div class="card custom-card">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="mb-0 card-title flex-grow-1">Penetapan <b class="text-info">Pegawai</b></h6>
                <div class="flex-shrink-0">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label class="form-label">Status Pegawai <span class="text-danger">*</span></label>
                            <select class="form-control" id="ref_penetapan"></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label class="form-label">Tgl. Diberlakukan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_berlaku_penetapan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <div class="row">
                                <div class="col"><textarea id="ket_penetapan" class="form-control" placeholder="Tuliskan Keterangan (Bila Ada)" rows="1"></textarea></div>
                                <div class="col-auto"><button class="btn btn-primary" onclick="prosesTambahPenetapan()" id="btn-simpan-penetapan"><i class="fas fa-save me-1"></i> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="mb-0 card-title flex-grow-1">Tabel <b class="text-primary">Riwayat</b> <b class="text-danger">Penetapan</b></h6>
                <div class="flex-shrink-0">
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning-transparent" id="btn-refresh" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Refresh Tabel Penetapan Pegawai" onclick="refreshPenetapan()">
                            <i class="fa-fw fas fa-sync nav-icon me-1"></i>Segarkan</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-light shadow-sm" role="alert">
                    <small>
                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Data record yang dapat di <b class="text-warning">ubah</b>/<b class="text-danger">hapus</b> adalah data paling terakhir<br>
                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Penghapusan data akan menonaktifkan data record dan status pegawai akan digantikan oleh data record terakhir apabila terdapat data lebih dari 1
                    </small>
                </div>
                <div class="table-responsive">
                    <table id="dttable-penetapan" class="table dt-responsive table-hover w-100 align-middle">
                        <thead>
                            <tr>
                                <th class="cell-fit">#ID</th>
                                <th class="cell-fit">STATUS</th>
                                <th class="cell-fit">TGL BERLAKU</th>
                                <th class="cell-fit">KETERANGAN</th>
                                <th class="cell-fit">DIPERBARUI</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody-penetapan">
                            <tr>
                                <td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="cell-fit">#ID</th>
                                <th class="cell-fit">STATUS</th>
                                <th class="cell-fit">TGL BERLAKU</th>
                                <th class="cell-fit">KETERANGAN</th>
                                <th class="cell-fit">DIPERBARUI</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade animate__animated animate__rubberBand" id="ubahPenetapan" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Form <b class="text-warning">Ubah</b> Penetapan Pegawai <span class="badge text-bg-primary p-1 ms-1" id="show_id_penetapan"></span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="id_edit_penetapan" hidden>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label class="form-label">Status Pegawai <span class="text-danger">*</span></label>
                            <select class="form-control" id="ref_penetapan_edit"></select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label class="form-label">Tgl. Diberlakukan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_berlaku_penetapan_edit">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <div class="row">
                                <div class="col">
                                    <textarea id="ket_penetapan_edit" class="form-control" placeholder="Tuliskan Keterangan (Bila Ada)" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btn-ubah-penetapan" onclick="prosesUbahPenetapan()"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</button>
                <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal animate__animated animate__rubberBand fade" id="hapusPenetapan" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Form <b class="text-danger">Hapus Status Pegawai</b>
                </h6>
            </div>
            <div class="modal-body">
                <input type="text" id="id_hapus_penetapan" hidden>
                <p style="text-align: justify;">Anda akan menghapus <strong>Status Pegawai</strong> tersebut.
                    Status pegawai akan diambilkan dari data terakhir yang sudah ada dan apabila baru pertama kali (satu-satunya data) yang dimasukkan akan mengakibatkan
                    status pegawai menjadi kosong. Maka dari itu, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapuspenetapan">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" id="btn-hapus-penetapan" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapusPenetapan()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    });

    function refreshPenetapan() {
        var ref_id      = $("#ref_penetapan");
        var tgl_berlaku = $("#tgl_berlaku_penetapan");
        var ket         = $("#ket_penetapan");

        // INIT
        ref_id.val('');
        tgl_berlaku.val('');
        ket.val('');

        // MULAI TABEL
        const btn = $("#btn-load-penetapan");
        $("#tampil-tbody-penetapan").empty();
        $("#tampil-tbody-penetapan").empty().append(`<tr><td colspan="9" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
        $.ajax(
            {
                url: `/api/v4/sdi/profilpegawai/penetapan/table/${id_pegawai}`,
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    btn.prop('disabled', true).empty().append('<i class="fas fa-sync fa-spin me-1"></i> memuat...');
                },
                success: function(res) {
                    // CEK STATUS AKTIF/TIDAKNYA DATA USER
                    if (res.user && res.user.status != null && res.user.deleted_at != null) {
                        $(".status-aktif-penetapan").prop('hidden', true);
                    } else {
                        $(".status-aktif-penetapan").prop('hidden', false);
                    }

                    var bgHapus = null;
                    $("#tampil-tbody-penetapan").empty();
                    $('#dttable-penetapan').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = "<tr id='data"+ item.id +"'>";
                        content += `<td><center><div class='dropend'><a href='javascript:void(0);' class='link-${item.status==0?'danger':'success'} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup="true">${item.id}</a><div class='dropdown-menu'>`;
                            if (res.user && res.user.status != null && res.user.deleted_at != null) {
                                content += `<a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                content += `<a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-trash me-1'></i> Hapus</a>`;
                            } else {
                                if (item.status == 0) {
                                    content += `<a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                    content += `<a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-trash me-1'></i> Hapus</a>`;
                                } else {
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbahPenetapan(`+item.id+`)" value="animate__rubberBand"><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-danger' onclick="showHapusPenetapan(`+item.id+`)" value="animate__rubberBand"><i class='fas fa-trash me-1'></i> Hapus</a>`;
                                }
                            }
                        content += `</div></center></td>`;
                        if (item.deleted_at != null) {
                            bgHapus = `<span class="badge rounded-pill text-bg-danger p-1">Terhapus</span>`;
                        } else {
                            bgHapus = ``;
                        }
                        content += "<td style='white-space: normal !important;word-wrap: break-word;'>"
                                    + "<div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'>"
                                    + "<h6 class='mb-0'>" + item.nama_referensi + `&nbsp;&nbsp;${item.status != 0?'<span class="badge rounded-pill text-bg-success p-1">Berlaku/Aktif</span>':'<span class="badge rounded-pill text-bg-secondary p-1">Nonaktif</span>'}&nbsp;&nbsp;` + bgHapus + "</h6><small class='text-truncate text-muted'>Oleh " + item.nama_kepegawaian + "</small>"
                                    + "</div></div></td>";
                        content += `<td>` + new Date(item.tgl_berlaku).toLocaleDateString("sv-SE") + `</td>`;
                        content += `<td>${item.keterangan?item.keterangan:'-'}</td>`;
                        content += "<td>" + new Date(item.updated_at).toLocaleString("sv-SE") + "</td></tr>";
                        $('#tampil-tbody-penetapan').append(content);
                    });
                    var table = $('#dttable-penetapan').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '25%' },
                            { sWidth: '10%' },
                            { sWidth: '50%' },
                            { sWidth: '10%' },
                        ],
                        displayLength: 10,
                    });

                    // REFRESH OPTION SELECT PENETAPAN
                    $("#ref_penetapan").find('option').remove().append(`<option value="" selected hidden>Pilih Perubahan Status</option>`);
                    res.ref_penetapan.forEach(item => {
                        $("#ref_penetapan").append(`
                            <option value="${item.id}">${item.deskripsi}</option>
                        `);
                    });
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Record Penetapan Pegawai tidak ditemukan.',
                        position: 'topRight'
                    });
                },
                complete: function() {
                    btn.prop('disabled', false).empty().html('<i class="ti ti-license me-2"></i>Penetapan');
                }
            }
        );
    }

    function prosesTambahPenetapan() {

        var fd = new FormData();

        // ISIAN FORM WAJIB
        var ref_id = $('#ref_penetapan').val();
        var tgl_berlaku = $('#tgl_berlaku_penetapan').val();
        var ket = $('#ket_penetapan').val();

        if (ref_id == '' || tgl_berlaku == '') {
            iziToast.warning({
                title: 'Pesan Ambigu!',
                message: 'Mohon lengkapi semua data (<span class="text-danger">*</span>) terlebih dahulu dan pastikan tidak ada yang kosong',
                position: 'topRight'
            });
        } else {
            // INISIALISASI
            fd.append('ref_id',ref_id);
            fd.append('tgl_berlaku',tgl_berlaku);
            fd.append('ket',ket);
            fd.append('user_id',id_user);
            fd.append('pegawai_id',id_pegawai);

            // AJAX REQUEST
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/sdi/profilpegawai/penetapan/tambah",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#btn-simpan-penetapan").prop('disabled', true);
                    $("#btn-simpan-penetapan").find("i").toggleClass("fa-save fa-sync fa-spin");
                },
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Status Pegawai berhasil ditambahkan pada '+res,
                        position: 'topRight'
                    });
                    if (res) {
                        refreshPenetapan();
                    }
                    // console.log(fd)
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat memeriksa data',
                        position: 'topRight'
                    });
                },
                complete: function() {
                    $("#btn-simpan-penetapan").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
                    $("#btn-simpan-penetapan").prop('disabled', false);
                }
            });
        }
    }

    function showUbahPenetapan(id) {
        $.ajax(
        {
            url: "/api/v4/sdi/profilpegawai/penetapan/ubah/"+id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#show_id_penetapan").text('ID : '+id);
                $("#id_edit_penetapan").val(id);
                $("#ref_penetapan_edit").find('option').remove();
                res.ref_penetapan.forEach(item => {
                    $("#ref_penetapan_edit").append(`
                        <option value="${item.id}" ${item.id == res.show.ref_id? "selected":""}>${item.deskripsi}</option>
                    `);
                });
                $('#tgl_berlaku_penetapan_edit').val(res.show.tgl_berlaku);
                $('#ket_penetapan_edit').val(res.show.keterangan);
                $('#ubahPenetapan').modal('show');
            }
        })
    }

    function prosesUbahPenetapan()
    {
        var jenis       = $("#ref_penetapan_edit").val();
        var tgl_berlaku = $("#tgl_berlaku_penetapan_edit").val();
        var keterangan  = $("#ket_penetapan_edit").val();

        if (jenis == "" || tgl_berlaku == "") {
            iziToast.warning({
                title: 'Pesan Ambigu!',
                message: 'Mohon lengkapi kolom pengisian wajib *',
                position: 'topRight'
            });
        } else {
            var fd = new FormData();
            var id_edit = $("#id_edit_penetapan").val();

            fd.append('id',id_edit);
            fd.append('ref_id',jenis);
            fd.append('tgl_berlaku',tgl_berlaku);
            fd.append('keterangan',keterangan);
            fd.append('user_id',id_user);
            fd.append('pegawai_id',id_pegawai);

            // AJAX request
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/sdi/profilpegawai/penetapan/ubah/"+id_edit+"/proses",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#btn-ubah-penetapan").prop('disabled', true);
                    $("#btn-ubah-penetapan").find("i").toggleClass("fa-edit fa-sync fa-spin");
                },
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Status pegawai berhasil diperbarui pada '+res,
                        position: 'topRight'
                    });
                    if (res) {
                        $('#ubahPenetapan').modal('hide');
                        refreshPenetapan();
                    }
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat memperbarui data',
                        position: 'topRight'
                    });
                },
                complete: function() {
                    $("#btn-ubah-penetapan").find("i").removeClass("fa-sync fa-spin").addClass("fa-edit");
                    $("#btn-ubah-penetapan").prop('disabled', false);
                }
            });
        }
    }

    function showHapusPenetapan(id) {
        $("#id_hapus_penetapan").val(id);
        var inputs = document.getElementById('setujuhapuspenetapan');
        inputs.checked = false;
        $('#hapusPenetapan').modal('show');
    }

    function prosesHapusPenetapan() {
        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapuspenetapan').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan status pegawai',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            var id = $("#id_hapus_penetapan").val();
            $.ajax({
                url: "/api/v4/sdi/profilpegawai/penetapan/hapus/"+id+"/proses",
                type: 'DELETE',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Status Pegawai telah berhasil dihapus pada '+res,
                        position: 'topRight'
                    });
                    $('#hapusPenetapan').modal('hide');
                    refreshPenetapan();
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat menghapus data',
                        position: 'topRight'
                    });
                },
            });
        }
    }
</script>
