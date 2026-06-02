@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Referensi <b class="text-teal link-underline-teal text-decoration-underline">Shift</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">SDI</a>
                    </li>
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Jadwal Dinas</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Referensi Shift
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card custom-card mb-3">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <div class="btn-group">
                            <a class="btn btn-outline-secondary" href="{{ route('v4.sdi.jadwaldinas') }}" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Kembali ke Halaman Jadwal Dinas"><i class="fas fa-angle-left me-1"></i> Kembali</a>
                            @if ($list['show'])
                                @if ($list['show']->pegawai_id == Auth::user()->id)
                                    <button class="btn btn-primary" onclick="tambah()" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Form Tambah" id="btn-tambah" disabled><i class='ti ti-calendar-plus me-1'></i> Tambah</button>
                                @endif
                            @endif
                        </div>
                        <div>
                            <button class="btn btn-warning-transparent" onclick="refresh()" data-bs-toggle="tooltip"
                                data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" id="btn-refresh-table"
                                title="Refresh - Tabel Shift Anda"><i class="fas fa-sync me-1"></i> Segarkan</button>
                            @can('admin_kepegawaian')
                                <button class="btn btn-teal-transparent ms-2" onclick="refreshAll()" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" id="btn-refreshAll-table"
                                    title="Lihat Semua Shift Unit"><i class="fas fa-infinity me-1"></i> Lihat Semua Shift</button>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light shadow-sm mb-3 mt-2">
                            <h5>Hal-hal yang perlu <b class="text-danger">diperhatikan</b> saat pengisian</h5>
                            <small>
                                <i class="ti ti-arrow-narrow-right me-1"></i> Pastikan Data Shift ditambahkan oleh Admin Jadwal (<b class="text-teal">Setiap Unit/Bagian hanya 1 orang perwakilan</b>), berkaitan dengan kelengkapan data saat pembuatan Jadwal Dinas <br>
                                <i class="ti ti-arrow-narrow-right me-1"></i> Akses <b>Tambah</b> hanya bisa dilakukan apabila Data Shift Karyawan yang bersangkutan belum didaftarkan/tergabung pada <b>UNIT</b> manapun (Belum pernah ditambahkan oleh siapapun) <br>
                                <i class="ti ti-arrow-narrow-right me-1"></i> Akses <b>Ubah</b> maupun <b>Hapus</b> Data Referensi Shift hanya dapat dilakukan oleh Admin Jadwal (User Admin Ref.Shift) <br>
                                <i class="ti ti-arrow-narrow-right me-1"></i> Penambahan Data Shift hanya dilakukan sekali saja dan dapat digunakan untuk seterusnya, terkecuali apabila terdapat perubahan Data Shift <br>
                                <i class="ti ti-arrow-narrow-right me-1"></i> Rentang Jam & Menit pada pengisian shift berangkat sampai pulang adalah lebih dari <b class="text-teal">(>) 4 Jam</b> dan kurang dari <b class="text-teal">(<) 18 Jam</b> <br>
                                <i class="ti ti-arrow-narrow-right me-1"></i> Perlu diperhatikan bahwa penghapusan Data Shift tidak akan menghapus Data Jadwal Dinas yang sudah/pernah diajukan sebelumnya (Min. 3 Bulan setelah shift ditambahkan) <br>
                                <i class="ti ti-arrow-narrow-right me-1"></i> Hapus SHIFT sesuai kebutuhan saja dan <b class="text-teal">lakukan secara hati-hati</b>. Idealnya penghapusan SHIFT adalah setelah lebih dari 3 / 4 bulan <br>
                                <i class="ti ti-arrow-narrow-right me-1"></i> Ketika masih dalam kurun waktu 1 - 2 bulan jadwal shift berjalan <b class="text-teal">TIDAK DIPERBOLEHKAN</b> untuk melakukan penghapusan shift
                            </small>
                        </div>
                        <div class="alert alert-danger mb-3 mt-1 text-center shadow-sm">
                            <h6>PERHATIAN !!! SHIFT SELAIN YANG <b class="text-danger">DITAMBAHKAN OTOMATIS OLEH SISTEM</b> MAKA AKAN DIANGGAP SHIFT MASUK JAGA ( <u class="text-danger"><b>TIDAK LIBUR</b></u> ) !!</h6>
                            <h6 class="mb-0"><small>MOHON HATI-HATI DALAM MENENTUKAN SHIFT PADA UNIT ANDA, HAL INI BERKAITAN DENGAN PENGHITUNGAN ABSENSI. DATA SHIFT SEPENUHNYA DIPANTAU LANGSUNG OLEH BAGIAN SDI.</small></h6>
                        </div>
                        <div class="table-responsive" style="border: 0px">
                            <table id="dttable" class="table dt-responsive table-hover w-100">
                                <thead>
                                    <tr>
                                        <th class="cell-fit">Aksi</th>
                                        <th class="cell-fit"><center>Unit</center></th>
                                        <th>(<b class="text-warning">KODE</b>) Nama Shift</th>
                                        <th class="cell-fit"><center>Jam <b class="text-success">Berangkat</b> (<b class="text-warning">24h</b>)</center></th>
                                        <th class="cell-fit"><center>Jam <b class="text-danger">Pulang</b> (<b class="text-warning">24h</b>)</center></th>
                                        <th class="cell-fit"><center>Selisih Jam</center></th>
                                        <th>Keterangan</th>
                                        <th class="cell-fit">Diperbarui</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody">
                                    <tr>
                                        <td colspan="9" style="font-size:13px">
                                            <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                        </td>
                                    </tr>
                                </tbody>
                                {{-- <tfoot>
                                    <tr>
                                        <th class="cell-fit">Aksi</th>
                                        <th class="cell-fit">Unit</th>
                                        <th>(<b class="text-warning">KODE</b>) Nama Shift</th>
                                        <th class="cell-fit">Jam Berangkat (24h)</th>
                                        <th class="cell-fit">Jam Pulang (24h)</th>
                                        <th class="cell-fit">Selisih Jam</th>
                                        <th>Keterangan</th>
                                        <th class="cell-fit">Diperbarui</th>
                                    </tr>
                                </tfoot> --}}
                            </table>
                            <!-- end table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH -->
    <div class="modal fade" tabindex="-1" id="modalTambah" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Tambah <b class="text-primary">Shift</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="alert alert-light shadow-sm">
                                    <small>
                                        <h6><center>Mohon Diperhatikan <b class="text-danger">Panduan Di Bawah</b> Sebelum Melakukan Pengisian!</center></h6>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Perhatikan penulisan Nama Singkat Shift karena kata tersebut akan menjadi pilihan dalam penentuan Jadwal Dinas<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Penambahan Jam Berangkat dan Jam Pulang harus sesuai dengan kebijakan yang ada, tidak diperbolehkan membuat jam shift sendiri / <i>OnRequest</i> (Diluar Jam Shift Berangkat & Pulang yang sudah ada) tanpa persetujuan bagian SDI<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Penulisan Nama Singkat Shift hanya diperbolehkan <kbd>2 HURUF</kbd><br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Shift yang akan ditambahkan tidak boleh sama dengan yang sudah ada<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Tidak diperbolehkan menambahkan Shift dengan selisih kurang dari 4 Jam, e.g (00:00 - 00:00)<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Format Waktu/Jam Shift = <u><b>JAM (24 Jam) : MENIT</b></u><br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Terkait <kbd>Toleransi Kehadiran (10 Menit)</kbd> sudah otomatis dari sistem<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Waktu/Jam Shift Berangkat dan Pulang tidak boleh sama<br>
                                        <i class="fas fa-caret-right text-primary me-1 mb-3"></i> Contoh memasukkan Jam Berangkat & Pulang (Khusus Lewat HARI)<br>
                                        <h6><span class="border border-dark border-top-2">&nbsp;Berangkat <i class="fas fa-long-arrow-alt-right text-danger"></i> Pulang&nbsp;</span>
                                        <i class="fas fa-grip-lines me-1">
                                        </i><span class="border border-dark border-top-2">&nbsp;21:00 <i class="fas fa-long-arrow-alt-right text-danger"></i> 05:00&nbsp;</span></h6>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama <b class="text-teal">Singkat</b> Shift <a class="text-danger">*</a></label>
                                <input type="text" id="singkat_add" class="form-control inputTgl" onkeyup="checkShift($(this))" placeholder="e.g. P / PS / P6 / etc">
                            </div>
                        </div>
                        <div class="col-md-9 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama <b class="text-teal">Lengkap</b> Shift <a class="text-danger">*</a></label>
                                <input type="text" id="shift_add" class="form-control" placeholder="e.g. PAGI / PAGI SIANG / PAGI JAM 6 / etc">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jam Berangkat / <b>Masuk</b> <a class="text-danger">*</a></label>
                                <input type="text" id="berangkat_add" class="form-control" data-provide="timepicker" placeholder="Format Waktu H:i">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jam Pulang / <b>Keluar</b> <a class="text-danger">*</a></label>
                                <input type="text" id="pulang_add" class="form-control" data-provide="timepicker" placeholder="Format Waktu H:i">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea rows="2" class="form-control" id="ket_add" placeholder="Optional"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal"><i
                            class="fa fa-times me-1"></i> Batal</button>
                    <button class="btn btn-primary" onclick="simpan()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                        title="Simpan Data"><i
                            class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL UBAH -->
    <div class="modal fade" tabindex="-1" id="modalUbah" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Ubah <b class="text-warning">Shift</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <div class="alert alert-light shadow-sm">
                                    <small>
                                        <h6><center>Mohon Diperhatikan <b class="text-danger">Panduan Di Bawah</b> Sebelum Melakukan Pengisian!</center></h6>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Perhatikan penulisan Nama Singkat Shift karena kata tersebut akan menjadi pilihan dalam penentuan Jadwal Dinas<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Penambahan Jam Berangkat dan Jam Pulang harus sesuai dengan kebijakan yang ada, tidak diperbolehkan membuat jam shift sendiri / <i>OnRequest</i> (Diluar Jam Shift Berangkat & Pulang yang sudah ada) tanpa persetujuan bagian SDI<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Penulisan Nama Singkat Shift hanya diperbolehkan <kbd>2 HURUF</kbd><br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Shift yang akan diubah tidak boleh sama dengan yang sudah ada<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Tidak diperbolehkan menambahkan Shift dengan selisih kurang dari 4 Jam, e.g (00:00 - 00:00)<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Format Waktu/Jam Shift = <u><b>JAM (24 Jam) : MENIT</b></u><br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Terkait <kbd>Toleransi Kehadiran (10 Menit)</kbd> sudah otomatis dari sistem<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Waktu/Jam Shift Berangkat dan Pulang tidak boleh sama<br>
                                        <i class="fas fa-caret-right text-primary me-1 mb-3"></i> Contoh memasukkan Jam Berangkat & Pulang (Khusus Lewat HARI)<br>
                                        <h6><span class="border border-dark border-top-2">&nbsp;Berangkat <i class="fas fa-long-arrow-alt-right text-danger"></i> Pulang&nbsp;</span>
                                        <i class="fas fa-grip-lines me-1">
                                        </i><span class="border border-dark border-top-2">&nbsp;21:00 <i class="fas fa-long-arrow-alt-right text-danger"></i> 05:00&nbsp;</span></h6>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama <b class="text-teal">Singkat</b> Shift <a class="text-danger">*</a></label>
                                <input type="text" id="singkat_edit" class="form-control inputTgl" onkeyup="checkShift($(this))" placeholder="e.g. P / PS / P6 / etc">
                            </div>
                        </div>
                        <div class="col-md-9 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama <b class="text-teal">Lengkap</b> Shift <a class="text-danger">*</a></label>
                                <input type="text" id="shift_edit" class="form-control" placeholder="e.g. PAGI / PAGI SIANG / PAGI JAM 6 / etc">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jam Berangkat / <b>Masuk</b> <a class="text-danger">*</a></label>
                                <input type="text" id="berangkat_edit" class="form-control" data-provide="timepicker" placeholder="Format Waktu H:i">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jam Pulang / <b>Keluar</b> <a class="text-danger">*</a></label>
                                <input type="text" id="pulang_edit" class="form-control" data-provide="timepicker" placeholder="Format Waktu H:i">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea rows="2" class="form-control" id="ket_edit" placeholder="Optional"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" id="btn-ubah" onclick="prosesUbah()"><i class="fa-fw fas fa-edit nav-icon me-1"></i> Ubah</button>
                    <button type="button" class="btn btn-link text-dark" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon me-1"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div class="modal animate__animated animate__rubberBand fade" id="hapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Form <b class="text-danger">Hapus Shift</b>
                    </h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan menghapus Daftar Shift tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuhapus">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-hapus" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapus()"><i class="fa fa-trash me-1"></i> Hapus</button>
                    <button type="reset" class="btn btn-link text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let fpBerangkatAdd, fpPulangAdd, fpBerangkatEdit, fpPulangEdit;
        $(document).ready(function() {
            $('.inputTgl').keypress(function() {
                let input = $(this).val();
                let cleanedInput = cleanInput(input);
                $(this).val(cleanedInput);
            });
            refresh();

            fpBerangkatAdd = flatpickr("#berangkat_add", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                allowInput: true
                });

            fpPulangAdd = flatpickr("#pulang_add", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                allowInput: true
                });

            fpBerangkatEdit = flatpickr("#berangkat_edit", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                allowInput: true
                });

            fpPulangEdit = flatpickr("#pulang_edit", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                allowInput: true
                });

            // flatpickr(".pilihJam", {
            //     enableTime: true,
            //     noCalendar: true,
            //     dateFormat: "H:i",
            //     time_24hr: true,
            //     allowInput: true
            // });
        })

        // IMPORTANT FUNCTION
        function checkShift(t) {
            if (t.val().length <= 2 ) {
                t.val(t.val().toUpperCase());
            } else {
                t.val('');
            }
        }

        function cleanInput(input) {
            let tests = [/[a-z]/i, /\d/];
            for (let i = 0; i < tests.length; i++) {
                console.log(tests[i]);
                if (input[i] == undefined || !tests[i].test(input[i])) {
                    return input.substring(0, i);
                }
            }

            return input.substring(0, tests.length);
        }

        // FUNCTION AREA
        function refresh() {
            $('.modal').modal('hide');
            $("#tampil-tbody").empty().append(
                `<tr style='font-size:13px'><td colspan="8"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            const btn = $('#btn-refresh-table').find('i');
            $.ajax({
                url: "/api/v4/sdi/jadwaldinas/shift/table",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    btn.removeClass('fa-sync').addClass('fa-spinner fa-spin');
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    if ($.fn.DataTable.isDataTable('#dttable')) {
                        $('#dttable').DataTable().clear().destroy();
                    }
                    if (res.atasan == @json(Auth::user()->id)) {
                        $('#btn-tambah').prop('disabled',false);
                    } else {
                        $('#btn-tambah').prop('disabled',true);
                    }
                    moment.locale('id');
                    let content = ``;
                    res.show.forEach(item => {
                        const berangkat = moment(item.berangkat, "HH:mm:ss");
                        let pulang = moment(item.pulang, "HH:mm:ss");

                        // jika pulang lebih kecil, berarti lewat hari
                        if (pulang.isBefore(berangkat)) {
                            pulang.add(1, 'day');
                        }

                        // hitung selisih
                        const durasiMenit = pulang.diff(berangkat, "minutes");

                        const jam = Math.floor(durasiMenit / 60);
                        const menit = durasiMenit % 60;
                        const menitStr = menit.toString().padStart(2, '0');
                        content += `<tr><td><div class="d-flex align-items-center">
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="${item.pegawai_id == @json(Auth::user()->id)?"link-primary text-decoration-underline dropdown-toggle":"link disabled"} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="dropdown">` + item.id + `</a>
                                                <div class="dropdown-menu dropdown-menu-right">`;
                                                    if (item.pegawai_id == @json(Auth::user()->id) ) {
                                                        content += `<a href="javascript:;" onclick="ubah(` + item.id + `)" class="dropdown-item text-warning"><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                                        content += `<a href="javascript:;" onclick="hapus(` + item.id + `)" class="dropdown-item text-danger"><i class='fas fa-trash-alt me-1'></i> Hapus</a>`;
                                                    } else {
                                                        content += `<a href="javascript:;" class="dropdown-item disabled"><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                                        content += `<a href="javascript:;" class="dropdown-item disabled"><i class='fas fa-trash-alt me-1'></i> Hapus</a>`;
                                                    }
                                    content += `</div>
                                            </div>
                                        </div></td>`;
                        content += `<td class='text-center'>${item.unit_pegawai?item.unit_pegawai:'-'}</td>`;
                        content += `<td><kbd class="bg-warning text-white me-1">${item.singkat}</kbd> <u><b class='text-dark'>`+item.shift+`</b></u></td>`;
                        content += `<td class='text-center'>`+item.berangkat+`</td>`;
                        content += `<td class='text-center'>`+item.pulang+`</td>`;
                        content += `<td class='text-center'>${jam} jam${menit !== 0 ? ' ' + menitStr + ' menit' : ''}</td>`;
                        content += `<td>${item.ket?item.ket:'-'}</td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0'>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</a>
                                                <small class='text-truncate text-muted'>Diperbarui Oleh ` + item.nama_pegawai + `</small>
                                            </div>
                                        </div>
                                    </td></tr>`;
                    })
                    $('#tampil-tbody').append(content);
                    $('#tampil-tbody').append(`<tr><td><div class="d-flex align-items-center"><i class="ri-prohibited-line text-danger"></i></div></td><td>Semua Unit</td><td><kbd class="bg-danger text-white me-1">L</kbd> <u><b class='text-dark'>LIBUR</b></u></td><td>-</td><td>-</td><td>-</td><td>-</td><td>Ditambahkan otomatis oleh sistem</td>`);
                    $('#tampil-tbody').append(`<tr><td><div class="d-flex align-items-center"><i class="ri-prohibited-line text-danger"></i></div></td><td>Semua Unit</td><td><kbd class="bg-danger text-white me-1">C</kbd> <u><b class='text-dark'>CUTI TAHUNAN</b></u></td><td>-</td><td>-</td><td>-</td><td>-</td><td>Ditambahkan otomatis oleh sistem</td>`);
                    $('#tampil-tbody').append(`<tr><td><div class="d-flex align-items-center"><i class="ri-prohibited-line text-danger"></i></div></td><td>Semua Unit</td><td><kbd class="bg-danger text-white me-1">CM</kbd> <u><b class='text-dark'>CUTI MELAHIRKAN</b></u></td><td>-</td><td>-</td><td>-</td><td>-</td><td>Ditambahkan otomatis oleh sistem</td>`);
                    $('#tampil-tbody').append(`<tr><td><div class="d-flex align-items-center"><i class="ri-prohibited-line text-danger"></i></div></td><td>Semua Unit</td><td><kbd class="bg-danger text-white me-1">CU</kbd> <u><b class='text-dark'>CUTI UMROH</b></u></td><td>-</td><td>-</td><td>-</td><td>-</td><td>Ditambahkan otomatis oleh sistem</td>`);
                    $('#tampil-tbody').append(`<tr><td><div class="d-flex align-items-center"><i class="ri-prohibited-line text-danger"></i></div></td><td>Semua Unit</td><td><kbd class="bg-danger text-white me-1">CH</kbd> <u><b class='text-dark'>CUTI HAJI</b></u></td><td>-</td><td>-</td><td>-</td><td>-</td><td>Ditambahkan otomatis oleh sistem</td>`);
                    $('#tampil-tbody').append(`<tr><td><div class="d-flex align-items-center"><i class="ri-prohibited-line text-danger"></i></div></td><td>Semua Unit</td><td><kbd class="bg-danger text-white me-1">CD</kbd> <u><b class='text-dark'>CUTI DILUAR TANGGUNGAN</b></u></td><td>-</td><td>-</td><td>-</td><td>-</td><td>Ditambahkan otomatis oleh sistem</td>`);

                    $('#dttable').DataTable({
                        order: [
                            [1, "asc"],
                            [7, "asc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '15%' },
                            { sWidth: '30%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                        ],
                        displayLength: 20,
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                },
                error: function (res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Tidak ada data shift ditemukan',
                        position: 'topRight'
                    });
                    $("#tampil-tbody").empty().append(
                        `<tr><td colspan="8"><center>Tidak ada Data Shift</center></td></tr>`
                    );
                },
                complete: function() {
                    btn.removeClass('fa-spinner fa-spin').addClass('fa-sync');
                }
            })
        }

        function getUnitClass(unit) {
            const colors = [
                'text-primary',
                'text-success',
                'text-warning',
                'text-info',
                'text-danger',
                'text-secondary'
            ];

            // if (unitColorMap[unit]) {
            //     return unitColorMap[unit];
            // }

            // auto assign berdasarkan hash sederhana
            let index = unit ? unit.length % colors.length : 0;
            return colors[index];
        }

        function refreshAll() {
            $('.modal').modal('hide');
            $("#tampil-tbody").empty().append(
                `<tr style='font-size:13px'><td colspan="8"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            const btn = $('#btn-refreshAll-table').find('i');
            $.ajax({
                url: "/api/v4/sdi/jadwaldinas/shift/table/all",
                type: 'GET',
                dataType: 'json', // added data type
                beforeSend: function() {
                    btn.removeClass('fa-infinity').addClass('fa-spinner fa-spin');
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    if ($.fn.DataTable.isDataTable('#dttable')) {
                        $('#dttable').DataTable().clear().destroy();
                    }
                    $('#btn-tambah').prop('disabled',true);
                    moment.locale('id');
                    let content = ``;
                    res.show.forEach(item => {
                        let unitClass = 'text-muted';
                        if (item.unit_pegawai) {
                            unitClass = getUnitClass(item.unit_pegawai);
                        }
                        const berangkat = moment(item.berangkat, "HH:mm:ss");
                        let pulang = moment(item.pulang, "HH:mm:ss");

                        // jika pulang lebih kecil, berarti lewat hari
                        if (pulang.isBefore(berangkat)) {
                            pulang.add(1, 'day');
                        }

                        // hitung selisih
                        const durasiMenit = pulang.diff(berangkat, "minutes");

                        const jam = Math.floor(durasiMenit / 60);
                        const menit = durasiMenit % 60;
                        const menitStr = menit.toString().padStart(2, '0');
                        content += `<tr><td>${item.id}</td>`;
                        content += `<td class="${unitClass} text-center"><b>${item.unit_pegawai?item.unit_pegawai:'-'}</b></td>`;
                        content += `<td><kbd class="bg-warning text-white me-1">${item.singkat}</kbd> <u><b class='text-dark'>`+item.shift+`</b></u></td>`;
                        content += `<td class='text-center'>`+item.berangkat+`</td>`;
                        content += `<td class='text-center'>`+item.pulang+`</td>`;
                        content += `<td class='text-center'>${jam} jam${menit !== 0 ? ' ' + menitStr + ' menit' : ''}</td>`;
                        content += `<td>${item.ket?item.ket:'-'}</td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column text-truncate'>
                                                <a class='mb-0 text-truncate'>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</a>
                                                <small class='text-truncate text-muted'>Diperbarui Oleh <br>` + item.nama_pegawai + `</small>
                                            </div>
                                        </div>
                                    </td></tr>`;
                    })
                    $('#tampil-tbody').append(content);

                    $('#dttable').DataTable({
                        order: [
                            [1, "asc"],
                            [7, "asc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '15%' },
                            { sWidth: '30%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                        ],
                        displayLength: 20,
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                },
                error: function (res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Tidak ada data shift ditemukan',
                        position: 'topRight'
                    });
                    $("#tampil-tbody").empty().append(
                        `<tr><td colspan="8"><center>Tidak ada Data Shift</center></td></tr>`
                    );
                },
                complete: function() {
                    btn.removeClass('fa-spinner fa-spin').addClass('fa-infinity');
                }
            })
        }

        function tambah() {
            $("#singkat_add").val("");
            $("#shift_add").val("");
            $("#berangkat_add").val("");
            $("#pulang_add").val("");
            $('#modalTambah').modal('show');
        }

        function simpan() {
            var singkat = $("#singkat_add").val();
            var shift = $("#shift_add").val();
            var berangkat = $("#berangkat_add").val();
            var pulang = $("#pulang_add").val();
            var ket = $("#ket_add").val();

            if (singkat == "" || shift == "" || berangkat == "" || pulang == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian wajib',
                    position: 'topRight'
                });
            } else {
                if (singkat == "DL") {
                    iziToast.error({
                        title: 'Maaf!',
                        message: '[DL] Dinas Luar hanya dapat digunakan saat pengajuan saja, tidak dapat ditambahkan ke Referensi Jadwal Dinas secara Manual.',
                        position: 'topRight'
                    });
                    return;
                }
                if (singkat == "L" || singkat == "C" || singkat == "CT" || singkat == "CM" || singkat == "CD" || singkat == "CU" || singkat == "CH") {
                    iziToast.error({
                        title: 'Maaf!',
                        message: 'Referensi Shift ['+singkat+'] sudah ditambahkan oleh Sistem. Tidak diizinkan menambahkan manual.',
                        position: 'topRight'
                    });
                    return;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/v4/sdi/jadwaldinas/shift/tambah',
                    dataType: 'json',
                    data: {
                        singkat: singkat,
                        shift: shift,
                        berangkat: berangkat,
                        pulang: pulang,
                        ket: ket,
                    },
                    success: function(res) {
                        if (res) {
                            if (res.code == 200) {
                                $('.modal').modal('hide');
                                iziToast.success({
                                    title: 'Sukses!',
                                    message: 'Tambah Shift berhasil pada '+ res.message,
                                    position: 'topRight'
                                });
                                refresh();
                            } else {
                                iziToast.error({
                                    title: 'Pesan Galat!',
                                    message: res.message,
                                    position: 'topRight'
                                });
                            }
                        }
                    },
                    error: function (res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: res.responseJSON.error,
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function ubah(id) {
            $("#id_edit").val("");
            $("#singkat_edit").val("");
            $("#shift_edit").val("");
            $("#berangkat_edit").val("");
            $("#pulang_edit").val("");
            $("#ket_edit").val("");
            $.ajax(
            {
                url: "/api/v4/sdi/jadwaldinas/shift/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#id_edit").val(res.show.id);
                    $("#singkat_edit").val(res.show.singkat);
                    $("#shift_edit").val(res.show.shift);
                    // $("#berangkat_edit").val(res.show.berangkat.substring(0,5)).change();
                    // $("#pulang_edit").val(res.show.pulang.substring(0,5)).change();
                    fpBerangkatEdit.setDate(res.show.berangkat.substring(0,5), true);
                    fpPulangEdit.setDate(res.show.pulang.substring(0,5), true);
                    $("#ket_edit").val(res.show.ket);
                    $('#modalUbah').modal('show');
                }
            });
        }

        function prosesUbah() {
            $("#btn-ubah").prop('disabled', true);
            $("#btn-ubah").find("i").toggleClass("fa-save fa-sync fa-spin");

            const btn = $("#btn-ubah");

            var fd = new FormData();
            fd.append('id',$("#id_edit").val());
            fd.append('singkat',$("#singkat_edit").val());
            fd.append('shift',$("#shift_edit").val());
            fd.append('berangkat',$("#berangkat_edit").val());
            fd.append('pulang',$("#pulang_edit").val());
            fd.append('ket',$("#ket_edit").val());

            if (fd.get('singkat') == "" || fd.get('shift') == "" || fd.get('berangkat') == "" || fd.get('pulang') == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian wajib',
                    position: 'topRight'
                });
            } else {
                if (fd.get('singkat') == "DL") {
                    iziToast.error({
                        title: 'Maaf!',
                        message: '[DL] Dinas Luar hanya dapat digunakan saat pengajuan saja, tidak dapat ditambahkan ke Referensi Jadwal Dinas secara Manual.',
                        position: 'topRight'
                    });
                    return;
                }
                if (fd.get('singkat') == "L" || fd.get('singkat') == "C" || fd.get('singkat') == "CT" || fd.get('singkat') == "CM" || fd.get('singkat') == "CD" || fd.get('singkat') == "CU" || fd.get('singkat') == "CH") {
                    iziToast.error({
                        title: 'Maaf!',
                        message: 'Referensi Shift ['+fd.get('singkat')+'] sudah ditambahkan oleh Sistem. Tidak diizinkan menambahkan manual.',
                        position: 'topRight'
                    });
                    return;
                }
                // AJAX request
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/sdi/jadwaldinas/shift/"+fd.get('id')+"/ubah",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(res){
                        if (res) {
                            if (res.code == 200) {
                                iziToast.success({
                                    title: 'Pesan Sukses! ID : '+fd.get('id'),
                                    message: 'Shift berhasil diperbarui pada '+res.message,
                                    position: 'topRight'
                                });
                                $('#ubah').modal('hide');
                                refresh();
                            } else {
                                iziToast.error({
                                    title: 'Pesan Galat! ID : '+fd.get('id'),
                                    message: 'Shift gagal diperbarui. '+res.message,
                                    position: 'topRight'
                                });
                            }
                        }
                        $("#btn-ubah").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
                        $("#btn-ubah").prop('disabled', false);
                    },
                    error: function(res){
                        console.log("error : " + JSON.stringify(res) );
                        $("#btn-ubah").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
                        $("#btn-ubah").prop('disabled', false);
                    }
                });
            }
        }

        function hapus(id) {
            $("#id_hapus").val(id);
            var inputs = document.getElementById('setujuhapus');
            inputs.checked = false;
            $('#hapus').modal('show');
        }

        function prosesHapus() {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuhapus').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui/ceklis form ini untuk melanjutkan proses penghapusan baris tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_hapus").val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/sdi/jadwaldinas/shift/"+id+"/hapus",
                    type: 'DELETE',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: res.message ?? ('Shift telah berhasil dihapus pada ' + res),
                            position: 'topRight'
                        });
                        $('#hapus').modal('hide');
                        refresh();
                    },
                    error: function(res) {
                        // Ambil pesan error dari server
                        let msg = res.responseJSON?.message || 'Shift gagal dihapus';
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: msg,
                            position: 'topRight'
                        });
                    }
                });
            }
        }
    </script>
@endsection
