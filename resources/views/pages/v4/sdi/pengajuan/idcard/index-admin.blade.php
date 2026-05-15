@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Pengajuan <b class="text-orange link-underline-primary text-decoration-underline">ID Card</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">SDI</a>
                    </li>
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Pengajuan</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        ID Card
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">Dafar <b class="text-danger">Riwayat</b></h6>
                        {{-- <div class="btn-group">

                            <a href="javascript:void(0);" class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical f-20"></i></a>
                            <ul class="dropdown-menu">
                                <a href="javascript:void(0);" class="dropdown-item">Informasi</a>
                                <a href="javascript:void(0);" class="dropdown-item" onclick="refresh()">Segarkan</a>
                            </ul>
                        </div> --}}
                        <a href="javascript:void(0);" class="btn btn-warning-transparent btn-sm" id="btn-refresh" onclick="refresh()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Segarkan Tabel Riwayat"><i class="ti ti-refresh me-1"></i> Refresh</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dttable" class="table table-hover dt-responsive align-middle">
                                <thead>
                                    <tr>
                                        <th class="cell-fit">#ID</th>
                                        <th class="cell-fit">NIP</th>
                                        <th><span class="badge bg-secondary-transparent me-1">JENIS</span> NAMA PEGAWAI</th>
                                        <th>JABATAN</th>
                                        <th><center>PROGRESS</center></th>
                                        <th>ESTIMASI</th>
                                        <th>UPDATE</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody">
                                    <tr>
                                        <td colspan="9" style="font-size:13px">
                                            <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="cell-fit">#ID</th>
                                        <th class="cell-fit">NIP</th>
                                        <th><span class="badge bg-secondary-transparent me-1">JENIS</span> NAMA PEGAWAI</th>
                                        <th>JABATAN</th>
                                        <th><center>PROGRESS</center></th>
                                        <th>ESTIMASI</th>
                                        <th>UPDATE</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL START --}}
    <div class="modal fade" id="modalUbahStatus" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <h6>Ubah <b class="text-orange">Status ID Card</b></h6>
                    </div>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="text" id="id_status" hidden>
                    <div class="alert alert-light shadow-sm" role="alert">
                        <small>
                            Mohon diperhatikan, apabila status telah dinyatakan ditolak, maka pengajuan <b>tidak dapat</b> dikembalikan lagi seperti semula. Lakukanlah dengan hati-hati
                        </small>
                    </div>
                    <div class="mb-2">
                        <div class="form-group mb-3">
                            <label class="form-label">Sesuaikan Status <a class="text-danger">*</a></label>
                            <select class="form-control" name="status" id="status"></select>
                        </div>
                        <div class="form-group" id="hideEstimasi">
                            <label class="form-label">Estimasi Waktu Penyelesaian <a class="text-danger">*</a></label>
                            <input class="form-control" type="date" name="estimasi" id="estimasi">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="prosesUbahStatus()" id="btn-submit" disabled><i class="fa-fw fas fa-rocket nav-icon me-1"></i> Submit</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa-fw fas fa-times nav-icon me-1"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}

    <script>
        $(document).ready(function() {
            refresh();
        });

        function refresh() {
            $("#tampil-tbody").empty();
            $("#tampil-tbody").empty().append(`<tr><td colspan="9" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);

            const btn = $('#btn-refresh');
            $.ajax(
                {
                    url: "/api/v4/sdi/pengajuan/idcard/table",
                    type: 'GET',
                    dataType: 'json', // added data type
                    beforeSend: function() {
                        btn.prop('disabled', true);
                        btn.find("i").addClass("ti-spin");
                    },
                    success: function(res) {
                        var adminID = @json(Auth::user()->can('admin_kepegawaian_kepala'));
                        $("#tampil-tbody").empty();
                        $('#dttable').DataTable().clear().destroy();

                        res.show.forEach(item => {
                            var colbot = ``;
                            if (item.progress == 0) {
                                colbot = `primary`;
                            } else {
                                if (item.progress == 1) {
                                    colbot = `warning`;
                                } else {
                                    if (item.progress == 2) {
                                        colbot = `success`;
                                    } else {
                                        colbot = `danger`;
                                    }
                                }
                            }
                            content = "<tr id='data"+ item.id +"'>";
                            content += `<td>
                                            <center>
                                                <div class='dropend'>
                                                    <a href="javascript:void(0);" class='${item.progress == 2 || item.progress == 3 ? 'disabled pe-none' : ''} link-${colbot} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' ${item.progress != 2 && item.progress != 3 ? 'onclick="showUbahStatus('+item.id+', '+item.progress+')"' : ''}>${item.id}</a>
                                                </div>
                                            </center>
                                        </td>`;
                            if (item.pengajuan == 0) {
                                stt = `<span class="badge bg-danger-transparent px-2 py-1 d-flex align-items-center p-1">Baru</span>`;
                            } else {
                                stt = `<span class="badge bg-primary-transparent px-2 py-1 d-flex align-items-center p-1">Ganti</span>`;
                            }
                            content += `<td>${item.pegawai_nip?item.pegawai_nip:'-'}</td>`;
                            content += "<td style='white-space: normal !important;word-wrap: break-word;'>"
                                            + "<div class='d-flex justify-content-start align-items-center'>"
                                                + "<div class='d-flex flex-column'>"

                                                    + "<div class='d-flex align-items-center gap-2 text-truncate'>"
                                                        + stt
                                                        + "<span class='fw-semibold'>" + item.pegawai_panggilan + "</span>"
                                                    + "</div>"

                                                    + "<small class='text-wrap text-muted'>Oleh " + item.pegawai_nama + "</small>"

                                                + "</div>"
                                            + "</div>"
                                        + "</td>";
                            content += `<td>${item.pegawai_jabatan?item.pegawai_jabatan:'-'}</td>`;
                            if (item.progress == 0) {
                                pg = `<center><span class="badge bg-primary-transparent p-1">Pengajuan</span></center>`;
                            } else {
                                if (item.progress == 1) {
                                    pg = `<center><span class="badge bg-warning-transparent p-1">Sedang Diproses</span></center>`;
                                } else {
                                    if (item.progress == 2) {
                                        pg = `<center><span class="badge bg-success-transparent p-1">Selesai</span></center>`;
                                    } else {
                                        pg = `<center><span class="badge bg-danger-transparent p-1">Ditolak</span></center>`;
                                    }
                                }
                            }
                            content += `<td>${pg}</td>`;
                            content += `<td>${item.estimasi?item.estimasi:'<b class="text-danger">Belum Ditentukan</b>'}</td>`;
                            content += `<td>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</td>`;
                            $('#tampil-tbody').append(content);
                        });
                        var table = $('#dttable').DataTable({
                            order: [
                                [6, "desc"]
                            ],
                            bAutoWidth: false,
                            aoColumns : [
                                { sWidth: '5%' },
                                { sWidth: '10%' },
                                { sWidth: '20%' },
                                { sWidth: '20%' },
                                { sWidth: '15%' },
                                { sWidth: '15%' },
                                { sWidth: '15%' },
                            ],
                            displayLength: 10,
                        });

                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: res.responseJSON.error,
                            position: 'topRight'
                        });
                    },
                    complete: function() {
                        btn.prop('disabled', false);
                        btn.find("i").removeClass("ti-spin");
                    }
                }
            );
        }

        function showUbahStatus(id,progress) {
            $("#id_status").val(id);
            $('#status').find('option').remove();
            $('#estimasi').prop('disabled',false);
            if (progress == 0) {
                $('#status').append(`
                    <option value="" selected>Pilih</option>
                    <option value="1">Terima</option>
                    <option value="3">Tolak</option>
                `);
            } else {
                if (progress == 1) {
                    $('#status').append(`
                        <option value="1" selected>Sedang Diproses</option>
                        <option value="2">Proses Selesai</option>
                        <option value="3">Tolak Pengajuan</option>
                    `);
                    $('#estimasi').prop('disabled',true);
                } else {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Status Pengajuan tidak ditemukan.',
                        position: 'topRight'
                    });
                }
            }
            $('#status').on('change', function() {
                $('#estimasi').val('').trigger('change');
                if ($(this).val() == "3") {
                    $('#hideEstimasi').prop('hidden',true);
                    $('#estimasi').prop('disabled',true);
                } else {
                    $('#hideEstimasi').prop('hidden',false);
                    $('#estimasi').prop('disabled',false);
                }

                if ($(this).val() == "") {
                    $('#btn-submit').prop('disabled',true);
                } else {
                    if ($(this).val() == "1" && $('#estimasi').val() == "") {
                        $('#btn-submit').prop('disabled',true);
                    } else {
                        $('#btn-submit').prop('disabled',false);
                    }
                }
            })
            $('#estimasi').on('change', function() {
                if ($('#status').val() == "1" && $(this).val() == "") {
                    $('#btn-submit').prop('disabled',true);
                } else {
                    $('#btn-submit').prop('disabled',false);
                }
            });
            $('#modalUbahStatus').modal('show');
        }

        function prosesUbahStatus() {
            // INIT
            var save = new FormData();
            save.append('id',$("#id_status").val());
            save.append('progress',$('#status').val());
            save.append('estimasi',$('#estimasi').val());

            if (save.get('progress') == "1" && save.get('estimasi') == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian Wajib',
                    position: 'topRight'
                });
            } else {
                // PROCESS
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/v4/sdi/pengajuan/idcard/status',
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    data: save,
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Status Pengajuan ID Card telah berhasil diubah pada '+res,
                            position: 'topRight'
                        });
                        $('#modalUbahStatus').modal('hide');
                        refresh();
                    },
                    error: function (res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: res.responseJSON.error,
                            position: 'topRight'
                        });
                    }
                })
            }
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
    </script>
@endsection
