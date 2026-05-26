@extends('layouts.v4')

@section('content')
    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Struktur <b class="text-primary">Organisasi</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Setting</a>
                    </li>
                    <li class="breadcrumb-item pe-none" aria-current="page">
                        Manajemen Akun
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Struktur Organisasi
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <button class="btn btn-outline-primary"
                            onclick="window.location.href='{{ route('v4.akun.strukturorganisasi.tambah') }}'">
                            <i class="fas fa-plus me-1"></i> Tambah Struktur Pegawai</button>
                    </div>
                    <div class="card-body table-responsive text-nowrap">
                        <table id="dttable" class="table dt-responsive table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="cell-fit">ID DB</th>
                                    <th class="cell-fit">ID USER</th>
                                    <th>NAMA USER (<b class="text-info">USERNAME</b>)</th>
                                    <th>ROLE USER</th>
                                    <th class="cell-fit">ROLE BAWAHAN</th>
                                    <th class="cell-fit">UPDATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($list['struktur_organisasi']) > 0)
                                    @foreach ($list['struktur_organisasi'] as $item)
                                        <tr>
                                            <td>
                                                <center>
                                                    <div class='btn-group'>
                                                        <a href="javascript:void(0)" class='link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover text-decoration-underline dropdown-toggle'
                                                            data-bs-toggle='dropdown' aria-expanded='false'>{{ $item->id }}
                                                        </a>
                                                        <ul class='dropdown-menu dropdown-menu-end'>
                                                            <li><a href='javascript:void(0);' class='dropdown-item text-warning'
                                                                    onclick="window.location.href='{{ url('v4/akun/strukturorganisasi/' . $item->id . '/ubah') }}'"><i
                                                                        class="fa-fw fas fa-edit nav-icon me-1"></i> Ubah</a></li>
                                                            <li><a href='javascript:void(0);' class='dropdown-item text-danger'
                                                                    onclick="hapus({{ $item->id }})"><i
                                                                        class="fa-fw fas fa-trash nav-icon me-1"></i> Hapus</a></li>
                                                        </ul>
                                                    </div>
                                                </center>
                                            </td>
                                            <td>{{ $item->id_user }}</td>
                                            <td>{{ $item->nama_user }}</td>
                                            <td>
                                                @foreach (json_decode($item->role) as $val)
                                                    @foreach ($list['roles'] as $key)
                                                        @if ($val == $key->id)
                                                            <span class="badge bg-primary-transparent">{{ $key->name }}</span>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </td>
                                            <td class="text-wrap">
                                                @foreach (json_decode($item->bawahan) as $val)
                                                    @foreach ($list['roles'] as $key)
                                                        @if ($val == $key->id)
                                                            <span class="badge bg-danger-transparent">{{ $key->name }}</span>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </td>
                                            <td>{{ $item->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit">ID DB</th>
                                    <th class="cell-fit">ID USER</th>
                                    <th>NAMA USER</th>
                                    <th>ROLE USER</th>
                                    <th class="cell-fit">ROLE BAWAHAN</th>
                                    <th class="cell-fit">UPDATE</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#dttable').DataTable({
                dom: 'Blfrtip',
                order: [
                    [5, "desc"]
                ],
                displayLength: 20,
                lengthChange: true,
                lengthMenu: [20, 35, 50, 75, 100, 500, 1000, 3000, 7000, 10000, 20000],
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible',
                            format: {
                                body: function (data, row, column, node) {
                                    return $(node).text().trim(); // buang HTML
                                }
                            }
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible',
                            format: {
                                body: function (data, row, column, node) {
                                    return $(node).text().trim();
                                }
                            }
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible',
                            format: {
                                body: function (data, row, column, node) {
                                    return $(node).text().trim();
                                }
                            }
                        }
                    },
                    'colvis'
                ]
            });
        })

        function hapus(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Hapus Permanen Akun Pengguna ID : ' + id,
                icon: 'warning',
                reverseButtons: false,
                showDenyButton: false,
                showCloseButton: false,
                showCancelButton: true,
                focusCancel: true,
                confirmButtonColor: '#FF4845',
                confirmButtonText: `<i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus`,
                cancelButtonText: `<i class="fa fa-times me-1" style="font-size:13px"></i>  Batal`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/api/strukturorganisasi/hapus/" + id,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Hapus Akun berhasil pada ' + res,
                                position: 'topRight'
                            });
                            window.location.reload();
                        },
                        error: function(res) {
                            Swal.fire({
                                title: `Gagal di hapus!`,
                                text: 'Pada ' + res,
                                icon: `error`,
                                showConfirmButton: false,
                                showCancelButton: false,
                                allowOutsideClick: true,
                                allowEscapeKey: true,
                                timer: 3000,
                                timerProgressBar: true,
                                backdrop: `rgba(26,27,41,0.8)`,
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection
