@extends('layouts.admin')

@section('content-body')
<x-page-header title="{{ isset($item) ? 'Edit Tahun Akademik' : 'Tambah Tahun Akademik' }}" />

<form method="POST" action="{{ isset($item) ? route('admin.tahun-akademik.update', $item) : route('admin.tahun-akademik.store') }}">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div>
            <label class="label"><span class="label-text">Kode</span></label>
            <input type="text" name="kode" value="{{ old('kode', $item->kode ?? '') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="label"><span class="label-text">Nama</span></label>
            <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="label"><span class="label-text">Tanggal Mulai</span></label>
            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $item->tanggal_mulai ?? '') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="label"><span class="label-text">Tanggal Selesai</span></label>
            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $item->tanggal_selesai ?? '') }}" class="input input-bordered w-full" required>
        </div>
    </div>
    <label class="label cursor-pointer max-w-2xl mb-4">
        <span class="label-text">Aktif</span>
        <input type="checkbox" name="is_active" class="toggle toggle-primary" @if (old('is_active', $item->is_active ?? false)) checked @endif>
    </label>
    <x-form-actions :cancelRoute="route('admin.tahun-akademik.index')" />
</form>
@endsection
