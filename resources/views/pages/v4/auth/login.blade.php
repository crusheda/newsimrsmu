@extends('layouts.v4-auth')

@section('content')

    <div class="row authentication authentication-cover-main mx-0">
        <div class="col-xxl-9 col-xl-9">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-6 col-sm-8 col-12">
                    <div class="card custom-card border-0 shadow-none my-4">
                        <div class="card-body p-5">

                            {{-- Logo --}}
                            <div class="mb-4 text-center">
                                <img
                                    src="{{ asset('images/logo/logo_full_text_light.png') }}" {{-- brand-logos/toggle-logo.png --}}
                                    alt="logo"
                                    class="mx-auto d-block mb-2 desktop-logo"
                                    style="height: 50px;"
                                />
                                <img
                                    src="{{ asset('images/logo/logo_full_text_dark.png') }}" {{-- brand-logos/toggle-logo.png --}}
                                    alt="logo"
                                    class="mx-auto d-block mb-2 desktop-dark"
                                    style="height: 50px;"
                                />
                            </div>

                            {{-- FORM LOGIN --}}
                            <form id="loginForm" method="POST" action="{{ route('v4.login.process') }}" class="row gy-3">
                                @csrf

                                {{-- Username --}}
                                <div class="col-xl-12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label text-default">Username</label>
                                        <div id="theme-toggle" class="toggle toggle-sm mb-0" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Ubah Tema Sistem" hidden> <span></span> </div>
                                    </div>
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Masukkan Username"
                                        value="{{ old('name') }}"
                                        autofocus
                                        required
                                    >
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Password --}}
                                <div class="col-xl-12 mb-2">
                                    <label class="form-label text-default d-block">Password</label>
                                    <div class="position-relative">
                                        <input
                                            type="password"
                                            name="password"
                                            id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Masukkan Password"
                                            required
                                        >
                                        <button
                                            type="button"
                                            class="show-password-button text-muted position-absolute end-0 top-0 h-100 border-0 bg-transparent"
                                            onclick="togglePassword()"
                                        >
                                            <i class="ri ri-eye-line align-middle" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    {{-- Remember me --}}
                                    <div class="mt-2 d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="remember"
                                                id="rememberMe"
                                                {{ old('remember') ? 'checked' : '' }}
                                            >
                                            <label class="form-check-label" for="rememberMe">
                                                Ingat Saya
                                            </label>
                                        </div>
                                        <a role="button" class="link-danger fw-medium fs-12">
                                            Lupa Password?
                                        </a>
                                    </div>
                                </div>

                                {{-- Captcha --}}
                                <div class="col-xl-12 mb-2">
                                    <label class="form-label text-default">Selesaikan Captcha</label>
                                    <div class="input-group align-items-center mt-2">
                                        <img
                                            src="{{ captcha_src('math') }}"
                                            id="captchaImage"
                                            class="rounded border"
                                        >
                                        <input
                                            type="number"
                                            name="captcha"
                                            class="form-control @error('captcha') is-invalid @enderror"
                                            placeholder="Tulis Hasil (+)"
                                            required
                                        >
                                        <button
                                            type="button"
                                            class="btn btn-outline-warning"
                                            onclick="reloadCaptcha()" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Muat Ulang Nilai Penjumlahan"
                                        >
                                            <i class="fas fa-sync"></i>
                                        </button>
                                    </div>
                                    @error('captcha')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Progress --}}
                                <div class="progress mt-1" style="height: 4px;">
                                    <div
                                        class="progress-bar bg-warning"
                                        id="captchaProgress"
                                        style="width: 0%;">
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="col-12 d-grid mt-3">
                                    <button type="submit" id="btnLogin" class="btn btn-primary">
                                        <i class="ri-login-box-line fs-16 me-1"></i> Sign In
                                    </button>
                                </div>

                                {{-- OR --}}
                                <div class="col-12 text-center my-3 authentication-barrier">
                                    <span class="op-4 fs-13">OR</span>
                                </div>

                                {{-- Register --}}
                                <div class="col-12 text-center fw-medium mt-0">
                                    Belum memiliki Akun?
                                    <a role="button" class="text-primary">
                                        Hubungi SDI
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
                        <img src="{{ asset('images/brand-logos/toggle-logo.png') }}" alt="logo" style="height: 40px" class="toggle-logo">
                        <img src="{{ asset('images/brand-logos/toggle-dark.png') }}" alt="logo" style="height: 40px" class="toggle-dark">
                    </a>
                </div>
                <div class="authentication-cover-background">
                    <img src="{{ asset('images/media/backgrounds/9.png') }}" alt="">
                </div>
                <div class="authentication-cover-content">
                    <div class="p-5">
                        <h3 class="fw-semibold lh-base">Hi, Selamat Datang 👋</h3>
                        <p class="mb-0 text-muted fw-medium">
                            Silakan masuk menggunakan Akun Simrsmu Anda untuk melanjutkan Peluncuran Dashboard.
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
        let showPassword = false;
        let progress = 0;
        let interval = null;
        let startTime = Date.now();
        const TOTAL_TIME = 30 * 1000; // 30 detik

        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const captchaImg = document.getElementById('captchaImage');
        const progressBar = document.getElementById('captchaProgress');

        /* =========================
            SHOW / HIDE PASSWORD
        ========================== */
        function togglePassword() {
            showPassword = !showPassword;
            passwordInput.type = showPassword ? 'text' : 'password';
            eyeIcon.className = showPassword
                ? 'ri ri-eye-off-line align-middle'
                : 'ri ri-eye-line align-middle';
        }

        /* =========================
            RELOAD CAPTCHA
        ========================== */
        function reloadCaptcha() {
            captchaImg.src = `/captcha/math?${Date.now()}`;
            resetProgress();
        }

        /* =========================
            PROGRESS BAR TIMER
        ========================== */
        function resetProgress() {
            startTime = Date.now();
            progressBar.style.width = '0%';
        }

        function startProgressTimer() {
            interval = setInterval(() => {
                const elapsed = Date.now() - startTime;
                progress = Math.min((elapsed / TOTAL_TIME) * 100, 100);
                progressBar.style.width = progress + '%';

                if (elapsed >= TOTAL_TIME) {
                    reloadCaptcha();
                    startTime = Date.now();
                }
            }, 50);
        }

        /* =========================
            INIT
        ========================== */
        $(document).ready(function() {

            // GET THEME
            if(localStorage.vyzordarktheme){
                $('#theme-toggle').addClass('on').prop('hidden',false);
            } else {
                $('#theme-toggle').removeClass('on').prop('hidden',false);
            }

            startProgressTimer();

            $('#loginForm').on('submit', function () {

                $('#btnLogin')
                    .prop('disabled', true)
                    .html(`
                        <span class="loading">
                            <i class="ri-loader-4-line fs-16 me-1"></i>
                        </span>
                        Memproses...
                    `);

                return true;
            });

            $('#theme-toggle').click(function(){
                $(this).toggleClass('on');
                toggleTheme();
            });

            $('[data-bs-toggle="tooltip"]').tooltip({
                trigger : 'hover'
            })
        })
    </script>

@endsection
