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
                                <h5 class="fw-semibold" id="totTahunIni">Rp ...</h5>
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
                                <h5 class="fw-semibold" id="totTahunLalu">Rp ...</h5>
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
                            Grafik <b class="text-secondary">Interaktif</b> <b class="text-primary" id="statGraph">Anda</b>
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
                            <button class="btn btn-secondary btn-shadow"  data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-html="true" title="Lihat Riwayat Pengadaan">
                                <i class="ri-shopping-bag-line me-1"></i> Riwayat
                            </button>
                            <button class="btn btn-warning btn-shadow" onclick="applyFilters()" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-html="true" title="Refresh Tabel Pengadaan">
                                <i class="ri-loop-left-line nav-icon"></i>
                            </button>
                        </div>
                        <button class="btn btn-primary btn-shadow" onclick="keranjang()" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" data-bs-html="true" title="Buka Keranjang Pengadaan">
                            <i class="ri-shopping-cart-2-line me-1"></i> Keranjang
                        </button>
                    </div>
                    <div class="card-header justify-content-between border-bottom-0">
                        <!-- Search Bar -->
                        <div class="w-sm-25">
                            <input class="form-control" type="search" id="search-input"
                                placeholder="Cari nama barang ..." aria-label="search-product">
                        </div>

                        <!-- Filters Section -->
                        <div class="row gy-2 w-sm-50">
                            <!-- Category Filter -->
                            <div class="col">
                                <select id="category-filter" class="form-control">
                                    <option value="" hidden>Jenis Barang</option>
                                    <option value="all">Semua</option>
                                    <option value="ATK">ATK</option>
                                    <option value="CETAK">CETAK</option>
                                    <option value="BHP">BHP</option>
                                </select>
                            </div>

                            <!-- Status Filter -->
                            <div class="col">
                                <select id="harga-filter" class="form-control">
                                    <option value="" hidden>Rentang Harga</option>
                                    <option value="all">Semua</option>
                                    <option value="lt500"> < 500 Ribu</option>
                                    <option value="500_1jt">500 Ribu - 1 Juta</option>
                                    <option value="1_10jt">1 Juta - 10 Juta</option>
                                    <option value="gt10jt"> > 10 Juta</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="product-table" class="grid-card-table"><center><i class="fas fa-sync fa-spin nav-icon me-1"></i> Memuat Tabel Pengadaan</center></div>
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
        let allData = [];
        let grid = null;
        let debounceTimer;

        function debounce(func, delay){
            return function(...args){
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    func.apply(this, args);
                }, delay);
            };
        }

        $(document).ready(function() {
            initGrid();

            $('#search-input').on('keyup', debounce(function(){
                applyFilters();
            }, 500)); // delay 500ms
            $('#category-filter').on('change', applyFilters);
            $('#harga-filter').on('change', applyFilters);

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
                    $('#totTahunIni').text(formatRupiah(res.total_tahun_ini));
                    $('#totTahunLalu').text(formatRupiah(res.total_tahun_lalu));
                    if (num == 1) {
                        $('#statGraph').text('Anda');
                    } else {
                        $('#statGraph').text('Rumah Sakit');
                    }

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

        // function loadData(){

        //     $.get('/api/v4/administrasi/pengadaan/barang', function(res){

        //         console.log('DATA API:', res);

        //         // ✅ ambil dari res.data
        //         allData = res.data.map(item => ([
        //             item.id,
        //             item.nama,
        //             item.jenis,
        //             item.satuan,
        //             item.harga,
        //             formatRupiah(item.harga),
        //             item.user ?? '-',
        //             new Date(item.created_at).toLocaleDateString('id-ID')
        //         ]));

        //         console.log('DATA GRID:', allData);

        //         initGrid(allData);
        //     });
        // }

        // function initGridOld(data){

        //     if(grid){
        //         grid.destroy();
        //     }

        //     grid = new gridjs.Grid({
        //         columns: [
        //             'ID',
        //             'Nama Barang',
        //             'Jenis',
        //             'Satuan',
        //             {
        //                 name: 'Harga',
        //                 formatter: (_, row) => {
        //                     return gridjs.html(`<b>${row.cells[5] ? row.cells[5].data : '-'}</b>`);
        //                 }
        //             },
        //             'User',
        //             'Tanggal'
        //         ],
        //         data: data,
        //         pagination: true,
        //         sort: true,
        //         search: false
        //     }).render(document.getElementById("product-table"));
        // }

        function mapData(item){
            return [
                item.id,
                item,
                // item.nama,
                // item.filename ?? '',
                // item.jenis ?? '-',
                // item.satuan ?? '-',
                item.harga ?? 0,
                moment(item.created_at).format('YYYY-MM-DD HH:mm:ss')
            ];
        }

        function initGrid(){

            if(grid){
                document.getElementById("product-table").innerHTML = "";
            }

            $('#product-table').empty();

            grid = new gridjs.Grid({
                columns: [
                    {
                        name: 'ID',
                        width: '80px',
                        formatter: (_, row) => row.cells[0].data
                    },

                    {
                        name: 'Nama Barang',
                        // width: '300px',
                        formatter: (_, row) => {

                            let item = row.cells[1].data;

                            let img = item.filename
                                ? '/' + item.filename.replace('public/', 'storage/')
                                : '/images/no-image.png';

                            return gridjs.html(`
                                <div class="d-flex align-items-center gap-3">
                                    <span class="avatar avatar-lg bg-light">
                                        <img src="${img}"
                                            onerror="this.src='/images/no-image.png'"
                                            style="object-fit:cover;width:100%;height:100%;">
                                    </span>

                                    <div>
                                        <div class="fw-semibold">${item.nama}</div>
                                        <div class="text-muted fs-13">
                                            ${item.jenis ?? '-'} • ${item.satuan ?? '-'}
                                        </div>
                                    </div>
                                </div>
                            `);
                        }
                    },

                    // {
                    //     name: 'Jenis',
                    //     width: '120px',
                    //     formatter: (_, row) => row.cells[3].data
                    // },

                    // {
                    //     name: 'Satuan',
                    //     width: '100px',
                    //     formatter: (_, row) => row.cells[4].data
                    // },

                    {
                        name: 'Harga',
                        width: '150px',
                        formatter: (_, row) => gridjs.html(`<b>${formatRupiah(row.cells[2].data)}</b>`)
                    },

                    {
                        name: 'Diperbarui',
                        width: '120px',
                        formatter: (_, row) => row.cells[3].data
                    },

                    {
                        id: 'actions',
                        name: 'Aksi',
                        width: '120px',
                        className: {
                            th: 'text-center',
                            td: 'text-center'
                        },
                        // attributes: {
                        //     th: { class: 'text-center' },
                        //     td: { class: 'text-center' }
                        // },
                        formatter: (_, row) => gridjs.html(`
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-success"
                                    onclick="tambahKeranjang(${row.cells[0].data})">
                                    <i class="ri-add-box-line me-1"></i> Tambah
                                </button>
                            </div>
                        `)
                    }
                ],

                server: {
                    url: '/api/v4/administrasi/pengadaan/barang',
                    then: data => data.data.map(mapData),
                    total: data => data.total
                },

                pagination: {
                    enabled: true,
                    limit: 10,
                    server: {
                        url: (prev, page, limit) => {
                            const separator = prev.includes('?') ? '&' : '?';
                            return `${prev}${separator}page=${page+1}&limit=${limit}`;
                        }
                    }
                },

                sort: false
            }).render(document.getElementById("product-table"));
        }

        function applyFilters(){

            const search = $('#search-input').val();
            const jenis = $('#category-filter').val();
            const harga = $('#harga-filter').val();

            const params = new URLSearchParams();

            if(search) params.append('search', search);
            if(jenis) params.append('jenis', jenis);
            if(harga) params.append('harga', harga);

            let url = '/api/v4/administrasi/pengadaan/barang?' + params.toString();

            grid.updateConfig({
                server: {
                    url: url,
                    then: data => data.data.map(mapData),
                    total: data => data.total
                }
            }).forceRender();
        }

        function tambahKeranjang(id){
            console.log('Tambah ke keranjang:', id);

            // contoh ajax
            // $.post('/api/v4/pengadaan/cart', {
            //     id_barang: id,
            //     _token: $('meta[name="csrf-token"]').attr('content')
            // }, function(res){
            //     alert('Berhasil ditambahkan ke keranjang');
            // });
        }

    </script>
@endsection
