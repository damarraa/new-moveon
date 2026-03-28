@extends('layouts.app')

@section('page_title', 'Data Profiling Kapal')
@section('breadcrumb', 'Data Profiling Kapal')

@section('page_actions')
    <a href="{{ route('operator.profiling.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Data
    </a>
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
                                           class="btn btn-info btn-sm text-white table-action-btn"
                                           title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('operator.profiling.edit', $item->id) }}"
                                           class="btn btn-warning btn-sm table-action-btn"
                                           title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('operator.profiling.destroy', $item->id) }}"
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

            @if($profilings->isEmpty())
                <div class="table-empty-state">
                    Belum ada data profiling.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        initAppDataTable('#profilingTable', {
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

        $(document).on('click', '.btn-delete', function () {
            const form = $(this).closest('.delete-form')[0];
            confirmDelete(form);
        });
    });
</script>
@endpush