@extends('layouts.admin')

@section('content-body')
<h1 class="mb-6 text-2xl font-bold text-gray-800">{{ isset($item) ? 'Edit Semester' : 'Tambah Semester' }}</h1>
<form method="POST" action="{{ isset($item) ? route('admin.semester.update', $item) : route('admin.semester.store') }}">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="mb-4">
        <label class="mb-1 block text-sm font-medium text-gray-700">Kode</label>
        <input type="text" name="kode" value="{{ old('kode', $item->kode ?? '') }}" class="w-full max-w-md rounded-lg border border-gray-300 px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="mb-1 block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="w-full max-w-md rounded-lg border border-gray-300 px-3 py-2" required>
    </div>
    <div class="flex gap-2">
        <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Simpan</button>
        <a href="{{ route('admin.semester.index') }}" class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300">Batal</a>
    </div>
</form>
@endsection
