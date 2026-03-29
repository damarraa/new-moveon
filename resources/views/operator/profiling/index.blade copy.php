@extends('layouts.app')

@section('page_title', 'Data Profiling Kapal')
@section('breadcrumb', 'Data Profiling Kapal')

@section('page_actions')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProfilingModal">
        <i class="bi bi-plus-lg me-1"></i> Tambah Data
    </button>
@endsection

@section('content')
    <div class="app-page">
        <div class="content-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="profilingTable" class="table app-table align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th class="table-control-col"></th>
                                <th>No</th>
                                <th>Nama Kapal</th>
                                <th>Asal Keberangkatan</th>
                                <th>Tujuan Keberangkatan</th>
                                <th>Waktu Keberangkatan</th>
                                <th>Kapasitas Penumpang</th>
                                <th class="table-action-col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($profilings as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_kapal }}</td>
                                    <td>{{ $item->asal_keberangkatan }}</td>
                                    <td>{{ $item->tujuan_keberangkatan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->waktu_keberangkatan)->format('d-m-Y H:i') }}</td>
                                    <td>{{ $item->kapasitas_penumpang }}</td>
                                    <td class="table-action-cell">
                                        <div class="table-action-wrap">
                                            <a href="{{ route('operator.profiling.show', $item->id) }}"
                                                class="btn btn-info btn-sm text-white table-action-btn" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <button type="button"
                                                class="btn btn-warning btn-sm table-action-btn btn-edit-profiling"
                                                title="Edit" data-bs-toggle="modal" data-bs-target="#editProfilingModal"
                                                data-id="{{ $item->id }}" data-nama_kapal="{{ $item->nama_kapal }}"
                                                data-asal_keberangkatan="{{ $item->asal_keberangkatan }}"
                                                data-tujuan_keberangkatan="{{ $item->tujuan_keberangkatan }}"
                                                data-waktu_keberangkatan="{{ \Carbon\Carbon::parse($item->waktu_keberangkatan)->format('Y-m-d\TH:i') }}"
                                                data-kapasitas_penumpang="{{ $item->kapasitas_penumpang }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

                                            <form action="{{ route('operator.profiling.destroy', $item->id) }}"
                                                method="POST" class="d-inline-block m-0 delete-form">
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

                @if ($profilings->isEmpty())
                    <div class="table-empty-state">
                        Belum ada data profiling.
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('operator.profiling.partials.create-modal')
    @include('operator.profiling.partials.edit-modal')
@endsection

@push('styles')
    <style>
        .profiling-modal-content {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.16);
        }

        .profiling-modal-header {
            padding: 1rem 1.2rem;
            border-bottom: 1px solid #e9eef5;
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
        }

        .profiling-modal-body {
            padding: 1.2rem;
            background: #ffffff;
        }

        .profiling-modal-footer {
            padding: 1rem 1.2rem;
            border-top: 1px solid #e9eef5;
            background: #fff;
        }

        .profiling-modal-body .form-label {
            font-weight: 600;
            margin-bottom: .45rem;
            color: #334155;
        }

        .profiling-modal-body .form-control {
            min-height: 44px;
        }

        .modal-fullscreen-sm-down .profiling-modal-content {
            border-radius: 0;
        }

        @media (max-width: 575.98px) {

            .profiling-modal-header,
            .profiling-modal-body,
            .profiling-modal-footer {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .profiling-modal-footer {
                display: flex;
                flex-direction: column-reverse;
                gap: .65rem;
            }

            .profiling-modal-footer .btn {
                width: 100%;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(function() {
            initAppDataTable('#profilingTable', {
                columnDefs: [{
                        orderable: false,
                        searchable: false,
                        className: 'dtr-control',
                        targets: 0
                    },
                    {
                        orderable: false,
                        searchable: false,
                        targets: 7
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
                        targets: 5
                    },
                    {
                        responsivePriority: 4,
                        targets: 6
                    },
                    {
                        responsivePriority: 1,
                        targets: 7
                    }
                ]
            });

            $(document).on('click', '.btn-delete', function() {
                const form = $(this).closest('.delete-form')[0];
                confirmDelete(form);
            });

            $(document).on('click', '.btn-edit-profiling', function() {
                const button = $(this);
                const id = button.data('id');

                $('#editProfilingForm').attr('action', `/operator/profiling/${id}`);
                $('#edit_nama_kapal').val(button.data('nama_kapal'));
                $('#edit_asal_keberangkatan').val(button.data('asal_keberangkatan'));
                $('#edit_tujuan_keberangkatan').val(button.data('tujuan_keberangkatan'));
                $('#edit_waktu_keberangkatan').val(button.data('waktu_keberangkatan'));
                $('#edit_kapasitas_penumpang').val(button.data('kapasitas_penumpang'));
            });

            @if ($errors->any())
                const createModalEl = document.getElementById('createProfilingModal');
                if (createModalEl) {
                    const createModal = new bootstrap.Modal(createModalEl);
                    createModal.show();
                }
            @endif
        });
    </script>
@endpush
