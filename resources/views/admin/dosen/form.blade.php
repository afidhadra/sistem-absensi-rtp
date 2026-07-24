@extends('layouts.admin')

@section('content-body')
<x-page-header title="{{ isset($item) ? 'Edit Dosen' : 'Tambah Dosen' }}" />

<form method="POST" action="{{ isset($item) ? route('admin.dosen.update', $item) : route('admin.dosen.store') }}">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div>
            <label class="label"><span class="label-text">NIP</span></label>
            <input type="text" name="nip" value="{{ old('nip', $item->nip ?? '') }}" class="input input-bordered w-full" required>
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
        <label class="label"><span class="label-text">Nama Lengkap</span></label>
        <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}" class="input input-bordered w-full" required>
    </div>
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div>
            <label class="label"><span class="label-text">Email</span></label>
            <input type="email" name="email" value="{{ old('email', $item->user?->email ?? '') }}" class="input input-bordered w-full" required>
        </div>
        @if (!isset($item))
            <div>
                <label class="label"><span class="label-text">Password</span></label>
                <input type="password" name="password" value="{{ old('password') }}" class="input input-bordered w-full" required>
            </div>
        @endif
    </div>
    <x-form-actions :cancelRoute="route('admin.dosen.index')" />
</form>
@endsection
