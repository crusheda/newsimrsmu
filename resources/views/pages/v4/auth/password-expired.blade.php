@extends('layouts.v4-auth')

@section('content')
    <div class="row authentication authentication-cover-main mx-0">
        <div class="col-xxl-9 col-xl-9">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xxl-7 col-xl-7 col-lg-8 col-md-8 col-sm-10 col-12">
                    <div class="card custom-card border-0 shadow-none my-4">
                        <div class="card-body p-5">

                            {{-- Logo --}}
                            <div class="mb-4 text-center">
                                <img src="{{ asset('images/logo/logo_full_text_light.png') }}" {{-- brand-logos/toggle-logo.png --}}
                                    alt="logo" class="mx-auto d-block mb-2 desktop-logo" style="height: 50px;" />
                                <img src="{{ asset('images/logo/logo_full_text_dark.png') }}" {{-- brand-logos/toggle-logo.png --}}
                                    alt="logo" class="mx-auto d-block mb-2 desktop-dark" style="height: 50px;" />
                            </div>

                            @if ($user->last_update_password)
                                <div class="col-xl-12 mb-3">
                                    <div class="alert svg-primary alert-primary alert-dismissible fade show custom-alert-icon shadow-sm" role="alert">
                                        {{-- <svg
                                            xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                            </path>
                                        </svg> --}}
                                        Terakhir Perubahan Password : {{ \Carbon\Carbon::parse($user->last_update_password)->diffForHumans() }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button>
                                    </div>
                                </div>
                            @endif

                            <div class="col-xl-12 mb-3">
                                <div class="alert alert-danger border border-danger mb-0 p-2">
                                    <div class="d-flex align-items-start">
                                        <div class="me-2 svg-danger">
                                            <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                                                enable-background="new 0 0 24 24" height="1.5rem" viewBox="0 0 24 24"
                                                width="1.5rem" fill="#000000">
                                                <g>
                                                    <rect fill="none" height="24" width="24"></rect>
                                                </g>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="M15.73,3H8.27L3,8.27v7.46L8.27,21h7.46L21,15.73V8.27L15.73,3z M19,14.9L14.9,19H9.1L5,14.9V9.1L9.1,5h5.8L19,9.1V14.9z">
                                                            </path>
                                                            <rect height="6" width="2" x="11" y="7"></rect>
                                                            <rect height="2" width="2" x="11" y="15"></rect>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="text-danger w-100">
                                            <div class="fs-16 fw-medium d-flex justify-content-between">Pencegahan Risiko !!
                                                {{-- <button type="button" class="btn-close p-0" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button> --}}
                                            </div>
                                            <div class="fs-12 op-8 mt-1 text-justify">
                                                <ol class="mb-1 ps-3 pe-2">
                                                    <li>
                                                        Password memiliki masa berlaku selama <strong>90 hari</strong> sebagai bagian dari kebijakan keamanan sistem.
                                                    </li>

                                                    <li>
                                                        Setelah melewati masa berlaku, pengguna <strong>wajib memperbarui password</strong> sebelum dapat melanjutkan penggunaan aplikasi.
                                                    </li>

                                                    <li>
                                                        Gunakan password yang kuat dengan kombinasi <strong>huruf besar, huruf kecil, angka, dan simbol</strong>.
                                                    </li>

                                                    <li>
                                                        Hindari menggunakan password yang sama dengan akun lain atau password sebelumnya.
                                                    </li>

                                                    <li>
                                                        Jangan membagikan password kepada siapapun untuk menjaga keamanan dan kerahasiaan data pasien.
                                                    </li>

                                                    <li>
                                                        Perubahan password secara berkala membantu melindungi akun dari akses yang tidak sah.
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- FORM LOGIN --}}
                            <form id="formExpiredPassword" class="row gy-3">
                                @csrf

                                @if (session('error'))
                                    <div class="col-xl-12 mb-2">
                                        <div class="alert alert-warning alert-dismissible fade show shadow-sm">
                                            <i class="ri-error-warning-line me-2"></i>
                                            {{ session('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert">
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                {{-- PASSWORD --}}
                                <div class="col-xl-12 mb-2">
                                    <label class="form-label text-default">
                                        Buat Password Baru
                                    </label>

                                    <div class="position-relative">
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Masukkan Password Baru" required>
                                        <button type="button"
                                            class="show-password-button text-muted position-absolute end-0 top-0 h-100 border-0 bg-transparent"
                                            onclick="togglePassword('password',this)">
                                            <i class="ri-eye-line"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- KONFIRMASI --}}
                                <div class="col-xl-12 mb-1">
                                    <label class="form-label text-default">
                                        Konfirmasi Password Baru
                                    </label>
                                    <div class="position-relative">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control" placeholder="Konfirmasi Password" required>
                                        <button type="button"
                                            class="show-password-button text-muted position-absolute end-0 top-0 h-100 border-0 bg-transparent"
                                            onclick="togglePassword('password_confirmation',this)">
                                            <i class="ri-eye-line"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- RULE PASSWORD --}}
                                <div class="col-xl-12 mb-2">
                                    <h6 class="fs-13 mb-3 text-warning">Persyaratan Pembuatan Password :</h6>
                                    <div class="fs-12">
                                        <div id="req-length" class="text-danger mb-2">
                                            <i class="ri-checkbox-circle-line"></i>
                                            Minimal 8 karakter
                                        </div>
                                        <div id="req-uppercase" class="text-danger mb-2">
                                            <i class="ri-checkbox-circle-line"></i>
                                            Mengandung huruf besar
                                        </div>
                                        <div id="req-number" class="text-danger mb-2">
                                            <i class="ri-checkbox-circle-line"></i>
                                            Mengandung angka
                                        </div>
                                        <div id="req-special" class="text-danger mb-2">
                                            <i class="ri-checkbox-circle-line"></i>
                                            Mengandung simbol (!@#$%^&*)
                                        </div>
                                    </div>
                                </div>

                                {{-- BUTTON --}}
                                <div class="col-xl-12">
                                    <div class="btn-group w-100">
                                        <button type="button" class="btn btn-secondary-transparent"
                                            onclick="event.preventDefault(); document.getElementById('logoutform').submit();" style="flex:1;">
                                            <i class="ri-arrow-left-s-line me-1"></i>
                                            Logout
                                        </button>
                                        <button type="submit" id="btnReset" class="btn btn-danger" style="flex:3;" disabled>
                                            <i class="ri-login-box-line fs-16 me-1"></i>
                                            <span id="btnText">
                                                Perbarui Password
                                            </span>
                                        </button>
                                    </div>
                                </div>

                                {{-- OR --}}
                                <div class="col-xl-12 text-center my-3 authentication-barrier">
                                    <span class="op-4 fs-13">OR</span>
                                </div>

                                {{-- Register --}}
                                <div class="col-xl-12 text-center fw-medium mt-0">
                                    Lupa Password Akun?
                                    <a role="button" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline fw-medium" href="{{ route('v4.password.request') }}">
                                        Reset Password
                                    </a>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-12 d-xl-block d-none px-0">
            <div class="authentication-cover overflow-hidden">
                <div class="authentication-cover-logo">
                    <a href="{{ route('v4.portal') }}">
                        <img src="{{ asset('images/brand-logos/toggle-logo.png') }}" alt="logo" style="height: 40px"
                            class="toggle-logo">
                        <img src="{{ asset('images/brand-logos/toggle-dark.png') }}" alt="logo" style="height: 40px"
                            class="toggle-dark">
                    </a>
                </div>
                <div class="authentication-cover-background">
                    <img src="{{ asset('images/media/backgrounds/9.png') }}" alt="">
                </div>
                <div class="authentication-cover-content">
                    <div class="p-5">
                        <h3 class="fw-semibold lh-base">
                            Pembaruan Password Diperlukan
                        </h3>

                        <p class="mb-0 text-muted fw-medium">
                            Demi menjaga keamanan akun dan melindungi kerahasiaan data,
                            password Anda telah melewati masa berlaku 90 hari.
                            Silakan lakukan pembaruan password sebelum melanjutkan penggunaan sistem.
                        </p>
                    </div>
                    <div>
                        <img src="{{ asset('images/media/media-72.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let loadingReset = false;

        function toggleReq(id, status) {
            if (status) {
                $(id)
                    .removeClass('text-danger')
                    .addClass('text-success');
            } else {
                $(id)
                    .removeClass('text-success')
                    .addClass('text-danger');
            }
        }

        function validateResetPassword() {
            let password = $('#password').val();
            let confirm = $('#password_confirmation').val();
            let length = password.length >= 8;
            let uppercase = /[A-Z]/.test(password);
            let number = /[0-9]/.test(password);
            let special = /[!@#$%^&*]/.test(password);

            toggleReq('#req-length', length);
            toggleReq('#req-uppercase', uppercase);
            toggleReq('#req-number', number);
            toggleReq('#req-special', special);

            let valid =
                length &&
                uppercase &&
                number &&
                special &&
                password === confirm;

            $('#password_confirmation')
                .removeClass('is-valid is-invalid');

            if (confirm.length) {
                if (password === confirm) {
                    $('#password_confirmation')
                        .addClass('is-valid');
                } else {
                    $('#password_confirmation')
                        .addClass('is-invalid');
                }
            }

            $('#btnReset')
                .prop('disabled', !valid);
        }

        function togglePassword(id, btn) {
            let input = document.getElementById(id);
            let icon = btn.querySelector('i');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('ri-eye-line');
                icon.classList.add('ri-eye-off-line');
            } else {
                input.type = "password";
                icon.classList.remove('ri-eye-off-line');
                icon.classList.add('ri-eye-line');
            }
        }

        $('#password,#password_confirmation')
            .on('input', function() {
                validateResetPassword();
            });

        $('#formExpiredPassword')
            .submit(function(e) {
                e.preventDefault();
                if (loadingReset)
                    return;
                loadingReset = true;
                let btn = $('#btnReset');
                $.ajax({
                    url: "{{ route('v4.password.updatePassword') }}",
                    method: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        btn.prop('disabled', true);
                        $('#btnText')
                            .html('Memproses...');
                    },
                    success: function(res) {
                        Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: res.message ??
                                    'Password berhasil diperbarui',
                                timer: 2500,
                                showConfirmButton: false
                            })
                            .then(() => {
                                window.location.href =
                                    "{{ route('v4.dashboard') }}";
                            });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Informasi',
                            text: xhr.responseJSON?.message ??
                                'Terjadi kesalahan'
                        });
                    },
                    complete: function() {
                        loadingReset = false;
                        btn.prop('disabled', false);
                        $('#btnText')
                            .html('Ubah Password');
                        validateResetPassword();
                    }
                });
            });

        setTimeout(() => {
            Swal.fire({
                icon: 'warning',
                title: 'Sesi akan dihentikan',
                text: 'Silakan perbarui password Anda',
                allowOutsideClick: false
            });
        }, 300000);

        validateResetPassword();
    </script>
@endsection
