@extends('layouts.v4')

@section('content')
    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Pengajuan <b class="text-primary link-underline-primary text-decoration-underline">Perbaikan IT</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">IT</a>
                    </li>
                    <li class="breadcrumb-item pe-none" aria-current="page">
                        Tiket Pengajuan
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Perbaikan IT
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12">

                <div class="row" id="dashboardCards">

                    <div class="col-xl-3 col-lg-6">
                        <div class="card custom-card dashboard-main-card info" data-card="diterima">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="flex-fill">
                                        <h6 class="mb-2 fs-12">Pengaduan Diterima</h6>
                                        <div>
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <h4 class="fw-medium mb-0">
                                                    <span class="count-up" data-count="0">0</span>
                                                </h4>
                                                <span class="badge bg-info badge-month">Diterima</span>
                                            </div>
                                            <p class="text-muted fs-11 mb-0 lh-1">
                                                <span class="percent text-info me-1 fw-medium">
                                                    <i class="ri-subtract-line me-1 align-middle"></i>0%
                                                </span>
                                                <span>Bulan Ini</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="avatar avatar-lg bg-info-transparent mb-3 svg-info mx-auto">
                                        <!-- SVG tetap -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M200,75.64V40a16,16,0,0,0-16-16H72A16,16,0,0,0,56,40V76a16.07,16.07,0,0,0,6.4,12.8L114.67,128,62.4,167.2A16.07,16.07,0,0,0,56,180v36a16,16,0,0,0,16,16H184a16,16,0,0,0,16-16V180.36a16.09,16.09,0,0,0-6.35-12.77L141.27,128l52.38-39.59A16.09,16.09,0,0,0,200,75.64ZM184,40V64H72V40Zm0,176H72V180l56-42,56,42.35Z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card custom-card dashboard-main-card warning" data-card="dikerjakan">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="flex-fill">
                                        <h6 class="mb-2 fs-12">Pengaduan Dikerjakan</h6>
                                        <div>
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <h4 class="fw-medium mb-0">
                                                    <span class="count-up" data-count="0">0</span>
                                                </h4>
                                                <span class="badge bg-warning badge-month">Dikerjakan</span>
                                            </div>
                                            <p class="text-muted fs-11 mb-0 lh-1">
                                                <span class="percent text-warning me-1 fw-medium">
                                                    <i class="ri-subtract-line me-1 align-middle"></i>0%
                                                </span>
                                                <span>Bulan Ini</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="avatar avatar-lg bg-warning-transparent mb-3 svg-warning mx-auto">
                                        <!-- SVG tetap -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M100,116.43a8,8,0,0,0,4-6.93v-72A8,8,0,0,0,93.34,30,104.06,104.06,0,0,0,25.73,147a8,8,0,0,0,4.52,5.81,7.86,7.86,0,0,0,3.35.74,8,8,0,0,0,4-1.07ZM88,49.62v55.26L40.12,132.51C40,131,40,129.48,40,128A88.12,88.12,0,0,1,88,49.62ZM232,128A104,104,0,0,1,38.32,180.7a8,8,0,0,1,2.87-11L120,123.83V32a8,8,0,0,1,8-8,104.05,104.05,0,0,1,89.74,51.48c.11.16.21.32.31.49s.2.37.29.55A103.34,103.34,0,0,1,232,128Z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card custom-card dashboard-main-card success" data-card="selesai">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="flex-fill">
                                        <h6 class="mb-2 fs-12">Pengaduan Diselesaikan</h6>
                                        <div>
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <h4 class="fw-medium mb-0">
                                                    <span class="count-up" data-count="0">0</span>
                                                </h4>
                                                <span class="badge bg-success border badge-month">Selesai</span>
                                            </div>
                                            <p class="text-muted fs-11 mb-0 lh-1">
                                                <span class="percent text-success me-1 fw-medium">
                                                    <i class="ri-subtract-line me-1 align-middle"></i>0%
                                                </span>
                                                <span>Bulan Ini</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="avatar avatar-lg bg-success-transparent mb-3 svg-success mx-auto">
                                        <!-- SVG tetap -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm45.66,85.66-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35a8,8,0,0,1,11.32,11.32Z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card custom-card dashboard-main-card danger" data-card="ditolak">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="flex-fill">
                                        <h6 class="mb-2 fs-12">Pengaduan Ditolak</h6>
                                        <div>
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <h4 class="fw-medium mb-0">
                                                    <span class="count-up" data-count="0">0</span>
                                                </h4>
                                                <span class="badge bg-danger badge-month">Ditolak</span>
                                            </div>
                                            <p class="text-muted fs-11 mb-0 lh-1">
                                                <span class="percent text-danger me-1 fw-medium">
                                                    <i class="ri-subtract-line me-1 align-middle"></i>0%
                                                </span>
                                                <span>Bulan Ini</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="avatar avatar-lg bg-danger-transparent mb-3 svg-danger mx-auto">
                                        <!-- SVG tetap -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M216,40H40A16,16,0,0,0,24,56V208a8,8,0,0,0,11.58,7.15L64,200.94l28.42,14.21a8,8,0,0,0,7.16,0L128,200.94l28.42,14.21a8,8,0,0,0,7.16,0L192,200.94l28.42,14.21A8,8,0,0,0,232,208V56A16,16,0,0,0,216,40ZM176,144H80a8,8,0,0,1,0-16h96a8,8,0,0,1,0,16Zm0-32H80a8,8,0,0,1,0-16h96a8,8,0,0,1,0,16Z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">
                        <div class="card custom-card card-bg-light mb-3">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    <i class="ri-add-box-line me-1"></i> Buat <b class="text-pink">Tiket</b>
                                </div>
                                <div class="d-flex">
                                    {{-- <button class="btn btn-sm btn-primary btn-wave waves-light"><i class="ri-add-line fw-medium align-middle me-1"></i> Buat Sekarang</button> --}}
                                    {{-- <div class="dropdown ms-2">
                                        <button class="btn btn-icon btn-secondary-light btn-sm btn-wave waves-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);">New Tasks</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Pending Tasks</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Completed Tasks</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Inprogress Tasks</a></li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group mb-3">
                                            <label for="judulTiket" class="form-label">Judul Permasalahan <b class="text-danger">*</b></label>
                                            <input type="text" class="form-control form-control-sm" id="judul" spellcheck=false autocomplete="off"
                                                autocapitalize="off" placeholder="Masukkan judul permasalahan..." disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="kategoriTiket" class="form-label">Kategori <b class="text-danger">*</b></label>
                                            <select id="kategori" class="form-control form-control-sm select2" disabled>
                                                <option value="" selected disabled>Pilih kategori...</option>
                                                @if ($kategori->isNotEmpty())
                                                    @foreach ($kategori as $k)
                                                        <option value="{{ $k->id }}">{{ $k->deskripsi ?? $k->nama }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="deskripsiTiket" class="form-label">Deskripsi Masalah <b class="text-danger">*</b></label>
                                            <textarea class="form-control form-control-sm" id="deskripsi" rows="3" placeholder="Jelaskan masalah yang Anda alami..." disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <button id="btn-reset" class="btn btn-sm btn-secondary btn-wave waves-light" onclick="resetForm()" disabled>
                                        <i class="ri-refresh-line fw-medium align-middle me-1"></i> Reset Form
                                    </button>
                                    <button id="btn-submit" class="btn btn-sm btn-primary btn-wave waves-light me-2" onclick="buatTiket()" disabled>
                                        <i class="ri-add-line fw-medium align-middle me-1"></i> Buat Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    <i class="ri-table-line me-1"></i> Daftar <b class="text-primary">Tiket</b>
                                </div>
                                <button id="btn-refresh" class="btn btn-sm btn-warning btn-wave waves-light" onclick="refresh()">
                                    <i class="ri-refresh-line fw-medium align-middle me-1"></i> Refresh
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dttable" class="table dt-responsive table-hover nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th class="cell-fit text-center">ID TIKET</th>
                                                <th class="cell-fit">JUDUL</th>
                                                <th class="cell-fit">DESKRIPSI</th>
                                                <th class="cell-fit">STATUS</th>
                                                <th class="cell-fit">TGL PENGADUAN</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tampil-tbody">
                                            <tr>
                                                <td colspan="5">
                                                    <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="cell-fit text-center">ID TIKET</th>
                                                <th class="cell-fit">JUDUL</th>
                                                <th class="cell-fit">DESKRIPSI</th>
                                                <th class="cell-fit">STATUS</th>
                                                <th class="cell-fit">TGL PENGADUAN</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="buatTiket" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Buat Tiket</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="row gy-2">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div> --}}

    <script>
        $(document).ready(function() {
            // SELECT2
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    allowClear: true,
                    dropdownParent: e.parent()
                })
            });

            refresh();
        });

        function initAutoComplete(dataSource) {
            new autoComplete({
                selector: "#judul",
                placeHolder: "Masukkan judul permasalahan...",
                data: {
                    src: dataSource,
                    cache: true,
                },
                resultItem: {
                    highlight: true
                },
                events: {
                    input: {
                        selection: (event) => {
                            const selection = event.detail.selection.value;
                            document.querySelector("#judul").value = selection;
                        }
                    }
                }
            });
        }

        function updateCard(key, item) {

            const card = document.querySelector(`[data-card="${key}"]`);
            if (!card) return;

            card.querySelector('.count-up').innerText = item.total;

            const percentEl = card.querySelector('.percent');
            if (!percentEl) return;

            percentEl.classList.remove('text-success', 'text-danger');

            let arrowClass = '';
            let colorClass = '';

            if (item.is_up) {
                arrowClass = 'ri-arrow-up-s-line';
                colorClass = 'text-success';
            } else {
                arrowClass = 'ri-arrow-down-s-line';
                colorClass = 'text-danger';
            }

            percentEl.classList.add(colorClass);

            percentEl.innerHTML = `
                <i class="${arrowClass} me-1 align-middle"></i>
                ${Math.abs(item.percent)}%
            `;
        }

        function updateDashboardCards(data) {

            if (!data) return;

            document.querySelectorAll('.dashboard-main-card').forEach(card => {

                let key = card.getAttribute('data-card'); // diterima, dikerjakan, dst

                if (data[key]) {

                    let item = data[key];

                    let total   = item.total ?? 0;
                    let percent = item.percent ?? 0;
                    let isUp    = item.is_up ?? true;

                    let countEl   = card.querySelector('.count-up');
                    let percentEl = card.querySelector('.percent');

                    // Update total
                    countEl.innerText = total;
                    countEl.setAttribute('data-count', total);

                    // Update percent
                    let iconClass = isUp
                        ? 'ri-arrow-up-s-line'
                        : 'ri-arrow-down-s-line';

                    percentEl.innerHTML = `
                        <i class="${iconClass} me-1 align-middle"></i>
                        ${percent}%
                    `;
                }

            });
        }

        function refresh() {
            if ($.fn.DataTable.isDataTable('#dttable')) {
                $('#dttable').DataTable().clear().destroy();
            }
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="5"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );

            const btn = $('#btn-refresh');

            $.ajax({
                url: "/api/v4/it/pengajuan/tiket/table",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function () {
                    btn.prop('disabled', true)
                        .find('i')
                        .addClass('fa-spin');
                },
                success: function(res) {

                    updateDashboardCards(res.summary);

                    $("#tampil-tbody").empty();
                    let judulList = []; // reset judul list setiap refresh

                    res.show.forEach(item => {
                        if (item.title) {
                            judulList.push(item.title.trim()); // untuk autocomplete nanti
                        }

                        /* ======================
                        BADGE
                        ====================== */
                        let updated = moment(item.updated_at).local().format('YYYY-MM-DD HH:mm:ss');

                        nama_lengkap = '';
                        if (item.nama_lengkap_user) {
                            nama_lengkap = item.nama_lengkap_user;
                        } else if (item.nama_user) {
                            nama_lengkap = item.nama_user;
                        } else if (item.nama) {
                            nama_lengkap = item.nama;
                        } else {
                            nama_lengkap = '-';
                        }

                        let status = '';
                        if (item.tgl_tolak) {
                            status = '<span class="badge bg-danger-transparent fs-16">Ditolak</span>';
                        } else if (item.tgl_selesai) {
                            status = '<span class="badge bg-success-transparent fs-16">Selesai</span>';
                        } else if (item.tgl_kerjakan) {
                            status = '<span class="badge bg-warning-transparent fs-16">Diproses</span>';
                        } else if (item.tgl_terima) {
                            status = '<span class="badge bg-info-transparent fs-16">Diterima</span>';
                        } else {
                            status = '<span class="badge bg-secondary-transparent fs-16">Pending</span>';
                        }

                        let kategori = '';
                        let nama_kategori = item.kategori.nama ?? '-';
                        if (item.kategori.id == 1) {
                            kategori = '<span class="badge bg-primary ms-1">' + nama_kategori + '</span>';
                        } else if (item.kategori.id == 2) {
                            kategori = '<span class="badge bg-secondary ms-1">' + nama_kategori + '</span>';
                        } else if (item.kategori.id == 3) {
                            kategori = '<span class="badge bg-success ms-1">' + nama_kategori + '</span>';
                        } else if (item.kategori.id == 4) {
                            kategori = '<span class="badge bg-warning ms-1">' + nama_kategori + '</span>';
                        } else {
                            kategori = '<span class="badge bg-secondary ms-1">' + nama_kategori + '</span>';
                        }

                        let unit = '';
                        if (item.unit) {
                            let units = item.unit;

                            // Kalau masih string JSON → parse dulu
                            if (typeof units === 'string') {
                                try {
                                    units = JSON.parse(units);
                                } catch (e) {
                                    units = [units]; // fallback kalau bukan JSON valid
                                }
                            }

                            if (Array.isArray(units)) {
                                unit = units
                                    .map(u => res.roles[u] ?? u)
                                    .join(', ');
                            }
                        }

                        let content = `
                            <tr>
                                <td>
                                    <a href="javascript:void(0);" class='link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle'
                                        data-bs-toggle='dropdown' aria-expanded='false'>${item.tiket_id}
                                    </a>
                                    <ul class='dropdown-menu dropdown-menu-end'>
                                        <li><a href='javascript:void(0);' class='dropdown-item text-info' onclick="perbaruiStatus(${item.id})">
                                            <i class="fa-fw fas fa-edit nav-icon me-1"></i> Perbarui Status</a></li>
                                        <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(${item.id})">
                                            <i class="fa-fw fas fa-trash nav-icon me-1"></i> Hapus</a></li>
                                    </ul>
                                </td>
                                <td style='white-space: normal !important;word-wrap: break-word;'>
                                    <div class='d-flex justify-content-start align-items-center'>
                                        <div class='d-flex flex-column'>
                                            <h6 class='mb-0 text-truncate text-primary'>
                                                <a href='javascript:void(0);' data-bs-toggle='tooltip' data-bs-placement='bottom' data-bs-html='true' title='Lihat Detail Pengaduan'><u>${item.title}</u> ${kategori}</a>
                                            </h6>
                                            <small class='text-truncate text-muted'>Diajukan Oleh ${nama_lengkap}</small>
                                            <small class='text-truncate text-muted fs-10'><i>${unit ?? ''}</i></small>
                                        </div>
                                    </div>
                                </td>
                                <td style='white-space: normal !important;word-wrap: break-word;'>
                                    <div class='d-flex justify-content-start align-items-center'>
                                        <div class='d-flex flex-column'>
                                            <h6 class='mb-0 text-truncate fs-14'>
                                                ${item.ket_pengaduan}
                                            </h6>
                                            <figcaption class="blockquote-footer mt-0 mb-0 text-muted op-7">
                                                <cite data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Tanggal Pengaduan">${item.tgl_pengaduan}</cite>
                                            </figcaption>
                                        </div>
                                    </div>
                                </td>
                                <td>${status}</td>
                                <td class="text-start">${updated}</td>
                            </tr>
                        `;

                        $('#tampil-tbody').append(content);

                        /* TOOLTIP */
                        $('[data-bs-toggle="tooltip"]').tooltip();
                    });

                    $('#dttable').DataTable({
                        order: [4,"desc"],
                        displayLength: 7,
                        lengthMenu: [7,15,25,50,100,300,500],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '10%' },
                            { sWidth: '20%' },
                            { sWidth: '50%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                        ],
                    });

                    // AUTOCOMPLETE INPUT JUDUL
                    // remove duplicate (ignore case)
                    judulList = judulList.filter((value, index, self) =>
                        index === self.findIndex(v => v.toLowerCase() === value.toLowerCase())
                    );

                    initAutoComplete(judulList);

                    $('#judul').prop('disabled', false);
                    $('#kategori').prop('disabled', false);
                    $('#deskripsi').prop('disabled', false);
                    $('#btn-submit').prop('disabled', false);
                    $('#btn-reset').prop('disabled', false);
                },
                error: function (xhr) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON?.message ?? 'Terjadi kesalahan / Gagal memanggil Function',
                        position: 'topRight'
                    });
                },
                complete: function () {
                    // always reset button (baik success maupun error)
                    btn.prop('disabled', false)
                        .find('i')
                        .removeClass('fa-spin');
                }
            })
        }

        function buatTiket() {
            let btn = $('#btn-submit');

            btn.prop('disabled', true)
                .find('i')
                .removeClass('ri-add-line')
                .addClass('ri-loader-line fa-spin');

            let data = {
                title: $('#judul').val(),
                kategori: $('#kategori').val(),
                ket_pengaduan: $('#deskripsi').val()
            };

            let formData = new FormData();
            for (let key in data) {
                formData.append(key, data[key]);
            }

            $.ajax({
                url: "/api/v4/it/pengajuan/tiket/kirim", // API WA Baileysid
                type: "POST",
                data: formData,
                processData:false,
                contentType:false,
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if(response.telegram_sent === false){
                        iziToast.warning({
                            title: 'Tiket berhasil dibuat',
                            message: 'Notifikasi Telegram gagal dikirim, silakan hubungi IT untuk memastikan tiket Anda diproses.',
                        });
                        return;
                    }

                    iziToast.success({
                        title: 'Pesan Berhasil!',
                        message: response.data,
                        position: 'topRight'
                    });

                    resetForm();
                },
                error: function (xhr) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON?.message ?? 'Terjadi kesalahan / Gagal memanggil Function',
                        position: 'topRight'
                    });
                },
                complete: function () {
                    // always reset button (baik success maupun error)
                    btn.prop('disabled', false)
                        .find('i')
                        .removeClass('ri-loader-line fa-spin')
                        .addClass('ri-add-line');

                    refresh();
                }
            })
        }

        function hapus(id) {

            if (!confirm('Yakin ingin menghapus Tiket Perbaikan ini?')) return;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/v4/it/pengajuan/tiket/${id}/hapus`,
                type: "DELETE",
                success: function(res) {
                    iziToast.success({
                        title: 'Sukses',
                        message: res.message
                    });
                },
                error: function(err) {
                    iziToast.error({
                        message: err.responseJSON.message
                    });
                },
                complete: function () {
                    refresh();
                }
            });

        }

        function resetForm() {
            $('#judul').val('');
            $('#kategori').val('').change();
            $('#deskripsi').val('');
        }
    </script>
@endsection
