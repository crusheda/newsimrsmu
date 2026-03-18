@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Elektronik <b class="text-primary link-underline-primary text-decoration-underline">Pengadaan</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Administrasi</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        E-Pengadaan
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card custom-card dashboard-main-card primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="fw-semibold">Rp ...</h5>
                                <span class="d-block fs-12 text-muted">Total Belanja <span class="ms-1 badge bg-primary-transparent">Tahun Ini</span></span>
                            </div>
                            <div>
                                <span class="avatar avatar-lg bg-primary-transparent svg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 22h14a2 2 0 0 0 2-2V9a1 1 0 0 0-1-1h-3v-.777c0-2.609-1.903-4.945-4.5-5.198A5.005 5.005 0 0 0 7 7v1H4a1 1 0 0 0-1 1v11a2 2 0 0 0 2 2zm12-12v2h-2v-2h2zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v1H9V7zm-2 3h2v2H7v-2z"></path></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card custom-card dashboard-main-card secondary">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="fw-semibold">Rp ...</h5>
                                <span class="d-block fs-12 text-muted">Total Belanja <span class="ms-1 badge bg-secondary-transparent">Tahun Lalu</span></span>
                            </div>
                            <div>
                                <span class="avatar avatar-lg bg-secondary-transparent svg-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921z"></path><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="17.5" cy="19.5" r="1.5"></circle></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <div class="card-title">
                            Grafik <b class="text-secondary">Interaktif</b>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Menu Grafik</button>
                                <ul class="dropdown-menu p-2">
                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="grafikPengadaan(1)">Grafik Anda</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="grafikPengadaan(0)">Grafik Internal RS</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row sales-stats mb-3 text-center align-items-center justify-content-center">
                            <div class="col">
                                <div>Total Pengadaan Bulan Ini</div>
                                <div class="d-flex justify-content-center gap-2">
                                    <a id="bulan-ini-total" class="fs-16 fw-semibold">Rp ...</a>
                                </div>
                            </div>
                            <div class="col">
                                <div>Total Pengadaan Bulan Lalu</div>
                                <div class="d-flex justify-content-center gap-1">
                                    <a id="bulan-lalu-total" class="fs-16 fw-semibold">Rp ...</a>
                                </div>
                            </div>
                            <div class="col">
                                <div>Persentase Selisih</div>
                                <div id="persen-wrapper"><i class="ti ti-rotate-clockwise-2 text-secondary ti-spin-slow fs-20"></i></div>
                            </div>
                        </div>
                        <div id="grafik-pengadaan"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <div class="btn-group">
                            <button class="btn btn-primary btn-shadow" data-bs-toggle="modal" data-bs-target="#tambah">
                                <i class="ri-git-repository-commits-line me-1"></i> Upload Berkas
                            </button>
                            <button class="btn btn-warning btn-shadow" onclick="refresh()" id="btn-refresh" disabled>
                                <i class="ri-loop-left-line nav-icon"></i></button>
                        </div>
                        <button class="btn btn-info btn-shadow" id="btn-verif" onclick="verif()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Menampilkan Semua Data Laporan Rutin Bawahan">
                            <i class="ri-file-check-line me-1"></i> <span class="align-middle">Verifikasi Laporan Bawahan</span>
                        </button>
                    </div>
                    <div class="card-body">

                        {{-- MY CONTENT --}}

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // const options2 = {
        //     series: [{
        //         name: 'Profit',
        //         data: [99, 15, 36, 63, 42, 120, 78, 51, 32, 62, 76, 32],
        //         type: 'bar',
        //     }, {
        //         name: 'Sales',
        //         data: [136, 150, 158, 115, 102, 156, 135, 151, 125, 68, 164, 163],
        //         type: 'area',
        //     }, {
        //         name: 'Revenue',
        //         data: [128, 148, 39, 152, 169, 129, 112, 148, 150, 117, 198, 120],
        //         type: 'line',
        //     }],
        //     chart: {
        //         height: 320,
        //         type: 'line',
        //         toolbar: {
        //             show: false,
        //         },
        //         background: 'none',
        //         fill: "#fff",
        //     },
        //     plotOptions: {
        //         bar: {
        //             borderRadius: 2,
        //             columnWidth: '30%',
        //         }
        //     },
        //     grid: {
        //         borderColor: "#f1f1f1",
        //         strokeDashArray: 2,
        //         xaxis: {
        //             lines: {
        //                 show: true
        //             }
        //         },
        //         yaxis: {
        //             lines: {
        //                 show: false
        //             }
        //         }
        //     },
        //     colors: ["var(--primary-color)", "rgb(255, 73, 205)", "var(--primary03)"],
        //     background: 'transparent',
        //     dataLabels: {
        //         enabled: false
        //     },
        //     stroke: {
        //         curve: 'smooth',
        //         width: [2, 1.5, 2],
        //         dashArray: [0, 0, 6]
        //     },
        //     legend: {
        //         show: true,
        //         position: 'top',
        //         markers: {
        //             width: 8,
        //             height: 8,
        //         }
        //     },
        //     xaxis: {
        //         categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        //         show: false,
        //         axisBorder: {
        //             show: false,
        //             color: 'rgba(119, 119, 142, 0.05)',
        //             offsetX: 0,
        //             offsetY: 0,
        //         },
        //         axisTicks: {
        //             show: false,
        //             borderType: 'solid',
        //             color: 'rgba(119, 119, 142, 0.05)',
        //             width: 6,
        //             offsetX: 0,
        //             offsetY: 0
        //         },
        //         labels: {
        //             rotate: -90,
        //         }
        //     },
        //     fill: {
        //         type: ['solid', 'gradient', 'solid'],
        //         gradient: {
        //             shadeIntensity: 1,
        //             opacityFrom: 0.4,
        //             opacityTo: 0.1,
        //             stops: [0, 90, 100],
        //             colorStops: [
        //                 [
        //                     {
        //                         offset: 0,
        //                         color: "var(--primary-color)",
        //                         opacity: 1
        //                     },
        //                     {
        //                         offset: 75,
        //                         color: "var(--primary-color)",
        //                         opacity: 1
        //                     },
        //                     {
        //                         offset: 100,
        //                         color: 'var(--primary-color)',
        //                         opacity: 1
        //                     }
        //                 ],
        //                 [
        //                     {
        //                         offset: 0,
        //                         color: "rgba(255, 73, 205, 0.1)",
        //                         opacity: 0.1
        //                     },
        //                     {
        //                         offset: 75,
        //                         color: "rgba(255, 73, 205, 0.1)",
        //                         opacity: 1
        //                     },
        //                     {
        //                         offset: 100,
        //                         color: 'rgba(255, 73, 205, 0.2)',
        //                         opacity: 1
        //                     }
        //                 ],
        //                 [
        //                     {
        //                         offset: 0,
        //                         color: 'var(--primary03)',
        //                         opacity: 1
        //                     },
        //                     {
        //                         offset: 75,
        //                         color: 'var(--primary03)',
        //                         opacity: 0.1
        //                     },
        //                     {
        //                         offset: 100,
        //                         color: 'var(--primary03)',
        //                         opacity: 1
        //                     }
        //                 ],
        //             ]
        //         }
        //     },
        //     yaxis: {
        //         show: false,
        //         axisBorder: {
        //             show: false,
        //         },
        //         axisTicks: {
        //             show: false,
        //         }
        //     },
        //     tooltip: {
        //         x: {
        //             format: 'dd/MM/yy HH:mm'
        //         },
        //     },
        // };
        let chartPengadaan = null;

        $(document).ready(function() {
            grafikPengadaan(1);
        });

        function formatRupiah(angka){
            return "Rp " + Number(angka).toLocaleString('id-ID');
        }

        function formatRupiahShort(val){
            if(val >= 1000000000){
                return 'Rp ' + (val/1000000000).toFixed(1) + ' M';
            } else if(val >= 1000000){
                return 'Rp ' + (val/1000000).toFixed(1) + ' Jt';
            }
            return formatRupiah(val);
        }

        function namaBulan(index){
            const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            return bulan[index-1];
        }

        function grafikPengadaan(num) { // num 0 = RS ; 1 = OWN
            $.ajax({
                url: `/api/v4/administrasi/pengadaan/grafik-pengadaan/${num}`,
                type: 'GET',
                success: function(res){

                    let now = new Date();
                    let bulanIni = now.getMonth() + 1;
                    let bulanLalu = bulanIni - 1 || 12;

                    // 👉 set nilai
                    $('#bulan-lalu-total').empty().html(formatRupiah(res.bulan_lalu) + ` <span class="ms-1 fs-12 badge bg-secondary-transparent">${namaBulan(bulanLalu)}</span>`);
                    $('#bulan-ini-total').empty().html(formatRupiah(res.bulan_ini) + ` <span class="ms-1 fs-12 badge bg-primary-transparent">${namaBulan(bulanIni)}</span>`);

                    // 👉 persen
                    let persen = res.persen;
                    let isNaik = persen >= 0;

                    let html = `
                        <span class="${isNaik ? 'text-success' : 'text-danger'}">
                            <i class="ti ${isNaik ? 'ti-arrow-narrow-up' : 'ti-arrow-narrow-down'} align-middle fs-20"></i>
                            <span class="fs-12 badge ${isNaik ? 'bg-success' : 'bg-danger'}-transparent">
                                ${Math.abs(persen)}%
                            </span>
                        </span>
                    `;

                    $('#persen-wrapper').empty().html(html);

                    // =====================
                    // CHART (punyamu tadi)
                    // =====================

                    const options = {
                        series: [
                            {
                                name: `Tahun Ini (${new Date().getFullYear()})`,
                                data: res.tahun_ini,
                                // type: 'area'
                            },
                            {
                                name: `Tahun Lalu (${new Date().getFullYear() - 1})`,
                                data: res.tahun_lalu,
                                // type: 'line'
                            },
                            {
                                name: `Dua Tahun Lalu (${new Date().getFullYear() - 2})`,
                                data: res.dua_tahun_lalu,
                                // type: 'line'
                            }
                        ],
                        colors: ['#985ffd', '#ff49cd', '#fdaf22'],
                        chart: {
                            height: 320,
                            type: 'area',
                            // stacked: true,
                            toolbar: {
                                show: true,
                                tools: {
                                    download: true, // ini tombol export
                                    selection: false,
                                    zoom: false,
                                    zoomin: false,
                                    zoomout: false,
                                    pan: false,
                                    reset: false
                                }
                            }
                        },
                        stroke: {
                            curve: 'smooth',
                            // width: [2, 2, 2],
                            // dashArray: [0, 5, 8]
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                opacityFrom: 0.2,
                                opacityTo: 0.6,
                            }
                        },
                        grid: {
                            borderColor: '#f2f5f7',
                        },
                        legend: {
                            position: 'bottom',
                            horizontalAlign: 'center',
                            offsetX: -10
                        },
                        xaxis: {
                            categories: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']
                        },
                        // yaxis: {
                        //     labels: {
                        //         show: false
                        //     }
                        // },
                        yaxis: {
                            labels: {
                                formatter: function(val){
                                    return formatRupiah(val);
                                }
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function(val){
                                    return formatRupiah(val);
                                }
                            }
                        },
                        dataLabels: {
                            enabled: false,
                            formatter: function(val){
                                return formatRupiah(val);
                            }
                        }
                    };

                    if(chartPengadaan){
                        chartPengadaan.destroy();
                    }

                    chartPengadaan = new ApexCharts(document.querySelector("#grafik-pengadaan"), options);
                    chartPengadaan.render();
                }
            });
        }
    </script>
@endsection
