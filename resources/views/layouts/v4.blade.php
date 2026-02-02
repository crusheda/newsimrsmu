<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr"
    data-nav-layout="vertical"
    data-theme-mode="light"
    data-header-styles="transparent"
    data-width="fullwidth"
    data-menu-styles="transparent"
    data-page-style="flat"
    data-toggled="close"
    data-vertical-style="default"
    loader="disable" foxified>
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

        <!-- iziToast-->
        <link rel="stylesheet" href="{{ asset('libs/iziToast/iziToast.css') }}" />

        <!-- Sweet Alert-->
        <link href="{{ asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Choices JS -->
        <script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

        <!-- Main Theme Js -->
        <script src="{{ asset('js/main.js') }}"></script>

        <!-- Bootstrap Css -->
        <link id="style" href="{{ asset('libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" >

        <!-- Style Css -->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" >

        <!-- Icons Css +_+ -->
        <link href="{{ asset('css/icons.css') }}" rel="stylesheet" >
        <link rel="stylesheet" href="{{ asset('fonts/inter/inter.css') }}" id="main-font-link">
        <!-- [phosphor Icons] https://phosphoricons.com/ -->
        <link rel="stylesheet" href="{{ asset('fonts/phosphor/duotone/style.css') }}">
        <!-- [Tabler Icons] https://tablericons.com -->
        <link rel="stylesheet" href="{{ asset('fonts/tabler-icons.min.css') }}">
        <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
        <link rel="stylesheet" href="{{ asset('fonts/fontawesome.css') }}">
        <!-- [Material Icons] https://fonts.google.com/icons -->
        <link rel="stylesheet" href="{{ asset('fonts/material.css') }}">

        <!-- Node Waves Css -->
        <link href="{{ asset('libs/node-waves/waves.min.css') }}" rel="stylesheet" >

        <!-- Simplebar Css -->
        <link href="{{ asset('libs/simplebar/simplebar.min.css') }}" rel="stylesheet" >

        <!-- Color Picker Css -->
        <link rel="stylesheet" href="{{ asset('libs/flatpickr/flatpickr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('libs/@simonwep/pickr/themes/nano.min.css') }}">

        <!-- Choices Css -->
        <link rel="stylesheet" href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css') }}">

        <!-- FlatPickr CSS -->
        <link rel="stylesheet" href="{{ asset('libs/flatpickr/flatpickr.min.css') }}">

        <!-- Auto Complete CSS -->
        <link rel="stylesheet" href="{{ asset('libs/@tarekraafat/autocomplete.js/css/autoComplete.css') }}">

    </head>
    <body class="font-sans antialiased">
        <div class="progress-top-bar"></div>

        <!-- Logout Form -->
        <form id="logoutform" action="{{ route('v4.logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

        @include('inc.v4.switcher')

        <!-- Loader -->
        <div id="loader" >
            <img src="{{ asset('images/loader.svg') }}" alt="">
        </div>
        <!-- Loader -->

        <div class="page">

            @include('inc.v4.header')

            @include('inc.v4.sidebar')

            <!-- START Page Content -->
            <main id="main-content">
                <div class="main-content app-content">
                    @yield('content')
                </div>
            </main>
            <!-- END Page Content -->

            @include('inc.v4.footer')

            <div class="modal fade" id="header-responsive-search" tabindex="-1" aria-labelledby="header-responsive-search" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="input-group">
                                <input type="text" class="form-control border-end-0" placeholder="Search Anything ..."
                                    aria-label="Search Anything ..." aria-describedby="button-addon2">
                                <button class="btn btn-primary" type="button"
                                    id="button-addon2"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Scroll To Top -->
        <div class="scrollToTop">
            <span class="arrow lh-1"><i class="ti ti-arrow-big-up fs-18"></i></span>
        </div>
        <div id="responsive-overlay"></div>
        <!-- Scroll To Top -->

        <!-- Popper JS -->
        <script src="{{ asset('libs/@popperjs/core/umd/popper.min.js') }}"></script>

        <!-- Bootstrap JS -->
        <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- iziToast JS -->
        <script src="{{ asset('libs/iziToast/iziToast.js') }}"></script>

        <!-- sweetalert2 JS -->
        <script src="{{ asset('libs/sweetalert2/sweetalert2.min.js') }}"></script>

        <!-- Defaultmenu JS -->
        <script src="{{ asset('js/defaultmenu.min.js') }}"></script>

        <!-- Node Waves JS-->
        <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>

        <!-- Sticky JS -->
        <script src="{{ asset('js/sticky.js') }}"></script>

        <!-- Simplebar JS -->
        <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('js/simplebar.js') }}"></script>

        <!-- Auto Complete JS -->
        <script src="{{ asset('libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>

        <!-- Color Picker JS -->
        <script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

        <!-- Date & Time Picker JS -->
        <script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>

        <!-- Apex Charts JS -->
        <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- Custom JS -->
        <script src="{{ asset('js/custom.js') }}"></script>

        <!-- Custom-Switcher JS -->
        <script src="{{ asset('js/custom-switcher.min.js') }}"></script>
    </body>
</html>
