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

                            <form id="formResetPassword">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm">
                                            <h6 class="alert-heading fw-bold mb-3">
                                                Tips Keamanan Password
                                            </h6>
                                            <ul class="mb-0">
                                                <li class="mb-2">
                                                    Jangan berikan
                                                    <b class="text-danger">
                                                        Password
                                                    </b>
                                                    Anda kepada orang lain.
                                                </li>
                                                <li class="mb-2">
                                                    Password harus memenuhi kriteria keamanan di bawah.
                                                </li>
                                                <li>
                                                    Gunakan password yang kuat untuk menjaga keamanan akun Simrsmu.
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Password Baru
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    id="password"
                                                    name="password"
                                                    placeholder="••••••••"
                                                    onkeydown="allowPasswordInput(event)"
                                                    oninput="sanitizePassword(this)"
                                                    required>
                                                <button
                                                    class="btn btn-sm btn-teal-transparent"
                                                    type="button"
                                                    onclick="togglePassword('password', this)">
                                                    <i class="ri-eye-line ms-2 me-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Konfirmasi Password
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    id="password_confirmation"
                                                    name="password_confirmation"
                                                    placeholder="••••••••"
                                                    onkeydown="allowPasswordInput(event)"
                                                    oninput="sanitizePassword(this)"
                                                    required>
                                                <button
                                                    class="btn btn-sm btn-teal-transparent"
                                                    type="button"
                                                    onclick="togglePassword('password_confirmation', this)">
                                                    <i class="ri-eye-line ms-2 me-2"></i>
                                                </button>
                                            </div>
                                            <small class="text-muted fs-11">Tuliskan kembali Password Baru Anda untuk konfirmasi.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="fs-14">
                                            Password Baru wajib memenuhi :
                                        </h6>

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item requirements text-danger py-2"
                                                id="req-length">
                                                <i class="ti ti-circle-check me-2"></i>
                                                Minimal 8 karakter
                                            </li>
                                            <li class="list-group-item requirements text-danger py-2"
                                                id="req-uppercase">
                                                <i class="ti ti-circle-check me-2"></i>
                                                Minimal 1 Huruf Kapital
                                            </li>
                                            <li class="list-group-item requirements text-danger py-2"
                                                id="req-number">
                                                <i class="ti ti-circle-check me-2"></i>
                                                Minimal 1 Angka
                                            </li>
                                            <li class="list-group-item requirements text-danger py-2"
                                                id="req-special">
                                                <i class="ti ti-circle-check me-2"></i>
                                                Minimal 1 Karakter Khusus (!@#$%^&*)
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="btn-group w-100 mt-4">
                                    <button
                                        type="button"
                                        class="btn btn-secondary-transparent" style="flex:2;"
                                        onclick="window.location.href='{{ route('v4.login') }}'">
                                        <i class="ri-arrow-left-s-line me-1"></i>
                                        Batalkan
                                    </button>

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                        id="btnReset" style="flex:4;"
                                        disabled>
                                        <i class="ri-lock-password-line me-1"></i>
                                        <span id="btnText">
                                            Reset Password
                                        </span>
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
                        <h3 class="fw-semibold lh-base">Reset Password 👋</h3>
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
        let loadingReset = false;

        function allowPasswordInput(e) {

            // tombol yang tetap diizinkan
            const allowedKeys = [
                'Backspace',
                'Delete',
                'Tab',
                'Escape',
                'Enter',
                'ArrowLeft',
                'ArrowRight',
                'ArrowUp',
                'ArrowDown',
                'Home',
                'End'
            ];

            if (allowedKeys.includes(e.key) || e.ctrlKey || e.metaKey) {
                return;
            }

            // hanya huruf, angka, dan !@#$%^&*
            const regex = /^[A-Za-z0-9!@#$%^&*]$/;

            if (!regex.test(e.key)) {
                e.preventDefault();
            }
        }

        function sanitizePassword(el) { // oninput digunakan sebagai pengaman kedua untuk menghapus karakter yang tidak diizinkan.
            el.value = el.value.replace(/[^A-Za-z0-9!@#$%^&*]/g, '');
            validateResetPassword();
        }

        function toggleReq(id,status)
        {
            if(status){
                $(id)
                .removeClass('text-danger')
                .addClass('text-success');
            }else{
                $(id)
                .removeClass('text-success')
                .addClass('text-danger');
            }
        }

        function validateResetPassword()
        {
            let password = $('#password').val();
            let confirm = $('#password_confirmation').val();
            let length = password.length >= 8;
            let uppercase = /[A-Z]/.test(password);
            let number = /[0-9]/.test(password);
            let special = /[!@#$%^&*]/.test(password);

            toggleReq('#req-length', length);
            toggleReq('#req-uppercase', uppercase);
            toggleReq('#req-number', number);
            toggleReq('#req-special', special);

            let valid =
                length &&
                uppercase &&
                number &&
                special &&
                password === confirm;

            $('#password_confirmation')
                .removeClass('is-valid is-invalid');

            if(confirm.length){
                if(password === confirm){
                    $('#password_confirmation')
                    .addClass('is-valid');
                }else{
                    $('#password_confirmation')
                    .addClass('is-invalid');
                }
            }

            $('#btnReset').prop('disabled', !valid);
        }

        function togglePassword(id, btn)
        {
            let input = document.getElementById(id);
            let icon = btn.querySelector('i');

            if(input.type === "password"){
                input.type = "text";
                icon.classList.remove('ri-eye-line');
                icon.classList.add('ri-eye-off-line');
            }else{
                input.type = "password";
                icon.classList.remove('ri-eye-off-line');
                icon.classList.add('ri-eye-line');
            }
        }

        $('#password,#password_confirmation').on('input',function(){
            validateResetPassword();
        });

        $('#formResetPassword').submit(function(e){
            e.preventDefault();

            if(loadingReset)
                return;

            loadingReset=true;
            let btn=$('#btnReset');

            $.ajax({
                url:"/api/v4/reset-password",
                method:"POST",
                data:new FormData(this),
                processData:false,
                contentType:false,
                beforeSend:function(){
                    btn.prop('disabled',true);
                    $('#btnText')
                    .html('Memproses...');
                },
                success:function(res){
                    Swal.fire({
                        title:'Berhasil',
                        text:res.message,
                        icon:'success',
                        timer:3000,
                        timerProgressBar:true
                    })
                    .then(()=>{
                        window.location.href="{{ route('v4.login') }}";
                    });
                },
                error:function(xhr){
                    Swal.fire({
                        title:'Informasi',
                        text:xhr.responseJSON?.message ?? 'Terjadi kesalahan',
                        icon:'error'
                    });
                },
                complete:function(){
                    loadingReset=false;
                    btn.prop('disabled',false);
                    $('#btnText')
                    .html('Reset Password');
                    validateResetPassword();
                }
            });
        });
    </script>
@endsection
