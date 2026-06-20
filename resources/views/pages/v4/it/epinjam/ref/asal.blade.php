@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    <b class="text-secondary">E</b>-<b class="text-teal">Pinjam</b> - <b class="text-info link-underline-secondary text-decoration-underline">Referensi</b> <b class="text-primary link-underline-primary text-decoration-underline">Asal</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">IT</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('v4.it.epinjam') }}">E-Pinjam</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Ref Asal
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
                            <button class="btn btn-primary-light" onclick="tambah()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Form Tambah Referensi" id="btn-tambah"><i class='ri-add-box-line me-1'></i> Tambah Unit Asal</button>
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
                                        <th class="cell-fit">Unit Asal</th>
                                        <th class="cell-fit">Barang <b class="text-success">Terkait</b></th>
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
                                        <th class="cell-fit">Unit Asal</th>
                                        <th class="cell-fit">Barang <b class="text-success">Terkait</b></th>
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
                    <h6 class="modal-title">Tambah <b class="text-info">Referensi</b> <b class="text-primary">Asal</b></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nama Unit Asal <a class="text-danger">*</a></label>
                        <input type="text" class="form-control" id="asal" placeholder="Tuliskan Nama Unit Asal" required></input>
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
                    <h6 class="modal-title">Ubah <b class="text-info">Referensi</b> <b class="text-primary">Asal</b></h6>&nbsp;&nbsp;<span class="badge text-bg-warning badge-sm p-1"><a id="show_id_ubah"></a></span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="form-group">
                        <label class="form-label">Nama Asal <a class="text-danger">*</a></label>
                        <input type="text" class="form-control" id="asal_edit" placeholder="Tuliskan Nama Unit Asal" required></input>
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
                        Hapus <b class="text-info">Referensi</b> <b class="text-primary">Asal</b>&nbsp;&nbsp;<span class="badge text-bg-danger badge-sm p-1"><a id="show_id_hapus"></a></span>
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan menghapus Referensi Asal tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
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
                url: "/api/v4/it/epinjam/ref/asal",
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
                        content += `<td style="white-space: normal; word-wrap: break-word; word-break: break-word;" class="text-uppercase">${item.unit}</td>`;

                        let daftarBarang = item.barang?.map(val => val.nama).join(", ") ?? "-";
                        content += `<td style="white-space: normal; word-wrap: break-word; word-break: break-word;" class="text-uppercase">${daftarBarang}</td>`;

                        content += `<td>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0 text-wrap'>${item.updated_at ? new Date(item.updated_at).toLocaleString("sv-SE") : ''}</a>
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
                            { sWidth: '45%' },
                            { sWidth: '25%' },
                            { sWidth: '20%' },
                        ],
                        displayLength: 20,
                    });
                },
                error: function (res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Tidak ada data Unit Asal ditemukan',
                        position: 'topRight'
                    });
                    $("#tampil-tbody").empty().append(
                        `<tr style='font-size:13px'><td colspan="9"><center>Tidak ada Data Unit Asal</center></td></tr>`
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
            $("#asal").val("");
            $('#modalTambah').modal('show');
        }

        function ubah(id) {
            const btn = $('#dropdown-' + id);

            $.ajax({
                url: '/api/v4/it/epinjam/ref/asal/ubah/' + id,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.empty().html('<i class="ri-refresh-line ri-spin"></i>');
                },
                success: function(res) {
                    $('#id_edit').val(res.id);
                    $('#show_id_ubah').text('ID#'+id);

                    $('#asal_edit').val(res.unit);

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
                url: '/api/v4/it/epinjam/ref/asal/ubah',
                type: 'PUT',
                dataType: 'json',
                data: {
                    id: $('#id_edit').val(),
                    asal: $('#asal_edit').val(),
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
            let asal = $("#asal").val();

            if (!asal) {
                iziToast.warning({
                    title: 'Pesan System!',
                    message: 'Nama Unit Asal wajib diisi.',
                    position: 'topRight'
                });
                return;
            }

            const btn = $("#btn-simpan");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/it/epinjam/ref/asal/simpan",
                type: "POST",
                dataType: "json",
                data: {
                    asal: asal,
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
                    refresh();
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
                    url: `/api/v4/it/epinjam/ref/asal/hapus/${id}`,
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
                            message: 'Penghapusan data Unit Asal telah berhasil dilakukan pada '+res,
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
