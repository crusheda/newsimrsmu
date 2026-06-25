<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password Akun SIMRS MU</title>
</head>

<body style="margin:0;padding:30px;background:#f4f7fb;font-family:Arial,Helvetica,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#fff;border-radius:15px;overflow:hidden;box-shadow:0 5px 25px rgba(0,0,0,.08);">
                    <tr>
                        <td style="padding:30px;text-align:center;">
                            <img src="https://simrsmu.com/images/logo/logo_full_text_light.png" alt="SIMRS MU"
                                style="width:300px;height:auto;display:block;margin:auto;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="height:6px;background:#0d6efd;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:35px;color:#333;">
                            <h3 style="font-size:22px;margin:0 0 25px;">
                                Yth. {{ $user->nama ?? $user->name }},
                            </h3>
                            <p style="font-size:16px;line-height:1.8;">
                                Kami menerima permintaan untuk melakukan reset password akun Anda
                                pada website
                                <a href="https://simrsmu.com" style="color:#0d6efd;text-decoration:none;">
                                    <strong>simrsmu.com</strong>
                                </a>.
                            </p>
                            <p style="font-size:16px;line-height:1.8;">
                                Untuk melanjutkan proses reset password dan membuat password baru,
                                silakan klik tombol berikut:
                            </p>
                            <div style="text-align:center;margin:35px 0;">
                                <a href="{{ $url }}"
                                    style="background:#0d6efd;
                                            color:#fff;
                                            padding:16px 35px;
                                            border-radius:10px;
                                            text-decoration:none;
                                            font-weight:bold;
                                            font-size:16px;
                                            display:inline-block;
                                            ">
                                    🔐 Reset Password Akun Saya
                                </a>
                            </div>
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="background:#eef6ff;border-radius:12px;border:1px solid #cfe2ff;">
                                <tr>
                                    <td style="padding:20px;">
                                        <h4 style="margin:0;color:#0d6efd;font-size:18px;">
                                            ⏱ Informasi Penting
                                        </h4>
                                        <p style="margin:10px 0 0;font-size:15px;line-height:1.7;color:#444;">
                                            Link reset password ini hanya berlaku dalam waktu tertentu.
                                            Segera lakukan perubahan password setelah menerima email ini.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="background:#fff7e6;border-radius:12px;border:1px solid #ffe0a3;">
                                <tr>
                                    <td style="padding:20px;">
                                        <h4 style="margin:0;color:#d98200;font-size:18px;">
                                            🛡 Perhatian Keamanan
                                        </h4>
                                        <p style="margin:10px 0 0;font-size:15px;line-height:1.7;color:#555;">
                                            Jangan memberikan link reset password ini kepada orang lain.
                                            Jika Anda tidak merasa melakukan permintaan reset password,
                                            abaikan email ini. Akun Anda tetap aman.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <p style="margin-top:35px;font-size:15px;line-height:1.7;">
                                Terima kasih telah menggunakan layanan
                                <a href="https://simrsmu.com" style="color:#0d6efd;text-decoration:none;">
                                    <strong>SIMRS MU</strong>
                                </a>.
                            </p>
                            <p style="font-size:15px;">
                                Salam,<br>
                                <strong>Tim Sakudewa Tech ⚡</strong>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#064dbb;padding:25px;color:#fff;text-align:center;">
                            <img src="https://simrsmu.com/images/logo/full-horizontal-hd-white.png" alt="SIMRS MU"
                                style="width:160px;height:auto;margin-bottom:15px;">
                            <p style="font-size:12px;margin:0;opacity:.8;">
                                Email ini dikirim otomatis oleh sistem.<br>
                                Mohon tidak membalas email ini.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
