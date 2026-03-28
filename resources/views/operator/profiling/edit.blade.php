@extends('layouts.app')

@section('page_title', 'Edit Data Profiling')
@section('breadcrumb', 'Edit Data Profiling')

@section('page_actions')
    <a href="{{ route('operator.profiling.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-3 p-md-4">
            <form action="{{ route('operator.profiling.update', $profiling->id) }}" method="POST" id="profilingEditForm">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Nama Kapal</label>
                        <input type="text" name="nama_kapal" class="form-control"
                               value="{{ old('nama_kapal', $profiling->nama_kapal) }}"
                               placeholder="Masukkan nama kapal">
                        @error('nama_kapal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Kapasitas Penumpang</label>
                        <input type="number" name="kapasitas_penumpang" class="form-control" min="1"
                               value="{{ old('kapasitas_penumpang', $profiling->kapasitas_penumpang) }}"
                               placeholder="Masukkan kapasitas penumpang">
                        @error('kapasitas_penumpang')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Asal Keberangkatan</label>
                        <input type="text" name="asal_keberangkatan" class="form-control"
                               value="{{ old('asal_keberangkatan', $profiling->asal_keberangkatan) }}"
                               placeholder="Masukkan asal keberangkatan">
                        @error('asal_keberangkatan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Tujuan Keberangkatan</label>
                        <input type="text" name="tujuan_keberangkatan" class="form-control"
                               value="{{ old('tujuan_keberangkatan', $profiling->tujuan_keberangkatan) }}"
                               placeholder="Masukkan tujuan keberangkatan">
                        @error('tujuan_keberangkatan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Waktu Keberangkatan</label>
                        <input type="datetime-local" name="waktu_keberangkatan" class="form-control"
                               value="{{ old('waktu_keberangkatan', \Carbon\Carbon::parse($profiling->waktu_keberangkatan)->format('Y-m-d\TH:i')) }}">
                        @error('waktu_keberangkatan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                    <a href="{{ route('operator.profiling.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection