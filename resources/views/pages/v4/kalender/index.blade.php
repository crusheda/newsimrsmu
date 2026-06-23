@extends('layouts.v4')

@section('content')

    <style>
        #calendar {
            max-width: 100% !important;
            /* width: 100%; */
            /* margin: 0 auto; */
            /* background: #fff; */
            border-radius: 10px;
            /* padding: 10px; */
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        #calendar .fc-scrollgrid-section-sticky > * {
            background: transparent !important;
        }
    </style>

    <div class="container-fluid page-container main-body-container shadow-sm">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Kalender <b class="text-primary link-underline-primary text-decoration-underline">Digital</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Publik</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Kalender Digital
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card custom-card mb-3">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info-transparent rounded" onclick="window.location='{{ route('v4.administrasi.eruang') }}'"
                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tambah Agenda / Kegiatan di E-Ruang">
                                <i class="fa-fw fas fa-plus-square nav-icon me-1"></i> Tambah Agenda <span class="badge bg-secondary d-none d-md-inline ms-1 p-1">E-Ruang</span>
                            </button>
                        </div>
                        <h6 class="ms-2 mb-0 fs-13">Klik <span class="badge text-bg-primary">BARIS KALENDER</span> untuk melihat <span class="text-orange fw-bold"><i>Detail Acara</i></span></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container-fluid page-container main-body-container"> --}}
        <div id="calendar" class="main-body-container calendar mt-3 p-4"><center><i class="fa-fw fas fa-spinner fa-spin nav-icon me-1"></i> Memuat Kalender...</center></div>
    {{-- </div> --}}

    <div class="modal fade" id="calendar-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="calendar-modal-title f-w-600 text-truncate">Modal title</h6><a href="#"
                        class="avtar avtar-s btn-link-danger btn-pc-default ms-auto" data-bs-dismiss="modal"><i
                            class="ti ti-x f-20"></i></a>
                </div>
                <div class="modal-body">
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-xs bg-light-secondary"><i class="ti ti-heading f-20"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1"><b class="text-orange">Agenda</b> / <b class="text-orange">Kegiatan</b></h6>
                            <p class="pc-event-title text-muted fs-20"></p>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-xs bg-light-warning"><i class="ti ti-map-pin f-20"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1"><b>Ruangan</b></h6>
                            <p class="pc-event-venue text-muted"></p>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-xs bg-light-danger"><i class="ti ti-calendar-event f-20"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1"><b>Waktu</b></h6>
                            <p class="pc-event-date text-muted"></p>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-xs bg-light-primary"><i class="ti ti-file-text f-20"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1"><b>Keterangan</b></h6>
                            <p class="pc-event-description text-muted"></p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-xs bg-light-info"><i class="ti ti-user-check f-20"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1"><b>Ditambahkan Oleh</b></h6>
                            <p class="pc-event-user text-muted"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <p class="pc-event-created"></p>
                    {{-- <ul class="list-inline me-auto mb-0">
                        <li class="list-inline-item align-bottom"><a href="#" id="pc_event_remove"
                                class="avtar avtar-s btn-link-danger btn-pc-default w-sm-auto" data-bs-toggle="tooltip"
                                title="Delete"><i class="ti ti-trash f-18"></i></a></li>
                        <li class="list-inline-item align-bottom"><a href="#" id="pc_event_edit"
                                class="avtar avtar-s btn-link-success btn-pc-default" data-bs-toggle="tooltip"
                                title="Edit"><i class="ti ti-edit-circle f-18"></i></a></li>
                    </ul> --}}
                    <div class="flex-grow-1 text-end"><button type="button" class="btn btn-secondary-transparent"
                            data-bs-dismiss="modal">Tutup</button></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            loadCalendar();

            document.querySelectorAll(
                '#calendar .fc-col-header-cell-cushion, #calendar .fc-daygrid-day-number'
            ).forEach(el => {
                el.style.setProperty('color', '#212529', 'important');
            });

            // 🔹 Jika punya dropdown filter ruangan
            $('#filter-unit').on('change', function() {
                loadCalendar($(this).val());
            });
        });

        function loadCalendar(unit = null) {

            $('#calendar').html('');

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'id',
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                },
                themeSystem: "bootstrap",
                selectable: true,
                editable: false,
                dayMaxEvents: true,

                events: {
                    url: '/api/v4/kalender/data',
                    method: 'GET',
                    extraParams: {
                        unit: unit
                    },
                    failure: function() {
                        alert('Gagal memuat data event!');
                    }
                },

                eventDidMount: function(info) {
                    info.el.style.backgroundColor = info.event.backgroundColor;
                    info.el.style.borderColor = info.event.backgroundColor;
                    info.el.style.color = info.event.textColor;
                },

                eventClick: function(info) {
                    let ev = info.event;
                    let ket = ev.extendedProps.ket ?? '-';
                    let ruangan = ev.extendedProps.ruangan ?? '-';
                    let addedBy = ev.extendedProps.added_by ?? '-';
                    let addedAt = ev.extendedProps.added_at ?? '-';

                    // Format tanggal ke: Senin, 1 Desember 2025
                    let start = new Date(ev.start);
                    let end = ev.end ? new Date(ev.end) : null;

                    const hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
                    const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

                    function formatJam(tgl) {
                        let jam = String(tgl.getHours()).padStart(2, '0');
                        let menit = String(tgl.getMinutes()).padStart(2, '0');
                        return `${jam}:${menit}`;
                    }

                    let tglText = `${hari[start.getDay()]}, ${start.getDate()} ${bulan[start.getMonth()]} ${start.getFullYear()}`;

                    let jamMulai = formatJam(start);
                    let jamSelesai = end ? formatJam(end) : jamMulai;

                    let finalDateText = `${tglText} Pukul ${jamMulai} - ${jamSelesai} WIB`;

                    // Isi modal
                    $('.calendar-modal-title').html('<span class="badge bg-purple-gradient me-1">Detail Acara</span> '+ev.title);
                    $('.pc-event-title').empty().html("<b class='text-uppercase'>"+ev.title+"</b>");
                    $('.pc-event-venue').text(ruangan);
                    $('.pc-event-date').text(finalDateText);
                    $('.pc-event-description').text(ket);
                    $('.pc-event-user').text(addedBy);
                    $('.pc-event-created').text('Ditambahkan pada '+new Date(addedAt).toLocaleString("sv-SE"));

                    // Tampilkan modal
                    $('#calendar-modal').modal('show');
                }
            });

            calendar.render();

            // FOR DARK MODE
            new MutationObserver(() => {
                // 1. day number
                document.querySelectorAll('.fc-daygrid-day-number[style]').forEach(el => {
                    el.removeAttribute('style');
                });

                // 2. header day (Min, Sen, dll)
                document.querySelectorAll('.fc-col-header-cell-cushion[style]').forEach(el => {
                    el.removeAttribute('style');
                });

            }).observe(calendarEl, {
                subtree: true,
                attributes: true
            });
        }
    </script>
@endsection
