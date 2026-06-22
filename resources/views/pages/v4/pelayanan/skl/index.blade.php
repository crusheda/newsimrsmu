@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Layanan <b class="text-primary link-underline-primary text-decoration-underline">SKL</b>
                    (<b class="text-warning link-underline-warning text-decoration-underline">Surat Keterangan Lahir</b>)
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Pelayanan</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        SKL
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" onclick="tambah()" value="animate__jackInTheBox">
                                <i class="fa-fw fas fa-upload nav-icon me-1"></i> Tambah <span class="d-none d-md-inline">Data SKL</span>
                            </button>
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="tooltip" data-bs-offset="0,4" id="btn-refresh"
                                data-bs-placement="bottom" data-bs-html="true" title="Tampilkan 30 Data SKL Terbaru" onclick="refresh()">
                                <i class="fa-fw fas fa-sync nav-icon"></i> <span class="d-none d-md-inline ms-1">30 Data Terakhir</span></button>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-offset="0,4" id="btn-refresh-all"
                                data-bs-placement="bottom" data-bs-html="true" title="Tampilkan Semua Data SKL" onclick="showAll()">
                                <i class="fa-fw fas fa-history"></i> <span class="d-none d-md-inline ms-1">Seluruh Data</span></button>
                        </div>
                        <div class="dropdown">
                            <button type="button" class="btn btn-info" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-filter me-1"></i> Filter <span class="d-none d-md-inline">Data</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-md" style="width: 300px">
                                <div class="dropdown-item-text">
                                    <div>
                                        <h6 class="mb-2 mt-2 text-center">Pencarian Berdasarkan <b class="text-primary">Nama Ibu</b></h6>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="form-group p-2 pb-0">
                                    <div class="input-group">
                                        <div class="input-group-text">NY.</div>
                                        <input type="text" class="form-control" id="cari_ibu" placeholder="Tulis Nama Ibu" width="300">
                                    </div>
                                </div>
                                <div class="p-2">
                                    <center>
                                        <button type="button" id="btn-filter" class="btn btn-info-transparent btn-block w-100" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="bottom" data-bs-html="true" title="Filter Data Berdasarkan Nama Ibu" onclick="filter()">
                                            <i class="fas fa-filter me-1"></i> Filter
                                        </button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dttable" class="table dt-responsive table-hover w-100 align-middle">
                                <thead>
                                    <tr>
                                        <th class="cell-fit">#ID</th>
                                        <th class="cell-fit">NO SURAT</th>
                                        <th class="cell-fit">TGL</th>
                                        <th class="cell-fit">NAMA IBU</th>
                                        <th class="cell-fit">NAMA AYAH</th>
                                        <th class="cell-fit">NAMA ANAK</th>
                                        <th class="cell-fit">JK / BB / TB</th>
                                        <th class="cell-fit">ALAMAT</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody">
                                    <tr>
                                        <td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="cell-fit">#ID</th>
                                        <th class="cell-fit">NO SURAT</th>
                                        <th class="cell-fit">TGL</th>
                                        <th class="cell-fit">NAMA IBU</th>
                                        <th class="cell-fit">NAMA AYAH</th>
                                        <th class="cell-fit">NAMA ANAK</th>
                                        <th class="cell-fit">JK / BB / TB</th>
                                        <th class="cell-fit">ALAMAT</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL START --}}
    <div class="modal fade animate__animated animate__jackInTheBox fade" id="tambah" aria-hidden="true"
        aria-labelledby="modalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah <b class="text-primary">Data</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-skl" class="form-auth-small" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="alert alert-light shadow" role="alert">
                                    <small>
                                        <i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan <b class="text-info">Nomor Surat</b> sudah sesuai sebelum disimpan<br>
                                        <i class="fa-fw fas fa-caret-right nav-icon"></i> Tanda <a class="text-danger">*</a> berarti isian <b class="text-danger">Wajib</b> diisi<br>
                                        <i class="fa-fw fas fa-caret-right nav-icon"></i> Disarankan untuk menggunakan <b>Huruf Besar/Capital/Uppercase</b> saat pengisian
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">No Surat <a class="text-danger">*</a></label>
                                    <div class="input-group">
                                        <button class="btn btn-info" type="button" id="button_ubah_no_surat" onclick="ubahNoSurat()" style="border-top-left-radius:8px;border-bottom-left-radius:8px">Ubah</button>
                                        <input type="text" class="form-control" id="tampil_no_surat" style="border-top-right-radius:8px;border-bottom-right-radius:8px" disabled>
                                        <input type="number" name="no_surat" id="save_no_surat" class="form-control" placeholder="" style="border-radius:8px" hidden required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Waktu <a class="text-danger">*</a></label>
                                    <input type="datetime-local" name="tgl" id="tgl_add" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">NIK Ibu <a class="text-danger">*</a></label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" class="form-control" name="nik_ibu" id="basic-url3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            aria-describedby="basic-addon34" maxlength="16" placeholder="Nomor Induk Kependudukan Ibu" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">NIK Ayah <a class="text-danger">*</a></label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" class="form-control" name="nik_ayah" id="basic-url3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            aria-describedby="basic-addon34" maxlength="16" placeholder="Nomor Induk Kependudukan Ayah" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama Ibu <a class="text-danger">*</a></label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text" id="basic-addon34">NY.</span>
                                        <input type="text" class="form-control" name="ibu" id="basic-url3" oninput="this.value = this.value.toUpperCase()"
                                            aria-describedby="basic-addon34" placeholder="Nama Lengkap Ibu" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama Ayah <a class="text-danger">*</a></label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text" id="basic-addon34">TN.</span>
                                        <input type="text" class="form-control" name="ayah" id="basic-url3" oninput="this.value = this.value.toUpperCase()"
                                            aria-describedby="basic-addon34" placeholder="Nama Lengkap Ayah" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama Anak (<b class="text-warning">Optional</b>)</label>
                                    <input type="text" class="form-control" name="anak" id="basic-url3" oninput="this.value = this.value.toUpperCase()"
                                        aria-describedby="basic-addon34" placeholder="Nama Lengkap Anak (Bila Ada)" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama Dokter <a class="text-danger">*</a></label>
                                    <select class="form-control" name="dr" style="width: 100%" required>
                                        <option selected="selected" value="" hidden>Pilih</option>
                                        <option value="1">dr. Gede Sri Dhyana M. A., Sp.OG</option>
                                        <option value="2">dr. H. Ahmad Sutamat, Sp.OG</option>
                                        <option value="3">dr. Febrian Andhika Adiyana, Sp.OG</option>
                                        <option value="4">dr. Putri Eka Pratiwi, Sp.OG</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Berat Badan <a class="text-danger">*</a></label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" name="bb"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            maxlength="4" class="form-control" placeholder="..." required>
                                        <span class="input-group-text" id="basic-addon34">gram</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tinggi Badan <a class="text-danger">*</a></label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" name="tb"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            maxlength="2" class="form-control" placeholder="..." required>
                                        <span class="input-group-text" id="basic-addon34">cm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Jenis Kelamin <a class="text-danger">*</a></label>
                                    <select name="kelamin" class="form-control" style="width: 100%" required>
                                        <option selected="selected" value="" hidden>Pilih</option>
                                        <option value="unknown">Belum Diketahui</option>
                                        <option value="laki-laki">Laki-laki (L)</option>
                                        <option value="perempuan">Perempuan (P)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Alamat <a class="text-danger">*</a></label>
                                    <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat Lengkap" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-b-0">
                        <a class="btn btn-secondary-transparent" href="javascript:void(0);" data-bs-dismiss="modal"><i
                                class="fas fa-chevron-left"></i>&nbsp;&nbsp;Tutup</a>
                        <button class="btn btn-primary" id="btn-simpan" onclick="saveData()"><i
                                class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade animate__animated animate__rubberBand fade" id="ubah" data-bs-backdrop="static"
        aria-hidden="true" aria-labelledby="modalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah <b class="text-warning">Data</b> <small><kbd>ID : <a id="show_id"></a></kbd></small></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow-y:visible;">
                    <input type="text" id="id_edit" hidden>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            {{-- <div class="form-group">
                                    <label class="form-label">No Surat : </label>
                                    <input type="number" name="no_surat" value="{{ $list['nomer'] }}" class="form-control"
                                        placeholder="" disabled>
                                    <input type="number" name="no_surat" value="{{ $list['nomer'] }}" class="form-control"
                                        placeholder="" hidden>
                                </div> --}}
                            <div class="form-group">
                                <label class="form-label">No Surat <a class="text-danger">*</a></label>
                                <input type="text" class="form-control" id="no_surat_edit"
                                    value="" disabled>
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <div class="form-group">
                                <label class="form-label">Waktu <a class="text-danger">*</a></label>
                                <input type="datetime-local" id="tgl_edit" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">NIK Ibu <a class="text-danger">*</a></label>
                                <div class="input-group input-group-merge">
                                    <input type="number" class="form-control" name="nik_ibu_edit" id="nik_ibu_edit" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        aria-describedby="basic-addon34" maxlength="16" placeholder="Nomor Induk Kependudukan Ibu" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">NIK Ayah <a class="text-danger">*</a></label>
                                <div class="input-group input-group-merge">
                                    <input type="number" class="form-control" name="nik_ayah_edit" id="nik_ayah_edit" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        aria-describedby="basic-addon34" maxlength="16" placeholder="Nomor Induk Kependudukan Ayah" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Ibu <a class="text-danger">*</a></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text" id="basic-addon34">NY.</span>
                                    <input type="text" class="form-control" id="ibu_edit"
                                        aria-describedby="basic-addon34" placeholder="Nama Lengkap Ibu" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Ayah <a class="text-danger">*</a></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text" id="basic-addon34">TN.</span>
                                    <input type="text" class="form-control" id="ayah_edit"
                                        aria-describedby="basic-addon34" placeholder="Nama Lengkap Ayah" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Anak (<b class="text-warning">Optional</b>)</label>
                                <div class="input-group input-group-merge">
                                    {{-- <span class="input-group-text" id="basic-addon34">BY.</span> --}}
                                    <input type="text" class="form-control" id="anak_edit"
                                        aria-describedby="basic-addon34" placeholder="Nama Lengkap Anak (Bila Ada)" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Dokter <a class="text-danger">*</a></label>
                                <select class="form-control" id="dr_edit" style="width: 100%;" required></select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Berat Badan <a class="text-danger">*</a></label>
                                <div class="input-group input-group-merge">
                                    <input type="number" id="bb_edit"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        maxlength="4" class="form-control" placeholder="..." required>
                                    <span class="input-group-text" id="basic-addon34">gram</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tinggi Badan <a class="text-danger">*</a></label>
                                <div class="input-group input-group-merge">
                                    <input type="number" id="tb_edit"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        maxlength="2" class="form-control" placeholder="..." required>
                                    <span class="input-group-text" id="basic-addon34">cm</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jenis Kelamin <a class="text-danger">*</a></label>
                                <select class="form-control select2" id="kelamin_edit" style="width: 100%;z-index: 9999!important;" required></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Alamat <a class="text-danger">*</a></label>
                                <textarea class="form-control" id="alamat_edit" placeholder="Masukkan Alamat Lengkap" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary-transparent" href="javascript:void(0);" data-bs-dismiss="modal"><i
                            class="fas fa-chevron-left"></i>&nbsp;&nbsp;Tutup</a>
                    <button class="btn btn-primary" type="submit" id="submit_edit" onclick="ubah()"><i
                            class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}

    <script>
        let fpTgl;

        $(document).ready(function() {
            // TGL ADD
            const l = document.querySelector("#tgl_add");
            const c = new Date(Date.now() + 1728e5);
            var today = moment().locale('id').format('Y-MM-DD HH:mm');
            fpTgl = l.flatpickr({
                enableTime: true,
                defaultDate: today,
                minuteIncrement: 1,
                time_24hr: true,
                dateFormat: "Y-m-d H:i", // 🔥 penting
                disable: [{
                    from: c.toISOString().split("T")[0],
                    to: "3000-01-01"
                }]
            });

            // VALIDASI INPUT NUMBER
            $('input[type=number][max]:not([max=""])').on('input', function(ev) {
                var $this = $(this);
                var maxlength = $this.attr('max').length;
                var value = $this.val();
                if (value && value.length >= maxlength) {
                    $this.val(value.substr(0, maxlength));
                }
            });
            $('#rm').change(function() {
                if (this.value == '') {
                    $("#nama1").val("");
                    $("#nama2").val("");
                    $("#jns_kelamin1").val("");
                    $("#jns_kelamin2").val("");
                    $("#umur2").val("");
                    $("#umur1").val("");
                    $("#alamat1").val("");
                    $("#alamat2").val("");
                    $("#des").val("");
                    $("#kec").val("");
                    $("#kab").val("");
                } else {
                    if (this.value.length == 4) {
                        this.value = '0000' + this.value;
                    }
                    if (this.value.length == 5) {
                        this.value = '000' + this.value;
                    }
                    if (this.value.length == 6) {
                        this.value = '00' + this.value;
                    }
                    if (this.value.length < 4) {
                        this.value = this.value;
                    }
                    $.ajax({
                        // url: "http://192.168.1.3:8000/api/all/"+this.value,
                        url: "/api/antigen/getpasien/" + this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            $("#nama1").val(res.NAMAPASIEN);
                            $("#nama2").val(res.NAMAPASIEN);
                            $("#jns_kelamin1").val(res.JNSKELAMIN);
                            $("#jns_kelamin2").val(res.JNSKELAMIN);
                            $("#umur1").val(res.UMUR);
                            $("#umur2").val(res.UMUR);
                            $("#alamat1").val(res.ALAMAT);
                            $("#alamat2").val(res.ALAMAT);

                            $("#des").val(res.DESA);
                            $("#kec").val(res.KECAMATAN);
                            $("#kab").val(res.NAMA_KABKOTA);
                            // $('#jumlah20').attr('required', true);
                        }
                    });
                }
            });

            refresh();
        });

        // FUNCTION
        function refresh() {
            $("#cari_ibu").val('');
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="10"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            const btn = $('#btn-refresh').find('i');
            $.ajax({
                url: "/api/v4/pelayanan/skl/get",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    btn.prop('disabled', true).addClass('fa-spin');
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        // var updet = item.updated_at.substring(0, 10);
                        content = `<tr id='data"+ item.id +"'>`;
                        content +=
                            `<td><center><div class='btn-group'><a href='javascript:void(0);' class='link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false' value="animate__rubberBand">`+item.id+`</a><ul class='dropdown-menu dropdown-menu-right'>` +
                            `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(` +
                            item.id +
                            `)"><i class='fas fa-edit me-1'></i> Ubah</a></li>` +
                            `<li><a href='javascript:void(0);' class='dropdown-item text-info' onclick="window.open('/v4/pelayanan/skl/` +
                            item.id +
                            `/print','id','width=900,height=600')"><i class='fas fa-print me-1'></i> Cetak</a></li>` +
                            `<li><a href='javascript:void(0);' class='dropdown-item text-success' onclick="window.open('/v4/pelayanan/skl/` +
                            item.id +
                            `/cetak')"><i class='fas fa-download me-1'></i> Download</a></li>` +
                            `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` +
                            item.id +
                            `)"><i class='fas fa-trash me-1'></i> Hapus</a></li>` +
                            `</ul></center></td><td>`;
                        content += item.no_surat + "</td><td>" + item.tgl + "</td>";
                        if (item.nik_ibu) {
                            nik_ibu = 'NIK - ' + item.nik_ibu;
                        } else {
                            nik_ibu = '';
                        }
                        if (item.nik_ayah) {
                            nik_ayah = 'NIK - ' + item.nik_ayah;
                        } else {
                            nik_ayah = '';
                        }
                        content += "<td><div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate text-primary'><a href='javascript:void(0);' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-html='true' class='text-dark'><u>" + item.ibu + "</u></a></h6><small class='text-truncate text-muted'>" + nik_ibu + "</small></div></div></td>";
                        content += "<td><div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate text-primary'><a href='javascript:void(0);' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-html='true' class='text-dark'><u>" + item.ayah + "</u></a></h6><small class='text-truncate text-muted'>" + nik_ayah + "</small></div></div></td>";
                        content += "<td>";
                        if (item.anak == null)
                            content += "";
                        else
                            content += item.anak;
                        content += "</td><td>";
                        if (item.kelamin == "unknown")
                            content += "<span class='badge bg-dark text-white me-1'>-</span>";
                        if (item.kelamin == "laki-laki")
                            content += "<span class='badge bg-blue text-white me-1'>L</span>";
                        if (item.kelamin == "perempuan")
                            content += "<span class='badge bg-pink text-white me-1'>P</span>";
                        content +=  " / " + item.bb + " / " + item.tb + "</td><td class='text-wrap'>" +
                            item.alamat + "</td>";
                        content += `</tr>`;
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [1, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '6%' },
                            { sWidth: '7%' },
                            { sWidth: '12%' },
                            { sWidth: '15%' },
                            { sWidth: '15%' },
                            { sWidth: '15%' },
                            { sWidth: '10%' },
                            { sWidth: '20%' },
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
                }, error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                }, complete: function() {
                    btn.prop('disabled', false).removeClass('fa-spin');
                }
            });
        }

        function filter() {
            var kunci = $("#cari_ibu").val();
            if (kunci == '') {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Filter Nama Ibu belum diisi',
                    position: 'topRight'
                });
                $('#btn-filter').tooltip('hide');
            } else {
                $("#tampil-tbody").empty().append(
                    `<tr><td colspan="10"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
                $.ajax({
                    url: "/api/v4/pelayanan/skl/cari/"+kunci,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#tampil-tbody").empty();
                        $('#dttable').DataTable().clear().destroy();
                        res.show.forEach(item => {
                            // var updet = item.updated_at.substring(0, 10);
                            content = `<tr id='data"+ item.id +"'>`;
                            content +=
                                `<td><center><div class='btn-group'><a href='javascript:void(0);' class='link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false' value="animate__rubberBand">`+item.id+`</a><ul class='dropdown-menu dropdown-menu-right'>` +
                                `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(` +
                                item.id +
                                `)"><i class='fas fa-edit me-1'></i> Ubah</a></li>` +
                                `<li><a href='javascript:void(0);' class='dropdown-item text-info' onclick="window.open('/v4/pelayanan/skl/` +
                                item.id +
                                `/print','id','width=900,height=600')"><i class='fas fa-print me-1'></i> Cetak</a></li>` +
                                `<li><a href='javascript:void(0);' class='dropdown-item text-success' onclick="window.open('/v4/pelayanan/skl/` +
                                item.id +
                                `/cetak')"><i class='fas fa-download me-1'></i> Download</a></li>` +
                                `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` +
                                item.id +
                                `)"><i class='fas fa-trash me-1'></i> Hapus</a></li>` +
                                `</ul></center></td><td>`;
                            content += item.no_surat + "</td><td>" + item.tgl + "</td>";
                            if (item.nik_ibu) {
                                nik_ibu = 'NIK - ' + item.nik_ibu;
                            } else {
                                nik_ibu = '';
                            }
                            if (item.nik_ayah) {
                                nik_ayah = 'NIK - ' + item.nik_ayah;
                            } else {
                                nik_ayah = '';
                            }
                            content += "<td><div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate text-primary'><a href='javascript:void(0);' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-html='true' class='text-dark'><u>" + item.ibu + "</u></a></h6><small class='text-truncate text-muted'>" + nik_ibu + "</small></div></div></td>";
                            content += "<td><div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate text-primary'><a href='javascript:void(0);' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-html='true' class='text-dark'><u>" + item.ayah + "</u></a></h6><small class='text-truncate text-muted'>" + nik_ayah + "</small></div></div></td>";
                            content += "<td>";
                            if (item.anak == null)
                                content += "";
                            else
                                content += item.anak;
                            content += "</td><td>";
                            if (item.kelamin == "unknown")
                                content += "<span class='badge bg-dark text-white me-1'>-</span>";
                            if (item.kelamin == "laki-laki")
                                content += "<span class='badge bg-blue text-white me-1'>L</span>";
                            if (item.kelamin == "perempuan")
                                content += "<span class='badge bg-pink text-white me-1'>P</span>";
                            content +=  " / " + item.bb + " / " + item.tb + "</td><td class='text-wrap'>" +
                                item.alamat + "</td>";
                            content += `</tr>`;
                            $('#tampil-tbody').append(content);
                        });
                        var table = $('#dttable').DataTable({
                            order: [
                                [1, "desc"]
                            ],
                            bAutoWidth: false,
                            aoColumns : [
                                { sWidth: '6%' },
                                { sWidth: '7%' },
                                { sWidth: '12%' },
                                { sWidth: '15%' },
                                { sWidth: '15%' },
                                { sWidth: '15%' },
                                { sWidth: '10%' },
                                { sWidth: '20%' },
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
                    }
                });
                $('#btn-filter').tooltip('hide');
            }
        }

        function showAll() {
            $("#cari_ibu").val('');
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="10"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            const btn = $('#btn-refresh-all').find('i');
            $.ajax({
                url: "/api/v4/pelayanan/skl/all",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    btn.prop('disabled', true).addClass('fa-sync fa-spin').removeClass('fa-history');
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        // var updet = item.updated_at.substring(0, 10);
                        content = `<tr id='data"+ item.id +"'>`;
                        content +=
                            `<td><center><div class='btn-group'><a href='javascript:void(0);' class='link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false' value="animate__rubberBand">`+item.id+`</a><ul class='dropdown-menu dropdown-menu-right'>` +
                            `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(` +
                            item.id +
                            `)"><i class='fas fa-edit me-1'></i> Ubah</a></li>` +
                            `<li><a href='javascript:void(0);' class='dropdown-item text-info' onclick="window.open('/v4/pelayanan/skl/` +
                            item.id +
                            `/print','id','width=900,height=600')"><i class='fas fa-print me-1'></i> Cetak</a></li>` +
                            `<li><a href='javascript:void(0);' class='dropdown-item text-success' onclick="window.open('/v4/pelayanan/skl/` +
                            item.id +
                            `/cetak')"><i class='fas fa-download me-1'></i> Download</a></li>` +
                            `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` +
                            item.id +
                            `)"><i class='fas fa-trash me-1'></i> Hapus</a></li>` +
                            `</ul></center></td><td>`;
                        content += item.no_surat + "</td><td>" + item.tgl + "</td>";
                        if (item.nik_ibu) {
                            nik_ibu = 'NIK - ' + item.nik_ibu;
                        } else {
                            nik_ibu = '';
                        }
                        if (item.nik_ayah) {
                            nik_ayah = 'NIK - ' + item.nik_ayah;
                        } else {
                            nik_ayah = '';
                        }
                        content += "<td><div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate text-primary'><a href='javascript:void(0);' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-html='true' class='text-dark'><u>" + item.ibu + "</u></a></h6><small class='text-truncate text-muted'>" + nik_ibu + "</small></div></div></td>";
                        content += "<td><div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate text-primary'><a href='javascript:void(0);' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-html='true' class='text-dark'><u>" + item.ayah + "</u></a></h6><small class='text-truncate text-muted'>" + nik_ayah + "</small></div></div></td>";
                        content += "<td>";
                        if (item.anak == null)
                            content += "";
                        else
                            content += item.anak;
                        content += "</td><td>";
                        if (item.kelamin == "unknown")
                            content += "<span class='badge bg-dark text-white me-1'>-</span>";
                        if (item.kelamin == "laki-laki")
                            content += "<span class='badge bg-blue text-white me-1'>L</span>";
                        if (item.kelamin == "perempuan")
                            content += "<span class='badge bg-pink text-white me-1'>P</span>";
                        content +=  " / " + item.bb + " / " + item.tb + "</td><td class='text-wrap'>" +
                            item.alamat + "</td>";
                        content += `</tr>`;
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [1, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '6%' },
                            { sWidth: '7%' },
                            { sWidth: '12%' },
                            { sWidth: '15%' },
                            { sWidth: '15%' },
                            { sWidth: '15%' },
                            { sWidth: '10%' },
                            { sWidth: '20%' },
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
                }, error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                }, complete: function() {
                    btn.prop('disabled', false).removeClass('fa-sync fa-spin').addClass('fa-history');
                }
            });
        }

        function tambah() {
            $.ajax({
                url: "/api/v4/pelayanan/skl/getqueue",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#button_ubah_no_surat').prop('hidden', false);
                    $("#tampil_no_surat").val(res.nomer).prop('hidden', false).prop('disabled', true);
                    $("#save_no_surat").val(res.nomer).prop('hidden', true);
                    $('#tambah').modal('show');
                }
            });
        }

        function saveData() {
            let form = $('#form-skl')[0];
            let data = new FormData(form);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/api/v4/pelayanan/skl/simpan",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,

                beforeSend: function () {
                    $('#btn-simpan').prop('disabled', true);
                    $('#btn-simpan').html(`
                        <span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...
                    `);
                },

                success: function (response) {
                    // reset form
                    $('#form-skl')[0].reset();

                    // 🔥 re-init tanggal
                    let now = moment().format('YYYY-MM-DD HH:mm');
                    fpTgl.setDate(now, true);

                    // tutup modal
                    $('#tambah').modal('hide');

                    // notif sukses
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil disimpan!',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // reload data (opsional kalau pakai datatable)
                    refresh();
                },

                error: function (xhr) {
                    let errorHtml = 'Terjadi kesalahan!';

                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.errors) {

                            let errors = Object.values(xhr.responseJSON.errors).flat();

                            errorHtml = '<ul style="text-align:left; margin:0; padding-left:20px;">';
                            errors.forEach(function (err) {
                                errorHtml += `<li>${err}</li>`;
                            });
                            errorHtml += '</ul>';

                        } else if (xhr.responseJSON.message) {
                            errorHtml = xhr.responseJSON.message;
                        }
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Maaf proses Gagal, Periksa sekali lagi data Anda!',
                        html: errorHtml   // 🔥 pakai html, bukan text
                    });
                },

                complete: function () {
                    $('#btn-simpan').prop('disabled', false);
                    $('#btn-simpan').html(`
                        <i class="fa fa-save"></i>&nbsp;&nbsp;Simpan
                    `);
                }
            });
        }

        // Button UBAH
        function ubahNoSurat() {
            document.getElementById("button_ubah_no_surat").hidden = true;
            document.getElementById("tampil_no_surat").hidden = true;
            document.getElementById("save_no_surat").hidden = false;
        }

        function showUbah(id) {
            $.ajax({
                url: "/api/v4/pelayanan/skl/getubah/" + id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // $("#tgl_edit").val(tgl); // yyyy-MM-ddThh:mm
                    // var tgl = res.tgl + ' ' + res.waktu;
                    var finalTgl = moment(res.show.tgl).format('Y-MM-DD HH:mm');
                    // TGL EDIT
                    var a = document.querySelector("#tgl_edit");
                    var b = new Date(Date.now() - 1728e5);
                    a.flatpickr({
                        enableTime: !0,
                        minuteIncrement: 1,
                        defaultDate: finalTgl,
                        time_24hr: true,
                        // disable: [{
                        //   from: "2000-01-01",
                        //   to: b.toISOString().split("T")[0]
                        // }]
                    })
                    document.getElementById('show_id').innerHTML = res.show.id;
                    $("#id_edit").val(res.show.id);
                    $("#no_surat_edit").val(res.show.no_surat);
                    if (res.show.nik_ibu) {
                        $("#nik_ibu_edit").val(res.show.nik_ibu);
                    }
                    if (res.show.nik_ayah) {
                        $("#nik_ayah_edit").val(res.show.nik_ayah);
                    }
                    $("#ibu_edit").val(res.show.ibu.slice(4, 199));
                    $("#ayah_edit").val(res.show.ayah.slice(4, 199));
                    $("#anak_edit").val(res.show.anak);
                    $("#bb_edit").val(res.show.bb);
                    $("#tb_edit").val(res.show.tb);
                    $("#alamat_edit").val(res.show.alamat);
                    $("#kelamin_edit").find('option').remove();
                    $("#kelamin_edit").append(`
                        <option value="unknown" ${res.show.kelamin == 'unknown'? "selected":""}>Belum Diketahui</option>
                        <option value="laki-laki" ${res.show.kelamin == 'laki-laki'? "selected":""}>Laki-laki</option>
                        <option value="perempuan" ${res.show.kelamin == 'perempuan'? "selected":""}>Perempuan</option>
                    `);
                    $("#dr_edit").find('option').remove();
                    $("#dr_edit").append(`
                        <option value="1" ${res.show.dr == '1'? "selected":""}>dr. Gede Sri Dhyana M. A., Sp.OG</option>
                        <option value="2" ${res.show.dr == '2'? "selected":""}>dr. H. Ahmad Sutamat, Sp.OG</option>
                        <option value="3" ${res.show.dr == '3'? "selected":""}>dr. Febrian Andhika Adiyana, Sp.OG</option>
                        <option value="4" ${res.show.dr == '4'? "selected":""}>dr. Putri Eka Pratiwi, Sp.OG</option>
                    `);
                    $('#ubah').modal('show');
                }, error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: xhr.responseJSON.message,
                        position: 'topRight'
                    });
                }, complete: function() {
                }
            });
        }

        function ubah() {
            var user_edit = '{{ Auth::user()->name }}';
            var id_edit = $("#id_edit").val();
            var no_surat_edit = $("#no_surat_edit").val();
            var tgl_edit = $("#tgl_edit").val();
            var nik_ibu_edit = $("#nik_ibu_edit").val();
            var nik_ayah_edit = $("#nik_ayah_edit").val();
            var ibu_edit = $("#ibu_edit").val();
            var ayah_edit = $("#ayah_edit").val();
            var anak_edit = $("#anak_edit").val();
            var dr_edit = $("#dr_edit").val();
            var bb_edit = $("#bb_edit").val();
            var tb_edit = $("#tb_edit").val();
            var kelamin_edit = $("#kelamin_edit").val();
            var alamat_edit = $("#alamat_edit").val();

            // console.log(tgl_edit+' - '+ibu_edit+' - '+ayah_edit+' - '+anak_edit+' - '+dr_edit+' - '+bb_edit+' - '+tb_edit+' - '+kelamin_edit+' - '+alamat_edit);
            if (no_surat_edit == "" || tgl_edit == "" || nik_ibu_edit == "" || nik_ayah_edit == "" || ibu_edit == "" || ayah_edit == "" || dr_edit == "" || bb_edit == "" || tb_edit == "" || kelamin_edit  == "" || alamat_edit == "") {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon lengkapi semua data terlebih dahulu',
                    position: 'topRight'
                });
                // Swal.fire({
                //     title: 'Pesan Galat!',
                //     text: 'Mohon lengkapi semua data terlebih dahulu',
                //     icon: 'error',
                //     showConfirmButton: false,
                //     showCancelButton: false,
                //     allowOutsideClick: true,
                //     allowEscapeKey: true,
                //     timer: 3000,
                //     timerProgressBar: true,
                //     backdrop: `rgba(26,27,41,0.8)`,
                // });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/v4/pelayanan/skl/ubah/' + id_edit,
                    dataType: 'json',
                    data: {
                        user_edit: user_edit,
                        id_edit: id_edit,
                        no_surat_edit: no_surat_edit,
                        tgl_edit: tgl_edit,
                        nik_ibu_edit: nik_ibu_edit,
                        nik_ayah_edit: nik_ayah_edit,
                        ibu_edit: ibu_edit,
                        ayah_edit: ayah_edit,
                        anak_edit: anak_edit,
                        dr_edit: dr_edit,
                        bb_edit: bb_edit,
                        tb_edit: tb_edit,
                        kelamin_edit: kelamin_edit,
                        alamat_edit: alamat_edit,
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Ubah Surat Keterangan Lahir Bayi NY.'+ibu_edit+' berhasil pada ' + res,
                            position: 'topRight'
                        });
                        if (res) {
                            $('#ubah').modal('hide');
                        }
                    }, error: function(xhr, status, error) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: xhr.responseJSON.message,
                            position: 'topRight'
                        });
                    }, complete: function() {
                        refresh();
                    }
                });
            }
        }

        function hapus(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Data SKL ID : ' + id,
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
                        url: "/api/v4/pelayanan/skl/hapus/" + id,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Pesan Sukses!',
                                message: 'Hapus Data SKL berhasil pada ' + res,
                                position: 'topRight'
                            });
                        }, error: function(xhr, status, error) {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: xhr.responseJSON.message,
                                position: 'topRight'
                            });
                        }, complete: function() {
                            refresh();
                        }
                    });
                }
            })
        }
    </script>
@endsection
