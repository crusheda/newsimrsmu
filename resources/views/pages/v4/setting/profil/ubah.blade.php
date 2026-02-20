<div class="card custom-card">
    <div class="card-header fw-bold justify-content-between">
        <div>
            Ubah
            <b class="text-primary">
                Profil Saya
            </b>
        </div>
        <div>
            ( <span class="text-danger">*</span> ) Wajib Diisi
        </div>
    </div>
    <div class="card-body">
        <form id="formProfil" class="g-3 needs-validation" noValidate>
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-5">
                            <label class="form-label fw-bold">
                                Foto Profil
                            </label>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-3 flex-wrap">
                                        <span class="avatar avatar-xxl">
                                            <img id="previewFoto" src="{{ asset('images/white.jpg') }}" alt="Foto Profil" style="width:100%;height:100%;object-fit:cover">
                                            <!-- LOADING -->
                                            <div id="avatarLoadingUbah"
                                                class="position-absolute top-50 start-50 translate-middle">
                                                <div class="spinner-border spinner-border-sm"></div>
                                            </div>
                                        </span>

                                        <div class="d-flex flex-column">

                                            <div class="d-flex align-items-center gap-2 flex-wrap">

                                                <input type="file"
                                                    id="foto_ubah"
                                                    accept="image/*"
                                                    class="form-control form-control-sm skip-submit"
                                                    style="width:auto">

                                                <button type="button" class="btn btn-sm btn-primary" id="btnUploadFoto" onclick="ubahFotoProfil()" disabled>
                                                    <i class="ri-upload-2-line me-1"></i> Ganti Foto
                                                </button>

                                                <button type="button" class="btn btn-sm btn-light" id="btnHapusFoto" onclick="confirmHapusFotoProfil()" disabled>
                                                    <i class="ri-delete-bin-line me-1"></i> Hapus Foto
                                                </button>

                                            </div>

                                            <span class="d-block fs-12 text-muted mt-1">
                                                Ekstensi JPG / PNG. Ukuran ideal 200x200 pixels. Maksimal 3MB.
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <label class="form-label fw-bold">
                                Data Sensitif
                            </label>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3 mb-3">
                                            <label class="block font-medium mb-1">
                                                No.
                                                Induk
                                                Pegawai
                                                (NIP)
                                            </label>
                                            <input type="text" id="nip_ubah" readOnly
                                                class="w-full form-control p-2 bg-light"
                                                placeholder="(otomatis terisi)" />
                                        </div>
                                        <div class="col-sm-5 mb-3">
                                            <label class="block font-medium mb-1">
                                                No.
                                                Induk
                                                Kependudukan
                                                (NIK)
                                                <span class="text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <input type="text" id="nik_ubah" class="w-full form-control p-2" placeholder="..." required />
                                        </div>

                                        <div class="col-sm-4 mb-3">
                                            <label class="block font-medium mb-1">
                                                Email
                                                Aktif
                                                <span class="text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <input type="email" id="email_ubah" class="w-full form-control p-2" placeholder="..." required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7">
                    <label class="form-label fw-bold">
                        Pengalaman Kerja
                    </label>
                    <textarea id="pengalaman_kerja_ubah" rows="5" class="form-control mb-3"
                        placeholder="e.g. Saya pernah bekerja pada suatu instansi swasta ternama bertempat di Kota X dan berprofesi sebagai X..."></textarea>

                    <label class="form-label fw-bold">
                        Data Identitas
                    </label>
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text bg-primary-transparent">Preview</div>
                                        <input type="text" class="form-control form-control-sm border-dashed shadow-sm" id="nama_lengkap_ubah"
                                            placeholder="Nama Lengkap + Gelar (Terisi Otomatis)" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="block font-medium mb-1">
                                        Gelar
                                        Depan
                                    </label>
                                    <input type="text" id="gelar_depan_ubah" class="w-full form-control p-2"
                                        placeholder="dr" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="block font-medium mb-1">
                                        Nama
                                        Lengkap
                                        (<b class="text-primary link-underline-primary text-decoration-underline">Tanpa
                                        Gelar</b>)
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input type="text" id="nama_ubah" class="w-full form-control p-2"
                                        placeholder="Mayor Sunaryo Tiga Tujuh" required />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="block font-medium mb-1">
                                        Gelar
                                        Belakang
                                    </label>
                                    <input type="text" id="gelar_belakang_ubah" class="w-full form-control p-2"
                                        placeholder="Sp.x.FinaCS" />
                                </div>

                                <hr>

                                <div class="col-sm-5 mb-3">
                                    <label class="block font-medium mb-1">
                                        Nama
                                        Panggilan
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input type="text" id="nick_ubah" class="w-full form-control p-2" placeholder="Sunaryo" required />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="block font-medium mb-1">
                                        No. HP
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input type="text" id="no_hp_ubah" class="w-full form-control p-2"
                                        placeholder="628xxx" required />
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="block font-medium mb-1">
                                        Jenis
                                        Kelamin
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select id="jns_kelamin_ubah" class="w-full form-control p-2" required>
                                        <option value="">
                                            --
                                            Pilih
                                            --
                                        </option>
                                        <option value="LAKI-LAKI">
                                            Laki-laki
                                        </option>
                                        <option value="PEREMPUAN">
                                            Perempuan
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label class="block font-medium mb-1">
                                        Tempat Lahir
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select id="temp_lahir_ubah" class="form-control" required>
                                        <option value="">
                                            --
                                            Pilih Kota
                                            --
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="block font-medium mb-1">
                                        Tanggal Lahir
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input type="date" id="tgl_lahir_ubah" class="w-full form-control p-2" required />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="block font-medium mb-1">
                                        Status Perkawinan
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select id="status_kawin_ubah" class="w-full form-control p-2" required>
                                        <option value="">
                                            --
                                            Pilih
                                            --
                                        </option>
                                        <option value="BELUM">
                                            Belum Kawin
                                        </option>
                                        <option value="SUDAH">
                                            Sudah Kawin
                                        </option>
                                        <option value="CERAI">
                                            Cerai
                                        </option>
                                        <option value="RAHASIA">
                                            Tidak ingin memberi tahu
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <label class="form-label fw-bold">
                        Alamat KTP
                    </label>
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="alert alert-light">
                                <div class="form-check form-check-lg">
                                    <input class="form-check-input skip-submit border border-3" type="checkbox" id="cek_dom" />
                                    <label class="form-check-label" htmlFor="cek_dom">
                                        <u>
                                            <b>
                                                Alamat <b class="text-danger">Domisili</b> <b class="text-pink">Berbeda</b> dengan KTP?
                                            </b>
                                        </u>
                                    </label>
                                </div>
                                <small>
                                    Silakan isi Centang <i class="ri-checkbox-line fs-15 text-primary align-middle"></i> di atas ini untuk menampilkan Pilihan Alamat Domisili saat ini, diisi apabila alamat domisili Anda saat ini berbeda dengan alamat yang tertera pada KTP
                                </small>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        Provinsi
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select id="ktp_provinsi_ubah" class="w-full form-control p-2" required>
                                        <option value="">
                                            --
                                            Pilih
                                            Provinsi
                                            --
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        Kabupaten
                                        / Kota
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select id="ktp_kabupaten_ubah" required class="w-full form-control p-2" disabled required>
                                        <option value="">
                                            --
                                            Pilih
                                            Kabupaten
                                            --
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        Kecamatan
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select id="ktp_kecamatan_ubah" class="w-full form-control p-2" disabled required>
                                        <option value="">
                                            --
                                            Pilih
                                            Kecamatan
                                            --
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        Kelurahan
                                        / Desa
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select id="ktp_kelurahan_ubah" class="w-full form-control p-2" disabled required>
                                        <option value="">
                                            --
                                            Pilih
                                            Kelurahan
                                            --
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">
                                        Alamat
                                        Lengkap
                                        (KTP)
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <textarea id="alamat_ktp_ubah" rows="2" class="w-full form-control p-2" placeholder="Tuliskan alamat lengkap (Sesuai KTP)" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="input_dom" hidden>
                        <label class="form-label fw-bold">
                            Alamat Domisili (<i class="text-pink">Tempat Tinggal Anda Sekarang</i>)
                        </label>
                        <div class="card custom-card mt-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">
                                            Provinsi
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        <select id="dom_provinsi_ubah" class="form-control">
                                            <option value="">
                                                --
                                                Pilih
                                                Provinsi
                                                --
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">
                                            Kabupaten
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        <select id="dom_kabupaten_ubah" class="form-control" disabled>
                                            <option value="">
                                                --
                                                Pilih
                                                Kabupaten
                                                --
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">
                                            Kecamatan
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        <select id="dom_kecamatan_ubah" class="form-control" disabled>
                                            <option value="">
                                                --
                                                Pilih
                                                Kecamatan
                                                --
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">
                                            Kelurahan
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        <select id="dom_kelurahan_ubah" class="form-control" disabled>
                                            <option value="">
                                                --
                                                Pilih
                                                Kelurahan
                                                --
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="form-label">
                                            Alamat
                                            Lengkap (Saat Ini)
                                            <span class="text-danger">
                                                *
                                            </span>
                                        </label>
                                        <textarea class="form-control" id="alamat_dom_ubah" rows="4" placeholder="Tuliskan alamat lengkap domisili" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <label htmlFor="pengalaman_kerja" class="form-label fw-bold">
                        Data Media Sosial
                    </label>
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="block font-medium mb-1">
                                        <i class="ri-facebook-circle-fill fs-6 me-1"></i>
                                        Facebook
                                    </label>
                                    <input type="text" id="fb_ubah" placeholder="Facebook" class="form-control" />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="block font-medium mb-1">
                                        <i class="ri-instagram-fill fs-6 me-1"></i>
                                        Instagram
                                    </label>
                                    <input type="text" id="ig_ubah" placeholder="Instagram" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="block font-medium mb-1">
                                        <i class="ri-tiktok-fill fs-6 me-1"></i>
                                        Tiktok
                                    </label>
                                    <input type="text" id="tt_ubah" placeholder="Tiktok" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <label htmlFor="pengalaman_kerja" class="form-label fw-bold">
                        Data Kesehatan
                    </label>
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="block font-medium mb-1">
                                        Riwayat Penyakit
                                    </label>
                                    <textarea id="rp_ubah" rows="3"
                                        class="form-control" placeholder="e.g. Tuliskan bila ada"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="block font-medium mb-1">
                                        Riwayat Penyakit Keluarga
                                    </label>
                                    <textarea id="rpk_ubah" rows="3"
                                        class="form-control" placeholder="e.g. Tuliskan bila ada"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="block font-medium mb-1">
                                        Riwayat Operasi
                                    </label>
                                    <textarea id="ro_ubah" rows="3"
                                        class="form-control" placeholder="e.g. Tuliskan bila ada"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="block font-medium mb-1">
                                        Riwayat Penggunaan Obat
                                    </label>
                                    <textarea id="rpo_ubah" rows="3"
                                        class="form-control" placeholder="e.g. Tuliskan bila ada"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                $pendidikanList = [
                    'sd' => 'Sekolah Dasar (SD) atau sederajat',
                    'smp' => 'SMP/SLTP atau sederajat',
                    'sma' => 'SMA/SMK atau sederajat',
                    'd2' => 'Diploma 2',
                    'd3' => 'Diploma 3',
                    'd4' => 'Diploma 4',
                    's1' => 'Strata 1',
                    's1_profesi' => 'Strata 1 (Khusus Profesi)',
                    's2' => 'Strata 2',
                    's3' => 'Strata 3',
                ];
                @endphp
                <div class="col-xl-5">
                    <label class="form-label fw-bold">
                        Data Pendidikan
                    </label>
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-light mb-4">
                                <label class="form-label fw-bold">
                                    Keterangan
                                    Pengisian
                                </label>
                                <ul class="list-unstyled ms-2">
                                    <li>
                                        <i class="ti ti-arrow-narrow-right text-primary"></i>
                                        Kolom
                                        pertama
                                        adalah
                                        nama
                                        sekolah/universitas
                                    </li>
                                    <li>
                                        <i class="ti ti-arrow-narrow-right text-primary"></i>
                                        Kolom
                                        kedua
                                        adalah
                                        tahun
                                        lulus
                                        sesuai
                                        ijazah
                                    </li>
                                    <li>
                                        <i class="ti ti-arrow-narrow-right text-primary"></i>
                                        Kolom
                                        ketiga
                                        adalah
                                        upload
                                        dokumen
                                        Ijazah
                                        (PDF)
                                    </li>
                                    <li>
                                        <i class="ti ti-arrow-narrow-right text-primary"></i>
                                        Upload
                                        ulang
                                        dokumen
                                        untuk
                                        memperbarui
                                        ijazah
                                        baru
                                    </li>
                                </ul>
                            </div>
                            @foreach($pendidikanList as $key=>$label)
                            <div class="{{ $key!='s3' ? 'mb-3 border-bottom pb-3':'' }}">

                                <label class="fw-medium mb-1">{{ $label }}</label>

                                <div class="input-group mb-2">
                                    <input type="text"
                                        class="form-control sekolah"
                                        name="{{ $key }}"
                                        id="{{ $key }}"
                                        placeholder="Nama Sekolah / Universitas">

                                    <input type="number"
                                        class="form-control tahun"
                                        name="th_{{ $key }}"
                                        id="th_{{ $key }}"
                                        placeholder="Tahun Lulus">
                                </div>

                                <div class="input-group">

                                    <input type="file"
                                        class="form-control"
                                        accept="application/pdf"
                                        id="upload_{{ $key }}"
                                        name="upload_{{ $key }}">

                                    <label for="upload_{{ $key }}" class="btn btn-secondary-light" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Upload Dokumen">
                                        <i class="ri-upload-2-fill fs-6"></i>
                                    </label>

                                    <a href="#" target="_blank" id="download_{{ $key }}" class="btn btn-success-light d-none"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download Dokumen">
                                        <i class="ri-download-2-fill fs-6"></i>
                                    </a>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" onclick="ubahProfil()">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    let cleaveNoHp;
    $(document).ready(function() {

        // PREVIEW FOTO UPLOAD
        $('#foto_ubah').on('change', function(e){

            const file = e.target.files[0];

            if(!file) return;

            // validasi ukuran 3MB
            if(file.size > 3 * 1024 * 1024){
                Swal.fire({title: 'Ahh Maaf!!', text: 'Ukuran maksimal Foto yg bisa diupload adalah 3 Mb', icon: 'info', timer: 5000, timerProgressBar: true});
                $(this).val('');
                return;
            }

            // if(!file.type.match('image.*')){
            //     Swal.fire({title: 'Ahh Maaf!!', text: 'File yang diupload wajib berupa File Foto (Semua Ekstensi)', icon: 'info', timer: 5000, timerProgressBar: true});
            //     $(this).val('');
            //     return;
            // }

            const allowedTypes = ['image/jpeg', 'image/png'];

            if(!allowedTypes.includes(file.type)){
                Swal.fire({
                    title: 'Ahh Maaf!!',
                    text: 'File yang diupload wajib JPG atau PNG',
                    icon: 'info',
                    timer: 5000,
                    timerProgressBar: true
                });
                $(this).val('');
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e){
                $('#previewFoto').attr('src', e.target.result);
            }

            reader.readAsDataURL(file);

            $('#btnHapusFoto,#btnUploadFoto').prop('disabled',false);
        });

        $('.sekolah').on('input',function(){

            let id = $(this).attr('id');

            if($(this).val().trim() === ''){
                $('#th_'+id).val('').prop('disabled',true);
            }else{
                $('#th_'+id).prop('disabled',false);
            }
        });

        $('#cek_dom').on('change', function(){

            if($(this).is(':checked')){

                $('#input_dom').removeAttr('hidden');

                $('#dom_provinsi_ubah, #dom_kabupaten_ubah, #dom_kecamatan_ubah, #dom_kelurahan_ubah, #alamat_dom_ubah')
                    .attr('required',true);

                // copy KTP ke Domisili
                $('#dom_provinsi_ubah').val($('#ktp_provinsi_ubah').val()).trigger('change');
                $('#dom_kabupaten_ubah').empty().append(`<option value="">-- Pilih Kabupaten --</option>`);
                $('#dom_kecamatan_ubah').empty().append(`<option value="">-- Pilih Kecamatan --</option>`);
                $('#dom_kelurahan_ubah').empty().append(`<option value="">-- Pilih Kelurahan --</option>`);
                // $('#dom_kabupaten_ubah').val($('#ktp_kabupaten_ubah').val()).trigger('change');
                // $('#dom_kecamatan_ubah').val($('#ktp_kecamatan_ubah').val()).trigger('change');
                // $('#dom_kelurahan_ubah').val($('#ktp_kelurahan_ubah').val()).trigger('change');
                $('#alamat_dom_ubah').val($('#alamat_ktp_ubah').val()).prop('disabled',false);

            }else{

                $('#input_dom').attr('hidden',true);

                $('#dom_provinsi_ubah, #dom_kabupaten_ubah, #dom_kecamatan_ubah, #dom_kelurahan_ubah, #alamat_dom_ubah')
                    .removeAttr('required')
                    .prop('disabled',true)
                    .val('');

            }

        });

        // INPUT SELECT KTP
        $('#ktp_provinsi_ubah').change(function(){

            $.get('/api/v4/provinsi/'+this.value,function(res){

                $('#ktp_kabupaten_ubah').empty().prop('disabled',false).append('<option value="">-- Pilih Kabupaten --</option>');
                $('#ktp_kecamatan_ubah').empty().prop('disabled',true).append(`<option value="">-- Pilih Kecamatan --</option>`);
                $('#ktp_kelurahan_ubah').empty().prop('disabled',true).append(`<option value="">-- Pilih Kelurahan --</option>`);

                res.forEach(v=>{
                    $('#ktp_kabupaten_ubah').append(`<option value="${v.nama_kabkota}">${v.nama_kabkota}</option>`);
                });

            });

        });

        $('#ktp_kabupaten_ubah').change(function(){

            $.get('/api/v4/kota/'+this.value,function(res){

                $('#ktp_kecamatan_ubah').empty().prop('disabled',false).append('<option value="">-- Pilih Kecamatan --</option>');
                $('#ktp_kelurahan_ubah').empty().prop('disabled',true).append(`<option value="">-- Pilih Kelurahan --</option>`);

                res.forEach(v=>{
                    $('#ktp_kecamatan_ubah').append(`<option value="${v.kecamatan}">${v.kecamatan}</option>`);
                });

            });

        });

        $('#ktp_kecamatan_ubah').change(function(){

            $.get('/api/v4/kecamatan/'+this.value,function(res){

                $('#ktp_kelurahan_ubah').empty().prop('disabled',false).append('<option value="">-- Pilih Kelurahan --</option>');

                res.forEach(v=>{
                    $('#ktp_kelurahan_ubah').append(`<option value="${v.desa}">${v.desa}</option>`);
                });

            });

        });

        // INPUT SELECT DOMISILI
        $('#dom_provinsi_ubah').change(function(){

            $.get('/api/v4/provinsi/'+this.value,function(res){

                $('#dom_kabupaten_ubah').empty().prop('disabled',false).append('<option value="">-- Pilih Kabupaten --</option>');
                $('#dom_kecamatan_ubah').empty().prop('disabled',true).append(`<option value="">-- Pilih Kecamatan --</option>`);
                $('#dom_kelurahan_ubah').empty().prop('disabled',true).append(`<option value="">-- Pilih Kelurahan --</option>`);

                res.forEach(v=>{
                    $('#dom_kabupaten_ubah').append(`<option value="${v.nama_kabkota}">${v.nama_kabkota}</option>`);
                });

            });

        });

        $('#dom_kabupaten_ubah').change(function(){

            $.get('/api/v4/kota/'+this.value,function(res){

                $('#dom_kecamatan_ubah').empty().prop('disabled',false).append('<option value="">-- Pilih Kecamatan --</option>');
                $('#dom_kelurahan_ubah').empty().prop('disabled',true).append(`<option value="">-- Pilih Kelurahan --</option>`);

                res.forEach(v=>{
                    $('#dom_kecamatan_ubah').append(`<option value="${v.kecamatan}">${v.kecamatan}</option>`);
                });

            });

        });

        $('#dom_kecamatan_ubah').change(function(){

            $.get('/api/v4/kecamatan/'+this.value,function(res){

                $('#dom_kelurahan_ubah').empty().prop('disabled',false).append('<option value="">-- Pilih Kelurahan --</option>');

                res.forEach(v=>{
                    $('#dom_kelurahan_ubah').append(`<option value="${v.desa}">${v.desa}</option>`);
                });

            });

        });

        $(document).on('input change', '.sekolah, .tahun, [id^="upload_"]', function(){
            syncPendidikanRequired();
        });

        // expose ke global biar bisa dipanggil saat submit
        window.syncPendidikanRequired = syncPendidikanRequired;
    });

    function syncPendidikanRequired() {

        $('[id^="upload_"]').each(function(){

            let key = this.id.replace('upload_','');

            let sekolah = $('#' + key);
            let tahun   = $('#th_' + key);
            let upload  = $('#upload_' + key);

            let filled =
                sekolah.val() ||
                tahun.val() ||
                upload[0].files.length > 0;

            if(filled){

                // jadi wajib
                sekolah.prop('required', true);
                tahun.prop('required', true);
                // upload.prop('required', true);

                // invalid hanya jika kosong
                sekolah.toggleClass('is-invalid', !sekolah.val());
                tahun.toggleClass('is-invalid', !tahun.val());
                // upload.toggleClass('is-invalid', upload[0].files.length === 0);

            }else{

                // bebas semua
                sekolah.prop('required', false).removeClass('is-invalid');
                tahun.prop('required', false).removeClass('is-invalid');
                upload.prop('required', false).removeClass('is-invalid');

            }

        });
    }

    function generateNamaLengkap() {
        let gelarDepan = $('#gelar_depan_ubah').val().trim();
        let nama = $('#nama_ubah').val().trim();
        let gelarBelakang = $('#gelar_belakang_ubah').val().trim();

        // Format Gelar Depan
        if (gelarDepan !== '') {
            gelarDepan = gelarDepan.replace(/\.+$/, '') + '.';
        }

        // Format Gelar Belakang
        if (gelarBelakang !== '') {
            gelarBelakang = ', ' + gelarBelakang.replace(/^,?\s*/, '');
        }

        let fullNama =
            (gelarDepan ? gelarDepan + ' ' : '') +
            nama +
            (gelarBelakang ? gelarBelakang : '');

        $('#nama_lengkap_ubah').val(fullNama);
    }

    function loadUbah() {
        $.ajax({
            url: "/api/v4/profil/show",
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $('#avatarLoadingUbah').show();
                $('#previewFoto').addClass('loading');
            },
            success: function(res) {
                if (!res.status) {
                    Swal.fire('Info', res.message, 'info');
                    return;
                }

                // FOTO PROFIL
                    let fotoUrlUbah = '';
                    if(res.data.foto_user != null){
                        fotoUrlUbah = "{{ url('storage') }}/" + res.data.foto_user.filename.replace('public/','');
                        $('#btnHapusFoto').prop('disabled',false);
                    } else {
                        fotoUrlUbah = "{{ asset('images/no-image-person.png') }}";
                        $('#btnHapusFoto').prop('disabled',true);
                    }

                    $('#previewFoto').attr('src', fotoUrlUbah);

                // DATA SENSITIF
                    $('#nip_ubah').val(res.data.user.nip);
                    $('#nik_ubah').val(res.data.user.nik);
                    $('#email_ubah').val(res.data.user.email);
                    $('#pengalaman_kerja_ubah').val(res.data.user.pengalaman_kerja);

                    $('#nama_lengkap_ubah').val(res.data.user.nama_lengkap);
                    $('#gelar_depan_ubah').val(res.data.user.gelar_depan);
                    $('#nama_ubah').val(res.data.user.nama);
                    $('#gelar_belakang_ubah').val(res.data.user.gelar_belakang);
                    generateNamaLengkap(); // init FIRST
                    $('#gelar_depan_ubah, #nama_ubah, #gelar_belakang_ubah').on('input', function () {
                        generateNamaLengkap();
                    });

                    $('#nick_ubah').val(res.data.user.nick);

                    // NO. HANDPHONE
                    if (!cleaveNoHp) {
                        cleaveNoHp = new Cleave('#no_hp_ubah', { // INPUT MASK No.HP{
                            prefix: '62',
                            delimiter: '-',
                            noImmediatePrefix: false, // langsung tampil 62
                            blocks: [2, 3, 4, 5], // sesuaikan format
                            numericOnly: true
                        });
                    }
                    let noHp = res.data.user.no_hp;
                    if (noHp) {
                        // hapus semua selain angka dulu
                        noHp = noHp.replace(/\D/g, '');

                        if (noHp.startsWith('0')) {
                            noHp = '62' + noHp.substring(1);
                        }
                        else if (!noHp.startsWith('62')) {
                            noHp = '62' + noHp;
                        }
                    }
                    // $('#no_hp_ubah').val(noHp);
                    cleaveNoHp.setRawValue(noHp);
                    $('#no_hp_ubah').on('input', function() {
                        if (!this.value.startsWith('62')) {
                            this.value = '62';
                        }

                        let valHp = this.value;
                        let clean = valHp.replace(/\D/g, ''); // hapus selain angka
                        if (clean.length < 11) {
                            if (clean == '62') {
                                $(this).removeClass('is-valid is-invalid');
                            } else {
                                $(this).removeClass('is-valid').addClass('is-invalid');
                            }
                        } else {
                            $(this).removeClass('is-invalid').addClass('is-valid');
                        }
                    });

                    $('#jns_kelamin_ubah').val(res.data.user.jns_kelamin);
                    res.data?.kota?.forEach(v=>{
                        $('#temp_lahir_ubah').append(`<option value="${v.nama_kabkota}" ${v.nama_kabkota == res.data.user.temp_lahir?'selected':''}>${v.nama_kabkota}</option>`);
                    });
                    $('#tgl_lahir_ubah').val(res.data.user.tgl_lahir);
                    $('#status_kawin_ubah').val(res.data.user.status_kawin);
                    $('#rp_ubah').val(res.data.user.riwayat_penyakit);
                    $('#rpk_ubah').val(res.data.user.riwayat_penyakit_keluarga);
                    $('#ro_ubah').val(res.data.user.riwayat_operasi);
                    $('#rpo_ubah').val(res.data.user.riwayat_penggunaan_obat);

                    // DATA PENDIDIKAN
                    const pendidikan = [
                    'sd','smp','sma','d2','d3','d4','s1','s1_profesi','s2','s3'
                    ];
                    let hasFilledPendidikan = false;

                    pendidikan.forEach(function(p){
                        // nama sekolah
                        $('#'+p).val(res.data.user[p]);

                        // tahun
                        $('#th_'+p).val(res.data.user['th_'+p]);

                        // file
                        let file = res.data.user['filename_'+p];

                        if(file){
                            hasFilledPendidikan = true; // 🔥 ADA FILE

                            let url = "{{ url('storage') }}/"+file.replace('public/','');

                            $('#download_'+p)
                                .attr('href',url)
                                .removeClass('d-none');
                        }else{
                            $('#download_'+p).addClass('d-none');
                        }

                        // kalau sekolah ada isi → tandai
                        if(res.data.user[p] || res.data.user['th_'+p]){
                            hasFilledPendidikan = true;
                        }

                        // disable tahun kalau nama kosong
                        if(!res.data.user[p]){
                            $('#th_'+p).prop('disabled',true);
                        }

                    });

                    // 🔥 SETELAH LOOP SELESAI
                    if(hasFilledPendidikan){
                        syncPendidikanRequired();
                    }

                    $('#dom_kabupaten_ubah').empty().prop('disabled',false).append('<option value="">-- Pilih Kabupaten --</option>');
                    $('#dom_kecamatan_ubah').empty().prop('disabled',true).append(`<option value="">-- Pilih Kecamatan --</option>`);
                    $('#dom_kelurahan_ubah').empty().prop('disabled',true).append(`<option value="">-- Pilih Kelurahan --</option>`);
                    // $('#ktp_provinsi_ubah').val(res.data.user.ktp_provinsi);
                    if (res.data.user.ktp_kabupaten) {
                        $('#ktp_kabupaten_ubah').empty().append(`<option value="${res.data.user.ktp_kabupaten}">${res.data.user.ktp_kabupaten}</option>`);
                    } else {
                        $('#ktp_kabupaten_ubah').empty().append(`<option value="">-- Pilih Kabupaten --</option>`);
                    }

                    if (res.data.user.ktp_kecamatan) {
                        $('#ktp_kecamatan_ubah').empty().append(`<option value="${res.data.user.ktp_kecamatan}">${res.data.user.ktp_kecamatan}</option>`);
                    } else {
                        $('#ktp_kecamatan_ubah').empty().append(`<option value="">-- Pilih Kecamatan --</option>`);
                    }

                    if (res.data.user.ktp_kelurahan) {
                        $('#ktp_kelurahan_ubah').empty().append(`<option value="${res.data.user.ktp_kelurahan}">${res.data.user.ktp_kelurahan}</option>`);
                    } else {
                        $('#ktp_kelurahan_ubah').empty().append(`<option value="">-- Pilih Kelurahan --</option>`);
                    }

                    if (res.data.user.alamat_ktp) {
                        $('#alamat_ktp_ubah').val(res.data.user.alamat_ktp);
                    }

                    if (res.data.user.alamat_dom) {
                        $('#input_dom').removeAttr('hidden');

                        $('#dom_provinsi_ubah, #dom_kabupaten_ubah, #dom_kecamatan_ubah, #dom_kelurahan_ubah, #alamat_dom_ubah')
                            .attr('required',true);
                        // $('#dom_provinsi_ubah').val(res.data.user.dom_provinsi);
                        $('#dom_kabupaten_ubah').empty().append(`<option value="${res.data.user.dom_kabupaten}">${res.data.user.dom_kabupaten}</option>`);
                        $('#dom_kecamatan_ubah').empty().append(`<option value="${res.data.user.dom_kecamatan}">${res.data.user.dom_kecamatan}</option>`);
                        $('#dom_kelurahan_ubah').empty().append(`<option value="${res.data.user.dom_kelurahan}">${res.data.user.dom_kelurahan}</option>`);
                        $('#alamat_dom_ubah').val(res.data.user.alamat_dom);
                    } else {
                        $('#input_dom').attr('hidden',true);

                        $('#dom_provinsi_ubah, #dom_kabupaten_ubah, #dom_kecamatan_ubah, #dom_kelurahan_ubah, #alamat_dom_ubah')
                            .removeAttr('required')
                            .val('');
                    }
                    $('#fb_ubah').val(res.data.user.fb);
                    $('#ig_ubah').val(res.data.user.ig);
                    $('#tt_ubah').val(res.data.user.tt);
                    // $('#_ubah').val();
                    // $('#_ubah').val();

                // PUSH PROVINSI
                    res.data?.provinsi?.forEach(v=>{
                        $('#ktp_provinsi_ubah').append(`<option value="${v.provinsi}" ${v.provinsi == res.data.user.ktp_provinsi?'selected':''}>${v.provinsi}</option>`);
                        $('#dom_provinsi_ubah').append(`<option value="${v.provinsi}" ${v.provinsi == res.data.user.dom_provinsi?'selected':''}>${v.provinsi}</option>`);
                    });
            },
            error: function(xhr) {
                Swal.fire('Gagal', xhr.responseJSON?.message ?? 'Terjadi kesalahan', 'error');
            },
            complete: function() {
                $('#avatarLoadingUbah').hide();
                $('#previewFoto').removeClass('loading');
            }
        })

        let form = document.getElementById('formProfil');

        // hapus bootstrap validation state
        form.classList.remove('was-validated');

        // bersihkan invalid class manual
        $('#formProfil')
            .find('.is-invalid')
            .removeClass('is-invalid');

        // reset native validity
        form.querySelectorAll('input,select,textarea').forEach(el=>{
            el.setCustomValidity('');
        });
    }

    function ubahProfil() {

        let form = document.getElementById('formProfil');
        let btn = $('#btn-simpan');

        syncPendidikanRequired();

        // matikan skip-submit dulu
        $('.skip-submit').each(function(){
            $(this).data('req', this.required);
            this.required = false;
        });

        if (!form.checkValidity()) {

            // restore required
            $('.skip-submit').each(function(){
                this.required = $(this).data('req');
            });

            form.classList.add('was-validated');

            // cari input pertama yang invalid
            let invalid = $('#formProfil').find(':invalid').first();

            // ambil label terdekat
            let label = invalid.closest('div').find('label').clone();

            // buang tanda *
            label.find('span').remove();

            let labelText = label.text().trim();

            Swal.fire({
                title: 'Ahh Maaf!!',
                text: labelText + ' wajib diisi',
                icon: 'info',
                timer: 5000,
                timerProgressBar: true
            });

            invalid.focus();
            return;
        }
        // restore required kalau lolos
        $('.skip-submit').each(function(){
            this.required = $(this).data('req');
        });

        let noHpInput = $('#no_hp_ubah');
        let noHpClean = noHpInput.val().replace(/\D/g, '');
        if (noHpClean.length < 11) {
            noHpInput.removeClass('is-valid').addClass('is-invalid');
            noHpInput.focus();
            return;
        } else {
            noHpInput.removeClass('is-invalid').addClass('is-valid');
        }

        // mulai simpan data
        let formData = new FormData();

        $('#formProfil').find('input, select, textarea').each(function(){

            let id = $(this).attr('id');
            if(!id) return;

            // ===== SKIP SUBMIT PROFIL =====
            if($(this).hasClass('skip-submit')) return;

            // ===== HAPUS _ubah =====
            let field = id.replace('_ubah','');

            if(this.type === 'file'){
                if(this.files[0]){
                    formData.append(field,this.files[0]);
                }
            }
            else if(this.type === 'checkbox'){
                formData.append(field, this.checked ? 1 : 0);
            }
            else{
                formData.append(field, $(this).val());
            }

        });

        $.ajax({
            url:'/api/v4/profil/ubah',
            type:'POST',
            data:formData,
            processData:false,
            contentType:false,
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend:function(){
                btn.prop('disabled',true)
                    .find('i')
                    .removeClass('fa-save')
                    .addClass('fa-spinner fa-sync');
            },
            success:function(res){
                if(!res.status){
                    Swal.fire('Info', res.message, 'info');
                    return;
                }
                Swal.fire({title: 'Yeayy!', text: res.message, icon: 'success', timer: 5000, timerProgressBar: true});
                $('#formProfil').removeClass('was-validated')[0].reset();
                $('#no_hp_ubah').removeClass('is-valid is-invalid');
                loadUbah();
            },
            error:function(xhr){
                Swal.fire('Gagal',xhr.responseJSON?.message ?? 'Terjadi kesalahan','error');
            },
            complete:function(){
                btn.prop('disabled',false)
                    .find('i')
                    .removeClass('fa-spinner fa-sync')
                    .addClass('fa-save');
            }
        });
    }

    function ubahFotoProfil() {

        let file = $('#foto_ubah')[0].files[0];
        let btn = $('#btnUploadFoto');

        if(!file){
            Swal.fire({title: 'Info!', text: 'Silakan pilih / masukkan foto terlebih dahulu', icon: 'info', timer: 5000, timerProgressBar: true});
            return;
        }

        let formData = new FormData();
        formData.append('file', file);

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/api/v4/profil/foto/ubah",
            type: 'POST',
            processData:false,
            contentType:false,
            data: formData,
            dataType: 'json',
            beforeSend: function () {
                $('#avatarLoadingUbah').show();
                $('#previewFoto').addClass('loading');
                btn.prop('disabled', true);
            },
            success: function(res) {
                if(!res.status){
                    Swal.fire('Info', res.message, 'info');
                    btn.prop('disabled', false);
                    return;
                }

                Swal.fire({
                    title:'Berhasil',
                    text:res.message,
                    icon:'success',
                    timer:2000,
                    showConfirmButton:false
                });

                loadDataDiri();

                $('#foto_ubah').val('');
                $('.profile-img').attr('src', "{{ url('storage') }}/" + res.path.replace('public/',''));
                $('#btnUploadFoto').prop('disabled',true);
                $('#btnHapusFoto').prop('disabled',false);
            },
            error: function(xhr) {
                Swal.fire('Gagal', xhr.responseJSON?.message ?? 'Terjadi kesalahan', 'error');
            },
            complete: function() {
                $('#avatarLoadingUbah').hide();
                $('#previewFoto').removeClass('loading');
                btn.prop('disabled', false);
            }
        })
    }

    function confirmHapusFotoProfil() {
        Swal.fire({
            title: 'Hapus foto profil?',
            text: 'Menghapus foto profil akan mengembalikan foto ke bentuk Default dari Sistem',
            icon: 'warning',
            showCancelButton: true,
            showDenyButton: false,
            confirmButtonText: 'Hapus Foto Profil',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if(result.isConfirmed){
                hapusFotoProfil();
            }
        });
    }

    function hapusFotoProfil() {

        let btn = $('#btnHapusFoto');

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `/api/v4/profil/foto/hapus`,
            type: 'DELETE',
            dataType: 'json',
            beforeSend: function () {
                $('#avatarLoadingUbah').show();
                $('#previewFoto').addClass('loading');
                btn.prop('disabled', true);
            },
            success: function(res) {
                if(!res.status){
                    Swal.fire('Info', res.message, 'info');
                    btn.prop('disabled', false);
                    return;
                }

                Swal.fire({
                    title:'Berhasil',
                    text:res.message,
                    icon:'success',
                    timer:2000,
                    showConfirmButton:false
                });

                loadDataDiri();

                $('#foto_ubah').val('');
                $('.profile-img').attr('src', res.path);
                $('#previewFoto').removeClass('loading');
                $('#previewFoto').attr('src', res.path);
            },
            error: function(xhr) {
                Swal.fire('Gagal', xhr.responseJSON?.message ?? 'Terjadi kesalahan', 'error');
            },
            complete: function() {
                $('#avatarLoadingUbah').hide();
                $('#previewFoto').removeClass('loading');
                $('#btnUploadFoto').prop('disabled',false);
                $('#btnHapusFoto').prop('disabled',true);
            }
        })
    }
</script>
