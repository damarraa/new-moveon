@extends('layouts.app')

@section('page_title', 'Detail Data Profiling')
@section('breadcrumb', 'Detail Data Profiling')

@section('page_actions')
    <div class="d-flex flex-column flex-sm-row gap-2">
        <a href="{{ route('operator.profiling.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <a href="{{ route('operator.profiling.edit', $profiling->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil-square me-1"></i> Edit
        </a>
    </div>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-3 p-md-4">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <tr>
                        <th style="width: 280px;">UUID Data</th>
                        <td>{{ $profiling->id }}</td>
                    </tr>
                    <tr>
                        <th>Nama Kapal</th>
                        <td>{{ $profiling->nama_kapal }}</td>
                    </tr>
                    <tr>
                        <th>Asal Keberangkatan</th>
                        <td>{{ $profiling->asal_keberangkatan }}</td>
                    </tr>
                    <tr>
                        <th>Tujuan Keberangkatan</th>
                        <td>{{ $profiling->tujuan_keberangkatan }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Keberangkatan</th>
                        <td>{{ \Carbon\Carbon::parse($profiling->waktu_keberangkatan)->format('d-m-Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Kapasitas Penumpang</th>
                        <td>{{ $profiling->kapasitas_penumpang }}</td>
                    </tr>
                    <tr>
                        <th>UUID User</th>
                        <td>{{ $profiling->user_id }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection