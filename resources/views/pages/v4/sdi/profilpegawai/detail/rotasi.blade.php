<div class="row">
    <div class="col-md-12 status-aktif-rotasi" hidden>
        <div class="card custom-card">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="mb-0 card-title flex-grow-1">Rotasi <b class="text-orange">Pegawai</b></h6>
                <div class="flex-shrink-0">
                </div>
            </div>
            <div class="card-body p-b-10">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group mb-3">
                            <label class="form-label">Kategori Rotasi <span class="text-danger">*</span></label>
                            <select class="form-control" id="ref_rotasi"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="defaultFormControlInput" class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <div class="select2-dark mb-2">
                                <select id="jabatan_rotasi" name="jabatan_rotasi[]" class="select2 form-select" data-bs-auto-close="outside" required multiple="multiple" data-placeholder="Pilih Jabatan ..." style="width: 100%"></select>
                            </div>
                            {{-- <sub><i class="ti ti-arrows-up-right text-primary me-1"></i> <u>Refresh Browser</u> apabila jabatan tidak sesuai</sub> --}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-3">
                            <label class="form-label">Tgl. Berlaku <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_berlaku_rotasi">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="form-label">Keterangan</label>
                            <div class="row">
                                <div class="col"><textarea id="ket_rotasi" class="form-control" placeholder="Tuliskan Keterangan (Bila Ada)" rows="1"></textarea></div>
                                <div class="col-auto"><button class="btn btn-primary" onclick="prosesTambahRotasi()" id="btn-simpan-rotasi"><i class="fas fa-save me-1"></i> Simpan</button>
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
                <h6 class="mb-0 card-title flex-grow-1">Tabel <b class="text-primary">Riwayat</b> <b class="text-info">Rotasi</b></h6>
                <div class="flex-shrink-0">
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning-transparent" id="btn-refresh" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Refresh Tabel Rotasi Pegawai" onclick="refreshRotasi()">
                            <i class="fa-fw fas fa-sync nav-icon me-1"></i>Segarkan</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-light shadow-sm" role="alert">
                    <small>
                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Data record yang dapat di <b class="text-warning">ubah</b>/<b class="text-danger">hapus</b> adalah data paling terakhir<br>
                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Data terhapus diabaikan dan tidak dapat dikembalikan lagi atau dibatalkan<br>
                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Pembatalan data akan menonaktifkan data record dan rotasi jabatan pegawai pada baris yang dipilih dan akan digantikan oleh data jabatan pada record terakhir apabila terdapat data lebih dari 1
                    </small>
                </div>
                <div class="table-responsive">
                    <table id="dttable-rotasi" class="table dt-responsive table-hover w-100 align-middle">
                        <thead>
                            <tr>
                                <th class="cell-fit">#ID</th>
                                <th class="cell-fit">JENIS ROTASI</th>
                                <th class="cell-fit">TGL BERLAKU</th>
                                <th class="cell-fit">SEBELUM</th>
                                <th class="cell-fit">SESUDAH</th>
                                <th class="cell-fit">KETERANGAN</th>
                                <th class="cell-fit">DIPERBARUI</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody-rotasi">
                            <tr>
                                <td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="cell-fit">#ID</th>
                                <th class="cell-fit">JENIS ROTASI</th>
                                <th class="cell-fit">TGL BERLAKU</th>
                                <th class="cell-fit">SEBELUM</th>
                                <th class="cell-fit">SESUDAH</th>
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

    <div class="modal fade animate__animated animate__rubberBand" id="ubahRotasi" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form <b class="text-warning">Ubah Rotasi Jabatan Pegawai</b>&nbsp;&nbsp;&nbsp;<span class="badge text-bg-primary p-1" id="show_id_rotasi"></span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit_rotasi" hidden>
                    <div class="row"> </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-ubah-rotasi" onclick="prosesUbahRotasi()"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</button>
                    <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal animate__animated animate__rubberBand fade" id="hapusRotasi" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form <b class="text-danger">Batal Rotasi Pegawai</b>
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus_rotasi" hidden>
                    <p style="text-align: justify;">Anda akan menonaktifkan/membatalkan <strong>Data Rotasi Pegawai</strong> dari database.
                        Pembatalan data akan berpengaruh pada jabatan dan akses pengguna saat ini, apabila data baru pertama kali masuk (satu-satunya data)
                        yang dimasukkan akan mengakibatkan jabatan menjadi kosong pada database. Maka dari itu, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penonaktifan.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuhapusrotasi">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-hapus-rotasi" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapusRotasi()"><i class="ti ti-arrow-back-up me-1" style="font-size:13px"></i> Batalkan</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
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
    });

    function refreshRotasi() {
        var ref_id       = $("#ref_rotasi");
        var tgl_berlaku  = $("#tgl_berlaku_rotasi");
        var ket          = $("#ket_rotasi");

        // INIT
        ref_id.val('');
        tgl_berlaku.val('');
        ket.val('');

        // MULAI TABEL
        const btn = $("#btn-load-rotasi");
        const btn2 = $("#btn-refresh");
        $("#tampil-tbody-rotasi").empty();
        $("#tampil-tbody-rotasi").empty().append(`<tr><td colspan="9" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
        $.ajax(
            {
                url: `/api/v4/sdi/profilpegawai/rotasi/table/${id_pegawai}`,
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    btn.prop('disabled', true).empty().append('<i class="fas fa-sync fa-spin me-1"></i> memuat...');
                    btn2.prop('disabled', true).find("i").addClass("fa-spin");
                },
                success: function(res) {
                    // CEK STATUS AKTIF/TIDAKNYA DATA USER
                    if (res.user && res.user.status != null && res.user.deleted_at != null) {
                        $(".status-aktif-rotasi").prop('hidden', true);
                    } else {
                        $(".status-aktif-rotasi").prop('hidden', false);
                    }

                    $("#tampil-tbody-rotasi").empty();
                    $('#dttable-rotasi').DataTable().clear().destroy();

                    res.show.forEach(item => {
                        content = "<tr id='data"+ item.id +"'>";
                        content += `<td><center><div class='dropend'><a href='javascript:void(0);' class='link-${item.status==0?'danger':'success'} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup="true">${item.id}</a><div class='dropdown-menu'>`;
                            if (res.user && res.user.status != null && res.user.deleted_at != null) {
                                content += `<a href='javascript:void(0);' class='dropdown-item disabled'><i class='ti ti-trash me-1'></i> Batalkan Rotasi</a>`;
                            } else {
                                if (item.status == 0) {
                                    content += `<a href='javascript:void(0);' class='dropdown-item disabled'><i class='ti ti-arrow-back-up me-1'></i> Batalkan Rotasi</a>`;
                                } else {
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-danger' onclick="showHapusRotasi(`+item.id+`)" value="animate__rubberBand"><i class='ti ti-arrow-back-up me-1'></i> Batalkan Rotasi</a>`;
                                }
                            }
                        content += `</div></center></td>`;
                        if (item.deleted_at != null) {
                            bgHapus = `<span class="badge rounded-pill text-bg-secondary p-1">Terhapus</span>`;
                        } else {
                            bgHapus = ``;
                        }
                        content += "<td style='white-space: normal !important;word-wrap: break-word;'>"
                                    + "<div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'>"
                                    + "<h6 class='mb-0'>" + item.nama_referensi + "&nbsp;&nbsp;" + bgHapus + "</h6><small class='text-truncate text-muted'>Oleh " + item.nama_kepegawaian + "</small>"
                                    + "</div></div></td>";
                        content += `<td>` + new Date(item.tgl_berlaku).toLocaleDateString("sv-SE") + `</td>`;
                        content += `<td>`;
                        if (item.before) {
                            try {
                                var bef = JSON.parse(item.before);
                            } catch (e) {
                                var bef = item.before;
                            }
                            bef.forEach(val => {
                                res.onlyRole.forEach(rl => {
                                    if (val == rl.id_role) {
                                        content += `<span class="badge rounded-pill text-bg-secondary p-1">${rl.deskripsi_role?rl.deskripsi_role:rl.nama_role}</span>&nbsp;`;
                                    }
                                })
                            })
                        }
                        content += `</td>`;
                        content += `<td>`;
                        if (item.after) {
                            try {
                                var aft = JSON.parse(item.after);
                            } catch (e) {
                                var aft = item.after;
                            }
                            aft.forEach(val => {
                                res.onlyRole.forEach(rl => {
                                    if (val == rl.id_role) {
                                        content += `<span class="badge rounded-pill text-bg-primary p-1">${rl.deskripsi_role?rl.deskripsi_role:rl.nama_role}</span>&nbsp;`;
                                    }
                                })
                            })
                        }
                        content += `</td>`;
                        content += `<td>${item.keterangan?item.keterangan:'-'}</td>`;
                        content += "<td>" + new Date(item.updated_at).toLocaleString("sv-SE") + "</td></tr>";
                        $('#tampil-tbody-rotasi').append(content);
                    });
                    var table = $('#dttable-rotasi').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '15%' },
                            { sWidth: '10%' },
                            { sWidth: '20%' },
                            { sWidth: '20%' },
                            { sWidth: '15%' },
                            { sWidth: '15%' },
                        ],
                        displayLength: 10,
                    });

                    // REFRESH OPTION SELECT ROTASI
                    $("#ref_rotasi").find('option').remove().append(`<option value="" selected hidden>Pilih Kategori Rotasi</option>`);
                    res.ref_rotasi.forEach(item => {
                        $("#ref_rotasi").append(`
                            <option value="${item.id}">${item.deskripsi}</option>
                        `);
                    });

                    // CHANGE SELECT JABATAN VALUE
                    $("#jabatan_rotasi").find('option').remove();
                    res.onlyRole.forEach(item => {
                        opt = '';
                        opt += `<option value="${item.id_role}"`;
                        res.model.forEach(val => {
                            if (item.id_role == val.role_id) {
                                opt += `selected`;
                            }
                        })
                        opt += `>${item.deskripsi_role?item.deskripsi_role:item.nama_role}</option>`;
                        $("#jabatan_rotasi").append(opt);
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
                    btn.prop('disabled', false).empty().html('<i class="ti ti-route me-2"></i>Rotasi');
                    btn2.prop('disabled', false).find("i").removeClass("fa-spin");
                }
            }
        );
    }

    function prosesTambahRotasi() {

        var fd = new FormData();

        // ISIAN FORM WAJIB
        var ref_id = $('#ref_rotasi').val();
        var jabatan = $('#jabatan_rotasi').val();
        var tgl_berlaku = $('#tgl_berlaku_rotasi').val();
        var ket = $('#ket_rotasi').val();

        if (ref_id == '' || jabatan == '' || tgl_berlaku == '') {
            iziToast.warning({
                title: 'Pesan Ambigu!',
                message: 'Mohon lengkapi semua data (<span class="text-danger">*</span>) terlebih dahulu dan pastikan tidak ada yang kosong',
                position: 'topRight'
            });
        } else {
            // INISIALISASI
            fd.append('ref_id',ref_id);
            fd.append('jabatan',JSON.stringify(jabatan));
            fd.append('tgl_berlaku',tgl_berlaku);
            fd.append('ket',ket);
            fd.append('user_id',id_user);
            fd.append('pegawai_id',id_pegawai);

            // AJAX REQUEST
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/sdi/profilpegawai/rotasi/tambah",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#btn-simpan-rotasi").prop('disabled', true);
                    $("#btn-simpan-rotasi").find("i").toggleClass("fa-save fa-sync fa-spin");
                },
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Rotasi Jabatan Pegawai berhasil diperbarui pada '+res,
                        position: 'topRight'
                    });
                    if (res) {
                        refreshRotasi();
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
                    $("#btn-simpan-rotasi").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
                    $("#btn-simpan-rotasi").prop('disabled', false);
                }
            });
        }
    }

    function showHapusRotasi(id) {
        $("#id_hapus_rotasi").val(id);
        var inputs = document.getElementById('setujuhapusrotasi');
        inputs.checked = false;
        $('#hapusRotasi').modal('show');
    }

    function prosesHapusRotasi() {
        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapusrotasi').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan rotasi jabatan pegawai',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            var id = $("#id_hapus_rotasi").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/sdi/profilpegawai/rotasi/hapus/"+id+"/proses",
                type: 'DELETE',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Rotasi Jabatan Pegawai telah berhasil dihapus pada '+res,
                        position: 'topRight'
                    });
                    $('#hapusRotasi').modal('hide');
                    refreshRotasi();
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
