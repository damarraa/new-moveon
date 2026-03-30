@extends('layouts.app')

@section('page_title', 'Tambah Manifest')
@section('breadcrumb', 'Tambah Manifest')

@section('content')
<form action="{{ route('operator.manifest.store') }}" method="POST" id="manifestForm">
    @csrf
    @include('operator.manifest.partials.form', ['submitLabel' => 'Simpan Manifest'])
</form>
@endsection