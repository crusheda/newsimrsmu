@extends('layouts.v4')

@section('content')

    <style>
        #tabelRekap { min-width: 1200px; /* atau bisa juga auto, tergantung kebutuhan kolom kamu */ width: 100%; }
        #fresh-table { scroll-behavior: smooth; }
    </style>

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Rekapitulasi <b class="text-danger link-underline-danger text-decoration-underline">Pengadaan</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Administrasi</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a role="button" onclick="window.location.href='{{ route('v4.administrasi.pengadaan') }}'">E-Pengadaan</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Rekapitulasi
                    </li>
                </ol>
            </div>
        </div>

        <!-- [ Main Content ] start -->
        <div class="row pt-1">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between p-4">
                        <div class="btn-group">
                            <button class="btn btn-dark btn-sm" onclick="window.location.href='{{ route('v4.administrasi.pengadaan') }}';"><i class="fas fa-arrow-left me-2"></i> Kembali</button>
                            <button class="btn btn-info btn-sm" onclick="showRekap()" data-bs-toggle="tooltip"
                                data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                title="Filter Rekap Pengadaan"><i class="fas fa-calendar-alt me-2"></i> Tampilkan Data Lainnya
                            </button>
                        </div>
                        <div class="btn-group">
                            <a href="javascript:void(0);" class="btn btn-warning-transparent btn-sm" onclick="refresh()" data-bs-toggle="tooltip"
                                data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Segarkan Tabel" id="btn-refresh">
                                <i class="fas fa-sync me-2"></i> Refresh Tabel
                            </a>
                            <button id="btnExcel" class="btn btn-success-transparent btn-sm">
                                <i class="fa fa-file-excel me-1"></i> Export Excel
                            </button>
                            <button id="btnPDF" class="btn btn-danger-transparent btn-sm">
                                <i class="fa fa-file-pdf me-1"></i> Export PDF
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        <div class="border border-bottom-1 border-top-0 border-start-0 border-end-0 mb-3">
                            <h3 class="text-center">PENGADAAN <b class="text-primary text-uppercase" id="judul_kategori">{{ $list['nama_kategori'] }}</b> BULAN <b class="text-danger" id="judul_bulan">{{ $list['bln'] }}</b> TAHUN <b class="text-danger" id="judul_tahun">{{ $list['thn'] }}</b></h3>
                        </div>
                        <div class="table-responsive" style="border: 0px;overflow-x: auto; -webkit-overflow-scrolling: touch;scroll-behavior: smooth;" id="fresh-table">
                            <table id="tabelRekap" class="table table-display table-bordered" style="min-width: 1200px;width: 100%;">
                                <thead></thead>
                                <tbody><tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- MULAI MODAL --}}
    <div class="modal fade" tabindex="-1" id="rekap" role="dialog" aria-labelledby="orderdetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="orderdetailsModalLabel">Rekapitulasi <b class="text-danger">Data</b></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group" style="width: 100%">
                                <label class="form-label">Pilih Bulan <b class="text-danger">*</b></label>
                                <select onchange="rekapBtn()" class="form-control" name="bulan" id="bulan">
                                    @foreach(getBulanList() as $key => $val)
                                        <option value="{{ $key }}" {{ $key == $list['bln'] ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group" style="width: 100%">
                                <label class="form-label">Pilih Tahun <b class="text-danger">*</b></label>
                                <select onchange="rekapBtn()" class="form-control" name="tahun" id="tahun">
                                    @foreach(getTahunRange(2) as $tahun)
                                        <option value="{{ $tahun }}" {{ $tahun == $list['thn'] ? 'selected' : '' }}>{{ $tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" style="width: 100%">
                                <label class="form-label">Pilih Jenis / Kategori <b class="text-danger">*</b></label>
                                <select onchange="rekapBtn()" class="form-control" name="kategori" id="kategori">
                                    <option hidden>Pilih Kategori</option>
                                    @if ($list['ref'])
                                        @foreach ($list['ref'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="submit_filter" onclick="refresh()" disabled><i
                            class="fa-fw fas fa-filter nav-icon"></i> Submit</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><i
                            class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- SELESAI MODAL --}}

    <script>
        $(document).ready(function() {
            refresh();
            $('#btnExcel').on('click', function () {

                let table = document.getElementById("tabelRekap");

                let wb = XLSX.utils.table_to_book(table, {
                    sheet: "Rekap"
                });

                XLSX.writeFile(wb, `Rekap_Barang_${moment().format('YYYYMMDD_HHmm')}.xlsx`);
            });
            $('#btnPDF').on('click', function () {

                let body = [];

                let table = document.getElementById("tabelRekap");

                // ambil semua row
                table.querySelectorAll("tr").forEach(tr => {
                    let row = [];

                    tr.querySelectorAll("th, td").forEach(td => {
                        row.push({
                            text: td.innerText,
                            bold: td.tagName === "TH",
                            alignment: "center"
                        });
                    });

                    body.push(row);
                });

                let docDefinition = {
                    pageOrientation: 'landscape',
                    content: [
                        { text: 'Rekap Barang', style: 'header' },
                        {
                            table: {
                                headerRows: 2, // karena kamu pakai 2 header
                                body: body
                            }
                        }
                    ],
                    styles: {
                        header: {
                            fontSize: 14,
                            bold: true,
                            margin: [0, 0, 0, 10]
                        }
                    }
                };

                pdfMake.createPdf(docDefinition).download(
                    `Rekap_Barang_${moment().format('YYYYMMDD_HHmm')}.pdf`
                );
            });
        })

        function showRekap() {
            $('#rekap').modal('show');
        }

        function rekapBtn() {
            // var unit = $("#unit_cari").val();
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            var kategori = $("#kategori").val();

            if (bulan != 'Pilih Bulan' && tahun != 'Pilih Tahun' && kategori != 'Pilih Kategori') {
                $('#submit_filter').prop('disabled', false).removeClass('btn-secondary').addClass('btn-primary');
            }
        }

        function refresh() {
            var inp_bulan = $("#bulan").val();
            var inp_tahun = $("#tahun").val();
            var inp_kategori = $("#kategori").val();

            if (inp_bulan != 'Pilih Bulan') {
                bulan = $("#bulan").val();
                $("#judul_bulan").text(bulan);
            } else { bulan = "{{ $list['bln'] }}"; }

            if (inp_tahun != 'Pilih Tahun') {
                tahun = $("#tahun").val();
                $("#judul_tahun").text(tahun);
            } else { tahun = "{{ $list['thn'] }}"; }

            nama_kategori = "{{ $list['nama_kategori'] }}";
            if (inp_kategori != 'Pilih Kategori') {
                kategori = $("#kategori").val();
                if (kategori == 1) {
                    nama_kategori = 'ATK';
                } else {
                    if (kategori == 2) {
                        nama_kategori = 'CETAK';
                    } else {
                        nama_kategori = 'BHP';
                    }
                }
                $("#judul_kategori").text(nama_kategori);
            } else { kategori = "{{ $list['kategori'] }}"; }

            $('#btn-refresh').prop('disabled',true);
            $('#btn-refresh').find('i').addClass('fa-spin');
            $('#tabelRekap').empty().append(`<thead></thead><tbody><tr style='font-size:13px'><td colspan="100%"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody><tfoot></tfoot>`);

            $.ajax({
                url: `/api/v4/administrasi/pengadaan/rekap/${bulan}/${tahun}/${kategori}`,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    // $('#tabelRekap').empty().append(`<thead></thead><tbody></tbody><tfoot></tfoot>`);
                    if ( $.fn.DataTable.isDataTable('#tabelRekap') ) {
                        $('#tabelRekap').DataTable().clear().destroy();
                    }
                    var tbody = $('#tabelRekap tbody');
                    var thead = $('#tabelRekap thead');
                    var tfoot = $('#tabelRekap tfoot');
                    tbody.empty();
                    thead.empty();
                    tfoot.empty();

                    if (res.data.length != 0) {
                        // Inisialisasi penampung total per unit
                        var totalPerUnit = {};
                        res.units.forEach(function (unitData) {
                            var unitKey = unitData.unit + '|' + unitData.tgl_pengadaan;
                            totalPerUnit[unitKey] = 0;
                        });

                        // Buat header dinamis
                        var head1 = `
                            <tr>
                                <th rowspan="2">ID</th>
                                <th rowspan="2">Nama Barang</th>`;
                        var head2 = `<tr>`;

                        res.units.forEach(function (unitData) {
                            var label = `${unitData.unit} (<b class="text-danger">${unitData.tgl_pengadaan}</b>)`;
                            head1 += `<th colspan="3">${label}</th>`;
                            head2 += `<th>Jml</th><th>Total Harga</th><th>Keterangan</th>`;
                        });

                        head1 += `</tr>`;
                        head2 += `</tr>`;
                        thead.append(head1);
                        thead.append(head2);

                        // Buat tbody per barang
                        res.data.forEach(function (row) {
                            var tr = `
                                <tr>
                                    <td>${row.id}</td>
                                    <td>${row.nama}</td>`;

                            res.units.forEach(function (unitData) {
                                var unitKey = `${unitData.unit}|${unitData.tgl_pengadaan}`;
                                if (row.units && row.units[unitKey]) {
                                    var detail = row.units[unitKey];
                                    tr += `
                                        <td>${detail.jumlah}</td>
                                        <td>${detail.total}</td>
                                        <td>${detail.keterangan || ''}</td>`;
                                    totalPerUnit[unitKey] += parseFloat(detail.total);
                                } else {
                                    tr += `<td></td><td></td><td></td>`;
                                }
                            });

                            tr += `</tr>`;
                            tbody.append(tr);
                        });

                        // Buat baris total keseluruhan di <tfoot>
                        var totalRow = `
                            <tr style="font-weight:bold;">
                                <td colspan="2" align="right">TOTAL KESELURUHAN</td>`;

                        res.units.forEach(function (unitData) {
                            var unitKey = `${unitData.unit}|${unitData.tgl_pengadaan}`;
                            totalRow += `
                                <td></td>
                                <td>${formatRupiah((totalPerUnit[unitKey] || 0).toFixed(2))}</td>
                                <td></td>`;
                        });
                        totalRow += `</tr>`;
                        tfoot.append(totalRow);

                        // Aktifkan tombol refresh
                        $('#btn-refresh').prop('disabled', false);
                        $('#btn-refresh').find('i').removeClass('fa-spin');
                        $('#rekap').modal('hide');

                        // Inisialisasi DataTable
                        // $('#tabelRekap').DataTable({
                        //     destroy: true,
                        //     dom: 'Bfrtip',
                        //     order: [[1, "asc"]],
                        //     displayLength: 10000,
                        //     lengthChange: true,
                        //     scrollX: true,
                        //     deferRender: false,
                        //     scrollY: '700px', // bisa disesuaikan sesuai kebutuhan tinggi viewport kamu
                        //     scrollCollapse: true,
                        //     autoWidth: true,
                        //     fixedHeader: true,
                        //     // fixedHeader: {
                        //     //     header: true,
                        //     //     headerOffset: 0
                        //     // },
                        //     // fixedColumns: {
                        //     //     leftColumns: 2 // misalnya freeze kolom ID & Nama Barang
                        //     // },
                        //     columnDefs: [
                        //         { targets: 1, orderable: true },
                        //         { targets: '_all', orderable: false },
                        //     ],
                        //     buttons: [
                        //         {
                        //             extend: 'copy',
                        //             text: '<i class="fa fa-copy me-1"></i> Salin',
                        //             className: 'btn btn-sm btn-secondary'
                        //         },
                        //         {
                        //             extend: 'excel',
                        //             text: '<i class="fa fa-file-excel me-1"></i> Export ke Excel',
                        //             className: 'btn btn-sm btn-success',
                        //             title: 'Rekap Barang',
                        //             messageTop: 'Laporan Rekap Barang',
                        //             filename: 'Rekap_Barang_' + nama_kategori + '_' + moment().format('YYYYMMDD_HHmm')
                        //         },
                        //         {
                        //             extend: 'pdf',
                        //             text: '<i class="fa fa-file-pdf me-1"></i> Export ke PDF',
                        //             className: 'btn btn-sm btn-danger',
                        //             title: 'Rekap Barang',
                        //             messageTop: 'Laporan Rekap Barang',
                        //             filename: 'Rekap_Barang_' + nama_kategori + '_' + moment().format('YYYYMMDD_HHmm'),
                        //             orientation: 'landscape',
                        //             pageSize: 'A4',
                        //             customize: function (doc) {
                        //                 doc.styles.tableHeader.fillColor = '#f8f8f8';
                        //                 doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        //             }
                        //         }
                        //         // , 'colvis'
                        //     ],
                        //     // drawCallback: function () {
                        //     //     // Fix lebar kolom manual tiap redraw
                        //     //     this.api().columns.adjust();
                        //     // }
                        // }).columns.adjust().draw();
                    } else {
                        $('#tabelRekap').empty().append(`<thead></thead><tbody><tr style='font-size:13px'><td colspan="100%"><center>Data Tidak Ditemukan. Silakan Pilih Bulan / Tahun / Kategori Pengadaan Yang Sesuai.</center></td></tr></tbody><tfoot></tfoot>`);
                    }
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan System!',
                        message: xhr.responseText ?? 'Terjadi kesalahan saat memuat data.',
                        position: 'topRight'
                    });
                },
                complete: function() {
                    $('#rekap').modal('hide');
                    $('#btn-refresh').prop('disabled',false);
                    $('#btn-refresh').find('i').removeClass('fa-spin');
                }
            })
        }

        function formatRupiah(angka) {
            if (!angka || isNaN(angka)) return 'Rp 0 ,-';
            return 'Rp ' + parseFloat(angka).toFixed(0)
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' ,-';
        }
    </script>
@endsection
