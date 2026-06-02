<div class="row mb-3">
    <div class="col-xxl-12 mb-3">
        <div class="alert alert-light shadow-sm" role="alert">
            <small><i class="ti ti-arrow-narrow-right me-1"></i> Pengajuan Peminjaman Ruangan dapat diverifikasi oleh Bagian Gizi Mulai dari <span class="badge bg-primary-transparent">H-1 Acara setelah Pukul 12:00 WIB</span> sampai <span class="badge bg-danger-transparent">Hari H Acara Pukul 23:59 WIB</span></small><br>
            <small><i class="ti ti-arrow-narrow-right me-1"></i> Data yang ditampilkan diurutkan berdasarkan <span class="badge bg-info-transparent">Tanggal Terdekat</span> lalu berdasarkan <strong>Jam dari yang paling Awal</strong></small><br>
            <small><i class="ti ti-arrow-narrow-right me-1"></i> Display diperbarui secara otomatis per 5 menit sekali dengan tampilan yang dibatasi (<strong>5 Antrean</strong>)</small>
        </div>
    </div>
    <div class="col-xxl-3">
        <div class="position-relative">
            <select class="select2 form-control validasiTgl" id="tampil_gizi_ruangan" style="width: 100%" data-bs-auto-close="outside" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Pilih salah satu/Kosongi untuk menampilkan semua Ruangan">
                <option value="" selected hidden>Pilih Ruangan</option>
                @if (!empty($list['ruangan']))
                    @foreach ($list['ruangan'] as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->kapasitas }} Peserta)</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-xxl-2">
        <div class="position-relative">
            <div id="datepicker1">
                <input type="text" class="form-control" id="tampil_gizi_tgl" placeholder="Pilih Tanggal" data-date-format="yyyy-mm-dd" data-date-container='#datepicker1' data-date-autoclose="true" data-provide="datepicker" required>
            </div>
        </div>
    </div>
    <div class="col-xxl-3">
        <div class="position-relative">
            <select class="select2 form-control" id="tampil_gizi_status" style="width: 100%" data-bs-auto-close="outside" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Pilih Status Verifikasi">
                <option value="0" hidden>Semua Data</option>
                <option value="1" selected>Belum Diverifikasi</option>
                <option value="2">Sudah Diverifikasi</option>
                <option value="3">Ditolak</option>
            </select>
        </div>
    </div>
    <div class="col-xxl-4" id="start-display">
        <div class="position-relative h-100 hstack gap-3">
            <button type="submit" class="btn btn-primary h-100 w-100" id="btn-tampil-gizi" onclick="showDisplay()"><i class="fas fa-tv align-middle me-1"></i> Tampilkan Display</button>
        </div>
    </div>
    <div class="col-xxl-4" id="stop-display" hidden>
        <div class="position-relative h-100 hstack gap-3">
            <button type="submit" class="btn btn-danger h-100 w-100" id="btn-tampil-gizi" onclick="stopDisplay()"><i class="fas fa-times align-middle me-1"></i> Berhenti <span class="badge bg-light text-dark ms-1" id="detik"></span></button>
        </div>
    </div>
</div>

{{-- START DISPLAY --}}
<div class="row" id="show_tampil_display">
    <div class="row justify-content-center mt-lg-5">
        <div class="col-xl-5 col-sm-8">
            <div class="text-center">
                <div class="row justify-content-center mt-2 mb-2">
                    <div class="col-sm-6 col-8">
                        <img src="{{ asset('images/verification-img.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END DISPLAY -->

<script>
    function showDisplay() {
        // clearInterval(interval);
        display();
        setInterval(function() {
            display();
        }, 300000); // 1000 = 1 detik
        $("#tampil_gizi_ruangan").prop('disabled', true);
        $("#tampil_gizi_tgl").prop('disabled', true);
        $("#tampil_gizi_status").prop('disabled', true);
        $("#btn-tampil-gizi").prop('disabled', true);
        $("#stop-display").prop('hidden', false);
        $("#start-display").prop('hidden', true);
        // setInterval(function() {
        //     display();
        // }, 8000);
        // setTimeout(display(), 10000);
    }

    function stopDisplay() {
        clearInterval();
        $('#show_tampil_display').empty();
        $('#show_tampil_display').append(`
            <div class="row justify-content-center mt-lg-5">
                <div class="col-xl-5 col-sm-8">
                    <div class="text-center">
                        <div class="row justify-content-center mt-2 mb-2">
                            <div class="col-sm-6 col-8">
                                <img src="{{ asset('images/verification-img.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);
        $("#detik").html('');
        $("#tampil_gizi_ruangan").prop('disabled', false);
        $("#tampil_gizi_tgl").prop('disabled', false);
        $("#tampil_gizi_status").prop('disabled', false);
        $("#btn-tampil-gizi").prop('disabled', false);
        $("#stop-display").prop('hidden', true);
        $("#start-display").prop('hidden', false);
    }

    function verifGizi(id) {
        $.ajax({
            url: "/api/v4/administrasi/eruang/gizi/verif/"+id,
            type: 'get',
            success: function(res) {
                iziToast.success({
                    title: 'Pesan Sukses!',
                    message: 'Status Gizi dengan ID : '+id+' Berhasil di verifikasi',
                    position: 'topRight'
                });
                stopDisplay();
                showDisplay();
            },
            error: function(res) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Verifikasi gagal dilakukan',
                    position: 'topRight'
                });
            }
        });
    }

    function display() {
        console.log(new Date().getHours());
        $("#show_tampil_display").empty().append(
            `<center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>`
        );
        var getInputRuangan = $("#tampil_gizi_ruangan").val();
        var getInputTgl = $("#tampil_gizi_tgl").val();
        var getInputStatus = $("#tampil_gizi_status").val();
        $.ajax({
            url: "/api/v4/administrasi/eruang/display?ruangan="+getInputRuangan+"&tgl="+getInputTgl+"&status="+getInputStatus,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                $("#show_tampil_display").empty();
                if (res.show == '') {
                    $('#show_tampil_display').append(`<center><h6 class='mt-3'>Data Peminjaman Ruangan Tidak Ada Pada Tanggal <b class='text-danger'>`+getInputTgl+`</b></h6></center>`);
                } else {
                    res.show.forEach(item => {
                        var val = item.tgl;
                        var date = new Date();
                        var tgl = new Date(val);
                        tgl.setDate(tgl.getDate()-1);
                        var hmin1 = tgl.toLocaleDateString("sv-SE");
                        var harih = new Date(val).toLocaleDateString("sv-SE");
                        var hariini = new Date().toLocaleDateString("sv-SE");
                        var jamSekarang = date.getHours();

                        var valid = 0;
                        if (hmin1 == hariini) {
                            if (jamSekarang >= 12) {
                                valid = 1;
                            }
                        } else {
                            if (harih == hariini) {
                                valid = 1;
                            }
                        }

                        content = ``;
                        content += `<div class="col-xl-4 col-sm-6 d-flex align-items-stretch">`;
                                    if (item.status_penolakan == null) {
                                        if (item.gizi_verif == null) {
                                            if (harih < hariini) {
                                                content += `<div class="card border border-5 border-secondary" style="width:100%">`;
                                            } else {
                                                if (valid == 1) {
                                                    content += `<div class="card border border-5 border-primary" style="width:100%">`;
                                                } else {
                                                    content += `<div class="card border border-5 border-warning" style="width:100%">`;
                                                }
                                            }
                                        } else {
                                            content += `<div class="card border border-5 border-success" style="width:100%">`;
                                        }
                                    } else {
                                        content += `<div class="card border border-5 border-danger" style="width:100%">`;
                                    }
                                content += `<div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-4">
                                                        <img src="${item.foto_profil?'/storage/'+item.foto_profil.substr(7,1000):'/images/pku/user.png'}" class="user-avtar wid-60 rounded-circle" alt="Avatar" style="width: 60px;height:60px">
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden text-dark">
                                                        <h4 class="text-truncate font-size-20"><a href="javascript: void(0);">${item.status_penolakan?'<s>'+item.nama_ruangan+'</s>':item.nama_ruangan}</a></h4>
                                                        <p class="mb-0 mt-1">
                                                            <i class="ti ti-arrow-narrow-right text-primary me-1"></i> <b>Agenda :</b> ${item.agenda}<br>
                                                            <i class="ti ti-arrow-narrow-right text-primary me-1"></i> <b>User :</b> ${item.nama_user?item.nama_user:'Tidak Ada Nama'} (${item.no_hp?item.no_hp:'-'})<br>
                                                            <i class="ti ti-arrow-narrow-right text-primary me-1"></i> <b>Pesanan Gizi :</b>
                                                            <p style="white-space: pre-line">${item.gizi?item.gizi:''}</p>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="px-3 py-2 border-top">
                                                <ul class="list-inline mb-0 text-dark">
                                                    <li class="list-inline-item me-3 mt-1">
                                                        <i class="ti ti-calendar-plus me-1"></i> ${item.tgl}
                                                    </li>
                                                    <li class="list-inline-item me-3 mt-1">
                                                        <i class="ti ti-clock me-1"></i> ${item.jam_mulai.substring(0,5)} - ${item.jam_selesai.substring(0,5)} WIB
                                                    </li>
                                                    <div class="float-end">`;
                                                    if (item.status_penolakan == null) {
                                                        if (item.gizi_verif == null) {
                                                            if (harih < hariini) {
                                                                content += `<button class="btn btn-secondary avtar-s mb-0 btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Gagal Verifikasi" disabled><i class="ti ti-check"></i></button>`;
                                                            } else {
                                                                if (valid == 1) {
                                                                    content += `<button class="btn btn-primary avtar-s mb-0 btn-sm" onclick="verifGizi(${item.id})" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Verifikasi Sekarang"><i class="ti ti-check me-1"></i> Verifikasi</button>`;
                                                                } else {
                                                                    content += `<button class="btn btn-warning avtar-s mb-0 btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Verifikasi Belum Dapat Dilakukan"><i class="ti ti-check"></i></button>`;
                                                                }
                                                            }
                                                        } else {
                                                            content += `<button class="btn btn-success avtar-s mb-0 btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Sudah Terverifikasi"><i class="ti ti-checks"></i></button>`;
                                                        }
                                                    } else {
                                                        content += `<button class="btn btn-danger avtar-s mb-0 btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Pengajuan Ditolak"><i class="ti ti-x"></i></button>`;
                                                    }

                                        content += `</div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>`;
                        $('#show_tampil_display').append(content);
                    })
                }

                // Showing Tooltip
                $('[data-bs-toggle="tooltip"]').tooltip({
                    trigger: 'hover'
                })

                // UPDATED
                $("#detik").html('Pukul '+res.now+' (Per 5 Menit)');
            }
        })
    }
</script>
