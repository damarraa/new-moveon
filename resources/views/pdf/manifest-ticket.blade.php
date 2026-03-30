<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Ticket Manifest</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111827;
            margin: 24px;
        }

        .header {
            text-align: center;
            margin-bottom: 24px;
        }

        .header h1 {
            margin: 0 0 4px;
            font-size: 20px;
        }

        .header p {
            margin: 0;
            color: #6b7280;
        }

        .card {
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            padding: 8px 6px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        th {
            text-align: left;
            background: #f9fafb;
        }

        .small {
            font-size: 11px;
            color: #6b7280;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 11px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>E-Ticket Manifest</h1>
        <p>Bukti Check-In Penumpang</p>
    </div>

    <div class="card">
        <div class="title">Informasi Perjalanan</div>
        <table>
            <tr>
                <th style="width: 220px;">ID Manifest</th>
                <td>{{ $manifest->id }}</td>
            </tr>
            <tr>
                <th>Nama Kapal</th>
                <td>{{ $manifest->profiling->nama_kapal ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jenis Layanan</th>
                <td>{{ ucfirst($manifest->jenis_layanan) }}</td>
            </tr>
            <tr>
                <th>Rute</th>
                <td>{{ $manifest->asal }} - {{ $manifest->tujuan }}</td>
            </tr>
            <tr>
                <th>Tanggal Berangkat</th>
                <td>{{ \Carbon\Carbon::parse($manifest->tanggal_berangkat)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Jam Berangkat</th>
                <td>{{ \Carbon\Carbon::parse($manifest->jam_berangkat)->format('H:i') }}</td>
            </tr>
            <tr>
                <th>No. WhatsApp Perwakilan</th>
                <td>{{ $manifest->telepon }}</td>
            </tr>
            <tr>
                <th>Jumlah Penumpang</th>
                <td>{{ $manifest->jumlah_penumpang }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($manifest->status) }}</td>
            </tr>
            @if($manifest->jenis_layanan === 'penyeberangan')
                <tr>
                    <th>Bawa Kendaraan</th>
                    <td>{{ $manifest->bawa_kendaraan ?? 'Tidak' }}</td>
                </tr>
                @if(($manifest->bawa_kendaraan ?? 'Tidak') === 'Ya')
                    <tr>
                        <th>Jenis Kendaraan</th>
                        <td>{{ $manifest->jenis_kendaraan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Plat Nomor</th>
                        <td>{{ $manifest->plat_nomor ?? '-' }}</td>
                    </tr>
                @endif
            @endif
        </table>
    </div>

    <div class="card">
        <div class="title">Daftar Penumpang</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th style="width: 130px;">Tanggal Lahir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($manifest->penumpangs as $penumpang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $penumpang->nik }}</td>
                        <td>{{ $penumpang->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($penumpang->tanggal_lahir)->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        Dicetak otomatis oleh sistem MOVEON.
    </div>
</body>
</html>