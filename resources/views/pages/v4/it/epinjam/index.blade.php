@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    <b class="text-secondary link-underline-secondary text-decoration-underline">Elektronik</b> <b class="text-teal link-underline-teal text-decoration-underline">Pinjam</b> (<b class="text-secondary">E</b>-<b class="text-teal">Pinjam</b>)
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">IT</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        E-Pinjam
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">Form <b class="text-secondary">Tambah</b></h6>
                        <h6 class="mb-0 fs-12">Isian (<a class="text-danger">*</a>) wajib diisi</h6>
                    </div>
                    <div class="card-body border-bottom p-0 table-responsive">
                        <table class="table nowrap text-nowrap table-borderless" id="table-add-row">
                            <thead>
                                <tr>
                                    <th>Kategori (<a class="text-danger">*</a>)</th>
                                    <th>Nama Barang (<a class="text-danger">*</a>)</th>
                                    <th>Peruntukan</th>
                                    <th>Rencana Kembali</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="row-barang">
                                    <td class="py-0"><select class="select2 form-control kategori" style="width: 100%" required></select></td>
                                    <td class="py-0"><select class="select2 form-control barang" style="width: 100%" disabled required></select></td>
                                    <td class="py-0"><input class="form-control peruntukan" type="text" placeholder="Optional" required></td>
                                    <td class="py-0"><input class="form-control flatpickr-back tgl_kembali" type="text" placeholder="Optional" required></td>
                                    <td class="py-0 cell-fit"><button type="button" class="btn btn-sm btn-danger-light btnHapusBarang" onclick="hapusBarang(this)"><i class="ri-delete-bin-5-line fs-16 me-1"></i> Hapus</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-primary-transparent" id="btn-tambah-barang" onclick="tambahBarang()">
                                            <i class="bi bi-plus-lg"></i> Tambah Barang
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-9 mb-3">
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-item-center">
                                    <label class="form-label">Pilih Pegawai Peminjam (<a class="text-danger">*</a>)</label>

                                    <div class="form-check">
                                        <input class="form-check-input form-checked-secondary" type="checkbox" id="tulis_manual" onchange="togglePeminjam(this)">
                                        <label class="form-check-label text-warning fw-bold" for="tulis_manual">
                                            Tulis Manual?
                                        </label>
                                    </div>
                                </div>

                                <div id="peminjam-wrapper">
                                    <select class="select2 form-control" id="peminjam" style="width: 100%" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Pilih Tgl. Pinjam (<a class="text-danger">*</a>)</label>
                                <input class="form-control flatpickr" id="tgl_pinjam" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Keperluan (<a class="text-warning">Optional</a>)</label>
                                <textarea class="form-control" id="keperluan" rows="2" placeholder="Tuliskan keperluan peminjaman barang"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between py-3">
                        <div class="btn-group">
                            <button class="btn btn-secondary-transparent" onclick="clearInput()"><i class="ri-edit-line"></i> <span class="d-none d-md-inline ms-1">Kosongkan</span></button>
                            <button class="btn btn-orange-light" onclick="loadTambah()" id="refresh-input"><i class="ri-refresh-line"></i> <span class="d-none d-md-inline ms-1">Refresh Input</span></button>
                        </div>
                        <button class="btn btn-primary" id="btn-simpan-ajukan" onclick="simpan()" disabled><i class="ri-send-plane-fill me-1"></i> Submit</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">Riwayat <b class="text-primary">Peminjaman</b></h6>
                        <div class="btn-group my-1">
                            <button type="button" class="btn btn-sm btn-warning-transparent btn-wave" onclick="refresh()" id="btn-refresh">
                                <i class="ri-refresh-line"></i> <span class="d-none d-md-inline ms-1">Refresh</span>
                            </button>
                            <button class="btn btn-sm btn-primary-transparent btn-wave dropdown-toggle dropdown-toggle-split me-2" type="button" id="defaultDropdown"
                                data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false"> Menu Admin </button>
                            <ul class="dropdown-menu" aria-labelledby="defaultDropdown" style="">
                                <li><a class="dropdown-item text-orange" href="{{ route('v4.it.epinjam.ref.kategori') }}"><span class="badge bg-dark-transparent me-2 p-1"><i class="ri-number-1"></i></span> Ref Kategori</a></li>
                                <li><a class="dropdown-item text-primary" href="{{ route('v4.it.epinjam.ref.asal') }}"><span class="badge bg-dark-transparent me-2 p-1"><i class="ri-number-2"></i></span> Ref Asal</a></li>
                                <li><a class="dropdown-item text-success" href="{{ route('v4.it.epinjam.ref.barang') }}"><span class="badge bg-dark-transparent me-2 p-1"><i class="ri-number-3"></i></span> Ref Barang</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <div class="alert alert-solid-light shadow-sm">
                            <h6>Baca <b class="text-danger">Saya</b>!</h6>
                            <small>
                                <ul class="mb-0">
                                    <li>Pengubahan atau Penghapusan dokumen laporan hanya berlaku pada <strong class="text-danger">Hari saat Anda mengupload saja</strong></li>
                                    <li>Penghapusan laporan lewat hari hanya dilakukan Oleh Admin Laporan</li>
                                    <li>Tidak ada batasan upload per Bulan, pengguna bebas melakukan upload laporan rutin dengan ketentuan sebagai berikut :
                                        <ul>
                                            <li>File Upload yang disarankan berupa Dokumen PDF <b class="text-pink">(.pdf)</b> atau Word <b class="text-pink">(.doc/.docx)</b></li>
                                            <li>Batas ukuran maksimum dokumen adalah <b class="text-primary">5 mb</b></li>
                                        </ul>
                                    </li>
                                    <li>Laporan yang sudah diverifikasi <b class="text-danger">TIDAK BISA</b> diubah atau dihapus kembali</li>
                                    <li>Catatan dan Verifikator diisi oleh Atasan atau bisa juga oleh Admin</li>
                                </ul>
                            </small>
                        </div> --}}
                        <div class="table-responsive">
                            <table id="dttable" class="table dt-responsive table-hover nowrap w-100 align-middle">
                                <thead>
                                    <tr>
                                        <th class="cell-fit">
                                            <center>#ID</center>
                                        </th>
                                        <th>NAMA PEMINJAM / <b class="text-teal">JABATAN</b> / <b class="text-warning">KEPERLUAN</b></th>
                                        {{-- <th>JABATAN</th> --}}
                                        <th>STATUS</th>
                                        <th>MULAI PEMINJAMAN</th>
                                        <th>TGL. DIKEMBALIKAN</th>
                                        <th>DAFTAR BARANG</th>
                                        <th>TGL. DIPERBARUI</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody">
                                    <tr>
                                        <td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Menginisialisasi data...</center></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="cell-fit">
                                            <center>#ID</center>
                                        </th>
                                        <th>NAMA PEMINJAM / <b class="text-teal">JABATAN</b> / <b class="text-warning">KEPERLUAN</b></th>
                                        {{-- <th>JABATAN</th> --}}
                                        <th>STATUS</th>
                                        <th>MULAI PEMINJAMAN</th>
                                        <th>TGL. DIKEMBALIKAN</th>
                                        <th>DAFTAR BARANG</th>
                                        <th>TGL. DIPERBARUI</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUbah" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="edit_id">

                    <!-- PEMINJAM -->
                    <div class="form-group mb-3">
                        <label>Peminjam</label>

                        <div id="edit-peminjam-wrapper">
                            <select class="form-control select2" id="edit_peminjam" style="width:100%"></select>
                        </div>
                    </div>

                    <!-- TGL -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Tanggal Pinjam</label>
                            <input type="text" id="edit_tgl_pinjam" class="form-control flatpickr">
                        </div>

                        <div class="col-md-6">
                            <label>Keperluan</label>
                            <textarea id="edit_keperluan" class="form-control"></textarea>
                        </div>
                    </div>

                    <!-- DETAIL -->
                    <table class="table nowrap table-borderless" id="edit-table-row">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Barang</th>
                                <th>Peruntukan</th>
                                <th>Rencana Kembali</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="edit-body-barang"></tbody>
                    </table>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" onclick="prosesUbah()">Ubah</button>
                </div>

            </div>
        </div>
    </div>
{{--
    <div class="modal fade" id="modalStatusBarang" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">
                        Ubah <b class="text-info">Status Barang</b>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="status_list_id">

                    <label class="form-label">
                        Status Barang
                    </label>

                    <select class="form-control" id="status_barang">
                        <option value="1">
                            Aktif / Dipinjam
                        </option>

                        <option value="0">
                            Tidak Aktif / Dikembalikan
                        </option>
                    </select>

                </div>


                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-secondary-transparent"
                        data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i> Batal
                    </button>

                    <button type="button"
                        class="btn btn-info-transparent"
                        onclick="simpanStatusBarang()">
                        <i class="ri-supabase-line me-1"></i> Simpan
                    </button>

                </div>

            </div>
        </div>
    </div> --}}

    <!-- MODAL PERBARUI STATUS -->
    <div class="modal fade" tabindex="-1" id="modalStatusBarang">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">
                        Perbarui <b class="text-info">Status Barang</b>
                    </h6>

                    <button class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="id_epinjam">

                    <div class="p-2 pt-0 pb-0" id="list-status-barang"></div>

                </div>

                <div class="modal-footer d-flex justify-content-between">

                    <button
                        class="btn btn-danger" onclick="selesaikanSemua()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left"
                        data-bs-html="true" title="Klik tombol ini untuk menandai semua barang sebagai <b class='text-danger'>Dikembalikan</b>">

                        <i class="ri-check-double-line me-1"></i>

                        Barang Dikembalikan Semua

                    </button>

                    <button
                        class="btn btn-primary" onclick="simpanStatusBarang()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right"
                        data-bs-html="true" title="Klik tombol ini untuk menyimpan perubahan status Per <b class='text-primary'>ITEM BARANG</b>">

                        <i class="ri-save-line me-1"></i>

                        Perbarui Status Barang

                    </button>

                </div>

            </div>
        </div>
    </div>

    <script>
        let dataBarang = [];
        let dataUsers = [];
        let now = new Date();
        let isInitEdit = true;

        $(document).ready(function() {
            // SELECT2
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    // dropdownParent: e.parent()
                    dropdownParent: e.closest('.card')
                })
            });

            const today = new Date();
            today.setHours(23, 59, 59, 999);
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            const next = new Date(today);
            next.setDate(next.getDate() + 999999);
            // FLATPICKR TGL PINJAM
            flatpickr(".flatpickr", {
                enableTime: true,
                defaultDate: now,
                minuteIncrement: 1,
                time_24hr: true,
                // disable: [{
                //     from: tomorrow.toISOString().split("T")[0],
                //     to: next.toISOString().split("T")[0]
                // }]
                disable: [
                    function(date) {
                        return date > today;
                    }
                ]
            });
            flatpickr(".flatpickr-back", {
                // enableTime: true,
                allowInput: true,
                // defaultDate: now,
                minuteIncrement: 1,
                time_24hr: true,
                minDate: "today"
            });

            // FORM TAMBAH
            $('#table-add-row').on('change', '.kategori', function() {
                let kategoriId = $(this).val();
                let row = $(this).closest('tr');
                let barangSelect = row.find('.barang');

                barangSelect.prop('disabled',false).html(
                    '<option value="">-- Pilih Barang --</option>'
                );

                if (!kategoriId) return;


                let barangTerpilih = [];

                $('.barang').each(function(){
                    let val = $(this).val();

                    if(val){
                        barangTerpilih.push(val);
                    }
                });


                let kategori = dataBarang.find(x => x.id == kategoriId);


                if(!kategori) return;


                let barangOption = '<option value="">-- Pilih Barang --</option>';


                $.each(kategori.barang, function(i,item){

                    // skip barang yang sudah dipakai di row lain
                    if(!barangTerpilih.includes(String(item.id))){
                        barangOption += `
                            <option value="${item.id}">
                                ${item.nama}
                            </option>
                        `;
                    }

                });

                barangSelect.html(barangOption);
                barangSelect.trigger('change');
            });

            // FORM UBAH
            $('#edit-table-row').on('change', '.edit-kategori', function () {

                if (isInitEdit) return;

                let kategoriId = $(this).val();
                let row = $(this).closest('tr');
                let barangSelect = row.find('.edit-barang');

                barangSelect.prop('disabled', !kategoriId);
                barangSelect.html(
                    '<option value="">-- Pilih Barang --</option>'
                );

                if (!kategoriId) return;

                let kategori = null;

                $.each(dataBarang, function (i, item) {
                    if (item.id == kategoriId) {
                        kategori = item;
                        return false;
                    }
                });

                if (!kategori) return;

                let barangOption = '<option value="">-- Pilih Barang --</option>';

                $.each(kategori.barang, function (i, item) {
                    barangOption += `
                        <option value="${item.id}">
                            ${item.nama}
                        </option>
                    `;
                });

                barangSelect.html(barangOption);
                barangSelect.trigger('change');
            });

            // $(document).on('click', '.btnHapusBarang', function() {

            //     if ($('.row-barang').length <= 1) {

            //         iziToast.warning({
            //             title: 'Pesan System!',
            //             message: 'Minimal harus ada 1 barang.',
            //             position: 'topRight'
            //         });

            //         return;
            //     }

            //     $(this).closest('tr').remove();

            // });

            loadTambah();
            refresh();

            $('#btn-simpan-ajukan').prop('disabled',false);
        });

        function getKategoriOption() {

            let option = '<option value="">-- Pilih Kategori --</option>';

            $.each(dataBarang, function(i, item) {
                option += `
                    <option value="${item.id}">
                        ${item.nama}
                    </option>
                `;
            });

            return option;
        }

        function loadTambah() {
            let btn = $('#refresh-input');

            $.ajax({
                url: "/api/v4/it/epinjam/loadtambah",
                type: "GET",
                dataType: "json",
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.find("i").addClass("ri-spin-slow");
                },
                success: function(res) {

                    // simpan ke global variable
                    dataUsers = res.users;

                    // SHOW KATEGORI
                    dataBarang = res.barang;

                    let kategoriOption = '<option value="">-- Pilih Kategori --</option>';
                    $.each(dataBarang, function(i, item) {
                        kategoriOption += `
                            <option value="${item.id}">
                                ${item.nama}
                            </option>
                        `;
                    });
                    $('.kategori').html(kategoriOption);

                    // SHOW PEMINJAM (SELECT)
                    let peminjamSelect = `
                        <select class="select2 form-control" id="peminjam" style="width: 100%">
                            <option value="" selected hidden>Pilih Pegawai</option>
                        </select>
                    `;

                    $("#peminjam-wrapper").html(peminjamSelect);

                    let peminjamOptions = '';

                    dataUsers.forEach(user => {
                        let roles = user.roles.map(r => r.name).join(', ');
                        peminjamOptions += `
                            <option value="${user.id}">
                                ${user.nama} (${roles})
                            </option>
                        `;
                    });
                    $("#peminjam").append(peminjamOptions);

                    $("#peminjam").select2({
                        // placeholder: "Pilih",
                        width: '100%'
                    });
                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan System!',
                        message: xhr.responseText,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    btn.find("i").removeClass("ri-spin-slow");
                    btn.prop('disabled', false);
                    iziToast.success({
                        title: 'Pesan System!',
                        message: 'Input Form Tambah berhasil diperbarui',
                        position: 'topRight'
                    });
                }
            });
        }

        function renderKategori(selected = null) {

            let html = '<option value="">-- Pilih --</option>';

            dataBarang.forEach(k => {
                html += `
                    <option value="${k.id}" ${k.id == selected ? 'selected' : ''}>
                        ${k.nama}
                    </option>
                `;
            });

            return html;
        }

        function togglePeminjam(el) {

            let wrapper = $('#peminjam-wrapper');

            if ($(el).is(':checked')) {

                // kalau select2 aktif, destroy dulu
                if ($('#peminjam').hasClass("select2-hidden-accessible")) {
                    $('#peminjam').select2('destroy');
                }

                wrapper.html(`
                    <input type="text" id="peminjam" class="form-control" placeholder="Masukkan nama pegawai">
                `);

            } else {

                wrapper.html(`
                    <select class="select2 form-control" id="peminjam" style="width: 100%">
                        <option value="" selected hidden>Pilih Pegawai</option>
                    </select>
                `);

                // isi ulang data (kalau sudah disimpan global lebih bagus)
                if (typeof dataUsers !== 'undefined') {
                    let opt = '';

                    dataUsers.forEach(user => {
                        let roles = user.roles.map(r => r.name).join(', ');
                        opt += `<option value="${user.id}">
                                    ${user.nama} (${roles})
                                </option>`;
                    });

                    $('#peminjam').append(opt);
                }

                $('#peminjam').select2({
                    width: '100%'
                });
            }
        }

        function tambahBarang() { // ADD ROW BARANG

            let valid = true;

            $('.row-barang').each(function(){

                let kategori = $(this).find('.kategori').val();
                let barang   = $(this).find('.barang').val();

                if(!kategori || !barang){
                    valid = false;
                    return false; // stop loop
                }

            });

            if(!valid){

                iziToast.warning({
                    title: 'Pesan System!',
                    message: 'Silahkan pilih kategori dan barang terlebih dahulu.',
                    position: 'topRight'
                });

                return;
            }

            // let kategoriOption = $('.kategori:first').html();

            let row = `
                <tr class="row-barang">
                    <td class="pt-2 pb-0">
                        <select class="select2 form-control kategori" style="width:100%">
                            ${getKategoriOption()}
                        </select>
                    </td>

                    <td class="pt-2 pb-0">
                        <select class="select2 form-control barang" style="width:100%" disabled>
                            <option value="">-- Pilih Barang --</option>
                        </select>
                    </td>

                    <td class="pt-2 pb-0">
                        <input class="form-control peruntukan" type="text" placeholder="Optional">
                    </td>

                    <td class="pt-2 pb-0">
                        <input class="form-control flatpickr-back tgl_kembali" type="text" placeholder="Optional">
                    </td>

                    <td class="pt-2 pb-0 cell-fit">
                        <button type="button" class="btn btn-sm btn-danger-light btnHapusBarang" onclick="hapusBarang(this)">
                            <i class="ri-delete-bin-5-line fs-16 me-1"></i> Hapus
                        </button>
                    </td>
                </tr>
            `;

            $('#table-add-row tbody tr:last').before(row);

            let newRow = $('#table-add-row tbody tr.row-barang:last');
            // let newRow = $('table tbody tr:last').prev();
            newRow.find('.select2').each(function() {

                $(this).wrap('<div class="position-relative"></div>')
                    .select2({
                        placeholder: "Pilih",
                        // dropdownParent: $(this).parent()
                        dropdownParent: $(this).closest('.card')
                    });

            });

            let inputBaru = newRow.find('.flatpickr-back')[0];

            flatpickr(inputBaru, {
                // enableTime: true,
                allowInput: true,
                // defaultDate: now,
                minuteIncrement: 1,
                time_24hr: true,
                minDate: "today"
            });
        }

        function hapusBarang(btn) {

            if ($('.row-barang').length <= 1) {

                iziToast.warning({
                    title: 'Pesan System!',
                    message: 'Minimal harus ada 1 barang.',
                    position: 'topRight'
                });

                return;
            }

            $(btn).closest('tr').remove();
        }

        function simpan() {

            const btn = $('#btn-simpan-ajukan');
            let detail = [];

            $('.row-barang').each(function() {

                detail.push({
                    kategori_id: $(this).find('.kategori').val(),
                    barang_id: $(this).find('.barang').val(),
                    peruntukan: $(this).find('.peruntukan').val(),
                    tgl_kembali: $(this).find('.tgl_kembali').val()
                });

            });

            // cek mode manual
            let isManual = $('#tulis_manual').is(':checked');

            let peminjamValue = $('#peminjam').val();

            let data = {
                peminjam_type: isManual ? 'manual' : 'user',
                peminjam_nama: isManual ? peminjamValue : null,
                user_id: isManual ? null : peminjamValue,
                tgl_pinjam: $('#tgl_pinjam').val(),
                keperluan: $('#keperluan').val(),
                detail: detail
            };

            // VALIDASI FRONTEND
            if (!peminjamValue || peminjamValue.trim() === '') {
                iziToast.warning({
                    title: 'Peringatan!',
                    message: 'Nama Peminjam wajib diisi',
                    position: 'topRight'
                });
                return;
            }

            if (detail.length === 0) {
                iziToast.warning({
                    title: 'Peringatan!',
                    message: 'Detail barang masih kosong',
                    position: 'topRight'
                });
                return;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '/api/v4/it/epinjam/simpan',
                data: JSON.stringify(data),
                contentType: 'application/json',
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.find("i")
                        .removeClass("ri-send-plane-fill")
                        .addClass("ri-refresh-line ri-spin");
                },
                success: function(res) {
                    loadTambah();
                    refresh();
                    clearInput();
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: res.message ?? res,
                        position: 'topRight'
                    });
                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    btn.find("i")
                        .removeClass("ri-refresh-line ri-spin")
                        .addClass("ri-send-plane-fill");
                    btn.prop('disabled', false);
                }
            });
        }

        function ubah(id) {
            $.ajax({
                url: `/api/v4/it/epinjam/ubah/${id}`,
                type: "GET",
                beforeSend: function() {
                    isInitEdit = true;
                },
                success: function(res) {

                    const data = res.show;

                    $('#edit_id').val(data.id);

                    // =========================
                    // 1. PEMINJAM
                    // =========================
                    if (data.user_pinjam) {

                        let html = `
                            <select class="form-control select2" id="edit_peminjam" style="width:100%">
                                <option value="">Pilih Pegawai</option>
                            </select>
                        `;

                        $('#edit_peminjam_wrapper').empty().html(html);

                        res.users.forEach(u => {
                            $('#edit_peminjam').append(`
                                <option value="${u.id}" ${u.id == data.user_pinjam.id ? 'selected' : ''}>
                                    ${u.nama}
                                </option>
                            `);
                        });

                        $('#edit_peminjam').select2({ width: '100%' });

                    } else {

                        $('#edit_peminjam_wrapper').empty().html(`
                            <input type="text" class="form-control" id="edit_peminjam_manual"
                                value="${data.nama_user_pinjam ?? ''}">
                        `);
                    }

                    // =========================
                    // 2. FIELD UTAMA
                    // =========================
                    $('#edit_tgl_pinjam').val(data.tgl_pinjam);
                    $('#edit_keperluan').val(data.keperluan);

                    // =========================
                    // 3. FLATTEN SEMUA BARANG
                    // =========================
                    let allBarang = [];

                    res.barang.forEach(k => {
                        k.barang.forEach(b => {
                            allBarang.push({
                                id: b.id,
                                nama: b.nama,
                                kategori_id: k.id
                            });
                        });
                    });

                    // =========================
                    // 4. RESET TABLE
                    // =========================
                    $('#edit-body-barang').empty();

                    // =========================
                    // 5. RENDER LIST PINJAM
                    // =========================
                    data.list.forEach(item => {

                        let kategoriOption = '<option value="">-- Pilih Kategori --</option>';

                        $.each(res.barang, function (i, k) {
                            kategoriOption += `
                                <option value="${k.id}"
                                    ${k.id == item.barang?.id_kategori ? 'selected' : ''}>
                                    ${k.nama}
                                </option>
                            `;
                        });

                        let barangOption = '<option value="">-- Pilih Barang --</option>';

                        let selectedKategori = res.barang.find(k =>
                            k.id == item.barang?.kategori?.id
                        );

                        if (selectedKategori) {

                            $.each(selectedKategori.barang, function (i, b) {

                                barangOption += `
                                    <option value="${b.id}"
                                        ${Number(b.id) === Number(item.id_barang) ? 'selected' : ''}>
                                        ${b.nama}
                                    </option>
                                `;
                            });

                        } else {

                            // fallback kalau kategori tidak ketemu
                            barangOption = `
                                <option value="${item.id_barang}" selected>
                                    ${item.barang?.nama ?? '-'}
                                </option>
                            `;
                        }

                        let row = `
                            <tr class="edit-row">

                                <td>
                                    <select class="form-control edit-kategori">
                                        ${kategoriOption}
                                    </select>
                                </td>

                                <td>
                                    <select class="form-control edit-barang">
                                        ${barangOption}
                                    </select>
                                </td>

                                <td>
                                    <input class="form-control edit-peruntukan"
                                        value="${item.peruntukan ?? ''}">
                                </td>

                                <td>
                                    <input class="form-control edit-tgl"
                                        value="${item.tgl_rencana_kembali ?? ''}">
                                </td>

                                <td>
                                    <button type="button"
                                        class="btn btn-danger btn-sm"
                                        onclick="$(this).closest('tr').remove()">
                                        Hapus
                                    </button>
                                </td>

                            </tr>
                        `;

                        $('#edit-body-barang').append(row);
                    });
                    $('#edit-table-row .edit-kategori').trigger('change');

                    // =========================
                    // 6. SHOW MODAL
                    // =========================
                    $('#modalUbah').modal('show');
                },
                error: function(xhr) {
                    let message = 'Terjadi kesalahan sistem';
                    if (xhr.responseJSON?.message) {
                        message = xhr.responseJSON.message;
                    }
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: message,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    isInitEdit = false;
                }
            });
        }

        function prosesUbah() {

            let id = $('#edit_id').val();

            let detail = [];

            $('#edit-body-barang tr').each(function () {

                detail.push({
                    barang_id: $(this).find('.edit-barang').val(),
                    peruntukan: $(this).find('.edit-peruntukan').val(),
                    tgl_kembali: $(this).find('.edit-tgl').val()
                });
            });

            let peminjam = $('#edit_peminjam').length
                ? $('#edit_peminjam').val()
                : $('#edit_peminjam_manual').val();

            let peminjamType = $('#edit_peminjam').length ? 'user' : 'manual';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/v4/it/epinjam/ubah/${id}/proses`,
                type: "PUT",
                contentType: "application/json",

                data: JSON.stringify({
                    peminjam_type: peminjamType,
                    user_id: peminjamType === 'user' ? peminjam : null,
                    peminjam_nama: peminjamType === 'manual' ? peminjam : null,
                    tgl_pinjam: $('#edit_tgl_pinjam').val(),
                    keperluan: $('#edit_keperluan').val(),
                    detail: detail
                }),

                success: function(res) {

                    $('#modalEdit').modal('hide');
                    loadTambah();
                    refresh();
                    clearInput();

                    iziToast.success({
                        title: 'Sukses',
                        message: res.message
                    });
                },

                error: function(err) {
                    iziToast.error({
                        message: err.responseJSON.message
                    });
                }
            });
        }

        function hapus(id) {

            if (!confirm('Yakin ingin menghapus data ini?')) return;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/v4/it/epinjam/hapus/${id}`,
                type: "DELETE",
                success: function(res) {
                    loadTambah();
                    refresh();
                    clearInput();
                    iziToast.success({
                        title: 'Sukses',
                        message: res.message
                    });
                },
                error: function(err) {
                    iziToast.error({
                        message: err.responseJSON.message
                    });
                }
            });

        }

        function clearInput() {

            // Form utama
            $('#peminjam').val(null).trigger('change');
            // $('#tgl_pinjam').val('');
            $('#keperluan').val('');

            // Flatpickr utama (jika ada)
            const fpPinjam = $('#tgl_pinjam')[0]?._flatpickr;
            if (fpPinjam) {
                fpPinjam.setDate(new Date(), true);
            }
            // $('#tgl_pinjam')[0]?._flatpickr?.clear();

            // Hapus semua row barang kecuali pertama
            $('.row-barang').not(':first').remove();

            // Reset row pertama
            let firstRow = $('.row-barang:first');

            firstRow.find('.kategori').val(null).trigger('change');
            firstRow.find('.barang').val(null).trigger('change').prop('disabled',true);
            firstRow.find('.peruntukan').val('');

            let tglKembali = firstRow.find('.tgl_kembali')[0];
            if (tglKembali?._flatpickr) {
                tglKembali._flatpickr.clear();
            } else {
                firstRow.find('.tgl_kembali').val('');
            }

        }

        function refresh() {
            const btn = $('#btn-refresh');
            if ($.fn.DataTable.isDataTable('#dttable')) {
                $('#dttable').DataTable().clear().destroy();
            }
            $("#tampil-tbody").empty().append(`<tr><td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/v4/it/epinjam",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.find("i").addClass('ri-spin');
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    var date = getDateTime();
                    content = ``;
                    res.show.forEach(item => {
                        let barang = '';
                        item.list.forEach(list => {
                            barang += `
                                <li class="list-group-item d-sm-flex justify-content-between align-items-start border-0" style="padding:0">
                                    <div class="ms-2 me-auto text-muted">
                                        <div class="fw-medium fs-14 text-default">${list.barang.kategori.nama} - ${list.barang.nama}</div>
                                        ${list.peruntukan ? '<small><b class="text-orange">Peruntukan : '+list.peruntukan+'</b></small><br>' : '' }
                                        ${list.tgl_rencana_kembali ? '<small><b class="text-danger">Renc. Kembali : '+formatTanggalOnlyIndo(list.tgl_rencana_kembali)+'</b></small>' : '' }
                                    </div>
                                </li>
                            `;
                        });
                        var crdet = new Date(item.created_at).toLocaleString("sv-SE").substring(0, 10);
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        if (item.tgl_kembali) {
                            status = 'Dikembalikan';
                            colorBtn = 'success';
                        } else {
                            if (crdet == date) {
                                status = 'Mulai Dipinjam';
                                colorBtn = 'info';
                            } else {
                                status = 'Sedang Dipinjam';
                                colorBtn = 'primary';
                            }
                        }
                        content += `<tr id="data` + item.id + `">`;
                        content += `<td><center>
                                <div class='btn-group'>
                                    <a href='javascript:void(0);' class='link-${colorBtn} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' id="dropdown-${item.id}" data-bs-toggle='dropdown' aria-expanded='false'>${item.id}</a>
                                    <ul class='dropdown-menu dropdown-menu-end'>`;
                                    if (item.status == 1) {
                                        content += `<li><a href="javascript:void(0);" class='dropdown-item text-info' onclick="ubahStatusBarang(${item.id})"><i class="ri-supabase-line me-1"></i> Perbarui Status</a></li>`;
                                        if (updet == date) {
                                            // content += `<li><a href="javascript:void(0);" class='dropdown-item text-warning' onclick="ubah(${item.id})"><i class="ri-edit-line me-1"></i> Ubah</a></li>`;
                                            content += `<li><a href="javascript:void(0);" class='dropdown-item disabled'><i class="ri-edit-line me-1"></i> Ubah</a></li>`;
                                        } else {
                                            content += `<li><a href="javascript:void(0);" class='dropdown-item disabled'><i class="ri-edit-line me-1"></i> Ubah</a></li>`;
                                        }
                                        content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(${item.id})"><i class="ri-delete-bin-line me-1"></i> Hapus</a></li>`;
                                    } else {
                                        content += `<li><a href="javascript:void(0);" class='dropdown-item disabled'><i class="ri-supabase-line me-1"></i> Perbarui Status</a></li>
                                                    <li><a href="javascript:void(0);" class='dropdown-item disabled'><i class="ri-edit-line me-1"></i> Ubah</a></li>
                                                    <li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="ri-delete-bin-line me-1"></i> Hapus</a></li>`;
                                    }
                        content += `</ul></div></center></td>`;

                        let nama = item.nama_user_pinjam
                                ?? item.user_pinjam?.nama
                                ?? item.user_pinjam?.name
                                ?? '-';
                        let role = item.user_pinjam?.roles?.length
                                ? item.user_pinjam.roles
                                    .map(r => r.deskripsi ?? r.name)
                                    .join(', ')
                                : '-';
                        let tipePeminjam = item.user_pinjam
                                ? `<span class="badge bg-primary-transparent p-1">Internal RS</span>`
                                : `<span class="badge bg-warning-transparent p-1">Luar RS</span>`;
                        content += `<td>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0 text-truncate link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline'>
                                                    ${nama}&nbsp;${tipePeminjam}
                                                </a>
                                                <a class='mb-0 text-truncate text-teal fs-13' style="white-space: normal; word-wrap: break-word; word-break: break-word;" class="text-uppercase">
                                                    ${role}
                                                </a>
                                                <small class='text-muted text-wrap'>${item.keperluan ? '<b class="text-warning">Keperluan</b> : '+item.keperluan : ''}</small>
                                            </div>
                                        </div>
                                    </td>`;
                        // content += `<td style="white-space: normal; word-wrap: break-word; word-break: break-word;" class="text-uppercase">${role}</td>`;
                        content += `<td><span class="badge bg-${colorBtn} fs-15">${status}</span></td>`;

                        const tglPinjam = dayjs(item.tgl_pinjam);
                        const badgePj = dayjs().diff(tglPinjam, 'month', true) >= 1
                            ? '<span class="badge bg-danger-transparent p-1"><i class="ri-alarm-warning-line me-1"></i> Risky</span>'
                            : '<span class="badge bg-success-transparent p-1"><i class="ri-flag-line me-1"></i> Safe</span>';
                        const tooltipPj = dayjs().diff(tglPinjam, 'month', true) >= 1
                            ? 'Peminjaman telah melewati batas waktu AMAN (1 Bulan)'
                            : 'Peminjaman dilakukan masih dalam kurun waktu kurang dari 1 Bulan';
                        content += `<td>${formatTanggalIndo(item.tgl_pinjam)}<br><div data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left"
                                        data-bs-html="true" title="${tooltipPj}"><small class="me-1">(<b class="text-orange">${tglPinjam.fromNow()}</b>)</small> ${badgePj}</div></td>`;

                        let adminNamaKembali = item.user_admin_kembali?.nama ?? '';
                        content += `<td>${item.tgl_kembali? formatTanggalIndo(item.tgl_kembali) + `<br><small class='text-muted text-wrap'>Dikembalikan Kpd. ${adminNamaKembali}</small>` : '-'}</td>`;

                        // LIST BARANG
                        content += `<td style="white-space: normal; word-wrap: break-word; word-break: break-word;">
                                        <ol class="list-group list-group-numbered">${barang}</ol>
                                    </td>`;

                        let adminNama = item.user_admin_pinjam?.nama ?? '-';
                        content += `<td>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0 text-wrap'>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</a>
                                                <small class='text-muted text-wrap'>Ditambahkan Oleh ${adminNama}</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `</tr>`;

                    });
                    $('#tampil-tbody').append(content);
                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger : 'hover'
                    })
                    var table = $('#dttable').DataTable({
                        order: [
                            [6, "desc"]
                        ],
                        // bAutoWidth: false,
                        // aoColumns : [
                        //     { sWidth: '5%' },
                        //     { sWidth: '25%' },
                        //     { sWidth: '10%' },
                        //     { sWidth: '15%' },
                        //     { sWidth: '20%' },
                        //     { sWidth: '15%' },
                        //     { sWidth: '10%' },
                        // ],
                        displayLength: 15,
                    });
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan System!',
                        message: xhr.responseText ?? 'Terjadi kesalahan saat memuat data.',
                        position: 'topRight'
                    });
                },
                complete: function() {
                    btn.prop('disabled', false);
                    btn.find("i").removeClass("ri-spin");
                }
            });
        }

        // function ubahStatusBarang(id, status)
        // {
        //     $('#status_list_id').val(id);

        //     $('#status_barang')
        //         .val(status)
        //         .trigger('change');

        //     $('#modalStatusBarang').modal('show');
        // }

        // function simpanStatusBarang()
        // {
        //     let id = $('#status_list_id').val();
        //     let status = $('#status_barang').val();

        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: "/api/v4/it/epinjam/updatestatus",
        //         type: "POST",
        //         data: {
        //             id: id,
        //             status: status
        //         },
        //         beforeSend:function(){
        //             $('#modalStatusBarang button')
        //                 .prop('disabled',true);
        //         },
        //         success:function(res){
        //             $('#modalStatusBarang').modal('hide');
        //             iziToast.success({
        //                 title:'Berhasil',
        //                 message:res.message,
        //                 position:'topRight'
        //             });
        //             loadTambah();
        //             refresh();
        //             clearInput();
        //         },
        //         error:function(xhr){
        //             iziToast.error({
        //                 title:'Gagal',
        //                 message:xhr.responseJSON.message,
        //                 position:'topRight'
        //             });
        //         },
        //         complete:function(){
        //             $('#modalStatusBarang button')
        //                 .prop('disabled',false);
        //         }
        //     });
        // }

        function ubahStatusBarang(id)
        {
            const btn = $('#dropdown-' + id);

            $.ajax({
                url: '/api/v4/it/epinjam/updatestatus/' + id,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.empty().html('<i class="ri-refresh-line ri-spin"></i>');
                },
                success: function(res) {

                    $('#id_epinjam').val(id);

                    let html='';

                    res.list.forEach(function(item){

                        html += `
                            <div class="row border rounded p-2 mb-1 mt-1">

                                <div class="col-md-8 px-1 mb-2">

                                    <b>${item.barang.nama}</b><br>

                                    <small class="text-muted">
                                        ${item.barang.kategori.nama}
                                    </small>

                                    ${item.tgl_rencana_kembali?`<small class="text-danger">
                                        <i class="ri-arrow-right-s-line text-warning"></i> Renc. Dikembalikan pada `+formatTanggalOnlyIndo(item.tgl_rencana_kembali)+`
                                    </small>`:``}
                                </div>

                                <div class="col-md-4 px-0">

                                    <select
                                        class="form-select status-item"
                                        data-id="${item.id}"
                                        ${item.status==0?'disabled':''}>

                                        <option
                                            value="1"
                                            ${item.status==1?'selected':''}>

                                            Dipinjam

                                        </option>

                                        <option
                                            value="0"
                                            ${item.status==0?'selected':''}>

                                            Dikembalikan

                                        </option>

                                    </select>

                                </div>

                            </div>
                        `;

                    });

                    $('#list-status-barang').html(html);

                    $('#modalStatusBarang').modal('show');
                },
                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    btn.prop('disabled', false).empty().text(id);
                }
            });
        }

        function simpanStatusBarang()
        {

            let detail=[];

            $('.status-item').each(function(){

                detail.push({

                    id:$(this).data('id'),

                    status:$(this).val()

                });

            });


            $.ajax({

                headers:{
                    'X-CSRF-TOKEN':
                    $('meta[name="csrf-token"]').attr('content')
                },

                url:'/api/v4/it/epinjam/updatestatus',

                type:'POST',

                data:{
                    detail:detail
                },

                success:function(res){

                    $('#modalStatusBarang').modal('hide');

                    iziToast.success({

                        title:'Berhasil',

                        message:res.message

                    });

                    refresh();

                    loadTambah();

                }

            });

        }

        function selesaikanSemua()
        {
            let id = $('#id_epinjam').val();

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Seluruh barang pada transaksi ini akan dikembalikan. Lanjutkan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kembalikan Semua',
                cancelButtonText: 'Batal'
            }).then((result)=>{

                if(!result.isConfirmed){
                    return;
                }

                $.ajax({

                    headers:{
                        'X-CSRF-TOKEN':
                        $('meta[name="csrf-token"]').attr('content')
                    },

                    url:'/api/v4/it/epinjam/updatestatussemua',

                    type:'POST',

                    data:{
                        id:id
                    },

                    beforeSend:function(){

                        $('#modalStatusBarang button')
                            .prop('disabled',true);

                    },

                    success:function(res){

                        $('#modalStatusBarang').modal('hide');

                        iziToast.success({

                            title:'Berhasil',

                            message:res.message,

                            position:'topRight'

                        });

                        refresh();

                        loadTambah();

                    },

                    error:function(xhr){

                        iziToast.error({

                            title:'Gagal',

                            message:xhr.responseJSON.message,

                            position:'topRight'

                        });

                    },

                    complete:function(){

                        $('#modalStatusBarang button')
                            .prop('disabled',false);

                    }

                });

            });

        }

        function formatTanggalIndo(datetime) {
            if (!datetime) return '';

            const bulan = [
                'Januari','Februari','Maret','April','Mei','Juni',
                'Juli','Agustus','September','Oktober','November','Desember'
            ];

            const d = new Date(datetime.replace(' ', 'T'));

            const tgl   = d.getDate().toString().padStart(2, '0');
            const bln   = bulan[d.getMonth()];
            const thn   = d.getFullYear();
            const jam   = d.getHours().toString().padStart(2, '0');
            const menit= d.getMinutes().toString().padStart(2, '0');

            return `${tgl} ${bln} ${thn} ${jam}:${menit}`;
        }

        function formatTanggalOnlyIndo(date) {
            if (!date) return '';

            const bulan = [
                'Januari','Februari','Maret','April','Mei','Juni',
                'Juli','Agustus','September','Oktober','November','Desember'
            ];

            const d = new Date(date.replace(' ', 'T'));

            const tgl   = d.getDate().toString().padStart(2, '0');
            const bln   = bulan[d.getMonth()];
            const thn   = d.getFullYear();

            return `${tgl} ${bln} ${thn}`;
        }
    </script>
@endsection
