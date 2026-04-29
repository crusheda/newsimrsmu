<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">
<head>

    <!-- Meta Data -->
    <title id="titlexhead">{{ config('app.name') }} v{{ config('app.version') }} {{ Auth::check() ? '- '.Auth::user()->name : '' }}</title>
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

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome.css') }}">

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

    <!-- CLOUDFLARE TURNSTILE CAPTCHA -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

</head>

<body class="bg-white">

    @yield('content')

    <!-- Bootstrap JS -->
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Show Password JS -->
    <script src="{{ asset('js/show-password.js') }}"></script>

    <script src="{{ asset('libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('js/prism-custom.js') }}"></script>

    <script>
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
            $('[data-bs-toggle="tooltip"]').tooltip({
                trigger : 'hover'
            })
        })
    </script>
</body>
</html>
