@extends('layouts.app')

@section('page_title', 'Edit Manifest')

@section('content')
<div class="card p-4">
    <h1>Edit Manifest #{{ $id ?? '-' }}</h1>
    <p>Form edit manifest akan ditampilkan di sini.</p>
</div>
@endsection