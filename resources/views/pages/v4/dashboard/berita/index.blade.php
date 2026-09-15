@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    E - <b class="text-primary link-underline-primary text-decoration-underline">Absensi</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Berita Digital
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">

                <div class="card border-0 shadow-sm">

                    {{-- HEADER --}}
                    <div class="card-header bg-white border-0 py-3">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <h5 class="mb-1 fw-bold">
                                    Berita Digital
                                </h5>

                                <small class="text-muted">
                                    Kelola berita aplikasi E-Absensi
                                </small>
                            </div>

                            <button
                                type="button"
                                class="btn btn-primary"
                                onclick="tambahBerita()"
                            >
                                <i class="ri-add-line me-1"></i>
                                Tambah Berita
                            </button>

                        </div>

                    </div>


                    {{-- BODY --}}
                    <div class="card-body">

                        <div class="table-responsive">

                            <table
                                class="table table-hover align-middle"
                                id="tableBerita"
                            >

                                <thead>
                                    <tr>
                                        <th width="60">No</th>
                                        <th width="100">Gambar</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th width="120">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="tbodyBerita">

                                    <tr>
                                        <td
                                            colspan="7"
                                            class="text-center py-4"
                                        >
                                            Memuat data...
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- MODAL BERITA --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="modalBerita"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-header">

                <h5
                    class="modal-title fw-bold"
                    id="modalBeritaTitle"
                >
                    Tambah Berita
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <form
                id="formBerita"
                enctype="multipart/form-data"
            >

                @csrf

                <input
                    type="hidden"
                    id="berita_id"
                    name="berita_id"
                >


                <div class="modal-body">

                    {{-- JUDUL --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Judul
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="judul"
                            name="judul"
                            placeholder="Masukkan judul berita"
                            required
                        >

                    </div>


                    {{-- RINGKASAN --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Ringkasan
                        </label>

                        <textarea
                            class="form-control"
                            id="ringkasan"
                            name="ringkasan"
                            rows="3"
                            placeholder="Ringkasan singkat berita"
                        ></textarea>

                    </div>


                    {{-- ISI --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Isi Berita
                        </label>

                        <textarea
                            class="form-control"
                            id="isi"
                            name="isi"
                            rows="8"
                            placeholder="Isi berita"
                            required
                        ></textarea>

                    </div>


                    {{-- PENULIS --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Penulis
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="penulis"
                            name="penulis"
                            placeholder="Nama penulis"
                        >

                    </div>


                    <div class="row">

                        {{-- GAMBAR --}}
                        <div class="col-md-8">

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Gambar
                                </label>

                                <input
                                    type="file"
                                    class="form-control"
                                    id="gambar"
                                    name="gambar"
                                    accept="image/jpeg,image/png,image/webp"
                                >

                                <small class="text-muted">
                                    JPG, PNG atau WEBP. Maksimal 5 MB.
                                </small>

                            </div>

                        </div>


                        {{-- PUBLISHED --}}
                        <div class="col-md-4">

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Status
                                </label>

                                <div class="form-check form-switch mt-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="is_published"
                                        name="is_published"
                                        value="1"
                                        checked
                                    >

                                    <label
                                        class="form-check-label"
                                        for="is_published"
                                    >
                                        Publikasikan
                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- PREVIEW --}}
                    <div
                        id="previewContainer"
                        class="mb-2 d-none"
                    >

                        <label class="form-label fw-semibold">
                            Preview Gambar
                        </label>

                        <div>

                            <img
                                id="previewGambar"
                                src=""
                                class="rounded"
                                style="
                                    max-width: 250px;
                                    max-height: 150px;
                                    object-fit: cover;
                                "
                            >

                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                        id="btnSimpan"
                    >
                        <i class="ri-save-line me-1"></i>
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>

    let modalBerita;
    let modeBerita = 'tambah';


    /*
    |--------------------------------------------------------------------------
    | INIT
    |--------------------------------------------------------------------------
    */

    $(document).ready(function () {

        modalBerita = new bootstrap.Modal(
            document.getElementById('modalBerita')
        );

        loadBerita();


        /*
        |--------------------------------------------------------------------------
        | SUBMIT FORM
        |--------------------------------------------------------------------------
        */

        $('#formBerita').on('submit', function (e) {

            e.preventDefault();

            simpanBerita();

        });


        /*
        |--------------------------------------------------------------------------
        | PREVIEW GAMBAR
        |--------------------------------------------------------------------------
        */

        $('#gambar').on('change', function () {

            const file = this.files[0];

            if (!file) {
                $('#previewContainer').addClass('d-none');
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {

                $('#previewGambar')
                    .attr('src', e.target.result);

                $('#previewContainer')
                    .removeClass('d-none');

            };

            reader.readAsDataURL(file);

        });

    });


    /*
    |--------------------------------------------------------------------------
    | LOAD DATA
    |--------------------------------------------------------------------------
    */

    function loadBerita() {

        $('#tbodyBerita').html(`
            <tr>
                <td colspan="7" class="text-center py-4">
                    <div class="spinner-border spinner-border-sm me-2"></div>
                    Memuat data...
                </td>
            </tr>
        `);


        $.ajax({

            url: "/api/v4/berita",

            type: 'GET',

            dataType: 'json',

            success: function (response) {

                if (
                    !response.success ||
                    !Array.isArray(response.data)
                ) {

                    $('#tbodyBerita').html(`
                        <tr>
                            <td
                                colspan="7"
                                class="text-center text-muted py-4"
                            >
                                Tidak ada data berita.
                            </td>
                        </tr>
                    `);

                    return;
                }


                let html = '';


                if (response.data.length === 0) {

                    html = `
                        <tr>
                            <td
                                colspan="7"
                                class="text-center text-muted py-4"
                            >
                                Belum ada berita.
                            </td>
                        </tr>
                    `;

                } else {

                    response.data.forEach(function (item, index) {

                        const gambar = item.gambar
                            ? `/storage/${item.gambar}`
                            : null;


                        html += `

                            <tr>

                                <td>
                                    ${index + 1}
                                </td>


                                <td>

                                    ${
                                        gambar
                                        ?
                                        `
                                        <img
                                            src="${gambar}"
                                            style="
                                                width:70px;
                                                height:45px;
                                                object-fit:cover;
                                                border-radius:8px;
                                            "
                                        >
                                        `
                                        :
                                        `
                                        <div
                                            class="bg-light rounded d-flex
                                            align-items-center justify-content-center"
                                            style="
                                                width:70px;
                                                height:45px;
                                            "
                                        >
                                            <i class="ri-image-line text-muted"></i>
                                        </div>
                                        `
                                    }

                                </td>


                                <td>

                                    <div class="fw-semibold">
                                        ${escapeHtml(item.judul)}
                                    </div>

                                    ${
                                        item.ringkasan
                                        ?
                                        `
                                        <small class="text-muted">
                                            ${escapeHtml(
                                                item.ringkasan
                                            ).substring(0, 100)}
                                        </small>
                                        `
                                        :
                                        ''
                                    }

                                </td>


                                <td>
                                    ${escapeHtml(item.penulis ?? '-')}
                                </td>


                                <td>

                                    ${
                                        item.is_published
                                        ?
                                        `
                                        <span class="badge bg-success">
                                            Published
                                        </span>
                                        `
                                        :
                                        `
                                        <span class="badge bg-secondary">
                                            Draft
                                        </span>
                                        `
                                    }

                                </td>


                                <td>
                                    ${
                                        item.published_at
                                        ?
                                        formatTanggal(item.published_at)
                                        :
                                        '-'
                                    }
                                </td>


                                <td>

                                    <div class="d-flex gap-1">

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            onclick="editBerita(${item.id})"
                                            title="Ubah"
                                        >
                                            <i class="ri-edit-line"></i>
                                        </button>


                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="hapusBerita(${item.id})"
                                            title="Hapus"
                                        >
                                            <i class="ri-delete-bin-line"></i>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        `;

                    });

                }


                $('#tbodyBerita').html(html);

            },

            error: function (xhr) {

                console.error(xhr);

                $('#tbodyBerita').html(`
                    <tr>
                        <td
                            colspan="7"
                            class="text-center text-danger py-4"
                        >
                            Gagal memuat data berita.
                        </td>
                    </tr>
                `);

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH
    |--------------------------------------------------------------------------
    */

    function tambahBerita() {

        modeBerita = 'tambah';

        $('#modalBeritaTitle')
            .text('Tambah Berita');

        $('#formBerita')[0].reset();

        $('#berita_id').val('');

        $('#is_published')
            .prop('checked', true);

        $('#previewContainer')
            .addClass('d-none');

        $('#previewGambar')
            .attr('src', '');

        modalBerita.show();

    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    function editBerita(id) {

        modeBerita = 'edit';

        $('#btnSimpan')
            .prop('disabled', true)
            .html(`
                <span class="spinner-border spinner-border-sm me-1"></span>
                Memuat...
            `);


        $.ajax({

            url: `/api/v4/berita/${id}`,

            type: 'GET',

            dataType: 'json',

            success: function (response) {

                if (
                    !response.success ||
                    !response.data
                ) {

                    alert(
                        response.message ??
                        'Data berita tidak ditemukan.'
                    );

                    return;
                }


                const item = response.data;


                $('#modalBeritaTitle')
                    .text('Ubah Berita');


                $('#berita_id')
                    .val(item.id);


                $('#judul')
                    .val(item.judul ?? '');


                $('#ringkasan')
                    .val(item.ringkasan ?? '');


                $('#isi')
                    .val(item.isi ?? '');


                $('#penulis')
                    .val(item.penulis ?? '');


                $('#is_published')
                    .prop(
                        'checked',
                        item.is_published == true ||
                        item.is_published == 1
                    );


                $('#gambar')
                    .val('');


                if (item.gambar) {

                    $('#previewGambar')
                        .attr(
                            'src',
                            `/storage/${item.gambar}`
                        );

                    $('#previewContainer')
                        .removeClass('d-none');

                } else {

                    $('#previewContainer')
                        .addClass('d-none');

                }


                modalBerita.show();

            },

            error: function (xhr) {

                console.error(xhr);

                alert(
                    'Gagal mengambil data berita.'
                );

            },

            complete: function () {

                $('#btnSimpan')
                    .prop('disabled', false)
                    .html(`
                        <i class="ri-save-line me-1"></i>
                        Simpan
                    `);

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN / UPDATE
    |--------------------------------------------------------------------------
    */

    function simpanBerita() {

        const id = $('#berita_id').val();

        const formData = new FormData(
            $('#formBerita')[0]
        );


        if (modeBerita === 'edit') {

            formData.append(
                '_method',
                'PUT'
            );

        }


        $('#btnSimpan')
            .prop('disabled', true)
            .html(`
                <span class="spinner-border spinner-border-sm me-1"></span>
                Menyimpan...
            `);


        const url = modeBerita === 'edit'
            ? `/api/v4/berita/${id}`
            : "{{ url('/api/v4/berita') }}";


        $.ajax({

            url: url,

            type: 'POST',

            data: formData,

            processData: false,

            contentType: false,

            headers: {
                'Accept': 'application/json'
            },

            success: function (response) {

                if (!response.success) {

                    alert(
                        response.message ??
                        'Gagal menyimpan berita.'
                    );

                    return;
                }


                modalBerita.hide();

                loadBerita();


                alert(
                    response.message ??
                    'Berita berhasil disimpan.'
                );

            },

            error: function (xhr) {

                console.error(xhr);

                let message =
                    'Terjadi kesalahan saat menyimpan berita.';


                if (xhr.status === 422) {

                    const errors =
                        xhr.responseJSON?.errors;


                    if (errors) {

                        message = Object
                            .values(errors)
                            .flat()
                            .join('\n');

                    }

                } else if (
                    xhr.responseJSON?.message
                ) {

                    message =
                        xhr.responseJSON.message;

                }


                alert(message);

            },

            complete: function () {

                $('#btnSimpan')
                    .prop('disabled', false)
                    .html(`
                        <i class="ri-save-line me-1"></i>
                        Simpan
                    `);

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS
    |--------------------------------------------------------------------------
    */

    function hapusBerita(id) {

        if (
            !confirm(
                'Apakah Anda yakin ingin menghapus berita ini?'
            )
        ) {
            return;
        }


        $.ajax({

            url: `/api/v4/berita/${id}`,

            type: 'DELETE',

            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN':
                    $('meta[name="csrf-token"]').attr('content')
            },

            success: function (response) {

                alert(
                    response.message ??
                    'Berita berhasil dihapus.'
                );

                loadBerita();

            },

            error: function (xhr) {

                console.error(xhr);

                alert(
                    xhr.responseJSON?.message ??
                    'Gagal menghapus berita.'
                );

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | FORMAT TANGGAL
    |--------------------------------------------------------------------------
    */

    function formatTanggal(tanggal) {

        const date = new Date(tanggal);

        return date.toLocaleDateString(
            'id-ID',
            {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {

        if (value === null || value === undefined) {
            return '';
        }

        return $('<div>')
            .text(value)
            .html();

    }

    </script>

@endsection
