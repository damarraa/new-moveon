@extends('layouts.app')

@section('page_title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="app-page dashboard-page">
    <div class="dashboard-hero mb-4">
        <div class="dashboard-hero-content">
            <div>
                <div class="dashboard-eyebrow">Ringkasan Operasional</div>
                <h1 class="dashboard-title">Dashboard Monitoring Kapal & Manifest</h1>
                <p class="dashboard-subtitle mb-0">
                    Pantau data kapal, manifest check-in, penumpang, kendaraan, dan aktivitas operasional dalam satu tampilan.
                </p>
            </div>

            <div class="dashboard-hero-badge">
                <span class="hero-badge-label">Hari ini</span>
                <span class="hero-badge-value">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
            </div>
        </div>
    </div>

    <div class="stats-grid mb-4">
        <div class="stat-card">
            <div class="stat-label">Total Kapal Terdaftar</div>
            <div class="stat-value">{{ $totalProfiling }}</div>
            <div class="stat-desc">Data kapal dari profiling</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Total Manifest</div>
            <div class="stat-value">{{ $totalManifest }}</div>
            <div class="stat-desc">Seluruh data check-in manifest</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Total Penumpang</div>
            <div class="stat-value">{{ $totalPenumpang }}</div>
            <div class="stat-desc">Akumulasi seluruh penumpang</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Total Kendaraan</div>
            <div class="stat-value">{{ $totalKendaraan }}</div>
            <div class="stat-desc">Manifest yang membawa kendaraan</div>
        </div>
    </div>

    <div class="stats-grid stats-grid-secondary mb-4">
        <div class="stat-card soft-card">
            <div class="stat-label">Manifest Hari Ini</div>
            <div class="stat-value">{{ $manifestHariIni }}</div>
            <div class="stat-desc">Jumlah check-in untuk keberangkatan hari ini</div>
        </div>

        <div class="stat-card soft-card">
            <div class="stat-label">Penumpang Hari Ini</div>
            <div class="stat-value">{{ $penumpangHariIni }}</div>
            <div class="stat-desc">Penumpang dengan jadwal keberangkatan hari ini</div>
        </div>

        <div class="stat-card soft-card">
            <div class="stat-label">Pelaporan Kapal</div>
            <div class="stat-value">{{ $totalPelaporan }}</div>
            <div class="stat-desc">Data pelaporan kondisi operasional kapal</div>
        </div>

        <div class="stat-card soft-card">
            <div class="stat-label">Status Lainnya</div>
            <div class="stat-value">{{ $kapalStatusLain }}</div>
            <div class="stat-desc">Status operasi di luar kategori utama</div>
        </div>
    </div>

    <div class="dashboard-grid mb-4">
        <div class="content-card">
            <div class="card-body">
                <div class="section-header">
                    <h5 class="mb-0">Status Operasional Kapal</h5>
                </div>

                <div class="status-summary-grid">
                    <div class="mini-status-card status-success">
                        <div class="mini-status-label">Beroperasi</div>
                        <div class="mini-status-value">{{ $kapalBeroperasi }}</div>
                    </div>

                    <div class="mini-status-card status-danger">
                        <div class="mini-status-label">Tidak Beroperasi</div>
                        <div class="mini-status-value">{{ $kapalTidakBeroperasi }}</div>
                    </div>

                    <div class="mini-status-card status-neutral">
                        <div class="mini-status-label">Status Lain</div>
                        <div class="mini-status-value">{{ $kapalStatusLain }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="card-body">
                <div class="section-header">
                    <h5 class="mb-0">Jenis Layanan</h5>
                </div>

                <div class="service-list">
                    @forelse($jenisLayanan as $layanan)
                        <div class="service-item">
                            <div class="service-name">
                                {{ ucfirst($layanan->jenis_layanan) }}
                            </div>
                            <div class="service-total">
                                {{ $layanan->total }}
                            </div>
                        </div>
                    @empty
                        <div class="empty-inline">Belum ada data jenis layanan.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-grid mb-4">
        <div class="content-card">
            <div class="card-body">
                <div class="section-header">
                    <h5 class="mb-0">Jadwal Kapal Terdekat</h5>
                </div>

                <div class="table-responsive">
                    <table class="table app-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Nama Kapal</th>
                                <th>Rute</th>
                                <th>Waktu Berangkat</th>
                                <th>Kapasitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwalTerdekat as $jadwal)
                                <tr>
                                    <td class="fw-semibold text-dark">{{ $jadwal->nama_kapal ?? '-' }}</td>
                                    <td>{{ $jadwal->asal_keberangkatan ?? '-' }} - {{ $jadwal->tujuan_keberangkatan ?? '-' }}</td>
                                    <td>
                                        {{ !empty($jadwal->waktu_keberangkatan) ? \Carbon\Carbon::parse($jadwal->waktu_keberangkatan)->translatedFormat('d M Y, H:i') : '-' }}
                                    </td>
                                    <td>{{ $jadwal->kapasitas_penumpang ?? 0 }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada jadwal kapal.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="card-body">
                <div class="section-header">
                    <h5 class="mb-0">Manifest Terbaru</h5>
                </div>

                <div class="table-responsive">
                    <table class="table app-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Kapal</th>
                                <th>Rute</th>
                                <th>Tanggal</th>
                                <th>Penumpang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($manifestTerbaru as $item)
                                <tr>
                                    <td class="fw-semibold text-dark">{{ $item->profiling->nama_kapal ?? '-' }}</td>
                                    <td>{{ $item->asal ?? '-' }} - {{ $item->tujuan ?? '-' }}</td>
                                    <td>
                                        {{ !empty($item->tanggal_berangkat) ? \Carbon\Carbon::parse($item->tanggal_berangkat)->format('d-m-Y') : '-' }}
                                        @if(!empty($item->jam_berangkat))
                                            <div class="small text-muted">{{ \Carbon\Carbon::parse($item->jam_berangkat)->format('H:i') }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $item->jumlah_penumpang ?? 0 }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada data manifest.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-grid mb-4">
        <div class="content-card">
            <div class="card-body">
                <div class="section-header">
                    <h5 class="mb-0">Kapal Paling Aktif</h5>
                </div>

                <div class="table-responsive">
                    <table class="table app-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Nama Kapal</th>
                                <th>Total Manifest</th>
                                <th>Total Penumpang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kapalAktif as $kapal)
                                <tr>
                                    <td class="fw-semibold text-dark">{{ $kapal->nama_kapal }}</td>
                                    <td>{{ $kapal->total_manifest }}</td>
                                    <td>{{ $kapal->total_penumpang }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada aktivitas kapal.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="card-body">
                <div class="section-header">
                    <h5 class="mb-0">Rute Paling Sering Dipakai</h5>
                </div>

                <div class="table-responsive">
                    <table class="table app-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Rute</th>
                                <th>Total Manifest</th>
                                <th>Total Penumpang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rutePopuler as $rute)
                                <tr>
                                    <td class="fw-semibold text-dark">{{ $rute->asal ?? '-' }} - {{ $rute->tujuan ?? '-' }}</td>
                                    <td>{{ $rute->total_manifest }}</td>
                                    <td>{{ $rute->total_penumpang }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada data rute.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="card-body">
            <div class="section-header">
                <h5 class="mb-0">Tren Manifest 6 Bulan Terakhir</h5>
            </div>

            <div class="trend-grid">
                @forelse($manifestBulanan as $bulan)
                    <div class="trend-card">
                        <div class="trend-month">{{ $bulan->label }}</div>
                        <div class="trend-total">{{ $bulan->total }}</div>
                        <div class="trend-caption">manifest</div>
                    </div>
                @empty
                    <div class="empty-inline">Belum ada data tren manifest.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .dashboard-page {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .dashboard-hero {
        border-radius: 22px;
        padding: 1.4rem 1.5rem;
        background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 55%, #083b8a 100%);
        color: #fff;
        box-shadow: 0 14px 34px rgba(13, 110, 253, .16);
    }

    .dashboard-hero-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .dashboard-eyebrow {
        font-size: .78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
        opacity: .85;
        margin-bottom: .45rem;
    }

    .dashboard-title {
        font-size: 1.6rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: .45rem;
    }

    .dashboard-subtitle {
        max-width: 760px;
        font-size: .96rem;
        color: rgba(255,255,255,.88);
    }

    .dashboard-hero-badge {
        min-width: 180px;
        background: rgba(255,255,255,.14);
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 16px;
        padding: .85rem 1rem;
        backdrop-filter: blur(6px);
    }

    .hero-badge-label {
        display: block;
        font-size: .78rem;
        opacity: .85;
        margin-bottom: .25rem;
    }

    .hero-badge-value {
        display: block;
        font-size: 1rem;
        font-weight: 700;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
    }

    .stats-grid-secondary {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }

    .stat-card {
        background: #fff;
        border: 1px solid #e9eef5;
        border-radius: 20px;
        padding: 1.1rem 1.15rem;
        box-shadow: 0 6px 18px rgba(15, 23, 42, .04);
    }

    .soft-card {
        background: #fbfdff;
    }

    .stat-label {
        font-size: .82rem;
        font-weight: 700;
        color: #64748b;
        margin-bottom: .45rem;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.1;
        margin-bottom: .3rem;
    }

    .stat-desc {
        font-size: .85rem;
        color: #94a3b8;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
        margin-bottom: 1rem;
    }

    .section-header h5 {
        font-size: 1rem;
        font-weight: 800;
        color: #0f172a;
    }

    .status-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: .85rem;
    }

    .mini-status-card {
        border-radius: 16px;
        padding: 1rem;
        border: 1px solid #e9eef5;
    }

    .status-success {
        background: #effaf3;
        border-color: #d7f0df;
    }

    .status-danger {
        background: #fff4f4;
        border-color: #f4d7d7;
    }

    .status-neutral {
        background: #f8fafc;
        border-color: #e5e7eb;
    }

    .mini-status-label {
        font-size: .82rem;
        color: #64748b;
        font-weight: 700;
        margin-bottom: .35rem;
    }

    .mini-status-value {
        font-size: 1.45rem;
        font-weight: 800;
        color: #0f172a;
    }

    .service-list {
        display: flex;
        flex-direction: column;
        gap: .7rem;
    }

    .service-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #eef2f7;
        border-radius: 14px;
        padding: .8rem .9rem;
        background: #fff;
    }

    .service-name {
        font-size: .92rem;
        font-weight: 600;
        color: #0f172a;
    }

    .service-total {
        min-width: 38px;
        height: 38px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: .88rem;
        font-weight: 800;
        color: #0b5ed7;
        background: #eef6ff;
    }

    .trend-grid {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: .9rem;
    }

    .trend-card {
        border: 1px solid #e9eef5;
        background: #fff;
        border-radius: 18px;
        padding: 1rem;
        text-align: center;
    }

    .trend-month {
        font-size: .8rem;
        font-weight: 700;
        color: #64748b;
        margin-bottom: .45rem;
    }

    .trend-total {
        font-size: 1.4rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
    }

    .trend-caption {
        font-size: .78rem;
        color: #94a3b8;
        margin-top: .25rem;
    }

    .empty-inline {
        color: #94a3b8;
        font-size: .9rem;
        padding: .35rem 0;
    }

    @media (max-width: 1199.98px) {
        .stats-grid,
        .stats-grid-secondary {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .trend-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 991.98px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .status-summary-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767.98px) {
        .stats-grid,
        .stats-grid-secondary,
        .trend-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-title {
            font-size: 1.3rem;
        }

        .dashboard-hero {
            padding: 1.1rem;
        }
    }
</style>
@endpush