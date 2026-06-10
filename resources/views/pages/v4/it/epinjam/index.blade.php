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
                                <label class="form-label">Pilih Pegawai Peminjam (<a class="text-danger">*</a>)</label>
                                <select class="select2 form-control" id="peminjam" style="width: 100%" required></select>
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
                        <button class="btn btn-secondary-transparent" onclick="clearInput()"><i class="ri-edit-line me-1"></i> Kosongkan</button>
                        <button class="btn btn-primary" id="btn-simpan-ajukan" onclick="simpan()"><i class="ri-send-plane-fill me-1"></i> Submit</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">Riwayat <b class="text-teal">Peminjaman</b></h6>
                        <div class="btn-group my-1">
                            <button type="button" class="btn btn-sm btn-warning-transparent btn-wave" onclick="refresh()" id="btn-refresh">
                                <i class="ri-refresh-line me-1"></i> Refresh
                            </button>
                            <button class="btn btn-sm btn-primary-transparent btn-wave dropdown-toggle dropdown-toggle-split me-2" type="button" id="defaultDropdown"
                                data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false"> Menu Admin </button>
                            <ul class="dropdown-menu" aria-labelledby="defaultDropdown" style="">
                                <li><a class="dropdown-item" href="{{ route('v4.it.epinjam.ref.barang') }}">Ref Barang</a></li>
                                {{-- <li><a class="dropdown-item" href="{{ route('v4.it.epinjam.ref.kategori') }}">Ref Kategori</a></li>
                                <li><a class="dropdown-item" href="{{ route('v4.it.epinjam.ref.asal') }}">Ref Asal</a></li> --}}
                                <li><a class="dropdown-item disabled" href="javascript:void(0);"><s>Ref Kategori</s></a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);"><s>Ref Asal</s></a></li>
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
                                        <th>NAMA PEMINJAM</th>
                                        <th>JABATAN</th>
                                        <th>STATUS</th>
                                        <th>WAKTU PEMINJAMAN</th>
                                        <th>DAFTAR BARANG</th>
                                        <th>DIPERBARUI</th>
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
                                        <th>NAMA PEMINJAM</th>
                                        <th>JABATAN</th>
                                        <th>STATUS</th>
                                        <th>WAKTU PEMINJAMAN</th>
                                        <th>DAFTAR BARANG</th>
                                        <th>DIPERBARUI</th>
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

    <script>
        let dataBarang = [];
        let now = new Date();

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

            $('#table-add-row').on('change', '.kategori', function() {
                let kategoriId = $(this).val();
                let row = $(this).closest('tr');
                let barangSelect = row.find('.barang');

                barangSelect.prop('disabled',false).html(
                    '<option value="">-- Pilih Barang --</option>'
                );

                if (!kategoriId) {
                    return;
                }

                let kategori = null;
                $.each(dataBarang, function(i, item) {
                    if (item.id == kategoriId) {
                        kategori = item;
                        return false;
                    }
                });

                if (!kategori) {
                    return;
                }

                let barangOption = '<option value="">-- Pilih Barang --</option>';
                $.each(kategori.barang, function(i, item) {
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
            $.ajax({
                url: "/api/v4/it/epinjam/loadtambah",
                type: "GET",
                dataType: "json",

                success: function(res) {

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

                    // SHOW PEMINJAM
                    $("#peminjam").empty().append(`<option value="" selected hidden>-- Pilih Pegawai --</option>`);
                    res.users.forEach(user => {

                        let roles = user.roles.map(r => r.name).join(', ');

                        $("#peminjam").append(`
                            <option value="${user.id}">
                                ${user.nama} (${roles})
                            </option>
                        `);
                    });
                    $("#peminjam").trigger('change');
                },

                error: function(xhr) {
                    iziToast.error({
                        title: 'Pesan System!',
                        message: xhr.responseText,
                        position: 'topRight'
                    });
                }
            });
        }

        function tambahBarang() { // ADD ROW BARANG

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

            let data = {
                user_id: $('#peminjam').val(),
                tgl_pinjam: $('#tgl_pinjam').val(),
                keperluan: $('#keperluan').val(),
                detail: detail
            };

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
                    refresh();
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
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        if (item.tglKembali) {
                            status = 'Dikembalikan';
                            colorBtn = 'success';
                        } else {
                            if (updet == date) {
                                status = 'Mulai Dipinjam';
                                colorBtn = 'info';
                            } else {
                                status = 'Sedang Dipinjam';
                                colorBtn = 'primary';
                            }
                        }
                        content = `<tr id="data` + item.id + `">`;
                        content += `<td><center>
                                <div class='btn-group'>
                                    <a href='javascript:void(0);' class='link-${colorBtn} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' id="dropdown-${item.id}" data-bs-toggle='dropdown' aria-expanded='false'>${item.id}</a>
                                    <ul class='dropdown-menu dropdown-menu-end'>`;
                                    if (updet == date) {
                                        content +=
                                            `<li><a href="javascript:void(0);" class='dropdown-item text-warning' onclick="showUbah(${item.id})"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                            <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(${item.id})"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                    } else {
                                        content +=
                                            `<li><a href="javascript:void(0);" class='dropdown-item disabled'><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                            <li><a href='javascript:void(0);' class='dropdown-item disabled'><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                    }
                        content += `</ul></div></center></td>`;

                        let nama = item.user_pinjam?.nama ?? item.user_pinjam?.name ?? '-';
                        let role = item.user_pinjam?.roles
                                    ?.map(r => r.name)
                                    .join(', ') ?? '-';
                        content += `<td>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0 text-truncate'>${nama}</a>
                                                <small class='text-muted text-wrap'>${item.keperluan ? 'Keperluan : '+item.keperluan : ''}</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style="white-space: normal; word-wrap: break-word; word-break: break-word;" class="text-uppercase">${role}</td>`;
                        content += `<td><span class="badge bg-${colorBtn}">${status}</span></td>`;
                        content += `<td>${formatTanggalIndo(item.tgl_pinjam)}</td>`;

                        // LIST BARANG
                        content += `<td style="white-space: normal; word-wrap: break-word; word-break: break-word;">
                                        <ol class="list-group list-group-numbered">${barang}</ol>
                                    </td>`;

                        content += `<td>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0 text-wrap'>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</a>
                                                <small class='text-muted text-wrap'>` + item.user_admin_pinjam?.nama ?? '' + `</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `</tr>`;
                        $('#tampil-tbody').append(content);

                        // Showing Tooltip
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger : 'hover'
                        })
                    });
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
