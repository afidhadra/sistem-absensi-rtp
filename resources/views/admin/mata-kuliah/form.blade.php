@extends('layouts.admin')

@section('content-body')
<x-page-header title="{{ isset($item) ? 'Edit Mata Kuliah' : 'Tambah Mata Kuliah' }}" />

<form method="POST" action="{{ isset($item) ? route('admin.mata-kuliah.update', $item) : route('admin.mata-kuliah.store') }}">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div>
            <label class="label"><span class="label-text">Kode</span></label>
            <input type="text" name="kode" value="{{ old('kode', $item->kode ?? '') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="label"><span class="label-text">SKS</span></label>
            <input type="number" name="sks" value="{{ old('sks', $item->sks ?? '') }}" class="input input-bordered w-full" required min="1" max="8">
        </div>
        <div>
            <label class="label"><span class="label-text">Semester</span></label>
            <select name="semester_id" class="select select-bordered w-full">
                @foreach ($semesters as $s)
                    <option value="{{ $s->id }}" @if (old('semester_id', $item->semester_id ?? '') == $s->id) selected @endif>{{ $s->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="label"><span class="label-text">Program Studi</span></label>
            <select name="program_studi_id" class="select select-bordered w-full">
                @foreach ($prodi as $p)
                    <option value="{{ $p->id }}" @if (old('program_studi_id', $item->program_studi_id ?? '') == $p->id) selected @endif>{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-4 max-w-2xl">
        <label class="label"><span class="label-text">Nama</span></label>
        <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="input input-bordered w-full" required>
    </div>
    <label class="label cursor-pointer max-w-2xl mb-4">
        <span class="label-text">Aktif</span>
        <input type="checkbox" name="is_active" class="toggle toggle-primary" @if (old('is_active', $item->is_active ?? false)) checked @endif>
    </label>
    <x-form-actions :cancelRoute="route('admin.mata-kuliah.index')" />
</form>
@endsection
