<div class="card custom-card">
    <div class="card-header fw-bold justify-content-between">
        <div>
            Ubah
            <b class="text-danger">
                Password
            </b>
        </div>
        <div>
            (
            <span class="text-danger">
                *
            </span>
            ) Wajib Diisi
        </div>
    </div>
    <form id="formPassword" class="needs-validation" novalidate>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <div class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm"
                        role="alert">
                        <h6 class="alert-heading fw-bold mb-3">
                            Keamanan Password
                        </h6>
                        <ul>
                            <li class="mb-2">
                                Jangan berikan
                                <strong class="text-danger fw-bold">
                                    Password
                                </strong>
                                anda kepada
                                orang lain
                            </li>
                            <li class="mb-2">
                                Password akan
                                diproses melalui
                                metode
                                <i class="text-dark fw-bold">
                                    Bcrypt Hash
                                    Password
                                </i>
                                oleh sistem
                            </li>
                            <li class="mb-2">
                                Apabila anda
                                lupa Password
                                akun Simrsmu,
                                silakan masuk ke
                                laman
                                <b class="text-danger fw-bold">
                                    Lupa
                                    Password
                                </b>
                                pada halaman
                                Login
                            </li>
                            <li class="mb-2">Password Baru harus memenuhi kriteria yang sudah tertera di bawah</li>
                            <li>Tombol Perbarui Password akan <b class="text-success">Aktif</b> apabila <b class="text-info fw-bold">Password Baru</b> dan <b class="text-info fw-bold">Konfirmasi Password Baru</b> sudah sesuai kriteria</li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">
                            Password Lama
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <input type="password" class="form-control" id="oldPassword"
                            name="current_password" autoComplete="current-password"
                            placeholder="••••••••••" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Password Baru
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <input type="password" class="form-control" id="newPassword"
                            name="new_password" autoComplete="new_password" onkeydown="allowPasswordInput(event)" oninput="sanitizePassword(this)"
                            placeholder="••••••••••" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Konfirmasi Password
                            Baru
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <input type="password" class="form-control" id="confirmPassword"
                            name="new_password_confirmation" onkeydown="allowPasswordInput(event)" oninput="sanitizePassword(this)"
                            autoComplete="new_password_confirmation" placeholder="••••••••••"
                            required />
                        <small>
                            Tuliskan password
                            baru yang sama untuk
                            konfirmasi password
                            baru Anda
                        </small>
                    </div>
                </div>

                <div class="col-sm-6">
                    <h6>
                        Password Baru Anda harus
                        memenuhi kriteria
                        sebagai berikut :
                    </h6>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item requirements" id="req-length">
                            <i class="ti ti-circle-check f-16 me-2"></i>
                            Melebihi 8 karakter
                        </li>
                        <li class="list-group-item requirements" id="req-uppercase">
                            <i class="ti ti-circle-check f-16 me-2"></i>
                            Minimal 1 Huruf Kapital (A-Z)
                        </li>
                        <li class="list-group-item requirements" id="req-number">
                            <i class="ti ti-circle-check f-16 me-2"></i>
                            Minimal 1 Angka (0-9)
                        </li>
                        <li class="list-group-item requirements" id="req-special">
                            <i class="ti ti-circle-check f-16 me-2"></i>
                            Minimal 1 Karakter Khusus (!@#$%^&*)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer btn-page">
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <div class="fs-semibold fs-14">
                    <p class="card-text align-middle">
                        <small>
                            Terakhir password
                            diperbarui :
                        </small>
                        <br />
                        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-decoration-underline" role="button" id="last_update_password">...</a>
                    </p>
                </div>
                <button class="btn btn-secondary" type="submit" id="btn-submit-password" disabled>
                    <i class="ri-rocket-2-line me-1"></i>
                    Perbarui
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    let loading = false;

    $(document).ready(function() {

        $('#newPassword, #confirmPassword').on('input', function () {
            validatePassword();
        });

        $('#formPassword').on('submit', function(e){

            e.preventDefault();
            if(loading) return;

            let form = this;
            let btn  = $('#btn-submit-password');

            if(!form.checkValidity()){
                form.classList.add('was-validated');
                Swal.fire('Info','Lengkapi semua field password','info');
                return;
            }

            loading = true;

            let formData = new FormData(form);

            $.ajax({
                url:'/api/v4/profil/password',
                type:'POST',
                data:formData,
                processData:false,
                contentType:false,
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend:function(){
                    btn.prop('disabled',true)
                    .html('<i class="ri-loader-4-line ri-spin me-1"></i> Memproses...');
                },
                success:function(res){

                    if(!res.status){
                        Swal.fire({
                            title:'Informasi!',
                            text:res.message,
                            icon:'warning',
                            timer:4000,
                            timerProgressBar:true
                        });
                        return;
                    }

                    Swal.fire({
                        title:'Yeayy!',
                        text:res.message,
                        icon:'success',
                        timer:4000,
                        timerProgressBar:true
                    });

                    // reset form
                    form.reset();
                    form.classList.remove('was-validated');

                    $('.requirements').removeClass('text-success').addClass('text-danger');
                    $('#confirmPassword').removeClass('is-valid is-invalid');

                    validatePassword();

                    $('#last_update_password').text(res.last_update_password+' WIB');

                },
                error:function(xhr){

                    Swal.fire({
                        title:'Ahh Maaf!!',
                        text:xhr.responseJSON?.message ?? 'Terjadi kesalahan',
                        icon:'error',
                        timer:6000,
                        timerProgressBar:true
                    });

                },
                complete:function(){
                    loading = false;
                    btn.prop('disabled',false).html('<i class="ri-rocket-2-line me-1"></i> Perbarui');
                }
            });

        });
    })

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

    function toggleRequirement(id, status) {
        if (status) {
            $(id).removeClass('text-danger').addClass('text-success');
        } else {
            $(id).removeClass('text-success').addClass('text-danger');
        }
    }

    function validatePassword() {

        let password = $('#newPassword').val();
        let confirm = $('#confirmPassword').val();

        let length = password.length >= 8;
        let uppercase = /[A-Z]/.test(password);
        let number = /[0-9]/.test(password);
        let special = /[!@#$%^&*]/.test(password);

        toggleRequirement('#req-length', length);
        toggleRequirement('#req-uppercase', uppercase);
        toggleRequirement('#req-number', number);
        toggleRequirement('#req-special', special);

        let allValid = length && uppercase && number && special;

        // RESET confirm dulu
        $('#confirmPassword').removeClass('is-valid is-invalid');

        // Confirm password
        if(confirm.length > 0){
            if(password === confirm){
                $('#confirmPassword').addClass('is-valid');
            }else{
                $('#confirmPassword').addClass('is-invalid');
            }
        }

        // Enable submit
        $('#btn-submit-password').prop(
            'disabled',
            !(allValid && password === confirm)
        );
    }
</script>
