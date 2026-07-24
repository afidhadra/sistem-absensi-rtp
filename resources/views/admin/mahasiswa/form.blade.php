@extends('layouts.admin')

@section('content-body')
<x-form-errors />
<x-page-header title="{{ isset($item) ? 'Edit Mahasiswa' : 'Tambah Mahasiswa' }}" />

<form method="POST" action="{{ isset($item) ? route('admin.mahasiswa.update', $item) : route('admin.mahasiswa.store') }}"><div class="card border border-base-300 border-l-4 border-l-primary"><div class="card-body p-4 space-y-3">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div>
            <label class="label"><span class="label-text text-xs">NIM</span></label>
            <input type="text" name="nim" value="{{ old('nim', $item->nim ?? '') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="label"><span class="label-text text-xs">Kelas</span></label>
            <select name="kelas_id" class="select select-bordered w-full">
                <option value="">-</option>
                @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" @if (old('kelas_id', $item->kelas_id ?? '') == $k->id) selected @endif>{{ $k->kode }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-4 max-w-2xl">
        <label class="label"><span class="label-text text-xs">Nama Lengkap</span></label>
        <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="input input-bordered w-full" required>
    </div>
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div>
            <label class="label"><span class="label-text text-xs">Email</span></label>
            <input type="email" name="email" value="{{ old('email', $item->user?->email ?? '') }}" class="input input-bordered w-full" required>
        </div>
        @if (!isset($item))
            <div>
                <label class="label"><span class="label-text text-xs">Password</span></label>
                <input type="password" name="password" value="{{ old('password') }}" class="input input-bordered w-full" required>
            </div>
        @endif
    </div>
    <x-form-actions :cancelRoute="route('admin.mahasiswa.index')" />
</div></div></form>
@endsection
