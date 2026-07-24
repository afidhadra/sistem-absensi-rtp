@extends('layouts.admin')

@section('content-body')
<x-form-errors />
<x-page-header title="{{ isset($item) ? 'Edit Program Studi' : 'Tambah Program Studi' }}" />

<form method="POST" action="{{ isset($item) ? route('admin.prodi.update', $item) : route('admin.prodi.store') }}">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div>
            <label class="label"><span class="label-text">Kode</span></label>
            <input type="text" name="kode" value="{{ old('kode', $item->kode ?? '') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="label"><span class="label-text">Fakultas</span></label>
            <select name="fakultas_id" class="select select-bordered w-full">
                <option value="">-</option>
                @foreach ($fakultas as $f)
                    <option value="{{ $f->id }}" @if (old('fakultas_id', $item->fakultas_id ?? '') == $f->id) selected @endif>{{ $f->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-4 max-w-2xl">
        <label class="label"><span class="label-text">Nama</span></label>
        <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="input input-bordered w-full" required>
    </div>
    <x-form-actions :cancelRoute="route('admin.prodi.index')" />
</form>
@endsection
