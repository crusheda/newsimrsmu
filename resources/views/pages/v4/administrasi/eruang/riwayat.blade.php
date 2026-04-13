
<div class="row">
    <div class="col-md-12 mb-3 border-bottom border-dashed">
        <div class="d-flex justify-content-between pb-3">
            <div>
                <div class="input-daterange input-group bg-light rounded">
                    <input type="text" name="filter_tgl" class="form-control bg-transparent border-0 flatpickrunl form-control-sm" placeholder="Filter Tanggal Acara" aria-label="" aria-describedby="button-addon2" disabled>
                    <button class="btn btn-primary btn-sm" type="button" id="button-addon2" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="Cari data berdasarkan tanggal acara" disabled><i class="fas fa-search align-middle"></i></button>
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-warning btn-sm" onclick="riwayat()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                    title="Refresh Tabel Pemesanan Ruangan" id="btn-refresh-table"><i class="fas fa-sync fa-fw nav-icon me-1"></i>Segarkan
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table align-middle dt-responsive w-100 table-check table-hover nowrap" id="dttable" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col"><center>Aksi</center></th>
                    <th scope="col">Nama Ruang/Agenda</th>
                    <th scope="col">Peminjam</th>
                    <th scope="col">Tanggal Acara</th>
                    <th scope="col">Waktu Acara</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Pesanan Gizi</th>
                    <th scope="col">Alasan Penolakan</th>
                    <th scope="col">Diperbarui</th>
                </tr>
            </thead>
            <tbody id="tampil-tbody"></tbody>
        </table>
    </div>
</div>

<!-- MODAL UBAH -->
<div class="modal fade" tabindex="-1" id="modalUbah" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderdetailsModalLabel">Ubah Data Peminjaman <kbd>ID : <b id="id_show_edit"></b></kbd></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="id_edit" hidden>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <div class="form-group">
                            <label class="form-label">Ruangan <a class="text-danger">*</a></label>
                            <input type="text" class="form-control" id="show_ruangan_edit" disabled>
                            {{-- <select class="select2 form-control" id="ruangan_edit" style="width: 100%" data-bs-auto-close="outside" hidden></select> --}}
                            <input type="text" class="form-control" id="ruangan_edit" hidden>
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <div class="form-group">
                            <label class="form-label">Agenda Acara <a class="text-danger">*</a></label>
                            <input type="text" id="agenda_edit" class="form-control" placeholder="e.g. Rapat Rutin Bagian **">
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label class="form-label">Tanggal Acara <a class="text-danger">*</a></label>
                            <input type="text" id="show_tgl_edit" class="form-control" placeholder="YYYY-MM-DD" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tanggal acara" disabled/>
                            <input type="text" id="tgl_edit" class="form-control" placeholder="YYYY-MM-DD" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tanggal acara" hidden/>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea rows="4" class="form-control" id="ket_edit" placeholder="Optional"></textarea>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Pesan Tambahan Untuk Bagian Gizi</label>
                        <textarea rows="4" class="form-control" id="gizi_edit" placeholder="e.g. Tolong siapkan snack untuk 10 peserta pelatihan terima kasih"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btn-ubah" onclick="prosesUbah()"><i class="fa-fw fas fa-edit nav-icon me-1" style="font-size:13px"></i> Ubah</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon me-1" style="font-size:13px"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="modal animate__animated animate__rubberBand fade" id="modalHapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Form Hapus Peminjaman Ruangan
                </h4>
            </div>
            <div class="modal-body">
                <input type="text" id="id_hapus" hidden>
                <p style="text-align: justify;">Anda akan menghapus Pengajuan Peminjaman Ruangan tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
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
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TOLAK --}}
<div class="modal animate__animated animate__rubberBand fade" id="modalTolak" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Form Penolakan Peminjaman Ruangan
                </h4>
            </div>
            <div class="modal-body">
                <input type="text" id="id_tolak" hidden>
                <div class="form-group">
                    <label for="" class ="form-label">Tuliskan Alasan Penolakan <a class="text-danger">*</a></label>
                    <textarea rows="2" class="form-control" id="alasan_penolakan" placeholder="e.g. Pada Tanggal dan Jam tersebut Ruangan akan direnovasi"></textarea>
                </div>
                <small><i class="mdi mdi-arrow-right text-primary me-1"></i> Penolakan akan gagal apabila sudah diverifikasi oleh bagian Gizi</small>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" id="btn-hapus" class="btn btn-dark me-sm-3 me-1" onclick="prosesTolak()"><i class="fas fa-calendar-times me-1" style="font-size:13px"></i> Tolak</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal animate__animated animate__rubberBand fade" id="modalAlasanPenolakan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Alasan Penolakan
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <textarea rows="4" class="form-control" id="show_alasan_penolakan" disabled></textarea>
                </div>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function riwayat() {
        $('#btn-refresh-table').find('i').addClass('fa-spin');
        $("#tampil-tbody").empty().append(
            `<tr style='font-size:13px'><td colspan="20"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
        );
        $.ajax({
            url: "/api/v4/administrasi/eruang",
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                $("#tampil-tbody").empty();
                $('#dttable').DataTable().clear().destroy();
                var userID = "{{ Auth::user()->id }}";
                var adminID = "{{ Auth::user()->can('admin_eruang') }}";
                var date = new Date().toLocaleDateString('en-ZA');
                // console.log('ini tgl sekarang : '+date);
                res.show.forEach(item => {
                    var input = new Date(item.tgl).toLocaleDateString('en-ZA');
                    var updet = new Date(item.created_at).toLocaleDateString('en-ZA');

                    // console.log('ini tgl input : '+input);

                    // JIKA ADMIN
                    if (adminID == true) {
                        if (item.gizi_verif == null) {
                            if (item.status_penolakan == null) {
                                content = `<tr><td><center><div class="btn-group">
                                                <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle" data-bs-toggle="dropdown">${item.id}</a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="javascript:;" onclick="verifTolakTgl(` + item.id + `)" class="dropdown-item text-info"><i class='fas fa-calendar-times me-1'></i> Tolak</a></li>
                                                    <li><a href="javascript:;" onclick="verifEditTgl(` + item.id + `)" class="dropdown-item text-warning"><i class='fas fa-edit me-1'></i> Ubah</a></li>
                                                    <li><a href="javascript:;" onclick="verifHapusTgl(` + item.id + `)" class="dropdown-item text-danger"><i class='fas fa-trash-alt me-1'></i> Hapus</a></li>
                                                </ul>
                                            </div></center></td>`;
                            } else {
                                content = `<tr><td><center><div class="btn-group">
                                                <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle" data-bs-toggle="dropdown">${item.id}</a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="javascript:;" onclick="lihatPenolakan(` + item.id + `)" class="dropdown-item text-primary"><i class='fas fa-calendar-times me-1'></i> Alasan Penolakan</a></li>
                                                    <li><a href="javascript:;" onclick="verifEditTgl(` + item.id + `)" class="dropdown-item text-warning"><i class='fas fa-edit me-1'></i> Ubah</a></li>
                                                    <li><a href="javascript:;" onclick="verifHapusTgl(` + item.id + `)" class="dropdown-item text-danger"><i class='fas fa-trash-alt me-1'></i> Hapus</a></li>
                                                </ul>
                                            </div></center></td>`;
                            }
                        } else {
                            if (item.status_penolakan == null) {
                                content = `<tr><td><center><div class="btn-group">
                                                <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle" data-bs-toggle="dropdown">${item.id}</a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="javascript:;" class="dropdown-item text-secondary"><i class='fas fa-calendar-times me-1'></i> <s>Tolak</s></a></li>
                                                    <li><a href="javascript:;" onclick="verifEditTgl(` + item.id + `)" class="dropdown-item text-warning"><i class='fas fa-edit me-1'></i> Ubah</a></li>
                                                    <li><a href="javascript:;" onclick="verifHapusTgl(` + item.id + `)" class="dropdown-item text-danger"><i class='fas fa-trash-alt me-1'></i> Hapus</a></li>
                                                </ul>
                                            </div></center></td>`;
                            } else {
                                content = `<tr><td><center><div class="btn-group">
                                                <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle" data-bs-toggle="dropdown">${item.id}</a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="javascript:;" onclick="lihatPenolakan(` + item.id + `)" class="dropdown-item text-primary"><i class='fas fa-calendar-times me-1'></i> Alasan Penolakan</a></li>
                                                    <li><a href="javascript:;" onclick="verifEditTgl(` + item.id + `)" class="dropdown-item text-warning"><i class='fas fa-edit me-1'></i> Ubah</a></li>
                                                    <li><a href="javascript:;" onclick="verifHapusTgl(` + item.id + `)" class="dropdown-item text-danger"><i class='fas fa-trash-alt me-1'></i> Hapus</a></li>
                                                </ul>
                                            </div></center></td>`;
                            }
                        }
                    // JIKA USER
                    } else {
                        if (userID == item.id_user) {
                            // if (updet == date) {
                            if (item.gizi_verif == null) {
                                if (item.status_penolakan == null) {
                                    content = `<tr><td><center><div class="btn-group">
                                                    <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle" data-bs-toggle="dropdown">${item.id}</a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="javascript:;" onclick="verifEditTgl(` + item.id + `)" class="dropdown-item text-warning"><i class='fas fa-edit me-1'></i> Ubah</a></li>
                                                        <li><a href="javascript:;" onclick="verifHapusTgl(` + item.id + `)" class="dropdown-item text-danger"><i class='fas fa-trash-alt me-1'></i> Hapus</a></li>
                                                    </ul>
                                                </div></center></td>`;
                                } else {
                                    content = `<tr><td><center><div class="btn-group">
                                                    <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle" data-bs-toggle="dropdown">${item.id}</a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="javascript:;" onclick="lihatPenolakan(` + item.id + `)" class="dropdown-item text-primary"><i class='fas fa-calendar-times me-1'></i> Alasan Penolakan</a></li>
                                                        <li><a href="javascript:;" class="dropdown-item text-secondary" disabled><i class='fas fa-edit me-1'></i> Ubah</a></li>
                                                        <li><a href="javascript:;" class="dropdown-item text-secondary" disabled><i class='fas fa-trash-alt me-1'></i> Hapus</a></li>
                                                    </ul>
                                                </div></center></td>`;
                                }
                            } else {
                                content = `<tr><td><center><div class="btn-group">
                                                <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle" data-bs-toggle="dropdown">${item.id}</a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="javascript:;" class="dropdown-item text-secondary" disabled><i class='fas fa-edit me-1'></i> Ubah</a></li>
                                                    <li><a href="javascript:;" class="dropdown-item text-secondary" disabled><i class='fas fa-trash-alt me-1'></i> Hapus</a></li>
                                                </ul>
                                            </div></center></td>`;
                            }
                        } else {
                            content = `<tr><td><center><div class="btn-group">
                                            <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle" data-bs-toggle="dropdown">${item.id}</a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="javascript:;" class="dropdown-item text-secondary" disabled><i class='fas fa-edit me-1'></i> Ubah</a></li>
                                                <li><a href="javascript:;" class="dropdown-item text-secondary" disabled><i class='fas fa-trash-alt me-1'></i> Hapus</a></li>
                                            </ul>
                                        </div></center></td>`;
                        }
                    }
                    // LANJUT CONTENT
                    // WARNA NAMA RUANGAN
                    var namar = null;
                    if (item.status_penolakan) {
                        namar = `<u><s class='text-danger'>`+item.nama_ruangan+`</s></u>`;
                    } else {
                        if (item.gizi_verif) {
                            namar = `<u class='text-success'>`+item.nama_ruangan+`</u>`;
                        } else {
                            namar = `<u class='text-primary'>`+item.nama_ruangan+`</u>`;
                        }
                    }
                    content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                    <div class='d-flex justify-content-start align-items-center'>
                                        <div class='d-flex flex-column'>
                                            <h6 class='mb-0'><span class="badge text-bg-secondary" style="font-size:10px;padding:3">`+item.kapasitas+` P</span> `+namar+` ${item.gizi_verif?'<i class="ti ti-checkbox text-info" title="Telah Diverifikasi oleh Gizi"></i>':''}</h6>
                                            <h6 class='mb-0'><small class='text-truncate text-muted'>`+item.agenda+`</small></h6>
                                        </div>
                                    </div>
                                </td>`;
                    content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                    <div class='d-flex justify-content-start align-items-center'>
                                        <div class='d-flex flex-column'>
                                            <h6 class='mb-0'>`+item.nama_user+`</h6>
                                            <h6 class='mb-0'><small class='text-truncate text-muted'>${item.no_hp?item.no_hp:''}</small></h6>
                                        </div>
                                    </div>
                                </td>`;
                    content += `<td><center>`+item.tgl+`</center></td>`;
                    content += `<td>`+item.jam_mulai.substring(0, 5)+` - `+item.jam_selesai.substring(0, 5)+` WIB</td>`;
                    content += `<td>${item.ket?item.ket:''}</td>`;
                    content += `<td style="white-space: pre-line">${item.gizi?item.gizi:''}</td>`;
                    content += `<td>${item.alasan_penolakan?item.alasan_penolakan:''}</td>`;
                    // unit.forEach(val => {
                    //     res.role.forEach(pus => {
                    //         if (val == pus.id) {
                    //             content += `<span class="badge bg-dark">` + pus.name +
                    //                 `</span>&nbsp;`;
                    //         }
                    //     })
                    // })
                    // content += `<td>`+item.updated_at.substring(0, 19).replace('T',' ')+`</td></tr>`;
                    content += `<td>`+new Date(item.updated_at).toLocaleString("sv-SE")+`</td></tr>`;
                    $('#tampil-tbody').append(content);
                })

                var table = $('#dttable').DataTable({
                    order: [
                        [8, "desc"]
                    ],
                    bAutoWidth: false,
                    aoColumns : [
                        { sWidth: '5%' },
                        { sWidth: '17%' },
                        { sWidth: '13%' },
                        { sWidth: '10%' },
                        { sWidth: '10%' },
                        { sWidth: '14%' },
                        { sWidth: '10%' },
                        { sWidth: '13%' },
                        { sWidth: '8%' },
                    ],
                    columnDefs: [
                        { visible: false, targets: [7] },
                    ],
                    displayLength: 10,
                });

                // Showing Tooltip
                $('[data-bs-toggle="tooltip"]').tooltip({
                    trigger: 'hover'
                })
                $('#btn-refresh-table').find('i').removeClass('fa-spin');
            }
        })
    }

    function ubah(id) {
        $("#id_edit").val("");
        $("#ruangan_edit").val("");
        $("#show_ruangan_edit").val("");
        $("#agenda_edit").val("");
        $("#tgl_edit").val("");
        $("#show_tgl_edit").val("");
        $("#ket_edit").val("");
        $("#gizi_edit").val("");

        $.ajax(
        {
            url: "/api/v4/administrasi/eruang/ubah/"+id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#show_tgl_edit").val(res.show.tgl);
                var a = document.querySelector("#tgl_edit");
                a.flatpickr({
                    enableTime: 0,
                    minuteIncrement: 1,
                    time_24hr: true,
                    defaultDate: res.show.tgl,
                })
                $("#id_show_edit").text(res.show.id);
                $("#id_edit").val(res.show.id);
                $("#agenda_edit").val(res.show.agenda);
                // $("#tgl_edit").val(res.show.tgl);
                $("#ket_edit").val(res.show.ket);
                $("#gizi_edit").val(res.show.gizi);
                $("#show_ruangan_edit").find('option').remove();
                res.ruangan.forEach(item => {
                    // if ('{{ Auth::user()->id == 82 || Auth::user()->id == 294 || Auth::user()->id == 2 }}') {
                    //     if (item.id == res.show.id_ruangan_ref) {
                    //         $("#show_ruangan_edit").val(item.nama+' ('+item.kapasitas+' Peserta)');
                    //         $("#ruangan_edit").val(item.id);
                    //     }
                    // } else {
                    // }
                    if (item.id == res.show.id_ruangan_ref) {
                        $("#show_ruangan_edit").val(item.nama+' ('+item.kapasitas+' Peserta)');
                        $("#ruangan_edit").val(item.id);
                    }
                });
                // BACKUP RUANGAN ASLI ------------------------
                // $("#ruangan_edit").find('option').remove();
                // res.ruangan.forEach(item => {
                //     $("#ruangan_edit").append(`
                //         <option value="${item.id}" ${item.id == res.show.id_ruangan_ref? "selected":""}>${item.nama} (${item.kapasitas} Peserta)</option>
                //     `);
                // });
                $('#modalUbah').modal('show');
            }
        });
    }

    function prosesUbah() {
        $("#btn-ubah").prop('disabled', true);
        $("#btn-ubah").find("i").toggleClass("fa-save fa-sync fa-spin");

        var save = new FormData();
        save.append('id',$("#id_edit").val());
        save.append('ruangan',$("#ruangan_edit").val());
        save.append('agenda',$("#agenda_edit").val());
        save.append('tgl',$("#tgl_edit").val());
        save.append('ket',$("#ket_edit").val());
        save.append('gizi',$("#gizi_edit").val());
        save.append('user','{{ Auth::user()->id }}');

        if (
            save.get('ruangan') == "" ||
            save.get('agenda') == "" ||
            save.get('tgl') == ""
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
                url: "/api/v4/administrasi/eruang/ubah/"+save.get('id')+"/proses",
                method: 'post',
                data: save,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses! ID : '+save.get('id'),
                        message: 'Pengajuan Peminjaman Ruangan berhasil diperbarui pada '+res,
                        position: 'topRight'
                    });
                    if (res) {
                        $('#modalUbah').modal('hide');
                        refreshWithOpenRiwayat();
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
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
                message: 'Mohon menyetujui untuk dilakukan penghapusan baris tersebut',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            var id = $("#id_hapus").val();
            $.ajax({
                url: "/api/v4/administrasi/eruang/hapus/"+id,
                type: 'DELETE',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Pengajuan Peminjaman Ruangan telah berhasil dihapus pada '+res,
                        position: 'topRight'
                    });
                    $('#modalHapus').modal('hide');
                    refreshWithOpenRiwayat();
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Pengajuan Peminjaman Ruangan gagal dihapus',
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function tolak(id) {
        $("#id_tolak").val(id);
        $('#modalTolak').modal('show');
    }

    function prosesTolak() {
        var id = $("#id_tolak").val();
        var alasan = $("#alasan_penolakan").val();
        if (alasan == "") {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Alasan Penolakan wajib diisi',
                position: 'topRight'
            });
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/administrasi/eruang/tolak/"+id,
                method: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    alasan: alasan,
                },
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Penolakan Peminjaman Ruangan telah berhasil pada '+res,
                        position: 'topRight'
                    });
                    $('#modalTolak').modal('hide');
                    refreshWithOpenRiwayat();
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON.error,
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function lihatPenolakan(id) {
            $.ajax({
                url: "/api/v4/administrasi/eruang/gizi/verif/edithapus/"+id,
                type: 'get',
                success: function(res) {
                    $('#show_alasan_penolakan').val(res.alasan_penolakan);
                    $('#modalAlasanPenolakan').modal('show');
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON.error,
                        position: 'topRight'
                    });
                }
            });
    }

    // VERIFIKASI GIZI
    // function verifSnackGiziTgl(val) {
    //     var date = new Date();
    //     var tgl = new Date(val);
    //     tgl.setDate(tgl.getDate()-1);
    //     var hmin1 = tgl.toLocaleDateString("sv-SE");
    //     var harih = new Date(val).toLocaleDateString("sv-SE");
    //     var hariini = new Date().toLocaleDateString("sv-SE");
    //     var jamSekarang = date.getHours();

    //     // console.log(hariini);
    //     // console.log(hmin1);
    //     // console.log(jamSekarang);
    //     // console.log(jamMulai);
    //     if (hmin1 > hariini) {
    //         $("#show_gizi1").prop('hidden',true);
    //         $("#show_gizi2").prop('hidden',false);
    //         $(".pilih_snack").prop('hidden',false);
    //         $(".validasiTgl").prop('disabled',false);
    //         iziToast.warning({
    //             title: 'Pesan Admin!',
    //             message: 'Silakan menyesuaikan Jam Mulai dan Selesai',
    //             position: 'topRight'
    //         });
    //     } else {
    //         if (hmin1 == hariini) {
    //             $("#show_gizi1").prop('hidden',true);
    //             $("#show_gizi2").prop('hidden',false);
    //             $(".validasiTgl").prop('disabled',false);
    //             if (jamSekarang < 12) {
    //                 $(".pilih_snack").prop('hidden',false);
    //                 iziToast.warning({
    //                     title: 'Pesan Admin!',
    //                     message: 'Silakan menyesuaikan Jam Mulai dan Selesai',
    //                     position: 'topRight'
    //                 });
    //             } else {
    //                 $(".pilih_snack").prop('hidden',true);
    //                 iziToast.warning({
    //                     title: 'Pesan Admin!',
    //                     message: 'Silakan menyesuaikan Jam Mulai dan Selesai. Tidak bisa menambahkan Snack karena sudah melebihi Pukul 12:00 WIB',
    //                     position: 'topRight'
    //                 });
    //             }
    //         } else {
    //             $("#show_gizi1").prop('hidden',false);
    //             $("#show_gizi2").prop('hidden',true);
    //             $(".pilih_snack").prop('hidden',true);
    //             if (harih == hariini) {
    //                 $(".validasiTgl").prop('disabled',false);
    //                 iziToast.warning({
    //                     title: 'Pesan Admin!',
    //                     message: 'Pengajuan masih berlaku tetapi tidak bisa memesan Snack/Makan/Minum ke bagian Gizi',
    //                     position: 'topRight'
    //                 });
    //             } else {
    //                 $(".validasiTgl").prop('disabled',true);
    //                 iziToast.error({
    //                     title: 'Pesan Galat!',
    //                     message: 'Silakan memilih tanggal yang valid (Harus lebih dari hari ini)',
    //                     position: 'topRight'
    //                 });
    //             }
    //         }
    //     }
    // }

    function verifTolakTgl(id) {
        $.ajax({
            url: "/api/v4/administrasi/eruang/gizi/verif/edithapus/"+id,
            type: 'get',
            success: function(res) {
                var val = res.tgl;
                var date = new Date();
                var tgl = new Date(val);
                tgl.setDate(tgl.getDate()-1);
                var hmin1 = tgl.toLocaleDateString("sv-SE");
                var harih = new Date(val).toLocaleDateString("sv-SE");
                var hariini = new Date().toLocaleDateString("sv-SE");
                var jamSekarang = date.getHours();
                var adminID = "{{ Auth::user()->can('admin_eruang') }}";

                if (adminID) {
                    tolak(res.id);
                } else {
                    if (hmin1 > hariini) {
                        tolak(res.id);
                    } else {
                        if (hmin1 == hariini) {
                            if (jamSekarang < 12) {
                                tolak(res.id);
                            } else {
                                iziToast.error({
                                    title: 'Pesan Galat!',
                                    message: 'Penolakan pengajuan sudah melewati batas waktu yang telah ditentukan',
                                    position: 'topRight'
                                });
                            }
                        } else {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: 'Penolakan pengajuan sudah melewati batas waktu yang telah ditentukan',
                                position: 'topRight'
                            });
                            // if (harih == hariini) {

                            // } else {
                            //     iziToast.error({
                            //         title: 'Pesan Galat!',
                            //         message: 'Silakan memilih tanggal yang valid (Harus lebih dari hari ini)',
                            //         position: 'topRight'
                            //     });
                            // }
                        }
                    }
                }
            },
            error: function(res) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Verifikasi gagal dilakukan',
                    position: 'topRight'
                });
            }
        });
    }

    function verifEditTgl(id) {
        $.ajax({
            url: "/api/v4/administrasi/eruang/gizi/verif/edithapus/"+id,
            type: 'get',
            success: function(res) {
                var val = res.tgl;
                var date = new Date();
                var tgl = new Date(val);
                tgl.setDate(tgl.getDate()-1);
                var hmin1 = tgl.toLocaleDateString("sv-SE");
                var harih = new Date(val).toLocaleDateString("sv-SE");
                var hariini = new Date().toLocaleDateString("sv-SE");
                var jamSekarang = date.getHours();
                var adminID = "{{ Auth::user()->can('admin_eruang') }}";

                if (adminID) {
                    ubah(res.id);
                } else {
                    if (hmin1 > hariini) {
                        ubah(res.id);
                    } else {
                        if (hmin1 == hariini) {
                            if (jamSekarang < 12) {
                                ubah(res.id);
                            } else {
                                iziToast.error({
                                    title: 'Pesan Galat!',
                                    message: 'Perubahan data sudah melewati batas waktu yang telah ditentukan',
                                    position: 'topRight'
                                });
                            }
                        } else {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: 'Perubahan data sudah melewati batas waktu yang telah ditentukan',
                                position: 'topRight'
                            });
                            // if (harih == hariini) {

                            // } else {
                            //     iziToast.error({
                            //         title: 'Pesan Galat!',
                            //         message: 'Silakan memilih tanggal yang valid (Harus lebih dari hari ini)',
                            //         position: 'topRight'
                            //     });
                            // }
                        }
                    }
                }
            },
            error: function(res) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Verifikasi gagal dilakukan',
                    position: 'topRight'
                });
            }
        });
    }

    function verifHapusTgl(id) {
        $.ajax({
            url: "/api/v4/administrasi/eruang/gizi/verif/edithapus/"+id,
            type: 'get',
            success: function(res) {
                var val = res.tgl;
                var date = new Date();
                var tgl = new Date(val);
                tgl.setDate(tgl.getDate()-1);
                var hmin1 = tgl.toLocaleDateString("sv-SE");
                var harih = new Date(val).toLocaleDateString("sv-SE");
                var hariini = new Date().toLocaleDateString("sv-SE");
                var jamSekarang = date.getHours();
                var adminID = "{{ Auth::user()->can('admin_eruang') }}";

                if (adminID) {
                    hapus(res.id);
                } else {
                    if (hmin1 > hariini) {
                        hapus(res.id);
                    } else {
                        if (hmin1 == hariini) {
                            if (jamSekarang < 12) {
                                hapus(res.id);
                            } else {
                                iziToast.error({
                                    title: 'Pesan Galat!',
                                    message: 'Penghapusan data sudah melewati batas waktu yang telah ditentukan',
                                    position: 'topRight'
                                });
                            }
                        } else {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: 'Penghapusan data sudah melewati batas waktu yang telah ditentukan',
                                position: 'topRight'
                            });
                            // if (harih == hariini) {

                            // } else {
                            //     iziToast.error({
                            //         title: 'Pesan Galat!',
                            //         message: 'Silakan memilih tanggal yang valid (Harus lebih dari hari ini)',
                            //         position: 'topRight'
                            //     });
                            // }
                        }
                    }
                }
            },
            error: function(res) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Verifikasi gagal dilakukan',
                    position: 'topRight'
                });
            }
        });
    }
</script>
