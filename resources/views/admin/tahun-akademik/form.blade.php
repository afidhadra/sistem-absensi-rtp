@extends('layouts.admin')

@section('content-body')
<x-form-errors />
<x-page-header title="{{ isset($item) ? 'Edit Tahun Akademik' : 'Tambah Tahun Akademik' }}" />

<form method="POST" action="{{ isset($item) ? route('admin.tahun-akademik.update', $item) : route('admin.tahun-akademik.store') }}"><div class="card border border-base-300 border-l-4 border-l-primary"><div class="card-body p-4 space-y-3">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div>
            <label class="label"><span class="label-text text-xs">Kode</span></label>
            <input type="text" name="kode" value="{{ old('kode', $item->kode ?? '') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="label"><span class="label-text text-xs">Nama</span></label>
            <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="label"><span class="label-text text-xs">Tanggal Mulai</span></label>
            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $item->tanggal_mulai ?? '') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="label"><span class="label-text text-xs">Tanggal Selesai</span></label>
            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $item->tanggal_selesai ?? '') }}" class="input input-bordered w-full" required>
        </div>
    </div>
    <label class="label cursor-pointer max-w-2xl mb-4">
        <span class="label-text text-xs">Aktif</span>
        <input type="checkbox" name="is_active" value="1" class="toggle toggle-primary" @if (old('is_active', $item->is_active ?? false)) checked @endif>
    </label>
    <x-form-actions :cancelRoute="route('admin.tahun-akademik.index')" />
</div></div></form>
@endsection
