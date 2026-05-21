@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Perizinan <b class="text-danger link-underline-danger text-decoration-underline">Perangkat</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">SDI</a>
                    </li>
                    <li class="breadcrumb-item pe-none" aria-current="page">
                        Absensi Pegawai
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Perizinan Perangkat
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0"><b style="font-size: 1rem">Tabel <a class="text-primary">Perangkat</a></b></h6>
                        <div class="btn-group">
                            <a href="javascript:void(0);" class="btn btn-warning-transparent btn-sm" onclick="refresh()" data-bs-toggle="tooltip" id="btn-refresh"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Segarkan Tabel"><i class="ti ti-refresh f-20 me-2"></i> Refresh Tabel Perangkat</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dttable" class="table table-hover dt-responsive align-middle" style="width: 100%">
                                <thead id="tampil-thead"></thead>
                                <tbody id="tampil-tbody">
                                    <tr>
                                        <td colspan="20" style="font-size:13px">
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
    </div>

    {{-- START MODAL --}}
    <div class="modal animate__animated animate__rubberBand fade" id="modalApprove" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form <b class="text-success">PERSETUJUAN</b> Perizinan Perangkat
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_approve" hidden>
                    <p style="text-align: justify;">Anda akan mengijinkan perangkat tersebut, status akan berubah ke <span class="badge text-bg-success">Telah Disetujui</span>. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan pemrosesan data.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuapprove">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Saya yakin untuk mengijinkan perangkat ini.</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-approve" class="btn btn-success me-sm-3 me-1" onclick="prosesApprove()"><i class="fas fa-smile-beam me-1" style="font-size:13px"></i> Ijinkan Akses</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalReject" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form <b class="text-danger">BATAL</b> Perizinan Perangkat
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_reject" hidden>
                    <p style="text-align: justify;">Anda akan menghapus ijin akses E-Absensi pada perangkat tersebut, status akan berubah ke <span class="badge text-bg-danger">Belum/Tidak Disetujui</span>. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan pemrosesan data.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujureject">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Saya yakin untuk menghapus perizinan perangkat ini.</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-reject" class="btn btn-danger me-sm-3 me-1" onclick="prosesReject()"><i class="fas fa-frown me-1" style="font-size:13px"></i> Hapus Ijin Akses</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalAktif" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form <b class="text-info">BUKA BLOKIR</b> Perangkat
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_aktif" hidden>
                    <p style="text-align: justify;">Anda akan membuka blokir perangkat pengguna tersebut. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan pemrosesan data.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuaktif">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Saya yakin untuk membuka blokir perangkat ini.</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-aktif" class="btn btn-info me-sm-3 me-1" onclick="prosesAktif()"><i class="fas fa-lock-open me-1" style="font-size:13px"></i> Buka Blokir</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalBlokir" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form <b class="text-danger">BLOKIR</b> Perangkat
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_blokir" hidden>
                    <p style="text-align: justify;">Anda akan membuka blokir perangkat pengguna tersebut. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan pemrosesan data.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujublokir">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Saya yakin untuk membuka blokir perangkat ini.</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-blokir" class="btn btn-danger me-sm-3 me-1" onclick="prosesBlokir()"><i class="fas fa-lock me-1"></i> Blokir</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    {{-- END MODAL --}}

    <script>
        $(document).ready(function() {
            refresh();
        });

        function refresh() {
            const btn = $('#btn-refresh');
            $("#tampil-thead").empty().append(`
                <tr>
                    <th><center>AKSI</center></th>
                    <th>PENGGUNA APLIKASI [<b class='text-orange'>#IDUSER</b>]</th>
                    <th>PERANGKAT</th>
                    <th>PLATFORM</th>
                    <th><center>STATUS LOGIN USER</center></th>
                    <th><center>STATUS IZIN DEVICE</center></th>
                    <th>UPDATE DATA</th>
                    <th>TERAKHIR LOGIN</th>
                    <th>DITETAPKAN</th>
                </tr>
            `);
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="20"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/v4/sdi/absensi/perangkat/table",
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.find('i').addClass('ti-spin');
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE");
                        var userID = @json(Auth::user()->id);
                        var devID = @json(Auth::user()->hasRole('karu-it'));
                        var adminID = @json(Auth::user()->can('admin_kepegawaian'));
                        var superID = @json(Auth::user()->can('admin_kepegawaian_kepala'));
                        var clrBtn = '';
                        if (item.accepted) {
                            clrBtn = 'success';
                            txtBtn = 'Telah Disetujui';
                        } else {
                            clrBtn = 'danger';
                            txtBtn = 'Belum/Tidak Disetujui';
                        }
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        content += `<td><center>`;
                                if (item.status == 1) {
                                    if (superID || adminID || devID) {
                                        if (item.nama_user) {
                                            if (item.accepted) {
                                                content += `<buttoon class="btn btn-danger-transparent btn-icon me-2" onclick="reject(${item.id})" data-bs-toggle="tooltip"
                                                data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Hapus Perizinan Device"><i class="fas fa-frown"></i></buttoon>`;
                                            } else {
                                                content += `<buttoon class="btn btn-success btn-icon me-2" onclick="approve(${item.id})" data-bs-toggle="tooltip"
                                                data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tetapkan Perizinan Device"><i class="fas fa-smile-beam"></i></buttoon>`;
                                            }
                                        } else {
                                            content += `<buttoon class="btn btn-success disabled btn-icon me-2" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="bottom" data-bs-html="true" title="Perizinan Belum dibuka sampai Pengguna melengkapi Profil" disabled><i class="fas fa-smile-beam"></i></buttoon>`;
                                        }
                                    }
                                } else {
                                    content += `<buttoon class="btn btn-success disabled btn-icon me-2" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                    data-bs-placement="bottom" data-bs-html="true" title="Tetapkan Perizinan Device" disabled><i class="fas fa-smile-beam"></i></buttoon>`;
                                }
                                if (superID || devID) {
                                    if (item.status) {
                                        content += `<buttoon class="btn btn-danger-transparent btn-icon" onclick="blokir(${item.id})" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                        data-bs-placement="bottom" data-bs-html="true" title="Blokir Device"><i class="fas fa-lock"></i></buttoon>`;
                                    } else {
                                        content += `<buttoon class="btn btn-info-transparent btn-icon" onclick="bukaBlokir(${item.id})" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                        data-bs-placement="bottom" data-bs-html="true" title="Buka Blokir Device"><i class="fas fa-lock-open"></i></buttoon>`;
                                    }
                                }
                        content += "</center></td>";
                        content += `<td>${item.nama_user?"<b class='text-"+clrBtn+"'>"+item.nama_user+"</b>":'<b class="text-secondary">Profil Pengguna Tidak Lengkap</b>'} [<b class="text-orange">#${item.user_id}</b>]</td>`;
                        content += `<td>${item.nama_brand?item.nama_brand+' - ':''}${item.nama_android?item.nama_android:'Perangkat Tidak Diketahui'} ${item.nama_device?'(ID#'+item.nama_device+')':''}</td>`;
                        content += `<td>${item.platform} (Ver. ${item.os_version})</td>`;
                                    aktif = '';
                                    if (item.status) {
                                        if (item.is_active) {
                                            aktif = '<span class="badge text-bg-info">Sedang Aktif</span>';
                                        } else {
                                            aktif = '<span class="badge text-bg-warning">Tidak Aktif</span>';
                                        }
                                    } else {
                                        aktif = '<span class="badge text-bg-danger">-</span>';
                                    }
                        content += `<td class="text-center">${aktif}</td>`;
                        content += `<td class="text-center"><span class="badge text-bg-${clrBtn}">${txtBtn}</span></td>`;
                        content += `<td>${updet}</td>`;
                        content += `<td>${item.last_login_at?new Date(item.last_login_at).toLocaleString("sv-SE"):''}</td>`;
                        content += `<td>${item.accepted_date?'Pada '+formatDateIndo(item.accepted_date):''}<br>${item.nama_admin?'Oleh '+item.nama_admin:''}</td>`;
                        // content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                        //                 <div class='d-flex justify-content-start align-items-center'>
                        //                     <div class='d-flex flex-column'>
                        //                         <a class='mb-0'>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</a>
                        //                         <small class='text-truncate text-muted'>` + item.nama_user + `</small>
                        //                     </div>
                        //                 </div>
                        //             </td>`;
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                        // Showing Tooltip
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger: 'hover'
                        })
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [5, "asc"],
                            [6, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '25%' },
                            { sWidth: '20%' },
                            { sWidth: '8%' },
                            { sWidth: '8%' },
                            { sWidth: '8%' },
                            { sWidth: '8%' },
                            { sWidth: '8%' },
                            { sWidth: '10%' },
                        ],
                        columnDefs: [
                            { sortable: false, targets: [0] },
                            { sortable: false, targets: [8] },
                            { visible: false, targets: [7] },
                        ],
                        displayLength: 20,
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

        function approve(id) {
            $("#id_approve").val(id);
            var inputs = document.getElementById('setujuapprove');
            inputs.checked = false;
            $('#modalApprove').modal('show');
        }
        function reject(id) {
            $("#id_reject").val(id);
            var inputs = document.getElementById('setujureject');
            inputs.checked = false;
            $('#modalReject').modal('show');
        }
        function bukaBlokir(id) {
            $("#id_aktif").val(id);
            var inputs = document.getElementById('setujuaktif');
            inputs.checked = false;
            $('#modalAktif').modal('show');
        }
        function blokir(id) {
            $("#id_blokir").val(id);
            var inputs = document.getElementById('setujublokir');
            inputs.checked = false;
            $('#modalBlokir').modal('show');
        }

        function prosesApprove() {
            // SWITCH BTN
            var checkbox = $('#setujuapprove').is(":checked");
            if (checkbox == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui (Check) untuk dilakukan proses perizinan perangkat pengguna tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES
                var id = $("#id_approve").val();
                $.ajax({
                    url: "/api/v4/sdi/absensi/perangkat/approve/"+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Perangkat pengguna telah berhasil diizinkan pada '+res,
                            position: 'topRight'
                        });
                        $('#modalApprove').modal('hide');
                        refresh();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Perangkat pengguna gagal diizinkan',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function prosesReject() {
            // SWITCH BTN
            var checkbox = $('#setujureject').is(":checked");
            if (checkbox == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui (Check) untuk dilakukan proses batal perizinan perangkat pengguna tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES
                var id = $("#id_reject").val();
                $.ajax({
                    url: "/api/v4/sdi/absensi/perangkat/reject/"+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Hapus Perizinan Perangkat pengguna telah berhasil dilakukan pada '+res,
                            position: 'topRight'
                        });
                        $('#modalReject').modal('hide');
                        refresh();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Prose Hapus Perizinan Perangkat pengguna gagal dilakukan',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function prosesAktif() {
            // SWITCH BTN
            var checkbox = $('#setujuaktif').is(":checked");
            if (checkbox == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui (Check) untuk dilakukan proses pengaktifan / buka blokir perangkat pengguna tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES
                var id = $("#id_aktif").val();
                $.ajax({
                    url: "/api/v4/sdi/absensi/perangkat/aktif/"+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Status Blokir dari Perangkat pengguna telah dibuka kembali pada '+res,
                            position: 'topRight'
                        });
                        $('#modalAktif').modal('hide');
                        refresh();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Proses buka blokir perangkat pengguna gagal dilakukan',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function prosesBlokir() {
            // SWITCH BTN
            var checkbox = $('#setujublokir').is(":checked");
            if (checkbox == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui (Check) untuk dilakukan pemblokiran perangkat pengguna tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES
                var id = $("#id_blokir").val();
                $.ajax({
                    url: "/api/v4/sdi/absensi/perangkat/blokir/"+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Perangkat pengguna telah berhasil diblokir pada '+res,
                            position: 'topRight'
                        });
                        $('#modalBlokir').modal('hide');
                        refresh();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Perangkat pengguna gagal diblokir',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        // helper format datetime ke format: 25 Januari 2025 14:02:00 WIB
        function formatDateIndo(datetime) {
            if (!datetime) return '';

            const date = new Date(datetime);

            // opsi format lokal Indonesia
            let formatted = date.toLocaleString("id-ID", {
                day: "2-digit",
                month: "long",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
                hour12: false,
                timeZone: "Asia/Jakarta"
            });

            // ganti titik jadi :
            formatted = formatted.replace(/\./g, ":");

            return formatted + " WIB";
        }
    </script>
@endsection
