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

                            @if (session('status'))
                                <div class="alert alert-success mt-3 mb-3">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form id="formResetPassword" method="POST" action="{{ route('v4.password.email') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label text-default d-block">E-mail [<b class="text-orange">Terdaftar</b>/<b class="text-orange">Aktif</b>]</label>
                                    <input type="email" name="email" class="form-control" placeholder="Tuliskan Email Anda Disini ..." required>
                                    <a class="fs-12"><small><i class="ri-corner-down-right-line text-danger"></i> <i>Pastikan Anda mempunyai Akses menuju Email Aktif Anda</i></small></a>
                                </div>

                                <div class="btn-group w-100" role="group">
                                    <button
                                        type="button"
                                        class="btn btn-secondary-transparent"
                                        style="flex:1;"
                                        onclick="window.location.href='{{ route('v4.login') }}'">
                                        <i class="ri-arrow-left-s-line me-1"></i>
                                        Sign In
                                    </button>
                                    <button type="submit" class="btn btn-danger" id="btnReset" style="flex:4;">
                                        <span id="btnText"><i class="ri-mail-send-line me-1"></i> Kirim Link Reset Password</span>
                                        <span id="btnLoading" class="spinner-border spinner-border-sm d-none"></span>
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
                        <h3 class="fw-semibold lh-base">Lupa Password Akun??</h3>
                        <p class="mb-0 text-muted fw-medium">
                            Silakan klik tombol <b class="text-danger">Kirim Link Reset Password</b> untuk melakukan reset password akun dengan Email Aktif Anda. Selanjutnya silakan Cek pada <b class="text-primary">Email Masuk</b> untuk melanjutkan proses Reset Password.
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

    document
    .getElementById('formResetPassword')
    .addEventListener('submit', function(e){

        let btn = document.getElementById('btnReset');
        let text = document.getElementById('btnText');
        let loading = document.getElementById('btnLoading');

        console.log('submit jalan');

        btn.disabled = true;
        btn.style.pointerEvents = 'none';

        text.innerHTML = 'Memproses Pengiriman Email Reset...';

        loading.classList.remove('d-none');

    });

    </script>
@endsection
