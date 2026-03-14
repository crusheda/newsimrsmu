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

        @include('inc.v4.css')

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

        @include('inc.v4.js')

    </body>
</html>
