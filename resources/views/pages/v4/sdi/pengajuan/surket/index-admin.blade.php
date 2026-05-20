@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Surat <b class="text-success link-underline-success text-decoration-underline">Keterangan</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">SDI</a>
                    </li>
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Pengajuan</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Surat Keterangan
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6><b>Daftar <b class="text-danger">Pengajuan</b></b></h6>
                        <div class="btn-group">
                            <a href="javascript:void(0);" class="btn btn-sm btn-warning-transparent" onclick="showRiwayat()" id="btn-refresh"><i class="ti ti-refresh f-20 me-1"></i> Refresh Tabel</a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-primary disabled" onclick="showKategori()"><s>Daftar Kategori</s></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dttable" class="table table-hover dt-responsive align-middle">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>#ID</center>
                                        </th>
                                        <th>KATEGORI PENGAJUAN</th>
                                        <th>IDENTITAS PEGAWAI</th>
                                        <th><center>PROGRESS</center></th>
                                        <th>UPDATE</th>
                                        <th>VERIFIED</th>
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
                                        <th>
                                            <center>#ID</center>
                                        </th>
                                        <th>KATEGORI PENGAJUAN</th>
                                        <th>IDENTITAS PEGAWAI</th>
                                        <th><center>PROGRESS</center></th>
                                        <th>UPDATE</th>
                                        <th>VERIFIED</th>
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
    <div class="modal animate__animated animate__rubberBand fade" id="modalVerif" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form Verifikasi Pengajuan
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_verif" hidden>
                    <p style="text-align: justify;">Anda akan melakukan verifikasi Pengajuan Surat Keterangan tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan proses.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuverif">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-verif" class="btn btn-primary me-sm-3 me-1" onclick="prosesVerif()"><i class="fas fa-check me-1" style="font-size:13px"></i> Verifikasi</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalBatalVerif" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form Pembatalan Verifikasi Pengajuan
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_batal_verif" hidden>
                    <p style="text-align: justify;">Anda akan melakukan pembatalan verifikasi Pengajuan Surat Keterangan tersebut sehingga status akan berubah menjadi <kbd>PENGAJUAN</kbd>, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan proses.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujubatalverif">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-batal-verif" class="btn btn-warning me-sm-3 me-1" onclick="prosesBatalVerif()"><i class="fas fa-undo me-1" style="font-size:13px"></i> Batalkan Verifikasi</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalBatalTolak" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form Pembatalan Penolakan Pengajuan
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_status" hidden>
                    <p style="text-align: justify;">Anda akan melakukan pembatalan penolakan Pengajuan Surat Keterangan tersebut sehingga status akan berubah menjadi <kbd>PENGAJUAN</kbd>, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan proses.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujustatus">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-status" class="btn btn-danger me-sm-3 me-1" onclick="prosesBatalTolak()"><i class="fas fa-flag-checkered me-1" style="font-size:13px"></i> Batalkan Penolakan</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalTolak" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form Penolakan Pengajuan
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_tolak" hidden>
                    <p style="text-align: justify;">Anda akan melakukan penolakan Pengajuan Surat Keterangan tersebut status akan berubah menjadi <kbd>DITOLAK</kbd>, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penolakan.</p>
                    <label class="form-label"><b>Masukkan Alasan Penolakan</b> <a class="text-danger">*</a></label>
                    <input id="kettolak" name="kettolak" class="form-control mb-3" placeholder="Masukkan Alasan Penolakan"></input>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujutolak">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-tolak" class="btn btn-danger me-sm-3 me-1" onclick="prosesTolak()"><i class="fas fa-minus-circle me-1" style="font-size:13px"></i> Tolak Pengajuan</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalUpload" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form Upload File/Dokumen Final
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_upload" hidden>
                    <label class="form-label">Upload File <a class="text-danger">*</a></label>
                    <input type="file" name="filex" id="filex" class="form-control mb-1">
                    <small class="text-muted d-block">Maksimal ukuran file/dokumen <b>3 mb</b></small>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-upload" class="btn btn-success me-sm-3 me-1" onclick="prosesUploadFile()"><i class="fas fa-upload me-1" style="font-size:13px"></i> Upload</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalBatalUpload" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form Pembatalan File Upload
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_batal_upload" hidden>
                    <p style="text-align: justify;">Anda akan melakukan pembatalan/hapus file upload Surat Keterangan tersebut status akan berubah menjadi <kbd>DIPROSES</kbd>, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penolakan.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujubatalupload">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-batal-upload" class="btn btn-danger me-sm-3 me-1" onclick="prosesBatalUploadFile()"><i class="fas fa-minus-circle me-1" style="font-size:13px"></i> Batalkan Upload</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}

    <script>
        $(document).ready(function() {
            // const datepicker_range = new DateRangePicker(document.querySelector('#pc-datepicker-5'), {
            //     buttonClass: 'btn',
            //     // todayBtn: true,
            //     clearBtn: true
            // });

            // SELECT2
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    allowClear: true,
                    dropdownParent: e.parent()
                })
            });

            // $('#kategori').on('change', function() {
            //     if (this.value == 159) {
            //         $('.mandatory1').prop('hidden',false);
            //     } else {
            //         $('#tmk').val('');
            //         $('#tak').val('');
            //         $('.mandatory1').prop('hidden',true);
            //     }

            //     if (this.value == 160) {
            //         $('#mandatory_paklaring').prop('hidden',false);
            //     } else {
            //         $('#mandatory_paklaring').prop('hidden',true);
            //     }
            // });
            showRiwayat();
        });

        function showRiwayat() {
            const btn = $("#btn-refresh");
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/v4/sdi/pengajuan/surket/table",
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.find("i").addClass("ti-spin");
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        var selesai = new Date(item.tgl_selesai).toLocaleString("sv-SE").substring(0, 10);
                        var date = new Date().toLocaleString("sv-SE").substring(0, 10);
                        // PROGRESS
                        if (item.progress == 0) {
                            var status = `<span class="badge rounded-pill text-bg-primary">Pengajuan</span>`;
                        } else {
                            if (item.progress == 1) {
                                var status = `<span class="badge rounded-pill text-bg-warning">Diverifikasi</span>`;
                            } else {
                                if (item.progress == 2) {
                                    var status = `<span class="badge rounded-pill text-bg-info">Dalam Proses</span>`;
                                } else {
                                    if (item.progress == 3) {
                                        var status = `<span class="badge rounded-pill text-bg-success">Selesai</span>`;
                                    } else {
                                        if (item.progress == 4) {
                                            var status = `<span class="badge rounded-pill text-bg-danger">Ditolak</span>`;
                                        } else {
                                            var status = `<span class="badge rounded-pill text-bg-secondary">Dibatalkan/Dihapus</span>`;
                                        }
                                    }
                                }
                            }
                        }
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        if (item.progress == 4) { // Ditolak
                            clrbtn = 'danger';
                            valid = 'Ditolak';
                        } else {
                            if (item.progress == 3) { // Selesai
                                clrbtn = 'success';
                                valid = 'Diselesaikan';
                            } else {
                                if (item.progress == 2) { // Dalam Proses
                                    clrbtn = 'info';
                                    valid = 'Diproses';
                                } else {
                                    if (item.progress == 1) { // Diverifikasi
                                        clrbtn = 'warning';
                                        valid = 'Diverifikasi';
                                    } else {
                                        if (item.progress == 0) { // Pengajuan
                                            clrbtn = 'primary';
                                            valid = 'Diterima';
                                        } else {
                                            clrbtn = 'secondary';
                                            valid = 'Dibatalkan/Dihapus';
                                        }
                                    }
                                }
                            }
                        }
                        //
                        content += `<td><center><div class='btn-group'>`;
                            content += `<a href="javascript:void(0);"  class='link-${clrbtn} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</a>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                                        if (item.progress == 4) {
                                            content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-check-square nav-icon me-1"></i>Verif</a></li>`;
                                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="batalTolak(${item.id})"><i class="fa-fw fas fas fa-reply nav-icon me-1"></i> Batal Tolak</a></li>`;
                                        } else {
                                            if (item.progress == 3) {
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item text-success' onclick='downloadFile(${item.id})'><i class="fa-fw fas fa-download nav-icon me-1"></i> Download Dokumen Final</a></li>`;
                                                if (selesai == date) {
                                                    content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick='batalUploadFile(${item.id})'><i class="fa-fw fas fa-upload nav-icon me-1"></i> Batal/Hapus File Upload</a></li>`;
                                                } else {
                                                    content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-upload nav-icon me-1"></i> Batal/Hapus File Upload</a></li>`;
                                                }
                                            } else {
                                                if (item.progress == 2) {
                                                    content += `<li><a href='javascript:void(0);' class='dropdown-item text-success' onclick='uploadFile(${item.id})'><i class="fa-fw fas fa-upload nav-icon me-1"></i> Upload File (PDF)</a></li>`;
                                                } else {
                                                    if (item.progress == 1) {
                                                        content += `<li><a href='javascript:void(0);' class='dropdown-item text-info' onclick='generateFile(${item.id})'><i class="fa-fw fas fa-paperclip nav-icon me-1"></i> Generate File</a></li>`;
                                                        content += `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="batalVerif(${item.id})"><i class="fa-fw fas fas fa-reply nav-icon me-1"></i> Batal Verif</a></li>`;
                                                        content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-times-circle nav-icon me-1"></i> Tolak</a></li>`;
                                                    } else {
                                                        if (item.progress == 0) {
                                                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="verif(${item.id})"><i class="fa-fw fas fa-check-square nav-icon me-1"></i> Verif</a></li>`;
                                                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="tolak(${item.id})"><i class="fa-fw fas fa-times-circle nav-icon me-1"></i> Tolak</a></li>`;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                            content += `</ul>`;
                        content += "</div></center></td>";
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>${item.kategori}</h6>
                                                <small class='text-truncate text-muted'></small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-1 text-${clrbtn}'>${item.pegawai_nama}</h6>
                                                <small class='text-truncate text-muted'>Tempat, Tgl Lahir : <b>${item.pegawai_ttl}</b></small>
                                                <small class='text-truncate text-muted'>Pendidikan Terakhir : <b>${item.pegawai_pendidikan}</b></small>
                                                <small class='text-truncate text-muted'>Alamat : <b>${item.pegawai_alamat}</b></small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += "<td><center>" + status + "</center></td><td>" + new Date(item.updated_at).toLocaleString("sv-SE") + "</td>";
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>${item.valid?'Telah <b class="text-'+clrbtn+'">'+valid+'</b> oleh <b class="text-primary">SDI</b>':'Belum Terverifikasi'}</h6>
                                                <small class='text-truncate text-muted'>${item.tgl_valid?'Pada '+item.tgl_valid:''}</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [4, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '12%' },
                            { sWidth: '45%' },
                            { sWidth: '8%' },
                            { sWidth: '10%' },
                            { sWidth: '20%' },
                        ],
                        columnDefs: [
                            // { visible: false, targets: [7] },
                        ],
                        displayLength: 15,
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
            })
        }

        // function ajukan() {
        //     $("#btn-simpan").prop('disabled', true);
        //     $("#btn-simpan").find("i").toggleClass("fa-stamp fa-sync fa-spin");

        //     // Definisi
        //     var save = new FormData();
        //     save.append('nama',$('#nama').val());
        //     save.append('ttl',$('#ttl').val());
        //     save.append('pendidikan',$('#pendidikan').val());
        //     save.append('alamat',$('#alamat').val());
        //     save.append('profesi',$('#profesi').val());
        //     save.append('tmt',$('#tmt').val());
        //     save.append('tat',$('#tat').val());
        //     save.append('tmk',$('#tmk').val());
        //     save.append('tak',$('#tak').val());
        //     save.append('kategori',$('#kategori').val());
        //     save.append('pegawai','{{ Auth::user()->id }}');
        //     // INITIALIZE VALIDATION
        //     var validation = false;
        //     if (save.get('kategori') == 159) { // PEMENUHAN SKP
        //         if ($('#nama').val() == "" ||
        //             $('#ttl').val() == "" ||
        //             $('#pendidikan').val() == "" ||
        //             $('#alamat').val() == "" ||
        //             $('#profesi').val() == "" ||
        //             $('#tmk').val() == "" ||
        //             $('#tak').val() == "") {
        //             validation = true;
        //         }
        //     } else {
        //         if (save.get('kategori') == 160) { // PAKLARING
        //             if ($('#nama').val() == "" ||
        //                 $('#ttl').val() == "" ||
        //                 $('#pendidikan').val() == "" ||
        //                 $('#alamat').val() == "" ||
        //                 $('#profesi').val() == "" ||
        //                 $('#tmt').val() == "" ||
        //                 $('#tat').val() == "") {
        //                 validation = true;
        //             }
        //         } else {
        //             if (save.get('kategori') != '') { // KATEGORI TIDAK BOLEH KOSONG
        //                 if ($('#nama').val() == "" ||
        //                     $('#ttl').val() == "" ||
        //                     $('#pendidikan').val() == "" ||
        //                     $('#alamat').val() == "" ||
        //                     $('#profesi').val() == "" ||
        //                     $('#tmt').val() == "") {
        //                     validation = true;
        //                 }
        //             } else {
        //                 validation = true;
        //             }
        //         }
        //     }

        //     // CHECKING VALIDATION
        //     if (validation == true) {
        //         iziToast.warning({
        //             title: 'Pesan Ambigu!',
        //             message: 'Pastikan tidak ada data yang kosong, silakan membaca keterangan pengisian dan periksa data Anda sekali lagi :)',
        //             position: 'topRight'
        //         });
        //     } else {
        //         $.ajax({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             method: 'POST',
        //             url: '/api/v4/sdi/pengajuan/surket/tambah',
        //             contentType: false,
        //             processData: false,
        //             dataType: 'json',
        //             data: save,
        //             success: function(res) {
        //                 if (res.code == 500) {
        //                     iziToast.error({
        //                         title: 'Pesan Galat!',
        //                         message: res.message,
        //                         position: 'topRight',
        //                         buttons: [
        //                             [
        //                                 '<button>Tutup</button>',
        //                                 function (instance, toast) {
        //                                     instance.hide({
        //                                         transitionOut: 'fadeOutUp'
        //                                     }, toast);
        //                                 }
        //                             ]
        //                         ]
        //                     });
        //                 } else {
        //                     iziToast.success({
        //                         title: 'Pesan Sukses!',
        //                         message: 'Pengajuan Surat Keterangan telah berhasil dilakukan pada '+res,
        //                         position: 'topRight'
        //                     });
        //                     showRiwayat();
        //                 }
        //             },
        //             error: function (res) {
        //                 iziToast.error({
        //                     title: 'Pesan Galat!',
        //                     message: res.responseJSON.error,
        //                     position: 'topRight'
        //                 });
        //             }
        //         });
        //     }

        //     $("#btn-simpan").find("i").removeClass("fa-sync fa-spin").addClass("fa-stamp");
        //     $("#btn-simpan").prop('disabled', false);
        // }

        function generateFile(id) {
            window.open("/v4/sdi/pengajuan/surket/"+id+"/generate");
            showRiwayat();
        }

        function downloadFile(id) {
            window.open("/v4/sdi/pengajuan/surket/"+id+"/download");
        }

        function tolak(id) {
            $("#id_tolak").val(id);
            var inputs = document.getElementById('setujutolak');
            inputs.checked = false;
            $('#modalTolak').modal('show');
        }

        function prosesTolak() {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujutolak').is(":checked");
            if (checkboxHapus == false || $('#kettolak').val() == '') {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan penolakan pengajuan tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var save = new FormData();
                var id = $("#id_tolak").val();
                save.append('id',id);
                save.append('ket',$('input[name="kettolak"]').val());
                save.append('pegawai_id',@json(Auth::user()->id));
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: "/api/v4/sdi/pengajuan/surket/tolak",
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    data: save,
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Pengajuan Surat Keterangan Anda telah berhasil ditolak pada '+res,
                            position: 'topRight'
                        });
                        $('#modalTolak').modal('hide');
                        showRiwayat();
                    },
                    error: function (res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pengajuan Surat Keterangan Anda gagal ditolak',
                            position: 'topRight'
                        });
                    }
                });
                // $.ajax({
                //     url: "/api/v4/sdi/pengajuan/surket/"+id+"/tolak",
                //     type: 'GET',
                //     dataType: 'json',
                //     success: function(res) {
                //         iziToast.success({
                //             title: 'Pesan Sukses!',
                //             message: 'Pengajuan Surat Keterangan Anda telah berhasil ditolak pada '+res,
                //             position: 'topRight'
                //         });
                //         $('#modalTolak').modal('hide');
                //         showRiwayat();
                //     },
                //     error: function(res) {
                //         iziToast.error({
                //             title: 'Pesan Galat!',
                //             message: 'Pengajuan Surat Keterangan Anda gagal ditolak',
                //             position: 'topRight'
                //         });
                //     }
                // });
            }
        }

        function batalTolak(id) {
            $("#id_status").val(id);
            var inputs = document.getElementById('setujustatus');
            inputs.checked = false;
            $('#modalBatalTolak').modal('show');
        }

        function prosesBatalTolak(id) {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujustatus').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan pembatalan status penolakan pengajuan tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_status").val();
                $.ajax({
                    url: "/api/v4/sdi/pengajuan/surket/"+id+"/bataltolak",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Penolakan Pengajuan Surat Keterangan telah berhasil dibatalkan pada '+res,
                            position: 'topRight'
                        });
                        $('#modalBatalTolak').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pembatalan Penolakan Pengajuan Surat Keterangan gagal dilakukan',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function verif(id) {
            $("#id_verif").val(id);
            var inputs = document.getElementById('setujuverif');
            inputs.checked = false;
            $('#modalVerif').modal('show');
        }

        function prosesVerif(id) {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuverif').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan verifikasi pengajuan tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_verif").val();
                var user = @json(Auth::user()->id);
                $.ajax({
                    url: "/api/v4/sdi/pengajuan/surket/"+id+"/verif/"+user,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Pengajuan Surat Keterangan Anda telah berhasil diverifikasi pada '+res,
                            position: 'topRight'
                        });
                        $('#modalVerif').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pengajuan Surat Keterangan Anda gagal diverifikasi',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function uploadFile(id) {
            $("#id_upload").val(id);
            $('#modalUpload').modal('show');
        }

        function prosesUploadFile() {
            var save = new FormData();
            var filesAdded = $('#filex')[0].files;
            id = $("#id_upload").val();
            save.append('id',id);
            save.append('pegawai',@json(Auth::user()->id));
            save.append('file',filesAdded[0]);

            if (filesAdded.length == 0) {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda sudah menambahkan file upload',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: "/api/v4/sdi/pengajuan/surket/proses",
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    data: save,
                    success: function(res) {
                        if (res.code == 400) {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: res.message,
                                position: 'topRight',
                                buttons: [
                                    [
                                        '<button>Tutup</button>',
                                        function (instance, toast) {
                                            instance.hide({
                                                transitionOut: 'fadeOutUp'
                                            }, toast);
                                        }
                                    ]
                                ]
                            });
                        } else {
                            iziToast.success({
                                title: 'Pesan Sukses!',
                                message: 'Surat keterangan telah berhasil diselesaikan pada '+res,
                                position: 'topRight'
                            });
                            $('#modalUpload').modal('hide');
                            showRiwayat();
                        }
                    },
                    error: function (res) {
                        let errors = res.responseJSON.errors;
                        let message = res.responseJSON.message;

                        // Ambil error pertama dari list
                        if (errors) {
                            let allErrors = [];
                            $.each(errors, function (key, val) {
                                allErrors.push(val[0]); // ambil pesan pertama per field
                            });
                            message = allErrors.join('<br>');
                        }

                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: message,
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function batalUploadFile(id) {
            $("#id_batal_upload").val(id);
            var inputs = document.getElementById('setujubatalupload');
            inputs.checked = false;
            $('#modalBatalUpload').modal('show');
        }

        function prosesBatalUploadFile(id) {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujubatalupload').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan pembatalan upload file tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_batal_upload").val();
                $.ajax({
                    url: "/api/v4/sdi/pengajuan/surket/"+id+"/batalproses",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Dokumen Final Surat Keterangan Anda telah berhasil dibatalkan pada '+res,
                            position: 'topRight'
                        });
                        $('#modalBatalUpload').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pembatalan file upload Surat Keterangan Anda gagal',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function batalVerif(id) {
            $("#id_batal_verif").val(id);
            var inputs = document.getElementById('setujubatalverif');
            inputs.checked = false;
            $('#modalBatalVerif').modal('show');
        }

        function prosesBatalVerif(id) {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujubatalverif').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan pembatalan verifikasi pengajuan tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_batal_verif").val();
                $.ajax({
                    url: "/api/v4/sdi/pengajuan/surket/"+id+"/unverif",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Pengajuan Surat Keterangan Anda telah berhasil dibatalkan status verifikasi pada '+res,
                            position: 'topRight'
                        });
                        $('#modalBatalVerif').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pengajuan Surat Keterangan Anda gagal batal verifikasi',
                            position: 'topRight'
                        });
                    }
                });
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

        function zeroPad(nr,base){ // 1 => 001 (1,100)
            var  len = (String(base).length - String(nr).length)+1;
            return len > 0? new Array(len).join('0')+nr : nr;
        }
    </script>
@endsection
