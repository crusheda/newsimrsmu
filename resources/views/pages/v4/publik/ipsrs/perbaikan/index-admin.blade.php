@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Perbaikan <b class="text-orange link-underline-orange text-decoration-underline">IPSRS</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Publik</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Perbaikan IPSRS
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            {{-- BARIS 1 --}}
            <div class="col-lg-2 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-1">{{ $list['total'] }}</h3>
                                <p class="text-muted mb-0">Total</p>
                            </div>
                            <div class="col-4 text-end"><i class="ti ti-license text-secondary fs-36"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-1">{{ $list['totalmasukpengaduan'] }}</h3>
                                <p class="text-muted mb-0">Diverifikasi</p>
                            </div>
                            <div class="col-4 text-end"><i class="ti ti-checks text-primary fs-36"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-1">{{ $list['totaldiverifikasi'] }}</h3>
                                <p class="text-muted mb-0">Diterima</p>
                            </div>
                            <div class="col-4 text-end"><i class="ti ti-phone-incoming text-info fs-36"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-1">{{ $list['totaldikerjakan'] }}</h3>
                                <p class="text-muted mb-0">Dikerjakan</p>
                            </div>
                            <div class="col-4 text-end"><i class="ti ti-clock text-warning fs-36"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-1">{{ $list['totalselesai'] }}</h3>
                                <p class="text-muted mb-0">Diselesaikan</p>
                            </div>
                            <div class="col-4 text-end"><i class="ti ti-clipboard-check text-success fs-36"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-1">{{ $list['totalditolak'] }}</h3>
                                <p class="text-muted mb-0">Ditolak</p>
                            </div>
                            <div class="col-4 text-end"><i class="ti ti-file-shredder text-danger fs-36"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Diagram Pengaduan <a id="show_tahun" class="text-primary">Tahun {{ $list['tahun'] }}</a></h6>
                        </div>
                        <div class="flex-shrink-0 ms-3">
                            <div class="dropdown">
                                <a class="btn btn-outline-secondary dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true">
                                    Tahun Lainnya
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    @php
                                        for ($i=2023; $i <= $list['tahun']; $i++) {
                                            if ($i == $list['tahun']) {
                                                echo"<button class='dropdown-item' onclick='diagram($i)'>Tahun $i (<a class='text-primary'>Saat Ini</a>)</button>";
                                            } else {
                                                echo"<button class='dropdown-item' onclick='diagram($i)'>Tahun $i</button>";
                                            }
                                        }
                                    @endphp
                                    {{-- <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Weekly</a>
                                    <a class="dropdown-item" href="#">Monthly</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="diagram">
                        <div class="d-flex justify-content-center align-items-center"><span class="spinner-border spinner-border-sm text-primary me-2" role="status"></span>Loading...</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">Tabel <b class="text-danger">Pengaduan</b></h6>
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning-transparent" id="btn-refresh" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Segarkan Tabel Pengaduan (100 Data Terakhir)" onclick="refresh()">
                                    <i class="fa-fw fas fa-sync nav-icon me-1"></i> 100 Data Aktif Terakhir</button>
                            <button type="button" class="btn btn-danger-transparent" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                title="Tampilkan Seluruh Data" onclick="showAll()">
                                <i class="fa-fw fas fa-infinity nav-icon me-1"></i> Seluruh Data</button>
                            <button type="button" class="btn btn-success-transparent" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                title="Rekapitulasi Data Perbaikan">
                                <i class="fa-fw fas fa-history nav-icon me-1"></i> Rekapitulasi</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="table">
                            <div class="alert alert-light shadow-sm mb-3">
                                <small>
                                    <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Data pengaduan yang ditampilkan di bawah adalah <b class="text-warning">100 Data</b> Pengaduan yang masih <b class="text-success">Aktif</b> <br>
                                </small>
                            </div>
                            <table id="dttable" class="table table-hover dt-responsive align-middle">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th><center>STATUS</center></th>
                                        <th>NAMA</th>
                                        <th>UNIT</th>
                                        <th>LOKASI</th>
                                        <th>TGL PENGADUAN</th>
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
                                        <th>#ID</th>
                                        <th><center>STATUS</center></th>
                                        <th>NAMA</th>
                                        <th>UNIT</th>
                                        <th>LOKASI</th>
                                        <th>TGL PENGADUAN</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="table-responsive" id="tableAll" hidden>
                            <div class="alert alert-light shadow-sm mb-3">
                                <small>
                                    <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Export Data <b class="text-success">EXCEL</b> / <b class="text-danger">PDF</b> dapat melalui tombol pada tabel di bawah ini <br>
                                    <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Untuk menampilkan semua kolom, silakan [<b class="text-secondary">✓</b>] pilihan kolom pada tombol "<b>Column Visibility</b>" di bawah ini <br>
                                    <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Silakan melakukan pencarian / filtering data melalui kolom isian <b class="text-warning">Cari Data : .....</b>
                                </small>
                            </div>
                            <table id="dttableAll" class="table table-hover dt-responsive align-middle">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th><center>STATUS</center></th>
                                        <th>NAMA</th>
                                        <th>UNIT</th>
                                        <th>LOKASI</th>
                                        <th>TGL PENGADUAN</th>
                                        <th>KETERANGAN PENGADUAN</th>
                                        <th>TGL DITERIMA</th>
                                        <th>KETERANGAN DITERIMA</th>
                                        <th>TGL DIKERJAKAN</th>
                                        <th>KETERANGAN DIKERJAKAN</th>
                                        <th>TGL SELESAI</th>
                                        <th>KETERANGAN SELESAI</th>
                                        <th>KETERANGAN PENOLAKAN</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody-all">
                                    <tr>
                                        <td colspan="9" style="font-size:13px">
                                            <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#ID</th>
                                        <th><center>STATUS</center></th>
                                        <th>NAMA</th>
                                        <th>UNIT</th>
                                        <th>LOKASI</th>
                                        <th>TGL PENGADUAN</th>
                                        <th>KETERANGAN PENGADUAN</th>
                                        <th>TGL DITERIMA</th>
                                        <th>KETERANGAN DITERIMA</th>
                                        <th>TGL DIKERJAKAN</th>
                                        <th>KETERANGAN DIKERJAKAN</th>
                                        <th>TGL SELESAI</th>
                                        <th>KETERANGAN SELESAI</th>
                                        <th>KETERANGAN PENOLAKAN</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalLampiran" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Lampiran Pengaduan
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="imgPush"></div>
                    <h6 id="titleImgPush" class="text-center"></h6>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="reset" class="btn btn-link-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let chart;
        $(document).ready(function() {
            refresh();
            diagram(new Date().getFullYear());
        });

        // FUNCTION
        function refresh() {
            $("#table").prop('hidden',false);
            $("#tableAll").prop('hidden',true);
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="20" style="font-size: 13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/publik/perbaikan/ipsrs/admin/table",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        if (item.unit) {
                            try {
                                var un = JSON.parse(item.unit);
                            } catch (e) {
                                var un = item.unit;
                            }
                        }
                        if (un !== null) {
                            un = un.toString().replaceAll(',', ', ').replaceAll('-', ' ');
                        } else {
                            un = '';
                        }
                        var status = '';
                        var colorBtn = '';
                        if (item.tgl_selesai != null && item.ket_penolakan == null) {
                            colorBtn = 'success';
                            status = '<td><center><span class="badge text-bg-success fs-12">Selesai</span></center></td>';
                        } else {
                            if (item.ket_penolakan != null) {
                                colorBtn = 'danger';
                                status = '<td><center><span class="badge text-bg-danger fs-12">Ditolak</span></center></td>';
                            } else {
                                if (item.tgl_diterima == null) {
                                    colorBtn = 'primary';
                                    status = '<td><center><span class="badge text-bg-primary fs-12">Diverifikasi</span></center></td>';
                                } else {
                                    if (item.tgl_dikerjakan == null) {
                                        colorBtn = 'info';
                                        status = '<td><center><span class="badge text-bg-info fs-12">Diterima</span></center></td>';
                                    } else {
                                        if (item.tgl_selesai == null) {
                                            colorBtn = 'warning';
                                            status = '<td><center><span class="badge text-bg-warning fs-12">Dikerjakan</span></center></td>';
                                        } else {
                                            colorBtn = 'secondary';
                                            status = '<td><center><span class="badge text-bg-secondary fs-12">Tidak Ditemukan</span></center></td>';
                                        }
                                    }
                                }
                            }
                        }

                        content = `<tr><td><div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="link-${colorBtn} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle" data-bs-toggle="dropdown">${item.id}</a>
                                            <div class="dropdown-menu dropdown-menu-end">`;
                                                if (item.filename_pengaduan != null && item.filename_pengaduan != '') {
                                                    content += `<a href="javascript:void(0);" onclick="showLampiran(${item.id})" class="dropdown-item text-info"><i class='fas fa-image me-2'></i> Lampiran</a>`;
                                                } else {
                                                    content += `<a href="javascript:void(0);" class="dropdown-item disabled" disabled><i class='fas fa-image me-2'></i> Lampiran</a>`;
                                                }
                                                content += `<a href="/v4/publik/perbaikan/ipsrs/detail/${item.id}" class="dropdown-item text-primary"><i class='fa fa-wrench me-2'></i> Lihat Pengaduan</a>`;
                        content += `</div></div></div></td>`;
                        // LANJUT CONTENT
                        content += status;
                        content += `<td>${item.nama?item.nama:'<s class="text-danger">Nama Tidak Valid</s>'}</td>`;
                        content += `<td>`+un+`</td>`;
                        content += `<td>${item.lokasi}</td>`;
                        content += `<td>`+new Date(item.tgl_pengaduan).toLocaleString("sv-SE")+`</td></tr>`;
                        $('#tampil-tbody').append(content);
                    })

                    var table = $('#dttable').DataTable({
                        order: [
                            [5, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '8%' },
                            { sWidth: '8%' },
                            { sWidth: '20%' },
                            { sWidth: '24%' },
                            { sWidth: '30%' },
                            { sWidth: '10%' },
                        ],
                        displayLength: 20,
                    });
                }
            })
        }

        function showAll() {
            $("#table").prop('hidden',true);
            $("#tableAll").prop('hidden',false);
            $("#tampil-tbody-all").empty().append(
                `<tr><td colspan="20" style="font-size: 13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses seluruh data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/v4/publik/perbaikan/ipsrs/admin/tableAll",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody-all").empty();
                    $('#dttableAll').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        if (item.unit) {
                            try {
                                var un = JSON.parse(item.unit);
                            } catch (e) {
                                var un = item.unit;
                            }
                        }
                        if (un !== null) {
                            un = un.toString().replaceAll(',', ', ').replaceAll('-', ' ');
                        } else {
                            un = '';
                        }
                        var status = '';
                        var colorBtn = '';
                        if (item.tgl_selesai != null && item.ket_penolakan == null) {
                            colorBtn = 'success';
                            status = '<td><center><span class="badge text-bg-success fs-12">Selesai</span></center></td>';
                        } else {
                            if (item.ket_penolakan != null) {
                                colorBtn = 'danger';
                                status = '<td><center><span class="badge text-bg-danger fs-12">Ditolak</span></center></td>';
                            } else {
                                if (item.tgl_diterima == null) {
                                    colorBtn = 'primary';
                                    status = '<td><center><span class="badge text-bg-primary fs-12">Diverifikasi</span></center></td>';
                                } else {
                                    if (item.tgl_dikerjakan == null) {
                                        colorBtn = 'info';
                                        status = '<td><center><span class="badge text-bg-info fs-12">Diterima</span></center></td>';
                                    } else {
                                        if (item.tgl_selesai == null) {
                                            colorBtn = 'warning';
                                            status = '<td><center><span class="badge text-bg-warning fs-12">Dikerjakan</span></center></td>';
                                        } else {
                                            colorBtn = 'secondary';
                                            status = '<td><center><span class="badge text-bg-secondary fs-12">Tidak Ditemukan</span></center></td>';
                                        }
                                    }
                                }
                            }
                        }

                        content = `<tr><td><div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="link-${colorBtn} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle" data-bs-toggle="dropdown">${item.id}</a>
                                            <div class="dropdown-menu dropdown-menu-end">`;
                                                if (item.filename_pengaduan != null && item.filename_pengaduan != '') {
                                                    content += `<a href="javascript:void(0);" onclick="showLampiran(${item.id})" class="dropdown-item text-info"><i class='fas fa-image me-2'></i> Lampiran</a>`;
                                                } else {
                                                    content += `<a href="javascript:void(0);" class="dropdown-item disabled" disabled><i class='fas fa-image me-2'></i> Lampiran</a>`;
                                                }
                                                content += `<a href="/v4/publik/perbaikan/ipsrs/detail/${item.id}" class="dropdown-item text-primary"><i class='fa fa-wrench me-2'></i> Lihat Pengaduan</a>`;
                        content += `</div></div></div></td>`;
                        // LANJUT CONTENT
                        content += status;
                        content += `<td>${item.nama?item.nama:'<s class="text-danger">Nama Tidak Valid</s>'}</td>`;
                        content += `<td>`+un+`</td>`;
                        content += `<td>${item.lokasi}</td>`;
                        content += `<td>`+new Date(item.tgl_pengaduan).toLocaleString("sv-SE")+`</td>`;
                        content += `<td>${item.ket_pengaduan?item.ket_pengaduan:'-'}</td>`;
                        content += `<td>`+new Date(item.tgl_diterima).toLocaleString("sv-SE")+`</td>`;
                        content += `<td>${item.ket_diterima?item.ket_diterima:'-'}</td>`;
                        content += `<td>`+new Date(item.tgl_dikerjakan).toLocaleString("sv-SE")+`</td>`;
                        content += `<td>${item.ket_dikerjakan?item.ket_dikerjakan:'-'}</td>`;
                        content += `<td>`+new Date(item.tgl_selesai).toLocaleString("sv-SE")+`</td>`;
                        content += `<td>${item.ket_selesai?item.ket_selesai:'-'}</td>`;
                        content += `<td>${item.ket_penolakan?item.ket_penolakan:'-'}</td></tr>`;
                        $('#tampil-tbody-all').append(content);
                    })

                    var table = $('#dttableAll').DataTable({
                        order: [
                            [5, "desc"]
                        ],
                        columnDefs: [
                            { visible: false, targets: [6] },
                            { visible: false, targets: [7] },
                            { visible: false, targets: [8] },
                            { visible: false, targets: [9] },
                            { visible: false, targets: [10] },
                            { visible: false, targets: [11] },
                            { visible: false, targets: [12] },
                            { visible: false, targets: [13] },
                        ],
                        displayLength: 100,
                    });
                }
            })
        }

        function showLampiran(id) {
            $.ajax({
                url: "/api/v4/publik/perbaikan/ipsrs/admin/lampiran/"+id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $('#imgPush').empty();
                    $('#titleImgPush').text(res.title_pengaduan);
                    $('#imgPush').append(`<center><img src="/storage/`+res.filename_pengaduan.substring(7,1000)+`" class="img-fluid" alt=""></center>`);
                    $('#modalLampiran').modal('show');
                }
            })
        }

        function diagram(tahun) {
            $('#diagram').empty();
            $('#diagram').append(`<div class="d-flex justify-content-center align-items-center"><span class="spinner-border spinner-border-sm text-primary me-2" role="status"></span>Loading...</div>`);
            $.ajax({
                url: "/api/v4/publik/perbaikan/ipsrs/admin/diagram/"+tahun,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    // console.log(res);
                    $('#diagram').empty();
                    $('#show_tahun').text('Tahun '+tahun);
                    new ApexCharts(document.querySelector("#diagram"), {
                        chart: {
                            type: "area",
                            height: 300,
                            toolbar: {
                                show: !1
                            }
                        },
                        colors: ["#0d6efd","#F80F30"],
                        fill: {
                            type: "gradient",
                            gradient: {
                                shadeIntensity: 1,
                                type: "vertical",
                                inverseColors: !1,
                                opacityFrom: .5,
                                opacityTo: 0
                            }
                        },
                        dataLabels: {
                            enabled: !1
                        },
                        stroke: {
                            width: 1
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: "45%",
                                borderRadius: 4
                            }
                        },
                        grid: {
                            strokeDashArray: 4
                        },
                        series: [
                            {
                                name: 'Pengaduan Selesai',
                                data: res.selesai
                            },
                            {
                                name: 'Pengaduan Ditolak',
                                // data: [30, 60, 40, 70, 50, 90, 50, 55, 45, 60, 50, 65]
                                data: res.ditolak
                            }
                        ],
                        xaxis: {
                            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                            axisBorder: {
                                show: !1
                            },
                            axisTicks: {
                                show: !1
                            }
                        }
                    }).render();
                }
            })
        }
    </script>
@endsection
