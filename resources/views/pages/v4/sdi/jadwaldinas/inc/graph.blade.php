<div class="col-xl-12 mb-3">
    <div class="row">
        <div class="col-xl-3">
            <div class="card custom-card mb-3">
                <div class="card-body">
                    <div class="d-flex gap-3 flex-wrap align-items-center">
                        <span class="avatar avatar-md bg-success-transparent svg-success">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                            </svg>
                        </span>
                        <div>
                            <div class="fw-medium">Cuti Tahunan <b class="text-orange">Anda</b></div>
                            <span class="fw-semibold fs-12 text-muted">Tahun <b class="text-success">{{ \Carbon\Carbon::now()->isoFormat('YYYY') }}</b></span>
                        </div>
                        <div class="ms-auto text-muted fs-11 text-end">
                            <h6 class="fw-medium mb-0 fs-25" id="showTxCuti"><i class="ri-refresh-line ri-spin"></i></h6>
                            <small>Terpakai</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer btn-group">
                    @can('admin_kepegawaian')
                        <button class="btn btn-sm btn-info-transparent" onclick="totalCutiAllUnit()"><i class="ri-umbrella-line me-1"></i> Lihat Cuti Tahunan Semua Unit</button>
                    @else
                        <button class="btn btn-sm btn-success-transparent" onclick="totalCutiUnit()"><i class="ri-umbrella-line me-1"></i> Lihat Cuti Tahunan Unit</button>
                    @endcan
                    <button class="btn btn-sm btn-danger-transparent" onclick="showRiwayatAbsensi()" id="btn-riwayat-absensi"><i class="ri-history-line me-1"></i> Riwayat Absensi</button>
                </div>
            </div>
            {{-- colors: [
                "#64748B", // Total Hari
                "#5DF4F9", // Hadir
                "#10B981", // Disiplin (baru)
                "#3B82F6", // Ijin
                "#EF4444", // Terlambat
                "#F97316", // Belum Pulang
                "#A855F7", // Cuti
                "#94A3B8", // Libur
                "#DC2626", // Mangkir
                "#14B8A6"  // Sisa
            ] --}}
            <div class="card shadow-none-border mb-3">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">Keterangan <b class="text-teal">Grafik Absensi</b></h6>
                    <div data-simplebar id="scrollKeteranganGrafik" style="max-height: 380px;">
                        <ul class="list-unstyled mb-0 text-dark" id="showKeteranganGrafik" hidden>
                            <li class="mb-2">
                                <div class="d-flex align-items-start gap-2">
                                    <div class="lh-0">
                                        <i class="ri-circle-fill" style="color: #64748B"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <span class="fw-medium">Total Hari Kerja</span>
                                        <span class="d-block text-muted fs-12">Total dari keseluruhan Jadwal Masuk Shift</span>
                                    </div>
                                </div>
                            </li>

                            <li class="mb-2">
                                <div class="d-flex align-items-start gap-2">
                                    <div class="lh-0">
                                        <i class="ri-circle-fill" style="color: #5DF4F9"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <span class="fw-medium">Hadir</span>
                                        <span class="d-block text-muted fs-12">Pegawai hadir sesuai jadwal kerja</span>
                                    </div>
                                </div>
                            </li>

                            <li class="mb-2">
                                <div class="d-flex align-items-start gap-2">
                                    <div class="lh-0">
                                        <i class="ri-circle-fill" style="color: #10B981"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <span class="fw-medium">Disiplin</span>
                                        <span class="d-block text-muted fs-12">Absensi lengkap tanpa pelanggaran waktu</span>
                                    </div>
                                </div>
                            </li>

                            <li class="mb-2">
                                <div class="d-flex align-items-start gap-2">
                                    <div class="lh-0">
                                        <i class="ri-circle-fill" style="color: #3B82F6"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <span class="fw-medium">Ijin / Dinas Luar</span>
                                        <span class="d-block text-muted fs-12">Pegawai tidak hadir karena tugas atau izin resmi</span>
                                    </div>
                                </div>
                            </li>

                            <li class="mb-2">
                                <div class="d-flex align-items-start gap-2">
                                    <div class="lh-0">
                                        <i class="ri-circle-fill" style="color: #EF4444"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <span class="fw-medium">Terlambat</span>
                                        <span class="d-block text-muted fs-12">Masuk kerja melewati jam yang ditentukan</span>
                                    </div>
                                </div>
                            </li>

                            <li class="mb-2">
                                <div class="d-flex align-items-start gap-2">
                                    <div class="lh-0">
                                        <i class="ri-circle-fill" style="color: #F97316"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <span class="fw-medium">Absen 1x</span>
                                        <span class="d-block text-muted fs-12">Belum melakukan absensi pulang</span>
                                    </div>
                                </div>
                            </li>

                            <li class="mb-2">
                                <div class="d-flex align-items-start gap-2">
                                    <div class="lh-0">
                                        <i class="ri-circle-fill" style="color: #A855F7"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <span class="fw-medium">Cuti</span>
                                        <span class="d-block text-muted fs-12">Pegawai sedang cuti resmi</span>
                                    </div>
                                </div>
                            </li>

                            <li class="mb-2">
                                <div class="d-flex align-items-start gap-2">
                                    <div class="lh-0">
                                        <i class="ri-circle-fill" style="color: #94A3B8"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <span class="fw-medium">Libur</span>
                                        <span class="d-block text-muted fs-12">Hari libur non kerja</span>
                                    </div>
                                </div>
                            </li>

                            <li class="mb-2">
                                <div class="d-flex align-items-start gap-2">
                                    <div class="lh-0">
                                        <i class="ri-circle-fill" style="color: #DC2626"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <span class="fw-medium">Mangkir</span>
                                        <span class="d-block text-muted fs-12">Tidak hadir / tidak melakukan absensi tanpa keterangan</span>
                                    </div>
                                </div>
                            </li>

                            <li class="mb-0">
                                <div class="d-flex align-items-start gap-2">
                                    <div class="lh-0">
                                        <i class="ri-circle-fill" style="color: #14B8A6"></i>
                                    </div>
                                    <div class="flex-fill">
                                        <span class="fw-medium">Sisa Hari Kerja</span>
                                        <span class="d-block text-muted fs-12">Hari kerja yang belum terisi status absensi / belum melakukan absensi</span>
                                    </div>
                                </div>
                            </li>

                        </ul>
                        <div id="loadingKeteranganGrafik" class="text-dark"><center><i class="ri-refresh-line ri-spin me-1"></i> Memuat Data</center></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="row">
                <div class="col-xl-4 d-flex">
                    <div class="card custom-card dashboard-main-card overflow-hidden primary mb-3 w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-3">
                                <div class="flex-fill">
                                    <span class="fs-13 fw-medium">Total Keterlambatan <span class="badge bg-outline-primary badge-sm" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Periode Bulan Ini"
                                        >{{ \Carbon\Carbon::now()->isoFormat('MMMM Y') }}</span></span>
                                    <h1 class="fw-semibold my-2 lh-1" id="cx_total_terlambat_bulan_ini" style="cursor: pointer;"><i class="ri-refresh-line ri-spin fs-16"></i></h1>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="fs-12 d-block text-muted mt-1">
                                            <span class="me-1 d-inline-flex align-items-center fw-semibold" id="cx_presentase_terlambat"><i class="ri-refresh-line ri-spin"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <span class="avatar avatar-lg bg-primary-transparent">
                                        <i class="ri-calendar-schedule-line fs-22"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 d-flex">
                    <div class="card custom-card dashboard-main-card overflow-hidden secondary mb-3 w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-3">
                                <div class="flex-fill">
                                    <span class="fs-13 fw-medium">Total Keterlambatan <span class="badge bg-outline-secondary badge-sm" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Periode Bulan Lalu"
                                        >{{ \Carbon\Carbon::now()->subMonth()->isoFormat('MMMM Y') }}</span>
                                    </span>
                                    <h1 class="fw-semibold my-2 lh-1" id="cx_total_terlambat_bulan_lalu" style="cursor: pointer;"><i class="ri-refresh-line ri-spin fs-16"></i></h1>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="fs-12 d-block text-muted mt-1">
                                            <span class="me-1 d-inline-flex align-items-center fw-semibold">Periode &nbsp;<b class="text-orange">Bulan Lalu</b></span>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <span class="avatar avatar-lg bg-secondary-transparent">
                                        <i class="ri-calendar-schedule-line fs-22"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card custom-card dashboard-main-card overflow-hidden info mb-3">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-start gap-3">
                                <span class="avatar avatar-lg bg-info-transparent">
                                    <i class="ri-stack-overflow-line fs-22"></i>
                                </span>
                                <div class="flex-fill">
                                    <span class="fs-13 fw-medium">Total Lembur Bulan Ini</span>
                                    <h6 class="fw-semibold my-2 lh-1 mb-0 text-info" id="cx_total_lembur_bulan_ini" style="cursor: pointer;"><i class="ri-refresh-line ri-spin fs-16 text-dark"></i></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card custom-card dashboard-main-card overflow-hidden success mb-3">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-start gap-3">
                                <span class="avatar avatar-lg bg-success-transparent">
                                    <i class="ri-home-office-line fs-22"></i>
                                </span>
                                <div class="flex-fill">
                                    <span class="fs-13 fw-medium">Total Bekerja Bulan Ini</span>
                                    <h6 class="fw-semibold my-2 lh-1 mb-0 text-success" id="cx_total_kerja_bulan_ini" style="cursor: pointer;"><i class="ri-refresh-line ri-spin fs-16 text-dark"></i></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card shadow-none-border mb-0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="">
                        <div class="card-body mb-0">
                            <center><h6>Grafik Absensi <b class="text-danger">6 Bulan Terakhir</b></h6></center>
                            <div id="area-stacked"><b class="text-dark"><center><i class="ri-refresh-line ri-spin me-1"></i> Memuat Grafik...</center></b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="col-xl-3 mb-3">
    <div class="card mb-0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Jumlah Absensi Anda dalam kurun waktu 1 bulan penghitungan BULAN INI (Tidak termasuk Cuti, Libur, Ijin, dll)">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="my-n4" style="width: 130px">
                        <div id="grafikTotalAbsensi1"></div>
                    </div>
                </div>
                <div class="flex-grow-1 mx-2">
                    <p class="mb-1 text-dark">Total Absensi (Shift Jaga) <span class="badge text-bg-primary">BULAN INI</span></p>
                    <b class="text-dark"><small class="mb-0" id="dateGrafikTotalAbsensi1"></small></b>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 mb-3">
    <div class="card mb-0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Jumlah Absensi Anda dalam kurun waktu 1 bulan penghitungan BULAN LALU (Tidak termasuk Cuti, Libur, Ijin, dll)">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="my-n4" style="width: 130px">
                        <div id="grafikTotalAbsensi0"></div>
                    </div>
                </div>
                <div class="flex-grow-1 mx-2">
                    <p class="mb-1 text-dark">Total Absensi (Shift Jaga) <span class="badge text-bg-secondary">BULAN LALU</span></p>
                    <b class="text-dark"><small class="mb-0" id="dateGrafikTotalAbsensi0"></small></b>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- MODAL --}}
<div class="modal fade animate__animated animate__rubberBand" id="modalCutiUnit" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xxl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Daftar <b class="text-teal">Cuti Tahunan</b> <b class="text-info">Unit Kerja</b>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="tampil-cuti-unit">
                    <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-transparent" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    let chartAbsensi = null;
    let autoScrollTimer = null;
    $(document).ready(function() {
        totalCuti();
        // graphTotalAbsensi(1); // periode aktif 21→20 (sekarang)
        // graphTotalAbsensi(0); // periode sebelumnya 21→20
        grafikAbsensi();
        countAbsensi();
    })

    // function graphTotalAbsensi(range) {
    //     $.ajax({
    //         url: "/api/v4/sdi/jadwaldinas/totalabsensi/" + range,
    //         type: "GET",
    //         dataType: "json",
    //         success: function(res) {

    //             if (range == 1) {
    //                 colorGrafik = "#2563EB"; // biru
    //                 colorBackGrafik = "#2563EB30"; // biru muda
    //             } else {
    //                 colorGrafik = "#DC2626"; // merah
    //                 colorBackGrafik = "#fce9e9"; // merah muda
    //             }

    //             let totalAbsensi = Number(res.total_absensi) || 0;
    //             let totalHariKerja = Number(res.total_hari_kerja) || 0;

    //             let persen = totalHariKerja > 0
    //                 ? Math.round((totalAbsensi / totalHariKerja) * 100)
    //                 : 0;

    //             let options = {
    //                 series: [persen],
    //                 chart: {
    //                     height: 115,
    //                     type: "radialBar"
    //                 },
    //                 plotOptions: {
    //                     radialBar: {
    //                         hollow: {
    //                             margin: 0,
    //                             size: "60%",
    //                             background: "transparent"
    //                         },
    //                         track: {
    //                             background: colorBackGrafik,
    //                             strokeWidth: "100%"
    //                         },
    //                         dataLabels: {
    //                             show: true,
    //                             name: { show: false },
    //                             value: {
    //                                 formatter: function () {
    //                                     return totalAbsensi + "x / " + totalHariKerja + "hr"; // teks tengah
    //                                 },
    //                                 offsetY: 7,
    //                                 color: colorGrafik,
    //                                 fontSize: "12px",
    //                                 fontWeight: "700",
    //                                 show: true
    //                             }
    //                         }
    //                     }
    //                 },
    //                 colors: [colorGrafik],
    //                 fill: { type: "solid" },
    //                 stroke: { lineCap: "round" },
    //                 tooltip: {
    //                     enabled: true,
    //                     y: {
    //                         formatter: function () {
    //                             return persen + "% (Total Absensi " + totalAbsensi + "x / Total Hari Kerja " + totalHariKerja + "hr)";
    //                         }
    //                     }
    //                 }
    //             };

    //             new ApexCharts(
    //                 document.querySelector("#grafikTotalAbsensi"+range),
    //                 options
    //             ).render();

    //             // tampilkan bulan dan tahun
    //             $('#dateGrafikTotalAbsensi'+range).text(
    //                 formatTanggalIndo(res.start) + ' - ' + formatTanggalIndo(res.end)
    //             );
    //         },

    //         error: function(err) {
    //             console.error("Gagal load grafik absensi", err);
    //         }
    //     });
    // }

    // function totalCuti() {
    //     $.ajax({
    //         url: "/api/v4/sdi/jadwaldinas/totalcuti",
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function(res) {

    //             var totalReal = parseInt(res);
    //             var maxCuti   = 12;

    //             var progressValue = Math.min(totalReal, maxCuti);
    //             var percent = (progressValue / maxCuti) * 100;

    //             var $container = $('.cuti-progress');
    //             var $bar       = $container.find('.progress-bar');
    //             var $value     = $container.find('.progress-bar-value');
    //             var $indicator = $container.find('.cuti-indicator');
    //             var $over      = $container.find('.cuti-over');

    //             // reset dulu
    //             $bar.removeClass('bg-danger').css('width', '0%');
    //             $value.text('0%');
    //             // $indicator.text('0x').css('left', '0%');
    //             $over.hide();

    //             // animasi delay biar smooth
    //             setTimeout(function() {

    //                 // animasi width
    //                 $bar.css({
    //                     'width': percent + '%',
    //                     'transition': 'width 1s ease'
    //                 });

    //                 // animasi angka persen (opsional naik bertahap)
    //                 let current = 0;
    //                 let interval = setInterval(function() {
    //                     if (current >= totalReal) {
    //                         clearInterval(interval);
    //                     } else {
    //                         current++;
    //                         $value.text(totalReal + ' x');
    //                     }
    //                 }, 200);

    //                 // indikator jumlah cuti REAL
    //                 // $indicator
    //                 //     .text(totalReal + 'x')
    //                 //     .css({
    //                 //         'left': percent + '%',
    //                 //         'transition': 'left 1s ease'
    //                 //     });

    //                 // over limit
    //                 var over = totalReal - maxCuti;

    //                 if (over > 0) {
    //                     $bar.addClass('bg-danger');

    //                     $over
    //                         .text('Over +' + over)
    //                         .fadeIn();
    //                 }

    //             }, 100);

    //         },
    //         error: function(err) {
    //             Swal.fire({
    //                 title: err.statusText + " (Code " + err.status + ")",
    //                 html: err.responseText,
    //                 icon: "error",
    //                 showConfirmButton: true,
    //                 backdrop: `rgba(26,27,41,0.8)`,
    //             });
    //         }
    //     });
    // }

    function totalCuti() {
        $.ajax({
            url: "/api/v4/sdi/jadwaldinas/totalcuti",
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('#showTxCuti').empty().append('<i class="ri-refresh-line ri-spin"></i>');
            },
            success: function(res) {
                $('#showTxCuti').empty().append(res+'<b class="text-orange">x</b>');
            },
            error: function(err) {
                Swal.fire({
                    title: err.statusText + " (Code " + err.status + ")",
                    html: err.responseText,
                    icon: "error",
                    showConfirmButton: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                });
                $('#showTxCuti').empty().append('<b class="text-danger">xx</b>');
            }
        });
    }

    function grafikAbsensi() {
        $.ajax({
            url: "/api/v4/sdi/jadwaldinas/grafikabsensi",
            type: "GET",
            dataType: "json",
            beforeSend: function() {
                $('#showKeteranganGrafik').prop('hidden',true);
                $('#loadingKeteranganGrafik').prop('hidden',false);
            },
            success: function (res) {
                $('#area-stacked').empty();

                let categories = [];

                let totalHari = [];
                let hadir = [];
                let disiplin = [];
                let ijinDL = [];
                let terlambat = [];
                let belumPulang = [];
                let cuti = [];
                let libur = [];
                let mangkir = [];
                let sisa = [];

                res.forEach((item) => {

                    categories.push(item.periode);

                    totalHari.push(item.total_hari_kerja);
                    hadir.push(item.hadir);

                    // DISIPLIN dari absensi_lengkap
                    disiplin.push(item.absensi_lengkap);

                    ijinDL.push((item.ijin || 0) + (item.dinas_luar || 0));

                    terlambat.push(item.terlambat);
                    belumPulang.push(item.belum_pulang);
                    cuti.push(item.cuti);
                    libur.push(item.libur);
                    mangkir.push(item.mangkir);

                    let sisaHari =
                        (item.total_hari_kerja || 0)
                        - (
                            (item.hadir || 0)
                            + (item.ijin || 0)
                            + (item.dinas_luar || 0)
                            + (item.cuti || 0)
                            + (item.libur || 0)
                            + (item.mangkir || 0)
                        );

                    sisa.push(sisaHari < 0 ? 0 : sisaHari);
                });

                let options = {
                    series: [
                        { name: "Total Hari Kerja", data: totalHari },
                        { name: "Hadir", data: hadir },

                        // DISIPLIN BARU
                        { name: "Disiplin", data: disiplin },

                        { name: "Ijin / Dinas Luar", data: ijinDL },
                        { name: "Terlambat", data: terlambat },
                        { name: "Absen 1x", data: belumPulang },
                        { name: "Cuti", data: cuti },
                        { name: "Libur", data: libur },
                        { name: "Mangkir", data: mangkir },
                        { name: "Sisa Hari Kerja", data: sisa },
                    ],

                    chart: {
                        type: "area",
                        height: 380,
                        stacked: false,
                        toolbar: { show: true },
                        // parentHeightOffset: 10,
                        // redrawOnWindowResize: true
                    },

                    colors: [
                        "#64748B", // Total Hari
                        "#5DF4F9", // Hadir
                        "#10B981", // Disiplin (baru)
                        "#3B82F6", // Ijin
                        "#EF4444", // Terlambat
                        "#F97316", // Belum Pulang
                        "#A855F7", // Cuti
                        "#94A3B8", // Libur
                        "#DC2626", // Mangkir
                        "#14B8A6"  // Sisa
                    ],

                    stroke: {
                        curve: "smooth"
                    },

                    fill: {
                        type: "gradient",
                        gradient: {
                            shade: "light",
                            opacityFrom: 0.8,
                            opacityTo: 0.2
                        }
                    },

                    dataLabels: {
                        enabled: false
                    },

                    legend: {
                        position: "top",
                        horizontalAlign: "left"
                    },

                    // xaxis: {
                    //     categories: categories
                    // },
                    xaxis: {
                        categories: categories,
                        labels: {
                            rotate: 0,
                            trim: false,
                            hideOverlappingLabels: false,
                            style: {
                                fontSize: "10px",
                                fontStyle: "italic"
                            },
                            formatter: function (value) {
                                if (!value) return value;

                                let parts = value.split(" - ");

                                // return array -> ApexCharts akan convert ke <tspan>
                                return parts;
                            }
                        }
                    },

                    tooltip: {
                        shared: true
                    }
                };

                if (chartAbsensi) {
                    chartAbsensi.destroy();
                }

                chartAbsensi = new ApexCharts(
                    document.querySelector("#area-stacked"),
                    options
                );

                chartAbsensi.render();
            },

            error: function (xhr) {
                iziToast.error({
                    title: "Pesan Galat!",
                    message: xhr.responseJSON?.message ?? "Terjadi kesalahan",
                    position: "topRight"
                });
            }, complete: function() {
                $('#showKeteranganGrafik').prop('hidden',false);
                $('#loadingKeteranganGrafik').prop('hidden',true);

                setTimeout(function () {
                    autoScrollKeterangan();
                }, 200);
            }
        });
    }

    function countAbsensi() {
        $.ajax({
            url: "/api/v4/sdi/jadwaldinas/countabsensi",
            type: "GET",
            dataType: "json",
            beforeSend: function() {
                $('#cx_total_terlambat_bulan_ini').empty().html(`<i class="ri-refresh-line ri-spin fs-16"></i>`);
                $('#cx_presentase_terlambat').empty().html(`<i class="ri-refresh-line ri-spin"></i>`);

                $('#cx_total_terlambat_bulan_lalu').empty().html(`<i class="ri-refresh-line ri-spin fs-16"></i>`);

                $('#cx_total_lembur_bulan_ini').empty().html(`<i class="ri-refresh-line ri-spin fs-16"></i>`);
                $('#cx_total_kerja_bulan_ini').empty().html(`<i class="ri-refresh-line ri-spin fs-16"></i>`);
            },
            success: function (res) {
                // ==========================
                // VALIDASI DATA
                // ==========================

                const terlambatBulanIni =
                    res.terlambat_bulan_ini ?? '-';

                const terlambatBulanLalu =
                    res.terlambat_bulan_lalu ?? '-';

                const persentasePerubahan =
                    res.persentase_perubahan !== null && res.persentase_perubahan !== undefined
                        ? `${res.persentase_perubahan}%`
                        : '-';

                const status =
                    res.status ?? '-';

                const waktuTerlambatBulanIni =
                    res.total_waktu_terlambat_bulan_ini ?? '-';

                const waktuTerlambatBulanLalu =
                    res.total_waktu_terlambat_bulan_lalu ?? '-';

                const totalLembur =
                    res.total_waktu_lembur ?? '-';

                const totalJamBekerja =
                    res.total_jam_bekerja ?? '-';

                const periodeSekarang =
                    res.periode_sekarang ?? {};

                const periodeSebelumnya =
                    res.periode_sebelumnya ?? {};

                const mulaiSekarang =
                    periodeSekarang.mulai ?? '-';

                const sampaiSekarang =
                    periodeSekarang.sampai ?? '-';

                const mulaiSebelumnya =
                    periodeSebelumnya.mulai ?? '-';

                const sampaiSebelumnya =
                    periodeSebelumnya.sampai ?? '-';

                // CARD 1
                    let iconPrs = '';
                    if (res.status == 'naik') {
                        iconPrs = '<i class="ti ti-trending-up me-1 fw-semibold align-middle"></i>';
                        $('#cx_presentase_terlambat').removeClass('text-success text-danger').addClass('text-danger');
                    } else { // turun
                        if (res.status == 'turun') {
                            iconPrs = '<i class="ti ti-trending-down me-1 fw-semibold align-middle"></i>';
                            $('#cx_presentase_terlambat').removeClass('text-success text-danger').addClass('text-success');
                        } else {
                            if (res.status == 'tetap') {
                                iconPrs = '<i class="ti ti-elbow-right me-1 fw-s                 emibold align-middle"></i>';
                                $('#cx_presentase_terlambat').removeClass('text-success text-danger').addClass('text-info');
                            }
                        }
                    }

                    if (waktuTerlambatBulanIni != '' || waktuTerlambatBulanIni != 0 || terlambatBulanIni != '' || terlambatBulanIni != 0) {
                        let clrCxTerlambat = '';
                        if (waktuTerlambatBulanIni == '00:00:00') {
                            clrCxTerlambat = 'primary';
                        } else {
                            clrCxTerlambat = 'danger';
                        }

                        let txCxTerlambat = '';
                        let clrCxTerlambatDis = '';
                        if (res.terlambat_bulan_ini == 0) {
                            clrCxTerlambatDis = 'success';
                            txCxTerlambat = 'DISIPLIN';
                        } else {
                            clrCxTerlambatDis = 'warning';
                            txCxTerlambat = terlambatBulanIni+'x';
                        }
                        $('#cx_total_terlambat_bulan_ini').empty().html(`<b class="link-${clrCxTerlambat} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Periode Perhitungan Bulan Ini = ${res.periode_sekarang.mulai} <i class='ri-contract-left-right-line'></i> ${res.periode_sekarang.sampai}">${waktuTerlambatBulanIni}</b> <b class="fs-18">(<b class="text-${clrCxTerlambatDis}">${txCxTerlambat}</b>)</b>`);
                    } else {
                        $('#cx_total_terlambat_bulan_ini').empty().html(`-`);
                    }

                    if (res.status != null || res.status != '' || res.status != 0) {
                        $('#cx_presentase_terlambat').empty().html(`${iconPrs} ${persentasePerubahan}&nbsp;<b class="text-muted">Dibandingkan dgn bulan kemarin</b>`);
                    } else {
                        $('#cx_presentase_terlambat').empty().html(``);
                    }

                // CARD 2
                    if (waktuTerlambatBulanLalu != '' || waktuTerlambatBulanLalu != 0 || terlambatBulanLalu != '' || terlambatBulanLalu != 0) {
                        let clrCxTerlambat = '';
                        if (waktuTerlambatBulanLalu == '00:00:00') {
                            clrCxTerlambat = 'primary';
                        } else {
                            clrCxTerlambat = 'danger';
                        }
                        $('#cx_total_terlambat_bulan_lalu').empty().html(`<b class="link-${clrCxTerlambat} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Periode Perhitungan Bln Lalu = ${res.periode_sebelumnya.mulai} <i class='ri-contract-left-right-line'></i> ${res.periode_sebelumnya.sampai}">${waktuTerlambatBulanLalu}</b> <b class="fs-18">(<b class="text-warning">${terlambatBulanLalu}x</b>)</b>`);
                    } else {
                        $('#cx_total_terlambat_bulan_lalu').empty().html(`-`);
                    }

                // CARD 3
                    if (res.total_waktu_lembur != '' || res.total_waktu_lembur != 0 || res.total_waktu_lembur != null) {
                        $('#cx_total_lembur_bulan_ini').empty().html(`${totalLembur}`);
                    } else {
                        $('#cx_total_lembur_bulan_ini').empty().html(`-`);
                    }

                // CARD 4
                    if (res.total_jam_bekerja != '' || res.total_jam_bekerja != 0 || res.total_jam_bekerja != null) {
                        $('#cx_total_kerja_bulan_ini').empty().html(`${totalJamBekerja}`);
                    } else {
                        $('#cx_total_kerja_bulan_ini').empty().html(`-`);
                    }
            },
            error: function (xhr) {
                iziToast.error({
                    title: "Pesan Galat!",
                    message: xhr.responseJSON?.message ?? "Terjadi kesalahan",
                    position: "topRight"
                });
            }, complete: function() {
                $('[data-bs-toggle="tooltip"]').tooltip({
                    trigger: 'hover'
                })

                setTimeout(function () {
                    autoScrollKeterangan();
                }, 200);
            }
        });
    }

    // FOR USER
    function totalCutiUnit() {
        $.ajax({
            url: "/api/v4/sdi/jadwaldinas/totalcutiunit",
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('#modalCutiUnit').modal('show');
                $('#tampil-cuti-unit').empty().html(`<center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>`);
            },
            success: function(res) {
                const tahunSekarang = {{ \Carbon\Carbon::now()->format('Y') }};
                const tahunSebelumnya = tahunSekarang - 1;
                let i = 0;

                let tampil = `<div class="table-responsive">
                    <table class="table table-hover table-bordered dt-responsive align-middle">
                        <thead>
                            <tr>
                                <th rowspan="2"><center>NO</center></th>
                                <th rowspan="2"><center>NAMA PEGAWAI</center></th>
                                <th colspan="2"><center>TAHUN ${tahunSebelumnya}</center></th>
                                <th colspan="2"><center>TAHUN ${tahunSekarang} <span class="badge rounded-pill text-bg-primary">SAAT INI</span></center></th>
                            </tr>
                            <tr>
                                <th><center>TOTAL CUTI <b class="text-primary">TERPAKAI</b></center></th>
                                <th><center>SISA CUTI <b class="text-danger">HANGUS</b></center></th>
                                <th><center>TOTAL CUTI <b class="text-primary">TERPAKAI</b></center></th>
                                <th><center>SISA CUTI <b class="text-danger">TERSEDIA</b></center></th>
                            </tr>
                        </thead>
                        <tbody>`;

                res.forEach(item => {

                    // property dinamis sesuai format API
                    const keyTotalNow = `total_cuti_${tahunSekarang}`;
                    const keySisaNow  = `sisa_cuti_${tahunSekarang}`;
                    const keyTotalPrev = `total_cuti_${tahunSebelumnya}`;
                    const keySisaPrev  = `sisa_cuti_${tahunSebelumnya}`;

                    tampil += `<tr>
                        <td><center>${++i}</center></td>
                        <td>${item.nama}</td>

                        <td><center><b class="text-primary">${item[keyTotalPrev]}x</b></center></td>
                        <td><center><b class="text-danger">${item[keySisaPrev]}x</b></center></td>

                        <td><center><b class="text-primary">${item[keyTotalNow]}x</b></center></td>
                        <td><center><b class="text-danger">${item[keySisaNow]}x</b></center></td>
                    </tr>`;
                });

                tampil += `</tbody></table></div>`;
                $('#tampil-cuti-unit').empty().html(tampil);
            }, error: function(err) {
                $('#modalCutiUnit').modal('hide');
                Swal.fire({
                    title: err.statusText + " (Code " + err.status + ")",
                    html: err.responseText,
                    icon: "error",
                    showConfirmButton: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                });
            }, complete: function() {

            }
        });
    }

    // FOR ADMIN
    function totalCutiAllUnit() {
        $.ajax({
            url: "/api/v4/sdi/jadwaldinas/totalcutiunit",
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('#modalCutiUnit').modal('show');
                $('#tampil-cuti-unit').empty().html(`<center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>`);
            },
            success: function(res) {
                const tahunSekarang = {{ \Carbon\Carbon::now()->format('Y') }};
                const tahunSebelumnya = tahunSekarang - 1;
                let i = 0;

                $('#dttable-cutiunit').DataTable().clear().destroy();

                let tampil = `<div class="table-responsive">
                    <table class="table table-hover table-bordered dt-responsive align-middle" id="dttable-cutiunit">
                        <thead>
                            <tr>
                                <th rowspan="2"><center>NO</center></th>
                                <th rowspan="2"><center>NAMA PEGAWAI</center></th>
                                <th rowspan="2"><center>UNIT</center></th>
                                <th colspan="2"><center>TAHUN ${tahunSebelumnya}</center></th>
                                <th colspan="2"><center>TAHUN ${tahunSekarang} <span class="badge rounded-pill text-bg-primary">SAAT INI</span></center></th>
                            </tr>
                            <tr>
                                <th><center>TOTAL CUTI <b class="text-primary">TERPAKAI</b></center></th>
                                <th><center>SISA CUTI <b class="text-danger">HANGUS</b></center></th>
                                <th><center>TOTAL CUTI <b class="text-primary">TERPAKAI</b></center></th>
                                <th><center>SISA CUTI <b class="text-danger">TERSEDIA</b></center></th>
                            </tr>
                        </thead>
                        <tbody>`;

                res.forEach(item => {

                    // property dinamis sesuai format API
                    const keyTotalNow = `total_cuti_${tahunSekarang}`;
                    const keySisaNow  = `sisa_cuti_${tahunSekarang}`;
                    const keyTotalPrev = `total_cuti_${tahunSebelumnya}`;
                    const keySisaPrev  = `sisa_cuti_${tahunSebelumnya}`;

                    tampil += `<tr>
                        <td><center>${++i}</center></td>
                        <td>${item.nama}</td>
                        <td><center>${item.unit}</center></td>

                        <td><center><b class="text-primary">${item[keyTotalPrev]}x</b></center></td>
                        <td><center><b class="text-danger">${item[keySisaPrev]}x</b></center></td>

                        <td><center><b class="text-primary">${item[keyTotalNow]}x</b></center></td>
                        <td><center><b class="text-danger">${item[keySisaNow]}x</b></center></td>
                    </tr>`;
                });

                tampil += `</tbody></table></div>`;
                $('#tampil-cuti-unit').empty().html(tampil);

                // INIT DTTABLE
                var table = $('#dttable-cutiunit').DataTable({
                    order: [
                        [2, "asc"]
                    ],
                    bAutoWidth: false,
                    aoColumns : [
                        { sWidth: '5%'  },  // NO
                        { sWidth: '25%' },  // NAMA
                        { sWidth: '10%' },  // UNIT
                        { sWidth: '10%' },  // TOTAL prev
                        { sWidth: '10%' },  // SISA prev
                        { sWidth: '10%' },  // TOTAL now
                        { sWidth: '10%' },  // SISA now
                    ],
                    columnDefs: [
                        // { visible: false, targets: [7] },
                    ],
                    displayLength: 50,
                });
            }, error: function(err) {
                $('#modalCutiUnit').modal('hide');
                Swal.fire({
                    title: err.statusText + " (Code " + err.status + ")",
                    html: err.responseText,
                    icon: "error",
                    showConfirmButton: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                });
            }, complete: function() {

            }
        });
    }

    function autoScrollKeterangan() {

        const $wrapper = $('#scrollKeteranganGrafik .simplebar-content-wrapper');

        if (!$wrapper.length) return;

        const wrapper = $wrapper[0];

        const maxScroll = wrapper.scrollHeight - wrapper.clientHeight;

        if (maxScroll <= 0) return;

        $wrapper.stop(true, true);

        if (autoScrollTimer) {
            clearTimeout(autoScrollTimer);
            autoScrollTimer = null;
        }

        let paused = false;

        $('#scrollKeteranganGrafik')
            .off('.autoScroll')
            .on('mouseenter.autoScroll', function () {
                paused = true;
                $wrapper.stop(true);
            })
            .on('mouseleave.autoScroll', function () {
                if (!paused) return;
                paused = false;
                loop();
            });

        function loop() {

            if (paused) return;

            // Mulai dari atas
            wrapper.scrollTop = 0;

            $wrapper.animate({
                scrollTop: maxScroll
            }, 8000, 'linear', function () {

                if (paused) return;

                // Diam 5 detik di bawah
                autoScrollTimer = setTimeout(function () {

                    // Langsung kembali ke atas
                    wrapper.scrollTop = 0;

                    // Ulang lagi
                    loop();

                }, 5000);

            });
        }

        loop();
    }

</script>
