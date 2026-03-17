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
                                <h5 class="fw-semibold">$43,038.00</h5>
                                <span class="d-block fs-12 text-muted">Total Sales</span>
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
                                <h5 class="fw-semibold">$28,346.00</h5>
                                <span class="d-block fs-12 text-muted">Total Expenses</span>
                            </div>
                            <div>
                                <span class="avatar avatar-lg bg-secondary-transparent svg-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 12v6a1 1 0 0 1-2 0V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v14c0 1.654 1.346 3 3 3h14c1.654 0 3-1.346 3-3v-6h-2zm-6-1v2H6v-2h8zM6 9V7h8v2H6zm8 6v2h-3v-2h3z"></path></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card custom-card dashboard-main-card warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="fw-semibold">1,29,368</h5>
                                <span class="d-block fs-12 text-muted">Total Visitors</span>
                            </div>
                            <div>
                                <span class="avatar avatar-lg bg-warning-transparent svg-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z"></path></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card custom-card dashboard-main-card success">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="fw-semibold">35,367</h5>
                                <span class="d-block fs-12 text-muted">Total Orders</span>
                            </div>
                            <div>
                                <span class="avatar avatar-lg bg-success-transparent svg-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921z"></path><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="17.5" cy="19.5" r="1.5"></circle></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Sales Statistics
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row sales-stats mb-3">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div>Bulan Lalu</div>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="fs-16 fw-semibold">3,542</span>
                                    <span class="text-success"><i class="ti ti-arrow-narrow-up align-middle"></i>
                                    <span class="badge bg-success-transparent">0.9%</span></span>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div>Bulan Ini</div>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="fs-16 fw-semibold">$52,38,346</span>
                                    <span class="text-success"><i class="ti ti-arrow-narrow-up align-middle"></i>
                                    <span class="badge bg-success-transparent">0.39%</span></span>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div>Persentase</div>
                                <div class="mb-0">
                                    <span class="fs-16 fw-semibold text-secondary">33.7%</span>
                                    <span class="text-success"><i class="ti ti-arrow-narrow-up align-middle"></i>
                                        <span class="badge bg-success-transparent">0.5%</span>
                                    </span>
                                </div>
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
        const options2 = {
            series: [{
                name: 'Profit',
                data: [99, 15, 36, 63, 42, 120, 78, 51, 32, 62, 76, 32],
                type: 'bar',
            }, {
                name: 'Sales',
                data: [136, 150, 158, 115, 102, 156, 135, 151, 125, 68, 164, 163],
                type: 'area',
            }, {
                name: 'Revenue',
                data: [128, 148, 39, 152, 169, 129, 112, 148, 150, 117, 198, 120],
                type: 'line',
            }],
            chart: {
                height: 320,
                type: 'line',
                toolbar: {
                    show: false,
                },
                background: 'none',
                fill: "#fff",
            },
            plotOptions: {
                bar: {
                    borderRadius: 2,
                    columnWidth: '30%',
                }
            },
            grid: {
                borderColor: "#f1f1f1",
                strokeDashArray: 2,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                }
            },
            colors: ["var(--primary-color)", "rgb(255, 73, 205)", "var(--primary03)"],
            background: 'transparent',
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: [2, 1.5, 2],
                dashArray: [0, 0, 6]
            },
            legend: {
                show: true,
                position: 'top',
                markers: {
                    width: 8,
                    height: 8,
                }
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                show: false,
                axisBorder: {
                    show: false,
                    color: 'rgba(119, 119, 142, 0.05)',
                    offsetX: 0,
                    offsetY: 0,
                },
                axisTicks: {
                    show: false,
                    borderType: 'solid',
                    color: 'rgba(119, 119, 142, 0.05)',
                    width: 6,
                    offsetX: 0,
                    offsetY: 0
                },
                labels: {
                    rotate: -90,
                }
            },
            fill: {
                type: ['solid', 'gradient', 'solid'],
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                    stops: [0, 90, 100],
                    colorStops: [
                        [
                            {
                                offset: 0,
                                color: "var(--primary-color)",
                                opacity: 1
                            },
                            {
                                offset: 75,
                                color: "var(--primary-color)",
                                opacity: 1
                            },
                            {
                                offset: 100,
                                color: 'var(--primary-color)',
                                opacity: 1
                            }
                        ],
                        [
                            {
                                offset: 0,
                                color: "rgba(255, 73, 205, 0.1)",
                                opacity: 0.1
                            },
                            {
                                offset: 75,
                                color: "rgba(255, 73, 205, 0.1)",
                                opacity: 1
                            },
                            {
                                offset: 100,
                                color: 'rgba(255, 73, 205, 0.2)',
                                opacity: 1
                            }
                        ],
                        [
                            {
                                offset: 0,
                                color: 'var(--primary03)',
                                opacity: 1
                            },
                            {
                                offset: 75,
                                color: 'var(--primary03)',
                                opacity: 0.1
                            },
                            {
                                offset: 100,
                                color: 'var(--primary03)',
                                opacity: 1
                            }
                        ],
                    ]
                }
            },
            yaxis: {
                show: false,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                }
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };

        $(document).ready(function() {
            grafikPengadaan();
        });

        function grafikPengadaan() {
            $.ajax({
                url: '/api/v4/administrasi/pengadaan/grafik-pengadaan',
                type: 'GET',
                success: function(res){

                    const options = {
                        series: [
                            {
                                name: 'Tahun Ini',
                                data: res.tahun_ini,
                                type: 'area'
                            },
                            {
                                name: 'Tahun Lalu',
                                data: res.tahun_lalu,
                                type: 'line'
                            }
                        ],
                        chart: {
                            height: 320,
                            type: 'line',
                            toolbar: { show: false }
                        },
                        stroke: {
                            curve: 'smooth',
                            width: [2, 2],
                            dashArray: [0, 5]
                        },
                        colors: ["#00bcd4", "#ff9800"],
                        xaxis: {
                            categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
                        },
                        dataLabels: {
                            enabled: false
                        },
                        fill: {
                            type: ['gradient', 'solid'],
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.4,
                                opacityTo: 0.1,
                                stops: [0, 90, 100]
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function(val){
                                    return "Rp " + val.toLocaleString('id-ID');
                                }
                            }
                        }
                    };

                    const chart = new ApexCharts(document.querySelector("#grafik-pengadaan"), options);
                    chart.render();
                }
            });
        }
    </script>
@endsection
