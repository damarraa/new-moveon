@extends('layouts.app')

@section('page_title', 'Pelaporan Kapal')
@section('breadcrumb', 'Pelaporan Kapal')

@section('page_actions')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPelaporanKapalModal">
        <i class="bi bi-plus-lg me-1"></i> Tambah Data
    </button>
@endsection

@section('content')
<div class="app-page">
    <div class="content-card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="pelaporanKapalTable" class="table app-table align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th class="table-control-col"></th>
                            <th>No</th>
                            <th>Nama Kapal</th>
                            <th>Status Operasi</th>
                            <th>Lama Tidak Beroperasi</th>
                            <th class="table-action-col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelaporanKapals as $item)
                            <tr>
                                <td></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_kapal }}</td>
                                <td>{{ $item->status_operasi }}</td>
                                <td>{{ $item->lama_tidak_beroperasi }}</td>
                                <td class="table-action-cell">
                                    <div class="table-action-wrap">
                                        <a href="{{ route('operator.pelaporan-kapal.show', $item->id) }}"
                                           class="btn btn-info btn-sm text-white table-action-btn"
                                           title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <button type="button"
                                                class="btn btn-warning btn-sm table-action-btn btn-edit-pelaporan-kapal"
                                                title="Edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editPelaporanKapalModal"
                                                data-id="{{ $item->id }}"
                                                data-nama_kapal="{{ $item->nama_kapal }}"
                                                data-status_operasi="{{ $item->status_operasi }}"
                                                data-lama_tidak_beroperasi="{{ $item->lama_tidak_beroperasi }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <form action="{{ route('operator.pelaporan-kapal.destroy', $item->id) }}"
                                              method="POST"
                                              class="d-inline-block m-0 delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="btn btn-danger btn-sm table-action-btn btn-delete"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($pelaporanKapals->isEmpty())
                <div class="table-empty-state">
                    Belum ada data pelaporan kapal.
                </div>
            @endif
        </div>
    </div>
</div>

@include('operator.pelaporan-kapal.partials.create-modal')
@include('operator.pelaporan-kapal.partials.edit-modal')
@endsection

@push('styles')
<style>
    .pelaporan-kapal-modal-content {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.16);
    }

    .pelaporan-kapal-modal-header {
        padding: 1rem 1.2rem;
        border-bottom: 1px solid #e9eef5;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
    }

    .pelaporan-kapal-modal-body {
        padding: 1.2rem;
        background: #ffffff;
    }

    .pelaporan-kapal-modal-footer {
        padding: 1rem 1.2rem;
        border-top: 1px solid #e9eef5;
        background: #fff;
    }

    .pelaporan-kapal-modal-body .form-label {
        font-weight: 600;
        margin-bottom: .45rem;
        color: #334155;
    }

    .pelaporan-kapal-modal-body .form-control,
    .pelaporan-kapal-modal-body .form-select {
        min-height: 44px;
    }

    .modal-fullscreen-sm-down .pelaporan-kapal-modal-content {
        border-radius: 0;
    }

    @media (max-width: 575.98px) {
        .pelaporan-kapal-modal-header,
        .pelaporan-kapal-modal-body,
        .pelaporan-kapal-modal-footer {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .pelaporan-kapal-modal-footer {
            display: flex;
            flex-direction: column-reverse;
            gap: .65rem;
        }

        .pelaporan-kapal-modal-footer .btn {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    $(function () {
        initAppDataTable('#pelaporanKapalTable', {
            columnDefs: [
                {
                    orderable: false,
                    searchable: false,
                    className: 'dtr-control',
                    targets: 0
                },
                {
                    orderable: false,
                    searchable: false,
                    targets: 5
                },
                {
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: 2
                },
                {
                    responsivePriority: 3,
                    targets: 3
                },
                {
                    responsivePriority: 4,
                    targets: 4
                },
                {
                    responsivePriority: 1,
                    targets: 5
                }
            ]
        });

        $(document).on('click', '.btn-delete', function () {
            const form = $(this).closest('.delete-form')[0];
            confirmDelete(form);
        });

        $(document).on('click', '.btn-edit-pelaporan-kapal', function () {
            const button = $(this);
            const id = button.data('id');

            $('#editPelaporanKapalForm').attr('action', `/operator/pelaporan-kapal/${id}`);
            $('#edit_nama_kapal').val(button.data('nama_kapal'));
            $('#edit_status_operasi').val(button.data('status_operasi'));
            $('#edit_lama_tidak_beroperasi').val(button.data('lama_tidak_beroperasi'));
        });

        @if ($errors->any())
            const createModalEl = document.getElementById('createPelaporanKapalModal');
            if (createModalEl) {
                const createModal = new bootstrap.Modal(createModalEl);
                createModal.show();
            }
        @endif
    });
</script>
@endpush