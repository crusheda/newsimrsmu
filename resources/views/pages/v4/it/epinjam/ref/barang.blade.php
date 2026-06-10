@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    <b class="text-secondary">E</b>-<b class="text-teal">Pinjam</b> - <b class="text-info link-underline-secondary text-decoration-underline">Referensi</b> <b class="text-teal link-underline-teal text-decoration-underline">Barang</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">IT</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('v4.it.epinjam') }}">E-Pinjam</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Ref Barang
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <div class="btn-group">
                            <a class="btn btn-secondary-transparent" href="{{ route('v4.it.epinjam') }}" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Kembali ke Halaman E-Pinjam"><i class="ri-arrow-left-s-line me-1"></i> Kembali</a>
                            <button class="btn btn-success-transparent" onclick="tambah()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Form Tambah Referensi" id="btn-tambah"><i class='ri-add-box-line me-1'></i> Tambah Barang</button>
                        </div>
                        <button class="btn btn-warning-transparent" onclick="refresh()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" id="btn-refresh"
                        title="Segarkan Tabel"><i class="ri-refresh-line me-1"></i> Segarkan</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap" style="border: 0px">
                            <table id="dttable" class="table dt-responsive table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="cell-fit"><center>Aksi</center></th>
                                        <th class="cell-fit">Referensi Barang</th>
                                        <th class="cell-fit">Kelengkapan</th>
                                        <th class="cell-fit">Diperbarui</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody">
                                    <tr>
                                        <td colspan="9" style="font-size:13px">
                                            <center><i class="fa fa-spinner fa-spin fa-fw"></i> Mengambil data...</center>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="cell-fit"><center>Aksi</center></th>
                                        <th class="cell-fit">Referensi Barang</th>
                                        <th class="cell-fit">Kelengkapan</th>
                                        <th class="cell-fit">Diperbarui</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- end table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH -->
    <div class="modal fade" tabindex="-1" id="modalTambah" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Tambah <b class="text-info">Referensi</b> <b class="text-success">Barang</b></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Kategori <a class="text-danger">*</a></label>
                                <select class="select2 form-control" id="kategori" style="width: 100%" required></select>
                            </div>
                        </div>
                        <div class="col-md-5 mb-3">
                            <div class="form-group">
                                <label class="form-label">Unit <b class="text-primary">Asal</b> <a class="text-danger">*</a></label>
                                <select class="select2 form-control" id="asal" style="width: 100%" required></select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Kondisi (<b class="text-warning">OPTIONAL</b>)</label>
                                <select class="select2 form-control" id="kondisi" style="width: 100%" required></select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Barang <a class="text-danger">*</a></label>
                                <input type="text" class="form-control" id="nama" placeholder="Tuliskan Nama Barang" required></input>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Kelengkapan (<b class="text-warning">OPTIONAL</b>)</label>
                                <textarea rows="2" class="form-control" id="kelengkapan" placeholder="Optional"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal">
                        <i class="fa fa-times me-1"></i> Batal
                    </button>
                    <button class="btn btn-success" onclick="simpan()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" id="btn-simpan"
                        title="Simpan Data"><i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL UBAH -->
    <div class="modal fade" tabindex="-1" id="modalUbah" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Ubah <b class="text-info">Referensi</b> <b class="text-success">Barang</b></h6>&nbsp;<span class="badge text-bg-warning badge-sm"><a id="show_id_ubah"></a></span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Kategori <a class="text-danger">*</a></label>
                                <select class="select2 form-control" id="kategori_edit" style="width: 100%" required></select>
                            </div>
                        </div>
                        <div class="col-md-5 mb-3">
                            <div class="form-group">
                                <label class="form-label">Unit <b class="text-primary">Asal</b> <a class="text-danger">*</a></label>
                                <select class="select2 form-control" id="asal_edit" style="width: 100%" required></select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Kondisi (<b class="text-warning">OPTIONAL</b>)</label>
                                <select class="select2 form-control" id="kondisi_edit" style="width: 100%" required></select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Barang <a class="text-danger">*</a></label>
                                <input type="text" class="form-control" id="nama_edit" placeholder="Tuliskan Nama Barang" required></input>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Kelengkapan (<b class="text-warning">OPTIONAL</b>)</label>
                                <textarea rows="2" class="form-control" id="kelengkapan_edit" placeholder="Optional"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-ubah" onclick="prosesUbah()"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</button>
                    <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal">
                        <i class="fa fa-times me-1"></i> Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div class="modal animate__animated animate__rubberBand fade" id="modalHapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Hapus <b class="text-info">Referensi</b> <b class="text-success">Barang</b>&nbsp;<span class="badge text-bg-danger badge-sm"><a id="show_id_hapus"></a></span>
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan menghapus Hari Libur Nasional tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
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
                    <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal">
                        <i class="fa fa-times me-1"></i> Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            refresh();
        })

        // FUNCTION AREA
        function refresh() {
            const btn = $('#btn-refresh')
            $('.modal').modal('hide');
            $("#tampil-tbody").empty().append(
                `<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/it/epinjam/ref/barang",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.find("i").addClass("ri-spin");
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = `<tr id="data` + item.id + `">`;
                        content += `<td><center>
                                            <div class='btn-group'>
                                                <a href="javascript:void(0);" class='link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' id="dropdown-${item.id}" data-bs-auto-close="true" data-bs-toggle='dropdown' aria-expanded='false'>${item.id}</a>
                                                <ul class='dropdown-menu dropdown-menu-right'>
                                                    <li><a href="javascript:void(0);" class='dropdown-item text-warning' onclick="ubah(${item.id})"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                                    <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(${item.id})"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>
                                                </ul>
                                            </div>
                                        </center>
                                    </td>`;
                        content += `<td>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0 text-truncate'>${item.kategori?.nama ? `[<b class="text-teal">${item.kategori?.nama}</b>] ` : ''}${item.nama ? `<b class="text-info">${item.nama}</b>` : ''}</a>
                                                <small class='text-muted text-wrap'>Asal : ${item.asal?.unit ?? '-'}</small>
                                                <small class='text-muted text-wrap'>Kondisi : ${item.kondisi?.deskripsi ?? '-'}</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style="white-space: normal; word-wrap: break-word; word-break: break-word;" class="text-uppercase">${item.kelengkapan ?? '-'}</td>`;
                        content += `<td>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0 text-wrap'>${new Date(item.updated_at).toLocaleString("sv-SE")}</a>
                                                <small class='text-muted text-wrap'>${item.user?.nama ?? ''}</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `</tr>`;
                        $('#tampil-tbody').append(content);

                        // Showing Tooltip
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger: 'hover'
                        })
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [3, "asc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '10%' },
                            { sWidth: '40%' },
                            { sWidth: '30%' },
                            { sWidth: '20%' },
                        ],
                        displayLength: 20,
                    });
                },
                error: function (res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Tidak ada data Barang ditemukan',
                        position: 'topRight'
                    });
                    $("#tampil-tbody").empty().append(
                        `<tr style='font-size:13px'><td colspan="9"><center>Tidak ada Data Barang</center></td></tr>`
                    );
                },
                complete: function() {
                    btn.find("i").removeClass("ri-spin");
                    btn.prop('disabled', false);
                }
            })
        }

        function formatTanggal(tahun, bulan, tgl) {
            // padding supaya selalu 2 digit
            let mm = bulan.toString().padStart(2, "0");
            let dd = tgl.toString().padStart(2, "0");
            return `${tahun}-${mm}-${dd}`;
        }

        function tambah() {
            const btn = $('#btn-tambah');
            $.ajax({
                url: "/api/v4/it/epinjam/ref/barang/loadtambah",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    $("#kategori").val("").trigger('change');
                    $("#asal").val("").trigger('change');
                    $("#kondisi").val("").trigger('change');
                    $("#nama").val("");
                    $("#kelengkapan").val("");
                    btn.prop('disabled', true);
                    btn.find("i")
                        .removeClass("ri-add-box-line")
                        .addClass("ri-refresh-line ri-spin");
                },
                success: function(res) {
                    $("#kategori").find('option').remove();
                    $("#kategori").append(`<option value="" selected>Pilih</option>`);
                    res.kategori.forEach(item => {
                        $("#kategori").append(`
                            <option value="${item.id}">${item.nama}</option>
                        `);
                    });
                    $("#asal").find('option').remove();
                    $("#asal").append(`<option value="" selected>Pilih</option>`);
                    res.asal.forEach(item => {
                        $("#asal").append(`
                            <option value="${item.id}">${item.unit}</option>
                        `);
                    });
                    $("#kondisi").find('option').remove();
                    // $("#kondisi").append(`<option value="" selected>Pilih</option>`);
                    res.kondisi.forEach(item => {
                        $("#kondisi").append(`
                            <option value="${item.queue}">${item.deskripsi}</option>
                        `);
                    });

                    var t = $(".select2");
                    t.length && t.each(function() {
                        var e = $(this);
                        e.wrap('<div class="position-relative"></div>').select2({
                            placeholder: "Pilih",
                            dropdownParent: e.parent()
                        })
                    });

                    $('#modalTambah').modal('show');
                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    btn.find("i")
                        .removeClass("ri-refresh-line ri-spin")
                        .addClass("ri-add-box-line");
                    btn.prop('disabled', false);
                }
            })
        }

        function ubah(id) {
            const btn = $('#dropdown-' + id);

            $.ajax({
                url: '/api/v4/it/epinjam/ref/barang/ubah/' + id,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.empty().html('<i class="ri-refresh-line ri-spin"></i>');
                },
                success: function(res) {
                    $('#id_edit').val(res.barang.id);
                    $('#show_id_ubah').text('ID#'+id);

                    // KATEGORI
                    $('#kategori_edit').empty();
                    $('#kategori_edit').append('<option value="">Pilih</option>');

                    res.kategori.forEach(item => {
                        $('#kategori_edit').append(`
                            <option value="${item.id}">
                                ${item.nama}
                            </option>
                        `);
                    });

                    // ASAL
                    $('#asal_edit').empty();
                    $('#asal_edit').append('<option value="">Pilih</option>');

                    res.asal.forEach(item => {
                        $('#asal_edit').append(`
                            <option value="${item.id}">
                                ${item.unit}
                            </option>
                        `);
                    });

                    // KONDISI
                    $('#kondisi_edit').empty();
                    $('#kondisi_edit').append('<option value="">Pilih</option>');
                    res.kondisi.forEach(item => {
                        $('#kondisi_edit').append(`
                            <option value="${item.queue}">
                                ${item.deskripsi}
                            </option>
                        `);
                    });

                    $('#kategori_edit').val(res.barang.id_kategori).trigger('change');
                    $('#asal_edit').val(res.barang.id_asal).trigger('change');
                    $('#kondisi_edit').val(res.barang.kondisi).trigger('change');
                    $('#nama_edit').val(res.barang.nama);
                    $('#kelengkapan_edit').val(res.barang.kelengkapan);

                    var t = $(".select2");
                    t.length && t.each(function() {
                        var e = $(this);
                        e.wrap('<div class="position-relative"></div>').select2({
                            placeholder: "Pilih",
                            dropdownParent: e.parent()
                        })
                    });

                    $('#modalUbah').modal('show');
                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    btn.prop('disabled', false).empty().text(id);
                }
            });
        }

        function prosesUbah() {
            const btn = $('#btn-ubah');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/api/v4/it/epinjam/ref/barang/ubah',
                type: 'PUT',
                dataType: 'json',
                data: {
                    id: $('#id_edit').val(),
                    id_kategori: $('#kategori_edit').val(),
                    id_asal: $('#asal_edit').val(),
                    kondisi: $('#kondisi_edit').val(),
                    nama: $('#nama_edit').val(),
                    kelengkapan: $('#kelengkapan_edit').val()
                },
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.find('i')
                        .removeClass('fa-edit')
                        .addClass('fa-spinner fa-spin');
                },
                success: function(res) {
                    iziToast.success({
                        title: 'Berhasil!',
                        message: res.message,
                        position: 'topRight'
                    });
                    $('#modalUbah').modal('hide');
                    refresh();
                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    btn.prop('disabled', false);
                    btn.find('i')
                        .removeClass('fa-spinner fa-spin')
                        .addClass('fa-edit');
                }
            });
        }

        function simpan() {
            let kategori = $("#kategori").val();
            let asal = $("#asal").val();
            let kondisi = $("#kondisi").val();
            let nama = $("#nama").val();
            let kelengkapan = $("#kelengkapan").val();

            if (!kategori) {
                iziToast.warning({
                    title: 'Pesan System!',
                    message: 'Kategori wajib dipilih.',
                    position: 'topRight'
                });
                return;
            }

            if (!asal) {
                iziToast.warning({
                    title: 'Pesan System!',
                    message: 'Unit asal wajib dipilih.',
                    position: 'topRight'
                });
                return;
            }

            if (!nama) {
                iziToast.warning({
                    title: 'Pesan System!',
                    message: 'Nama barang wajib diisi.',
                    position: 'topRight'
                });
                return;
            }

            const btn = $("#btn-simpan");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/it/epinjam/ref/barang/simpan",
                type: "POST",
                dataType: "json",
                data: {
                    kategori: kategori,
                    asal: asal,
                    kondisi: kondisi,
                    nama: nama,
                    kelengkapan: kelengkapan
                },
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.find("i")
                        .removeClass("fa-save")
                        .addClass("fa-spinner fa-spin");
                },
                success: function(res) {
                    iziToast.success({
                        title: 'Berhasil!',
                        message: res.message,
                        position: 'topRight'
                    });
                    $('#modalTambah').modal('hide');
                    if ($.fn.DataTable.isDataTable('#dttable')) {
                        $('#dttable').DataTable().ajax.reload(null, false);
                    }
                },
                error: function(xhr) {
                    let message = 'Terjadi kesalahan sistem';
                    if (xhr.responseJSON?.message) {
                        message = xhr.responseJSON.message;
                    }
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: message,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    btn.find("i")
                        .removeClass("fa-spinner fa-spin")
                        .addClass("fa-save");
                    btn.prop('disabled', false);
                }
            });
        }

        function hapus(id) {
            $("#id_hapus").val(id);
            $('#show_id_hapus').text('ID#'+id);
            var inputs = document.getElementById('setujuhapus');
            inputs.checked = false;
            $('#modalHapus').modal('show');
        }

        function prosesHapus() {
            const btn = $('#btn-hapus');
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuhapus').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui/ceklis form ini untuk melanjutkan proses penghapusan data tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_hapus").val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `/api/v4/it/epinjam/ref/barang/hapus/${id}`,
                    type: 'DELETE',
                    beforeSend: function() {
                        btn.prop('disabled', true);
                        btn.find('i')
                            .removeClass('fa-trash')
                            .addClass('fa-spinner fa-spin');
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Penghapusan data barang telah berhasil dilakukan pada '+res,
                            position: 'topRight'
                        });
                        $('#modalHapus').modal('hide');
                        refresh();
                    },
                    error: function(xhr) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.message ?? 'Penghapusan data gagal dilakukan, silakan ulangi sekali lagi',
                            position: 'topRight'
                        });
                    },
                    complete: function() {
                        btn.prop('disabled', false);
                        btn.find('i')
                            .removeClass('fa-spinner fa-spin')
                            .addClass('fa-trash');
                    }
                });
            }
        }
    </script>
@endsection
