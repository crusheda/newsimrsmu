@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    <b class="text-primary">Detail</b> - Perbaikan <b class="text-orange link-underline-orange text-decoration-underline">IPSRS</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Publik</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('v4.publik.ipsrs.perbaikan') }}" role="button">Perbaikan IPSRS</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Detail Perbaikan
                    </li>
                </ol>
            </div>
        </div>

        <!-- [ Main Content ] start -->
        <div class="row pt-1">
            <div class="col-md-4">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between border border-0 py-3">
                        <div class=" flex-grow-1">
                            <div class="btn-group">
                                <button class="btn btn-teal-transparent" onclick="window.location='{{ route('v4.publik.ipsrs.perbaikan') }}'">
                                    <i class="ti ti-arrow-back-up me-1"></i> Kembali</button>
                            </div>
                        </div>
                        {{-- <h5 class="mb-0 card-title flex-shrink-0 float-end"></h5> --}}
                        <div class="btn-group dropend" hidden>
                            <a href="javascript:void(0);" class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical f-18"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    {{-- <a class="dropdown-item" href="javascript:void(0);" onclick="showKategori()">Daftar Kategori</a> --}}
                                </li>
                            </ul>
                        </div>
                        {{-- <div class="dropdown ms-2 dropend">
                            <a class="text-muted btn-icon" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti ti-dots-vertical font-size-18"></i>
                            </a>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);">#</a>
                                <a class="dropdown-item" href="javascript:void(0);">#</a>
                                <a class="dropdown-item" href="javascript:void(0);">#</a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-body border-top">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-4">
                                <span class="avatar">
                                    @if (empty($list['fotouser']->filename))
                                        <img src="{{ asset('images/pku/user.png') }}" alt="Header Avatar">
                                    @else
                                        <img src="{{ url('storage/'.substr($list['fotouser']->filename,7,1000)) }}" alt="Header Avatar">
                                    @endif
                                </span>
                            </div>
                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                <div class="text-start">
                                    <h6 class="mb-1 fs-17">Pengaduan ID <b class="text-primary">#{{ $list['show']->id }}</b></h6>
                                    <h6 class="mb-0 fs-12" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom"
                                        data-bs-html="true" title="{{ $list['show']->tgl_pengaduan }}">{{ \Carbon\Carbon::parse($list['show']->tgl_pengaduan)->diffForHumans() }}</h6>
                                </div>
                                <div class="text-end text-muted">
                                    {{-- <h6 class="mb-1 fs-17">Dia<b class="text-warning">{{ $list['show']->tgl_pengaduan }}</b></h6>
                                    <h6 class="mb-0 fs-12" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom"
                                        data-bs-html="true" title="{{ $list['show']->tgl_pengaduan }}">{{ \Carbon\Carbon::parse($list['show']->tgl_pengaduan)->diffForHumans() }}</h6> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <div class="text-muted">
                            <div class="mb-2 d-flex align-items-center gap-1 flex-wrap">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-shield-user-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    Nama Pelapor :
                                </span>
                                <a>{{ $list['show']->nama_user }}</a>
                            </div>
                            <div class="mb-2 d-flex align-items-center gap-1 flex-wrap">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-group-2-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    Jabatan :
                                </span>
                                <a>
                                    {{ $list['user']->roles->pluck('deskripsi')->implode(', ') }}
                                </a>
                            </div>
                            <div class="mb-0 d-flex align-items-center gap-1">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-phone-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    No.HP :
                                </span>
                                @php
                                    $wa = preg_replace('/[^0-9]/', '', $list['show']->hp);

                                    if (substr($wa, 0, 1) === '0') {
                                        $wa = '62' . substr($wa, 1);
                                    }
                                @endphp

                                <a href="https://wa.me/{{ $wa }}" target="_blank" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline">
                                    {{ $list['show']->hp }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-top text-dark">
                        <h6 class="fw-semibold mb-2 text-warning"><i class="ti ti-arrow-narrow-right"></i> Lokasi</h6>
                        <p class="mb-0">{{ $list['show']->lokasi }}</p>
                    </div>
                    <div class="card-body border-top text-dark">
                        <h6 class="fw-semibold mb-2 text-primary"><i class="ti ti-arrow-narrow-right"></i> Deskripsi Laporan</h6>
                        <p class="mb-0">{{ $list['show']->ket_pengaduan }}</p>
                    </div>
                    @if (!empty($list['show']->filename_pengaduan))
                        <div class="card-body border-top">
                            <center>
                                <a class="image-popup-no-margins" href="{{ url('storage/' . substr($list['show']->filename_pengaduan, 7, 1000)) }}"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Klik untuk lihat lampiran">
                                    <img class="img-fluid" alt="" src="{{ url('storage/' . substr($list['show']->filename_pengaduan, 7, 1000)) }}">
                                </a>
                                <button class="btn btn-success-transparent" onclick="window.location.href='{{ url('/v4/publik/perbaikan/ipsrs/' . $list['show']->id) }}'">
                                    <i class="fas fa-download me-1"></i> Unduh
                                </button>
                            </center>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="card custom-card">
                    {{-- <div class="card-header align-middle bg-transparent border-bottom">
                        <div class="d-flex flex-wrap align-items-start">
                            <div class="me-2">
                                <h6 class="card-title mt-1 mb-0">Proses Pengaduan</h6>
                            </div>
                            <div class="hstack gap-3 ms-auto">

                            </div>
                        </div>
                    </div> --}}
                    <div class="row card-body">
                        <div class="col-md-12 order-md-0 order-0">
                            <!-- VERIFYING -->
                            @if ($list['show']->tgl_diterima == null &&
                                $list['show']->tgl_dikerjakan == null &&
                                $list['show']->tgl_selesai == null &&
                                $list['show']->ket_penolakan == null)
                                <div class="alert alert-light shadow-sm mb-3" role="alert">
                                    <h6 class="mb-0">Verifying</h6>
                                    <small>Proses Verifikasi Laporan menjadi Status <span class="badge bg-info">DITERIMA</span></small>
                                </div>
                                <div class="row g-3">
                                    <div class="form-group">
                                        <label for="defaultFormControlInput" class="form-label">Tuliskan Keterangan <b class="text-danger">Tolak</b> / <b class="text-primary">Terima</b> Laporan <a class="text-danger">*</a></label>
                                        <div class="form-group">
                                            <textarea rows="2" class="autosize1 form-control" name="ket" id="ket"
                                                placeholder="Tuliskan Keterangan" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <a class="btn btn-danger" href="javascript:void(0);"
                                            onclick="tolak({{ $list['show']->id }})">
                                            <i class="fas fa-thumbs-down"></i>
                                            <span class="align-middle d-sm-inline-block d-none">&nbsp;Tolak</span>
                                        </a>
                                        <a class="btn btn-primary" href="javascript:void(0);"
                                            onclick="terima({{ $list['show']->id }})">
                                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Terima&nbsp;</span>
                                            <i class="fas fa-thumbs-up"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <!-- PROCESSING -->
                            @if ($list['show']->tgl_diterima != null &&
                                $list['show']->tgl_dikerjakan == null &&
                                $list['show']->tgl_selesai == null &&
                                $list['show']->ket_penolakan == null)
                                <div class="alert alert-light shadow-sm mb-3">
                                    <h6 class="mb-0">Processing</h6>
                                    <small>Proses Pengerjaan Laporan menjadi status <span class="badge bg-warning">DIKERJAKAN</span></small>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="defaultFormControlInput" class="form-label">Keterangan Awal Pengerjaan <a class="text-danger">*</a></label>
                                            <div class="form-group">
                                                <textarea rows="3" class="autosize1 form-control" id="ket_pengerjaan" placeholder="Masukkan Keterangan Awal Pengerjaan" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <div class="form-group">
                                            <label for="defaultFormControlInput" class="form-label">Estimasi Penyelesaian (<b class="text-warning">Optional</b>)</label>
                                            <div class="form-group mb-2">
                                                <input type="text" class="form-control" placeholder="Tambahkan Estimasi Waktu" id="estimasi" />
                                            </div>
                                            <sub><strong>Nb. </strong>Untuk menambahkan <b class="text-orange">Catatan Pengerjaan</b> pada Sub Halaman Selanjutnya, Silakan klik <b class="text-warning">Kerjakan</b> di bawah ini.</sub>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-warning" onclick="kerjakan({{ $list['show']->id }})">
                                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Mulai Kerjakan </span>
                                            <i class="fas fa-wrench"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            <!-- FINISHING -->
                            @if ($list['show']->tgl_diterima != null &&
                                $list['show']->tgl_dikerjakan != null &&
                                $list['show']->tgl_selesai == null &&
                                $list['show']->ket_penolakan == null)
                                <div class="alert alert-light shadow-sm mb-3">
                                    <h6 class="mb-0">Finishing</h6>
                                    <small>Proses Penyelesaian Laporan Pengaduan IPSRS menjadi status <span class="badge bg-success">SELESAI</span></small>
                                </div>
                                <div class="row g-3">
                                    <div class="form-group">
                                        <label for="defaultFormControlInput" class="form-label">Keterangan Laporan Selesai <a class="text-danger">*</a></label>
                                        <div class="form-group">
                                            <textarea rows="2" class="autosize1 form-control" id="ket_selesai"
                                                placeholder="Tuliskan Keterangan untuk Laporan Selesai" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-warning-transparent btn-wave" data-bs-toggle="modal" data-bs-target="#catatan">
                                            <i class="ti ti-note me-1"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Catatan Pengerjaan</span>
                                        </button>
                                        <button class="btn btn-success btn-wave"
                                            onclick="selesai({{ $list['show']->id }})"><i class="ti ti-checks me-1"></i> Laporan Selesai</button>
                                    </div>
                                </div>
                            @endif
                            <!-- RESULT -->
                            @if ($list['show']->tgl_selesai != null)
                                <div class="alert alert-light shadow-sm mb-3">
                                    <h6 class="mb-0">Result</h6>
                                    <small>Hasil Laporan Pengerjaan IPSRS</small>
                                </div>
                                <h5 class="text-center mb-3">Hasil Akhir Laporan</h5>
                                <div class="row g-3" id="tampil-result"><center><i class="fas fa-sync fa-spin me-1"></i> Memuat hasil laporan...</center></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL START --}}
    <div class="modal fade" id="catatan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Catatan Pengerjaan Laporan <small><b class="text-primary">ID : {{ $list['show']->id }}</b></small></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="{{ route('v4.publik.ipsrs.perbaikan.catatan', $list['show']->id) }}"
                            method="POST"
                            enctype="multipart/form-data"
                            id="formCatatan">
                            @csrf
                            <input type="text" name="id_pengaduan" value="{{ $list['show']->id }}" hidden>
                            <div class="form-group mb-3">
                                <label for="defaultFormControlInput" class="form-label"><i class="ti ti-arrow-narrow-right text-primary me-1"></i> Tambah Catatan <a class="text-danger">*</a></label>
                                <textarea rows="3" class="autosize1 form-control" name="ket_catatan" id="ket_catatan"
                                    placeholder="e.g. Pengerjaan membutuhkan waktu dikarenakan terdapat beberapa komponen yang harus dibeli terlebih dahulu" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="defaultFormControlInput" class="form-label"><i class="ti ti-arrow-narrow-right text-primary me-1"></i> Lampiran (<b class="text-warning">Optional</b>) : </label>
                                <input type="file" name="file" id="imgInp" class="form-control">
                            </div>
                            <div class="col-12 d-flex justify-content-between mb-3">
                                <h6><sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Disarankan untuk menyertakan
                                        lampiran foto</sub></h6>
                                <button type="submit" class="btn btn-primary" id="btn-simpan-catatan"><i
                                        class="fa fa-save"></i>&nbsp;&nbsp;Tambah</button>
                            </div>
                        </form>
                        <hr>
                        <h6 class="fs-14">&nbsp;<i class="ti ti-arrow-narrow-right text-primary"></i> Daftar Catatan</h6>
                        <div class="table-responsive" style="border: 0px">
                            <table id="dikerjakan" class="table dt-responsive table-striped table-hover w-100 align-middle">
                                <thead>
                                    <tr>
                                        <th>Keterangan</th>
                                        <th>File</th>
                                        <th>Tgl</th>
                                        <th>
                                            <center>AKSI</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody style="text-transform: capitalize;font-size:13px">
                                    @if (count($list['catatan']) > 0)
                                        @foreach ($list['catatan'] as $val)
                                            <tr>
                                                <td>{{ $val->keterangan }}</td>
                                                <td>{{ $val->title }}</td>
                                                <td>{{ $val->created_at }}</td>
                                                <td>
                                                    <center>
                                                        <div class="btn-group">
                                                            {{-- Tombol Ubah --}}
                                                            <button type="button" class="btn btn-warning btn-sm"
                                                                data-bs-target="#ubahCatatan{{ $val->id }}"
                                                                data-bs-toggle="modal" data-bs-dismiss="modal"><i
                                                                    class="fa-fw fas fa-edit nav-icon"></i></button>
                                                            {{-- Tombol Download --}}
                                                            @if (!empty($val->title))
                                                                <button class="btn btn-success btn-sm"
                                                                    onclick="window.location.href='{{ url('/v4/publik/perbaikan/ipsrs/catatan/' . $val->id) }}'"><i
                                                                        class="fa-fw fas fa-download nav-icon"></i></button>
                                                            @else
                                                                <button class="btn btn-secondary btn-sm" disabled><i
                                                                        class="fa-fw fas fa-download nav-icon"></i></button>
                                                            @endif
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="9"><center>Belum ada catatan</center></td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i
                            class="fas fa-caret-left nav-icon me-1"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @foreach ($list['catatan'] as $item)
        <div class="modal fade" id="ubahCatatan{{ $item->id }}" data-bs-backdrop="static" aria-hidden="true"
            aria-labelledby="modalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modalToggleLabel2">Ubah Catatan <small><kbd>ID :
                                    {{ $item->id }}</kbd></small></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('v4.publik.ipsrs.perbaikan.ubahCatatan', $list['show']->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id_catatan" value="{{ $item->id }}" hidden>
                        <div class="form-group mb-3">
                            <label for="defaultFormControlInput" class="form-label">Catatan</label>
                            <textarea rows="3" class="autosize1 form-control" name="ket_catatan" placeholder="Masukkan Catatan" required><?php echo htmlspecialchars($item->keterangan); ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="defaultFormControlInput" class="form-label">Lampiran (Optional) : </label>
                            <input type="file" name="file" id="imgInp" class="form-control">
                        </div>
                        <h6><sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Disarankan untuk menyertakan lampiran
                                foto</sub></h6>
                    </form>
                    <div class="modal-footer">
                        <a class="btn btn-outline-secondary" href="javascript:void(0);" data-bs-target="#catatan"
                            data-bs-toggle="modal" data-bs-dismiss="modal"><i
                                class="fas fa-chevron-left"></i>&nbsp;&nbsp;Kembali</a>
                        <button class="btn btn-primary" type="submit"><i
                                class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- MODAL END --}}

    <script>
        $(document).ready(function() {

            $.ajax({
                url: "/api/v4/publik/perbaikan/ipsrs/result/{{ $list['show']->id }}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // Tampil Result setelah Selesai Laporan
                    $("#tampil-result").empty();
                    if (res.show[0].ket_penolakan == null) {
                        res.show.forEach(item => {
                            content = `<div class="col-md-8">
                            <small class="text-muted text-uppercase fs-16"><i class="ti ti-corner-down-right me-1 text-info"></i> Diterima</small>
                            <ul class="list-unstyled mb-5 mt-1">
                                <li class="d-flex align-items-center mb-2 fs-18"><strong>` + item.ket_diterima + `</strong></li>
                                <li class="d-flex align-items-center fs-17"><sub>` + item.tgl_diterima + `</sub></li>
                            </ul>
                            <small class="text-muted text-uppercase fs-16"><i class="ti ti-corner-down-right me-1 text-warning"></i> Dikerjakan</small>
                            <ul class="list-unstyled mb-5 mt-1">
                                <li class="d-flex align-items-center mb-2 fs-18"><strong>` + item.ket_dikerjakan + `</strong></li>
                                <li class="d-flex align-items-center fs-17"><sub>` + item.tgl_dikerjakan + `</sub></li>
                            </ul>
                            <small class="text-muted text-uppercase fs-16"><i class="ti ti-corner-down-right me-1 text-success"></i> Selesai</small>
                            <ul class="list-unstyled mb-5 mt-1">
                                <li class="d-flex align-items-center mb-2 fs-18"><strong>` + item.ket_selesai + `</strong></li>
                                <li class="d-flex align-items-center fs-17"><sub>` + item.tgl_selesai + `</sub></li>
                            </ul>
                        </div>`;
                        })
                        content +=
                            `<div class="col-md-4"><small class="text-muted text-uppercase fs-16"><i class="ti ti-corner-down-right me-1 text-orange"></i> Catatan Pengerjaan</small>`;
                        res.catatan.forEach(item => {
                            content += `<ul class="list-unstyled mb-1 mt-3">
                                <li class="d-flex align-items-center mb-2 fs-18"><strong>` + item.keterangan + `</strong></li>
                                <li class="d-flex align-items-center mb-4 fs-17"><sub>` + item.updated_at + `</sub></li>
                            </ul>`;
                        })
                        content += `</div>`;
                    } else {
                        content = `<div class="col-md-12 mt-2">
                            <h5><b class="text-danger">Laporan Ditolak</b></h5>
                            <h6>Alasan Penolakan :</h6>
                            <h6><i class="ti ti-corner-down-right me-1 text-primary"></i> ` + res.show[0].ket_penolakan + `</h6>
                        </div>`;
                    }
                    $('#tampil-result').append(content);
                }
            });

            const l = document.querySelector("#estimasi");
            const c = new Date(Date.now() - 1728e5),
                m = new Date(Date.now());
            l.flatpickr({
                dateFormat: "Y-m-d",
                disable: [{
                    from: "2000-01-01",
                    to: m.toISOString().split("T")[0]
                }]
            })

            $("#formCatatan").one('submit', function() {
                //stop submitting the form to see the disabled button effect
                $("#btn-simpan-catatan").attr('disabled', 'disabled');
                $("#btn-simpan-catatan").find("i").toggleClass("fa-save fa-spinner fa-spin");

                return true;
            });
        });

        // FUNCTION-FUNCTION
        function terima(id) {
            var ket = $("#ket").val();
            if (ket == "") {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Keterangan Wajib Diisi',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/v4/publik/perbaikan/ipsrs/verif/' + id,
                    dataType: 'json',
                    data: {
                        id: id,
                        ket: ket,
                        user_id: '{{ Auth::user()->id }}',
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Verifikasi Laporan Berhasil Diterima pada ' + res,
                            position: 'topRight'
                        });
                        window.location.reload();
                    }
                });
            }
        }

        function tolak(id) {
            var ket = $("#ket").val();
            if (ket == "") {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Keterangan Wajib Diisi',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/v4/publik/perbaikan/ipsrs/unverif/' + id,
                    dataType: 'json',
                    data: {
                        id: id,
                        ket: ket,
                        user_id: '{{ Auth::user()->id }}',
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Verifikasi Laporan Berhasil Ditolak Oleh ' + res.name,
                            position: 'topRight'
                        });
                        window.location.reload();
                        // Tampil Result setelah Selesai Laporan
                        // $("#tampil-result").empty();
                        // content = `<div class="col-md-12 mt-4">
                        //   <h3><kbd style="background-color: red">Laporan Ditolak</kbd></h3>
                        //   <h5>Alasan Penolakan :</h5>
                        //   <h6><i class="fas fa-chevron-right"></i> ` + res.tolak + `</h6>
                        // </div>`;
                        // $('#tampil-result').append(content);
                    }
                });
            }
        }

        function kerjakan(id) {
            var ket_pengerjaan = $("#ket_pengerjaan").val();
            var estimasi = $("#estimasi").val();

            if (ket_pengerjaan == "") {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Keterangan Pengerjaan Wajib Diisi',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/v4/publik/perbaikan/ipsrs/process/' + id,
                    dataType: 'json',
                    data: {
                        id: id,
                        ket_pengerjaan: ket_pengerjaan,
                        estimasi: estimasi,
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Laporan Mulai Dikerjakan pada ' + res,
                            position: 'topRight'
                        });
                        window.location.reload();
                    }
                });
            }
        }

        function selesai(id) {
            var ket_selesai = $("#ket_selesai").val();

            if (ket_selesai == "") {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Keterangan Selesai Laporan Wajib Diisi',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/v4/publik/perbaikan/ipsrs/finish/' + id,
                    dataType: 'json',
                    data: {
                        id: id,
                        ket_selesai: ket_selesai,
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Selamat!',
                            message: 'Laporan Berhasil Diselesaikan Oleh ' + res.name,
                            position: 'topRight'
                        });
                        window.location.reload();
                    }
                });
            }
        }
    </script>
@endsection
