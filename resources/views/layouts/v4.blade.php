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

        <!-- Custom Developer Css -->
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" >

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

        <!-- LightBox Css -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

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

        <!-- Select2 -->
        {{-- <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css" /> --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

        <!-- DataTable -->
        <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.3.7/b-3.2.6/b-colvis-3.2.6/b-html5-3.2.6/b-print-3.2.6/cc-1.2.0/fc-5.0.5/r-3.0.8/sb-1.8.4/datatables.min.css" rel="stylesheet" integrity="sha384-xE8CsVVujM0GkvuHxKaVX6wHHB3EF3z0ghhgyAdjySRvPjTrsQL7KyVIRfzZtA9f" crossorigin="anonymous">
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

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

        <!-- LightBox JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

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

        <!-- Datatables Cdn -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.3.7/b-3.2.6/b-colvis-3.2.6/b-html5-3.2.6/b-print-3.2.6/cc-1.2.1/sb-1.8.4/sp-2.3.5/datatables.min.js" integrity="sha384-SXwI3wNL77XIDCT2k19C4IUcyvREECbZ8rokpH2v4myQ+VqjX4Bxz0n+XzvpOys3" crossorigin="anonymous"></script>

        <!-- Internal Datatables JS -->

        <!-- Custom JS -->
        <script src="{{ asset('js/custom.js') }}"></script>

        <!-- Custom-Switcher JS -->
        <script src="{{ asset('js/custom-switcher.min.js') }}"></script>

        <!-- Select2 -->
        {{-- <script src="{{ asset('libs/select2/js/select2.min.js') }}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Supported JS -->
        <script>
            function closeModal() {
                $('.modal').modal('hide');
            }
        </script>
    </body>
</html>
