@extends('layouts.app')

@section('page_title', 'Detail Pelaporan Kapal')
@section('breadcrumb', 'Detail Pelaporan Kapal')

@section('page_actions')
    <div class="d-flex flex-column flex-sm-row gap-2">
        <a href="{{ route('operator.pelaporan-kapal.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>

        <button type="button"
                class="btn btn-primary btn-edit-pelaporan-kapal"
                data-bs-toggle="modal"
                data-bs-target="#editPelaporanKapalModal"
                data-id="{{ $pelaporanKapal->id }}"
                data-nama_kapal="{{ $pelaporanKapal->nama_kapal }}"
                data-status_operasi="{{ $pelaporanKapal->status_operasi }}"
                data-lama_tidak_beroperasi="{{ $pelaporanKapal->lama_tidak_beroperasi }}">
            <i class="bi bi-pencil-square me-1"></i> Edit
        </button>
    </div>
@endsection

@section('content')
<div class="app-page">
    <div class="content-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table app-table align-middle mb-0">
                    <tbody>
                        <tr>
                            <th style="width: 280px;">UUID Data</th>
                            <td>{{ $pelaporanKapal->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama Kapal</th>
                            <td>{{ $pelaporanKapal->nama_kapal }}</td>
                        </tr>
                        <tr>
                            <th>Status Operasi</th>
                            <td>{{ $pelaporanKapal->status_operasi }}</td>
                        </tr>
                        <tr>
                            <th>Lama Tidak Beroperasi</th>
                            <td>{{ $pelaporanKapal->lama_tidak_beroperasi }}</td>
                        </tr>
                        <tr>
                            <th>UUID User</th>
                            <td>{{ $pelaporanKapal->user_id }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('operator.pelaporan-kapal.partials.edit-modal')
@endsection

@push('scripts')
<script>
$(document).on('click', '.btn-edit-pelaporan-kapal', function () {
    const button = $(this);
    const id = button.data('id');

    $('#editPelaporanKapalForm').attr('action', `/operator/pelaporan-kapal/${id}`);
    $('#edit_nama_kapal').val(button.data('nama_kapal'));
    $('#edit_status_operasi').val(button.data('status_operasi'));
    $('#edit_lama_tidak_beroperasi').val(button.data('lama_tidak_beroperasi'));
});
</script>
@endpush