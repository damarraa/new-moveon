<div class="modal fade" id="editPelaporanKapalModal" tabindex="-1" aria-labelledby="editPelaporanKapalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
        <div class="modal-content pelaporan-kapal-modal-content">
            <div class="modal-header pelaporan-kapal-modal-header">
                <div>
                    <h5 class="modal-title mb-1" id="editPelaporanKapalModalLabel">Edit Pelaporan Kapal</h5>
                    <small class="text-muted">Ubah data pelaporan kapal sesuai kebutuhan</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" method="POST" id="editPelaporanKapalForm">
                @csrf
                @method('PUT')

                <div class="modal-body pelaporan-kapal-modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Nama Kapal</label>
                            <input type="text"
                                   name="nama_kapal"
                                   id="edit_nama_kapal"
                                   class="form-control"
                                   placeholder="Masukkan nama kapal">
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label">Status Operasi</label>
                            <select name="status_operasi" id="edit_status_operasi" class="form-select">
                                <option value="Docking">Docking</option>
                                <option value="Rusak Sementara">Rusak Sementara</option>
                                <option value="Rusak Selamanya">Rusak Selamanya</option>
                                <option value="Ubah Sifat">Ubah Sifat</option>
                            </select>
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label">Lama Tidak Beroperasi</label>
                            <select name="lama_tidak_beroperasi" id="edit_lama_tidak_beroperasi" class="form-select">
                                <option value="1-3 Bulan">1 - 3 Bulan</option>
                                <option value="3-6 Bulan">3 - 6 Bulan</option>
                                <option value="6-12 Bulan">6 - 12 Bulan</option>
                                <option value="Selamanya">Selamanya</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer pelaporan-kapal-modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>