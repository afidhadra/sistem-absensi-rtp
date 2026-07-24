@extends('layouts.admin')

@section('content-body')
<x-form-errors />
<x-page-header title="{{ isset($item) ? 'Edit Kelas' : 'Tambah Kelas' }}" />

<form method="POST" action="{{ isset($item) ? route('admin.kelas.update', $item) : route('admin.kelas.store') }}"><div class="card border border-base-300 border-l-4 border-l-primary"><div class="card-body p-4 space-y-3">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div>
            <label class="label"><span class="label-text text-xs">Kode</span></label>
            <input type="text" name="kode" value="{{ old('kode', $item->kode ?? '') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="label"><span class="label-text text-xs">Program Studi</span></label>
            <select name="program_studi_id" class="select select-bordered w-full">
                <option value="">-</option>
                @foreach ($prodi as $p)
                    <option value="{{ $p->id }}" @if (old('program_studi_id', $item->program_studi_id ?? '') == $p->id) selected @endif>{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-4 max-w-2xl">
        <label class="label"><span class="label-text text-xs">Nama</span></label>
        <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="input input-bordered w-full" required>
    </div>
    <x-form-actions :cancelRoute="route('admin.kelas.index')" />
</div></div></form>
@endsection
