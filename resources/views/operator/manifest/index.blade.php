@extends('layouts.app')

@section('page_title', 'Data Manifest')
@section('breadcrumb', 'Data Manifest')

@section('page_actions')
@endsection

@section('content')
<div class="app-page">
    <div class="content-card">
        <div class="card-body">

            <div class="table-responsive">
                <table id="manifestTable" class="table app-table align-middle manifest-table" style="width:100%">
                    <thead>
                        <tr>
                            <th class="table-control-col"></th>
                            <th style="width:70px;">No</th>
                            <th>Nama Kapal</th>
                            <th>Jenis</th>
                            <th>Asal</th>
                            <th>Tujuan</th>
                            <th style="width:100px;">Tanggal</th>
                            <th style="width:100px;">Jam</th>
                            <th style="width:100px;">Penumpang</th>
                            <th class="table-action-col text-center" style="width:80px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($manifests as $item)
                            <tr>
                                <td></td>

                                <td class="text-muted">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Nama Kapal --}}
                                <td class="fw-semibold text-dark">
                                    {{ $item->nama_kapal ?? ($item->profiling->nama_kapal ?? '-') }}
                                </td>

                                {{-- Jenis Layanan --}}
                                <td>
                                    <span class="badge-service {{ ($item->jenis_layanan ?? '') === 'penyeberangan' ? 'badge-penyeberangan' : 'badge-pelayaran' }}">
                                        {{ ucfirst($item->jenis_layanan ?? '-') }}
                                    </span>
                                </td>

                                {{-- Asal --}}
                                <td class="text-muted">
                                    {{ $item->asal ?? '-' }}
                                </td>

                                {{-- Tujuan --}}
                                <td class="text-muted">
                                    {{ $item->tujuan ?? '-' }}
                                </td>

                                {{-- Tanggal --}}
                                <td class="text-nowrap">
                                    {{ !empty($item->tanggal_berangkat) 
                                        ? \Carbon\Carbon::parse($item->tanggal_berangkat)->format('d-m-Y') 
                                        : '-' }}
                                </td>

                                {{-- Jam --}}
                                <td class="text-nowrap">
                                    {{ !empty($item->jam_berangkat) 
                                        ? \Carbon\Carbon::parse($item->jam_berangkat)->format('H:i') 
                                        : '-' }}
                                </td>

                                {{-- Jumlah Penumpang --}}
                                <td class="fw-semibold text-primary">
                                    {{ (int) ($item->jumlah_penumpang_group ?? $item->jumlah_penumpang ?? 0) }}
                                </td>

                                {{-- Aksi --}}
                                <td class="text-center">
                                    <a href="{{ route('operator.manifest.show', $item->group_key) }}"
                                       class="btn btn-sm btn-primary table-action-btn"
                                       title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Empty State --}}
            @if($manifests->isEmpty())
                <div class="table-empty-state text-center py-4 text-muted">
                    Belum ada data manifest.
                </div>
            @endif

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>

    /* TABLE */
    .manifest-table tbody tr td {
        vertical-align: middle;
        padding-top: .7rem;
        padding-bottom: .7rem;
    }

    .manifest-table tbody tr {
        transition: all .2s ease;
    }

    .manifest-table tbody tr:hover {
        background: #f9fbff;
    }

    /* BADGE JENIS LAYANAN (lebih kecil & clean) */
    .badge-service {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: .25rem .6rem;
        border-radius: 6px;
        font-size: .75rem;
        font-weight: 600;
        line-height: 1;
        white-space: nowrap;
    }

    .badge-pelayaran {
        background: #f5e7d5;
        color: #c56b08;
    }

    .badge-penyeberangan {
        background: #d9f2f8;
        color: #0c88a0;
    }

    /* BUTTON AKSI */
    .table-action-btn {
        padding: .35rem .55rem;
        border-radius: 6px;
    }

    /* EMPTY STATE */
    .table-empty-state {
        font-size: .95rem;
    }

    /* MOBILE */
    @media (max-width: 768px) {

        .badge-service {
            font-size: .7rem;
            padding: .2rem .5rem;
        }

        .manifest-table tbody tr td {
            padding-top: .6rem;
            padding-bottom: .6rem;
        }
    }

</style>
@endpush

@push('scripts')
<script>
    $(function () {
        initAppDataTable('#manifestTable', {
            columnDefs: [
                { orderable: false, searchable: false, className: 'dtr-control', targets: 0 },
                { orderable: false, searchable: false, targets: 9 },
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 2 },
                { responsivePriority: 3, targets: 9 }
            ]
        });
    });
</script>
@endpush