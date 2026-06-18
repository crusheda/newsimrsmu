<div class="modal fade animate__animated animate__rubberBand" id="riwayatAbsensi" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xxl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Riwayat <b class="text-danger">Absensi</b> <b class="text-teal">Anda</b>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="dttable-riwayat-absensi" class="table table-hover dt-responsive align-middle">
                        <thead>
                            <tr>
                                <th><center>#ID</center></th>
                                <th>ABSEN BERANGKAT</th>
                                <th>ABSEN PULANG</th>
                                <th>SHIFT & JAM</th>
                                <th>KELENGKAPAN</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody-riwayat-absensi">
                            <tr>
                                <td colspan="9" style="font-size:13px">
                                    <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><center>#ID</center></th>
                                <th>TGL BERANGKAT</th>
                                <th>TGL PULANG</th>
                                <th>SHIFT</th>
                                <th>KELENGKAPAN</th>
                                <th>STATUS</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning-transparent me-1" onclick="showRiwayatAbsensi()" id="btn-refresh-riwayat-absensi"><i class="fas fa-sync me-1"></i> Refresh</button>
                <button type="button" class="btn btn-secondary-transparent" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade animate__animated animate__rubberBand" id="riwayatAbsensiDetail" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-medium fs-18 mb-0 pe-none d-flex align-items-center gap-2">
                    <span>
                        Detail <b class="text-primary link-underline-primary text-decoration-underline">Absensi</b>
                    </span>
                    <span class="badge bg-purple-gradient" id="showTxIdRiwayat">ID # <i class="ri-refresh-line ri-spin"></i></span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center mb-4 gap-2 flex-wrap">
                    <div class="lh-1"> <span class="avatar avatar-lg me-1 bg-primary"><i class="ri-stack-line fs-24 lh-1"></i></span>
                    </div>
                    <div>
                        <h6 class="fw-medium mb-2"> E-commerce Platform </h6> <span class="badge bg-success-transparent"> In
                            progress</span> <span class="text-muted fs-12"><i class="ri-circle-fill text-success mx-2 fs-9"></i>Last
                            Updated 1 Day Ago</span>
                    </div>
                    <div class="ms-auto align-self-start">
                        <div class="dropdown"> <a aria-label="anchor" href="javascript:void(0);"
                                class="btn btn-icon btn-sm btn-primary-light" data-bs-toggle="dropdown" aria-expanded="false"> <i
                                    class="fe fe-more-vertical"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);"><i
                                            class="ri-eye-line align-middle me-1 d-inline-block"></i>View</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"><i
                                            class="ri-edit-line align-middle me-1 d-inline-block"></i>Edit</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"><i
                                            class="ri-delete-bin-line me-1 align-middle d-inline-block"></i>Delete</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="fs-15 fw-medium mb-2">Project Description :</div>
                <p class="text-muted mb-4">The Customer Feedback Dashboard Development project aims to create a comprehensive
                    dashboard that aggregates and visualizes customer feedback data. This will enable our team to gain actionable
                    insights and improve customer satisfaction.</p>
                <div class="d-flex gap-5 mb-4 flex-wrap">
                    <div class="d-flex align-items-center gap-2 me-3"> <span
                            class="avatar avatar-md avatar-rounded me-1 bg-success"><i
                                class="ri-calendar-event-line fs-18 lh-1 align-middle"></i></span>
                        <div>
                            <div class="fw-medium mb-0"> Start Date </div> <span class="fs-12 text-muted">March 1, 2025</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 me-3">
                        <span class="avatar avatar-md avatar-rounded me-1 bg-info">
                            <i class="ri-time-line fs-18 lh-1 align-middle"></i>
                        </span>
                        <div>
                            <div class="fw-medium mb-0"> End Date </div> <span class="fs-12 text-muted">July 15, 2025</span>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="row gy-3">
                        <div class="col-xl-12">
                            <div class="fs-15 fw-medium mb-2">Key tasks :</div>
                            <ul class="task-details-key-tasks mb-0">
                                <li>Initial planning phase of the project including scoping and goal setting.</li>
                                <li>Designing the product layout, wireframes, and UI elements.</li>
                                <li>Coding and development of the website interface, functionality, and integration.</li>
                                <li>Testing the product and website for bugs and quality assurance checks.</li>
                                <li>Deploy the final product to the live server.</li>
                                <li>Perform usability testing and iterate based on feedback.</li>
                            </ul>
                        </div>
                        <div class="col-xl-12">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="fs-15 fw-medium">Sub Tasks :</div> <a href="javascript:void(0);"
                                    class="btn btn-primary-light btn-wave btn-sm waves-effect waves-light">See More</a>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2"><i
                                                class="ri-link fs-15 lh-1 p-1 bg-primary-transparent rounded-circle"></i></div>
                                        <div class="fw-medium">Create wireframes for homepage</div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2"><i
                                                class="ri-link fs-15 lh-1 p-1 bg-primary-transparent rounded-circle"></i></div>
                                        <div class="fw-medium">Design product pages (UI)</div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2"><i
                                                class="ri-link fs-15 lh-1 p-1 bg-primary-transparent rounded-circle"></i></div>
                                        <div class="fw-medium">Design product pages (UI)</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="fs-15 fw-medium mb-2">Skills :</div>
                <div class="d-flex gap-2 flex-wrap">
                    <span class="badge bg-primary-transparent">UI/UX Design</span>
                    <span class="badge bg-secondary-transparent">Front-End Development</span>
                    <span class="badge bg-warning-transparent">Back-End Development</span>
                    <span class="badge bg-info-transparent">Quality Assurance</span>
                    <span class="badge bg-success-transparent">Project Management</span>
                    <span class="badge bg-danger-transparent">SEO Optimization</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-transparent me-1" data-bs-dismiss="modal"><i class="ri-close-line me-1"></i> Tutup</button>
                <button type="button" class="btn btn-danger-transparent" onclick="kembaliRiwayatAbsensi()" id="btn-back-riwayat-absensi"><i class="ri-arrow-left-s-fill me-1"></i> Kembali ke Riwayat</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    })

    function showRiwayatAbsensi() {
        const btn = $("#btn-riwayat-absensi");
        const btnRefresh = $("#btn-refresh-riwayat-absensi");
        $.ajax({
            url: `/api/v4/sdi/jadwaldinas/absensi/riwayat`,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('#riwayatAbsensi').modal('show');
                $("#tampil-tbody-riwayat-absensi").empty().append(`<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
                btn.prop('disabled', true);
                btn.find("i").addClass("ri-refresh-line ri-spin").removeClass('ri-history-line');
                btnRefresh.prop('disabled', true);
                btnRefresh.find("i").addClass("fa-spin");
            },
            success: function(res) {
                $("#tampil-tbody-riwayat-absensi").empty();
                $('#dttable-riwayat-absensi').DataTable().clear().destroy();
                res.show.forEach(item => {
                    // console.log(item);
                    // var berangkat = new Date(item.tgl_in).toLocaleDateString("sv-SE");
                    // var pulang = item.tgl_out ? new Date(item.tgl_out).toLocaleDateString("sv-SE") : '-';
                    var statusLengkap = '';
                    var status = '';
                    var kdShift = '';
                    var jenis = '';

                    if (item.jenis == 1) {
                        if (!item.tgl_out && item.terlambat == 1) {
                            statusLengkap = `<span class="badge fs-14 bg-warning-transparent">Absensi Tidak Lengkap</span>`;
                            status = `<span class="badge fs-14 bg-danger-transparent">Terlambat</span>`;
                        } else if (!item.tgl_out && item.terlambat == 0) {
                            statusLengkap = `<span class="badge fs-14 bg-warning-transparent">Absensi Tidak Lengkap</span>`;
                            status = `<span class="badge fs-14 bg-success-transparent">Disiplin</span>`;
                        } else if (item.tgl_out && item.terlambat == 1) {
                            statusLengkap = `<span class="badge fs-14 bg-success-transparent">Absensi Lengkap</span>`;
                            status = `<span class="badge fs-14 bg-danger-transparent">Terlambat</span>`;
                        } else if (item.tgl_out && item.terlambat == 0) {
                            statusLengkap = `<span class="badge fs-14 bg-success-transparent">Absensi Lengkap</span>`;
                            status = `<span class="badge fs-14 bg-success-transparent">Disiplin</span>`;
                        } else { // TIDAK VALID
                            statusLengkap = `<span class="badge fs-14 bg-dark-transparent">Tidak Valid</span>`;
                            status = `<span class="badge fs-14 bg-dark-transparent">Tidak Valid</span>`;
                        }
                    } else {
                        statusLengkap = `<span class="badge fs-14 bg-success-transparent">Absensi lengkap</span>`;
                        status = `<span class="badge fs-14 bg-info-transparent">Toleransi</span>`;
                    }

                    if (item.lewat_hari == 1) {
                        kdShift = `<b class="text-primary">${item.kd_shift}</b>`;
                    } else {
                        kdShift = `<b class="text-secondary">${item.kd_shift}</b>`;
                    }

                    if (item.jenis == 1) {
                        jenis = `<b class="text-primary">SHIFT</b>`;
                    } else if (item.jenis == 3) {
                        jenis = `<b class="text-warning">IJIN</b>`;
                    } else if (item.jenis == 4) {
                        jenis = `<b class="text-success">DINAS LUAR</b>`;
                    } else { // TIDAK VALID
                        jenis = `<b class="text-dark">TIDAK VALID</b>`;
                    }

                    content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                    content += `<td><center><div class='btn-group' data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Lihat Detail Absensi ID#${item.id}">
                                    <button type='button' class='btn btn-sm btn-teal-light' id='btn-detail-${item.id}' onclick='showRiwayatAbsensiDetail(${item.id})'>${item.id} <i class="ri-arrow-right-s-line ms-1"></i></button>`;
                    content += "</div></center></td>";
                    content += `<td>${item.tgl_in}</td>`;
                    content += `<td>${item.tgl_out ? item.tgl_out : '-'}</td>`;
                    content += `<td style='white-space: normal !important; word-wrap: break-word;'>
                                    <div class='d-flex justify-content-start align-items-center'>
                                        <div class='d-flex flex-column'>
                                            <h6 class='mb-0'>
                                                ${jenis}&nbsp;${kdShift}<i class="ri-arrow-right-s-line text-orange ms-1 me-1"></i>${item.nm_shift}
                                            </h6>
                                            <small class='text-muted'>${moment(item.ref_jam_masuk).format("HH:mm")} - ${moment(item.ref_jam_pulang).format("HH:mm")}</small>
                                        </div>
                                    </div>
                                </td>`;
                    content += `<td>${statusLengkap}</td>`;
                    content += `<td>${status}</td>`;
                    content += "</tr>";
                    $('#tampil-tbody-riwayat-absensi').append(content);

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                });
                var table = $('#dttable-riwayat-absensi').DataTable({
                    order: [
                        [1, "desc"]
                    ],
                    bAutoWidth: false,
                    aoColumns : [
                        { sWidth: '10%' },
                        { sWidth: '15%' },
                        { sWidth: '15%' },
                        { sWidth: '25%' },
                        { sWidth: '20%' },
                        { sWidth: '15%' },
                    ],
                    displayLength: 20,
                });
            },
            error: function(xhr, status, error) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: xhr.responseJSON.message ?? 'Riwayat Absensi gagal dimuat, silakan coba beberapa saat lagi',
                    position: 'topRight'
                });
            },
            complete: function() {
                btn.prop('disabled', false);
                btn.find("i").addClass("ri-history-line").removeClass('ri-refresh-line ri-spin');
                btnRefresh.prop('disabled', false);
                btnRefresh.find("i").removeClass('fa-spin');
            }
        })
    }

    function showRiwayatAbsensiDetail(id) {
        const btn = $("#btn-detail-"+id);
        const btn_temp = btn.html();
        $.ajax({
            url: `/api/v4/sdi/jadwaldinas/absensi/riwayat/${id}`,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                btn.prop('disabled', true);
                btn.html('<i class="ri-refresh-line ri-spin"></i>');
            },
            success: function(res) {
                $('#showTxIdRiwayat').text("ID # "+id);
            },
            error: function(xhr, status, error) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: xhr.responseJSON.message ?? 'Detail Absensi gagal dimuat, silakan coba beberapa saat lagi',
                    position: 'topRight'
                });
            },
            complete: function() {
                $('#riwayatAbsensi').modal('hide');
                btn.html(btn_temp);
                btn.prop('disabled', false);
                $('#riwayatAbsensiDetail').modal('show');
            }
        })
    }

    function kembaliRiwayatAbsensi() {
        $('#riwayatAbsensiDetail').modal('hide');
        $('#riwayatAbsensi').modal('show');
    }

    // function runDevlMessage() {
    //     Swal.fire({
    //         title: `Ahh Maaf!`,
    //         text: `Fitur ini masih dalam tahap pengembangan! Informasi lebih lanjut silahkan hubungi Pengembang.`,
    //         icon: `warning`,
    //         showConfirmButton: false,
    //         showCancelButton: false,
    //         allowOutsideClick: true,
    //         allowEscapeKey: true,
    //         timer: 4000,
    //         timerProgressBar: true,
    //         backdrop: `rgba(26,27,41,0.8)`,
    //     });
    // }
</script>
