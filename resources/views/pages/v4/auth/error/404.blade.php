@extends('layouts.v4-auth')

@section('content')

    <div class="page error-bg">
        <div class="error-page-background">
            <img src="{{ asset('images/background-404.svg') }}" alt="">
        </div>
        <!-- Start::error-page -->
        <div class="row align-items-center justify-content-center h-100 g-0">
            <div class="col-xl-7 col-lg-7 col-md-7 col-12">
                <div class="text-center">
                    <div class="text-center mb-5">
                        <img src="{{ asset('images/media/backgrounds/11.png') }}" alt="" class="w-sm-auto w-100 h-100">
                    </div>
                    <span class="d-block fs-4 text-primary fw-semibold">ERROR CODE</span>
                    <p class="error-text mb-0">404</p>
                    <p class="fs-5 fw-normal mb-3">Maaf, halaman yang Anda cari tidak ditemukan di {{ request()->getHost() }} <br>Silakan periksa kembali URL Anda saat ini<br>Atau bisa tekan <b>[<strong class="text-secondary">CTRL</strong> + <strong class="text-secondary">L</strong>]</b></p>
                    <a href="{{ route('v4.portal') }}" class="btn btn-primary-transparent"><i class="fas fa-rocket me-1"></i> Arahkan Saya</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("titlexhead").textContent = "{{ config('app.name') }} v{{ config('app.version') }} - Error Code 404 - Page Not Found";
    </script>
@endsection
