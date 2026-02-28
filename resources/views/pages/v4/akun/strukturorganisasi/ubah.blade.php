@extends('layouts.v4')

@section('content')
    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0">
                    <button class="btn btn-icon btn-outline-secondary btn-sm me-1"
                        onclick="window.location.href='{{ route('v4.akun.strukturorganisasi') }}'"
                        data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom"
                        data-bs-html="true" title="Kembali">
                        <i class="bx bx-chevron-left"></i>
                    </button>
                    <span class="align-middle pe-none">
                        Struktur <b class="text-primary">Organisasi</b>
                    </span>
                    <span class="badge bg-warning-transparent align-middle ms-1">ID # {{ $list['id'] }}</span>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Manajemen Akun</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a role="button" onclick="window.location.href='{{ route('v4.akun.strukturorganisasi') }}'">Struktur Organisasi</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Ubah
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Ubah <b class="text-warning">Data</b>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('v4.akun.strukturorganisasi.update', $list['id']) }}" method="POST" id="formUbah">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-4">
                                <label for="userx" class="form-label">Nama User</label>
                                <select id="userx" name="user" class="form-control select2" style="width: 100%" required>
                                    @if (count($list['user']) > 0)
                                        @foreach ($list['user'] as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == $list['id_user'] ? 'selected' : '' }}>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <sub>Pilih user yang akan mendapatkan akses laporan bawahannya</sub>
                            </div>

                            <div class="form-group mb-4">
                                <label for="bawahanx" class="form-label">Jabatan Struktural <b class="text-pink">Bawahan</b></label>
                                <select id="bawahanx"
                                        name="bawahan[]"
                                        class="select2 form-control select2-multiple"
                                        data-bs-auto-close="outside"
                                        multiple
                                        required
                                        style="width: 100%">

                                    @if (count($list['role']) > 0)
                                        @foreach ($list['role'] as $val)
                                            <option value="{{ $val->id }}"
                                                {{ in_array($val->id, $list['bawahan']) ? 'selected' : '' }}>
                                                {{ $val->name }}
                                            </option>
                                        @endforeach
                                    @endif

                                </select>
                                <sub>Pilih semua Role <b class="text-pink">bawahan</b></sub>
                            </div>

                            <button type="submit" class="btn btn-primary" id="btn-simpan" onclick="saveData()">
                                <i class="fas fa-save fa-md"></i>&nbsp;&nbsp;
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Ubah</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#userx").select2({
                placeholder: "",
            });
            $("#bawahanx").select2({
                placeholder: "",
            });
        })

        // FUNCTION
        function saveData() {
            $("#formUbah").one('submit', function() {
                $("#btn-simpan").attr('disabled', 'disabled');
                $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
                return true;
            });
        }
    </script>
@endsection