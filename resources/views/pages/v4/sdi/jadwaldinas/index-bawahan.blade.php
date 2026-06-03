@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Verifikasi <b class="text-primary link-underline-primary text-decoration-underline">Jadwal</b> <b class="text-info link-underline-info text-decoration-underline">Bawahan</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">SDI</a>
                    </li>
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Jadwal Dinas</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Bawahan
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <div class="btn-group">
                            <a href="{{ route('v4.sdi.jadwaldinas') }}" class="btn btn-secondary-transparent align-items-center" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Kembali ke Halaman Sebelumnya"><i class="ti ti-arrow-back-up me-2"></i> Kembali</a>
                            <button class="btn btn-warning-transparent" onclick="showRiwayat()" id="btn-refresh-jadwalBawahan" data-bs-toggle="tooltip"
                                data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Menampilkan Seluruh Jadwal Dinas Bawahan">
                                <i class="fas fa-sync f-20 me-2"></i> Tampilkan Semua Data
                            </button>
                        </div>
                        <div>
                            <div class="input-group">
                                <input type="month" class="form-control" value="" placeholder="Pilih Bulan & Tahun" id="filterBulan" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Pilih Bulan & Tahun"/>
                                <button class="btn btn-outline-info" onclick="showRiwayat($('#filterBulan').val())" id="btn-cari" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" id="btn-refresh-jadwalBawahanFilter"
                                    title="Filter Jadwal Dinas Bawahan Berdasarkan Bulan & Tahun" disabled><i class="fas fa-filter me-1"></i> Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dttable" class="table table-hover dt-responsive align-middle">
                                <thead>
                                    <tr>
                                        <th><center>#ID</center></th>
                                        <th>BLN / THN</th>
                                        <th>STAF</th>
                                        <th>KETERANGAN</th>
                                        <th>STATUS</th>
                                        <th>DIPERBARUI</th>
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
                                        <th><center>#ID</center></th>
                                        <th>BLN / THN</th>
                                        <th>STAF</th>
                                        <th>KETERANGAN</th>
                                        <th>STATUS</th>
                                        <th>DIPERBARUI</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalLihat" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center w-100">
                        <div class="">
                            <div class="fs-15 fw-medium text-dark" id="showUser"></div>
                            <p class="mb-0 op-7 fs-12 text-dark" id="showUserTime"></p>
                        </div>
                        <div class="ms-auto me-4">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <div class="modal-body" id="tampil-jadwal">
                    <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div id="footerLihat" class="d-none d-md-block"></div>
                    <div>
                        <button type="button" id="btn-cetak" class="btn btn-primary-transparent me-2"><i class="fa fa-print me-1"></i> Cetak</button>
                        <button type="button" id="btn-refresh-lihat" class="btn btn-warning-transparent me-2"><i class="fa fa-sync me-1"></i> Segarkan</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup &nbsp;<i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- FORM VERIF & BATAL VERIF --}}
    <div class="modal animate__animated animate__rubberBand fade" id="modalVerif" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Form Verif
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_verif" hidden>
                    <p style="text-align: justify;">Anda akan melakukan verifikasi Jadwal Dinas tersebut, status akan berubah ke <kbd>DIVERIFIKASI</kbd>. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan pemrosesan data.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuverif">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-verif" class="btn btn-success me-sm-3 me-1" onclick="prosesVerif()"><i class="fa fa-calendar-check me-1" style="font-size:13px"></i> Verifikasi</button>
                    <button type="reset" class="btn btn-secondary-transparent" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalBatalVerif" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Form Batal Verif
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_batal_verif" hidden>
                    <p style="text-align: justify;">Anda akan melakukan pembatalan verifikasi Jadwal Dinas tersebut, status akan berubah ke <kbd>PENDING</kbd>. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan pemrosesan data.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujubatalverif">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-batal-verif" class="btn btn-warning me-sm-3 me-1" onclick="prosesBatalVerif()"><i class="fa fa-calendar-check me-1" style="font-size:13px"></i> Batalkan Verifikasi</button>
                    <button type="reset" class="btn btn-secondary-transparent" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    {{-- FORM TOLAK & BATAL TOLAK --}}
    <div class="modal animate__animated animate__rubberBand fade" id="modalTolak" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Form Penolakan
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_tolak" hidden>
                    <p style="text-align: justify;">Anda akan melakukan penolakan Jadwal Dinas tersebut, status akan berubah ke <kbd>DITOLAK</kbd>. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan pemrosesan data.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujutolak">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-tolak" class="btn btn-danger me-sm-3 me-1" onclick="prosesTolak()"><i class="fa fa-calendar-times me-1" style="font-size:13px"></i> Tolak</button>
                    <button type="reset" class="btn btn-secondary-transparent" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalBatalTolak" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Form Batal Penolakan
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_batal_tolak" hidden>
                    <p style="text-align: justify;">Anda akan melakukan pembatalan penolakan Jadwal Dinas tersebut, status akan berubah ke <kbd>PENDING</kbd>. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan pemrosesan data.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujubataltolak">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-batal-verif" class="btn btn-danger me-sm-3 me-1" onclick="prosesBatalTolak()"><i class="fa fa-calendar-times me-1" style="font-size:13px"></i> Batalkan Penolakan</button>
                    <button type="reset" class="btn btn-secondary-transparent" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}

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

            $('#filterBulan').on('change', function() {
                if ($(this).val()) {
                    $('#btn-cari').prop('disabled', false); // aktifkan
                } else {
                    $('#btn-cari').prop('disabled', true); // nonaktifkan
                }
            });

            // $('.select2Tambah').select2({
            //     dropdownParent: $('#tambah')
            // });

            // showRiwayat($('#filterBulan').val());
            showRiwayat($('#filterBulan').val());
        });

        function showRiwayat(month) {
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            var regexBulan = /^\d{4}-(0[1-9]|1[0-2])$/;
            if (!regexBulan.test(month)) {
                $('#btn-refresh-jadwalBawahan').find("i").addClass("fa-spin");
                url = "/api/v4/sdi/jadwaldinas/bawahan/table";
                $('#filterBulan').val('');
                $('#btn-cari').prop('disabled', true);
            } else {
                $('#btn-refresh-jadwalBawahanFilter').find("i").addClass("fa-sync fa-spin").removeClass('fa-filter');
                url = "/api/v4/sdi/jadwaldinas/bawahan/table/"+month;
            }
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleDateString("sv-SE");
                        var date = new Date().toLocaleDateString("sv-SE");
                        var bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        if (item.progress == 0) {
                            var colButton = 'btn-danger-transparent';
                            var status = `<span class="badge fs-14 text-bg-danger">Ditolak</span>`;
                        } else {
                            if (item.progress == 1) {
                                var colButton = 'btn-warning-transparent';
                                var status = `<span class="badge fs-14 text-bg-warning">Pending</span>`;
                            } else {
                                if (item.progress == 2) {
                                    var colButton = 'btn-success-transparent';
                                    var status = `<span class="badge fs-14 text-bg-success">Diverifikasi</span>`;
                                } else {
                                    if (item.progress == 3) {
                                        var colButton = 'btn-primary-transparent';
                                        var status = `<span class="badge fs-14 text-bg-primary">Divalidasi</span>`;
                                    } else {
                                        var colButton = 'btn-orange-transparent';
                                        var status = `<span class="badge fs-14 text-bg-orange">Tidak Valid</span>`;
                                    }
                                }
                            }
                        }
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        content += `<td><center><div class='btn-group'>
                                        <button type='button' class='btn btn-sm ${colButton} dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false' id='btnoptshow${item.id}'>`+item.id+`</button>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-info" onclick="lihat(${item.id})"><i class="fa-fw fas fa-list-ol me-2"></i> Lihat</a></li>`;
                                            if (item.progress == 1) { // SEBELUM VERIFIKASI/PENDING
                                                content += `<li><a href="javascript:void(0);" class="dropdown-item disabled"><i class="fa fa-print me-2" style="font-size:13px"></i> Cetak</a></li>`;
                                                content += `<li><a href="javascript:void(0);" class="dropdown-item text-success" onclick="verif(${item.id})"><i class="fa-fw fas fa-calendar-check me-2"></i> Verif</a></li>`;
                                                content += `<li><a href="javascript:void(0);" class="dropdown-item text-danger" onclick="tolak(${item.id})"><i class="fa-fw fas fa-calendar-times me-2"></i> Tolak</a></li>`;
                                            } else { // SETELAH DIVERIFIKASI
                                                if (item.progress == 2) {
                                                    content += `<li><a href="javascript:void(0);" class="dropdown-item text-primary" onclick="printJadwal(${item.id})"><i class="fa fa-print me-2" style="font-size:13px"></i> Cetak</a></li>`;
                                                    content += `<li><a href="javascript:void(0);" class="dropdown-item text-warning" onclick="batalVerif(${item.id})"><i class="fa-fw fas fa-calendar-check me-2"></i> Batal Verif</a></li>`;
                                                    content += `<li><a href="javascript:void(0);" class="dropdown-item disabled"><i class="fa-fw fas fa-calendar-times me-2"></i> Tolak</a></li>`;
                                                } else { // DIVALIDASI
                                                    if (item.progress == 3) {
                                                        content += `<li><a href="javascript:void(0);" class="dropdown-item text-primary" onclick="printJadwal(${item.id})"><i class="fa fa-print me-2" style="font-size:13px"></i> Cetak</a></li>`;
                                                        content += `<li><a href="javascript:void(0);" class="dropdown-item disabled"><i class="fa-fw fas fa-calendar-check me-2"></i> Batal Verif</a></li>`;
                                                        content += `<li><a href="javascript:void(0);" class="dropdown-item disabled"><i class="fa-fw fas fa-calendar-times me-2"></i> Tolak</a></li>`;
                                                    } else { // DITOLAK
                                                        content += `<li><a href="javascript:void(0);" class="dropdown-item disabled"><i class="fa fa-print me-2" style="font-size:13px"></i> Cetak</a></li>`;
                                                        content += `<li><a href="javascript:void(0);" class="dropdown-item disabled"><i class="fa-fw fas fa-calendar-check me-2"></i> Verif</a></li>`;
                                                        content += `<li><a href="javascript:void(0);" class="dropdown-item text-warning" onclick="batalTolak(${item.id})"><i class="fa-fw fas fa-calendar-times me-2"></i> Batal Tolak</a></li>`;
                                                    }
                                                }
                                            }
                        content += "</ul></div></center></td>";
                        for (let i = 1; i <= bulan.length; i++) {
                            if (i == item.bulan) {
                                content += `<td>${bulan[i]} ${item.tahun}</td>`;
                            }
                        }
                        // parse sekali aja
                        let staf = JSON.parse(item.staf);
                        let totalStaf = staf.length;

                        // ambil nama verifikator
                        let nama_verif = res.users.find(us => us.id == item.verif)?.nama ?? null;

                        // ambil daftar nama staf sesuai ID
                        let stafNames = res.users
                            .filter(us => staf.includes(us.id.toString())) // pastikan id ke string
                            .map(us => us.nama ?? `<b class="text-danger">${us.name}</b>`)
                            .join('; ');

                        // buat konten
                        content += `
                            <td style='white-space: normal !important; word-wrap: break-word;'>
                                <div class='d-flex justify-content-start align-items-center'>
                                    <div class='d-flex flex-column'>
                                        <h6 class='mb-0'>
                                            Unit ${item.unit ? `<b class="text-primary">${item.unit}</b>` : `<s class="text-danger">Tidak Valid</s>`}
                                            (<b class="text-danger">${totalStaf}</b> Pegawai)
                                        </h6>
                                        <small class='text-muted'>${stafNames}</small>
                                    </div>
                                </div>
                            </td>
                        `;
                        content += `<td>${item.keterangan?item.keterangan:''}</td>`;
                        content += `<td>${status}</td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0'>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</a>
                                                <small class='text-truncate text-muted'><b class="text-warning">Ditambahkan</b> Oleh ` + item.nama_pegawai + `</small>
                                                ${item.nama_verif!=null?'<small class="text-truncate text-muted"><b class="text-success">Diverifikasi</b> Oleh '+item.nama_verif+'</small>':''}
                                                ${item.nama_valid!=null?'<small class="text-truncate text-muted"><b class="text-primary">Divalidasi</b> Oleh '+item.nama_valid+'</small>':''}
                                            </div>
                                        </div>
                                    </td>`;
                        content += "</tr>";
                        $('#tampil-tbody').append(content);

                        // Showing Tooltip
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger: 'hover'
                        })
                    });
                    var table = $('#dttable').DataTable({
                        // dom: 'Bfrtip',
                        order: [
                            [5, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '15%' },
                            { sWidth: '45%' },
                            { sWidth: '20%' },
                            { sWidth: '5%' },
                            { sWidth: '10%' },
                        ],
                        columnDefs: [
                            // { visible: false, targets: [7] },
                        ],
                        displayLength: 20,
                        // buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });
                    $('#btn-refresh-jadwalBawahan').find("i").removeClass("fa-spin");
                    $('#btn-refresh-jadwalBawahanFilter').find("i").removeClass("fa-sync fa-spin").addClass('fa-filter');
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Seluruh Jadwal Dinas Bawahan gagal dimuat, silakan coba beberapa saat lagi atau Hubungi Admin',
                        position: 'topRight'
                    });
                    $('#btn-refresh-jadwalBawahan').find("i").removeClass("fa-spin");
                    $('#btn-refresh-jadwalBawahanFilter').find("i").removeClass("fa-sync fa-spin").addClass('fa-filter');
                }
            })
        }

        function lihat(id) {
            $('#btnoptshow'+id).empty().append(`<i class="fa fa-spinner fa-spin fa-fw"></i>`);
            $("#tampil-jadwal").empty().append(`<center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>`);
            $.ajax({
                url: "/api/v4/sdi/jadwaldinas/jadwal/"+id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    moment.locale('id');
                    let hideJadwal = true;
                    const ketCuti = {
                        L:  "LIBUR",
                        C:  "CUTI TAHUNAN",
                        CM: "CUTI MELAHIRKAN",
                        CU: "CUTI UMROH",
                        CH: "CUTI HAJI",
                        CD: "CUTI DI LUAR TANGGUNGAN"
                    };

                    // Data dari API
                    const bulanAPI = parseInt(res.jadwal.bulan, 10); // contoh: 9
                    const tahunAPI = parseInt(res.jadwal.tahun, 10); // contoh: 2025

                    // Buat moment dari API
                    const tanggalAPI = moment(`${tahunAPI}-${bulanAPI}-01`, 'YYYY-MM-DD');

                    // Bulan & tahun sekarang
                    const tanggalSekarang = moment().startOf('month'); // tanggal awal bulan ini

                    // Bandingkan
                    if (tanggalAPI.isSameOrAfter(tanggalSekarang)) {
                        hideJadwal = false;
                    } else {
                        hideJadwal = true;
                    }

                    if (res.detail.length === 0) {
                        notifier.show(
                            "Pesan Galat!",
                            "Data isian Jadwal Dinas tidak ditemukan, silakan melengkapi jadwal terlebih dahulu (Klik Ubah)",
                            "warning",
                            "{{ asset('images/notification/medium_priority-48.png') }}",
                            4000
                        );
                        $('#btnoptshow'+id).empty().text(id);
                        return;
                    }

                    $("#showUser").empty().html('Dibuat Oleh <b class="text-primary">'+res.jadwal.nama_pegawai+'</b>');
                    $("#showUserTime").text('Pada '+new Date(res.jadwal.updated_at).toLocaleString("sv-SE"));

                    let footer = '';
                    if(res.jadwal.nama_verif) {
                        footer += `Diverifikasi Oleh <b class="text-success">${res.jadwal.nama_verif}</b> (${res.jadwal.tgl_verif})<br>`;
                    }
                    if(res.jadwal.nama_valid) {
                        footer += `Divalidasi Oleh <b class="text-primary">${res.jadwal.nama_valid}</b> (${res.jadwal.tgl_valid})`;
                    }
                    $('#footerLihat').empty().append(footer);

                    let n = 1;
                    let content = `
                        <h4 class="text-center mb-2">Jadwal Dinas Unit <b class="text-primary">${res.jadwal.unit}</b></h4>
                        <h5 class="text-center mb-2">Bulan <b class="text-primary">${res.bulan}</b> Tahun <b class="text-primary">${res.jadwal.tahun}</b></h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive p-10 pb-0">
                                    <table id="dttable-lihat-jadwal" class="table table-bordered dttable-jadwaldinas" style="width: 100%;table-layout: auto">
                                        <thead>
                                            <tr>
                                                <th class="text-center" rowspan="2">NO</th>
                                                <th class="text-center" rowspan="2">NAMA</th>
                                                <th class="text-center" colspan="${res.totalDay}">TANGGAL</th>
                                                <th ${hideJadwal?"hidden":""} class="text-center" rowspan="2">JAM KERJA (JAM)</th>
                                                <th ${hideJadwal?"hidden":""} class="text-center" colspan="${res.shift.length + 6}" style="background-color:#eaeeaf !important;border-top: 3px solid #eaeeaf;border-left: 3px solid #eaeeaf;border-right: 3px solid #eaeeaf;">JUMLAH SHIFT</th>
                                            </tr>
                                            <tr>`;

                    // Header tanggal
                    for (let i = 1; i <= res.totalDay; i++) {
                        let lnItem = res.ln.find(ln => ln.tgl === i);
                        let style = lnItem ? ` style="background-color: ${lnItem.color} !important;"` : '';
                        content += `<th class="p-2 text-center tgl${i}"${style}>${i < 10 ? '0'+i : i}</th>`;
                    }

                    // Header shift
                    res.shift.forEach((s, index) => {
                        content += `<th class="p-2 text-center" ${index===0?"style='border-left: 3px solid #eaeeaf;'":""} ${hideJadwal?"hidden":""}>${s.singkat}</th>`;
                    });
                    ['L','C','CM','CU','CH','CD'].forEach((s, index, arr) => {
                        let border = (s==='CD') ? "style='border-right: 3px solid #eaeeaf;'" : '';
                        content += `<th class="p-2 text-center" ${border} ${hideJadwal?"hidden":""}>${s}</th>`;
                    });
                    content += `</tr></thead><tbody>`;

                    // Mapping shift -> jam kerja & inisialisasi shiftCounts
                    let shiftDurasi = {};
                    let shiftCounts = {};
                    res.shift.concat(['L','C','CM','CU','CH','CD']).forEach(s => {
                        shiftDurasi[s.singkat || s] = ['L','C','CM','CU','CH','CD'].includes(s.singkat || s) ? 0 :
                            (function() {
                                let start = new Date(`1970-01-01T${s.berangkat}`);
                                let end = new Date(`1970-01-01T${s.pulang}`);
                                if (end < start) end.setDate(end.getDate()+1);
                                return (end - start)/(1000*60*60);
                            })();
                        shiftCounts[s.singkat || s] = 0;
                    });

                    // Mapping jumlah per tanggal
                    let shifts = res.shift.map(s=>s.singkat).concat(['L','C','CM','CU','CH','CD']);
                    let tfootCounts = {};
                    for (let i=1;i<=res.totalDay;i++){
                        tfootCounts[i] = {};
                        shifts.forEach(s => tfootCounts[i][s]=0);
                    }
                    res.detail.forEach(pegawai => {
                        for (let i=1;i<=res.totalDay;i++){
                            let kodeShift = pegawai[`tgl${i}`];
                            if(kodeShift && tfootCounts[i][kodeShift]!==undefined) tfootCounts[i][kodeShift]++;
                        }
                    });

                    // LOOPING JADWAL DINAS
                    res.detail.forEach(pegawai => {
                        let pegawaiShiftCounts = {...shiftCounts};
                        for (let i=1;i<=res.totalDay;i++){
                            let kodeShift = pegawai[`tgl${i}`];
                            if(kodeShift && pegawaiShiftCounts[kodeShift]!==undefined) pegawaiShiftCounts[kodeShift]++;
                        }

                        content += `
                        <tr class="text-center">
                            <td style="background-color: ${pegawai.color} !important;">${n++}</td>
                            <td class="text-start" style="background-color: ${pegawai.color} !important;">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="d-flex flex-column" style="max-width:150px;">
                                        <h6 class="mb-0 text-truncate">
                                            ${pegawai.pegawai_nama}
                                        </h6>
                                        <small class="text-truncate">
                                            ${pegawai.jabatan || ''}
                                        </small>
                                    </div>
                                </div>
                            </td>`;
                        // content += `<tr class="text-center">
                        //                 <td style="background-color: ${pegawai.color}">${n++}</td>
                        //                 <td class="text-start" style="background-color: ${pegawai.color}">
                        //                     <div class='d-flex justify-content-start align-items-center'>
                        //                         <div class='d-flex flex-column'>
                        //                             <h6 class='mb-0 clef'>${pegawai.pegawai_nama}</h6>
                        //                             <small class='text-truncate text-muted clef'>${pegawai.jabatan || ''}</small>
                        //                         </div>
                        //                     </div>
                        //                 </td>`;

                        // tanggal
                        for (let i=1;i<=res.totalDay;i++){
                            let kodeShift = pegawai[`tgl${i}`]||'';
                            let lnItem = res.ln.find(ln => ln.tgl==i);
                            let style = lnItem ? ` style="background-color: ${lnItem.color} !important;"` : '';
                            content += `<td class="p-2 tgl${i}"${style}>${kodeShift}</td>`;
                        }

                        // total jam kerja
                        let totalJamKerja = 0;
                        for (let i=1;i<=res.totalDay;i++){
                            let kodeShift = pegawai[`tgl${i}`];
                            if(kodeShift && shiftDurasi[kodeShift]) totalJamKerja += shiftDurasi[kodeShift];
                        }
                        content += `<td class="p-2" ${hideJadwal?"hidden":""}>${totalJamKerja}</td>`;

                        // shift counts
                        res.shift.forEach((s,index)=>{
                            content += `<td class="p-2 text-center" ${index==0?"style='border-left: 3px solid #eaeeaf !important;'":""} ${hideJadwal?"hidden":""}>${pegawaiShiftCounts[s.singkat]}</td>`;
                        });
                        ['L','C','CM','CU','CH','CD'].forEach(s=>{
                            let border = (s==='CD') ? "style='border-right: 3px solid #eaeeaf !important;'" : '';
                            content += `<td class="p-2 text-center" ${border} ${hideJadwal?"hidden":""}>${pegawaiShiftCounts[s]}</td>`;
                        });

                        content += `</tr>`;
                    });

                    // tfoot
                    content += `<tfoot style="border:3px solid #eaeeaf;" ${hideJadwal?"hidden":""}>`;
                    shifts.forEach((shift,index)=>{
                        content += `<tr>${index===0 ? `<th rowspan="${shifts.length}" style="writing-mode: vertical-rl; transform: rotate(180deg); text-align:center;background-color:#eaeeaf !important;">JUMLAH SHIFT</th>` : '' }
                                        <th>${shift}</th>`;
                        for (let i=1;i<=res.totalDay;i++){
                            content += `<td class="text-center">${tfootCounts[i][shift]}</td>`;
                        }
                        content += `</tr>`;
                    });
                    content += `</tfoot></table></div></div>`;

                    // Keterangan shift
                    content += `<div class="col-md-6 mt-3"><div class="p-10"><h6>Shift Jaga Terbaru :</h6><div class="list-group"><label class="list-group-item border-0 p-2"><ul>`;
                    res.shift.forEach(item=>{
                        content += `<li><b class="me-1">${item.singkat}</b>(<u>${item.shift}</u>) : ${item.berangkat.substring(0,5)} - ${item.pulang.substring(0,5)} WIB</li>`;
                    });
                    ['L','C','CM','CU','CH','CD'].forEach(s=>{
                        content += `<li>
                            <b class="me-1 text-danger">${s}</b>
                            (<u class="text-danger">${ketCuti[s]}</u>)
                        </li>`;
                    });
                    content += `</ul></label></div></div></div>`;

                    // Keterangan warna
                    content += `<div class="col-md-6 mt-3"><div class="p-10"><h6>Keterangan :</h6><div class="list-group">`;
                    content += `<label class="list-group-item border-0 p-1">
                                    <a class="btn btn-light me-2" style="background-color: #fed8b9 !important;" href="javascript:void(0);"></a>Hari Minggu
                                </label>`;
                    res.ln.forEach(item=>{
                        content += `<label class="list-group-item border-0 p-1">
                                        <a class="btn btn-light me-1" style="background-color: ${item.color} !important;" href="javascript:void(0);"></a>
                                        ${item.deskripsi}${item.keterangan ? ' ('+item.keterangan+')' : ''} ${item.tgl ? ' - Tanggal '+item.tgl : ''}
                                    </label>`;
                    });
                    content += `</div></div></div>`;

                    $('#tampil-jadwal').empty().append(content);

                    // warna hari minggu
                    for (let i = 0; i < res.totalDay; i++) {
                        if (res.dataArray[i] === 'Minggu') {
                            $('.tgl' + (i + 1)).each(function () {
                                this.style.setProperty('background-color', '#fed8b9', 'important');
                            });
                        }
                    }

                    $('#btn-refresh-lihat').attr('onClick', `lihat(${id});`);
                    $('#btn-cetak').attr('onClick', `printJadwal(${id});`);
                    $('#modalLihat').modal('show');
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Jadwal Dinas gagal dimuat, silakan coba beberapa saat lagi',
                        position: 'topRight'
                    });
                    // $('#btnoptshow'+id).empty().text(id);
                },
                complete: function() {
                    $('#btnoptshow' + id).empty().text(id);
                }
            })
        }

        function printJadwal(id) {
            // Generate URL route Laravel
            const url = `/kepegawaian/jadwaldinas/${id}/cetak`;

            // Buka popup dengan ukuran 800x600, tanpa toolbar, scrollable
            const width = 800;
            const height = 600;
            const left = (screen.width/2) - (width/2); // posisi tengah layar
            const top = (screen.height/2) - (height/2);

            window.open(
                url,
                '_blank',
                `width=${width},height=${height},top=${top},left=${left},resizable=yes,scrollbars=yes`
            );
        }

        // VERIFIKASI
        function verif(id) {
            $("#id_verif").val(id);
            var inputs = document.getElementById('setujuverif');
            inputs.checked = false;
            $('#modalVerif').modal('show');
        }
        function batalVerif(id) {
            $("#id_batal_verif").val(id);
            var inputs = document.getElementById('setujubatalverif');
            inputs.checked = false;
            $('#modalBatalVerif').modal('show');
        }

        function prosesVerif() {
            // SWITCH BTN
            var checkbox = $('#setujuverif').is(":checked");
            if (checkbox == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan verifikasi jadwal dinas tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES
                var id = $("#id_verif").val();
                $.ajax({
                    url: "/api/v4/sdi/jadwaldinas/bawahan/"+id+"/verif",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Jadwal Dinas telah berhasil diverifikasi pada '+res,
                            position: 'topRight'
                        });
                        $('#modalVerif').modal('hide');
                        showRiwayat($('#filterBulan').val());
                    },
                    error: function(xhr) {
                        // xhr.responseJSON berisi data JSON dari Laravel
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.message,
                            position: 'topRight'
                        });
                    }
                });
            }
        }
        function prosesBatalVerif() {
            // SWITCH BTN
            var checkbox = $('#setujubatalverif').is(":checked");
            if (checkbox == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan pembatalan verifikasi jadwal dinas tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES
                var id = $("#id_batal_verif").val();
                $.ajax({
                    url: "/api/v4/sdi/jadwaldinas/bawahan/"+id+"/batalverif",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Jadwal Dinas telah berhasil dibatalkan verifikasi pada '+res,
                            position: 'topRight'
                        });
                        $('#modalBatalVerif').modal('hide');
                        showRiwayat($('#filterBulan').val());
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Jadwal Dinas gagal batal verifikasi',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        // PENOLAKAN
        function tolak(id) {
            $("#id_tolak").val(id);
            var inputs = document.getElementById('setujutolak');
            inputs.checked = false;
            $('#modalTolak').modal('show');
        }
        function batalTolak(id) {
            $("#id_batal_tolak").val(id);
            var inputs = document.getElementById('setujubataltolak');
            inputs.checked = false;
            $('#modalBatalTolak').modal('show');
        }

        function prosesTolak() {
            // SWITCH BTN
            var checkbox = $('#setujutolak').is(":checked");
            if (checkbox == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan penolakan jadwal dinas tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES
                var id = $("#id_tolak").val();
                $.ajax({
                    url: "/api/v4/sdi/jadwaldinas/bawahan/"+id+"/tolak",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Jadwal Dinas telah berhasil ditolak pada '+res,
                            position: 'topRight'
                        });
                        $('#modalTolak').modal('hide');
                        showRiwayat($('#filterBulan').val());
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Jadwal Dinas gagal ditolak',
                            position: 'topRight'
                        });
                    }
                });
            }
        }
        function prosesBatalTolak() {
            // SWITCH BTN
            var checkbox = $('#setujubataltolak').is(":checked");
            if (checkbox == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan pembatalan penolakan jadwal dinas tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES
                var id = $("#id_batal_tolak").val();
                $.ajax({
                    url: "/api/v4/sdi/jadwaldinas/bawahan/"+id+"/bataltolak",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Jadwal Dinas telah berhasil dibatal tolak pada '+res,
                            position: 'topRight'
                        });
                        $('#modalBatalTolak').modal('hide');
                        showRiwayat($('#filterBulan').val());
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Jadwal Dinas gagal dibatal tolak',
                            position: 'topRight'
                        });
                    }
                });
            }
        }
    </script>
@endsection
