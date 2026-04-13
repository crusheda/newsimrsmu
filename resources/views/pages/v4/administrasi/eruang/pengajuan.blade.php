<form>
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="alert alert-light shadow-sm" role="alert">
                <h6 class="text-danger">Ketentuan Pengajuan</h6>
                <small><i class="ti ti-arrow-narrow-right me-1"></i> Peminjaman ruangan dapat dilakukan apabila ruangan tersebut tersedia/tidak terpakai dan pemilihan Jam & Menit tidak boleh sama</small><br>
                <small><i class="ti ti-arrow-narrow-right me-1"></i> Perubahan dan penghapusan data hanya dapat dilakukan sampai H-1 Acara & maksimal kurang dari Jam 12:00 WIB, tidak dalam kondisi ditolak oleh Admin, dan apabila sudah diverifikasi oleh bagian Gizi</small><br>
                <small><i class="ti ti-arrow-narrow-right me-1"></i> Permintaan khusus pada pesanan gizi dapat dilakukan dengan cara mengubah data setelah pengajuan</small><br>
                <small><i class="ti ti-arrow-narrow-right me-1"></i> Apabila sudah diverifikasi oleh bagian Gizi, maka peminjaman ruangan tidak dapat dihapus, akan tetapi Anda masih dapat mengubahnya dengan sepengetahuan bagian Gizi (Konfirmasi terlebih dahulu)</small><br>
                <small><i class="ti ti-arrow-narrow-right me-1"></i> Admin memiliki kuasa sepenuhnya untuk melakukan penolakan maupun penghapusan pengajuan apabila pada tgl dan jam tersebut bertepatan dengan acara yang lebih dipentingkan</small>
            </div>
        </div>

        <div class="col-md-12 mb-3" id="info_ketersediaan"></div>

        <label class="form-label">Pilih salah satu ruangan di bawah ini <a class="text-danger">*</a></label>

        <div class="col-md-12">
            <div class="row mb-0" id="loopRuangan">
                <div class="d-flex align-items-center mb-2">
                    <strong>Memuat Daftar Ruangan...</strong>
                    <div class="spinner-grow spinner-grow-sm text-primary ms-auto" role="status" aria-hidden="true"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Agenda Acara <a class="text-danger">*</a></label>
            <input type="text" id="agenda" class="form-control" placeholder="e.g. Rapat Paripurna Bagian **" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tuliskan nama acara"/>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Pilih Tanggal Acara <a class="text-danger">*</a></label>
            <div class="input-daterange input-group">
                <input type="text" id="tgl" class="form-control" placeholder="yyyy-mm-dd" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tanggal acara"/>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">
                Pilih Waktu Acara (<b class="text-warning">Format 24h</b>)
            </label>

            <div class="time-group">
                <div class="time-box">
                    <small>Jam Mulai <a class="text-danger">*</a></small>
                    <div class="time-input">
                        <input id="jam_mulai" class="form-control" type="text" placeholder="HH:mm">
                    </div>
                </div>

                <div class="time-box">
                    <small>Jam Selesai <a class="text-danger">*</a></small>
                    <div class="time-input">
                        <input id="jam_selesai" class="form-control" type="text" placeholder="HH:mm (Auto +1 Jam)">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label mb-0">Pesan Tambahan Untuk Bagian Gizi </label><br>
            <label class="form-label">(<b class="text-warning">isi nilai 0 apabila tidak diperlukan</b>)</label>
            <div class="input-daterange input-group" id="show_gizi1">
                <span class="input-group-text">Snack</span>
                <input type="number" class="form-control" disabled>
                <span class="input-group-text">Makan</span>
                <input type="number" class="form-control" disabled>
                <span class="input-group-text">Minum</span>
                <input type="number" class="form-control" disabled>
            </div>
            <div class="input-daterange input-group" id="show_gizi2" hidden>
                <span class="input-group-text pilih_snack">Snack</span>
                <input id="snack" type="number" class="form-control pilih_snack" value="0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Jumlah Permintaan Snack">
                <span class="input-group-text">Makan</span>
                <input id="makan" type="number" class="form-control" value="0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Jumlah Permintaan Makanan">
                <span class="input-group-text">Minum</span>
                <input id="minum" type="number" class="form-control" value="0" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Jumlah Permintaan Minuman">
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Keterangan Acara</label>
            <textarea rows="1" class="form-control" id="ket" placeholder="Optional"></textarea>
        </div>
    </div>

    <div class="col-md-12 d-flex justify-content-between">
        <button type="button" class="btn btn-info" onclick="window.location='{{ route('v4.administrasi.eruang') }}'" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Lihat Kalender Digital"><i class="fas fa-calendar-day me-1"></i> Kalender Digital</button>
        <button type="button" class="btn btn-success" id="btn-simpan" onclick="prosesSimpan()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Ajukan untuk melanjutkan proses Verifikasi Jadwal" disabled><i class="fas fa-stamp me-1"></i> Ajukan Sekarang</button>
    </div>
</form>

<script>
    let delayTimer;
    let disabledTimes = [];

    function toMinutes(t) {
        let [h, m] = t.split(":");
        return parseInt(h) * 60 + parseInt(m);
    }

    function isTimeOverlap(start1, end1, start2, end2) {
        start1 = toMinutes(start1);
        end1   = toMinutes(end1);
        start2 = toMinutes(start2);
        end2   = toMinutes(end2);

        return (start1 < end2 && end1 > start2);
    }

    function validateTimeSlot() {
        let mulai = $("#jam_mulai").val();
        let selesai = $("#jam_selesai").val();

        if (!mulai || !selesai) return;

        for (let r of disabledTimes) {
            if (isTimeOverlap(mulai, selesai, r.start, r.end)) {

                iziToast.error({
                    title: 'Bentrok Jadwal',
                    message: `Jam ${mulai} - ${selesai} bentrok dengan ${r.start} - ${r.end}`,
                    position: 'topRight',
                    timeout: 4000
                });

                // ❌ JANGAN clear input
                // $("#jam_mulai").val('');
                // $("#jam_selesai").val('');

                // 👉 opsional: kasih highlight biar jelas
                $("#jam_mulai, #jam_selesai").addClass("is-invalid");

                return;
            }
        }
        // kalau aman, hilangkan error
        $("#jam_mulai, #jam_selesai").removeClass("is-invalid");
    }

    function triggerCek() {
        clearTimeout(delayTimer);
        delayTimer = setTimeout(() => {
            let tgl = $("#tgl").val();

            verifSnackGiziTgl(tgl);
            cekKetersediaanRealtime();
        }, 300);
    }

    // $(document).on('change', '#tgl, #jam_mulai, #jam_selesai, input[name="ruangan"]', function () {
    //     cekKetersediaanRealtime();
    // });

    // $(document).on('change keyup', '#tgl, #jam_mulai, #jam_selesai, input[name="ruangan"]', triggerCek);
    $(document).on('change', '#tgl, #jam_mulai, #jam_selesai, input[name="ruangan"]', triggerCek);

    function loadRuangan() {
        const btn = $("#link_pengajuan");
        $.ajax({
            url: "/api/v4/administrasi/eruang/ruangan",
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $("#loopRuangan").empty().append(
                    `<div class="d-flex align-items-center mb-2">
                        <strong>Memuat Daftar Ruangan...</strong>
                        <div class="spinner-grow spinner-grow-sm text-primary ms-auto" role="status" aria-hidden="true"></div>
                    </div>`
                );
                $('#btn-simpan').prop('disabled', true);
                btn.prop('disabled', true).empty().append('<i class="fas fa-sync fa-spin me-1"></i> memuat...');
            },
            success: function(res) {
                $("#loopRuangan").empty();
                res.show.forEach(item => {
                    $("#loopRuangan").append(
                        `<div class="col-xl-3 col-sm-4">
                            <div class="border card p-3" style="margin-bottom: 14px">
                                <div class="form-check">
                                    <input type="radio" name="ruangan" class="form-check-input input-primary" id="ruangan${item.id}" value="${item.id}">
                                    <label class="form-check-label d-block ms-2" for="ruangan${item.id}">
                                        <span>
                                            <span class="h5 d-block">
                                                <strong class="float-end">
                                                    <span class="badge bg-light-primary">${item.kapasitas} P</span>
                                                </strong>${item.nama}
                                            </span>
                                            <span class="f-12 text-muted"><b class="font-weight-bold text-warning">Fasilitas</b> : ${item.fasilitas ?? '-'}</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>`
                    );
                });
                // resetFormPengajuan();
                $('#btn-simpan').prop('disabled', false);
            }, complete: function() {
                btn.prop('disabled', false).empty().append('Pengajuan');
            }, error: function(xhr, status, error) {
                $("#loopRuangan").empty().append(`<div class="d-flex align-items-center text-danger mb-2"><strong>${xhr.responseJSON.message ?? 'Terjadi kegagalan saat memproses data ruangan'}</strong></div>`);
                $('#btn-simpan').prop('disabled', true);
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat memproses data',
                    position: 'topRight'
                });
            }
        });
    }

    function refreshWithOpenRiwayat() {
        // reload table
        riwayat();
        // change active menu
        $("#link_pengajuan").removeClass("active");
        $("#link_display").removeClass("active");
        $("#link_riwayat").removeClass("active").addClass("active");
        $("#link_ruangan").removeClass("active");
        // change nav page
        $("#pengajuan").removeClass("active");
        $("#display").removeClass("active");
        $("#riwayat").removeClass("active").addClass("active");
        $("#ruangan").removeClass("active");
    }

    function cekKetersediaanRealtime() {

        let ruangan = $('input[name="ruangan"]:checked').val();
        let tgl = $("#tgl").val();
        let mulai = $("#jam_mulai").val();
        let selesai = $("#jam_selesai").val();

        if (!ruangan || !tgl || !mulai || !selesai) return;

        let tglArr = tgl.split(" to ");
        let tgl_mulai = tglArr[0];
        let tgl_selesai = tglArr[1] ?? tglArr[0];

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/api/v4/administrasi/eruang/cek',
            method: 'POST',
            data: {
                ruangan: ruangan,
                tgl_mulai: tgl_mulai,
                tgl_selesai: tgl_selesai,
                jam_mulai: mulai,
                jam_selesai: selesai,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $("#info_ketersediaan").html(
                    `<div class="alert alert-info py-2">Memeriksa ketersediaan ruangan...</div>`
                );
                $("#btn-simpan").prop("disabled", true);
            },
            success: function(res) {

                // 🔥 DISABLE TANGGAL
                if (res.disabled_dates && fpTanggal) {
                    fpTanggal.set('disable', res.disabled_dates);
                }

                // 🔥 DISABLE JAM
                disabledTimes = res.disabled_ranges || [];

                // 🔥 STATUS
                if (res.status) {
                    $("#info_ketersediaan").html(
                        `<div class="alert alert-success py-2">${res.message}</div>`
                    );
                    $("#btn-simpan").prop("disabled", false);
                } else {
                    $("#info_ketersediaan").html(
                        `<div class="alert alert-danger py-2">${res.message}</div>`
                    );
                    $("#btn-simpan").prop("disabled", true);
                }

                validateTimeSlot();
            },
            complete: function() {
                // $("#btn-simpan").prop("disabled", false);
            },
            error: function(xhr, status, error) {
                $("#info_ketersediaan").html(
                    `<div class="alert alert-danger py-2">${xhr.responseJSON.message ?? 'Terjadi kegagalan saat memeriksa ketersediaan ruangan'}</div>`
                );
                $("#btn-simpan").prop("disabled", true);
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: xhr.responseJSON.message ?? 'Terjadi kegagalan saat memeriksa ketersediaan ruangan',
                    position: 'topRight'
                });
            }
        });
    }

    function verifSnackGiziTgl(val) {

        if (!val) return;

        // 🔥 split range
        let tglArr = val.split(" to ");
        let tgl_mulai = tglArr[0];
        let tgl_selesai = tglArr[1] ?? tglArr[0];

        // 🔥 pakai tanggal mulai sebagai acuan utama
        let date = new Date();
        let tgl = new Date(tgl_mulai);

        tgl.setDate(tgl.getDate() - 1);

        let hmin1 = tgl.toLocaleDateString("sv-SE");
        let harih = new Date(tgl_mulai).toLocaleDateString("sv-SE");
        let hariini = new Date().toLocaleDateString("sv-SE");
        let jamSekarang = date.getHours();
        let today = new Date();
        today.setHours(0,0,0,0);

        if (new Date(tgl_selesai) < today) {
            iziToast.error({
                message: 'Range tanggal sudah lewat'
            });
            return;
        }

        // ================= LOGIC GIZI =================

        if (hmin1 > hariini) {

            $("#show_gizi1").prop('hidden', true);
            $("#show_gizi2").prop('hidden', false);
            $(".pilih_snack").prop('hidden', false);
            $(".validasiTgl").prop('disabled', false);

            // iziToast.warning({
            //     title: 'Pesan Admin!',
            //     message: 'Silakan menyesuaikan Jam Mulai dan Selesai',
            // });

        } else if (hmin1 == hariini) {

            $("#show_gizi1").prop('hidden', true);
            $("#show_gizi2").prop('hidden', false);
            $(".validasiTgl").prop('disabled', false);

            if (jamSekarang < 12) {
                $(".pilih_snack").prop('hidden', false);
            } else {
                $(".pilih_snack").prop('hidden', true);
            }

        } else {

            $("#show_gizi1").prop('hidden', true);
            $("#show_gizi2").prop('hidden', true);
            $(".pilih_snack").prop('hidden', true);

            if (harih == hariini) {
                $(".validasiTgl").prop('disabled', false);
            } else {
                $(".validasiTgl").prop('disabled', true);

                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Silakan memilih tanggal yang valid (Harus ≥ hari ini)',
                });
            }
        }
    }

    function prosesSimpan() {
        validateTimeSlot();

        let agenda = $("#agenda").val();
        let ruangan = $('input[name="ruangan"]:checked').val();
        let tgl = $("#tgl").val();
        let mulai = $("#jam_mulai").val();
        let selesai = $("#jam_selesai").val();

        // ================= VALIDASI FRONTEND =================
        if (!ruangan || !agenda || !tgl || !mulai || !selesai) {
            iziToast.warning({
                title: 'Validasi',
                message: 'Semua field wajib harus diisi',
                position: 'topRight'
            });
            return;
        }

        if (mulai >= selesai) {
            iziToast.warning({
                title: 'Validasi Jam',
                message: 'Jam selesai harus lebih besar dari jam mulai',
                position: 'topRight'
            });
            return;
        }

        // if (disabledTimes.includes($("#jam_mulai").val())) {
        //     iziToast.error({ message: 'Jam mulai sudah terpakai' });
        //     return;
        // }

        // if (disabledTimes.includes($("#jam_selesai").val())) {
        //     iziToast.error({ message: 'Jam selesai sudah terpakai' });
        //     return;
        // }

        // ================= LOADING =================
        $("#btn-simpan").prop('disabled', true);
        $("#btn-simpan i").attr("class", "fa fa-spinner fa-spin");

        let save = new FormData();
        save.append('agenda', agenda);
        save.append('ruangan', ruangan);
        save.append('tgl', tgl);
        save.append('jam_mulai', mulai);
        save.append('jam_selesai', selesai);
        save.append('ket', $("#ket").val());
        save.append('snack', $("#snack").val() || 0);
        save.append('makan', $("#makan").val() || 0);
        save.append('minum', $("#minum").val() || 0);

        $.ajax({
            url: '/api/v4/administrasi/eruang/store',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
            dataType: 'json',
            data: save,

            success: function(res) {
                if (res.code === 400) {
                    iziToast.error({ title: 'Error', message: res.message });
                } else {
                    iziToast.success({ title: 'Sukses', message: res.message });

                    $("form")[0].reset();
                    $("#btn-simpan").prop("disabled", true);

                    refreshWithOpenRiwayat();
                    resetFormPengajuan();
                }
            },

            error: function(res) {
                iziToast.error({
                    title: 'Error',
                    message: res.responseJSON?.message ?? 'Server error'
                });
            },

            complete: function() {
                $("#btn-simpan").prop('disabled', false);
                $("#btn-simpan i").attr("class", "fa fa-stamp");
            }
        });
    }

    function resetFormPengajuan() {

        // 🔹 Reset semua input form
        $("form")[0].reset();
        $('#agenda').val('');
        $('#ket').val('');

        // 🔹 Uncheck semua radio ruangan
        $('input[name="ruangan"]').prop('checked', false);

        // 🔹 Reset flatpickr (tanggal)
        if (typeof fpTanggal !== 'undefined') {
            fpTanggal.clear();
            fpTanggal.set('disable', []); // reset disable date
        }

        if (fpJamMulai) fpJamMulai.clear();
        if (fpJamSelesai) fpJamSelesai.clear();

        // 🔹 Reset disabled time range
        disabledTimes = [];

        // 🔹 Reset info ketersediaan
        $("#info_ketersediaan").html('');

        // 🔹 Reset validasi jam (hapus merah)
        $("#jam_mulai, #jam_selesai").removeClass("is-invalid");

        // 🔹 Reset gizi ke default (hidden awal)
        $("#show_gizi1").prop('hidden', false);
        $("#show_gizi2").prop('hidden', true);

        // 🔹 Disable tombol simpan lagi
        $("#btn-simpan").prop("disabled", true);

    }

</script>
