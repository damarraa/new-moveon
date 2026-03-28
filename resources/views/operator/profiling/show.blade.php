@extends('layouts.app')

@section('page_title', 'Detail Profiling')

@section('content')
<div class="card p-4">
    <h1>Detail Profiling #{{ $id ?? '-' }}</h1>
    <p>Rincian data profiling ditampilkan di sini.</p>
</div>
@endsection