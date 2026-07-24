@extends('layouts.admin')

@section('content-body')
<x-form-errors />
<x-page-header title="{{ isset($item) ? 'Edit Fakultas' : 'Tambah Fakultas' }}" />

<form method="POST" action="{{ isset($item) ? route('admin.fakultas.update', $item) : route('admin.fakultas.store') }}">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="mb-4">
        <label class="label"><span class="label-text">Kode</span></label>
        <input type="text" name="kode" value="{{ old('kode', $item->kode ?? '') }}" class="input input-bordered w-full max-w-md" required>
    </div>
    <div class="mb-4">
        <label class="label"><span class="label-text">Nama</span></label>
        <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="input input-bordered w-full max-w-md" required>
    </div>
    <x-form-actions :cancelRoute="route('admin.fakultas.index')" />
</form>
@endsection
