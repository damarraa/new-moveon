@extends('layouts.app')

@section('page_title', 'Detail Manifest')
@section('breadcrumb', 'Detail Manifest')

@section('page_actions')
    <div class="d-flex flex-column flex-sm-row gap-2">
        <a href="{{ route('operator.manifest.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
@endsection

@section('content')
<div class="app-page">
    <div class="content-card mb-3">
        <div class="card-body">
            <div class="detail-header-card">
                <div class="detail-header-title">
                    {{ $manifest->nama_kapal }}
                </div>

                <div class="detail-header-inline">
                    <span class="detail-type-badge {{ $manifest->jenis_layanan === 'penyeberangan' ? 'badge-penyeberangan' : 'badge-pelayaran' }}">
                        {{ ucfirst($manifest->jenis_layanan) }}
                    </span>

                    <span class="detail-inline-item">
                        <strong>Rute:</strong> {{ $manifest->asal }} - {{ $manifest->tujuan }}
                    </span>

                    <span class="detail-inline-item">
                        <strong>Jadwal:</strong>
                        {{ !empty($manifest->tanggal_berangkat) ? \Carbon\Carbon::parse($manifest->tanggal_berangkat)->format('d-m-Y') : '-' }}
                        •
                        {{ !empty($manifest->jam_berangkat) ? \Carbon\Carbon::parse($manifest->jam_berangkat)->format('H:i') : '-' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="detail-summary-grid mb-3">
        <div class="summary-card">
            <div class="summary-label">Total Penumpang</div>
            <div class="summary-value">{{ $manifest->jumlah_penumpang }}</div>
        </div>

        <div class="summary-card">
            <div class="summary-label">Total Kendaraan</div>
            <div class="summary-value">{{ $manifest->jumlah_kendaraan }}</div>
        </div>

        <div class="summary-card">
            <div class="summary-label">Total Kelompok</div>
            <div class="summary-value">{{ $manifest->jumlah_kelompok }}</div>
        </div>

        <div class="summary-card">
            <div class="summary-label">Total Check-in</div>
            <div class="summary-value">{{ $manifest->group_count }}</div>
        </div>
    </div>

    <div class="content-card mb-3">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                <h5 class="mb-0">Data Penumpang Keseluruhan</h5>
                <span class="detail-passenger-badge">
                    Total {{ $manifest->penumpangs->count() }} Penumpang
                </span>
            </div>

            <div class="table-responsive">
                <table class="table app-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width:70px;">No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th style="width:180px;">Tanggal Lahir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($manifest->penumpangs as $penumpang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penumpang->nik ?? '-' }}</td>
                                <td>{{ $penumpang->nama ?? '-' }}</td>
                                <td>
                                    {{ !empty($penumpang->tanggal_lahir) ? \Carbon\Carbon::parse($penumpang->tanggal_lahir)->format('d-m-Y') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada data penumpang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="content-card mb-3">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                <h5 class="mb-0">Data Kendaraan Keseluruhan</h5>
                <span class="detail-passenger-badge">
                    Total {{ $manifest->kendaraans->count() }} Kendaraan
                </span>
            </div>

            <div class="table-responsive">
                <table class="table app-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width:70px;">No</th>
                            <th>No. WhatsApp</th>
                            <th>Jenis Kendaraan</th>
                            <th>Plat Nomor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($manifest->kendaraans as $kendaraan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kendaraan->telepon ?? '-' }}</td>
                                <td>{{ $kendaraan->jenis_kendaraan ?? '-' }}</td>
                                <td>{{ $kendaraan->plat_nomor ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada data kendaraan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                <h5 class="mb-0">Data Berdasarkan Kelompok</h5>
                <span class="detail-passenger-badge">
                    Total {{ $manifest->kelompoks->count() }} Kelompok
                </span>
            </div>

            <div class="group-list">
                @forelse($manifest->kelompoks as $kelompok)
                    <div class="group-card">
                        <div class="group-card-header">
                            <div class="group-title">No. WhatsApp: {{ $kelompok->telepon }}</div>
                            <div class="group-meta">
                                {{ $kelompok->jumlah_penumpang }} penumpang •
                                {{ $kelompok->jumlah_kendaraan }} kendaraan •
                                {{ $kelompok->jumlah_data }} data check-in
                            </div>
                        </div>

                        <div class="group-card-body">
                            <div class="group-section mb-3">
                                <div class="group-section-title">Penumpang Kelompok Ini</div>
                                <div class="table-responsive">
                                    <table class="table app-table align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width:70px;">No</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th style="width:180px;">Tanggal Lahir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($kelompok->penumpangs as $penumpang)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $penumpang->nik ?? '-' }}</td>
                                                    <td>{{ $penumpang->nama ?? '-' }}</td>
                                                    <td>
                                                        {{ !empty($penumpang->tanggal_lahir) ? \Carbon\Carbon::parse($penumpang->tanggal_lahir)->format('d-m-Y') : '-' }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">Belum ada data penumpang.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="group-section">
                                <div class="group-section-title">Kendaraan Kelompok Ini</div>
                                <div class="table-responsive">
                                    <table class="table app-table align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width:70px;">No</th>
                                                <th>Jenis Kendaraan</th>
                                                <th>Plat Nomor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($kelompok->kendaraans as $kendaraan)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $kendaraan->jenis_kendaraan ?? '-' }}</td>
                                                    <td>{{ $kendaraan->plat_nomor ?? '-' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted">Kelompok ini tidak membawa kendaraan.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="table-empty-state text-center py-4 text-muted">
                        Belum ada data kelompok.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .detail-header-card {
        border: 1px solid #e9eef5;
        border-radius: 18px;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
        padding: 1.15rem 1.2rem;
    }

    .detail-header-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
        margin-bottom: .8rem;
    }

    .detail-header-inline {
        display: flex;
        flex-wrap: wrap;
        gap: .7rem .8rem;
        align-items: center;
    }

    .detail-type-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: .28rem .7rem;
        border-radius: 8px;
        font-size: .76rem;
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

    .detail-inline-item {
        font-size: .92rem;
        color: #334155;
        font-weight: 500;
        background: #fff;
        border: 1px solid #e9eef5;
        border-radius: 999px;
        padding: .45rem .85rem;
    }

    .detail-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
    }

    .summary-card {
        background: #fff;
        border: 1px solid #e9eef5;
        border-radius: 18px;
        padding: 1rem 1.1rem;
    }

    .summary-label {
        font-size: .82rem;
        font-weight: 700;
        color: #64748b;
        margin-bottom: .35rem;
    }

    .summary-value {
        font-size: 1.35rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
    }

    .detail-passenger-badge {
        display: inline-flex;
        align-items: center;
        padding: .45rem .8rem;
        border-radius: 999px;
        background: #eef6ff;
        color: #0b5ed7;
        font-size: 12px;
        font-weight: 700;
    }

    .group-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .group-card {
        border: 1px solid #e9eef5;
        border-radius: 18px;
        background: #fff;
        overflow: hidden;
    }

    .group-card-header {
        padding: 1rem 1rem .85rem;
        background: #fbfdff;
        border-bottom: 1px solid #eef2f7;
    }

    .group-title {
        font-size: 1rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: .25rem;
    }

    .group-meta {
        font-size: .88rem;
        color: #64748b;
        font-weight: 500;
    }

    .group-card-body {
        padding: 1rem;
    }

    .group-section-title {
        font-size: .92rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: .7rem;
    }

    @media (max-width: 991.98px) {
        .detail-summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 575.98px) {
        .detail-header-inline {
            flex-direction: column;
            align-items: stretch;
        }

        .detail-inline-item,
        .detail-type-badge {
            width: 100%;
            border-radius: 12px;
        }

        .detail-summary-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush