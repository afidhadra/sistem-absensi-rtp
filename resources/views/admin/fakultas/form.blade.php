@extends('layouts.admin')

@section('content-body')
<x-form-errors />
<x-page-header title="{{ isset($item) ? 'Edit Fakultas' : 'Tambah Fakultas' }}" />

<form method="POST" action="{{ isset($item) ? route('admin.fakultas.update', $item) : route('admin.fakultas.store') }}"><div class="card border border-base-300 border-l-4 border-l-primary"><div class="card-body p-4 space-y-3">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div>
        <label class="label"><span class="label-text text-xs">Kode</span></label>
        <input type="text" name="kode" value="{{ old('kode', $item->kode ?? '') }}" class="input input-bordered w-full max-w-md" required>
    </div>
    <div>
        <label class="label"><span class="label-text text-xs">Nama</span></label>
        <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="input input-bordered w-full max-w-md" required>
    </div>
    <x-form-actions :cancelRoute="route('admin.fakultas.index')" />
</div></div></form>
@endsection
