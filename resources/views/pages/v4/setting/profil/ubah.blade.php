
<div class="card custom-card">
    <div class="card-header fw-bold justify-content-between">
        <div>
            Ubah
            <b class="text-primary">
                Profil Saya
            </b>
        </div>
        <div>
            (
            <span class="text-danger">
                *
            </span>
            ) Wajib Diisi
        </div>
    </div>
    <div class="card-body">
        <form onSubmit={handleSubmitUbahProfil} class="g-3 needs-validation" noValidate>
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-5">
                            <label class="form-label fw-bold">
                                Foto Profil
                            </label>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex flex-column gap-2">
                                        <div class="d-flex align-items-center gap-3 flex-wrap">
                                            <span class="avatar avatar-xxl">
                                                <img src="" alt="Foto Profil" />
                                            </span>

                                            <div class="d-flex flex-column">
                                                <div
                                                    class="d-flex align-items-center gap-2 flex-wrap">
                                                    <input type="file" accept="image/*"
                                                        class="form-control form-control-sm"
                                                        style="width: auto" />

                                                    <button type="button"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ri-upload-2-line me-1"></i>
                                                        Ganti
                                                    </button>

                                                    <button type="button"
                                                        class="btn btn-sm btn-light">
                                                        <i class="ri-delete-bin-line me-1"></i>
                                                        Hapus
                                                    </button>
                                                </div>
                                                <span class="d-block fs-12 text-muted mt-1">
                                                    Ekstensi
                                                    JPG
                                                    /
                                                    PNG.
                                                    Ukuran
                                                    ideal
                                                    200x200
                                                    pixels.
                                                    Maksimal
                                                    3MB.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <label htmlFor="pengalaman_kerja" class="form-label fw-bold">
                                Data Sensitif
                            </label>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3 mb-3">
                                            <label class="block font-medium mb-1">
                                                Nomor
                                                Induk
                                                Pegawai
                                                (NIP)
                                            </label>
                                            <input type="text" name="nip" readOnly
                                                class="w-full form-control p-2 bg-light"
                                                placeholder="(otomatis terisi)" />
                                        </div>
                                        <div class="col-sm-5 mb-3">
                                            <label class="block font-medium mb-1">
                                                Nomor
                                                Induk
                                                Kependudukan
                                                (NIK)
                                                <span class="text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <input type="text" name="nik"
                                                class="w-full form-control p-2" />
                                        </div>

                                        <div class="col-sm-4 mb-3">
                                            <label class="block font-medium mb-1">
                                                Email
                                                Aktif
                                                <span class="text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <input type="email" name="email"
                                                class="w-full form-control p-2" />
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
                    <textarea id="pengalaman_kerja" name="pengalaman_kerja" rows="5" class="form-control mb-3"
                        placeholder="e.g. Saya pernah bekerja pada suatu instansi swasta ternama bertempat di Kota X dan berprofesi sebagai X..."></textarea>

                    <label htmlFor="pengalaman_kerja" class="form-label fw-bold">
                        Data Identitas
                    </label>
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="block font-medium mb-1">
                                        Gelar
                                        Depan
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input type="text" name="gelar_depan"
                                        class="w-full form-control p-2" placeholder="dr." />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="block font-medium mb-1">
                                        Nama
                                        Lengkap
                                        (Tanpa
                                        Gelar)
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input type="text" name="nama"
                                        class="w-full form-control p-2"
                                        placeholder="Mayor Sunaryo Tiga Tujuh" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="block font-medium mb-1">
                                        Gelar
                                        Belakang
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input type="text" name="gelar_belakang"
                                        class="w-full form-control p-2"
                                        placeholder="Sp.x.FinaCS" />
                                </div>

                                <div class="col-sm-5 mb-3">
                                    <label class="block font-medium mb-1">
                                        Nama
                                        Panggilan
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input type="text" name="nick"
                                        class="w-full form-control p-2" />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="block font-medium mb-1">
                                        No. HP
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input type="text" name="no_hp"
                                        class="w-full form-control p-2" placeholder="628xxx" />
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="block font-medium mb-1">
                                        Jenis
                                        Kelamin
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select name="jns_kelamin" class="w-full form-control p-2">
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
                                        Tempat
                                        Lahir
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select id="temp_lahir" name="temp_lahir"
                                        class="form-control" required>
                                        <option value="">
                                            --
                                            Pilih
                                            Kota
                                            --
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="block font-medium mb-1">
                                        Tanggal
                                        Lahir
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input type="date" name="tgl_lahir"
                                        class="w-full form-control p-2" />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="block font-medium mb-1">
                                        Status
                                        Perkawinan
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select name="status_kawin" class="w-full form-control p-2">
                                        <option value="">
                                            --
                                            Pilih
                                            --
                                        </option>
                                        <option value="BELUM">
                                            Belum
                                            Kawin
                                        </option>
                                        <option value="SUDAH">
                                            Sudah
                                            Kawin
                                        </option>
                                        <option value="CERAI">
                                            Cerai
                                        </option>
                                        <option value="RAHASIA">
                                            Tidak
                                            ingin
                                            memberi
                                            tahu
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
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        id="checkbox_alamat" name="cek_dom" />
                                    <label class="form-check-label" htmlFor="checkbox_alamat">
                                        <u>
                                            <b>
                                                Alamat
                                                Domisili
                                                sama
                                                dengan
                                                KTP
                                            </b>
                                        </u>
                                    </label>
                                </div>
                                <small>
                                    Hilangkan
                                    centang
                                    untuk
                                    menampilkan
                                    Pilihan
                                    Domisili
                                </small>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="block mb-1">
                                        Provinsi
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select name="ktp_provinsi" class="w-full form-control p-2"
                                        required>
                                        <option value="">
                                            --
                                            Pilih
                                            Provinsi
                                            --
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="block mb-1">
                                        Kabupaten
                                        / Kota
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select name="ktp_kabupaten" required
                                        class="w-full form-control p-2">
                                        <option value="">
                                            --
                                            Pilih
                                            Kabupaten
                                            --
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="block mb-1">
                                        Kecamatan
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select name="ktp_kecamatan" class="w-full form-control p-2"
                                        required>
                                        <option value="">
                                            --
                                            Pilih
                                            Kecamatan
                                            --
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="block mb-1">
                                        Kelurahan
                                        / Desa
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select name="ktp_kelurahan" class="w-full form-control p-2"
                                        required>
                                        <option value="">
                                            --
                                            Pilih
                                            Kelurahan
                                            --
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label class="block mb-1">
                                        Alamat
                                        Lengkap
                                        (KTP)
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <textarea name="alamat_ktp" rows="2" class="w-full form-control p-2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <label class="form-label fw-bold">
                        Alamat Domisili
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
                                    <select name="dom_provinsi" class="form-control">
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
                                    <select name="dom_kabupaten" class="form-control">
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
                                    <select name="dom_kecamatan" class="form-control">
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
                                    <select name="dom_kelurahan" class="form-control">
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
                                        Lengkap
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <textarea class="form-control" name="alamat_dom" rows="4" placeholder="Tuliskan alamat lengkap domisili Anda"></textarea>
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
                                    <input type="text" name="fb" placeholder="Facebook"
                                        class="form-control" />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="block font-medium mb-1">
                                        <i class="ri-instagram-fill fs-6 me-1"></i>
                                        Instagram
                                    </label>
                                    <input type="text" name="ig" placeholder="Instagram"
                                        class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="block font-medium mb-1">
                                        <i class="ri-tiktok-fill fs-6 me-1"></i>
                                        Tiktok
                                    </label>
                                    <input type="text" name="tt" placeholder="Tiktok"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-loader">
                            <span class="me-2">
                                Simpan
                                Perubahan
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>