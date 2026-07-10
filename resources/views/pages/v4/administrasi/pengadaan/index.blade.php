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
                                <button type="button" class="btn btn-info-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><span class="d-none d-md-inline">Menu</span> Grafik</button>
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
                            <button class="btn btn-secondary btn-shadow" onclick="bukaRiwayatPengadaan()" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-html="true" title="Lihat Riwayat Pengadaan" id="btn-riwayat-pengadaan">
                                <i class="ri-shopping-bag-line"></i> <span class="d-none d-md-inline ms-1">Riwayat</span>
                            </button>
                            <button class="btn btn-warning-transparent btn-shadow" id="btn-refresh" onclick="applyFilters()" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-html="true" title="Refresh Tabel Pengadaan">
                                <i class="ri-loop-left-line nav-icon" id="icon-refresh"></i>
                            </button>
                            @can('admin_pengadaan')
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-spy-line"></i> <span class="d-none d-md-inline ms-1">Menu Admin</span></button>
                                    <ul class="dropdown-menu p-2">
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.location.href='{{ route('v4.administrasi.pengadaan.barang') }}'">Daftar Barang</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#rekap">Rekapitulasi</a></li>
                                    </ul>
                                </div>
                            @endcan
                        </div>
                        <button class="btn btn-primary btn-shadow" onclick="bukaKeranjang()" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" data-bs-html="true" title="Buka Keranjang Pengadaan">
                            <i class="ri-shopping-cart-2-line me-1"></i> <span class="d-none d-md-inline">Buka</span> Keranjang
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
                                <select id="category-filter" class="form-control" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-html="true" title="Filter Jenis Barang">
                                    <option value="" hidden>Jenis Barang</option>
                                    <option value="all">Semua</option>
                                    @if ($list['ref'])
                                        @foreach ($list['ref'] as $item)
                                            <option value="{{ strtoupper($item->nama) }}">{{ $item->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!-- Status Filter -->
                            <div class="col">
                                <select id="harga-filter" class="form-control" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-html="true" title="Filter Rentang Harga Barang">
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
                        <div id="product-table" class="grid-card-table"><center><i class="fas fa-sync fa-spin nav-icon me-1"></i> Memuat Barang Pengadaan</center></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TAMBAH KERANJANG --}}
    <div class="modal fade" tabindex="-1" id="addKeranjang" role="dialog" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel"><b class="text-info">Tambah</b> ke <b class="text-success">keranjang</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_barang_input">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="" alt="img" id="img_barang_input" class="img-fluid rounded w-100">
                        </div>
                        <div class="col-md-7 ps-4">
                            <div class="mb-3">
                                <a href="javascript:void(0);">
                                    <h6 class="fw-medium mb-1" id="nama_barang_input"></h6>
                                </a>
                                <span class="text-muted fs-14" id="harga_barang_input"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah Permintaan</label>
                                <input type="number" id="jml_input" class="form-control" value="1" min="1">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea id="ket_input" rows="3" class="form-control" placeholder="Opsional..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button class="btn btn-primary-transparent" onclick="bukaKeranjang()"><i
                            class="ri-shopping-cart-2-line me-1 align-middle"></i> Lihat Keranjang</button>
                    <div>
                        <button class="btn btn-info me-1" onclick="submitTambahKeranjang()" id="btn-tambah-keranjang"><i
                            class="ri-add-box-line me-1"></i> Masukkan ke Keranjang</button>
                        <button type="button" class="btn btn-secondary-transparent" data-bs-dismiss="modal"><i
                                class="ri-close-line me-1"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BUKA KERANJANG --}}
    <div class="modal fade" tabindex="-1" id="keranjang" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Keranjang <b class="text-primary">Belanja</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card custom-card overflow-hidden mb-0">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table nowrap text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Produk/Barang</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Harga Satuan</th>
                                            <th>Jumlah</th>
                                            <th class="text-end">Sub Total</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tampil-keranjang"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button class="btn btn-warning-transparent" onclick="loadKeranjang()" id="btn-refresh-keranjang"
                        data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                        title="Muat Ulang Keranjang"><i class="ri-loop-right-line me-1"></i> Muat Ulang</button>
                    <div>
                        <button class="btn btn-danger me-2" onclick="checkoutKeranjang()" id="btn-ajukan"
                            data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                            title="Ajukan Pengadaan"><i class="ri-luggage-cart-line me-1"></i> Ajukan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="ri-close-line me-1"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TAMPIL RIWAYAT PENGADAAN --}}
    <div class="modal fade" tabindex="-1" id="riwayatPengadaan" role="dialog" aria-labelledby="riwpeng" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xxl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="riwpeng">Riwayat <b class="text-secondary">Belanja</b> <b class="text-primary">Pengadaan</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card custom-card overflow-hidden mb-0">
                        <div class="card-header d-flex align-items-center justify-content-between py-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class="form-control" id="filter_tahun_riwayat">

                                        <option value="0">Semua Tahun</option>

                                        @foreach ($list['tahun'] as $item)
                                            <option value="{{ $item }}" @can('admin_pengadaan') @if (now()->format('Y') == $item) selected @endif @endcan>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select class="form-control" id="filter_bulan_riwayat">

                                        <option value="0">Semua Bulan</option>

                                        @foreach ($list['bulan'] as $item)
                                            <option value="{{ $item['value'] }}" @can('admin_pengadaan') @if (now()->format('m') == $item['value']) selected @endif @endcan>
                                                {{ $item['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-secondary-transparent" onclick="bukaRiwayatPengadaan()" id="btn-terapkan-filter">
                                        <i class="ri-filter-line me-1"></i> Terapkan
                                    </button>
                                </div>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" disabled><i class="ri-spy-line"></i> <span class="d-none d-md-inline ms-1">Menu Admin</span></button>
                                {{-- <ul class="dropdown-menu p-2">
                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.location.href='{{ route('v4.administrasi.pengadaan.barang') }}'">Daftar Barang</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#rekap">Rekapitulasi</a></li>
                                </ul> --}}
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table id="dttable-riwayat" class="table nowrap text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID <b class="text-primary">PENGADAAN</b></th>
                                            <th>Pegawai/Unit</th>
                                            <th>Tgl Pengadaan</th>
                                            <th><b class="d-block text-end">Total</b></th>
                                            <th><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tampil-riwayat-pengadaan"></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID <b class="text-primary">PENGADAAN</b></th>
                                            <th>Pegawai/Unit</th>
                                            <th>Tgl Pengadaan</th>
                                            <th><b class="d-block text-end">Total</b></th>
                                            <th><center>Aksi</center></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button class="btn btn-primary-transparent" onclick="bukaKeranjang()">
                        <i class="ri-shopping-cart-2-line me-1 align-middle"></i> Lihat Keranjang
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- TAMPIL DETAIL DARI RIWAYAT PENGADAAN --}}
    <div class="modal fade" id="detailPengadaan" tabindex="-1">
        <div class="modal-dialog modal-xxl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><button class="btn btn-sm btn-icon btn-wave btn-secondary-transparent me-1" onclick="kembaliKeRiwayat()"><i class="ri-arrow-left-s-line"></i></button> Detail <b class="text-success">Pengadaan</b></h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div id="detail-header" class="mb-2"></div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Barang</th>
                                    <th class="text-center">Permintaan</th>
                                    <th class="text-end">Harga/Satuan</th>
                                    <th class="text-end">Sub Total</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="detail-body"></tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="kembaliKeRiwayat()"><i class="ri-arrow-left-s-line me-1"></i> Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <!-- TAMPIL FILTER REKAP PENGADAAN -->
    <div class="modal fade" tabindex="-1" id="rekap" role="dialog" aria-labelledby="orderdetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Rekapitulasi <b class="text-danger">Data</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('v4.administrasi.pengadaan.rekap') }}" name="formRekap" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group" style="width: 100%">
                                    <label class="form-label">Pilih Bulan <b class="text-danger">*</b></label>
                                    <select onchange="rekapBtn()" class="form-control" name="bulan" id="bulan_all">
                                        @foreach(getBulanList() as $key => $val)
                                            <option value="{{ $key }}" {{ $key == date('m') ? 'selected' : '' }}>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group" style="width: 100%">
                                    <label class="form-label">Pilih Tahun <b class="text-danger">*</b></label>
                                    <select onchange="rekapBtn()" class="form-control" name="tahun" id="tahun_all">
                                        @foreach(getTahunRange(2) as $tahun)
                                            <option value="{{ $tahun }}" {{ $tahun == date('Y') ? 'selected' : '' }}>{{ $tahun }}</option>
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
                    <button class="btn btn-primary" id="submit_filterAll" onclick="pushDataRekap()" disabled><i
                            class="fa-fw fas fa-filter nav-icon"></i> Submit</button>
                    </form>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><i
                            class="fa fa-times me-1"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let chartPengadaan = null;
        let allData = [];
        let grid = null;
        let debounceTimer;
        let timeoutQuantity;

        function debounce(func, delay){
            return function(...args){
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    func.apply(this, args);
                }, delay);
            };
        }

        $(document).ready(function() {
            if (moment().format('DD') > 15) {
                Swal.fire({
                    title: "Mohon Perhatian!",
                    html: "Pengadaan <strong class='text-danger'>TELAH DITUTUP</strong> untuk bulan ini! Silakan melakukan pengadaan pada bulan selanjutnya. Popup akan tertutup dalam <b></b> ms.",
                    icon: "danger",
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: () => {
                        const timer = Swal.getPopup().querySelector("b");
                        if (timer) {
                            timerInterval = setInterval(() => {
                                timer.textContent = `${Swal.getTimerLeft()}`;
                            }, 100);
                        }
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                });
            } else {
                Swal.fire({
                    title: "Mohon Perhatian!",
                    html: "Batas maksimal Pengajuan Pengadaan hanya sampai <strong class='text-primary'>TANGGAL 15</strong> setiap bulannya! Popup akan tertutup dalam <b></b> ms.",
                    icon: "warning",
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: () => {
                        // Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                });
            }

            initGrid();

            $('#search-input').on('keyup', debounce(function(){
                applyFilters();
            }, 500)); // delay 500ms
            $('#category-filter').on('change', applyFilters);
            $('#harga-filter').on('change', applyFilters);

            grafikPengadaan(1);

            // PLUS
            $(document).on('click', '.plus', function () {
                let row = $(this).closest('tr');
                let input = row.find('.qty');

                input.val(parseInt(input.val()) + 1);
                hitungRow(row);
            });

            // MINUS
            $(document).on('click', '.minus', function () {
                let row = $(this).closest('tr');
                let input = row.find('.qty');

                let val = parseInt(input.val());
                if (val > 1) input.val(val - 1);

                hitungRow(row);
            });

            // INPUT MANUAL
            $(document).on('keyup change', '.qty', function () {
                let row = $(this).closest('tr');
                hitungRow(row);
            });

            // HAPUS
            $(document).on('click', '.hapus', function () {
                let row = $(this).closest('tr');
                let id = row.data('id');

                hapusKeranjang(id, row);
            });
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

        function formatTanggalIndo(datetime) {

            const date = new Date(datetime);

            const tanggal = date.getDate();
            const bulan = date.toLocaleString('id-ID', { month: 'long' });
            const tahun = date.getFullYear();

            const jam = date.getHours().toString().padStart(2, '0');
            const menit = date.getMinutes().toString().padStart(2, '0');

            return `${tanggal} ${bulan} ${tahun} Pukul ${jam}:${menit} WIB`;
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
                        name: 'Nama Barang  (Jenis • Satuan)',
                        formatter: (_, row) => {

                            let item = row.cells[1].data;

                            let img = item.filename
                                ? '/' + item.filename.replace('public/', 'storage/')
                                : '/images/no-image.png';

                            let isDummy = img === '/images/no-image.png';

                            return gridjs.html(`
                                <div class="d-flex align-items-center gap-3">

                                    ${
                                        isDummy
                                        ? `
                                            <span class="avatar avatar-lg bg-light">
                                                <img src="${img}"
                                                    style="object-fit:cover;width:100%;height:100%;opacity:0.7;cursor:default;">
                                            </span>
                                        `
                                        : `
                                            <a href="${img}" data-lightbox="barang-${row.cells[0].data}" data-title="${item.nama}">
                                                <span class="avatar avatar-lg bg-light">
                                                    <img src="${img}"
                                                        style="object-fit:cover;width:100%;height:100%;cursor:pointer;">
                                                </span>
                                            </a>
                                        `
                                    }

                                    <div>
                                        <div class="fw-semibold">${item.nama}</div>
                                        <div class="text-muted fs-13">
                                            ${item.jenis ?? '-'} • ${item.satuan ? item.satuan.toUpperCase() : '-'}
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
                        name: 'Harga Satuan',
                        width: '150px',
                        formatter: (_, row) => gridjs.html(`<b class="fs-16">${formatRupiah(row.cells[2].data)}${row.cells[1].data.satuan? ' /<b class="text-danger">'+row.cells[1].data.satuan+'</b>' : ''}</b>`)
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
                                <button class="btn btn-sm btn-success btn-add" id="btn-add-${row.cells[0].data}" data-id="${row.cells[0].data}"
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
                    limit: 15,
                    server: {
                        url: (prev, page, limit) => {
                            const separator = prev.includes('?') ? '&' : '?';
                            return `${prev}${separator}page=${page+1}&limit=${limit}`;
                        }
                    }
                },

                sort: false
            }).render(document.getElementById("product-table"));

            lightbox.option({
                resizeDuration: 200,
                wrapAround: true,
                albumLabel: "Gambar %1 dari %2"
            });
        }

        function applyFilters(){
            $('#btn-refresh').prop('disabled', true);
            $('#icon-refresh')
                .removeClass('ri-loop-left-line')
                .addClass('ri-loader-4-line ri-spin');

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
                    then: data => {
                        $('#btn-refresh').prop('disabled', false);
                        $('#icon-refresh')
                            .removeClass('ri-loader-4-line ri-spin')
                            .addClass('ri-loop-left-line');

                        return data.data.map(mapData);
                    },
                    total: data => data.total
                }
            }).forceRender();
        }

        function bukaRiwayatPengadaan() {

            if ($.fn.DataTable.isDataTable('#dttable-riwayat')) {
                $('#dttable-riwayat').DataTable().clear().destroy();
            }

            const btn = $('#btn-riwayat-pengadaan');
            const btnFilter = $('#btn-terapkan-filter');

            $("#tampil-riwayat-pengadaan").html(`
                <tr>
                    <td colspan="5" class="text-center">
                        <i class="fa fa-spinner fa-spin"></i> Memproses data...
                    </td>
                </tr>
            `);

            $.ajax({
                url: '/api/v4/administrasi/pengadaan/riwayat',
                type: 'get',
                data: {
                    tahun: $('#filter_tahun_riwayat').val(),
                    bulan: $('#filter_bulan_riwayat').val()
                },

                beforeSend: function() {
                    btn.prop('disabled', true);
                    btnFilter.prop('disabled', true);
                    $('#filter_tahun_riwayat').prop('disabled', true);
                    $('#filter_bulan_riwayat').prop('disabled', true);
                    $('#riwayatPengadaan').modal('show');
                },

                success: function (res) {

                    var UserID = @json(@auth()->user()->id);
                    var isAdmin = @json(@auth()->user()->can('admin_pengadaan'));
                    var date = getDateTime(); // DATE ONLY

                    $("#tampil-riwayat-pengadaan").empty();

                    let data = res.data; // ✅ ambil dari data

                    data.forEach(item => {

                        var updet = new Date(item.tgl_pengadaan).toLocaleString("sv-SE").substring(0, 10); // DATE ONLY

                        let unit = JSON.parse(item.unit)
                                        .map(u => u.replace(/-/g, ' '))
                                        .join(', ');
                        let tgl = new Date(item.tgl_pengadaan).toLocaleString("sv-SE");

                        if (isAdmin) { // JIKA ADMIN
                            btnHapus = `<li>
                                            <a href="javascript:void(0)" class="dropdown-item text-danger"
                                                onclick="hapusPengadaan(${item.id_pengadaan})">
                                                <i class="ri-delete-bin-line me-2"></i> Hapus Pengadaan
                                            </a>
                                        </li>`;
                        } else {
                            if (UserID == item.id_user) { // JIKA USER UPLOADED
                                if (date == updet) { // JIKA MASIH DI HARI YG SAMA
                                    btnHapus = `<li>
                                                    <a href="javascript:void(0)" class="dropdown-item text-danger"
                                                        onclick="hapusPengadaan(${item.id_pengadaan})">
                                                        <i class="ri-delete-bin-line me-2"></i> Hapus Pengadaan
                                                    </a>
                                                </li>`;
                                } else {
                                    btnHapus = `<li>
                                                    <a href="javascript:void(0)" class="dropdown-item disabled" disabled>
                                                        <i class="ri-delete-bin-line me-2"></i> Hapus Pengadaan
                                                    </a>
                                                </li>`;
                                }
                            } else {
                                btnHapus = `<li>
                                                <a href="javascript:void(0)" class="dropdown-item disabled" disabled>
                                                    <i class="ri-delete-bin-line me-2"></i> Hapus Pengadaan
                                                </a>
                                            </li>`;
                            }
                        }

                        let content = `
                            <tr>
                                <td class="text-start">${item.id_pengadaan}</td>
                                <td class="text-nowrap nowrap">
                                    <b>${item.nama_user}</b><br>
                                    <small class="text-muted text-uppercase">${unit}</small>
                                </td>
                                <td>${tgl}</td>
                                <td class="text-end"><b>${formatRupiah(item.total)}</b></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-secondary-transparent dropdown-toggle" data-bs-toggle="dropdown" id="btn-menu-riwayat-${item.id}" data-bs-auto-close="true" aria-expanded="false">
                                            Menu
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"
                                                    onclick="lihatDetailPengadaan(${item.id})">
                                                    <i class="ri-eye-line me-2"></i> Lihat Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"
                                                    onclick="copyPengadaan(${item.id})">
                                                    <i class="ri-file-copy-line me-2"></i> Copy Pengadaan
                                                </a>
                                            </li>
                                            ${btnHapus}
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        `;

                        $('#tampil-riwayat-pengadaan').append(content);
                    });

                    $('#dttable-riwayat').DataTable({
                        order: [[2, "desc"]],
                        displayLength: 15,
                        columns: [
                            { orderable: false }, // ID PENGADAAN
                            { orderable: true },  // Pegawai/Unit
                            { orderable: true },  // Tgl Pengadaan
                            { orderable: true },  // Total
                            { orderable: false }  // Aksi
                        ]
                    });
                },

                complete: function() {
                    btn.prop('disabled', false);
                    btnFilter.prop('disabled', false);
                    $('#filter_tahun_riwayat').prop('disabled', false);
                    $('#filter_bulan_riwayat').prop('disabled', false);
                },

                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan Error!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                }
            });
        }

        function lihatDetailPengadaan(id) {
            const btn = $(`#btn-menu-riwayat-${id}`);
            $.ajax({
                url: '/api/v4/administrasi/pengadaan/riwayat',
                type: 'get',
                data: {
                    tahun: $('#filter_tahun_riwayat').val(),
                    bulan: $('#filter_bulan_riwayat').val()
                },
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.html(`<i class="fa fa-spinner fa-spin"></i>`);
                },
                success: function(res) {

                    let data = res.data.find(x => x.id == id);

                    if (!data) return;

                    let unit = JSON.parse(data.unit)
                                    .map(u => u.replace(/-/g, ' '))
                                    .join(', ');

                    // header
                    $('#detail-header').html(`
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td width="150"><b>ID Sistem</b></td>
                                <td width="10">:</td>
                                <td>${data.id}</td>
                            </tr>
                            <tr>
                                <td width="150"><b>ID Pengadaan</b></td>
                                <td width="10">:</td>
                                <td>${data.id_pengadaan}</td>
                            </tr>
                            <tr>
                                <td><b>Pegawai</b></td>
                                <td>:</td>
                                <td>${data.nama_user}</td>
                            </tr>
                            <tr>
                                <td><b>Unit/Jabatan</b></td>
                                <td>:</td>
                                <td class="text-uppercase">${unit}</td>
                            </tr>
                            <tr>
                                <td><b>Tanggal</b></td>
                                <td>:</td>
                                <td>${formatTanggalIndo(data.tgl_pengadaan)}</td>
                            </tr>
                        </table>
                    `);

                    // detail
                    let html = "";

                    // 🔁 loop detail
                    data.detail.forEach(d => {
                        html += `
                            <tr>
                                <td>${d.id_barang}</td>
                                <td class="text-nowrap nowrap">${d.nama_barang}</td>
                                <td class="text-center">${d.jumlah}</td>
                                <td class="text-end">${formatRupiah(d.harga, 'Rp. ')} ${d.satuan_barang?'<b class="text-danger ms-1">/'+d.satuan_barang+'</b>':''}</td>
                                <td class="text-end">${formatRupiah(d.total, 'Rp. ')}</td>
                                <td class="text-nowrap nowrap">${d.ket ?? '-'}</td>
                            </tr>
                        `;
                    });

                    // 🔥 GRAND TOTAL (ambil dari data.total)
                    html += `
                        <tr>
                            <td colspan="3" class="text-start fw-bold">
                                Grand Total:
                            </td>
                            <td colspan="2" class="fw-bold text-end">
                                ${formatRupiah(data.total, 'Rp. ')}
                            </td>
                            <td></td>
                        </tr>
                    `;

                    $('#detail-body').empty().html(html);

                    $('#riwayatPengadaan').modal('hide');
                    $('#detailPengadaan').modal('show');
                },
                complete: function() {
                    btn.prop('disabled', false);
                    btn.html(`Menu`);
                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan Error!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                }
            });
        }

        function kembaliKeRiwayat() {
            $('#detailPengadaan').modal('hide');
            $('#riwayatPengadaan').modal('show');
        }

        function copyPengadaan(id) {

            if (!confirm('Copy pengadaan ke keranjang?')) return;

            $.ajax({
                url: '/api/v4/administrasi/pengadaan/copy',
                type: 'post',
                data: {
                    id_pengadaan: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {

                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Berhasil ditambahkan ke keranjang',
                        position: 'topRight'
                    });

                    // optional: buka keranjang
                    bukaKeranjang();

                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan Error!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                }
            });
        }

        function tambahKeranjang(id_barang) {
            $('#id_barang_input').val(id_barang);
            $('#jml_input').val(1);
            $('#ket_input').val('');
            const btn = $('#btn-add-' + id_barang);

            $.ajax({
                url: '/api/v4/administrasi/pengadaan/tambahkeranjang/' + id_barang,
                type: 'get',
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.html(`<i class="ri-spinner-line ri-spin me-1"></i> Memuat...`);
                },
                success: function(res) {
                    let img = res.filename
                        ? '/' + res.filename.replace('public/', 'storage/')
                        : '/images/no-image.png';

                    let isDummy = img === '/images/no-image.png';

                    $('#img_barang_input').attr('src', img);

                    $('#nama_barang_input').empty().html(res.nama+' <b class="text-warning">(</b><b class="text-primary">'+res.jenis+'</b><b class="text-warning">)</b>');
                    $('#harga_barang_input').empty().html((formatRupiah(res.harga))+(res.satuan? ' <b class="text-warning">/</b> <b class="text-danger">'+res.satuan.toUpperCase()+'</b>' : ''));

                    $('#addKeranjang').modal('show');
                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan Error!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    btn.prop('disabled', false);
                    btn.html(`<i class="ri-add-box-line me-1"></i> Tambah`);
                }
            });
        }

        function submitTambahKeranjang() {

            let id_barang = $('#id_barang_input').val();
            let jml = $('#jml_input').val();
            let ket = $('#ket_input').val();

            const btn = $('#btn-tambah-keranjang');

            if (jml < 1) {
                iziToast.warning({
                    title: 'Mohon perhatian!',
                    message: 'Jumlah per barang minimal 1',
                    position: 'topRight'
                });
                return;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/api/v4/administrasi/pengadaan/keranjang/tambah',
                type: 'POST',
                data: {
                    id_barang: id_barang,
                    jml: jml,
                    ket: ket
                },
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.find("i").addClass("ri-spin-slow ri-loop-left-line").removeClass('ri-add-box-line');
                },
                success: function (res) {

                    iziToast.success({
                        title: 'Pesan System!',
                        message: 'Barang berhasil ditambahkan ke keranjang',
                        position: 'topRight'
                    });

                    $('#addKeranjang').modal('hide');

                    if ($('#keranjang').hasClass('show')) {
                        loadKeranjang();
                    }
                }, complete: function() {
                    btn.prop('disabled', false);
                    btn.find("i").removeClass("ri-spin-slow ri-loop-left-line").addClass('ri-add-box-line');
                }, error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                }
            });
        }

        function loadKeranjang() {
            const btn = $('#btn-refresh-keranjang');
            $('#addKeranjang').modal('hide');
            $('#riwayatPengadaan').modal('hide');

            $.ajax({
                url: "/api/v4/administrasi/pengadaan/keranjang",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.find("i").addClass("ri-spin-slow");

                    $('#tampil-keranjang').html(`<tr><td colspan="7" class="text-center"><i class="ri-spin ri-loop-right-line me-1"></i> Memuat Barang di Keranjang</td></tr>`);
                },
                success: function(res) {

                    let html = '';
                    let totalAll = 0;
                    let no = 1;

                    if (res.keranjang.length > 0) {

                        res.keranjang.forEach(item => {

                            let subtotal = item.jml_permintaan * item.harga_barang;
                            totalAll += subtotal;

                            let img = item.filename
                                ? '/' + item.filename.replace('public/', 'storage/')
                                : '/images/no-image.png';

                            html += `
                            <tr data-id="${item.id}">
                                <td>${no++}</td>

                                <td>
                                    <div class="d-flex align-items-start gap-2">
                                        <span class="avatar avatar-lg">
                                            <img src="${img}">
                                        </span>
                                        <div class="w-100">
                                            <h6 class="mb-1 text-wrap">
                                                ${item.nama_barang}
                                            </h6>
                                            <small class="text-muted">
                                                ${item.jenis ?? '-'} <div class="vr ms-1 me-1"></div> ${item.satuan ? item.satuan.toUpperCase() : '-'}
                                            </small><br>
                                            <small class="text-muted">Keterangan : <b>${item.ket ?? '-'}</b></small>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <span class="badge bg-success-transparent">Ready</span>
                                </td>

                                <td class="text-center">
                                    ${formatRupiah(item.harga_barang)}
                                </td>

                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-light minus">-</button>
                                        <input type="text" class="form-control qty text-center" value="${item.jml_permintaan}" style="width:60px">
                                        <button class="btn btn-sm btn-light plus">+</button>
                                    </div>
                                </td>

                                <td class="text-end subtotal">
                                    ${formatRupiah(subtotal)}
                                </td>

                                <td class="text-end">
                                    <button class="btn btn-danger btn-sm hapus">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </td>

                                <input type="hidden" class="harga" value="${item.harga_barang}">
                                <input type="hidden" class="id_barang" value="${item.id_barang}">
                                <input type="hidden" class="ket" value="${item.ket ?? ''}">
                            </tr>
                            `;
                        });

                        html += `
                        <tr>
                            <td colspan="5"></td>
                            <td class="text-end fw-bold">
                                Total: <span id="grandTotal">${formatRupiah(totalAll)}</span>
                            </td>
                            <td></td>
                        </tr>
                        `;

                    } else {
                        html = `
                        <tr>
                            <td colspan="7" class="text-center">Keranjang kosong</td>
                        </tr>`;
                    }

                    $('#tampil-keranjang').html(html);
                }, complete: function() {
                    btn.prop('disabled', false);
                    btn.find("i").removeClass("ri-spin-slow");
                }, error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                }
            });
        }

        function hitungRow(row) {
            let harga = parseInt(row.find('.harga').val());
            let qty = parseInt(row.find('.qty').val()) || 0;

            let subtotal = harga * qty;

            row.find('.subtotal').text(formatRupiah(subtotal));

            hitungTotal();

            let id = row.data('id');
            updateQty(id, qty);
        }

        function hitungTotal() {
            let total = 0;

            $('#tampil-keranjang tr').each(function () {

                let harga = $(this).find('.harga').val();
                let qty = $(this).find('.qty').val();

                if (harga && qty) {
                    total += harga * qty;
                }
            });

            $('#grandTotal').text(formatRupiah(total));
        }

        function updateQty(id, qty) {
            clearTimeout(timeoutQuantity);
            timeoutQuantity = setTimeout(() => {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `/api/v4/administrasi/pengadaan/keranjang/update/${id}`,
                    type: 'PUT',
                    data: { qty: qty }
                });
            }, 500);
        }

        function hapusKeranjang(id, row) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/v4/administrasi/pengadaan/keranjang/${id}/hapus`,
                type: 'DELETE',
                success: function () {
                    row.remove();
                    hitungTotal();
                }
            });
        }

        function checkoutKeranjang() {

            let items = [];
            const btn = $('#btn-ajukan');

            $('#tampil-keranjang tr').each(function () {

                let id_barang = $(this).find('.id_barang').val();

                if (id_barang) {
                    items.push({
                        id_barang: id_barang,
                        jumlah: $(this).find('.qty').val(),
                        ket: $(this).find('.ket').val()
                    });
                }
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/api/v4/administrasi/pengadaan/checkout',
                type: 'POST',
                data: {
                    items: items,
                    total: $('#grandTotal').text().replace(/\D/g, '')
                },
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.find("i").addClass("ri-loop-right-line ri-spin").removeClass('ri-loop-left-line');
                },
                success: function (res) {
                    iziToast.success({
                        title: 'Pesan Berhasil!',
                        message: res.message,
                        position: 'topRight'
                    });
                    $('#keranjang').modal('hide');
                }, complete: function() {
                    btn.prop('disabled', false);
                    btn.find("i").removeClass("ri-loop-right-line ri-spin").addClass('ri-loop-left-line');
                }, error: function(xhr, status, error) {

                    let message = 'Terjadi kesalahan';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }

                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: message,
                        position: 'topRight'
                    });
                }
            });
        }

        function bukaKeranjang() {
            $('#keranjang').modal('show');

            loadKeranjang();
            // $.get("/api/v4/administrasi/pengadaan/keranjang", function(res) {

            //     let html = '';
            //     let totalAll = 0;
            //     let no = 1;

            //     if (res.keranjang.length > 0) {

            //         res.keranjang.forEach(item => {

            //             let subtotal = item.jml_permintaan * item.harga_barang;
            //             totalAll += subtotal;

            //             html += `
            //             <tr data-id="${item.id}">
            //                 <td>${no++}</td>

            //                 <td>
            //                     <div class="d-flex align-items-center gap-3">
            //                         <span class="avatar avatar-xxl">
            //                             <img src="/images/no-img.png">
            //                         </span>
            //                         <div>
            //                             <h6 class="fw-semibold">${item.nama_barang}</h6>
            //                             <small class="text-muted">${item.ket ?? ''}</small>
            //                         </div>
            //                     </div>
            //                 </td>

            //                 <td class="text-center">
            //                     <span class="badge bg-success-transparent">Ready</span>
            //                 </td>

            //                 <td class="text-center">
            //                     Rp ${formatRupiah(item.harga_barang)}
            //                 </td>

            //                 <td>
            //                     <div class="d-inline-flex align-items-center gap-2">
            //                         <button class="btn btn-sm btn-light minus">-</button>
            //                         <input type="text" class="form-control text-center qty"
            //                             value="${item.jml_permintaan}" style="width:60px">
            //                         <button class="btn btn-sm btn-light plus">+</button>
            //                     </div>
            //                 </td>

            //                 <td class="text-end subtotal">
            //                     Rp ${formatRupiah(subtotal)}
            //                 </td>

            //                 <td class="text-end">
            //                     <button class="btn btn-sm btn-danger hapus">
            //                         <i class="ti ti-trash"></i>
            //                     </button>
            //                 </td>

            //                 <input type="hidden" class="harga" value="${item.harga_barang}">
            //                 <input type="hidden" class="id_barang" value="${item.id_barang}">
            //                 <input type="hidden" class="ket" value="${item.ket ?? ''}">
            //             </tr>
            //             `;
            //         });

            //         // TOTAL
            //         html += `
            //         <tr>
            //             <td colspan="5"></td>
            //             <td class="text-end fw-bold">
            //                 Total: Rp <span id="grandTotal">${formatRupiah(totalAll)}</span>
            //             </td>
            //             <td></td>
            //         </tr>
            //         `;

            //         $('#tampil-keranjang').html(html);

            //     } else {
            //         iziToast.warning({
            //             message: 'Keranjang kosong'
            //         });
            //     }
            // });
        }

        // Hapus Riwayat
        function hapusPengadaan(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Hapus Pengadaan ID : ' + id,
                icon: 'warning',
                reverseButtons: false,
                showDenyButton: false,
                showCloseButton: false,
                showCancelButton: true,
                focusCancel: true,
                confirmButtonColor: '#FF4845',
                confirmButtonText: `<i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus`,
                cancelButtonText: `<i class="fa fa-times me-1" style="font-size:13px"></i> Batal`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: `/api/v4/administrasi/pengadaan/riwayat/${id}/hapus`,
                        type: 'DELETE',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Pesan Sukses!',
                                message: 'Hapus Riwayat berhasil pada ' + res,
                                position: 'topRight'
                            });
                            // $('#riwayatPengadaan').modal('hide');
                        }, complete: function() {
                            bukaRiwayatPengadaan();
                        }, error: function(xhr, status, error) {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: xhr.responseJSON.message ?? 'Proses Hapus riwayat pengadaan tidak berhasil dilakukan. Silakan ulangi sekali lagi.',
                                position: 'topRight'
                            });
                        }
                    });
                }
            })
        }

        // FUNCTION REKAP
        function rekapBtn() {
            // var unit = $("#unit_cari").val();
            var bulan = $("#bulan_all").val();
            var tahun = $("#tahun_all").val();
            var kategori = $("#kategori").val();

            if (bulan != 'Pilih Bulan' && tahun != 'Pilih Tahun' && kategori != 'Pilih Kategori') {
                $('#submit_filterAll').prop('disabled', false).removeClass('btn-secondary').addClass('btn-primary');
            }
        }
        function pushDataRekap() {
            $("#rekap").one('submit', function() {
                //stop submitting the form to see the disabled button effect
                let x = document.forms["formRekap"]["bulan"].value;
                let y = document.forms["formRekap"]["tahun"].value;
                let z = document.forms["formRekap"]["kategori"].value;
                if (x == "" || y == "" || z == "") {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Mohon lengkapi semua isian',
                        position: 'topRight'
                    });
                    return false;
                } else {
                    $("#submit_filterAll").attr('disabled','disabled');
                    $("#submit_filterAll").find("i").removeClass("fa-filter").addClass("fa-sync fa-spin");
                    return true;
                }
            });
        }
    </script>
@endsection
