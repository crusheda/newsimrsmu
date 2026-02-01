<div class="card custom-card">
    <div class="card-header fw-bold justify-content-between">
        <div>
            Ubah
            <b class="text-danger">
                Password
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
    <form class="needs-validation" noValidate onSubmit={handleSubmitPassword}
        encType="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <div class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm"
                        role="alert">
                        <h6 class="alert-heading fw-bold mb-3">
                            Keamanan Password
                        </h6>
                        <ul>
                            <li class="mb-2">
                                Jangan berikan
                                <strong class="text-danger fw-bold">
                                    Password
                                </strong>
                                anda kepada
                                orang lain
                            </li>
                            <li class="mb-2">
                                Password akan
                                diproses melalui
                                metode
                                <i class="text-dark fw-bold">
                                    Bcrypt Hash
                                    Password
                                </i>
                                oleh sistem
                            </li>
                            <li>
                                Apabila anda
                                lupa Password
                                akun Simrsmu,
                                silakan masuk ke
                                laman
                                <b class="text-danger fw-bold">
                                    Lupa
                                    Password
                                </b>
                                pada halaman
                                Login
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">
                            Password Lama
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <input type="password" class="form-control" id="oldPassword"
                            name="current_password" autoComplete="current-password"
                            placeholder="••••••••••" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Password Baru
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <input type="password" class="form-control" id="newPassword"
                            name="new_password" autoComplete="new_password"
                            placeholder="••••••••••" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Konfirmasi Password
                            Baru
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <input type="password" class="form-control" id="confirmPassword"
                            name="new_password_confirmation"
                            autoComplete="new_password_confirmation" placeholder="••••••••••"
                            required />
                        <small>
                            Tuliskan password
                            baru yang sama untuk
                            konfirmasi password
                            baru Anda
                        </small>
                    </div>
                </div>

                <div class="col-sm-6">
                    <h6>
                        Password Baru Anda harus
                        memenuhi kriteria
                        sebagai berikut :
                    </h6>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item requirements">
                            <i class="ti ti-circle-check f-16 me-2 text-danger"></i>
                            Melebihi 8 karakter
                        </li>
                        <li class="list-group-item requirements">
                            <i class="ti ti-circle-check f-16 me-2 text-danger"></i>
                            Minimal 1 Huruf
                            Kapital (A-Z)
                        </li>
                        <li class="list-group-item requirements">
                            <i class="ti ti-circle-check f-16 me-2 text-danger"></i>
                            Minimal 1 Angka
                            (0-9)
                        </li>
                        <li class="list-group-item requirements">
                            <i class="ti ti-circle-check f-16 me-2 text-danger"></i>
                            Minimal 1 Karakter
                            Khusus (!@#$%^&*)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer btn-page">
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <div class="fs-semibold fs-14">
                    <p class="card-text align-middle">
                        <small>
                            Terakhir password
                            diperbarui :
                        </small>
                        <br />
                        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-decoration-underline"
                            role="button">-
                        </a>
                    </p>
                </div>
                <button class="btn btn-secondary" type="submit" id="btn-submit-password"
                    disabled={!isPasswordValid}>
                    <i class="ri-rocket-2-line me-1"></i>
                    Perbarui
                </button>
            </div>
        </div>
    </form>
</div>