@extends('layouts.app')

@section('page_title', 'Detail Manifest')

@section('content')
<div class="card p-4">
    <h1>Detail Manifest #{{ $id ?? '-' }}</h1>
    <p>Data manifest ditampilkan di sini.</p>
</div>
@endsection