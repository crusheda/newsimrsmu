@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    <b class="text-secondary link-underline-secondary text-decoration-underline">Elektronik</b> <b class="text-primary link-underline-primary text-decoration-underline">Ruangan</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Administrasi</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        E-Ruang
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="overflow: visible;">

                        {{-- MY CONTENT --}}
                        <ul class="nav nav-tabs border-0 tab-style-7" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link text-dark active" id="link_pengajuan" data-bs-toggle="tab" href="#pengajuan" role="tab" onclick="loadRuangan()">
                                    Pengajuan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" id="link_riwayat" data-bs-toggle="tab" href="#riwayat" role="tab">
                                    Riwayat
                                </a>
                            </li>
                            @if (Auth::user()->can('admin_eruang_gizi'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" id="link_display" data-bs-toggle="tab" href="#display" role="tab">
                                        Display Gizi
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->can('admin_eruang'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" id="link_ruangan" data-bs-toggle="tab" href="#ruangan" role="tab">
                                        Manajemen Ruangan
                                    </a>
                                </li>
                            @endif
                        </ul>

                        <div class="tab-content">

                            {{-- Pengajuan E-Ruang --}}
                            <div class="tab-pane active" id="pengajuan" role="tabpanel">
                                @include('pages.v4.administrasi.eruang.pengajuan')
                            </div>

                            {{-- Riwayat E-Ruang --}}
                            <div class="tab-pane table-responsive" id="riwayat" role="tabpanel">
                                @include('pages.v4.administrasi.eruang.riwayat')
                            </div>

                            {{-- Display Gizi --}}
                            <div class="tab-pane" id="display" role="tabpanel" style="height:auto">
                                @include('pages.v4.administrasi.eruang.display')
                            </div>

                            {{-- Manajemen Ruangan --}}
                            <div class="tab-pane" id="ruangan" role="tabpanel">
                                @include('pages.v4.administrasi.eruang.ruangan')
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let fpTanggal, fpTanggalEdit, fpJamMulai, fpJamSelesai, fpJamMulaiEdit, fpJamSelesaiEdit;
        let isAdmin = @json(Auth::user()->can('admin_eruang'));

        $(document).ready(function() {
            // SELECT2
            var te = $(".select2");
            te.length && te.each(function() {
                var es = $(this);
                es.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    dropdownParent: es.parent()
                })
            });
            var te = $(".select2unit");
            te.length && te.each(function() {
                var es = $(this);
                es.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih Unit",
                    dropdownParent: es.parent()
                })
            });

            // INIT DATE&TIMEPICKER FORM PENGAJUAN ---------------
            $("#filter_tgl").flatpickr({ // FILTER TANGGAL RIWAYAT
                mode: "single",
                // minDate: "today",
                dateFormat: "Y-m-d",

            });
            $("#tampil_gizi_tgl").flatpickr({ // FILTER TANGGAL RIWAYAT
                mode: "single",
                defaultDate: "today",
                dateFormat: "Y-m-d",

            });
            fpTanggal = $("#tgl").flatpickr({
                mode: "range",
                minDate: "today",
                dateFormat: "Y-m-d",
                onChange: function() {
                    triggerCek();
                }
            });
            fpJamMulai = flatpickr("#jam_mulai", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });

            fpJamSelesai = flatpickr("#jam_selesai", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });
            $(".time-input").on("click", function () {
                $(this).find("input")[0]._flatpickr.open();
            });

            // INITIALIZE PAGE
            loadRuangan();
            riwayat();
            if (isAdmin) {
                refreshTableRuangan();
            }

            $("#jam_mulai, #jam_selesai").on("change", function () {
                let mulai = $("#jam_mulai").val();
                let selesai = $("#jam_selesai").val();

                if (mulai && !selesai) {
                    let [h, m] = mulai.split(":");

                    let date = new Date();
                    date.setHours(parseInt(h));
                    date.setMinutes(parseInt(m));

                    date.setHours(date.getHours() + 1);

                    let newTime = date.toTimeString().slice(0,5);

                    // pakai flatpickr API biar sinkron
                    fpJamSelesai.setDate(newTime, true);
                } else {
                    if (mulai && selesai) {
                        if (mulai >= selesai) {
                            iziToast.warning({
                                title: 'Validasi',
                                message: 'Jam selesai harus lebih besar dari jam mulai',
                                position: 'topRight'
                            });

                            $("#jam_selesai").val('');
                        }
                    }
                }
            });

            $("input, textarea").on("input change", function () {
                let valid =
                    $('input[name="ruangan"]:checked').val() &&
                    $("#agenda").val() &&
                    $("#tgl").val() &&
                    $("#jam_mulai").val() &&
                    $("#jam_selesai").val();

                $("#btn-simpan").prop("disabled", !valid);
            });
        });
    </script>
@endsection
