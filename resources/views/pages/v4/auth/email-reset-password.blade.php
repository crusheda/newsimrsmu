<!DOCTYPE html>
<html>
<body style="background:#f5f6fa;padding:30px">

    <div style="max-width:600px;
                margin:auto;
                background:white;
                padding:30px;
                border-radius:10px;
                ">

        <h2>
            SIMRS MU
        </h2>

        <p>
            Halo {{ $user->name }},
        </p>

        <p>
            Kami menerima permintaan reset password akun Anda.
        </p>

        <a href="{{ $url }}"
            style="background:#0d6efd;
                    color:white;
                    padding:12px 20px;
                    border-radius:6px;
                    text-decoration:none;
                    ">
            Reset Password
        </a>

        <p style="margin-top:30px">
            Jika Anda tidak meminta reset password,
            abaikan email ini.
        </p>
    </div>

</body>
</html>
