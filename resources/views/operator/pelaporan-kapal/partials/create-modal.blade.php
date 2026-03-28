<div class="modal fade" id="createPelaporanKapalModal" tabindex="-1" aria-labelledby="createPelaporanKapalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
        <div class="modal-content pelaporan-kapal-modal-content">
            <div class="modal-header pelaporan-kapal-modal-header">
                <div>
                    <h5 class="modal-title mb-1" id="createPelaporanKapalModalLabel">Tambah Pelaporan Kapal</h5>
                    <small class="text-muted">Silakan isi data pelaporan kapal dengan lengkap</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('operator.pelaporan-kapal.store') }}" method="POST" id="createPelaporanKapalForm">
                @csrf

                <div class="modal-body pelaporan-kapal-modal-body">
                    <div class="row g-3">
                        <div class="col-12">
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
                            <label class="form-label">Status Operasi</label>
                            <select name="status_operasi" class="form-select @error('status_operasi') is-invalid @enderror">
                                <option value="">Pilih status operasi</option>
                                <option value="Docking" {{ old('status_operasi') == 'Docking' ? 'selected' : '' }}>Docking</option>
                                <option value="Rusak Sementara" {{ old('status_operasi') == 'Rusak Sementara' ? 'selected' : '' }}>Rusak Sementara</option>
                                <option value="Rusak Selamanya" {{ old('status_operasi') == 'Rusak Selamanya' ? 'selected' : '' }}>Rusak Selamanya</option>
                                <option value="Ubah Sifat" {{ old('status_operasi') == 'Ubah Sifat' ? 'selected' : '' }}>Ubah Sifat</option>
                            </select>
                            @error('status_operasi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label">Lama Tidak Beroperasi</label>
                            <select name="lama_tidak_beroperasi" class="form-select @error('lama_tidak_beroperasi') is-invalid @enderror">
                                <option value="">Pilih lama tidak beroperasi</option>
                                <option value="1-3 Bulan" {{ old('lama_tidak_beroperasi') == '1-3 Bulan' ? 'selected' : '' }}>1 - 3 Bulan</option>
                                <option value="3-6 Bulan" {{ old('lama_tidak_beroperasi') == '3-6 Bulan' ? 'selected' : '' }}>3 - 6 Bulan</option>
                                <option value="6-12 Bulan" {{ old('lama_tidak_beroperasi') == '6-12 Bulan' ? 'selected' : '' }}>6 - 12 Bulan</option>
                                <option value="Selamanya" {{ old('lama_tidak_beroperasi') == 'Selamanya' ? 'selected' : '' }}>Selamanya</option>
                            </select>
                            @error('lama_tidak_beroperasi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer pelaporan-kapal-modal-footer">
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