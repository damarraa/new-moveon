<div class="modal fade" id="showProfilingModal" tabindex="-1" aria-labelledby="showProfilingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
        <div class="modal-content profiling-modal-content">
            <div class="modal-header profiling-modal-header">
                <h5 class="modal-title fw-bold" id="showProfilingModalLabel">
                    <i class="bi bi-info-circle text-info me-2"></i>Detail Profiling Kapal
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body profiling-modal-body p-0">
                <div class="table-responsive m-0">
                    <table class="table table-bordered table-detail-profiling align-middle mb-0">
                        <tbody>
                            <tr>
                                <th>UUID Data</th>
                                <td><span id="show_uuid" class="user-select-all font-monospace text-muted"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Kapal</th>
                                <td><span id="show_nama_kapal"></span></td>
                            </tr>
                            <tr>
                                <th>Asal Keberangkatan</th>
                                <td><span id="show_asal"></span></td>
                            </tr>
                            <tr>
                                <th>Tujuan Keberangkatan</th>
                                <td><span id="show_tujuan"></span></td>
                            </tr>
                            <tr>
                                <th>Waktu Keberangkatan</th>
                                <td><span id="show_waktu" class="badge bg-primary-soft text-primary"></span></td>
                            </tr>
                            <tr>
                                <th>Kapasitas Penumpang</th>
                                <td><span id="show_kapasitas"></span></td>
                            </tr>
                            <tr>
                                <th>UUID Operator (User)</th>
                                <td><span id="show_uuid_user" class="user-select-all font-monospace text-muted"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer profiling-modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
