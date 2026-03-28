@extends('layouts.app')

@section('page_title', 'Detail Pelaporan Kapal')

@section('content')
<div class="card p-4">
    <h1>Detail Pelaporan Kapal #{{ $id ?? '-' }}</h1>
    <p>Data pelaporan kapal ditampilkan di sini.</p>
</div>
@endsection