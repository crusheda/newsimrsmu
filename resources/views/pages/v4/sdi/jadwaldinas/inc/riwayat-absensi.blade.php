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
                                <th>JENIS & SHIFT & JAM</th>
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
                                <th>ABSEN BERANGKAT</th>
                                <th>ABSEN PULANG</th>
                                <th>JENIS & SHIFT & JAM</th>
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
                <h6 class="modal-title fw-medium fs-18 mb-0 d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-secondary-transparent me-1" onclick="kembaliRiwayatAbsensi()"><i class="ri-arrow-left-s-fill"></i></button>
                    <span>
                        Detail <b class="text-primary link-underline-primary text-decoration-underline">Absensi</b>
                    </span>
                    <span class="badge bg-purple-gradient" id="showTxIdRiwayat">ID # <i class="ri-refresh-line ri-spin"></i></span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-hidden" id="tampil-detail-absensi"></div>
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
                    content += `<td data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="${moment(item.tgl_in).format('dddd, DD MMM YYYY HH:mm:ss [WIB]')}">${item.tgl_in}</td>`;
                    content += `<td data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="${item.tgl_out?moment(item.tgl_out).format('dddd, DD MMM YYYY HH:mm:ss [WIB]'):'...'}">${item.tgl_out ? item.tgl_out : '-'}</td>`;
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

                // JENIS ABSENSI
                let jenisAbsensi = '';
                if (res.show.jenis == 1) {
                    jenisAbsensi = `<span class="nft-details-auction-time">Shift Jaga (${res.show.kd_shift})</span>`;
                } else if (res.show.jenis == 3) {
                    jenisAbsensi = `<span class="nft-details-auction-time bg-warning">Ijin / Tidak Masuk</span>`;
                } else if (res.show.jenis == 4) {
                    jenisAbsensi = `<span class="nft-details-auction-time bg-info">Dinas Luar</span>`;
                } else {
                    jenisAbsensi = `<span class="nft-details-auction-time bg-secondary">Tidak Diketahui</span>`;
                }

                // ROLES / JABATAN PEGAWAI
                let jabatan = '';
                let roles = res.show?.pegawai?.roles ?? [];
                if (roles.length > 0) {
                    jabatan = `<span class="badge bg-primary-transparent me-1">`;
                    roles.forEach(r => {
                        jabatan += `${r.deskripsi ?? r.name ?? '??'} `;
                    });
                    jabatan += `</span>`;
                } else {
                    jabatan = `<span class="badge bg-secondary-transparent">Tidak ada jabatan</span>`;
                }

                // FOTO PROFIL
                let foto = "{{ asset('images/no-image-person.png') }}";

                if(res.show.foto_pegawai){
                    foto = "{{ url('storage') }}/" + res.show.foto_pegawai.replace('public/','');
                }

                let keterlambatan = '-';
                if (res.show.keterlambatan) {
                    if (res.show.keterlambatan == '00:00:00') {
                        keterlambatan = '<b class="text-success">Disiplin</b>';
                    } else {
                        keterlambatan = '<b class="text-danger">'+getTimeDescription(res.show.keterlambatan)+'</b>';
                    }
                }

                content = ``;
                content += `${jenisAbsensi}
                            <div class="d-flex align-items-center mb-4 gap-2 flex-wrap">
                                <div class="lh-1">
                                    <span class="avatar avatar-lg me-1 avatar-rounded" id="rFoto">
                                        <img src="${foto}" alt="foto_profil">
                                    </span>
                                </div>
                                <div>
                                    <h6 class="fw-medium mb-2"> ${res.show.nama_pegawai} </h6>
                                    ${jabatan}
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="row gy-3">
                                    <div class="col-xl-4 mb-3">
                                        <div class="fs-15 fw-medium mb-2 text-center">Foto Absensi</div>
                                        <div class="swiper pagination-absensi">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide d-flex justify-content-center align-items-center">
                                                    <img src="https://absensi.simrsmu.com/api/kepegawaian/detail/foto/${res.show.id}/1"
                                                        class="img-fluid rounded"
                                                        alt="Berangkat"
                                                        style="width:300px;height:300px;object-fit:cover">
                                                </div>
                                                <div class="swiper-slide d-flex justify-content-center align-items-center ${res.show.jenis != 1 ? 'invisible' : ''}">
                                                    <img src="https://absensi.simrsmu.com/api/kepegawaian/detail/foto/${res.show.id}/0"
                                                        class="img-fluid rounded"
                                                        alt="Pulang"
                                                        style="width:300px;height:300px;object-fit:cover">
                                                </div>
                                            </div>
                                            <div class="swiper-pagination absensi-pagination"></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8">
                                        <div class="fs-15 fw-medium mb-3">Detail Absensi :</div>
                                        <div class="d-flex gap-10 flex-wrap">
                                            <div class="d-flex align-items-center gap-2 me-3 mb-4">
                                                <span class="avatar avatar-md avatar-rounded me-1 bg-success">
                                                    <i class="ri-flight-takeoff-line fs-18 lh-1 align-middle"></i>
                                                </span>
                                                <div>
                                                    <div class="fw-medium mb-0"> Berangkat </div>
                                                    <span class="fs-12 text-muted">${moment(res.show.tgl_in).format('dddd, DD MMM YYYY HH:mm:ss [WIB]')}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2 me-3 mb-4 ${res.show.jenis != 1 ? 'invisible' : ''}">
                                                <span class="avatar avatar-md avatar-rounded me-1 bg-danger">
                                                    <i class="ri-flight-land-line fs-18 lh-1 align-middle"></i>
                                                </span>
                                                <div>
                                                    <div class="fw-medium mb-0"> Pulang </div>
                                                    <span class="fs-12 text-muted">${res.show.tgl_out ? moment(res.show.tgl_out).format('dddd, DD MMM YYYY HH:mm:ss [WIB]') : '-'}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="list-unstyled job-highlights-list">
                                            <li>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="lh-1">
                                                        <span class="avatar avatar-sm border lh-1 avatar-rounded me-2 bg-light text-default">
                                                            <i class="ri-calendar-check-line fs-15"></i>
                                                        </span> <b class="text-muted">Shift :</b>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge bg-info-transparent">${res.show.kd_shift}</span> ${res.show.nm_shift}&nbsp;&nbsp;(<b class="text-orange">${moment(res.show.ref_jam_masuk).format("HH:mm")}</b> - <b class="text-orange">${moment(res.show.ref_jam_pulang).format("HH:mm")}</b>)
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="lh-1"> <span class="avatar avatar-sm border lh-1 avatar-rounded me-2 bg-light text-default"> <i
                                                                class="ri-time-line fs-15"></i> </span> <b class="text-muted">Keterlambatan :</b></div>
                                                    <div>${keterlambatan}</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="lh-1"> <span class="avatar avatar-sm border lh-1 avatar-rounded me-2 bg-light text-default">
                                                            <i class="ri-calendar-schedule-fill fs-15"></i> </span> <b class="text-muted">Lembur :</b></div>
                                                    <div>${res.show.lembur ? getTimeDescription(res.show.lembur) : '-'}</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="lh-1"> <span class="avatar avatar-sm border lh-1 avatar-rounded me-2 bg-light text-default">
                                                            <i class="ri-hourglass-fill fs-15"></i> </span> <b class="text-muted">Total Waktu Bekerja :</b></div>
                                                    <div>${res.show.selisih_jam ? getTimeDescription(res.show.selisih_jam) : '-'}</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center gap-2 ${res.show.jenis == 1 ? 'invisible' : ''}">
                                                    <div class="lh-1"> <span class="avatar avatar-sm border lh-1 avatar-rounded me-2 bg-light text-default">
                                                            <i class="ri-sticky-note-add-line fs-15"></i> </span> <b class="text-muted">Keterangan :</b></div>
                                                    <p class="mb-0">${res.show.keterangan??'-'}</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>`;

                $('#tampil-detail-absensi').empty().append(content);

                // swiper with pagination
                if(window.swiperAbsensi){
                    window.swiperAbsensi.destroy(true,true);
                }

                window.swiperAbsensi = new Swiper(".pagination-absensi", {

                    slidesPerView: 1,
                    centeredSlides: true,

                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false
                    },

                    observer: true,
                    observeParents: true,

                    pagination: {

                        el: ".absensi-pagination",

                        clickable: true,

                        renderBullet: function(index, className) {

                            let text = index === 0 ? "<i class='text-success ri-flight-takeoff-line mt-2'></i>" : "<i class='text-danger ri-flight-land-line mt-2'></i>";

                            return `
                                <button type="button" class="${className}">
                                    ${text}
                                </button>
                            `;
                        }
                    },

                });

                window.swiperAbsensi.autoplay.start();
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

    function getTimeDescription(waktu) {

        let durasi = moment.duration(waktu);

        let jam = durasi.hours();
        let menit = durasi.minutes();
        let detik = durasi.seconds();

        let hasil = [];

        if (jam > 0) {
            hasil.push(
                String(jam).padStart(2,'0') + " jam"
            );
        }

        if (menit > 0) {
            hasil.push(
                String(menit).padStart(2,'0') + " menit"
            );
        }

        if (detik > 0) {
            hasil.push(
                String(detik).padStart(2,'0') + " detik"
            );
        }

        return hasil.join(" ");
    }
</script>
