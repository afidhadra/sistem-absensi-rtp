@extends('layouts.admin')

@section('content-body')
<h1 class="mb-6 text-2xl font-bold text-gray-800">{{ isset($item) ? 'Edit Mata Kuliah' : 'Tambah Mata Kuliah' }}</h1>
<form method="POST" action="{{ isset($item) ? route('admin.mata-kuliah.update', $item) : route('admin.mata-kuliah.store') }}">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div><label class="mb-1 block text-sm font-medium text-gray-700">Kode</label><input type="text" name="kode" value="{{ old('kode', $item->kode ?? '') }}" class="w-full rounded-lg border border-gray-300 px-3 py-2" required></div>
        <div><label class="mb-1 block text-sm font-medium text-gray-700">SKS</label><input type="number" name="sks" value="{{ old('sks', $item->sks ?? '') }}" min="1" max="8" class="w-full rounded-lg border border-gray-300 px-3 py-2" required></div>
    </div>
    <div class="mb-4 max-w-2xl"><label class="mb-1 block text-sm font-medium text-gray-700">Nama</label><input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="w-full rounded-lg border border-gray-300 px-3 py-2" required></div>
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div><label class="mb-1 block text-sm font-medium text-gray-700">Semester</label><select name="semester_id" class="w-full rounded-lg border border-gray-300 px-3 py-2"><option value="">-</option>@foreach ($semesters as $s)<option value="{{ $s->id }}" @if (old('semester_id', $item->semester_id ?? '') == $s->id) selected @endif>{{ $s->nama }}</option>@endforeach</select></div>
        <div><label class="mb-1 block text-sm font-medium text-gray-700">Program Studi</label><select name="program_studi_id" class="w-full rounded-lg border border-gray-300 px-3 py-2"><option value="">-</option>@foreach ($prodi as $p)<option value="{{ $p->id }}" @if (old('program_studi_id', $item->program_studi_id ?? '') == $p->id) selected @endif>{{ $p->nama }}</option>@endforeach</select></div>
    </div>
    <div class="mb-4"><label class="flex items-center gap-2 text-sm font-medium text-gray-700"><input type="checkbox" name="is_active" value="1" @if (old('is_active', $item->is_active ?? true)) checked @endif> Aktif</label></div>
    <div class="flex gap-2"><button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Simpan</button><a href="{{ route('admin.mata-kuliah.index') }}" class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300">Batal</a></div>
</form>
@endsection
