@extends('layouts.v4')

@section('content')

    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0 pe-none">
                    Detail Profil <b class="text-success link-underline-success text-decoration-underline">Pegawai</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item pe-none">
                        <a role="button">Administrasi</a>
                    </li>
                    <li class="breadcrumb-item pe-none" aria-current="page">
                        Profil Pegawai
                    </li>
                    <li class="breadcrumb-item pe-none active" aria-current="page">
                        Detail
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
                            title="Menampilkan Semua Data Laporan Rutin Bawahan">
                            <i class="ri-file-check-line me-1"></i> <span class="align-middle">Verifikasi Laporan Bawahan</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs border-0 tab-style-7" role="tablist" id="myTab">
                            <li class="nav-item">
                                <a class="nav-link active" id="btn-load-datadiri" data-bs-toggle="tab"
                                    href="#profil-pengguna" role="tab" aria-selected="true" onclick="loadDataDiri()">
                                    <i class="ti ti-user-check me-2"></i>Data Diri
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab"
                                    href="#kepegawaian" role="tab" aria-selected="true" onclick="showKepegawaian()">
                                    <i class="ti ti-sailboat me-2"></i>Kepegawaian
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab"
                                    href="#penetapan" role="tab" aria-selected="true" onclick="refreshPenetapan()">
                                    <i class="ti ti-license me-2"></i>Penetapan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab"
                                    href="#rotasi" role="tab" aria-selected="true" onclick="refreshRotasi()">
                                    <i class="ti ti-route me-2"></i>Rotasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab"
                                    href="#dokumen" role="tab" aria-selected="true" onclick="refreshDokumen()">
                                    <i class="ti ti-cloud-download me-2"></i>Dokumen
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab"
                                    href="#spkrkk" role="tab" aria-selected="true" onclick="refreshSpkRkk()">
                                    <i class="ti ti-brand-docker me-2"></i>SPK & RKK
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="profil-pengguna" role="tabpanel">
                            @include('pages.v4.sdi.profilpegawai.detail.datadiri')
                        </div>
                        <div class="tab-pane" id="kepegawaian" role="tabpanel">
                            @include('pages.v4.sdi.profilpegawai.detail.kepegawaian')
                        </div>
                        <div class="tab-pane" id="penetapan" role="tabpanel">
                            @include('pages.v4.sdi.profilpegawai.detail.penetapan')
                        </div>
                        <div class="tab-pane" id="rotasi" role="tabpanel">
                            @include('pages.v4.sdi.profilpegawai.detail.rotasi')
                        </div>
                        <div class="tab-pane" id="dokumen" role="tabpanel">
                            @include('pages.v4.sdi.profilpegawai.detail.dokumen')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let id_pegawai = @json($id_pegawai);
        let id_user = @json(Auth::user()->id);
        $(document).ready(function() {
            loadDataDiri();
        });
    </script>
@endsection
