<div class="row">
    <div class="col-md-12 mb-3 border-bottom border-dashed">
        <div class="d-flex justify-content-between pb-3">
            <button class="btn btn-primary btn-sm" onclick="tambahRuangan()" data-bs-toggle="tooltip"
                data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" id="btn-tambah-ruangan"
                title="Tambah Ruangan" disabled><i class='ti ti-layout-grid-add me-1'></i> Tambah Ruangan</button>
            <button class="btn btn-warning-transparent btn-sm" onclick="refreshTableRuangan()" data-bs-toggle="tooltip"
                data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" id="btn-refresh-ruangan"
                title="Refresh Tabel Ruangan"><i class="fas fa-sync me-1"></i> Segarkan Tabel</button>
        </div>
    </div>
    <div class="col-md-12">
        <div class="table-responsive text-nowrap" style="border: 0px">
            <table id="dttable-ruangan" class="table dt-responsive table-hover nowrap w-100">
                <thead>
                    <tr>
                        <th class="cell-fit">Aksi</th>
                        <th>Nama Ruangan</th>
                        <th>Deskripsi</th>
                        <th class="cell-fit">Kapasitas</th>
                        <th>Fasilitas</th>
                        <th>Hak Akses</th>
                        <th class="cell-fit">Diperbarui</th>
                    </tr>
                </thead>
                <tbody id="tampil-tbody-ruangan">
                    <tr>
                        <td colspan="9" style="font-size:13px">
                            <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- end table -->
        </div>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" tabindex="-1" id="modalTambahRuangan" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="orderdetailsModalLabel">Tambah Ruangan</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <div class="form-group">
                            <label class="form-label">Nama Ruangan <a class="text-danger">*</a></label>
                            <input type="text" id="nama-ruangan" class="form-control" placeholder="e.g. Ruang Direksi">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="form-label">Kapasitas <a class="text-danger">*</a></label>
                            <input type="number" id="kapasitas-ruangan" class="form-control" placeholder="50xxxx">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <div class="alert alert-light shadow-sm">
                                <small>
                                    <i class="fas fa-caret-right text-primary me-1"></i> Kosongi isian <b class="text-danger">Hak Akses</b> di atas untuk membuka akses Ruangan ke semua karyawan<br>
                                    <i class="fas fa-caret-right text-primary me-1"></i> Isian Hak Akses adalah sebagai acuan untuk karyawan yang diberikan akses khusus terhadap ruangan
                                </small>
                            </div>
                            <label class="form-label">Hak Akses</label>
                            <select class="select2unit form-control" id="akses-ruangan" style="width: 100%" data-bs-auto-close="outside" required multiple="multiple"></select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea rows="2" class="form-control" id="deskripsi-ruangan" placeholder="Optional"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Fasilitas</label>
                            <textarea rows="2" class="form-control" id="fasilitas-ruangan" placeholder="Optional"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal"><i
                        class="fa fa-times me-1"></i> Batal</button>
                <button class="btn btn-info" onclick="simpanRuangan()" data-bs-toggle="tooltip" id="btn-simpan-ruangan"
                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                    title="Simpan Data Ruangan"><i class="fas fa-save me-1"></i> Submit</button>
                {{-- <button class="btn btn-primary" onclick="showKeranjang()" data-bs-toggle="tooltip"
                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Lihat Keranjang"><i
                        class="bx bx-cart align-middle"></i>&nbsp;&nbsp;Keranjang</button> --}}
            </div>
        </div>
    </div>
</div>

<!-- MODAL UBAH -->
<div class="modal fade" tabindex="-1" id="modalUbahRuangan" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="orderdetailsModalLabel">Ubah Ruangan</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="id-edit-ruangan" hidden>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <div class="form-group">
                            <label class="form-label">Nama Ruangan <a class="text-danger">*</a></label>
                            <input type="text" id="nama-ruangan-edit" class="form-control" placeholder="e.g. Ruang Direksi">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="form-label">Kapasitas <a class="text-danger">*</a></label>
                            <input type="number" id="kapasitas-ruangan-edit" class="form-control" placeholder="50xxxx">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <div class="alert alert-light shadow-sm">
                                <small>
                                    <i class="fas fa-caret-right text-primary me-1"></i> Kosongi isian <b class="text-danger">Hak Akses</b> di atas untuk membuka akses Ruangan ke semua karyawan<br>
                                    <i class="fas fa-caret-right text-primary me-1"></i> Isian Hak Akses adalah sebagai acuan untuk karyawan yang diberikan akses khusus terhadap ruangan
                                </small>
                            </div>
                            <label class="form-label">Hak Akses</label>
                            <select class="select2unit form-control" id="akses-ruangan-edit" style="width: 100%" data-bs-auto-close="outside" required multiple="multiple"></select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea rows="2" class="form-control" id="deskripsi-ruangan-edit" placeholder="Optional"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Fasilitas</label>
                            <textarea rows="2" class="form-control" id="fasilitas-ruangan-edit" placeholder="Optional"></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btn-ubah-ruangan" onclick="prosesUbahRuangan()"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</button>
                <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="modal animate__animated animate__rubberBand fade" id="modalHapusRuangan" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Form Hapus Ruangan
                </h6>
            </div>
            <div class="modal-body">
                <input type="text" id="id-hapus-ruangan" hidden>
                <p style="text-align: justify;">Anda akan menghapus Ruangan tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapusruangan">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" id="btn-hapus-ruangan" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapusRuangan()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                <button type="reset" class="btn btn-secondary-light" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    // FUNCTION AREA
    function refreshTableRuangan() {
        const btn = $("#btn-refresh-ruangan");
        $('.modal').modal('hide');
        $("#tampil-tbody-ruangan").empty().append(
            `<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
        );
        $.ajax({
            url: "/api/v4/administrasi/eruang/ruangan",
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                btn.prop('disabled', true);
                btn.find("i").addClass("fa-spin");
            },
            success: function(res) {
                $("#tampil-tbody-ruangan").empty();
                if ($.fn.DataTable.isDataTable('#dttable-ruangan')) {
                    $('#dttable-ruangan').DataTable().clear().destroy();
                }
                res.show.forEach(item => {
                    let unit = item.akses ? JSON.parse(item.akses) : [];
                    content = `<tr><td><div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle" data-bs-toggle="dropdown">` + item.id + `</a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0);" onclick="ubahRuangan(` + item.id + `)" class="dropdown-item text-warning"><i class='fas fa-edit me-1'></i> Ubah</a>
                                                <a href="javascript:void(0);" onclick="hapusRuangan(` + item.id + `)" class="dropdown-item text-danger"><i class='fas fa-trash-alt me-1'></i> Hapus</a>
                                            </div>
                                        </div>
                                    </div></td>`;
                    content += `<td><b class='text-secondary'>`+item.nama+`</b></td>`;
                    content += `<td>${item.deskripsi?item.deskripsi:'-'}</td>`;
                    content += `<td>${item.kapasitas?item.kapasitas:'-'}</td>`;
                    content += `<td>${item.fasilitas?item.fasilitas:'-'}</td><td>`;
                    if (res.role && res.role.length > 0) {
                        if (unit.length > 0) {
                            unit.forEach(val => {
                                let role = res.role.find(r => r.id == val);

                                if (role) {
                                    content += `<span class="badge bg-primary">${role.name}</span>&nbsp;`;
                                }
                            })
                        } else {
                            content += `<span class="badge bg-secondary">Semua Karyawan</span>`;
                        }
                    } else {
                        content += `<span class="badge bg-danger">Jabatan tidak ditemukan</span>`;
                    }
                    content += `</td><td>`;
                        if(item.updated_at)
                        {
                            content += new Date(item.updated_at).toLocaleString("sv-SE");
                        } else { content += `-`; }
                    content += `</td></tr>`;
                    $('#tampil-tbody-ruangan').append(content);
                })
                var table = $('#dttable-ruangan').DataTable({
                    order: [
                        [6, "desc"]
                    ],
                    bAutoWidth: false,
                    aoColumns : [
                        { sWidth: '5%' },
                        { sWidth: '20%' },
                        { sWidth: '20%' },
                        { sWidth: '10%' },
                        { sWidth: '15%' },
                        { sWidth: '20%' },
                        { sWidth: '10%' },
                    ],
                    displayLength: 10,
                });

                // Showing Tooltip
                $('[data-bs-toggle="tooltip"]').tooltip({
                    trigger: 'hover'
                })

                // add role in form modal tambah
                $('#akses-ruangan').empty();
                if (res.role && res.role.length > 0) {
                    res.role.forEach(role => {
                        let option = `<option value="${role.id}">${role.name}</option>`;
                        $("#akses-ruangan").append(option);
                    });
                    $('#btn-tambah-ruangan').prop('disabled', false);
                }
            },
            complete: function(res) {
                btn.find("i").removeClass("fa-spin");
                btn.prop('disabled', false);
            },
            error: function(xhr, status, error) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat memeriksa data untuk ditampilkan',
                    position: 'topRight'
                });
                $('#btn-tambah-ruangan').prop('disabled', true);
            }
        })
    }

    function tambahRuangan() {
        $('#modalTambahRuangan').modal('show');
    }

    function simpanRuangan() {
        const btn = $("#btn-simpan-ruangan");
        var ruangan = $("#nama-ruangan").val();
        var kapasitas = $("#kapasitas-ruangan").val();
        var akses = $("#akses-ruangan").val();
        var deskripsi = $("#deskripsi-ruangan").val();
        var fasilitas = $("#fasilitas-ruangan").val();

        if (ruangan == "" || kapasitas == "") {
            iziToast.warning({
                title: 'Pesan Ambigu!',
                message: 'Pastikan Anda tidak mengosongi semua isian wajib',
                position: 'topRight'
            });
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '/api/v4/administrasi/eruang/ruangan/store',
                dataType: 'json',
                data: {
                    ruangan: ruangan,
                    kapasitas: kapasitas,
                    akses: akses,
                    deskripsi: deskripsi,
                    fasilitas: fasilitas,
                },
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.find("i").removeClass("fa-save").addClass("fa-sync fa-spin");
                },
                success: function(res) {
                    iziToast.success({
                        title: 'Sukses!',
                        message: 'Tambah Ruangan berhasil pada '+ res,
                        position: 'topRight'
                    });
                    if (res) {
                        $('.modal').modal('hide');
                        refreshTableRuangan();
                    }
                },
                complete: function() {
                    btn.find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
                    btn.prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat memeriksa data untuk disimpan',
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function ubahRuangan(id) {
        $("#id-edit-ruangan").val("");
        $("#nama-ruangan-edit").val("");
        $("#kapasitas-ruangan-edit").val("");
        $("#deskripsi-ruangan-edit").val("");
        $("#fasilitas-ruangan-edit").val("");
        $.ajax(
        {
            url: "/api/v4/administrasi/eruang/ruangan/ubah/"+id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {

                $("#id-edit-ruangan").val(res.show.id);
                $("#nama-ruangan-edit").val(res.show.nama);
                $("#deskripsi-ruangan-edit").val(res.show.deskripsi);
                $("#kapasitas-ruangan-edit").val(res.show.kapasitas);
                $("#fasilitas-ruangan-edit").val(res.show.fasilitas);

                $("#akses-ruangan-edit").empty();

                let selectedAkses = res.show.akses ? JSON.parse(res.show.akses) : [];

                res.role.forEach(role => {
                    let isSelected = selectedAkses.includes(role.id.toString()) ? 'selected' : '';

                    let option = `<option value="${role.id}" ${isSelected}>${role.name}</option>`;
                    $("#akses-ruangan-edit").append(option);
                });

                $("#akses-ruangan-edit").trigger('change');

                $('#modalUbahRuangan').modal('show');
            }
        });
    }

    function prosesUbahRuangan() {
        const btn = $("#btn-ubah-ruangan");

        var fd = new FormData();
        fd.append('id',$("#id-edit-ruangan").val());
        fd.append('ruangan',$("#nama-ruangan-edit").val());
        fd.append('deskripsi',$("#deskripsi-ruangan-edit").val());
        fd.append('kapasitas',$("#kapasitas-ruangan-edit").val());
        fd.append('fasilitas',$("#fasilitas-ruangan-edit").val());
        fd.append('akses',$("#akses-ruangan-edit").val());

        // AJAX request
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/api/v4/administrasi/eruang/ruangan/ubah/proses",
            method: 'post',
            data: fd,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function() {
                btn.prop('disabled', true);
                btn.find("i").removeClass("fa-save").addClass("fa-sync fa-spin");
            },
            success: function(res){
                iziToast.success({
                    title: 'Pesan Sukses! ID : '+fd.get('id'),
                    message: 'Ruangan berhasil diperbarui pada '+res,
                    position: 'topRight'
                });
                if (res) {
                    $('#modalUbahRuangan').modal('hide');
                    refreshTableRuangan();
                }
            },
            complete: function() {
                btn.find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
                btn.prop('disabled', false);
            },
            error: function(xhr, status, error) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat memeriksa data untuk diubah',
                    position: 'topRight'
                });
            }
        });
    }

    function hapusRuangan(id) {
        $("#id-hapus-ruangan").val(id);
        var inputs = document.getElementById('setujuhapusruangan');
        inputs.checked = false;
        $('#modalHapusRuangan').modal('show');
    }

    function prosesHapus() {
        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapusruangan').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui/ceklis form ini untuk melanjutkan proses penghapusan baris tersebut',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            var id = $("#id-hapus-ruangan").val();
            $.ajax({
                url: "/api/v4/administrasi/eruang/ruangan/hapus/"+id,
                type: 'DELETE',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Ruangan telah berhasil dihapus pada '+res,
                        position: 'topRight'
                    });
                    $('#modalHapusRuangan').modal('hide');
                    refreshTableRuangan();
                    // window.location.reload();
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat memeriksa data untuk dihapus',
                        position: 'topRight'
                    });
                }
            });
        }
    }
</script>
