@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    <b class="text-secondary link-underline-secondary text-decoration-underline">Elektronik</b> <b class="text-teal link-underline-teal text-decoration-underline">Pinjam</b> (<b class="text-secondary">E</b>-<b class="text-teal">Pinjam</b>)
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">IT</a>
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        E-Pinjam
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-5">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">Form <b class="text-secondary">Tambah</b></h6>
                        <div class="btn-group">
                            {{-- <button class="btn btn-sm btn-primary btn-shadow" data-bs-toggle="modal" data-bs-target="#tambah">
                                <i class="ri-git-repository-commits-line me-1"></i> Upload Berkas
                            </button> --}}
                            <button class="btn btn-sm btn-warning btn-shadow" onclick="refresh()" id="btn-refresh" disabled>
                                <i class="ri-loop-left-line nav-icon"></i></button>
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"></label>
                                <input type="text" class="form-control" id="" placeholder="Masukkan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            sss
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">Riwayat <b class="text-teal">Peminjaman</b></h6>
                        <div class="btn-group">
                            {{-- <button class="btn btn-sm btn-primary btn-shadow" data-bs-toggle="modal" data-bs-target="#tambah">
                                <i class="ri-git-repository-commits-line me-1"></i> Upload Berkas
                            </button> --}}
                            <button class="btn btn-sm btn-warning btn-shadow" onclick="refresh()" id="btn-refresh" disabled>
                                <i class="ri-loop-left-line nav-icon"></i></button>
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            s
                        </div>
                        <div class="col-md-6">
                            sss
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
