<div class="modal fade" id="showPelaporanKapalModal" tabindex="-1" aria-labelledby="showPelaporanKapalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
        <div class="modal-content pelaporan-kapal-modal-content">
            <div class="modal-header pelaporan-kapal-modal-header">
                <h5 class="modal-title fw-bold" id="showPelaporanKapalModalLabel">
                    <i class="bi bi-info-circle text-info me-2"></i>Detail Pelaporan Kapal
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body pelaporan-kapal-modal-body p-0">
                <div class="table-responsive m-0">
                    <table class="table table-bordered table-detail-pelaporan align-middle mb-0">
                        <tbody>
                            <tr>
                                <th>UUID Data</th>
                                <td><span id="show_pelaporan_uuid"
                                        class="user-select-all font-monospace text-muted"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Kapal</th>
                                <td><span id="show_pelaporan_nama"></span></td>
                            </tr>
                            <tr>
                                <th>Status Operasi</th>
                                <td id="show_pelaporan_status"></td>
                            </tr>
                            <tr>
                                <th>Lama Tidak Beroperasi</th>
                                <td><span id="show_pelaporan_lama"></span></td>
                            </tr>
                            <tr>
                                <th>UUID Operator (User)</th>
                                <td><span id="show_pelaporan_user"
                                        class="user-select-all font-monospace text-muted"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer pelaporan-kapal-modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
