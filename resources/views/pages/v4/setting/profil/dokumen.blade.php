<div class="card custom-card">
    <div class="card-header fw-bold justify-content-between">
        <div>
            Daftar
            <b class="text-teal">
                Upload Dokumen
            </b>
        </div>
        <div>
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-warning-light btn-wave">
                    <i class="fas fa-sync me-1" data-bs-toggle="tooltip"
                        title="Refresh Daftar Dokumen Upload"></i>
                    Refresh Tabel
                </button>
            </div>
        </div>
    </div>
    <div class="card-body pb-0">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0 flex-grow-1">
                <a class="text-danger">*</a>
                /x
                <small>
                    dokumen wajib sudah
                    terupload.
                </small>
            </h5>
            <div class="flex-shrink-0" id="switch-str" hidden>
                <div class="form-check form-switch custom-switch-v1 switch-sm">
                    <input type="checkbox" class="form-check-input input-primary"
                        id="checkboxseumurhidup" />
                    <label class="form-check-label" htmlFor="checkboxseumurhidup">
                        Seumur Hidup ?
                    </label>
                </div>
            </div>
        </div>
        <hr class="my-2" />
        <div class="row">
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label">
                        Jenis Surat
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <select class="form-control" id="jenis_dokumen" ref={jenisRef}
                        defaultValue="">
                        <option value="" hidden>
                            Pilih Jenis Surat
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label">
                        Tgl. Mulai Berlaku
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <input type="date" class="form-control" id="tgl_mulai_dokumen" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label">
                        Tgl. Berakhir Surat
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <input type="date" class="form-control" id="tgl_akhir_dokumen" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label class="form-label">
                        Nomor Surat
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <input type="text" class="form-control" id="no_surat_dokumen"
                        placeholder="e.g. III.l23213.AKBV" />
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group mb-3">
                    <label class="form-label">
                        Deskripsi
                    </label>
                    <textarea class="form-control" id="deskripsi_dokumen" placeholder="Tuliskan Keterangan (Optional)" rows="3"></textarea>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group mb-3 d-flex flex-column">
                    <label class="form-label">
                        Upload Dokumen
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <div class="row mb-2">
                        <div class="col">
                            <input type="file" class="form-control form-control-sm"
                                id="upload_dokumen" accept="application/pdf" />
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary" id="btn-upload-dokumen">
                                <i class="fas fa-upload me-1"></i>
                                Upload
                            </button>
                        </div>
                    </div>
                    <span class="d-block fs-12 text-muted mt-1">
                        Ekstensi Wajib
                        <mark>PDF</mark>.
                        Maksimal <b>2MB</b>.
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mb-0 table-hover text-nowrap w-100 dataTable no-footer"
                id="dttable-dokumen">
                <thead>
                    <tr>
                        <th>
                            <center>
                                AKSI
                            </center>
                        </th>
                        <th>DOKUMEN SURAT</th>
                        <th>DESKRIPSI</th>
                        <th>
                            <center>
                                STATUS
                            </center>
                        </th>
                        <th class="text-end">
                            TERAKHIR DIPERBARUI
                        </th>
                    </tr>
                </thead>
                <tbody id="tampil-tbody-dokumen">
                    <tr>
                        <td colSpan="9" style="font-size: 13px">
                            <center>
                                <i class="fa fa-spinner fa-spin fa-fw"></i>
                                Memproses
                                data...
                            </center>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>