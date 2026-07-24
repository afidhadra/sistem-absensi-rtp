@extends('layouts.admin')

@section('content-body')
<h1 class="mb-6 text-2xl font-bold text-gray-800">{{ isset($item) ? 'Edit Mahasiswa' : 'Tambah Mahasiswa' }}</h1>
<form method="POST" action="{{ isset($item) ? route('admin.mahasiswa.update', $item) : route('admin.mahasiswa.store') }}">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div><label class="mb-1 block text-sm font-medium text-gray-700">NIM</label><input type="text" name="nim" value="{{ old('nim', $item->nim ?? '') }}" class="w-full rounded-lg border border-gray-300 px-3 py-2" required></div>
        <div><label class="mb-1 block text-sm font-medium text-gray-700">Kelas</label><select name="kelas_id" class="w-full rounded-lg border border-gray-300 px-3 py-2"><option value="">-</option>@foreach ($kelas as $k)<option value="{{ $k->id }}" @if (old('kelas_id', $item->kelas_id ?? '') == $k->id) selected @endif>{{ $k->kode }}</option>@endforeach</select></div>
    </div>
    <div class="mb-4 max-w-2xl"><label class="mb-1 block text-sm font-medium text-gray-700">Nama Lengkap</label><input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="w-full rounded-lg border border-gray-300 px-3 py-2" required></div>
    <div class="mb-4 max-w-2xl"><label class="mb-1 block text-sm font-medium text-gray-700">Email</label><input type="email" name="email" value="{{ old('email', $item->user?->email ?? '') }}" class="w-full rounded-lg border border-gray-300 px-3 py-2" required></div>
    <div class="mb-4 max-w-2xl"><label class="mb-1 block text-sm font-medium text-gray-700">Password {{ isset($item) ? '(kosongkan jika tidak ubah)' : '' }}</label><input type="password" name="password" class="w-full rounded-lg border border-gray-300 px-3 py-2" @if (!isset($item)) required @endif></div>
    <div class="flex gap-2"><button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Simpan</button><a href="{{ route('admin.mahasiswa.index') }}" class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300">Batal</a></div>
</form>
@endsection
