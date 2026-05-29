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
                <div class="card custom-card dashboard-main-card secondary school-card flex-wrap">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2 justify-content-between">
                            <div> <span class="d-block mb-1 text-muted">Jabatan</span>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <div id="jabatan-wrapper"><i class="fas fa-sync-alt fa-spin ms-1"></i></div>
                                </div>
                            </div>
                            <div class="lh-1">
                                <span class="avatar avatar-lg bg-secondary-transparent svg-secondary">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                        viewBox="0 0 24 24" width="24px" fill="#5f6368">
                                        <g>
                                            <rect fill="none" height="24" width="24"></rect>
                                        </g>
                                        <g>
                                            <path
                                                d="M20,7h-5V4c0-1.1-0.9-2-2-2h-2C9.9,2,9,2.9,9,4v3H4C2.9,7,2,7.9,2,9v11c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V9 C22,7.9,21.1,7,20,7z M9,12c0.83,0,1.5,0.67,1.5,1.5S9.83,15,9,15s-1.5-0.67-1.5-1.5S8.17,12,9,12z M12,18H6v-0.75c0-1,2-1.5,3-1.5 s3,0.5,3,1.5V18z M13,9h-2V4h2V9z M18,16.5h-4V15h4V16.5z M18,13.5h-4V12h4V13.5z">
                                            </path>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-body text-center position-relative">
                        <img src="{{ asset('images/white.jpg') }}" alt="Foto Profil" class="img-thumbnail rounded-pill" id="fotoProfil" style="width:auto;height:auto;max-width:300px;max-height:450px;object-fit:cover">
                        <!-- LOADING -->
                        <div id="avatarLoading"
                            class="position-absolute top-50 start-50 translate-middle">
                            <div class="spinner-border text-dark custom-spinner"></div>
                        </div>
                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Pengalaman Kerja
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0" id="pengalaman_kerja"><i class="fas fa-sync-alt fa-spin ms-1"></i></p>
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
                                    <i class="ri-user-2-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    Status Pegawai :
                                </span>
                                <a id="status_jabatan"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
                            </div>
                            <div class="mb-2 d-flex align-items-center gap-1 flex-wrap">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-shield-user-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    Username :
                                </span>
                                <a id="name"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
                            </div>
                            <div class="mb-2 d-flex align-items-center gap-1 flex-wrap">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-file-user-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    NIP :
                                </span>
                                <a id="nip"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
                            </div>
                            <div class="mb-2 d-flex align-items-center gap-1 flex-wrap">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-pass-valid-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    NIK :
                                </span>
                                <a id="nik"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
                            </div>
                            <div class="mb-2 d-flex align-items-center gap-1 flex-wrap">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-mail-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    Email :
                                </span>
                                <a id="email"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
                            </div>
                            <div class="mb-2 d-flex align-items-center gap-1 flex-wrap">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-phone-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    No.HP :
                                </span>
                                <a id="hp"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
                            </div>
                            <div class="mb-2 d-flex align-items-center gap-1 flex-wrap">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-history-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    Terakhir Login :
                                </span>
                                <a id="log_akun"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
                            </div>
                            <div class="mb-0 d-flex align-items-center gap-1">
                                <span class="avatar avatar-sm avatar-rounded text-default">
                                    <i class="ri-rotate-lock-line align-middle fs-15"></i>
                                </span>
                                <span class="fw-medium text-default">
                                    Terakhir Ubah Password :
                                </span>
                                <a id="last_update_password"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
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
                                        <a href="javascript:void(0);" rel="noopener noreferrer" class="text-muted">
                                            Facebook
                                            /
                                            <span id="fb">
                                                <i class="fas fa-sync-alt fa-spin ms-1"></i>
                                            </span>
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
                                        <a href="javascript:void(0);" rel="noopener noreferrer" class="text-muted">
                                            Instagram
                                            /
                                            <span id="ig">
                                                <i class="fas fa-sync-alt fa-spin ms-1"></i>
                                            </span>
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
                                        <a href="javascript:void(0);" rel="noopener noreferrer" class="text-muted">
                                            Tiktok
                                            /
                                            <span id="tt">
                                                <i class="fas fa-sync-alt fa-spin ms-1"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            {{-- <li class="list-group-item">
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
                                            <span class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-decoration-underline">
                                                rspkusukoharjo
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </li> --}}
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
                                    Nama Lengkap + Gelar
                                </p>
                                <p class="mb-0">
                                    <a id="nama_lengkap"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">
                                    Nama
                                    Panggilan
                                </p>
                                <p class="mb-0">
                                    <a id="nick"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
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
                                    <a id="temp_lahir"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">
                                    Tanggal
                                    Lahir (Umur)
                                </p>
                                <p class="mb-0">
                                    <a id="tgl_lahir"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
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
                                    <a id="jk"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">
                                    Status Kawin
                                </p>
                                <p class="mb-0">
                                    <a id="sk"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
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
                        <p class="mb-0"><a id="alamat_ktp"><i class="fas fa-sync-alt fa-spin ms-1"></i></a></p>
                    </li>
                    <li class="list-group-item px-0 pb-0">
                        <p class="mb-1 text-muted">
                            Alamat Domisili
                        </p>
                        <p class="mb-0"><a id="alamat_dom"><i class="fas fa-sync-alt fa-spin ms-1"></i></a></p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Data Pendidikan</div>
            </div>
            <div class="card-body">
                <ul class="list-unstyled timeline-list-3" id="list_pendidikan">
                    <li class="text-muted">Memuat Data Pendidikan <i class="fas fa-sync-alt fa-spin ms-1"></i></li>
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
                            <p class="mb-0"><a id="rp"><i class="fas fa-sync-alt fa-spin ms-1"></i></a></p>
                        </div>
                    </li>
                    <li class="list-group-item d-sm-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto text-muted">
                            <div class="fw-medium fs-14 text-default">
                                Riwayat Penyakit
                                Keluarga?
                            </div>
                            <p class="mb-0"><a id="rpk"><i class="fas fa-sync-alt fa-spin ms-1"></i></a></p>
                        </div>
                    </li>
                    <li class="list-group-item d-sm-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto text-muted">
                            <div class="fw-medium fs-14 text-default">
                                Riwayat
                                Penggunaan Obat?
                            </div>
                            <p class="mb-0"><a id="rpo"><i class="fas fa-sync-alt fa-spin ms-1"></i></a></p>
                        </div>
                    </li>
                    <li class="list-group-item d-sm-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto text-muted">
                            <div class="fw-medium fs-14 text-default">
                                Riwayat Operasi?
                            </div>
                            <p class="mb-0"><a id="ro"><i class="fas fa-sync-alt fa-spin ms-1"></i></a></p>
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

    // function formatTanggalJam(datetime) {
    //     if (!datetime) return '-';

    //     const [date, time] = datetime.split(' ');
    //     const [year, month, day] = date.split('-');
    //     const [hour, minute] = time.split(':');

    //     const bulan = [
    //         'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
    //         'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    //     ];

    //     return `${parseInt(day)} ${bulan[parseInt(month) - 1]} ${year} ${hour}.${minute} WIB`;
    // }

    function hitungUmurLengkap(tanggalLahir) {

        if (!tanggalLahir) return '-';

        const lahir = new Date(tanggalLahir);
        const hariIni = new Date();

        let tahun = hariIni.getFullYear() - lahir.getFullYear();
        let bulan = hariIni.getMonth() - lahir.getMonth();
        let hari = hariIni.getDate() - lahir.getDate();

        // jika hari minus
        if (hari < 0) {

            bulan--;

            // ambil jumlah hari bulan sebelumnya
            const lastMonth = new Date(
                hariIni.getFullYear(),
                hariIni.getMonth(),
                0
            );

            hari += lastMonth.getDate();
        }

        // jika bulan minus
        if (bulan < 0) {
            tahun--;
            bulan += 12;
        }

        return `${tahun} Tahun ${bulan} Bulan ${hari} Hari`;
    }

    function loadDataDiri() {
        const btn = $("#btn-load-datadiri");
        $.ajax({
            url: `/api/v4/sdi/profilpegawai/datadiri/${id_pegawai}`,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $('#avatarLoading').show();
                btn.prop('disabled', true).empty().append('<i class="fas fa-sync fa-spin me-1"></i> memuat...');
            },
            success: function(res) {
                if (!res.status) {
                    Swal.fire('Info', res.message, 'info');
                    return;
                }

                if (res.data.user && res.data.user.deleted_at !== null) {
                    Swal.fire({
                        title: 'Mohon Perhatian!!',
                        text: 'Pegawai ini telah dinonaktifkan atau dihapus. Hanya dapat melihat data diri dan riwayat lainnya.',
                        icon: 'info',
                        timer: 5000,
                        timerProgressBar: true
                    });
                }

                let roles = res.data.role;
                let html = '';

                // ===== HANYA 1 ROLE =====
                if(roles.length === 1){

                    html = `
                        <h5 class="fw-semibold mb-0">
                            ${roles[0].deskripsi ?? roles[0].nama_role}
                        </h5>
                    `;

                }
                // ===== BANYAK ROLE =====
                else if(roles.length > 1){

                    html = `<ul class="mb-0 ps-3">`;

                    roles.forEach(r=>{
                        html += `<li>${r.deskripsi ?? r.nama_role}</li>`;
                    });

                    html += `</ul>`;
                }
                // ===== TIDAK ADA ROLE =====
                else{

                    html = `<span class="text-muted">Tidak ada jabatan</span>`;

                }

                $('#jabatan-wrapper').html(html);

                let defaultImg = "{{ asset('images/pku/user.png') }}";

                if(res.data.foto_user == null){

                    // tidak ada foto
                    $('#fotoProfil').attr('src', defaultImg);
                    $('#imgProfil').attr('src', defaultImg);

                }else{

                    // ada foto
                    let fotoUrl = "{{ url('storage') }}/" + res.data.foto_user.filename.replace('public/','');

                    $('#fotoProfil').attr('src', fotoUrl);
                    $('#imgProfil').attr('src', fotoUrl);
                }

                nama_lengkap = '';
                if (res.data.user && res.data.user.nama_lengkap) {
                    nama_lengkap = res.data.user.nama_lengkap;
                } else if (res.data.user.nama) {
                    nama_lengkap = res.data.user.nama;
                } else {
                    nama_lengkap = res.data.user.name;
                }

                $('#username').text(nama_lengkap);
                $('#id-pegawai').html(`<span class="badge bg-purple-gradient">ID PEGAWAI: ${res.data.user?.id ?? 'xx'}</span>`);
                $('#name').html(`<b>${res.data.user?.name ?? 'xx'}</b>`);
                $('#log_akun').empty().append(res.data.log_user?.log_date ? formatTanggalJam(res.data.log_user.log_date) : '-');
                $('#status_jabatan').text(res.data.status_user?.nama_status || 'Tidak Diketahui');
                $('#status_akun').html(res.data.user?.deleted_at == null ? '<span class="badge bg-success-gradient">Akun Aktif</span>' : '<span class="badge bg-danger-gradient">Akun Dinonaktifkan</span>');
                $('#pengalaman_kerja').text(res.data.user?.pengalaman_kerja ?? 'Tidak ada deskripsi pengalaman kerja.');

                $('#nip').text(res.data.user?.nip ?? '-');
                $('#nik').text(res.data.user?.nik ?? '-');
                $('#email').text(res.data.user?.email ?? '-');
                if (res.data.user && res.data.user.email) {
                    $('#email').attr('href',`mailto:${res.data.user.email}`);
                }
                if (res.data.user && res.data.user.no_hp) {
                    $('#hp').text(res.data.user.no_hp)
                    if (res.data.user.no_hp.startsWith('628')) {
                        $('#hp').attr('href', `https://wa.me/${res.data.user.no_hp}`).attr('target', '_blank');
                    } else {
                        $('#hp').removeAttr('href');
                    }
                } else {
                    $('#hp').text('-')
                }
                $('#fb').empty().append(res.data.user?.fb ? `${res.data.user.fb}` : 'xx');
                if (res.data.user && res.data.user.fb) {
                    $('#fb').addClass('link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-decoration-underline').closest('a').attr('href', `https://www.facebook.com/${res.data.user.fb}`).attr('target','_blank');
                }
                $('#ig').empty().append(res.data.user?.ig ? `${res.data.user.ig}` : 'xx');
                if (res.data.user && res.data.user.ig) {
                    $('#ig').addClass('link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-decoration-underline').closest('a').attr('href', `https://www.facebook.com/${res.data.user.ig}`).attr('target','_blank');
                }
                $('#tt').empty().append(res.data.user?.tt ? `${res.data.user.tt}` : 'xx');
                if (res.data.user && res.data.user.tt) {
                    $('#tt').addClass('link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-decoration-underline').closest('a').attr('href', `https://www.facebook.com/@${res.data.user.tt}`).attr('target','_blank');
                }
                $('#nama_lengkap').text(nama_lengkap);
                $('#nick').text(res.data.user?.nick ?? '-');
                $('#temp_lahir').text(res.data.user?.temp_lahir ?? '-');

                tgl_lahir = res.data.user?.tgl_lahir ? formatTanggal(res.data.user.tgl_lahir) : '';
                umur = hitungUmurLengkap(res.data.user?.tgl_lahir);
                if (tgl_lahir && umur) {
                    $('#tgl_lahir').html(`${tgl_lahir} (<b class="text-info">${umur}</b>)`);
                } else if (tgl_lahir) {
                    $('#tgl_lahir').text(tgl_lahir);
                } else {
                    $('#tgl_lahir').text(res.data.user?.tgl_lahir ? formatTanggal(res.data.user.tgl_lahir) : '-');
                }

                $('#jk').text(res.data.user?.jns_kelamin ?? '-');
                $('#sk').text(res.data.user?.status_kawin ?? '-');
                $('#alamat_ktp').text(res.data.user?.alamat_ktp ?? '-');
                $('#alamat_dom').text(res.data.user?.alamat_dom ?? 'Sama dengan Alamat pada KTP.');

                renderPendidikan(res.data.user);

                $('#rp').text(res.data.user?.riwayat_penyakit ?? 'Tidak Ada.');
                $('#rpk').text(res.data.user?.riwayat_penyakit_keluarga ?? 'Tidak Ada.');
                $('#rpo').text(res.data.user?.riwayat_penggunaan_obat ?? 'Tidak Ada.');
                $('#ro').text(res.data.user?.riwayat_operasi ?? 'Tidak Ada.');

                // PAGE password
                $('#last_update_password').text(formatTanggalJam(res.data.user?.last_update_password) ?? '-')
            }, error: function(xhr, status, error) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat memproses data',
                    position: 'topRight'
                });
            },
            complete: function() {
                $('#avatarLoading').hide();
                $('#imgProfil').removeClass('loading');
                btn.prop('disabled', false).empty().html('<i class="ti ti-user-check me-2"></i>Data Diri');
            }
        })
    }

    function buildPendidikan(user) {
        return [
            { jenjang: 'SD',  jurusan: user.sd,  tahun: user.th_sd,  color: 'primary' },
            { jenjang: 'SMP', jurusan: user.smp, tahun: user.th_smp, color: 'info' },
            { jenjang: 'SMA', jurusan: user.sma, tahun: user.th_sma, color: 'success' },
            { jenjang: 'D1',  jurusan: user.d1,  tahun: user.th_d1,  color: 'warning' },
            { jenjang: 'D2',  jurusan: user.d2,  tahun: user.th_d2,  color: 'warning' },
            { jenjang: 'D3',  jurusan: user.d3,  tahun: user.th_d3,  color: 'warning' },
            { jenjang: 'S1',  jurusan: user.s1,  tahun: user.th_s1,  color: 'danger' },
            { jenjang: 'S2',  jurusan: user.s2,  tahun: user.th_s2,  color: 'danger' },
            { jenjang: 'S3',  jurusan: user.s3,  tahun: user.th_s3,  color: 'danger' },
        ].filter(item => item.jurusan); // hanya yang terisi
    }

    function renderPendidikan(user) {
        const items = buildPendidikan(user);
        const $list = $('#list_pendidikan');

        $list.empty();

        if (!items.length) {
            $list.append('<li class="text-muted">Data pendidikan tidak tersedia</li>');
            return;
        }

        items.forEach((item, index) => {
            $list.append(`
                <li>
                    <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                        <div class="fw-semibold fs-15">
                            <span class="text-muted">
                                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-decoration-underline"
                                role="button">
                                    ${item.jurusan}
                                </a>
                            </span>
                        </div>
                        <span class="badge bg-${item.color}-transparent">
                            Lulus ${item.tahun ?? 'xxx'}
                        </span>
                    </div>
                    <div class="fs-13 text-muted">
                        Telah selesai Pendidikan jenjang
                        <span class="fw-medium text-default">${item.jenjang}</span>
                        di
                        <span class="fw-medium text-default">${item.jurusan}</span>
                        ${item.tahun ? ` pada tahun ${item.tahun}` : ''}.
                    </div>
                </li>
            `);
        });
    }
</script>
