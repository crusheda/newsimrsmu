@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Surat <b class="text-info link-underline-primary text-decoration-underline">Tugas</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">SDI</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Surat Tugas
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                @can('admin_kepegawaian')
                    <div class="card custom-card mb-3">
                        <div class="card-body p-b-10">
                            <div class="alert alert-light shadow-sm alert-dismissible fade show" role="alert">
                                <small>
                                    <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Batas maksimal upload dokumen <b><u>3 mb</u></b> dan hanya berformat <b>PDF</b> <br>
                                    <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Pegawai yang ada dalam pilihan di bawah adalah pegawai yang telah selesai melengkapi Profil / Biodata Pegawai <br>
                                    <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Pegawai-pegawai yang sudah ditambahkan akan mendapatkan akses download dokumen Surat Tugas tersebut pada masing-masing halaman surat tugas pegawai beserta notifikasi
                                </small>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Daftar Pegawai <span class="text-danger">*</span></label>
                                        <select class="form-select select2" name="pegawai[]" id="pegawai" style="width: 100%" multiple>
                                            @if (count($list['users']) > 0)
                                                @foreach ($list['users'] as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama?$item->nama:$item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Upload Dokumen <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col"><input type="file" class="form-control" id="filex" accept="application/pdf"></div>
                                            <div class="col-auto"><button class="btn btn-primary" onclick="prosesSimpan()" id="btn-simpan"><i class="fas fa-upload me-1"></i> Upload & Share</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">Tabel <b class="text-danger">Riwayat</b></h6>
                        <div class="btn-group">
                            <a href="javascript:void(0);" class="btn btn-sm btn-warning-transparent" onclick="refresh()"><i class="ti ti-refresh me-1"></i> Refresh</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dttable" class="table table-striped dt-responsive align-middle">
                                <thead>
                                    <tr>
                                        <th class="cell-fit">#ID</th>
                                        <th class="cell-fit">TANGGAL</th>
                                        <th class="cell-fit">PEGAWAI</th>
                                        <th class="cell-fit">DIPERBARUI</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody">
                                    <tr>
                                        <td colspan="9" style="font-size:13px">
                                            <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="cell-fit">#ID</th>
                                        <th class="cell-fit">TANGGAL</th>
                                        <th class="cell-fit">PEGAWAI</th>
                                        <th class="cell-fit">DIPERBARUI</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL START --}}
    <div class="modal fade animate__animated animate__rubberBand" id="modalUbah" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form Ubah
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Daftar Pegawai <span class="text-danger">*</span></label>
                                <select class="form-select select2" name="pegawai_edit[]" id="pegawai_edit" style="width: 100%" multiple></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="alert alert-secondary">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Dokumen Sebelumnya</label>
                                    <p class="text-primary"><u><a id="show_title"></a></u></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Upload Dokumen Baru (<b class="text-warning">Apabila Ada / Optional</b>) <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="filex_edit" accept="application/pdf">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="prosesUbah()" id="btn-ubah"><i class="fas fa-upload me-1"></i> Ubah</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalHapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Form Hapus
                    </h6>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan melakukan penghapusan Berkas Surat Tugas tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
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
                    <button type="submit" id="btn-proses-hapus" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapus()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                    <button type="reset" class="btn btn-link-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}

    <script>
        let adminID = @json(Auth::user()->can('admin_kepegawaian'));
        let date = getDateTime();
        $(document).ready(function() {
            // SELECT2
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: " Pilih Nama Pegawai",
                    allowClear: true,
                    dropdownParent: e.parent()
                })
            });

            refresh();
        });

        function refresh() {
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/v4/sdi/surtug/table",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    // VALIDATION FORM
                    // ------------------------------------------------------
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        let updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        content = "<tr id='data"+ item.id +"'>";
                        content += `<td><center><div class='dropend'><a href='javascript:void(0);' class='link-${date==updet?'success':'info'} link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup="true">${item.id}</a><div class='dropdown-menu'>`;
                            content += `<a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v4/sdi/surtug/`+item.id+`/download')"><i class='fas fa-download me-1'></i> Download</a>`;
                            if (adminID) {
                                if (date == updet) {
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-warning' id='btn-show-ubah' onclick="showUbahSurtug(`+item.id+`)"><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-danger' id='btn-show-hapus' onclick="showHapusSurtug(`+item.id+`)"><i class='fas fa-trash me-1'></i> Hapus</a>`;
                                } else {
                                    content += `<a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-edit me-1'></i> Ubah</a>`;
                                    content += `<a href='javascript:void(0);' class='dropdown-item disabled'><i class='fas fa-trash me-1'></i> Hapus</a>`;
                                }
                            }
                        content += `</div></center></td>`;
                        content += `<td>${item.tgl}</td>`;
                        content += `<td><small><ul class='list-unstyled mt-2'>`;
                        res.users.forEach(us => {
                            JSON.parse(item.pegawai_id).forEach(val => {
                                if (val == us.id) {
                                    content += `<li><i class="ti ti-arrow-narrow-right me-1"></i>` + us.nama + `</li>`;
                                }
                            })
                        })
                        content += `</small></ul></td>`;
                        // content += `<td>${item.keterangan?item.keterangan:''}</td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0'>${updet}</a>
                                                <small class='text-truncate text-muted'>Oleh ` + item.nama_user + `</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [3, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '10%' },
                            { sWidth: '65%' },
                            { sWidth: '20%' },
                        ],
                        displayLength: 10
                    });
                }
            })
        }

        function prosesSimpan() {
            const btn = $('#btn-simpan');

            // Definisi
            var save = new FormData();
            var filesAdded = $('#filex')[0].files;
            save.append('pegawai',JSON.stringify($('#pegawai').val()));
            if (filesAdded) {
                save.append('file',filesAdded[0]);
            }
            if ($('#pegawai').val() == "" || filesAdded.length == 0 // (Jika Tidak Ada File Yang Diupload)
                ) {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian Wajib',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/sdi/surtug/simpan",
                    method: 'post',
                    data: save,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        btn.find("i").removeClass("fa-upload").addClass("fa-sync fa-spin").prop('disabled', true);
                    },
                    success: function(res) {
                        if (res.code == 200) {
                            notifier.show(
                                "Pesan Sukses!", "Submit Berkas berhasil dilakukan pada "+res.message,
                                "success", "{{ asset('images/notification/ok-48.png') }}", 4e3
                            );
                            refresh()
                            clearInput();
                        } else {
                            notifier.show(
                                "Pesan Galat!", res.message,
                                "warning", "{{ asset('images/notification/medium_priority-48.png') }}", 4e3
                            );
                        }
                    },
                    error: function (res) {
                        notifier.show(
                            res.statusText + " (Code " + res.status + ")", res.responseText,
                            "danger", "{{ asset('images/notification/high_priority-48.png') }}", 4e3
                        );
                    },
                    complete: function() {
                        btn.find("i").removeClass("fa-sync fa-spin").addClass("fa-upload").prop('disabled', false);
                    }
                });
            }
        }

        function showUbahSurtug(id) {
            const btn = $('#btn-show-ubah');
            $.ajax(
            {
                url: "/api/v4/sdi/surtug/"+id+"/ubah",
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    btn.find("i").removeClass("fa-edit").addClass("fa-sync fa-spin").prop('disabled', true);
                },
                success: function(res) {
                    $('#id_edit').val(res.show.id);
                    $('#show_title').text(res.show.title);
                    $("#pegawai_edit").find('option').remove();
                    var un = JSON.parse(res.show.pegawai_id);
                    $("#pegawai_edit").find('option').remove();
                    res.users.forEach(pouch => {
                        selected = '';
                        un.forEach(val => {
                            if (val == pouch.id) {
                                selected = 'selected';
                            }
                        });
                        $("#pegawai_edit").append(`
                            <option value="${pouch.id}" ${selected}>${pouch.nama}</option>
                        `);
                    });
                    $('#modalUbah').modal('show');
                },
                error: function(res) {
                    notifier.show(
                        res.statusText + " (Code " + res.status + ")", res.responseText,
                        "danger", "{{ asset('images/notification/high_priority-48.png') }}", 4e3
                    );
                },
                complete: function() {
                    btn.find("i").removeClass("fa-sync fa-spin").addClass("fa-edit").prop('disabled', false);
                }
            })
        }

        function prosesUbah() {
            const btn = $('#btn-ubah');
            var save = new FormData();
            var id = $('#id_edit').val();
            var filesAdded = $('#filex_edit')[0].files;
            save.append('id',id);
            save.append('pegawai',JSON.stringify($('#pegawai_edit').val()));
            if (filesAdded.length > 0) {
                save.append('file', filesAdded[0]);
            }

            if (
                $('#pegawai_edit').val() == ""
            ) {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian Wajib',
                    position: 'topRight'
                });
            } else {
                // AJAX request
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/sdi/surtug/"+id+"/prosesubah",
                    method: 'post',
                    data: save,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        btn.find("i").removeClass("fa-edit").addClass("fa-sync fa-spin").prop('disabled', true);
                    },
                    success: function(res){
                        if (res) {
                            if (res.code == 200) {
                                notifier.show(
                                    "Pesan Sukses!", "Perubahan berhasil dilakukan pada "+res.message,
                                    "success", "{{ asset('images/notification/ok-48.png') }}", 4e3
                                );
                                $('#modalUbah').modal('hide');
                                refresh();
                                clearInput();
                            } else {
                                notifier.show(
                                    "Pesan Gagal! (Code " + res.code + ")", res.message,
                                    "danger", "{{ asset('images/notification/high_priority-48.png') }}", 4e3
                                );
                            }
                        }
                    },
                    error: function(res){
                        console.log("error : " + JSON.stringify(res) );
                        notifier.show(
                            res.statusText + " (Code " + res.status + ")", res.responseText,
                            "danger", "{{ asset('images/notification/high_priority-48.png') }}", 4e3
                        );
                    },
                    complete: function() {
                        btn.find("i").removeClass("fa-sync fa-spin").addClass("fa-edit").prop('disabled', false);
                    }
                });
            }
        }

        function showHapusSurtug(id) {
            $("#id_hapus").val(id);
            var inputs = document.getElementById('setujuhapus');
            inputs.checked = false;
            $('#modalHapus').modal('show');
        }

        function prosesHapus() {
            const btn = $('#btn-proses-hapus');
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuhapus').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan penghapusan berkas tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_hapus").val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/v4/sdi/surtug/"+id+"/hapus",
                    type: 'DELETE',
                    beforeSend: function() {
                        btn.find("i").removeClass("fa-trash").addClass("fa-sync fa-spin").prop('disabled', true);
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Surat Tugas telah berhasil dihapus pada '+res,
                            position: 'topRight'
                        });
                        $('#modalHapus').modal('hide');
                        refresh();
                        clearInput();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Surat Tugas gagal dihapus',
                            position: 'topRight'
                        });
                    },
                    complete: function() {
                        btn.find("i").removeClass("fa-sync fa-spin").addClass("fa-trash").prop('disabled', false);
                    }
                });
            }
        }

        function clearInput() {
            $('#pegawai').val('').change();
            $('#filex').val('');
        }
    </script>
@endsection
