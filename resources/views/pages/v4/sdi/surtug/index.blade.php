@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Berkas <b class="text-info link-underline-primary text-decoration-underline">Surat Tugas</b>
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
                <div class="card custom-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <div class="btn-group">
                            <button class="btn btn-primary btn-shadow" data-bs-toggle="modal" data-bs-target="#tambah">
                                <i class="ri-git-repository-commits-line me-1"></i> Upload Berkas
                            </button>
                            <button class="btn btn-warning btn-shadow" onclick="refresh()" id="btn-refresh" disabled>
                                <i class="ri-loop-left-line nav-icon"></i></button>
                        </div>
                        <button class="btn btn-info btn-shadow" id="btn-verif" onclick="verif()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Menampilkan Semua Data Surat Tugas Bawahan">
                            <i class="ri-file-check-line me-1"></i> <span class="align-middle">Verifikasi Surat Tugas Bawahan</span>
                        </button>
                    </div>
                    <div class="card-body">

                        {{-- MY CONTENT --}}

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
