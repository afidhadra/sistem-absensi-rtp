@extends('layouts.admin')

@section('content-body')
<h1 class="mb-6 text-2xl font-bold text-gray-800">{{ isset($item) ? 'Edit Dosen' : 'Tambah Dosen' }}</h1>
<form method="POST" action="{{ isset($item) ? route('admin.dosen.update', $item) : route('admin.dosen.store') }}">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div><label class="mb-1 block text-sm font-medium text-gray-700">NIP</label><input type="text" name="nip" value="{{ old('nip', $item->nip ?? '') }}" class="w-full rounded-lg border border-gray-300 px-3 py-2" required></div>
        <div><label class="mb-1 block text-sm font-medium text-gray-700">Fakultas</label><select name="fakultas_id" class="w-full rounded-lg border border-gray-300 px-3 py-2"><option value="">-</option>@foreach ($fakultas as $f)<option value="{{ $f->id }}" @if (old('fakultas_id', $item->fakultas_id ?? '') == $f->id) selected @endif>{{ $f->nama }}</option>@endforeach</select></div>
    </div>
    <div class="mb-4 max-w-2xl"><label class="mb-1 block text-sm font-medium text-gray-700">Nama Lengkap</label><input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="w-full rounded-lg border border-gray-300 px-3 py-2" required></div>
    <div class="mb-4 max-w-2xl"><label class="mb-1 block text-sm font-medium text-gray-700">Email</label><input type="email" name="email" value="{{ old('email', $item->user?->email ?? '') }}" class="w-full rounded-lg border border-gray-300 px-3 py-2" required></div>
    <div class="mb-4 max-w-2xl"><label class="mb-1 block text-sm font-medium text-gray-700">Password {{ isset($item) ? '(kosongkan jika tidak ubah)' : '' }}</label><input type="password" name="password" class="w-full rounded-lg border border-gray-300 px-3 py-2" @if (!isset($item)) required @endif></div>
    <div class="flex gap-2"><button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Simpan</button><a href="{{ route('admin.dosen.index') }}" class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300">Batal</a></div>
</form>
@endsection
