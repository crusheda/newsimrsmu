<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="horizontal" data-nav-style="menu-hover" data-menu-position="fixed" data-theme-mode="light">
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

    <!-- Style Css -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" >
    <link rel="stylesheet" href="{{ asset('fonts/inter/inter.css') }}" id="main-font-link">
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{ asset('fonts/phosphor/duotone/style.css') }}">
    <!-- [Tabler Icons] https://tablericons.com -->
    {{-- <link rel="stylesheet" href="{{ asset('fonts/tabler-icons.min.css') }}"> --}}
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome.css') }}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('fonts/material.css') }}">

    <!-- Node Waves Css -->
    <link href="{{ asset('libs/node-waves/waves.min.css') }}" rel="stylesheet" >

    <!-- SwiperJS Css -->
    <link rel="stylesheet" href="{{ asset('libs/swiper/swiper-bundle.min.css') }}">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/@simonwep/pickr/themes/nano.min.css') }}">
    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css') }}">

    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{ asset('libs/swiper/swiper-bundle.min.css') }}">

</head>

<body class="landing-body">

    <!-- Start Switcher -->
    {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="switcher-canvas" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Switcher</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="">
                <p class="switcher-style-head">Theme Color Mode:</p>
                <div class="row switcher-style g-0">
                    <div class="col-4">
                        <div class="form-check switch-select">
                            <label class="form-check-label" for="switcher-light-theme">
                                Light
                            </label>
                            <input class="form-check-input" type="radio" name="theme-style" id="switcher-light-theme"
                                checked>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check switch-select">
                            <label class="form-check-label" for="switcher-dark-theme">
                                Dark
                            </label>
                            <input class="form-check-input" type="radio" name="theme-style" id="switcher-dark-theme">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- End Switcher -->

    <div class="landing-page-wrapper">

        <!-- app-header -->
        <header class="app-header" id="header">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">

                <!-- Start::header-content-left -->
                <div class="header-content-left">

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <a href="{{ route('portal') }}" class="header-logo">
                                <img src="{{ asset('images/brand-logos/toggle-logo.png') }}" alt="logo" class="toggle-logo">
                                <img src="{{ asset('images/brand-logos/toggle-dark.png') }}" alt="logo" class="toggle-dark">
                            </a>
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link -->
                        <a href="javascript:void(0);" class="sidemenu-toggle header-link" data-bs-toggle="sidebar">
                            <span class="open-toggle">
                                <i class="ri-menu-3-line fs-20"></i>
                            </span>
                        </a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <div class="header-content-right">

                    <!-- Start::header-element -->
                    <div class="header-element align-items-center">
                        <!-- Start::header-link|switcher-icon -->
                        <div class="btn-list d-lg-none d-block">
                            <a href="{{ route('v4.login') }}" class="btn btn-primary-light">
                                <i class="las la-sign-in-alt me-1"></i> Log in
                            </a>
                            {{-- <button class="btn btn-icon btn-success switcher-icon" data-bs-toggle="offcanvas" data-bs-target="#switcher-canvas">
                                <i class="ri-settings-3-line"></i>
                            </button> --}}
                        </div>
                        <!-- End::header-link|switcher-icon -->
                    </div>
                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-right -->

            </div>
            <!-- End::main-header-container -->

        </header>
        <!-- /app-header -->

        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">

            <div class="container px-0">
                <!-- Start::main-sidebar -->
                <div class="main-sidebar">

                    <!-- Start::nav -->
                    <nav class="main-menu-container nav nav-pills sub-open">
                        <div class="landing-logo-container">
                            <div class="horizontal-logo">
                                <a href="{{ route('portal') }}" class="header-logo">
                                    <img src="{{ asset('images/brand-logos/desktop-logo.png') }}" alt="logo" class="desktop-logo">
                                    <img src="{{ asset('images/brand-logos/desktop-dark.png') }}" alt="logo" class="desktop-dark">
                                </a>
                            </div>
                        </div>
                        <div class="slide-left" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg></div>
                        <ul class="main-menu flex-fill justify-content-center">
                            <li class="slide">
                                <a class="side-menu__item" href="#home">
                                    <span class="side-menu__label">Beranda</span>
                                </a>
                            </li>
                            <li class="slide">
                                <a href="#feature" class="side-menu__item">
                                    <span class="side-menu__label">Profil</span>
                                </a>
                            </li>
                            {{-- <li class="slide">
                                <a href="#service" class="side-menu__item">
                                    <span class="side-menu__label">Services</span>
                                </a>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <span class="side-menu__label">Pages</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide">
                                        <a href="javascript:void(0);" class="side-menu__item">Abous Us</a>
                                    </li>
                                    <li class="slide">
                                        <a href="javascript:void(0);" class="side-menu__item">Terms & Conditions</a>
                                    </li>
                                    <li class="slide">
                                        <a href="javascript:void(0);" class="side-menu__item">Privacy Policy</a>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Level-2
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a href="javascript:void(0);" class="side-menu__item">Level-2-1</a>
                                            </li>
                                            <li class="slide has-sub">
                                                <a href="javascript:void(0);" class="side-menu__item">Level-2-2
                                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                                <ul class="slide-menu child3">
                                                    <li class="slide">
                                                        <a href="javascript:void(0);" class="side-menu__item">Level-2-2-1</a>
                                                    </li>
                                                    <li class="slide has-sub">
                                                        <a href="javascript:void(0);" class="side-menu__item">Level-2-2-2</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a href="#price" class="side-menu__item">
                                    <span class="side-menu__label">Subscription</span>
                                </a>
                            </li> --}}
                            <li class="slide">
                                <a href="#contactus" class="side-menu__item">
                                    <span class="side-menu__label">Kontak Kami</span>
                                </a>
                            </li>
                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
                        <div class="d-lg-flex d-none align-items-center">
                            <div class="btn-list d-xl-flex d-none">
                                <a href="{{ route('v4.login') }}" class="btn btn-wave btn-primary border">
                                    <i class="las la-sign-in-alt me-1"></i> Log in
                                </a>
                            </div>
                            <div class="form-check form-switch d-flex align-items-center gap-2 ms-2">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="theme-toggle"
                                >
                                <label class="form-check-label" for="theme-toggle" id="theme-toggle-label">
                                    Mode Terang
                                </label>
                            </div>
                            <script>
                                if(localStorage.vyzordarktheme){
                                    document.getElementById("theme-toggle").checked = true;
                                    document.getElementById("theme-toggle-label").innerText = "Mode Gelap";
                                }
                            </script>
                            {{-- <a href="javascript:void(0);" class="btn btn-icon btn-primary-light switcher-icon" data-bs-toggle="offcanvas" data-bs-target="#switcher-canvas">
                                <i class="ti ti-settings"></i>
                            </a> --}}
                        </div>
                    </nav>
                    <!-- End::nav -->

                </div>
                <!-- End::main-sidebar -->
            </div>

        </aside>
        <!-- End::app-sidebar -->

        <!-- Start::app-content -->
        <div class="main-content landing-main">

            <!-- Start:: Landing Banner -->
            <div class="landing-banner" id="home">
                <div class="banner-image-container">
                    <img src="{{ asset('images/media/backgrounds/5.png') }}" alt="">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 my-auto">
                            <div class="d-inline-flex align-items-center gap-2 text-default badge bg-white border fs-13 rounded-pill"><span class="avatar avatar-xs avatar-rounded bg-warning"><i class="ri-pulse-line fs-14"></i></span>Sistem Internal RS</div>
                            <h1 class="fw-semibold mt-3 landing-banner-heading">Sistem Informasi <br> RS <span class="text-primary">PKU Muhammadiyah</span> Sukoharjo</h1>
                            <span class="d-block fs-18">Platform yang mendukung manajemen data yang efektif, komunikasi yang lancar antar bagian manajemen, mempermudah proses administrasi, dan meningkatkan kinerja pegawai dengan dukungan sistem yang terintegrasi dan interkoneksi.</span>
                            <div class="btn-list banner-buttons">
                                <a href="index.html" class="btn btn-primary btn-lg rounded-pill btn-w-lg">Masuk Sekarang</a>
                                <a class="btn btn-lg btn-light border rounded-pill btn-w-lg" href="javascript:void(0);">Web Resmi RS</a>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="banner-main-img text-end d-xl-block d-none">
                                <img src="{{ asset('images/media/backgrounds/7.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: Landing Banner -->

            <!-- Start:: Section-1 -->
            <section class="section">
				<div class="container">
                    <div class="heading-section">
                        <div class="heading-subtitle">Dukungan</div>
                        <div class="heading-title">Software Pengembang</div>
                        <div class="heading-description">
                            Pengembangan sistem ini didukung oleh berbagai program, framework, dan tools pengembangan perangkat lunak, termasuk sistem basis data, layanan backend, serta teknologi frontend untuk memastikan performa, keamanan, dan skalabilitas sistem.
                        </div>
                    </div>
                    <div class="swiper trusted-clients">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="card custom-card trusted-clients-container mb-0 border border-dashed">
                                    <div class="card-body">
                                        <img src="{{ asset('images/company-logos/13.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card custom-card trusted-clients-container mb-0 border border-dashed">
                                    <div class="card-body">
                                        <img src="{{ asset('images/company-logos/14.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card custom-card trusted-clients-container mb-0 border border-dashed">
                                    <div class="card-body">
                                        <img src="{{ asset('images/company-logos/15.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card custom-card trusted-clients-container mb-0 border border-dashed">
                                    <div class="card-body">
                                        <img src="{{ asset('images/company-logos/16.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card custom-card trusted-clients-container mb-0 border border-dashed">
                                    <div class="card-body">
                                        <img src="{{ asset('images/company-logos/17.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card custom-card trusted-clients-container mb-0 border border-dashed">
                                    <div class="card-body">
                                        <img src="{{ asset('images/company-logos/18.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card custom-card trusted-clients-container mb-0 border border-dashed">
                                    <div class="card-body">
                                        <img src="{{ asset('images/company-logos/19.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card custom-card trusted-clients-container mb-0 border border-dashed">
                                    <div class="card-body">
                                        <img src="{{ asset('images/company-logos/20.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card custom-card trusted-clients-container mb-0 border border-dashed">
                                    <div class="card-body">
                                        <img src="{{ asset('images/company-logos/12.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</section>
            <!-- End:: Section-1 -->

            <!-- Start:: Section-3 -->
            <section class="section" id="service">
                <div class="container">
                    <div class="heading-section">
                        <div class="heading-subtitle">Fitur</div>
                        <div class="heading-title">Fitur Unggulan</div>
                        <div class="heading-description">
                            Beberapa fitur unggulan yang ditawarkan oleh sistem informasi manajemen rumah sakit untuk meningkatkan efisiensi operasional dan kualitas layanan kesehatan.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-7">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card custom-card landing-services-card primary">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start gap-3">
                                                <div class="lh-1">
                                                    <span class="avatar avatar-lg avatar-rounded bg-primary-transparent svg-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M104,208V104H32v96a8,8,0,0,0,8,8H96" opacity="0.2"/><line x1="32" y1="104" x2="224" y2="104" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="104" y1="104" x2="104" y2="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="32" y="48" width="192" height="160" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="d-block fw-semibold">Customizable Dashboards</h6>
                                                    <span class="d-block text-muted">Personalize your dashboard with customizable widgets & modules.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card custom-card landing-services-card secondary">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start gap-3">
                                                <div class="lh-1">
                                                    <span class="avatar avatar-lg avatar-rounded bg-secondary-transparent svg-secondary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M32,48H208a16,16,0,0,1,16,16V208a0,0,0,0,1,0,0H32a0,0,0,0,1,0,0V48A0,0,0,0,1,32,48Z" opacity="0.2"/><polyline points="224 208 32 208 32 48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="224 96 160 152 96 104 32 160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="d-block fw-semibold">Real-Time Analytics</h6>
                                                    <span class="d-block text-muted">Access real-time data to drive fast, informed decisions.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card custom-card landing-services-card warning">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start gap-3">
                                                <div class="lh-1">
                                                    <span class="avatar avatar-lg avatar-rounded bg-warning-transparent svg-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><circle cx="128" cy="96" r="64" opacity="0.2"/><circle cx="128" cy="96" r="64" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M32,216c19.37-33.47,54.55-56,96-56s76.63,22.53,96,56" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="d-block fw-semibold">User Management</h6>
                                                    <span class="d-block text-muted">Efficiently manage roles, permissions, and team access.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card custom-card landing-services-card success">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start gap-3">
                                                <div class="lh-1">
                                                    <span class="avatar avatar-lg avatar-rounded bg-success-transparent svg-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M212,132l-58.63,58.63a32,32,0,0,1-45.25,0L65.37,147.88a32,32,0,0,1,0-45.25L124,44Z" opacity="0.2"/><line x1="144" y1="64" x2="184" y2="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="232" y1="72" x2="192" y2="112" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="224" y1="144" x2="112" y2="32" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M212,132l-58.63,58.63a32,32,0,0,1-45.25,0L65.37,147.88a32,32,0,0,1,0-45.25L124,44" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="86.75" y1="169.25" x2="32" y2="224" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="d-block fw-semibold">Seamless Integration</h6>
                                                    <span class="d-block text-muted">Integrate effortlessly with third-party tools and services.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 my-auto">
                            <div class="services-image-container text-end d-xl-block d-none">
                                <img src="{{ asset('images/media/media-67.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End:: Section-3 -->

            <!-- Start:: Buy Now Section -->
            <section class="section section-md section-primary text-fixed-white py-5 buy-now-section">
                <div class="testimonials-background-container">
                    <img src="{{ asset('images/media/backgrounds/1.png') }}" alt="">
                </div>
                <div class="container">
                    <div class="d-flex align-items-center gap-2 justify-content-between flex-wrap">
                        <div>
                            <h4 class="fw-semibold text-fixed-white">Belum Memiliki Akun?</h4>
                            <span class="d-block fs-16 op-8">
                                Daftar sekarang dan nikmati kemudahan <br> manajemen rumah sakit dengan sistem kami.
                            </span>
                        </div>
                        <div class="btn-list">
                            <a href="index.html" class="btn btn-danger btn-lg btn-w-md d-inline-flex align-items-center">View Demo<i class="ti ti-arrow-narrow-right ms-2 custom-arrow1"></i></a>
                            <button class="btn btn-success btn-lg btn-w-md d-inline-flex align-items-center">Buy Now<i class="ti ti-shopping-cart ms-2"></i></button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End:: Buy Now Section -->

            <!-- Start:: Section-5 -->
            <section class="section">
                <div class="container">
                    <div class="heading-section">
                        <div class="heading-subtitle">FAQ's</div>
                        <div class="heading-title">Need Help? Find Your Answers Here</div>
                        <div class="heading-description">
                            Browse through common questions to get quick solutions. We're here to help!
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="accordion faq-accordion accordions-items-seperate" id="accordionFAQ3">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingcustomicon2Eleven">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecustomicon2Eleven" aria-expanded="true" aria-controls="collapsecustomicon2Eleven">
                                            <i class="ri-layout-4-line fw-medium avatar avatar-sm avatar-rounded bg-primary-transparent fs-5 me-2 text-primary flex-shrink-0"></i>How do I customize my dashboard layout?
                                        </button>
                                    </h2>
                                    <div id="collapsecustomicon2Eleven" class="accordion-collapse collapse show" aria-labelledby="headingcustomicon2Eleven" data-bs-parent="#accordionFAQ3">
                                        <div class="accordion-body">
                                            You can easily customize the dashboard by dragging and dropping widgets. Go to the settings menu and select 'Customize Dashboard' to rearrange the layout.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingcustomicon2Twelve">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecustomicon2Twelve" aria-expanded="false" aria-controls="collapsecustomicon2Twelve">
                                            <i class="ri-plug-line fw-medium avatar avatar-sm avatar-rounded bg-primary-transparent fs-5 me-2 text-primary flex-shrink-0"></i>Can I integrate third-party apps with the admin template?
                                        </button>
                                    </h2>
                                    <div id="collapsecustomicon2Twelve" class="accordion-collapse collapse" aria-labelledby="headingcustomicon2Twelve" data-bs-parent="#accordionFAQ3">
                                        <div class="accordion-body">
                                            Yes! Our admin template supports seamless integrations with third-party apps. You can easily connect tools like Google Analytics, CRM software, and more.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingcustomicon2Thirteen">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecustomicon2Thirteen" aria-expanded="false" aria-controls="collapsecustomicon2Thirteen">
                                            <i class="ri-phone-line fw-medium avatar avatar-sm avatar-rounded bg-primary-transparent fs-5 me-2 text-primary flex-shrink-0"></i>Is this admin template mobile responsive?
                                        </button>
                                    </h2>
                                    <div id="collapsecustomicon2Thirteen" class="accordion-collapse collapse" aria-labelledby="headingcustomicon2Thirteen" data-bs-parent="#accordionFAQ3">
                                        <div class="accordion-body">
                                            Absolutely! The admin template is fully responsive and optimized for mobile, ensuring that it works perfectly on smartphones and tablets.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingcustomicon2Fourteen">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecustomicon2Fourteen" aria-expanded="false" aria-controls="collapsecustomicon2Fourteen">
                                            <i class="ri-user-settings-line fw-medium avatar avatar-sm avatar-rounded bg-primary-transparent fs-5 me-2 text-primary flex-shrink-0"></i>How do I manage user roles and permissions?
                                        </button>
                                    </h2>
                                    <div id="collapsecustomicon2Fourteen" class="accordion-collapse collapse" aria-labelledby="headingcustomicon2Fourteen" data-bs-parent="#accordionFAQ3">
                                        <div class="accordion-body">
                                            You can manage user roles and permissions under the 'User Management' section. Simply assign roles like Admin, Manager, or Viewer to control access.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingcustomicon2Fifteen">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecustomicon2Fifteen" aria-expanded="false" aria-controls="collapsecustomicon2Fifteen">
                                            <i class="ri-file-excel-line fw-medium avatar avatar-sm avatar-rounded bg-primary-transparent fs-5 me-2 text-primary flex-shrink-0"></i>Can I export data from the reports section?
                                        </button>
                                    </h2>
                                    <div id="collapsecustomicon2Fifteen" class="accordion-collapse collapse" aria-labelledby="headingcustomicon2Fifteen" data-bs-parent="#accordionFAQ3">
                                        <div class="accordion-body">
                                            Yes, you can easily export reports as CSV, PDF, or Excel files. Just click the export button at the top of the reports page."
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingcustomicon2Sixteen">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecustomicon2Sixteen" aria-expanded="false" aria-controls="collapsecustomicon2Sixteen">
                                            <i class="ri-notification-line fw-medium avatar avatar-sm avatar-rounded bg-primary-transparent fs-5 me-2 text-primary flex-shrink-0"></i>How do I enable notifications for updates?
                                        </button>
                                    </h2>
                                    <div id="collapsecustomicon2Sixteen" class="accordion-collapse collapse" aria-labelledby="headingcustomicon2Sixteen" data-bs-parent="#accordionFAQ3">
                                        <div class="accordion-body">
                                            Notifications can be enabled under the 'Settings' section. You can choose to receive real-time alerts via email or in-app for important updates.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End:: Section-5 -->

            <!-- Start:: Setion-7 -->
            <section class="section bg-light py-5">
                <div class="container">
                    <div class="row gy-4">
                        <div class="col-lg-3 col-6">
                            <div class="text-center stats-point one">
                                <h4 class="fw-semibold mb-1">12,345</h4>
                                <div class="text-muted fs-16">Customers</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="text-center stats-point two">
                                <h4 class="fw-semibold mb-1">56,789</h4>
                                <div class="text-muted fs-16">Products Sold</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="text-center stats-point three">
                                <h4 class="fw-semibold mb-1">1,234</h4>
                                <div class="text-muted fs-16">Projects</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="text-center stats-point four">
                                <h4 class="fw-semibold mb-1">98%</h4>
                                <div class="text-muted fs-16">Client Satisfaction Rate</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End:: Setion-7 -->

            <!-- Start:: Section-8 -->
            <section class="section">
                <div class="container">
                    <div class="heading-section">
                        <div class="heading-subtitle">Permintaan Kustom</div>
                        <div class="heading-title">Pengajuan Fitur Sesuai Kebutuhan</div>
                        <div class="heading-description">
                            Kami memahami bahwa setiap rumah sakit memiliki kebutuhan bermacam-macam. Oleh karena itu, kami menyediakan layanan pengajuan fitur tambahan yang dapat disesuaikan dengan kebutuhan spesifik rumah sakit Anda. Tim pengembangan kami siap bekerja sama untuk mengimplementasikan fitur-fitur baru yang akan meningkatkan efisiensi operasional dan kualitas layanan kesehatan di rumah sakit Anda.
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-lg-3">
                            <div class="card custom-card border-0 shadow-none">
                                <div class="card-body p-4 text-center">
                                    <div class="step-arrow-container d-lg-block d-none">
                                        <img src="{{ asset('images/media/backgrounds/3.png') }}" alt="" class="img-fluid">
                                    </div>
                                    <div class="lh-1 mb-3">
                                        <span class="avatar avatar-lg svg-primary text-primary workflow-icon-container">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M104,208V104H32v96a8,8,0,0,0,8,8H96" opacity="0.2"/><line x1="32" y1="104" x2="224" y2="104" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="104" y1="104" x2="104" y2="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="32" y="48" width="192" height="160" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                                        </span>
                                    </div>
                                    <h5 class="fw-semibold">Dashboard Setup</h5>
                                    <span class="d-block text-muted">Quickly configure your dashboard with widgets, charts, and modules to track essential metrics.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card custom-card border-0 shadow-none">
                                <div class="card-body p-4 text-center">
                                    <div class="step-arrow-container d-lg-block d-none">
                                        <img src="{{ asset('images/media/backgrounds/4.png') }}" alt="" class="img-fluid">
                                    </div>
                                    <div class="lh-1 mb-3">
                                        <span class="avatar avatar-lg svg-warning text-warning workflow-icon-container">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><circle cx="84" cy="108" r="52" opacity="0.2"/><path d="M10.23,200a88,88,0,0,1,147.54,0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M172,160a87.93,87.93,0,0,1,73.77,40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><circle cx="84" cy="108" r="52" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M152.69,59.7A52,52,0,1,1,172,160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                                        </span>
                                    </div>
                                    <h5 class="fw-semibold">User Management</h5>
                                    <span class="d-block text-muted">Easily manage user roles, permissions, and access levels to keep your team organized.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card custom-card border-0 shadow-none">
                                <div class="card-body p-4 text-center">
                                    <div class="lh-1 mb-3">
                                        <span class="avatar avatar-lg svg-success text-success workflow-icon-container">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M32,48H208a16,16,0,0,1,16,16V208a0,0,0,0,1,0,0H32a0,0,0,0,1,0,0V48A0,0,0,0,1,32,48Z" opacity="0.2"/><polyline points="224 208 32 208 32 48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="224 96 160 152 96 104 32 160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                                        </span>
                                    </div>
                                    <h5 class="fw-semibold">Data Analytics</h5>
                                    <span class="d-block text-muted">Monitor real-time data and generate insightful reports to make informed business decisions.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End:: Section-8 -->

            <!-- Start:: Section-9 -->
            <section class="section">
                <div class="container">
                    <div class="heading-section">
                        <div class="heading-subtitle">Supporting</div>
                        <div class="heading-title">Tim IT Kami</div>
                        <div class="heading-description">
                            Tim IT kami terdiri dari profesional berpengalaman yang berdedikasi untuk mengembangkan, memelihara, dan meningkatkan sistem informasi manajemen rumah sakit dengan teknologi terkini.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="card custom-card">
                                <img src="{{ asset('images/faces/team/1.png') }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h6 class="fw-semibold mb-0">
                                        John Smith
                                    </h6>
                                    <span class="text-muted fs-13">Senior Developer</span>
                                    <div class="btn-list mt-3">
                                        <button class="btn btn-light btn-icon rounded-circle border">
                                            <i class="ri-facebook-circle-fill lh-1"></i>
                                        </button>
                                        <button class="btn btn-light btn-icon rounded-circle border">
                                            <i class="ri-twitter-x-fill lh-1"></i>
                                        </button>
                                        <button class="btn btn-light btn-icon rounded-circle border">
                                            <i class="ri-linkedin-box-fill lh-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card custom-card">
                                <img src="{{ asset('images/faces/team/2.png') }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h6 class="fw-semibold mb-0">
                                        Emily Johnson
                                    </h6>
                                    <span class="text-muted fs-13">Product Manager</span>
                                    <div class="btn-list mt-3">
                                        <button class="btn btn-light btn-icon rounded-circle border">
                                            <i class="ri-facebook-circle-fill lh-1"></i>
                                        </button>
                                        <button class="btn btn-light btn-icon rounded-circle border">
                                            <i class="ri-twitter-x-fill lh-1"></i>
                                        </button>
                                        <button class="btn btn-light btn-icon rounded-circle border">
                                            <i class="ri-linkedin-box-fill lh-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card custom-card">
                                <img src="{{ asset('images/faces/team/3.png') }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h6 class="fw-semibold mb-0">
                                        Sarah Davis
                                    </h6>
                                    <span class="text-muted fs-13">Marketing Specialist</span>
                                    <div class="btn-list mt-3">
                                        <button class="btn btn-light btn-icon rounded-circle border">
                                            <i class="ri-facebook-circle-fill lh-1"></i>
                                        </button>
                                        <button class="btn btn-light btn-icon rounded-circle border">
                                            <i class="ri-twitter-x-fill lh-1"></i>
                                        </button>
                                        <button class="btn btn-light btn-icon rounded-circle border">
                                            <i class="ri-linkedin-box-fill lh-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card custom-card">
                                <img src="{{ asset('images/faces/team/4.png') }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h6 class="fw-semibold mb-0">
                                        Michael Brown
                                    </h6>
                                    <span class="text-muted fs-13">Lead Designer</span>
                                    <div class="btn-list mt-3">
                                        <button class="btn btn-light btn-icon rounded-circle border">
                                            <i class="ri-facebook-circle-fill lh-1"></i>
                                        </button>
                                        <button class="btn btn-light btn-icon rounded-circle border">
                                            <i class="ri-twitter-x-fill lh-1"></i>
                                        </button>
                                        <button class="btn btn-light btn-icon rounded-circle border">
                                            <i class="ri-linkedin-box-fill lh-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End:: Section-9 -->

            <!-- Start:: Section-10 -->
            {{-- <section class="section" id="contactus">
                <div class="container">
                    <div class="heading-section">
                        <div class="heading-subtitle">Hubungi Kami</div>
                        <div class="heading-title">Get in Touch With Us</div>
                        <div class="heading-description">
                            Have questions or need assistance? Our team is here to help. <br> Reach out to us anytime for support or inquiries.
                        </div>
                    </div>
                    <div class="row gy-4 justify-content-between">
                        <div class="col-xl-6">
                            <h6 class="fw-semibold mb-4">Get In Touch !</h6>
                            <div class="row gy-3">
                                <div class="col-xl-6">
                                    <label for="contact-address-firstname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="contact-address-firstname" placeholder="Enter Name">
                                </div>
                                <div class="col-xl-6">
                                    <label for="contact-address-lastname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="contact-address-lastname" placeholder="Enter Name">
                                </div>
                                <div class="col-xl-12">
                                    <label for="contact-address-email" class="form-label">Email Id</label>
                                    <input type="email" class="form-control" id="contact-address-email" placeholder="Enter Email Id">
                                </div>
                                <div class="col-xl-12">
                                    <label for="contact-address-phone" class="form-label">Phone No</label>
                                    <input type="text" class="form-control" id="contact-address-phone" placeholder="Enter Phone No">
                                </div>
                                <div class="col-xl-12">
                                    <label for="contact-mail-message" class="form-label">Message</label>
                                    <textarea class="form-control" id="contact-mail-message" rows="4" placeholder="Enter Your Query ?"></textarea>
                                </div>
                            </div>
                            <div class="d-grid mt-3">
                                <button class="btn btn-primary">Submit<i class="ti ti-arrow-narrow-right ms-1 align-middle"></i></button>
                            </div>
                        </div>
                        <div class="col-xl-5">
                            <div class="row gy-5">
                                <div class="col-xl-12">
                                    <div class="d-flex align-items-start gap-3">
                                        <div>
                                            <span class="avatar avatar-lg bg-primary-transparent svg-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#5f6368"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path></svg>
                                            </span>
                                        </div>
                                        <div>
                                            <h5 class="fs-13 text-muted text-uppercase">Address :</h5>
                                            <span class="d-block fs-12 text-muted mb-2">Visit us in person From Mon-Fri 9:00am - 6:00pm</span>
                                            <div class="fw-semibold">123 Health Street, Suite 456
                                                <br>Wellness City, HC 78910<br>
                                                Country Name</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="d-flex align-items-start gap-3">
                                        <div>
                                            <span class="avatar avatar-lg bg-primary-transparent svg-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#5f6368"><path d="M0 0h24v24H0z" fill="none"></path><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56-.35-.12-.74-.03-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"></path></svg>
                                            </span>
                                        </div>
                                        <div>
                                            <h5 class="fs-13 text-muted text-uppercase">Phone Number :</h5>
                                            <span class="d-block fs-12 text-muted mb-2">Call our team Mon-Fri 9:00am - 6:00pm</span>
                                            <div class="fw-semibold">+1 (555) 123-4567</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="d-flex align-items-start gap-3">
                                        <div>
                                            <span class="avatar avatar-lg bg-primary-transparent svg-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#5f6368"><path d="M0 0h24v24H0z" fill="none"></path><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"></path></svg>
                                            </span>
                                        </div>
                                        <div>
                                            <h5 class="fs-13 text-muted text-uppercase">Email ID :</h5>
                                            <div class="fw-semibold lh-1">contact@healthclinic.com</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="d-flex align-items-start gap-3">
                                        <div>
                                            <span class="avatar avatar-lg bg-primary-transparent svg-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2C6.486 2 2 5.589 2 10c0 2.908 1.897 5.516 5 6.934V22l5.34-4.004C17.697 17.852 22 14.32 22 10c0-4.411-4.486-8-10-8zm-2.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"></path></svg>
                                            </span>
                                        </div>
                                        <div>
                                            <h5 class="fs-13 text-muted text-uppercase">Chat With Us :</h5>
                                            <div class="fw-semibold lh-1 chat-platforms">
                                                <a href="https://www.facebook.com/" target="_blank" class="d-block">
                                                    Chat on Facebook
                                                </a>
                                                <a href="https://www.twitter.com/" target="_blank" class="d-block">
                                                    Message Us On Twitter
                                                </a>
                                                <a href="javascript:void(0);" target="_blank">
                                                    Start a Live Chat
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
            <!-- End:: Section-10 -->

            <!-- Start:: Buy Now Section -->
            <section class="section section-md section-primary text-fixed-white py-5 buy-now-section">
                <div class="testimonials-background-container">
                    <img src="{{ asset('images/media/backgrounds/1.png') }}" alt="">
                </div>
                <div class="container">
                    <div class="d-flex align-items-center gap-2 justify-content-between">
                        <div>
                            <h4 class="fw-semibold text-fixed-white">Sudah mencoba hal baru dari Sistem Kami?</h4>
                            <span class="d-block fs-16 op-8">
                                Kami menyediakan solusi manajemen rumah sakit yang dapat disesuaikan dengan kebutuhan Anda. Coba sistem kami sekarang dan nikmati kemudahannya.
                            </span>
                        </div>
                        <button class="btn btn-secondary btn-lg btn-w-md d-inline-flex align-items-center">Masuk Sekarang</button>
                    </div>
                </div>
            </section>
            <!-- End:: Buy Now Section -->

        </div>
        <!-- End::app-content -->

        <!-- Start:: Footer -->
        <section class="section landing-footer text-fixed-white">
            <div class="container">
                <div class="row my-auto justify-content-between align-items-center mb-5 pb-5 newsletter-area gap-3">
                    <div class="col-lg-6">
                        <h3 class="mb-2 text-fixed-white">Subscribe to our News Letter</h3>
                        <div class="op-6">Stay up-to-date with the latest news and updates on our
                            products and services</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form mb-0">
                            <div class="form-group custom-form-group mx-auto">
                                <input type="text" class="form-control shadow-none" placeholder="Enter Your Email Address...">
                                <button class="custom-form-btn btn btn-primary bg-primary border-0 right-0 shadow-none" type="button">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center gy-3">
                    <div class="col-xl-4">
                        <p class="fw-semibold mb-3 brand-image"><a href="index.html"><img src="{{ asset('images/brand-logos/desktop-dark.html') }}" alt=""></a></p>
                        <p class="mb-2 op-6 fw-normal">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit et magnam, fuga est mollitia eius, quo illum illo inventore optio aut quas omnis rem. Dolores accusantium aspernatur minus ea incidunt.
                        </p>
                        <p class="mb-0 op-6 fw-normal">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem ea esse ad</p>
                    </div>
                    <div class="col-sm-3 col-xl-2 col-6">
                        <h6 class="fw-semibold mb-3 text-fixed-white">Product</h6>
                        <ul class="list-unstyled fw-normal landing-footer-list mb-0">
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-6">Services</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-6">Product Tour</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-6">Integrations</a>
                            </li>
                            <li>
                                <a href="pricing.html" class="text-fixed-white op-6">Pricing</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-3 col-xl-2 col-6">
                        <h6 class="fw-semibold mb-3 text-fixed-white">Support</h6>
                        <ul class="list-unstyled fw-normal landing-footer-list mb-0">
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-6">Contact Us</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-6">Technical Support</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-6">Documentation</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-6">Support</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-3 col-xl-2 col-6">
                        <h6 class="fw-semibold mb-3 text-fixed-white">Other</h6>
                        <ul class="list-unstyled fw-normal landing-footer-list mb-0">
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-6">Market Place</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-6">Social Integrations</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-3 col-xl-2 col-6">
                        <h6 class="fw-semibold mb-3 text-fixed-white">About</h6>
                        <ul class="list-unstyled fw-normal landing-footer-list mb-0">
                            <li>
                                <a href="blog.html" class="text-fixed-white op-6">Blog</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-6">About Us</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-6">Customers</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-6">Jobs</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <div class="py-3 landing-payment-gateways">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-7 col-lg-9">
                        <div class="d-md-flex align-items-center justify-content-center">
                            <p class="mb-0 me-3 text-fixed-white op-6 fw-normal">Payments We Accept :</p>
                            <div class="d-flex align-items-center gap-2 justify-content-center flex-wrap">
                                <div class="me-2 mb-2 mb-sm-0 payment-cards">
                                    <a href="javascript:void(0);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="40" viewBox="0 0 64 64"><g data-name="Paypal card"><path fill="#fff" d="M47 25.23a2.91 2.91 0 0 0-1-1.1 4.63 4.63 0 0 0-1.63-.59 12.57 12.57 0 0 0-2.19-.17H38.3a1 1 0 0 0-.88.71L34.8 35.47a.56.56 0 0 0 .57.71h1.86a1 1 0 0 0 .89-.7l.63-2.77a1 1 0 0 1 .9-.7h.53a8.9 8.9 0 0 0 5.32-1.4 4.41 4.41 0 0 0 1.88-3.69 3.67 3.67 0 0 0-.38-1.69ZM43 29a4 4 0 0 1-2.35.61h-.45a.57.57 0 0 1-.57-.71l.57-2.41a1 1 0 0 1 .89-.71h.6a3 3 0 0 1 1.62.36 1.26 1.26 0 0 1 .55 1.11A2.09 2.09 0 0 1 43 29Zm19.4-5.49h-1.65A1 1 0 0 0 60 24l-.09.15-.08.37-2.38 10.61-.08.33a.53.53 0 0 0 .46.67h1.77a.93.93 0 0 0 .8-.57l.1-.14L63 24.17a.54.54 0 0 0-.58-.7ZM56 26.82a7.12 7.12 0 0 0-3.32-.59 14.22 14.22 0 0 0-2.25.18c-.56.08-.61.1-1 .17a1.08 1.08 0 0 0-.81.87l-.23.93c-.13.59.21.57.37.52a9.45 9.45 0 0 1 1.1-.32 8.23 8.23 0 0 1 1.75-.24 4.66 4.66 0 0 1 1.69.24.86.86 0 0 1 .56.84v.27l-.27.16a33.3 33.3 0 0 0-2.74.3 9 9 0 0 0-2.37.65 3.73 3.73 0 0 0-1.6 1.26 3.5 3.5 0 0 0-.52 1.94 2.33 2.33 0 0 0 .76 1.78 2.89 2.89 0 0 0 2 .66 5.12 5.12 0 0 0 1.17-.1l.9-.31.77-.42.69-.47-.06.3a.54.54 0 0 0 .49.7h1.76a1 1 0 0 0 .79-.7L57 29.59l.07-.48v-.45A2 2 0 0 0 56 26.82Zm-3 6.61-.3.39-.72.37a2.66 2.66 0 0 1-1 .21 2.19 2.19 0 0 1-1-.2l-.37-.69a1.44 1.44 0 0 1 .27-.92 1.84 1.84 0 0 1 .8-.53 6.5 6.5 0 0 1 1.22-.28c.42-.05 1.27-.15 1.37-.15l.13.23c-.04.14-.28 1.14-.4 1.57Z"></path><path fill="#fff" d="M34.86 26.37h-2.23a1.63 1.63 0 0 0-1.18.7s-2.66 4.58-2.92 5h-.31l-.83-5a1 1 0 0 0-1-.73h-1.68a.54.54 0 0 0-.55.71s1.26 7.2 1.51 8.9c.12.94 0 1.1 0 1.1L24 40c-.24.39-.11.71.29.71h1.93a1.55 1.55 0 0 0 1.16-.7l7.42-12.59s.72-1.07.06-1.05Zm-12.65.45a7 7 0 0 0-3.32-.59 14.42 14.42 0 0 0-2.26.17 8.18 8.18 0 0 0-.95.18 1.08 1.08 0 0 0-.82.86l-.22.93c-.13.6.22.58.35.52a10.88 10.88 0 0 1 1.12-.32 7.58 7.58 0 0 1 1.74-.23 4.47 4.47 0 0 1 1.7.24.83.83 0 0 1 .55.84v.26l-.27.17a27 27 0 0 0-2.74.3 8.7 8.7 0 0 0-2.36.64 3.63 3.63 0 0 0-1.6 1.27 3.38 3.38 0 0 0-.57 1.94 2.28 2.28 0 0 0 .77 1.77 2.83 2.83 0 0 0 2 .67 4.87 4.87 0 0 0 1.16-.11l.91-.31.76-.42.7-.47-.06.29a.55.55 0 0 0 .5.69H21a1 1 0 0 0 .8-.69l1.36-5.88.07-.47v-.45a2 2 0 0 0-1.02-1.8Zm-3 6.6-.3.38-.73.38a2.62 2.62 0 0 1-1 .21 2.17 2.17 0 0 1-1.06-.2l-.36-.7a1.4 1.4 0 0 1 .27-.9l.79-.54a7.54 7.54 0 0 1 1.23-.28c.42-.05 1.26-.15 1.38-.15l.12.22c.02.16-.22 1.16-.33 1.58Zm-6-8.23a2.71 2.71 0 0 0-1-1.09 4.54 4.54 0 0 0-1.62-.6 13.86 13.86 0 0 0-2.2-.17H4.53a1 1 0 0 0-.9.71L1 35.42a.55.55 0 0 0 .56.71h1.88a.94.94 0 0 0 .89-.71L5 32.66a.93.93 0 0 1 .88-.7h.52a8.88 8.88 0 0 0 5.3-1.4 4.38 4.38 0 0 0 1.9-3.69 3.42 3.42 0 0 0-.36-1.68Zm-4 3.72a3.91 3.91 0 0 1-2.35.62h-.44a.55.55 0 0 1-.56-.71l.56-2.42a1 1 0 0 1 .89-.71h.6a3 3 0 0 1 1.62.36 1.24 1.24 0 0 1 .54 1.11 2 2 0 0 1-.84 1.75Z"></path></g></svg>
                                    </a>
                                </div>
                                <div class="me-2 mb-2 mb-sm-0 payment-cards">
                                    <a href="javascript:void(0);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="40" enable-background="new 0 0 48 48" viewBox="0 0 48 48"><polygon fill="#fff" points="17.202 32.269 21.087 32.269 23.584 16.732 19.422 16.732"></polygon><path fill="#fff" d="M13.873 16.454l-3.607 11.098-.681-3.126c-1.942-4.717-5.272-6.659-5.272-6.659l3.456 14.224h4.162l5.827-15.538H13.873zM44.948 16.454h-4.162l-6.382 15.538h3.884l.832-2.22h4.994l.555 2.22H48L44.948 16.454zM39.954 26.997l2.22-5.826 1.11 5.826H39.954zM28.855 20.893c0-.832.555-1.665 2.497-1.665 1.387 0 2.775 1.11 2.775 1.11l.832-3.329c0 0-1.942-.832-3.607-.832-4.162 0-6.104 2.22-6.104 4.717 0 4.994 5.549 4.162 5.549 6.659 0 .555-.277 1.387-2.497 1.387s-3.884-.832-3.884-.832l-.555 3.329c0 0 1.387.832 4.162.832 2.497.277 6.382-1.942 6.382-5.272C34.405 23.113 28.855 22.836 28.855 20.893z"></path><path fill="#fff" d="M9.711,25.055l-1.387-6.936c0,0-0.555-1.387-2.22-1.387c-1.665,0-6.104,0-6.104,0
                                            S8.046,19.229,9.711,25.055z"></path></svg>
                                    </a>
                                </div>
                                <div class="me-2 mb-2 mb-sm-0 payment-cards">
                                    <a href="javascript:void(0);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="40" viewBox="0 0 24 24"><path fill="#FF5F00" d="M15.245 17.831h-6.49V6.168h6.49v11.663z"></path><path fill="#EB001B" d="M9.167 12A7.404 7.404 0 0 1 12 6.169 7.417 7.417 0 0 0 0 12a7.417 7.417 0 0 0 11.999 5.831A7.406 7.406 0 0 1 9.167 12z"></path><path fill="#F79E1B" d="M24 12a7.417 7.417 0 0 1-12 5.831c1.725-1.358 2.833-3.465 2.833-5.831S13.725 7.527 12 6.169A7.417 7.417 0 0 1 24 12z"></path></svg>
                                    </a>
                                </div>
                                <div class="me-2 mb-2 mb-sm-0 payment-cards">
                                    <a href="javascript:void(0);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="40" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path fill="#fff" d="M3.093,14.964c1.18,0,2.55-0.431,2.79-1.711h-1.24c-0.213,0.625-0.85,0.923-1.568,0.923c-1.035,0-1.788-0.64-1.853-1.726h4.83v1.042c0,0.387-0.02,0.848-0.04,1.235h1.18c0.025-0.238,0.04-0.49,0.04-0.728c0.506,0.61,1.33,0.923,2.2,0.923c1.407,0,2.467-0.833,2.767-2.069c-0.022,0.12-0.037,0.253-0.037,0.402c0,0.908,0.792,1.682,2.272,1.682c1,0,1.717-0.224,2.32-0.952c0,0.253,0.016,0.506,0.046,0.759h1.114c-0.03-0.313-0.04-0.654-0.04-0.997v-2.44c0-0.372-0.07-0.67-0.2-0.923l2.33,4.345l-1.07,2.024h1.346L24,9.503h-1.243l-2.055,4.093l-2.055-4.092h-1.41l0.436,0.833c-0.42-0.744-1.351-1.012-2.415-1.012c-1.186,0-2.55,0.327-2.686,1.607h1.275c0.06-0.506,0.585-0.804,1.305-0.804c0.974,0,1.53,0.356,1.53,1.234v0.134c-0.465,0-1.05,0-1.56,0.018c-1.622,0.039-2.656,0.388-2.896,1.333c0.045-0.209,0.06-0.432,0.06-0.663c0-1.936-1.488-2.832-2.828-2.832c-0.8,0-1.612,0.201-2.202,0.899V7.25h-1.2v4.876c-0.01-1.904-1.252-2.783-2.94-2.783C0.982,9.343,0,10.49,0,12.23C0,13.808,0.95,14.985,3.093,14.964z M15.193,12.313l-0.002-0.002h-0.012c0.494-0.016,1.034-0.022,1.484-0.022v0.129c0,1.115-0.675,1.8-1.935,1.8c-0.945,0-1.305-0.501-1.305-0.962C13.423,12.544,14.098,12.346,15.193,12.313z M9.116,10.165c1.125,0,1.893,0.8,1.893,2.004c0,1.204-0.766,2.004-1.876,2.004H9.131h-0.03c-1.11,0-1.875-0.8-1.875-2.004C7.226,10.964,8.006,10.165,9.116,10.165z M3.058,10.145c0.871,0,1.681,0.418,1.725,1.534h-3.54C1.364,10.615,2.114,10.145,3.058,10.145z"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="landing-main-footer py-3">
            <div class="container">
                <div class="row">
                    <div></div>
                </div>
                <div class="row">
                    <div class="col-lg-4 text-lg-start text-center">
                        <span class="text-fixed-white op-7 fs-14"> © Copyright <span id="year"></span> <a
                            href="javascript:void(0);" class="text-primary fs-15 fw-semibold">Spruko </a> .All rights reserved
                        </span>
                    </div>
                    <div class="col-lg-8 text-lg-end text-center mt-lg-0 mt-1">
                        <ul class="list-unstyled fw-normal landing-footer-list mb-0">
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-8">Terms Of Service</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-8">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-8">Legal</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-8">Contact</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-8">Blog</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="text-fixed-white op-8">Licenses</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:: Footer -->

    </div>

    <div class="scrollToTop">
        <span class="arrow"><i class="ti ti-arrow-big-up fs-18"></i></span>
    </div>
    <div id="responsive-overlay"></div>

    <!-- Popper JS -->
    <script src="{{ asset('libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

    <!-- Choices JS -->
    <script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Swiper JS -->
    <script src="{{ asset('libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('js/defaultmenu.min.js') }}"></script>

    <!-- Internal Landing JS -->
    <script src="{{ asset('js/landing.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('js/sticky.js') }}"></script>

</body>
</html>
