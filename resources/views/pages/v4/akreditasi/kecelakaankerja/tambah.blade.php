@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    <b class="text-success">Tambah Data</b> - <b class="text-orange link-underline-orange text-decoration-underline">Pelaporan Kecelakaan Kerja</b> (<b class="text-danger">Accident Report</b>)
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Akreditasi</a>
                    </li>
                    <li class="breadcrumb-item pe-none" aria-current="page">
                        MFK
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a role="button" onclick="window.location.href='{{ route('v4.akreditasi.kecelakaankerja') }}'">Kecelakaan Kerja</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Tambah Data
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <div class="btn-group flex-grow-0">
                            <button class="btn btn-warning-transparent" onclick="window.location='{{ route('v4.akreditasi.kecelakaankerja') }}'"><i
                                class="fas fa-arrow-left"></i>&nbsp;&nbsp;Kembali / Batal</button>
                        </div>
                        <div class="flex-shrink-1">
                            <h6>Tanda <b class="text-danger">*</b> Wajib Disi</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-auth-small needs-validation" name="formTambah" action="{{ route('v4.akreditasi.kecelakaankerja.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3"><div class="alert alert-light shadow-sm p-3"><h5 class="mb-0 text-primary text-center">A. Identifikasi Kecelakaan</h5></div></div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Waktu <a class="text-danger">*</a></label>
                                        <input type="datetime-local" class="form-control" name="tgl"
                                            placeholder="Pilih Tanggal dan Waktu" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Lokasi <a class="text-danger">*</a></label>
                                        <input type="text" name="lokasi" id="lokasi" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Jenis Kecelakaan <a class="text-danger">*</a></label>
                                        <select class="form-control" name="jenis" id="jenis" style="width: 100%"
                                            required>
                                            <option value="">Pilih</option>
                                            <option value="1">Menabrak</option>
                                            <option value="2">Tertabrak</option>
                                            <option value="3">Terperangkap</option>
                                            <option value="4">Terbentur / Terpukul</option>
                                            <option value="5">Tergelincir</option>
                                            <option value="6">Terjepit</option>
                                            <option value="7">Tersangkut</option>
                                            <option value="8">Tertimbun</option>
                                            <option value="9">Terhirup</option>
                                            <option value="10">Tenggelam</option>
                                            <option value="11">Jatuh dari ketinggian yang sama</option>
                                            <option value="12">Jatuh dari ketinggian yang berbeda</option>
                                            <option value="13">Kontak dengan (Arus Listrik, Suhu Panas, Suhu Dingin, Terpapar
                                                Radiasi, Bahan Kimia Berbahaya)</option>
                                            <option value="14">Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="lainlain" class="row" hidden>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Lain-lain</label>
                                            <textarea class="form-control" name="lain1" id="lain1" placeholder="" maxlength="190" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Kronologi Kecelakaan <a class="text-danger">*</a></label>
                                        <textarea class="form-control" name="kronologi" id="kronologi1" placeholder="" maxlength="190" rows="2" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3"><div class="alert alert-light shadow-sm p-3"><h5 class="mb-0 text-primary text-center">B. Kerugian</h5></div></div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Kerugian Pada Manusia</label><br>
                                            <div class="checkbox-group required">
                                                <input class="form-check-input mb-2" type="radio" name="kerugian" id="radio-kerugian1" value="1" checked>
                                                <label for="radio-kerugian1"><b class="text-success">Tak Cedera</b> (Tidak ada cedera dan tidak ada hilang hari kerja)</label><br>
                                                <input class="form-check-input mb-2" type="radio" name="kerugian" id="radio-kerugian2" value="2">
                                                <label for="radio-kerugian2"><b class="text-info">Cedera Ringan</b> (Mengalami cedera ringan/mendapat P3K tapi tidak ada hilang hari kerja)</label><br>
                                                <input class="form-check-input mb-2" type="radio" name="kerugian" id="radio-kerugian3" value="3">
                                                <label for="radio-kerugian3"><b class="text-warning">Cedera Sedang</b> (Mengalami cedera yang memerlukan pertolongan medis tapi adanya hilang hari kerja)</label><br>
                                                <input class="form-check-input mb-2" type="radio" name="kerugian" id="radio-kerugian4" value="4">
                                                <label for="radio-kerugian4"><b class="text-orange">Cedera Berat</b> (Mengalami cedera yang memerlukan pertolongan medis dan atau rujukan medis, cacat sementara dan adanya hilang hari kerja)</label><br>
                                                <input class="form-check-input mb-2" type="radio" name="kerugian" id="radio-kerugian5" value="5">
                                                <label for="radio-kerugian5"><b class="text-danger">Meninggal/Fatal</b> (Mengalami cacat permanen atau kematian)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nama Korban <a class="text-danger">*</a><input type="checkbox" class="checkbox_check me-2" style="margin-left: 8px" onclick="validateLuarRs()" id="luarrs">Luar RS ?</label>
                                        {{-- <div class="input-group"> --}}
                                            <div class="korban1">
                                                <select class="select2 form-select korban1select" name="korban" style="width: 100%" required>
                                                    <option value="">Pilih Karyawan</option>
                                                    @foreach($list['user'] as $us => $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="text" name="korban_luar" class="form-control korban2" placeholder="Tuliskan Nama Korban dari luar Rumah Sakit" hidden>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Unit/Jabatan/Jenis <a class="text-danger">*</a></label>
                                        <div class="korban1">
                                            <select class="select2 form-select korban1select" name="role" id="unit" style="width: 100%" required>
                                                <option value="">Pilih</option>
                                                @foreach($list['unit'] as $name => $item)
                                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="text" name="role_luar" class="form-control korban2" placeholder="e.g. Tukang Sampah" hidden>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Tanggal Lahir <a class="text-danger">*</a></label>
                                        <input type="date" name="lahir" class="form-control"
                                            placeholder="YYYY-MM-DD" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Jenis Kelamin <a class="text-danger">*</a></label>
                                            <select id="jk" name="jk" class="form-control" style="width: 100%" required>
                                                <option value="">Pilih</option>
                                                <option value="laki-laki">Laki-laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Bila cedera / cacat, anggota tubuh mana yang terkena?</label>
                                        <input type="text" name="cedera" id="cedera" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Penanganan <a class="text-danger">*</a></label>
                                        <textarea class="form-control" name="penanganan" id="penanganan1" placeholder="" maxlength="190" rows="2" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Kerugian Aset/Material/Proses</label>
                                        <input type="text" name="k_aset" id="k_aset" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Kerugian Lingkungan</label>
                                        <input type="text" name="k_lingkungan" id="k_lingkungan" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3"><div class="alert alert-light shadow-sm p-3"><h5 class="mb-0 text-primary text-center">C. Investigasi Kecelakaan</h5></div></div>
                                <h6 class="text-primary">1. Penyebab Langsung</h6>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Tindakan Tidak Aman <i>(Unsafe Action)</i> <a class="text-danger">*</a></label>
                                        <input type="text" name="tta" id="tta" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Kondisi Tidak Aman <i>(Unsafe Condition)</i> <a class="text-danger">*</a></label>
                                        <input type="text" name="kta" id="kta" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                                <br>
                                <h6 class="text-primary">2. Penyebab Dasar</h6>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Faktor Personal <a class="text-danger">*</a></label>
                                        <input type="text" name="f_personal" id="f_personal" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Faktor Pekerjaan <a class="text-danger">*</a></label>
                                        <input type="text" name="f_pekerjaan" id="f_pekerjaan" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                                <br>
                                <h6 class="text-primary">3. Alat / Sumber Yang Terlibat Pada Kecelakaan</h6>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Peralatan Kerja <a class="text-danger">*</a></label>
                                        <input type="text" name="p_kerja" id="p_kerja" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Benda Bergerak</label>
                                        <input type="text" name="benda_bergerak" id="benda_bergerak"
                                            class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Mesin</label>
                                        <input type="text" name="mesin" id="mesin" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Bejana Tekan</label>
                                        <input type="text" name="bejana_tekan" id="bejana_tekan" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Material</label>
                                        <input type="text" name="material" id="material" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Alat Listrik</label>
                                        <input type="text" name="alat_listrik" id="alat_listrik" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Alat Berat</label>
                                        <input type="text" name="alat_berat" id="alat_berat" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Radiasi</label>
                                        <input type="text" name="radiasi" id="radiasi" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Kendaraan</label>
                                        <input type="text" name="kendaraan" id="kendaraan" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Binatang</label>
                                        <input type="text" name="binatang" id="binatang" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Lain-lain</label>
                                        <textarea class="form-control" name="lain2" id="lain2" placeholder="" maxlength="190" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3"><div class="alert alert-light shadow-sm p-3"><h5 class="mb-0 text-primary text-center">D. Rencana Tindakan Perbaikan</h5></div></div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Rencana Tindakan <a class="text-danger">*</a></label>
                                        <textarea class="form-control" name="r_tindakan" id="r_tindakan" placeholder="" maxlength="190" rows="2" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Target Waktu <a class="text-danger">*</a></label>
                                        <textarea class="form-control" name="t_waktu" id="t_waktu" placeholder="" maxlength="190" rows="2" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Wewenang <a class="text-danger">*</a></label>
                                        <textarea class="form-control" name="wewenang" id="wewenang" placeholder="" maxlength="190" rows="2" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <label class="form-label">Lampiran (<b class="text-warning">Optional</b>)</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <center><button type="submit" class="btn btn-success" id="btn-simpan" onclick="saveData()"><i class="fa-fw fas fa-save nav-icon"></i> Submit Laporan</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('div.checkbox-group.required :checkbox:checked').length > 0
            // SELECT2
            var te = $(".select2");
            te.length && te.each(function() {
                var es = $(this);
                es.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    dropdownParent: es.parent()
                })
            });

            // DATEPICKER
            const today = new Date();
            var tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            var next = new Date(today);
            next.setDate(next.getDate() + 999999);
            const l = $('.flatpickr');
            const full = $('.flatpickrfull');
            // const dates = new Date(Date.now());
            // const tomorow = dates.getTime();
            // const m = new Date(Date.now());
            // const c = new Date(Date.now() + 1728e5); // 3 hari kedepan
            var now = moment().locale('id').format('Y-MM-DD HH:mm');
            l.flatpickr({
                enableTime: 0,
                minuteIncrement: 1,
                // monthSelectorType: "static",
                // inline: true,
                // defaultHour: 12,
                // defaultMinute: "today",
                time_24hr: true,
                // dateFormat: "Y-m-d H:m",
                disable: [{
                    from: tomorrow.toISOString().split("T")[0],
                    to: next.toISOString().split("T")[0]
                }]
            })
            full.flatpickr({
                // mode: "range",
                dateFormat: "",
                enableTime: true,
                // dateFormat: "d M y, H:i",
                dateFormat: "Y-m-d H:i",
                time_24hr: true
            })

            // JENIS CHANGE
            $('#jenis').change(function() {
                if ($(this).val() == 14) {
                    $('#lainlain').prop('hidden',false);
                } else {
                    $('#lainlain').prop('hidden',true);
                }
            });
        });

        // FUNCTION-FUNCTION
        function saveData() {
            $("#formTambah").one('submit', function() {
                //stop submitting the form to see the disabled button effect
                $("#btn-simpan").attr('disabled','disabled');
                $("#btn-simpan").find("i").toggleClass("fa-save fa-spinner fa-spin");

                return true;
            });
        }

        function validateLuarRs() {
            if ($('input.checkbox_check').is(':checked')) {
                $(".korban1").prop('hidden', true);
                $(".korban2").prop('hidden', false);
                $(".korban1select").prop('required', false);
                $(".korban2").prop('required', true);
                $(".korban1select").val('').trigger('change');
                $(".korban2").val('');
            } else {
                $(".korban1").prop('hidden', false);
                $(".korban2").prop('hidden', true);
                $(".korban1select").prop('required', true);
                $(".korban2").prop('required', false);
                $(".korban1select").val('').trigger('change');
                $(".korban2").val('');
            }
        }
    </script>
@endsection
