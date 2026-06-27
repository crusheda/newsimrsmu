@extends('layouts.v4')

@section('content')
    <div class="row pt-1">
        <div class="col-xl-12 mb-3">
            <div class="card custom-card podcast-banner-card border-0 shadow-none">
                <div class="card-body">
                    <div class="podcast-banner-card-background"> <img src="{{ asset('/images/media/backgrounds/6.png') }}" alt=""> </div>
                    <div class="row">
                        <div class="col-xl-8"> <span class="badge bg-primary rounded-pill">Sumber Daya Insani</span>
                            <h6 class="fw-semibold mt-3">Selamat {{ $headerUser['waktu'] }},</h6>
                            <h2 class="fw-semibold">{{ $headerUser['nama_full'] }}</h2>
                            <p class="fs-16 mb-3 text-dark"> Sudahkan Anda Membaca Peraturan Kepegawaian ? </p>
                            {{-- <div class="fw-medium text-primary mb-4">Telah dibaca sebanyak <i class="ti ti-music mx-1"></i>
                                <span class="ms-2 text-default fs-12 op-8"><i class="ri-play-circle-line fs-13 mx-1"></i>260.517/ Monthly Listenders</span>
                            </div> --}}
                            <div class="btn-list">
                                <button class="btn btn-lg btn-primary btn-w-lg" data-bs-toggle="modal" data-bs-target="#peraturan-kepegawaian"> Baca Selengkapnya </button>
                                {{-- <button class="btn btn-lg btn-primary-ghost btn-w-lg">  </button> --}}
                            </div>
                            <p class="card-text mt-3"><small class="text-muted">Ditetapkan mulai <cite title="Source Title"><strong><u>1 Juli 2023</u></strong></cite></small></p>
                        </div>
                        <div class="col-xl-4">
                            <img src="{{ asset('/images/pku/all-group-users.png') }}" alt="" class="podcast-banner-img img-fluid d-md-block d-none h-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="peraturan-kepegawaian" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalCenterTitle">Peraturan Kepegawaian <span class="badge text-bg-danger p-1">1 Juli 2023</span></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="_df_book" source="{{ asset('/doc/073_PR_PERATURAN_PERUSAHAAN_2024.pdf') }}"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-transparent" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            warnAgePassword();
        });

        function warnAgePassword() {
            let expired = @json($list['expired']);
            let expiredDate = @json($list['expiredDate']);

            if (expired == true) {
                Swal.fire({
                    title: 'Mohon Perhatian!!',
                    html: `
                        Password Anda telah berusia <b class='text-danger fs-18'>${expiredDate} hari</b><br>
                        Segera Perbarui Password Anda. Usia Passowrd Maks. <b>90 Hari</b>
                    `,
                    icon: 'warning',

                    showCloseButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                    showCancelButton: true,
                    focusConfirm: true,

                    timer: undefined,
                    timerProgressBar: false,

                    confirmButtonText: `
                        <i class="ri-lock-line me-1"></i> Ubah Password
                    `,
                    cancelButtonText: `
                        <i class="ri-close-line me-1"></i> Tutup
                    `,

                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary-transparent'
                    },

                    buttonsStyling: false,
                    backdrop: `
                        rgb(54 22 22 / 40%)
                        url("/images/nyan-cat.gif")
                        left top
                        no-repeat
                    `

                }).then((result) => {

                    if (result.isConfirmed) {
                        window.location.href = "{{ route('v4.profil') }}";
                    }

                });
            }
        }
    </script>
@endsection
