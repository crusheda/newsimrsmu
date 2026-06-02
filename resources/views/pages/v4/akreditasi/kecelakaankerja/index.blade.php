@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    <b class="text-orange link-underline-orange text-decoration-underline">Pelaporan Kecelakaan Kerja</b> (<b class="text-danger">Accident Report</b>)
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Akreditasi</a>
                    </li>
                    <li class="breadcrumb-item pe-none" aria-current="page">
                        MFK
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Kecelakaan Kerja
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <button class="btn btn-primary" onclick="window.location='{{ route('v4.akreditasi.kecelakaankerja.tambah') }}'">
                            <i class="fas fa-plus-square me-1"></i>Tambah Data</button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                title="<i class='fa-fw fas fa-sync nav-icon me-1'></i> <span>Segarkan Tabel</span>" onclick="refresh()">
                                <i class="fa-fw fas fa-sync nav-icon"></i></button>
                            @can('admin_k3')
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="<i class='fa-fw fas fa-infinity nav-icon me-1'></i> <span>Tampilkan Semua Data</span>" onclick="showAll()">
                                    <i class="fa-fw fas fa-infinity nav-icon"></i></button>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light shadow-sm" role="alert">
                            <small><i class="ti ti-arrow-narrow-right text-primary me-1"></i> Data default yang ditampilkan dibatasi 100 data surat</small> <br>
                            <small><i class="ti ti-arrow-narrow-right text-primary me-1"></i> <b class="text-warning">Ubah</b> / <b class="text-danger">Hapus</b> data hanya dapat dilakukan oleh User yang bersangkutan dan pada hari yang sama dengan hari data disubmit</small> <br>
                            <small><i class="ti ti-arrow-narrow-right text-primary me-1"></i> Untuk menampilkan semua data, klik tombol <i class='fa-fw fas fa-infinity nav-icon text-danger'></i> di atas (Khusus <u>Admin</u>)</small>
                        </div>
                        <div class="table-responsive">
                            <table id="dttable" class="table dt-responsive table-hover w-100 align-middle">
                                <thead>
                                    <tr>
                                        <th><center>#ID</center></th>
                                        <th>KORBAN</th>
                                        <th>UNIT</th>
                                        <th>LOKASI</th>
                                        <th>TGL DITAMBAHKAN</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody">
                                    <tr>
                                        <td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td>
                                    </tr>
                                </tbody>
                                <tfoot class="bg-whitesmoke">
                                    <tr>
                                        <th><center>#ID</center></th>
                                        <th>KORBAN</th>
                                        <th>UNIT</th>
                                        <th>LOKASI</th>
                                        <th>TGL DITAMBAHKAN</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <table id="dttable2" class="table dt-responsive table-hover w-100 align-middle" hidden>
                                <thead>
                                    <tr>
                                        <th><center>#ID</center></th>
                                        <th>KORBAN</th>
                                        <th>UNIT</th>
                                        <th>LOKASI</th>
                                        <th>TGL</th>
                                        <th>JENIS KECELAKAAN</th>
                                        <th>KRONOLOGI KECELAKAAN</th>
                                        <th>KERUGIAN PADA MANUSIA</th>
                                        <th>TANGGAL LAHIR / USIA</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>ANGGOTA TUBUH CEDERA</th>
                                        <th>PENANGANAN</th>
                                        <th>KERUGIAN ASET</th>
                                        <th>KERUGIAN LINGKUNGAN</th>
                                        <th>1. TINDAKAN TIDAK AMAN</th>
                                        <th>1. KONDISI TIDAK AMAN</th>
                                        <th>2. FAKTOR PERSONAL</th>
                                        <th>2. FAKTOR PEKERJAAN</th>
                                        <th>3. PERALATAN KERJA</th>
                                        <th>3. BENDA BERGERAK</th>
                                        <th>3. MESIN</th>
                                        <th>3. BEJANA TEKAN</th>
                                        <th>3. MATERIAL</th>
                                        <th>3. ALAT LISTRIK</th>
                                        <th>3. ALAT BERAT</th>
                                        <th>3. RADIASI</th>
                                        <th>3. KENDARAAN</th>
                                        <th>3. BINATANG</th>
                                        <th>3. LAIN-LAIN</th>
                                        <th>RENCANA TINDAKAN</th>
                                        <th>TARGET WAKTU</th>
                                        <th>WEWENANG</th>
                                        <th>TERAKHIR DIUPDATE</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody2">
                                    <tr>
                                        <td colspan="40" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td>
                                    </tr>
                                </tbody>
                                <tfoot class="bg-whitesmoke">
                                    <tr>
                                        <th><center>#ID</center></th>
                                        <th>KORBAN</th>
                                        <th>UNIT</th>
                                        <th>LOKASI</th>
                                        <th>TGL</th>
                                        <th>JENIS KECELAKAAN</th>
                                        <th>KRONOLOGI KECELAKAAN</th>
                                        <th>KERUGIAN PADA MANUSIA</th>
                                        <th>TANGGAL LAHIR / USIA</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>ANGGOTA TUBUH CEDERA</th>
                                        <th>PENANGANAN</th>
                                        <th>KERUGIAN ASET</th>
                                        <th>KERUGIAN LINGKUNGAN</th>
                                        <th>1. TINDAKAN TIDAK AMAN</th>
                                        <th>1. KONDISI TIDAK AMAN</th>
                                        <th>2. FAKTOR PERSONAL</th>
                                        <th>2. FAKTOR PEKERJAAN</th>
                                        <th>3. PERALATAN KERJA</th>
                                        <th>3. BENDA BERGERAK</th>
                                        <th>3. MESIN</th>
                                        <th>3. BEJANA TEKAN</th>
                                        <th>3. MATERIAL</th>
                                        <th>3. ALAT LISTRIK</th>
                                        <th>3. ALAT BERAT</th>
                                        <th>3. RADIASI</th>
                                        <th>3. KENDARAAN</th>
                                        <th>3. BINATANG</th>
                                        <th>3. LAIN-LAIN</th>
                                        <th>RENCANA TINDAKAN</th>
                                        <th>TARGET WAKTU</th>
                                        <th>WEWENANG</th>
                                        <th>TERAKHIR DIUPDATE</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            refresh();
        });

        // FUNCTION-FUNCTION
        function refresh() {
            $("#btn-refresh").find("i").toggleClass("fa-sync fa-spinner fa-spin");
            $("#tampil-tbody2").empty();
            $('#dttable2').DataTable().clear().destroy();
            $("#dttable2").prop('hidden',true);
            $("#dttable").prop('hidden',false);
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="40"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );

            // AJAX TABLE GET
            $.ajax({
                url: "/api/v4/akreditasi/kecelakaankerja/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    var userID = @json(Auth::user()->id);
                    var adminID = @json(Auth::user()->can('admin_k3'));
                    // var date = getDateTime();
                    var date = new Date().toLocaleDateString('en-ZA');
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        content = `<tr id='data"+ item.id +"'>`;
                        content += `<td><center><div class='btn-group'><a href='javascript:void(0);' class='link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false' value="animate__rubberBand">`+item.id+`</a><ul class='dropdown-menu dropdown-menu-right'>`;
                        if (adminID == true) {
                            content += `<li><a href='/v4/akreditasi/kecelakaankerja/ubah/`+item.id+`' class='dropdown-item text-warning'><i class='fas fa-edit me-1'></i> Ubah</a></li>`;
                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` + item.id + `)"><i class='fas fa-trash me-1'></i> Hapus</a></li>`;
                        } else {
                            if (item.user == userID) {
                                if (updet == date) {
                                    content += `<li><a href='/v4/akreditasi/kecelakaankerja/ubah/`+item.id+`' class='dropdown-item text-warning'><i class='fas fa-edit me-1'></i> Ubah</a></li>`;
                                    content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` + item.id + `)"><i class='fas fa-trash me-1'></i> Hapus</a></li>`;
                                } else {
                                    content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-edit me-1'></i> Ubah</a></li>`;
                                    content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-trash me-1'></i> Hapus</a></li>`;
                                }
                            } else {
                                content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-edit me-1'></i> Ubah</a></li>`;
                                content += `<li><a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-trash me-1'></i> Hapus</a></li>`;
                            }
                        }
                        content += `</ul></center></td><td>`;
                        if (item.korban != null) {
                            res.user.forEach(key => {
                                if (item.korban == key.id) {
                                    content += key.nama;
                                }
                            })
                        } else {
                            content += item.korban_luar;
                        }
                        content += "</td><td class='text-uppercase'>" + (item.role || '-') + "</td><td>" + item.lokasi + "</td><td>" + item.tgl + "</td>";
                        content += `</tr>`;
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [4, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '8%' },
                            { sWidth: '32%' },
                            { sWidth: '25%' },
                            { sWidth: '20%' },
                            { sWidth: '15%' },
                        ],
                        displayLength: 15,
                    });

                    // SELECT PICKER
                    var t = $(".select2");
                    t.length && t.each(function() {
                        var e = $(this);
                        e.wrap('<div class="position-relative"></div>').select2({
                            placeholder: "Pilih",
                            dropdownParent: e.parent()
                        })
                    })

                    iziToast.success({
                        title: 'Pesan Refresh!',
                        message: 'Berhasil menampilkan semua data dengan kolom terbatas',
                        position: 'topRight'
                    });

                }
            });
            $("#btn-refresh").find("i").toggleClass("fa-spinner fa-spin fa-sync");
        }

        function showAll() {
            $("#btn-show-all").find("i").toggleClass("fa-infinity fa-spinner fa-spin");
            $("#tampil-tbody").empty();
            $('#dttable').DataTable().clear().destroy();
            $("#tampil-tbody2").empty().append(
                `<tr><td colspan="40"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );

            // AJAX TABLE GET
            $.ajax({
                url: "/api/v4/akreditasi/kecelakaankerja/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody2").empty();
                    $('#dttable2').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        // var updet = item.updated_at.substring(0, 10);
                        content = `<tr id='data`+item.id+`'>`;
                        content += `<td><center>`+item.id+`</center></td><td>`;
                        if (item.korban != null) {
                            res.user.forEach(key => {
                                if (item.korban == key.id) {
                                    content += key.nama;
                                }
                            })
                        } else {
                            content += item.korban_luar;
                        }
                        content += "</td><td>" + item.role + "</td><td>" + item.lokasi + "</td><td>" + item.tgl + "</td>";
                        // GET JENIS KECELAKAAN
                        var jenis = null;
                        if (item.jenis == 1) { jenis = 'Menabrak'; }
                        if (item.jenis == 2) { jenis = 'Tertabrak'; }
                        if (item.jenis == 3) { jenis = 'Terperangkap'; }
                        if (item.jenis == 4) { jenis = 'Terbentur / Terpukul'; }
                        if (item.jenis == 5) { jenis = 'Tergelincir'; }
                        if (item.jenis == 6) { jenis = 'Terjepit'; }
                        if (item.jenis == 7) { jenis = 'Tersangkut'; }
                        if (item.jenis == 8) { jenis = 'Tertimbun'; }
                        if (item.jenis == 9) { jenis = 'Terhirup'; }
                        if (item.jenis == 10) { jenis = 'Tenggelam'; }
                        if (item.jenis == 11) { jenis = 'Jatuh dari ketinggian yang sama'; }
                        if (item.jenis == 12) { jenis = 'Jatuh dari ketinggian yang berbeda'; }
                        if (item.jenis == 13) { jenis = 'Kontak dengan (Arus Listrik, Suhu Panas, Suhu Dingin, Terpapar Radiasi, Bahan Kimia Berbahaya)'; }
                        if (item.jenis == 14) { jenis = item.lain1; }
                        content += `<td>${jenis != null? jenis:'-'}</td>`;
                        content += `<td>`+ item.kronologi +`</td>`;
                        // GET KERUGIAN MANUSIA
                        var kerugian = null;
                        if (item.kerugian == 1) {
                            kerugian = 'Tak Cedera';
                        }
                        if (item.kerugian == 2) {
                            kerugian = 'Cedera Ringan';
                        }
                        if (item.kerugian == 3) {
                            kerugian = 'Cedera Sedang';
                        }
                        if (item.kerugian == 4) {
                            kerugian = 'Cedera Berat';
                        }
                        if (item.kerugian == 5) {
                            kerugian = 'Meninggal/Fatal';
                        }
                        content += `<td>${kerugian != null? kerugian:'-'}</td>`;
                        content += `<td>`+ item.lahir +` / `+ item.usia +`</td>`;
                        content += `<td>`+ item.jk +`</td>`;
                        content += `<td>`+ item.cedera +`</td>`;
                        content += `<td>`+ item.penanganan +`</td>`;
                        content += `<td>`+ item.k_aset +`</td>`;
                        content += `<td>`+ item.k_lingkungan +`</td>`;
                        content += `<td>`+ item.tta +`</td>`;
                        content += `<td>`+ item.kta +`</td>`;
                        content += `<td>`+ item.f_personal +`</td>`;
                        content += `<td>`+ item.f_pekerjan +`</td>`;
                        content += `<td>`+ item.p_kerja +`</td>`;
                        content += `<td>`+ item.mesin +`</td>`;
                        content += `<td>`+ item.material +`</td>`;
                        content += `<td>`+ item.alat_berat +`</td>`;
                        content += `<td>`+ item.kendaraan +`</td>`;
                        content += `<td>`+ item.benda_bergerak +`</td>`;
                        content += `<td>`+ item.bejana_tekan +`</td>`;
                        content += `<td>`+ item.alat_listrik +`</td>`;
                        content += `<td>`+ item.radiasi +`</td>`;
                        content += `<td>`+ item.binatang +`</td>`;
                        content += `<td>`+ item.lain2 +`</td>`;
                        content += `<td>`+ item.r_tindakan +`</td>`;
                        content += `<td>`+ item.t_waktu +`</td>`;
                        content += `<td>`+ item.wewenang +`</td>`;
                        content += `<td>`+ item.updated_at +`</td>`;
                        content += `</tr>`;
                        $('#tampil-tbody2').append(content);
                    });
                    var table = $('#dttable2').DataTable({
                        order: [
                            [4, "desc"]
                        ],
                        columnDefs: [
                            { visible: false, targets: [5] },
                            { visible: false, targets: [6] },
                            { visible: false, targets: [7] },
                            { visible: false, targets: [8] },
                            { visible: false, targets: [9] },
                            { visible: false, targets: [10] },
                            { visible: false, targets: [11] },
                            { visible: false, targets: [12] },
                            { visible: false, targets: [13] },
                            { visible: false, targets: [14] },
                            { visible: false, targets: [15] },
                            { visible: false, targets: [16] },
                            { visible: false, targets: [17] },
                            { visible: false, targets: [18] },
                            { visible: false, targets: [19] },
                            { visible: false, targets: [20] },
                            { visible: false, targets: [21] },
                            { visible: false, targets: [22] },
                            { visible: false, targets: [23] },
                            { visible: false, targets: [24] },
                            { visible: false, targets: [25] },
                            { visible: false, targets: [26] },
                            { visible: false, targets: [27] },
                            { visible: false, targets: [28] },
                            { visible: false, targets: [29] },
                            { visible: false, targets: [30] },
                            { visible: false, targets: [31] },
                        ],
                        displayLength: 15,
                    });

                    iziToast.warning({
                        title: 'Pesan Tambahan!',
                        message: 'Tombol Column Visibility untuk menampilkan kolom terpilih pada tabel',
                        position: 'topRight'
                    });
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Silakan klik tombol Excel untuk mengekspor semua data ke Excel',
                        position: 'topRight'
                    });
                    $("#dttable").prop('hidden',true);
                    $("#dttable2").prop('hidden',false);
                }
            });
            $("#btn-show-all").find("i").toggleClass("fa-spinner fa-spin fa-infinity");
        }

        function hapus(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Ingin menghapus Laporan ID : ' + id,
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
                        url: "/api/v4/akreditasi/kecelakaankerja/" + id + "/hapus",
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Pesan Sukses!',
                                message: 'Laporan telah berhasil dihapus',
                                position: 'topRight'
                            });
                            // fresh();
                            window.location.reload();
                        },
                        error: function(res) {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: 'Laporan gagal dihapus',
                                position: 'topRight'
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection
