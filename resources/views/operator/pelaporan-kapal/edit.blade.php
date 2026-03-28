@extends('layouts.app')

@section('page_title', 'Edit Pelaporan Kapal')

@section('content')
<div class="card p-4">
    <h1>Edit Pelaporan Kapal #{{ $id ?? '-' }}</h1>
    <p>Form edit pelaporan kapal akan ditampilkan di sini.</p>
</div>
@endsection