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
        runDevlMessage();
    }

    function runDevlMessage() {
        Swal.fire({
            title: `Ahh Maaf!`,
            text: `Fitur ini masih dalam tahap pengembangan! Informasi lebih lanjut silahkan hubungi Pengembang.`,
            icon: `warning`,
            showConfirmButton: false,
            showCancelButton: false,
            allowOutsideClick: true,
            allowEscapeKey: true,
            timer: 4000,
            timerProgressBar: true,
            backdrop: `rgba(26,27,41,0.8)`,
        });
    }
</script>
