<div class="row g-3">
    <div class="col-md-6 status-aktif" hidden>
        <div class="card shadow-none border mb-0 h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 me-3">
                        <h6 class="mb-0">NIP (Nomor Induk Pegawai)</h6>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-warning" disabled>NIP THL Terakhir : <u id="show_nip_thl_terakhir">000</u></button>
                            <button class="btn btn-sm btn-info" disabled>NIP Terakhir : <u id="show_nip_terakhir">000</u></button>
                        </div>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <div class="alert alert-secondary">
                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Apabila karyawan baru (Non THL), NIP bersifat otomatis<br>
                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Format <b>WAJIB</b> NIP <mark><b><u>KHUSUS THL</u></b></mark> adalah <u><b class="text-danger">THL</b></u> . <u><b class="text-warning">Tahun Masuk</b></u> . <u><b class="text-primary">Nomor Urutan</b></u>
                                                                                    <i class="fas fa-long-arrow-alt-right ms-1 me-2"></i><b><i> (Contoh : THL.25.001)</i></b><br>
                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Format <b>WAJIB</b> NIP Pegawai adalah <u><b class="text-danger">Tahun Masuk</b></u> . <u><b class="text-warning">Bulan Masuk</b></u> . <u><b class="text-primary">Nomor Urutan</b></u>
                                                                                    <i class="fas fa-long-arrow-alt-right ms-1 me-2"></i><b><i> (Contoh : 19.12.314)</i></b><br>
                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Gunakan Titik (.) sebagai pemisah. Tidak Diperbolehkan ada SPASI ' '<br>
                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Lakukan dengan teliti dan hati-hati dalam pengisian NIP, karena NIP bersifat <b class="text-info">UNIK</b>
                    </div>
                    <div class="row">
                        <div class="col"><input type="text" class="form-control" id="nip_pgw" maxlength="10" placeholder="Tuliskan NIP Pegawai (Wajib sesuai dengan Format)"></div>
                        <div class="col-auto"><button class="btn btn-light-primary" onclick="prosesSimpanNIP()" id="btn-simpan-nip"><i class="fas fa-save me-1"></i> Simpan</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 status-aktif" hidden>
        <div class="card shadow-none border mb-0 h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 me-3">
                        <h6 class="mb-0">Klasifikasi Pegawai</h6>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <div class="alert alert-secondary">
                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Nakes (dokter, perawat, bidan, penata anestesi, dll)<br>
                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Nakesla (Ahli gizi, Rehab Medik, ATLM, Apoteker, TTK, Radiografer, Rekam Medik)<br>
                        <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Non Nakes (Selain Nakes dan Nakesla)
                    </div>
                    <div class="row">
                        <div class="col"><select class="form-control" id="klasifikasi_pgw"></select></div>
                        <div class="col-auto"><button class="btn btn-light-primary" onclick="prosesSimpanKlasifikasiPgw()" id="btn-simpan-klasifikasi"><i class="fas fa-save me-1"></i> Simpan</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 status-aktif" hidden>
        <div class="card shadow-none border mb-0 h-100">
            <div class="card-body">
                <div class="alert alert-secondary">
                    <i class="ti ti-arrow-narrow-right text-primary me-1"></i> TMT (Tanggal Mulai Tugas) <span class="text-danger">*</span><br>
                    <i class="ti ti-arrow-narrow-right text-primary me-1"></i> TAT (Tanggal Akhir Tugas)
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label"><b>TMT</b> <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tmt">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><b>TAT</b></label>
                                    <input type="date" class="form-control" id="tat">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto"><button class="btn btn-light-primary" onclick="prosesSimpanTattmt()" id="btn-simpan-tattmt"><i class="fas fa-save me-1"></i> Simpan</button></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 status-aktif" hidden>
        <div class="card shadow-none border mb-0 h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 me-3">
                        <h6 class="mb-0">Profesi Pegawai (<b class="text-info">Sub Klasifikasi</b>)</h6>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <div class="alert alert-secondary">
                        <div class="row">
                            <div class="col-md-12">
                                <center><h6>Contoh <mark>Profesi</mark> seperti di bawah ini</h6></center><hr>
                            </div>
                            <div class="col-md-6">
                                <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Dokter<br>
                                <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Perawat<br>
                                <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Bidan<br>
                            </div>
                            <div class="col-md-6">
                                <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Penata Anestesi<br>
                                <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Apoteker<br>
                                <i class="ti ti-arrow-narrow-right text-primary me-1"></i> dll
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"><select class="form-control" id="profesi_pgw"></select></div>
                        <div class="col-auto"><button class="btn btn-light-primary" onclick="prosesSimpanProfesiPgw()" id="btn-simpan-profesi"><i class="fas fa-save me-1"></i> Simpan</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 status-aktif" hidden>
        <div class="card shadow-none border mb-0">
            <div class="card-body">
                <h6 class="mb-3">Hapus Akun</h6>
                <p class="mb-3">Apakah Anda yakin ingin menghapus akun ini?<br>
                    Hapus akun dapat mengakibatkan <strong>Pengguna tidak dapat masuk kembali ke dalam sistem</strong> dan berstatus <strong>Non Aktif</strong>.
                    Lakukan dengan hati-hati karena data Akun Pengguna/Penghapus akan tercatat sebagai penerima risiko yang ada.
                </p>
                <button class="btn btn-light-danger" onclick="showHapusPegawai()"><i class="fas fa-trash me-1"></i> Hapus Akun</button>
            </div>
        </div>
    </div>
    {{-- IF PEGAWAI NON AKTIF --}}
    <div class="col-md-12 status-nonaktif" hidden>
        <div class="card shadow-none border mb-0">
            <div class="card-body">
                <h5 class="mb-0 text-center">Pegawai telah resmi <b class="text-danger">dihapus/dinonaktifkan</b> pada {{ \Carbon\Carbon::parse($list['show']->deleted_at)->isoFormat('dddd, D MMMM Y, HH:mm a') }} Oleh {{ $list['show']->nama_admin }}</h5>
            </div>
        </div>
    </div>
</div>

{{-- FORM MODAL HAPUS --}}
<div class="modal animate__animated animate__rubberBand fade" id="hapusPegawai" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Form Hapus Pegawai
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="id_hapus_pegawai" hidden>
                <p style="text-align: justify;">
                    Apakah Anda yakin ingin <b>menghapus/menonaktifkan</b> Pegawai dengan <kbd>ID:<a id="show_id_pegawai"></a></kbd> ? <br>
                    Data pegawai yang terlah terhapus masih dapat dilihat pada riwayat pegawai (Tidak berarti terhapus permanen). <br><br>Ceklis dibawah untuk melanjutkan penghapusan.</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapuspegawai">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" id="btn-hapus-pegawai" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapusPegawai()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal animate__animated animate__rubberBand fade" id="hapusDokumen" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Form Hapus&nbsp;&nbsp;&nbsp;
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="id_hapus_dokumen" hidden>
                <p style="text-align: justify;">Anda akan menghapus berkas dokumen tersebut. Penghapusan berkas akan menyebabkan hilangnya data/dokumen yang terhapus tersebut pada Storage Sistem.
                    Maka dari itu, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapusdokumen">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" id="btn-hapus-dokumen" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapusDokumen()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal animate__animated animate__rubberBand fade" id="hapusPenetapan" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Form Hapus Status Pegawai
                </h6>
            </div>
            <div class="modal-body">
                <input type="text" id="id_hapus_penetapan" hidden>
                <p style="text-align: justify;">Anda akan menghapus <strong>Status Pegawai</strong> tersebut.
                    Status pegawai akan diambilkan dari data terakhir yang sudah ada dan apabila baru pertama kali (satu-satunya data) yang dimasukkan akan mengakibatkan
                    status pegawai menjadi kosong. Maka dari itu, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapuspenetapan">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" id="btn-hapus-penetapan" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapusPenetapan()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal animate__animated animate__rubberBand fade" id="hapusRotasi" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Form Batal Rotasi Pegawai
                </h6>
            </div>
            <div class="modal-body">
                <input type="text" id="id_hapus_rotasi" hidden>
                <p style="text-align: justify;">Anda akan menonaktifkan/membatalkan <strong>Data Rotasi Pegawai</strong> dari database.
                    Pembatalan data akan berpengaruh pada jabatan dan akses pengguna saat ini, apabila data baru pertama kali masuk (satu-satunya data)
                    yang dimasukkan akan mengakibatkan jabatan menjadi kosong pada database. Maka dari itu, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penonaktifan.</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapusrotasi">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" id="btn-hapus-rotasi" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapusRotasi()"><i class="ti ti-arrow-back-up me-1" style="font-size:13px"></i> Batalkan</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal animate__animated animate__rubberBand fade" id="hapusSpkRkk" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Form Hapus SPK / RKK Pegawai
                </h6>
            </div>
            <div class="modal-body">
                <input type="text" id="id_hapus_spkrkk" hidden>
                <p style="text-align: justify;">Anda akan menghapus <strong>Data SPK / RKK</strong> <kbd>ID:<a id="show_id_hapusspkrkk"></a></kbd> dari database.
                    Penghapusan data akan menghapus data record pada database dan menghapus file pada storage system. Maka dari itu, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penonaktifan.</p>
                <label class="switch">
                    <input type="checkbox" class="switch-input" id="setujuhapusspkrkk">
                    <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">Anda siap menerima Risiko</span>
                </label>
            </div>
            <div class="col-12 text-center mb-4">
                <button type="submit" id="btn-hapus-spkrkk" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapusSpkRkk()"><i class="fas fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    });

    function showKepegawaian() {
        $("#nip_pgw").val('');
        $("#klasifikasi_pgw").val('');
        $.ajax({
            url: `/api/v4/sdi/profilpegawai/kepegawaian/${id_pegawai}`,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                if (res.user && res.user.status == null && res.user.deleted_at == null) {
                    $(".status-aktif").prop('hidden', false);
                    $(".status-nonaktif").prop('hidden', true);
                } else {
                    $(".status-aktif").prop('hidden', true);
                    $(".status-nonaktif").prop('hidden', false);
                }

                $("#show_nip_terakhir").text(res.maxNip);
                $("#show_nip_thl_terakhir").text(res.maxNipThl);
                if (res.show) {
                    $("#nip_pgw").val(res.show.nip?res.show.nip:'');
                    $("#show_nip_after").text(res.show.nip? res.show.nip : '-');
                    $("#tmt").val(res.show.tmt);
                    if (res.show.tat) {
                        $("#tat").val(res.show.tat);
                    }
                    $("#klasifikasi_pgw").find('option').remove();
                    res.ref_klasifikasi.forEach(item => {
                        $("#klasifikasi_pgw").append(`<option value="" hidden>Pilih Salah Satu</option>`);
                        $("#klasifikasi_pgw").append(`
                            <option value="${item.id}" ${item.id == res.show.ref_profesi? "selected":""}>${item.deskripsi}</option>
                        `);
                    });
                    $("#profesi_pgw").find('option').remove();
                    res.ref_subprofesi.forEach(item => {
                        $("#profesi_pgw").append(`<option value="" hidden>Pilih Salah Satu</option>`);
                        $("#profesi_pgw").append(`
                            <option value="${item.id}" ${item.id == res.show.ref_subprofesi? "selected":""}>${item.deskripsi}</option>
                        `);
                    });
                }
            },
            error: function(res) {
                console.log("error : " + JSON.stringify(res) );
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: res.responseJSON,
                    position: 'topRight'
                });
            }
        });
    }
    function prosesSimpanNIP() {

        var fd = new FormData();

        // ISIAN FORM WAJIB
        var nip = $('#nip_pgw').val();

        if (nip == '') {
            iziToast.warning({
                title: 'Pesan Ambigu!',
                message: 'Masukkan NIP terlebih dahulu',
                position: 'topRight'
            });
        } else {
            if (nip.length < 9) {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Format NIP tidak valid, gunakan <strong>Titik (<b class="text-primary">.</b>)</strong> untuk memisahkan Tahun/Bulan Masuk dan No.Urut Pegawai',
                    position: 'topRight'
                });
            } else {
                // INISIALISASI
                fd.append('nip',nip);
                fd.append('user_id',id_user);
                fd.append('pegawai_id',id_pegawai);

                // AJAX REQUEST
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `/api/v4/sdi/profilpegawai/kepegawaian/nip/simpan`,
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $("#btn-simpan-nip").find("i").removeClass("fa-save").addClass("fa-sync fa-spin");
                        $("#btn-simpan-nip").prop('disabled', true);
                    },
                    success: function(res){
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'NIP Pegawai berhasil disimpan pada '+res,
                            position: 'topRight'
                        });
                        if (res) {
                            showKepegawaian();
                        }
                    },
                    error: function(res){
                        console.log("error : " + JSON.stringify(res) );
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: res.responseJSON.error,
                            position: 'topRight'
                        });
                    },
                    complete: function() {
                        $("#btn-simpan-nip").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
                        $("#btn-simpan-nip").prop('disabled', false);
                    }
                });
            }
        }
    }
    function prosesSimpanKlasifikasiPgw() {

        var fd = new FormData();

        // ISIAN FORM WAJIB
        var ref_profesi = $('#klasifikasi_pgw').val();

        if (ref_profesi == '') {
            iziToast.warning({
                title: 'Pesan Ambigu!',
                message: 'Pilih klasifikasi pegawai terlebih dahulu',
                position: 'topRight'
            });
        } else {
            // INISIALISASI
            fd.append('ref_profesi',ref_profesi);
            fd.append('user_id',id_user);
            fd.append('pegawai_id',id_pegawai);

            // AJAX REQUEST
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/v4/sdi/profilpegawai/kepegawaian/klasifikasi/simpan`,
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#btn-simpan-klasifikasi").find("i").removeClass("fa-save").addClass("fa-sync fa-spin");
                    $("#btn-simpan-klasifikasi").prop('disabled', true);
                },
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Klasifikasi pegawai berhasil disimpan pada '+res,
                        position: 'topRight'
                    });
                    if (res) {
                        showKepegawaian();
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    $("#btn-simpan-klasifikasi").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
                    $("#btn-simpan-klasifikasi").prop('disabled', false);
                }
            });
        }
    }
    function prosesSimpanTattmt() {

        var fd = new FormData();

        // ISIAN FORM WAJIB
        var tmt = $('#tmt').val();
        var tat = $('#tat').val();

        if (tmt == '') {
            iziToast.warning({
                title: 'Pesan Ambigu!',
                message: 'Masukkan Input TMT (Tanggal Mulai Tugas)',
                position: 'topRight'
            });
        } else {
            // INISIALISASI
            fd.append('tmt',tmt);
            fd.append('tat',tat);
            fd.append('user_id',id_user);
            fd.append('pegawai_id',id_pegawai);

            // AJAX REQUEST
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/v4/sdi/profilpegawai/kepegawaian/tattmt/simpan`,
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#btn-simpan-tattmt").find("i").removeClass("fa-save").addClass("fa-sync fa-spin");
                    $("#btn-simpan-tattmt").prop('disabled', true);
                },
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'TMT / TAT pegawai berhasil disimpan pada '+res,
                        position: 'topRight'
                    });
                    if (res) {
                        showKepegawaian();
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    $("#btn-simpan-tattmt").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
                    $("#btn-simpan-tattmt").prop('disabled', false);
                }
            });
        }
    }
    function prosesSimpanProfesiPgw() {

        var fd = new FormData();

        // ISIAN FORM WAJIB
        var ref_subprofesi = $('#profesi_pgw').val();

        if (ref_subprofesi == '') {
            iziToast.warning({
                title: 'Pesan Ambigu!',
                message: 'Pilih Profesi pegawai terlebih dahulu',
                position: 'topRight'
            });
        } else {
            // INISIALISASI
            fd.append('ref_subprofesi',ref_subprofesi);
            fd.append('user_id',id_user);
            fd.append('pegawai_id',id_pegawai);

            // AJAX REQUEST
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/v4/sdi/profilpegawai/kepegawaian/profesi/simpan`,
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#btn-simpan-profesi").find("i").removeClass("fa-save").addClass("fa-sync fa-spin");
                    $("#btn-simpan-profesi").prop('disabled', true);
                },
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Profesi Pegawai (Sub Klasifikasi) berhasil disimpan pada '+res,
                        position: 'topRight'
                    });
                    if (res) {
                        showKepegawaian();
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON,
                        position: 'topRight'
                    });
                },
                complete: function() {
                    $("#btn-simpan-profesi").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
                    $("#btn-simpan-profesi").prop('disabled', false);
                }
            });
        }
    }

    // SHOW HAPUS
    function showHapusPegawai(id) {
        $("#id_hapus_pegawai").val(id);
        $("#show_id_pegawai").text(id);
        var inputs = document.getElementById('setujuhapuspegawai');
        inputs.checked = false;
        $('#hapusPegawai').modal('show');
    }

    function showHapusPenetapan(id) {
        $("#id_hapus_penetapan").val(id);
        var inputs = document.getElementById('setujuhapuspenetapan');
        inputs.checked = false;
        $('#hapusPenetapan').modal('show');
    }

    function showHapusRotasi(id) {
        $("#id_hapus_rotasi").val(id);
        var inputs = document.getElementById('setujuhapusrotasi');
        inputs.checked = false;
        $('#hapusRotasi').modal('show');
    }

    function showHapusSpkRkk(id) {
        $("#id_hapus_spkrkk").val(id);
        $("#show_id_hapusspkrkk").text(id);
        var inputs = document.getElementById('setujuhapusspkrkk');
        inputs.checked = false;
        $('#hapusSpkRkk').modal('show');
    }

    function prosesHapusPegawai() {
        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapuspegawai').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan (Nonaktif) pegawai',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            var id = $("#id_hapus_pegawai").val();
            $.ajax({
                url: "/api/profilkaryawan/{{ Auth::user()->id }}/hapus/"+id+"/proses",
                type: 'GET',
                dataType: 'json', // added data type
                // type: 'DELETE',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Pegawai telah berhasil dihapus/dinonaktifkan pada '+res,
                        position: 'topRight'
                    });
                    $('#hapusPegawai').modal('hide');
                    // location.reload();
                    // redirect ke route
                    window.location.href = "{{ route('profilkaryawan.index') }}";
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'pegawai gagal dihapus',
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function prosesHapusPenetapan() {
        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapuspenetapan').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan status pegawai',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            var id = $("#id_hapus_penetapan").val();
            $.ajax({
                url: "/api/profilkaryawan/penetapan/hapus/"+id+"/proses",
                type: 'DELETE',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Status Pegawai telah berhasil dihapus pada '+res,
                        position: 'topRight'
                    });
                    $('#hapusPenetapan').modal('hide');
                    refreshPenetapan();
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Status pegawai gagal dihapus',
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function prosesHapusRotasi() {
        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapusrotasi').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan rotasi jabatan pegawai',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            var id = $("#id_hapus_rotasi").val();
            $.ajax({
                url: "/api/profilkaryawan/rotasi/hapus/"+id+"/proses",
                type: 'DELETE',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Rotasi Jabatan Pegawai telah berhasil dihapus pada '+res,
                        position: 'topRight'
                    });
                    $('#hapusRotasi').modal('hide');
                    refreshRotasi();
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Rotasi Jabatan Pegawai gagal dihapus',
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function prosesHapusSpkRkk() {
        // SWITCH BTN HAPUS
        var checkboxHapus = $('#setujuhapusspkrkk').is(":checked");
        if (checkboxHapus == false) {
            iziToast.error({
                title: 'Pesan Galat!',
                message: 'Mohon menyetujui untuk dilakukan penghapusan data record SPK / RKK tersebut',
                position: 'topRight'
            });
        } else {
            // PROSES HAPUS
            var id = $("#id_hapus_spkrkk").val();
            $.ajax({
                url: "/api/profilkaryawan/spkrkk/hapus/"+id+"/proses",
                type: 'DELETE',
                success: function(res) {
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Data Record Pegawai telah berhasil dihapus pada '+res,
                        position: 'topRight'
                    });
                    $('#hapusSpkRkk').modal('hide');
                    refreshSpkRkk();
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Data Record Pegawai gagal dihapus',
                        position: 'topRight'
                    });
                }
            });
        }
    }
</script>
