@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Referensi <b class="text-danger link-underline-danger text-decoration-underline">Staf</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">SDI</a>
                    </li>
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Jadwal Dinas</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Referensi Staf
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card custom-card mb-3">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h5 class="mb-0 card-title flex-grow-1">
                            <div class="btn-group">
                                <a class="btn btn-secondary-transparent" href="{{ route('v4.sdi.jadwaldinas') }}" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Kembali"><i class="fas fa-angle-left me-1"></i> Kembali</a>
                                <button class="btn btn-info-transparent" onclick="refresh()" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" id="btn-refresh-table"
                                    title="Refresh - Tabel Staf Anda"><i class="fas fa-sync me-1"></i> Segarkan</button>
                                @can('admin_kepegawaian')
                                    <button class="btn btn-teal-transparent" onclick="refreshAll()" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" id="btn-refreshAll-table"
                                        title="Lihat Semua Staf Unit"><i class="fas fa-infinity me-1"></i> Lihat Semua Staf</button>
                                @endcan
                            </div>
                        </h5>
                        <div class="flex-shrink-0" id="btn-link">
                            {{-- @if ($list['show'])
                                @if ($list['show']->pegawai_id == Auth::user()->id)
                                    <div class="btn-group">
                                        <button id="btn-tambah" class="btn btn-primary" onclick="tambah()" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                            title="Form Tambah" disabled><i class='ti ti-square-plus me-1'></i> Tambah</button>
                                        <button class="btn btn-warning" onclick="ubah({{ $list['show']->id }})" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                            title="Form Ubah"><i class='ti ti-edit me-1'></i> Ubah</button>
                                        <button class="btn btn-danger" onclick="hapus({{ $list['show']->id }})" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                            title="Form Hapus"><i class='ti ti-x me-1'></i> Hapus</button>
                                    </div>
                                @else
                                    <div class="btn-group">
                                        <button id="btn-tambah" class="btn btn-primary disabled" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                            title="Form Tambah" disabled><i class='ti ti-square-plus me-1'></i> Tambah</button>
                                        <button class="btn btn-warning disabled" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                            title="Form Ubah" disabled><i class='ti ti-edit me-1'></i> Ubah</button>
                                        <button class="btn btn-danger disabled" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                            title="Form Hapus" disabled><i class='ti ti-x me-1'></i> Hapus</button>
                                        <button class="btn btn-info" onclick="ambilAlih({{ $list['show']->id }})" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                            title="Form Ambil Alih Admin Jadwal Dinas"><i class='ti ti-switch-3 me-1'></i> Ambil Alih</button>
                                    </div>
                                @endif
                            @else
                                <div class="btn-group">
                                    <button id="btn-tambah" class="btn btn-primary" onclick="tambah()" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Form Tambah"><i class='ti ti-square-plus me-1'></i> Tambah</button>
                                    <button class="btn btn-warning disabled" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Form Ubah" disabled><i class='ti ti-edit me-1'></i> Ubah</button>
                                    <button class="btn btn-danger disabled" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Form Hapus" disabled><i class='ti ti-x me-1'></i> Hapus</button>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light shadow-sm mb-3">
                            <h6>Hal-hal yang perlu <b class="text-primary">diperhatikan</b> !!</h6>
                            <small>
                                Setelah berhasil menambahkan semua Staf pada Unit Anda, <b class="text-danger">DIWAJIBKAN</b> segera melengkapi Data (No.Urutan pada Jadwal) pada masing-masing staf (Klik Atur Karyawan). <br>Tombol Atur Karyawan ada pada masing-masing baris Staf Anda, Kolom <b><u>USERID</u></b>. <br>
                                <i class="ti ti-arrow-narrow-right me-1"></i> Pastikan Staf ditambahkan oleh Admin Jadwal (<b class="text-info">Setiap Unit/Bagian hanya 1 orang</b>), berkaitan dengan kelengkapan data saat pembuatan Jadwal Dinas <br>
                                <i class="ti ti-arrow-narrow-right me-1"></i> Akses <b>Tambah</b> hanya bisa dilakukan apabila Data Shift Karyawan yang bersangkutan belum didaftarkan/tergabung pada <b class="text-danger">UNIT</b> manapun (Belum pernah ditambahkan oleh siapapun) <br>
                                <i class="ti ti-arrow-narrow-right me-1"></i> Akses <b>Ubah</b> maupun <b>Hapus</b> Data Referensi Staf hanya dapat dilakukan oleh Admin Jadwal (User Admin Ref.Staf) <br>
                                <i class="ti ti-arrow-narrow-right me-1"></i> Penambahan Staf hanya dilakukan sekali saja dan dapat digunakan untuk seterusnya, terkecuali apabila terdapat pergantian Data Staf <br>
                                <i class="ti ti-arrow-narrow-right me-1"></i> Hapus Data Staf <b class="text-danger">DAPAT MENGHAPUS</b> riwayat jadwal yang berhubungan dengan karyawan terhapus, lakukan dengan hati-hati atau gunakan Ubah Data apabila diperlukan perubahan data karyawan
                            </small>
                        </div>
                        <div class="table-responsive">
                            <table id="dttable" class="table dt-responsive table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>USERID</th>
                                        <th>Urutan</th>
                                        <th>Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Unit</th>
                                        <th>Warna Baris</th>
                                        <th class="cell-fit">Diperbarui</th>
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
                                        <th>USERID</th>
                                        <th>Urutan</th>
                                        <th>Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Unit</th>
                                        <th>Warna Baris</th>
                                        <th class="cell-fit">Diperbarui</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL TAMBAH -->
    <div class="modal fade" tabindex="-1" id="modalTambah" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Tambah <b class="text-primary">Data Staf</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="alert alert-light shadow-sm">
                                    <small>
                                        <h6><center>Mohon Diperhatikan <b class="text-danger">Panduan Di Bawah</b> Sebelum Melakukan Pengisian!</center></h6>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Staf yang ditambahkan di bawah adalah staf yang akan ditampilkan pada Jadwal Dinas Anda<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Apabila terdapat pengurangan / penambahan staf di Unit Anda, segera lakukan pembaruan data<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Apabila nama Staf <b class="text-danger">TIDAK DITEMUKAN</b> pada isian di bawah, silakan memperbarui profil karyawan bersangkutan dengan masuk/login Simrsmu menggunakan akun yang telah diberikan oleh Kepegawaian sebelumnya
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Staf / Pegawai di <b class="text-primary">Unit</b> Anda <a class="text-danger">*</a></label>
                                <select class="form-select select2" name="staf_add[]" id="staf_add" style="width: 100%" multiple>
                                    @if (count($list['users']) > 0)
                                        @foreach ($list['users'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nama Unit <a class="text-danger">*</a></label>
                                <input type="text" class="form-control" id="unit_add" placeholder="Tuliskan Nama Unit Anda! e.g. Bangsal Dewasa">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal"><i
                            class="fa fa-times me-1"></i> Batal</button>
                    <button class="btn btn-info" onclick="simpan()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                        title="Simpan Data"><i class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL UBAH -->
    <div class="modal fade" tabindex="-1" id="modalUbah" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Ubah <b class="text-warning">Data Staf</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="alert alert-light shadow-sm">
                                    <small>
                                        <h6><center>Mohon Diperhatikan <b class="text-danger">Panduan Di Bawah</b> Sebelum Melakukan Pengisian!</center></h6>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Staf yang ditambahkan di bawah adalah staf yang akan ditampilkan pada Jadwal Dinas Anda<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Apabila terdapat pengurangan / penambahan staf di Unit Anda, segera lakukan pembaruan data<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Apabila nama Staf <b class="text-danger">TIDAK DITEMUKAN</b> pada isian di bawah, silakan memperbarui profil karyawan bersangkutan dengan masuk/login Simrsmu menggunakan akun yang telah diberikan oleh Kepegawaian sebelumnya
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Staf/Pegawai di <b class="text-primary">Unit</b> Anda <a class="text-danger">*</a></label>
                                <select class="form-select select2" name="staf_edit[]" id="staf_edit" style="width: 100%" multiple></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nama Unit <a class="text-danger">*</a></label>
                                <input type="text" class="form-control" id="unit_edit" placeholder="Tuliskan Nama Unit Anda! e.g. Bangsal Dewasa">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon me-1"></i> Tutup</button>
                    <button class="btn btn-warning" id="btn-ubah" onclick="prosesUbah()"><i class="fa-fw fas fa-edit nav-icon me-1"></i> Ubah</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div class="modal animate__animated animate__rubberBand fade" id="hapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Form Hapus <b class="text-danger">Data Staf</b>
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan menghapus Daftar Staf tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuhapus">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-hapus" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapus()"><i class="fa fa-trash me-1"></i> Hapus</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="ambilalih" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Form Ambil Alih <b class="text-info">Data Staf</b>
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_ambil_alih" hidden>
                    <p style="text-align: justify;">Anda akan mengambil alih kuasa Jadwal Dinas Unit, pastikan telah menghubungi pegawai sebelumnya untuk
                        dilakukan perpindahan hak akses dan penetapan Admin Jadwal Dinas yang baru.
                        lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuambilalih">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-ambil-alih" class="btn btn-info me-sm-3 me-1" onclick="prosesAmbilAlih()"><i class="fas fa-thumbs-up me-1" style="font-size:13px"></i> Lanjutkan</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modalAtur" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel"><i class='fas fa-sort-amount-down me-1'></i> Atur Karyawan - ID#<a class="text-primary" id="show_id_atur"></a></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_atur" hidden>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Urutan Karyawan <a class="text-danger">*</a></label>
                                <input type="number" class="form-control" id="urutan" maxlength="2" placeholder="e.g. 1 / 5 / 9 dst">
                            </div>
                        </div>
                        <div class="col-md-7 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" placeholder="e.g. Kepala Shift / Staf / dll">
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label class="form-label">Warna</label>
                                <input type="color" class="form-control form-control-color w-100" id="color" value="#3ec9d6" title="Pilih warna sesuai keinginan Anda">
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 d-grid gap-2">
                            <center><label class="form-label">Tes/Contoh Warna (Pilih <b class="text-info">Warna</b> TANPA MENUTUPI <b class="text-danger">Tulisan</b>)</label></center>
                            <center><button class="btn btn-block text-dark text-center shadow" id="tes_color">Dr. Ir. H. Sunaryo, S.T., M.T., M.B.A., Ph.D., IPM, ASEAN Eng.</button></center>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-atur" onclick="prosesAtur()"><i class="fas fa-user-check nav-icon me-1"></i> Terapkan</button>
                    <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon me-1"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

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
        })

        // FUNCTION AREA
        function refresh() {
            $('.modal').modal('hide');
            $("#tampil-tbody").empty().append(
                `<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            const btn = $('#btn-refresh-table').find('i');
            $.ajax({
                url: "/api/v4/sdi/jadwaldinas/staf/table",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    btn.addClass('fa-spin');
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    if ($.fn.DataTable.isDataTable('#dttable')) {
                        $('#dttable').DataTable().clear().destroy();
                    }
                    if (res.show) {
                        JSON.parse(res.show.staf).forEach(val => {
                            // INITIATE
                            var urutan = '-';
                            var jabatan = '-';
                            var color = '-';
                            console.log(val);
                            res.jabatan.forEach(jab => {
                                if (val == jab.id_staf) {
                                    urutan = jab.urutan;
                                    jabatan = jab.jabatan;
                                    color = jab.color;
                                }
                            })
                            var nama_user = '';
                            var foto_user = '/images/pku/user.png';
                            res.users.forEach(item => {
                                if (val == item.id) {
                                    if (item.nama) {
                                        nama_user = item.nama;
                                    } else {
                                        nama_user = item.name+' (Belum Melengkapi Profil)';
                                    }
                                    res.foto_user.forEach(lis => {
                                        if (lis.user_id == item.id) {
                                            foto_user = '/storage/'+item.filename.substr(7,10000);
                                            // if (item.filename) {
                                            // } else {
                                            //     foto_user = '';
                                            // }
                                        }
                                    })
                                }
                            })
                            content = ``;
                            content += `<tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="${res.show.pegawai_id == @json(Auth::user()->id)?"link-primary text-decoration-underline dropdown-toggle":"link disabled"} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="dropdown">${val}</a>
                                                        <div class="dropdown-menu dropdown-menu-right">`;
                                                            if (res.show.pegawai_id == @json(Auth::user()->id)) {
                                                                content += `<a href="javascript:void(0);" onclick="atur(${val})" class="dropdown-item text-primary"><i class='fas fa-sort-amount-down me-1'></i> Atur Karyawan</a>`;
                                                            } else {
                                                                content += `<a href="javascript:void(0);" class="dropdown-item disabled"><i class='fas fa-sort-amount-down me-1'></i> Atur Karyawan</a>`;
                                                            }
                            content += `                </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${urutan}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0"><img
                                                            src="${foto_user}" alt="user image"
                                                            class="img-radius wid-40 hei-40 align-top m-r-15"></div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-0">${nama_user}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${jabatan?jabatan:'-'}</td>
                                            <td>${res.show.unit?res.show.unit:'-'}</td>`;
                            if (color != "-") {
                                content += `<td><span class="badge border" style="background-color: ${color};color:#000000">TEXT HERE</span></td>`;
                            } else {
                                content += `<td>-</td>`;
                            }
                            content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                            <div class='d-flex justify-content-start align-items-center'>
                                                <div class='d-flex flex-column'>
                                                    <a class='mb-0'>` + new Date(res.show.updated_at).toLocaleString("sv-SE") + `</a>
                                                    <small class='text-truncate text-muted'>Diperbarui Oleh ` + res.show.nama_user + `</small>
                                                </div>
                                            </div>
                                        </td></tr>`;
                            $('#tampil-tbody').append(content);
                        })
                    }

                    // TOMBOL TAMBAH UBAH HAPUS
                    if (res.show) {
                        if (res.show.pegawai_id == @json(Auth::user()->id)) {
                            // console.log(res.show.id);
                            $('#btn-link').empty().append(`
                                <div class="btn-group">
                                    <button id="btn-tambah" class="btn btn-primary disabled" onclick="tambah()" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Form Tambah" disabled><i class='ti ti-square-plus me-1'></i> Tambah</button>
                                    <button class="btn btn-warning" onclick="ubah(${res.show.id})" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Form Ubah"><i class='ti ti-edit me-1'></i> Ubah</button>
                                    <button class="btn btn-danger disabled" onclick="hapus(${res.show.id})" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Form Hapus"><i class='ti ti-x me-1'></i> Hapus</button>
                                </div>
                            `);
                        } else {
                            $('#btn-link').empty().append(`
                                <div class="btn-group">
                                    <button id="btn-tambah" class="btn btn-primary disabled" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Form Tambah" disabled><i class='ti ti-square-plus me-1'></i> Tambah</button>
                                    <button class="btn btn-warning disabled" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Form Ubah" disabled><i class='ti ti-edit me-1'></i> Ubah</button>
                                    <button class="btn btn-danger disabled" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Form Hapus" disabled><i class='ti ti-x me-1'></i> Hapus</button>
                                    <button class="btn btn-info" onclick="ambilAlih(${res.show.pegawai_id})" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Form Ambil Alih Admin Jadwal Dinas"><i class='ti ti-switch-3 me-1'></i> Ambil Alih</button>
                                </div>
                            `);
                        }
                    } else {
                        $('#btn-link').empty().append(`
                            <div class="btn-group">
                                <button id="btn-tambah" class="btn btn-primary" onclick="tambah()" data-bs-toggle="tooltip"
                                data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                title="Form Tambah"><i class='ti ti-square-plus me-1'></i> Tambah</button>
                                <button class="btn btn-warning disabled" data-bs-toggle="tooltip"
                                data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                title="Form Ubah" disabled><i class='ti ti-edit me-1'></i> Ubah</button>
                                <button class="btn btn-danger disabled" data-bs-toggle="tooltip"
                                data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                title="Form Hapus" disabled><i class='ti ti-x me-1'></i> Hapus</button>
                            </div>
                        `);
                    }

                    var table = $('#dttable').DataTable({
                        order: [
                            [4, "asc"],
                            [1, "asc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '5%' },
                            { sWidth: '35%' },
                            { sWidth: '15%' },
                            { sWidth: '15%' },
                            { sWidth: '10%' },
                            { sWidth: '15%' },
                        ],
                        displayLength: 30,
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }, error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message ?? 'Tidak ada data Staf ditemukan.',
                        position: 'topRight'
                    });

                    $("#tampil-tbody").empty().append(
                        `<tr style='font-size:13px'><td colspan="9"><center>Tidak ada Data Staf</center></td></tr>`
                    );
                },
                complete: function() {
                    btn.removeClass('fa-spin');
                }
            })
        }

        function getUnitClass(unit) {
            const colors = [
                'text-primary',
                'text-success',
                'text-warning',
                'text-info',
                'text-danger',
                'text-secondary'
            ];

            // if (unitColorMap[unit]) {
            //     return unitColorMap[unit];
            // }

            // auto assign berdasarkan hash sederhana
            let index = unit ? unit.length % colors.length : 0;
            return colors[index];
        }

        function refreshAll() {
            $('.modal').modal('hide');
            $("#tampil-tbody").empty().append(
                `<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            const btn = $('#btn-refreshAll-table').find('i');
            $.ajax({
                url: "/api/v4/sdi/jadwaldinas/staf/table/all",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    btn.removeClass('fa-infinity').addClass('fa-sync fa-spin');
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    if ($.fn.DataTable.isDataTable('#dttable')) {
                        $('#dttable').DataTable().clear().destroy();
                    }
                    content = ``;
                    res.forEach(item => {
                        let unitClass = 'text-muted';
                        if (item.unit) {
                            unitClass = getUnitClass(item.unit);
                        }
                        let badgeAtasan = '';
                        if (item.is_atasan == 1) {
                            badgeAtasan = `<span class="badge bg-teal-transparent">Admin Jadwal</span>`;
                        }
                        content += `<tr>
                                        <td><a href="javascript:void(0);" class="pe-none"><b>${item.id}</b></a></td>
                                        <td>${item.urutan}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">
                                                        ${item.nama_user}
                                                    </h6><a class='ms-0'>${badgeAtasan} <span class="badge bg-primary-transparent">ID#${item.staf_id}</span></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class='text-wrap'>${item.jabatan?item.jabatan:'-'}</td>
                                        <td class='text-wrap'>
                                            <b class="${unitClass}">
                                                ${item.unit ? item.unit : '-'}
                                            </b>
                                        </td>`;
                        if (item.color != "-") {
                            content += `<td><span class="badge border" style="background-color: ${item.color};color:#000000">TEXT HERE</span></td>`;
                        } else {
                            content += `<td>-</td>`;
                        }
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0'>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</a>
                                                <small class='text-truncate text-muted'>Diperbarui Oleh ` + item.updated_by + `</small>
                                            </div>
                                        </div>
                                    </td></tr>`;
                    });
                    $('#tampil-tbody').append(content);

                    $('#btn-link').empty();

                    var table = $('#dttable').DataTable({
                        order: [
                            [4, "asc"],
                            [1, "asc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '5%' },
                            { sWidth: '35%' },
                            { sWidth: '20%' },
                            { sWidth: '15%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                        ],
                        displayLength: 30,
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }, error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message ?? 'Tidak ada data Staf ditemukan.',
                        position: 'topRight'
                    });

                    $('#btn-link').empty();

                    $("#tampil-tbody").empty().append(
                        `<tr style='font-size:13px'><td colspan="9"><center>Tidak ada Data Staf</center></td></tr>`
                    );
                },
                complete: function() {
                    btn.removeClass('fa-sync fa-spin').addClass('fa-infinity');
                }
            })
        }

        function atur(id) {
            $("#show_id_atur").text(id);
            $("#id_atur").val(id);
            $("#urutan").val("");
            $("#jabatan").val("");
            $("#color").val("#3ec9d6");
            // $('#modalAtur').modal('show');
            $.ajax(
            {
                url: "/api/v4/sdi/jadwaldinas/staf/atur/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#urutan").val(res.urutan);
                    $("#jabatan").val(res.jabatan);
                    $("#color").val(res.color?res.color:'#ffffff');
                    $('#tes_color').css('background-color', res.color?res.color:'#ffffff');
                    // $("#id_atur").val(res.show.id);
                    $('#modalAtur').modal('show');
                }
            });
            $('#color').on('change', function() {
                $('#tes_color').css('background-color', this.value);
                // console.log(this.value);
            });
        }

        function prosesAtur() {
            $("#btn-atur").prop('disabled', true);
            $("#btn-atur").find("i").toggleClass("fa-save fa-sync fa-spin");


            if ($("#urutan").val() == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian wajib',
                    position: 'topRight'
                });
            } else {
                var fd = new FormData();
                fd.append('urutan',$("#urutan").val());
                fd.append('jabatan',$("#jabatan").val());
                fd.append('color',$("#color").val());
                fd.append('staf',$("#id_atur").val());
                // AJAX request
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/sdi/jadwaldinas/staf/atur/"+fd.get('staf')+"/ubah",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(res){
                        if (res.status == 200) {
                            iziToast.success({
                                title: 'Pesan Sukses! IDSTAF : '+fd.get('staf'),
                                message: 'Staf berhasil diperbarui pada '+res,
                                position: 'topRight'
                            });
                            if (res) {
                                $('#modalAtur').modal('hide');
                                refresh();
                            }
                        } else {
                            iziToast.error({
                                title: 'Pesan Error!',
                                message: res.message,
                                position: 'topRight'
                            });
                        }
                    },
                    error: function(res){
                        console.log("error : " + JSON.stringify(res) );
                    }
                });
            }

            $("#btn-atur").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
            $("#btn-atur").prop('disabled', false);
        }

        function tambah() {
            $("#staf").val("").change();
            $('#modalTambah').modal('show');
        }

        function simpan() {
            var staf = JSON.stringify($('#staf_add').val());
            var unit = $('#unit_add').val();

            if ($('#staf_add').val() == "" || unit == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian wajib',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/v4/sdi/jadwaldinas/staf/tambah',
                    dataType: 'json',
                    data: {
                        staf: staf,
                        unit: unit,
                    },
                    success: function(res) {
                        if (res.status == 200) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Tambah Staf berhasil pada '+ res.message,
                                position: 'topRight'
                            });
                            if (res) {
                                $('.modal').modal('hide');
                                refresh();
                            }
                        } else {
                            iziToast.error({
                                title: 'Pesan Ambigu!',
                                message: res.message,
                                position: 'topRight'
                            });
                        }
                    }, error: function(xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.message,
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function ubah(id) {
            $("#id_edit").val("");
            $("#staf_edit").val("");
            $.ajax(
            {
                url: "/api/v4/sdi/jadwaldinas/staf/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#id_edit").val(res.show.id);
                    $("#unit_edit").val(res.show.unit);

                    var un = JSON.parse(res.show.staf);
                    $("#staf_edit").find('option').remove();
                    res.users.forEach(pounch => {
                        $("#staf_edit").append(`
                            <option value="${pounch.id}">${pounch.nama}</option>
                        `);
                    });
                    $("#staf_edit").val(un).change();

                    $('#modalUbah').modal('show');
                }, error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message ?? 'Gagal mengambil data Staf. Coba sekali lagi.',
                        position: 'topRight'
                    });
                }
            });
        }

        function prosesUbah() {
            $("#btn-ubah").prop('disabled', true);
            $("#btn-ubah").find("i").toggleClass("fa-save fa-sync fa-spin");


            if ($('#staf_edit').val() == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian wajib',
                    position: 'topRight'
                });
            } else {
                var fd = new FormData();
                fd.append('id',$("#id_edit").val());
                fd.append('unit',$("#unit_edit").val());
                fd.append('staf',JSON.stringify($('#staf_edit').val()));
                // AJAX request
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/sdi/jadwaldinas/staf/"+fd.get('id')+"/ubah",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(res){
                        if (res.status == 200) {
                            iziToast.success({
                                title: 'Pesan Sukses! ID : '+fd.get('id'),
                                message: 'Staf berhasil diperbarui pada '+res,
                                position: 'topRight'
                            });
                            if (res) {
                                $('#ubah').modal('hide');
                                refresh();
                            }
                        } else {
                            iziToast.error({
                                title: 'Pesan Ambigu!',
                                message: res.message ?? 'Gagal memperbarui data Staf. Coba sekali lagi.',
                                position: 'topRight'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.message ?? 'Gagal memperbarui data Staf. Coba sekali lagi.',
                            position: 'topRight'
                        });
                    }
                });
            }

            $("#btn-ubah").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
            $("#btn-ubah").prop('disabled', false);
        }

        function ambilAlih(id) {
            $("#id_ambil_alih").val(id);
            var inputs = document.getElementById('setujuambilalih');
            inputs.checked = false;
            $('#ambilalih').modal('show');
        }

        function prosesAmbilAlih() {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuambilalih').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui/ceklis form ini untuk melanjutkan proses pengambilalihan akses Admin Jadwal Dinas Unit tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_ambil_alih").val();
                $.ajax({
                    url: "/api/v4/sdi/jadwaldinas/staf/"+id+"/ambilalih",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Admin Jadwal Dinas telah berhasil ditetapkan pada '+res,
                            position: 'topRight'
                        });
                        $('#ambilalih').modal('hide');
                        refresh();
                    },
                    error: function(xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.message ?? 'Admin Jadwal Dinas gagal ditetapkan/sudah ditetapkan di Unit Lain. Periksa sekali lagi.',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function hapus(id) {
            $("#id_hapus").val(id);
            var inputs = document.getElementById('setujuhapus');
            inputs.checked = false;
            $('#hapus').modal('show');
        }

        function prosesHapus() {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuhapus').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui/ceklis form ini untuk melanjutkan proses penghapusan baris tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_hapus").val();
                $.ajax({
                    url: "/api/v4/sdi/jadwaldinas/staf/"+id+"/hapus",
                    type: 'DELETE',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Staf telah berhasil dihapus pada '+res,
                            position: 'topRight'
                        });
                        $('#hapus').modal('hide');
                        window.location.reload();
                        // refresh();
                    },
                    error: function(xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.message ?? 'Staf gagal dihapus',
                            position: 'topRight'
                        });
                    }
                });
            }
        }
    </script>
@endsection
