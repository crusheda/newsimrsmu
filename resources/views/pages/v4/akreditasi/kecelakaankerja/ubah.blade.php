@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    <b class="text-warning">Ubah Data</b> - <b class="text-orange link-underline-orange text-decoration-underline">Pelaporan Kecelakaan Kerja</b> (<b class="text-danger">Accident Report</b>)
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
                        Ubah Data
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-warning-transparent"
                                    onclick="window.location='{{ route('v4.akreditasi.kecelakaankerja') }}'">
                                <i class="fas fa-arrow-left me-1"></i> Kembali / Batal
                            </button>
                            <h6 class="ms-3 mb-0">
                                <span class="badge bg-primary fs-14">ID # {{ $list['show']->id }}</span>
                            </h6>
                        </div>
                        <div>
                            <h6 class="mb-0">
                                Tanda <b class="text-danger">*</b> Wajib Diisi
                            </h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('v4.akreditasi.kecelakaankerja.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $list['show']->id }}">
                            <div class="row">
                                <div class="col-md-12 mb-3"><div class="alert alert-light shadow-sm p-3"><h5 class="mb-0 text-primary text-center">A. Identifikasi Kecelakaan</h5></div></div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Waktu <a class="text-danger">*</a></label>
                                        <input type="datetime-local" class="form-control" name="tgl"
                                        placeholder="Pilih Tanggal dan Waktu" value="{{ $list['show']->tgl }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Lokasi <a class="text-danger">*</a></label>
                                        <input type="text" name="lokasi" id="lokasi" value="{{ $list['show']->lokasi }}" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Jenis Kecelakaan <a class="text-danger">*</a></label>
                                        <select class="select2 form-select" name="jenis" id="jenis"
                                            required>
                                            <option value="1" @if ($list['show']->jenis == '1') echo selected @endif>Menabrak</option>
                                            <option value="2" @if ($list['show']->jenis == '2') echo selected @endif>Tertabrak</option>
                                            <option value="3" @if ($list['show']->jenis == '3') echo selected @endif>Terperangkap</option>
                                            <option value="4" @if ($list['show']->jenis == '4') echo selected @endif>Terbentur / Terpukul</option>
                                            <option value="5" @if ($list['show']->jenis == '5') echo selected @endif>Tergelincir</option>
                                            <option value="6" @if ($list['show']->jenis == '6') echo selected @endif>Terjepit</option>
                                            <option value="7" @if ($list['show']->jenis == '7') echo selected @endif>Tersangkut</option>
                                            <option value="8" @if ($list['show']->jenis == '8') echo selected @endif>Tertimbun</option>
                                            <option value="9" @if ($list['show']->jenis == '9') echo selected @endif>Terhirup</option>
                                            <option value="10" @if ($list['show']->jenis == '10') echo selected @endif>Tenggelam</option>
                                            <option value="11" @if ($list['show']->jenis == '11') echo selected @endif>Jatuh dari ketinggian yang sama</option>
                                            <option value="12" @if ($list['show']->jenis == '12') echo selected @endif>Jatuh dari ketinggian yang berbeda</option>
                                            <option value="13" @if ($list['show']->jenis == '13') echo selected @endif>Kontak dengan (Arus Listrik, Suhu Panas, Suhu Dingin, Terpapar Radiasi, Bahan Kimia Berbahaya)</option>
                                            <option value="14" @if ($list['show']->jenis == '14') echo selected @endif>Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="lainlain" class="row" @if ($list['show']->jenis != '14') echo hidden @endif>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Lain-lain</label>
                                            <textarea class="form-control" name="lain1" id="lain1" placeholder="" maxlength="190" rows="2"><?php echo htmlspecialchars($list['show']->lain1); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Kronologi Kecelakaan <a class="text-danger">*</a></label>
                                        <textarea class="form-control" name="kronologi" id="kronologi1" placeholder="" maxlength="190" rows="2" required><?php echo htmlspecialchars($list['show']->kronologi); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3"><div class="alert alert-light shadow-sm p-3"><h5 class="mb-0 text-primary text-center">B. Kerugian</h5></div></div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Kerugian Pada Manusia</label><br>
                                            <div class="checkbox-group required">
                                                <input class="form-check-input mb-2" type="radio" name="kerugian" id="radio-kerugian1" value="1" @if ($list['show']->kerugian == '1') echo checked @endif>
                                                <label for="radio-kerugian1"><b class="text-success">Tak Cedera</b> (Tidak ada cedera dan tidak ada hilang hari kerja)</label><br>
                                                <input class="form-check-input mb-2" type="radio" name="kerugian" id="radio-kerugian2" value="2" @if ($list['show']->kerugian == '2') echo checked @endif>
                                                <label for="radio-kerugian2"><b class="text-info">Cedera Ringan</b> (Mengalami cedera ringan/mendapat P3K tapi tidak ada hilang hari kerja)</label><br>
                                                <input class="form-check-input mb-2" type="radio" name="kerugian" id="radio-kerugian3" value="3" @if ($list['show']->kerugian == '3') echo checked @endif>
                                                <label for="radio-kerugian3"><b class="text-warning">Cedera Sedang</b> (Mengalami cedera yang memerlukan pertolongan medis tapi adanya hilang hari kerja)</label><br>
                                                <input class="form-check-input mb-2" type="radio" name="kerugian" id="radio-kerugian4" value="4" @if ($list['show']->kerugian == '4') echo checked @endif>
                                                <label for="radio-kerugian4"><b class="text-orange">Cedera Berat</b> (Mengalami cedera yang memerlukan pertolongan medis dan atau rujukan medis, cacat sementara dan adanya hilang hari kerja)</label><br>
                                                <input class="form-check-input mb-2" type="radio" name="kerugian" id="radio-kerugian5" value="5" @if ($list['show']->kerugian == '5') echo checked @endif>
                                                <label for="radio-kerugian5"><b class="text-danger">Meninggal/Fatal</b> (Mengalami cacat permanen atau kematian)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nama Korban <a class="text-danger">*</a></label>
                                        <input type="text" name="korban" id="korban" value="{{ $list['show']->korban }}" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Unit <a class="text-danger">*</a></label>
                                        <select class="form-select" name="unit" id="unit" required>
                                            @foreach($list['unit'] as $name => $key)
                                                <option value="{{ $name }}" @if ($list['show']->unit == $name) echo selected @endif>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nama Korban <a class="text-danger">*</a></label>
                                        <input type="text" value="{{ $list['show']->nama_korban }}{{ $list['show']->korban_luar }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Unit/Jabatan/Jenis <a class="text-danger">*</a></label>
                                        <input type="text" value="{{ $list['show']->role }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Tanggal Lahir <a class="text-danger">*</a></label>
                                        <input type="date" name="lahir" value="{{ $list['show']->lahir }}" class="form-control"
                                            placeholder="YYYY-MM-DD" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Jenis Kelamin <a class="text-danger">*</a></label>
                                        <select id="jk" name="jk" class="select2 form-select" required>
                                            <option value="">Pilih</option>
                                            <option value="laki-laki" @if ($list['show']->jk == 'laki-laki') echo selected @endif>Laki-laki</option>
                                            <option value="perempuan" @if ($list['show']->jk == 'perempuan') echo selected @endif>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Bila cedera / cacat, anggota tubuh mana yang terkena? </label>
                                        <input type="text" name="cedera" id="cedera" value="{{ $list['show']->cedera }}" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Penanganan <a class="text-danger">*</a></label>
                                        <textarea class="form-control" name="penanganan" id="penanganan1" placeholder="" maxlength="190" rows="2" required><?php echo htmlspecialchars($list['show']->penanganan); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Kerugian Aset/Material/Proses</label>
                                        <input type="text" name="k_aset" id="k_aset" value="{{ $list['show']->k_aset }}" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Kerugian Lingkungan</label>
                                        <input type="text" name="k_lingkungan" id="k_lingkungan" value="{{ $list['show']->k_lingkungan }}" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3"><div class="alert alert-light shadow-sm p-3"><h5 class="mb-0 text-primary text-center">C. Investigasi Kecelakaan</h5></div></div>
                                <h6 class="text-primary">1. Penyebab Langsung</h6>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Tindakan Tidak Aman <i>(Unsafe Action)</i> <a class="text-danger">*</a></label>
                                        <input type="text" name="tta" id="tta" value="{{ $list['show']->tta }}" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Kondisi Tidak Aman <i>(Unsafe Condition)</i> <a class="text-danger">*</a></label>
                                        <input type="text" name="kta" id="kta" value="{{ $list['show']->kta }}" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                                <br>
                                <h6 class="text-primary">2. Penyebab Dasar</h6>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Faktor Personal <a class="text-danger">*</a></label>
                                        <input type="text" name="f_personal" id="f_personal" value="{{ $list['show']->f_personal }}" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Faktor Pekerjaan <a class="text-danger">*</a></label>
                                        <input type="text" name="f_pekerjaan" id="f_pekerjaan" value="{{ $list['show']->f_pekerjaan }}" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                                <br>
                                <h6 class="text-primary">3. Alat / Sumber Yang Terlibat Pada Kecelakaan</h6>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Peralatan Kerja <a class="text-danger">*</a></label>
                                        <input type="text" name="p_kerja" id="p_kerja" value="{{ $list['show']->p_kerja }}" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Benda Bergerak</label>
                                        <input type="text" name="benda_bergerak" id="benda_bergerak" value="{{ $list['show']->benda_bergerak }}"
                                            class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Mesin</label>
                                        <input type="text" name="mesin" id="mesin" value="{{ $list['show']->mesin }}" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Bejana Tekan</label>
                                        <input type="text" name="bejana_tekan" id="bejana_tekan" value="{{ $list['show']->bejana_tekan }}" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Material</label>
                                        <input type="text" name="material" id="material" value="{{ $list['show']->material }}" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Alat Listrik</label>
                                        <input type="text" name="alat_listrik" id="alat_listrik" value="{{ $list['show']->alat_listrik }}" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Alat Berat</label>
                                        <input type="text" name="alat_berat" id="alat_berat" value="{{ $list['show']->alat_berat }}" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Radiasi</label>
                                        <input type="text" name="radiasi" id="radiasi" value="{{ $list['show']->radiasi }}" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Kendaraan</label>
                                        <input type="text" name="kendaraan" id="kendaraan" value="{{ $list['show']->kendaraan }}" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Binatang</label>
                                        <input type="text" name="binatang" id="binatang" value="{{ $list['show']->binatang }}" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Lain-lain</label>
                                        <textarea class="form-control" name="lain2" id="lain2" placeholder="" maxlength="190" rows="2"><?php echo htmlspecialchars($list['show']->lain2); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3"><div class="alert alert-light shadow-sm p-3"><h5 class="mb-0 text-primary text-center">D. Rencana Tindakan Perbaikan</h5></div></div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Rencana Tindakan <a class="text-danger">*</a></label>
                                        <textarea class="form-control" name="r_tindakan" id="r_tindakan" placeholder="" maxlength="190" rows="2" required><?php echo htmlspecialchars($list['show']->r_tindakan); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Target Waktu <a class="text-danger">*</a></label>
                                        <textarea class="form-control" name="t_waktu" id="t_waktu" placeholder="" maxlength="190" rows="2" required><?php echo htmlspecialchars($list['show']->t_waktu); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Wewenang <a class="text-danger">*</a></label>
                                        <textarea class="form-control" name="wewenang" id="wewenang" placeholder="" maxlength="190" rows="2" required><?php echo htmlspecialchars($list['show']->wewenang); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Detail Lampiran</label><br>
                                        @if ($list['show']->filename == '')
                                            Tidak ada lampiran terupload.
                                        @else
                                            <b>{{ $list['show']->title }}</b> ({{Storage::size($list['show']->filename)}} bytes)
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <center><button class="btn btn-warning" id="btn-simpan" onclick="saveData()"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah Laporan</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // SELECT2
            var te = $(".select2");
            te.length && te.each(function() {
                var es = $(this);
                es.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    dropdownParent: es.parent()
                })
            });

            // JENIS CHANGE
            $('#jenis').change(function() {
                if ($(this).val() == 14) {
                    $('#lainlain').prop('hidden',false);
                } else {
                    $('#lainlain').prop('hidden',true);
                }
            });
        });
    </script>
@endsection
