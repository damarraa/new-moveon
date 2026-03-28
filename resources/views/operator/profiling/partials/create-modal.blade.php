<div class="modal fade" id="createProfilingModal" tabindex="-1" aria-labelledby="createProfilingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
        <div class="modal-content profiling-modal-content">
            <div class="modal-header profiling-modal-header">
                <div>
                    <h5 class="modal-title mb-1" id="createProfilingModalLabel">Tambah Data Profiling</h5>
                    <small class="text-muted">Silakan isi data kapal dengan lengkap</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('operator.profiling.store') }}" method="POST" id="createProfilingForm">
                @csrf

                <div class="modal-body profiling-modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Nama Kapal</label>
                            <input type="text"
                                   name="nama_kapal"
                                   class="form-control @error('nama_kapal') is-invalid @enderror"
                                   value="{{ old('nama_kapal') }}"
                                   placeholder="Masukkan nama kapal">
                            @error('nama_kapal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label">Kapasitas Penumpang</label>
                            <input type="number"
                                   name="kapasitas_penumpang"
                                   class="form-control @error('kapasitas_penumpang') is-invalid @enderror"
                                   min="1"
                                   value="{{ old('kapasitas_penumpang') }}"
                                   placeholder="Masukkan kapasitas penumpang">
                            @error('kapasitas_penumpang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label">Asal Keberangkatan</label>
                            <input type="text"
                                   name="asal_keberangkatan"
                                   class="form-control @error('asal_keberangkatan') is-invalid @enderror"
                                   value="{{ old('asal_keberangkatan') }}"
                                   placeholder="Masukkan asal keberangkatan">
                            @error('asal_keberangkatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label">Tujuan Keberangkatan</label>
                            <input type="text"
                                   name="tujuan_keberangkatan"
                                   class="form-control @error('tujuan_keberangkatan') is-invalid @enderror"
                                   value="{{ old('tujuan_keberangkatan') }}"
                                   placeholder="Masukkan tujuan keberangkatan">
                            @error('tujuan_keberangkatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label">Waktu Keberangkatan</label>
                            <input type="datetime-local"
                                   name="waktu_keberangkatan"
                                   class="form-control @error('waktu_keberangkatan') is-invalid @enderror"
                                   value="{{ old('waktu_keberangkatan') }}">
                            @error('waktu_keberangkatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer profiling-modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>