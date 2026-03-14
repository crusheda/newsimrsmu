<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">
<head>

    <!-- Meta Data -->
    <title>{{ config('app.name') }} v{{ config('app.version') }} {{ Auth::check() ? '- '.Auth::user()->name : '' }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sistem Manajemen Rumah Sakit PKU Muhammadiyah Sukoharjo" />
    <meta name="keywords" content="simrs, simrsmu, sim rspkuskh, pkuskh, rspkuskh, sistem pku, sistem informasi majemen rumah sakit, rumah sakit pku, pku muhammadiyah sukoharjo, pku sukoharjo">
    <meta name="author" content="Yussuf Faisal" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo/onlylogo/logo_dark_verysmall.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logo/onlylogo/logo_dark_verysmall.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/logo/onlylogo/logo_dark_verysmall.png') }}">

    <!-- JQUERY INIT -->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>

    <!-- Main Theme Js -->
    {{-- <script src="{{ asset('js/authentication-main.js') }}"></script> --}}

    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" >

    <!-- Light / Dark Theme -->
    <script>
        if(localStorage.vyzordarktheme){
            document.querySelector("html").setAttribute("data-theme-mode","dark");
            // document.getElementById("theme-toggle").checked = true;
        }
        if(localStorage.vyzorrtl){
            document.querySelector("html").setAttribute("dir","rtl")
            document.querySelector("#style")?.setAttribute("href", "{{ asset('libs/bootstrap/css/bootstrap.rtl.min.css') }}");
        }
        if(localStorage.vyzorltr){
            document.querySelector("html").setAttribute("dir","ltr")
            document.querySelector("#style")?.setAttribute("href", "{{ asset('libs/bootstrap/css/bootstrap.min.css') }}");
        }
		let html = document.querySelector("html");
		if (window.innerWidth < 992) {
            html.setAttribute("data-toggled", "close");
		}
    </script>

    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome.css') }}">

    <!-- Style Css -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" >

    <!-- Custom Css -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" >

    <!-- Prism CSS -->
    <link rel="stylesheet" href="{{ asset('libs/prismjs/themes/prism-coy.min.css') }}">

</head>

<body class="bg-white">

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

    <!-- Bootstrap JS -->
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Show Password JS -->
    <script src="{{ asset('js/show-password.js') }}"></script>

    <script src="{{ asset('libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('js/prism-custom.js') }}"></script>

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

        function toggleTheme(){
            const html = document.documentElement;

            if(html.getAttribute("data-theme-mode") === "dark"){
                html.setAttribute("data-theme-mode","light");
                localStorage.removeItem("vyzordarktheme");
            }else{
                html.setAttribute("data-theme-mode","dark");
                localStorage.setItem("vyzordarktheme", "true");
            }
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
</body>
</html>
