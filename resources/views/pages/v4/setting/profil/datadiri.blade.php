<div class="row">
    <div class="col-xxl-4">
        <div class="row">
            <div class="col-xl-12" hidden>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center gap-4">
                            <div class="text-center">
                                <h3 class="fw-semibold mb-1">
                                    13,264
                                </h3>
                                <span class="d-block text-muted">
                                    Followers
                                </span>
                            </div>
                            <div class="vr"></div>
                            <div class="text-center">
                                <h3 class="fw-semibold mb-1">
                                    7,238
                                </h3>
                                <span class="d-block text-muted">
                                    Following
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Pengalaman Kerja
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0">Tidak ada deskripsi pengalaman kerja.</p>
                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Data Sensitif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-muted">
                            <div class="mb-2 d-flex align-items-center gap-1 flex-wrap">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-file-user-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    NIP :
                                </span>
                                {user?.nip ||
                                "-"}
                            </div>
                            <div class="mb-2 d-flex align-items-center gap-1 flex-wrap">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-pass-valid-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    NIK :
                                </span>
                                {user?.nik ||
                                "-"}
                            </div>
                            <div class="mb-2 d-flex align-items-center gap-1 flex-wrap">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-mail-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    Email :
                                </span>
                                {user?.email ||
                                "-"}
                            </div>
                            <div class="mb-0 d-flex align-items-center gap-1">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-phone-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    No.HP :
                                </span>
                                {user?.no_hp ||
                                "-"}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card custom-card overflow-hidden">
                    <div class="card-header">
                        <div class="card-title">
                            Media Sosial
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush social-media-list">
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <div>
                                        <span class="avatar avatar-md bg-primary-transparent">
                                            <i class="ri-facebook-circle-fill fs-4"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <span class="d-block fw-medium">
                                            Facebook
                                        </span>
                                        <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer"
                                            class="text-muted">
                                            Facebook
                                            /
                                            <mark>
                                                {user?.fb ||
                                                "xxx"}
                                            </mark>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <div>
                                        <span class="avatar avatar-md bg-secondary-transparent">
                                            <i class="ri-instagram-fill fs-4"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <span class="d-block fw-medium">
                                            Instagram
                                        </span>
                                        <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"
                                            class="text-muted">
                                            Instagram
                                            /
                                            <mark>
                                                {user?.ig ||
                                                "xxx"}
                                            </mark>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <div>
                                        <span class="avatar avatar-md bg-dark-transparent">
                                            <i class="ri-tiktok-fill fs-20"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <span class="d-block fw-medium">
                                            Tiktok
                                        </span>
                                        <a href="https://www.tiktok.com/@" target="_blank" rel="noopener noreferrer"
                                            class="text-muted">
                                            Tiktok
                                            /
                                            <mark>
                                                {user?.tt ||
                                                "xxx"}
                                            </mark>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <div>
                                        <span class="avatar avatar-md bg-danger-transparent">
                                            <i class="ri-youtube-fill fs-20"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <span class="d-block fw-medium">
                                            Youtube
                                            <b class="text-danger">
                                                RS
                                            </b>
                                        </span>
                                        <a href="https://www.youtube.com/@rspkumuhsukoharjo1801" target="_blank"
                                            rel="noopener noreferrer" class="text-muted">
                                            Youtube
                                            /
                                            <mark>
                                                rspkusukoharjo
                                            </mark>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-8">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Data Identitas
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 pt-0">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">
                                    Nama Lengkap
                                </p>
                                <p class="mb-0">
                                    {user?.nama ||
                                    "..."}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">
                                    Nama
                                    Panggilan
                                </p>
                                <p class="mb-0">
                                    {user?.nick ||
                                    "..."}
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">
                                    Tempat Lahir
                                </p>
                                <p class="mb-0">
                                    {user?.temp_lahir ||
                                    "..."}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">
                                    Tanggal
                                    Lahir
                                </p>
                                <p class="mb-0">
                                    {user?.tgl_lahir
                                    ? dayjs(
                                    user.tgl_lahir
                                    ).format(
                                    "D MMMM YYYY"
                                    )
                                    : "..."}
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">
                                    Jenis
                                    Kelamin
                                </p>
                                <p class="mb-0">
                                    {user?.jns_kelamin ||
                                    "..."}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">
                                    Status Kawin
                                </p>
                                <p class="mb-0">
                                    {user?.status_kawin ||
                                    "..."}
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0">
                        <p class="mb-1 text-muted">
                            Alamat Lengkap
                            <strong class="text-danger">
                                Sesuai KTP
                            </strong>
                        </p>
                        <p class="mb-0">...</p>
                    </li>
                    <li class="list-group-item px-0 pb-0">
                        <p class="mb-1 text-muted">
                            Alamat Domisili
                        </p>
                        <p class="mb-0">Sama dengan alamat pada KTP</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Data Pendidikan
                </div>
            </div>
            <div class="card-body">
                <ul class="list-unstyled timeline-list-3">
                    <li key={index}>
                        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                            <div class="fw-semibold fs-15">
                                <span class="text-muted">
                                    <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-decoration-underline"
                                        role="button">
                                        {
                                        item.jurusan
                                        }
                                    </a>
                                </span>
                            </div>
                            <span class="badge bg-${item.color}-transparent">
                                Lulus
                                {item.tahun ||
                                "xxx"}
                            </span>
                        </div>
                        <div class="fs-13 text-muted">
                            Telah
                            selesai
                            Pendidikan
                            jenjang
                            <span class="fw-medium text-default">
                                {
                                item.jenjang
                                }
                            </span>
                            di
                            <span class="fw-medium text-default">
                                {
                                item.jurusan
                                }
                            </span>
                            {item.tahun
                            ? " pada tahun " +
                            item.tahun
                            : ""}
                            .
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Data Kesehatan
                </div>
            </div>
            <div class="card-body">
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item d-sm-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto text-muted">
                            <div class="fw-medium fs-14 text-default">
                                Riwayat
                                Penyakit?
                            </div>
                            <p class="mb-0">Tidak Ada.</p>
                        </div>
                    </li>
                    <li class="list-group-item d-sm-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto text-muted">
                            <div class="fw-medium fs-14 text-default">
                                Riwayat Penyakit
                                Keluarga?
                            </div>
                            <p class="mb-0">Tidak Ada.</p>
                        </div>
                    </li>
                    <li class="list-group-item d-sm-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto text-muted">
                            <div class="fw-medium fs-14 text-default">
                                Riwayat
                                Penggunaan Obat?
                            </div>
                            <p class="mb-0">Tidak Ada.</p>
                        </div>
                    </li>
                    <li class="list-group-item d-sm-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto text-muted">
                            <div class="fw-medium fs-14 text-default">
                                Riwayat Operasi?
                            </div>
                            <p class="mb-0">Tidak Ada.</p>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    });

    function loadDataDiri() {
        $.ajax({
            url: "/api/v4/profil/show",
            type: 'GET',
            dataType: 'json',
            xhrFields: {
                withCredentials: true
            },
            success: function(res) {

            },
            error: function(xhr) {
                console.log(xhr.status, xhr.responseText);
            }
        })
    }
</script>
