@extends('layouts.app')

@section('page_title', 'Edit Manifest')
@section('breadcrumb', 'Edit Manifest')

@section('content')
<form action="{{ route('operator.manifest.update', $manifest->id) }}" method="POST" id="manifestForm">
    @csrf
    @method('PUT')
    @include('operator.manifest.partials.form', ['submitLabel' => 'Update Manifest'])
</form>
@endsection