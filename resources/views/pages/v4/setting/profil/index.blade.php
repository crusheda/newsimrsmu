@extends('layouts.v4')

@section('content')
    <div class="container-fluid page-container main-body-container">
        <div class="page-header-breadcrumb mb-3">
            <div class="d-flex align-center justify-content-between flex-wrap">
                <h1 class="page-title fw-medium fs-18 mb-0">
                    Profil <b class="text-primary">Saya</b>
                </h1>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a role="button">Akun</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Profil Saya
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card custom-card profile-card">
                    <div class="profile-banner-image">
                        <img src="{{ asset('images/media/backgrounds/bgsubcrop.png') }}" class="card-img-top" alt="..." />
                    </div>
                    <div class="card-body p-4 pb-0 position-relative">
                        <div class="d-flex align-items-end justify-content-between flex-wrap">
                            <div>
                                <a data-lightbox="fotoProfil" data-title="Foto Profil" role="button" id="fotoProfil">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light-transparent online">
                                        <img id="imgProfil"
                                            src="{{ asset('images/white.jpg') }}"
                                            alt="Foto Profil"
                                            style="width:100%;height:100%;object-fit:cover">

                                        <!-- LOADING -->
                                        <div id="avatarLoading"
                                            class="position-absolute top-50 start-50 translate-middle">
                                            <div class="spinner-border spinner-border-sm"></div>
                                        </div>
                                    </span>
                                </a>
                                <div class="mt-4 mb-3 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                                    <div>
                                        <h5 class="fw-semibold mb-1" id="username"><i class="fas fa-sync-alt fa-spin"></i></h5>
                                        <p class="fs-12 mb-0 fw-medium text-muted">
                                            <span class="me-3">
                                                <i class="ri-shield-user-line me-1 align-middle"></i>Status : <a id="status_jabatan"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
                                            </span>
                                            <span class="me-3">
                                                <i class="ri-user-follow-line me-1 align-middle"></i><a id="status_akun"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
                                            </span>
                                            <span>
                                                <i class="ri-login-box-line me-1 align-middle"></i>Terakhir Login: <a id="log_akun"><i class="fas fa-sync-alt fa-spin ms-1"></i></a>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <ul class="nav nav-tabs mb-0 tab-style-8 scaleX" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="" data-bs-toggle="tab"
                                            data-bs-target="#profil-tab" type="button" role="tab"
                                            aria-controls="profil-tab" aria-selected="true" onclick="loadDataDiri()">
                                            Data Diri
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="" data-bs-toggle="tab"
                                            data-bs-target="#ubah-profil-tab" type="button" role="tab"
                                            aria-controls="ubah-profil-tab" aria-selected="false" onclick="loadUbah()">
                                            Ubah
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="" data-bs-toggle="tab"
                                            data-bs-target="#password-tab" type="button" role="tab"
                                            aria-controls="password-tab" aria-selected="false">
                                            Password
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="" data-bs-toggle="tab"
                                            data-bs-target="#dokumen-tab" type="button" role="tab"
                                            aria-controls="dokumen-tab" aria-selected="false" onclick="loadDokumen()">
                                            Dokumen
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation" hidden>
                                        <button class="nav-link" id="" data-bs-toggle="tab"
                                            data-bs-target="#spkrkk-tab" type="button" role="tab"
                                            aria-controls="spkrkk-tab" aria-selected="false">
                                            SPK & RKK
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="tab-content" id="">
                    <div class="tab-pane show active p-0 border-0" id="profil-tab" role="tabpanel" aria-labelledby="profil-tab" tabIndex="0">
                        @include('pages.v4.setting.profil.datadiri')
                    </div>
                    <div class="tab-pane p-0 border-0" id="ubah-profil-tab" role="tabpanel" aria-labelledby="ubah-profil-tab" tabIndex="0">
                        @include('pages.v4.setting.profil.ubah')
                    </div>
                    <div class="tab-pane p-0 border-0" id="password-tab" role="tabpanel" aria-labelledby="password-tab" tabIndex="0">
                        @include('pages.v4.setting.profil.password')
                    </div>
                    <div class="tab-pane p-0 border-0" id="dokumen-tab" role="tabpanel" aria-labelledby="dokumen-tab" tabIndex="0">
                        @include('pages.v4.setting.profil.dokumen')
                    </div>
                    <div class="tab-pane p-0 border-0" id="spkrkk-tab" role="tabpanel" aria-labelledby="spkrkk-tab" tabIndex="0">
                        @include('pages.v4.setting.profil.spkrkk')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            loadDataDiri();
        });
    </script>
@endsection
