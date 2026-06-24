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

                            <form method="POST" action="{{ route('v4.password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">

                                <div class="mb-3">
                                    <label class="form-label text-default">Password Baru</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-default"><b class="text-orange">Konfirmasi</b> Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>

                                <div class="btn-group w-100" role="group">
                                    <button
                                        type="button"
                                        class="btn btn-secondary-transparent"
                                        style="flex:1;"
                                        onclick="window.location.href='{{ route('v4.login') }}'">
                                        <i class="ri-arrow-left-s-line me-1"></i>
                                        Batalkan
                                    </button>
                                    <button class="btn btn-danger">
                                        <i class="ri-lock-password-line me-1"></i> Reset Password
                                    </button>
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
@endsection
