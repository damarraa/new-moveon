<div class="modal fade" id="editProfilingModal" tabindex="-1" aria-labelledby="editProfilingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
        <div class="modal-content profiling-modal-content">
            <div class="modal-header profiling-modal-header">
                <div>
                    <h5 class="modal-title mb-1" id="editProfilingModalLabel">Edit Data Profiling</h5>
                    <small class="text-muted">Ubah data kapal sesuai kebutuhan</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" method="POST" id="editProfilingForm">
                @csrf
                @method('PUT')

                <div class="modal-body profiling-modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Nama Kapal</label>
                            <input type="text"
                                   name="nama_kapal"
                                   id="edit_nama_kapal"
                                   class="form-control"
                                   placeholder="Masukkan nama kapal">
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label">Kapasitas Penumpang</label>
                            <input type="number"
                                   name="kapasitas_penumpang"
                                   id="edit_kapasitas_penumpang"
                                   class="form-control"
                                   min="1"
                                   placeholder="Masukkan kapasitas penumpang">
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label">Asal Keberangkatan</label>
                            <input type="text"
                                   name="asal_keberangkatan"
                                   id="edit_asal_keberangkatan"
                                   class="form-control"
                                   placeholder="Masukkan asal keberangkatan">
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label">Tujuan Keberangkatan</label>
                            <input type="text"
                                   name="tujuan_keberangkatan"
                                   id="edit_tujuan_keberangkatan"
                                   class="form-control"
                                   placeholder="Masukkan tujuan keberangkatan">
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label">Waktu Keberangkatan</label>
                            <input type="datetime-local"
                                   name="waktu_keberangkatan"
                                   id="edit_waktu_keberangkatan"
                                   class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer profiling-modal-footer">
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