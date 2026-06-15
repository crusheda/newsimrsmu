<div class="col-xl-6 mb-3">
    <div class="card shadow-none border mb-0">
        <div class="card-body p-3">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="">Total <b class="text-teal">Cuti Tahunan</b> Anda di <b class="text-info">Tahun {{ \Carbon\Carbon::now()->format('Y') }}</b></h6>
                @can('admin_kepegawaian')
                    <button class="btn btn-success-transparent btn-sm" onclick="totalCutiAllUnit()"><i class="fas fa-suitcase-rolling me-1"></i> Lihat Cuti Tahunan <span class="badge bg-danger ms-1">Semua Unit</span></button>
                @else
                    <button class="btn btn-teal-transparent btn-sm" onclick="totalCutiUnit()"><i class="fas fa-suitcase-rolling me-1"></i> Lihat Cuti Tahunan Unit</button>
                @endcan
            </div>
            <div class="progress progress-sm progress-custom progress-animate cuti-progress mt-5 mb-2 ms-2"
                role="progressbar"
                aria-valuenow="0"
                aria-valuemin="0"
                aria-valuemax="100">

                {{-- <h6 class="progress-bar-title"><i class="ri-umbrella-line"></i></h6> --}}

                <div class="progress-bar" style="width: 0%">
                    <div class="progress-bar-value"><i class="ri-loader-2-line ri-spin"></i></div>
                </div>

                <!-- indikator angka -->
                <div class="cuti-indicator"
                    style="position:absolute; top:-20px; left:0%; transform:translateX(-50%); font-size:12px;">
                </div>

                <!-- over limit -->
                <span class="cuti-over badge bg-danger"
                    style="position:absolute; top:-25px; right:10px; display:none;">
                </span>

            </div>
        </div>
    </div>
</div>
<div class="col-xl-12 mb-3">
    <div class="card shadow-none-border mb-0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="">
        <div class="card-body">
            <center><h6>Total Absensi <b class="text-danger">6 Bulan Terakhir</b> Anda</h6></center>
            <div id="area-stacked"><b class="text-dark"><center><i class="ri-refresh-line ri-spin me-1"></i> Memuat Grafik...</center></b></div>
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
    $(document).ready(function() {
        totalCuti();
        // graphTotalAbsensi(1); // periode aktif 21→20 (sekarang)
        // graphTotalAbsensi(0); // periode sebelumnya 21→20
        grafikAbsensi();
    })

    function graphTotalAbsensi(range) {
        $.ajax({
            url: "/api/v4/sdi/jadwaldinas/totalabsensi/" + range,
            type: "GET",
            dataType: "json",
            success: function(res) {

                if (range == 1) {
                    colorGrafik = "#2563EB"; // biru
                    colorBackGrafik = "#2563EB30"; // biru muda
                } else {
                    colorGrafik = "#DC2626"; // merah
                    colorBackGrafik = "#fce9e9"; // merah muda
                }

                let totalAbsensi = Number(res.total_absensi) || 0;
                let totalHariKerja = Number(res.total_hari_kerja) || 0;

                let persen = totalHariKerja > 0
                    ? Math.round((totalAbsensi / totalHariKerja) * 100)
                    : 0;

                let options = {
                    series: [persen],
                    chart: {
                        height: 115,
                        type: "radialBar"
                    },
                    plotOptions: {
                        radialBar: {
                            hollow: {
                                margin: 0,
                                size: "60%",
                                background: "transparent"
                            },
                            track: {
                                background: colorBackGrafik,
                                strokeWidth: "100%"
                            },
                            dataLabels: {
                                show: true,
                                name: { show: false },
                                value: {
                                    formatter: function () {
                                        return totalAbsensi + "x / " + totalHariKerja + "hr"; // teks tengah
                                    },
                                    offsetY: 7,
                                    color: colorGrafik,
                                    fontSize: "12px",
                                    fontWeight: "700",
                                    show: true
                                }
                            }
                        }
                    },
                    colors: [colorGrafik],
                    fill: { type: "solid" },
                    stroke: { lineCap: "round" },
                    tooltip: {
                        enabled: true,
                        y: {
                            formatter: function () {
                                return persen + "% (Total Absensi " + totalAbsensi + "x / Total Hari Kerja " + totalHariKerja + "hr)";
                            }
                        }
                    }
                };

                new ApexCharts(
                    document.querySelector("#grafikTotalAbsensi"+range),
                    options
                ).render();

                // tampilkan bulan dan tahun
                $('#dateGrafikTotalAbsensi'+range).text(
                    formatTanggalIndo(res.start) + ' - ' + formatTanggalIndo(res.end)
                );
            },

            error: function(err) {
                console.error("Gagal load grafik absensi", err);
            }
        });
    }

    function totalCuti() {
        $.ajax({
            url: "/api/v4/sdi/jadwaldinas/totalcuti",
            type: 'GET',
            dataType: 'json',
            success: function(res) {

                var totalReal = parseInt(res);
                var maxCuti   = 12;

                var progressValue = Math.min(totalReal, maxCuti);
                var percent = (progressValue / maxCuti) * 100;

                var $container = $('.cuti-progress');
                var $bar       = $container.find('.progress-bar');
                var $value     = $container.find('.progress-bar-value');
                var $indicator = $container.find('.cuti-indicator');
                var $over      = $container.find('.cuti-over');

                // reset dulu
                $bar.removeClass('bg-danger').css('width', '0%');
                $value.text('0%');
                // $indicator.text('0x').css('left', '0%');
                $over.hide();

                // animasi delay biar smooth
                setTimeout(function() {

                    // animasi width
                    $bar.css({
                        'width': percent + '%',
                        'transition': 'width 1s ease'
                    });

                    // animasi angka persen (opsional naik bertahap)
                    let current = 0;
                    let interval = setInterval(function() {
                        if (current >= totalReal) {
                            clearInterval(interval);
                        } else {
                            current++;
                            $value.text(totalReal + ' x');
                        }
                    }, 200);

                    // indikator jumlah cuti REAL
                    // $indicator
                    //     .text(totalReal + 'x')
                    //     .css({
                    //         'left': percent + '%',
                    //         'transition': 'left 1s ease'
                    //     });

                    // over limit
                    var over = totalReal - maxCuti;

                    if (over > 0) {
                        $bar.addClass('bg-danger');

                        $over
                            .text('Over +' + over)
                            .fadeIn();
                    }

                }, 100);

            },
            error: function(err) {
                Swal.fire({
                    title: err.statusText + " (Code " + err.status + ")",
                    html: err.responseText,
                    icon: "error",
                    showConfirmButton: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                });
            }
        });
    }

    function grafikAbsensi() {
        $.ajax({
            url: "/api/v4/sdi/jadwaldinas/grafikabsensi",
            type: "GET",
            dataType: "json",
            beforeSend: function() {
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
                        { name: "Belum Pulang", data: belumPulang },
                        { name: "Cuti", data: cuti },
                        { name: "Libur", data: libur },
                        { name: "Mangkir", data: mangkir },
                        { name: "Sisa Hari Kerja", data: sisa },
                    ],

                    chart: {
                        type: "area",
                        height: 380,
                        stacked: true,
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
</script>
