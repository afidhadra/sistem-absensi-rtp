@extends('layouts.admin')

@section('content-body')
<x-form-errors />
<x-page-header title="{{ isset($item) ? 'Edit Jadwal' : 'Tambah Jadwal' }}" />

<form method="POST" action="{{ isset($item) ? route('admin.jadwal.update', $item) : route('admin.jadwal.store') }}"><div class="card border border-base-300 border-l-4 border-l-primary"><div class="card-body p-4 space-y-3">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div>
            <label class="label"><span class="label-text text-xs">Penugasan</span></label>
            <select name="teaching_assignment_id" class="select select-bordered w-full" required>
                @foreach ($ta as $t)
                    <option value="{{ $t->id }}" @if (old('teaching_assignment_id', $item->teaching_assignment_id ?? '') == $t->id) selected @endif>{{ $t->dosen?->nama }} - {{ $t->mataKuliah?->nama }} ({{ $t->kelas?->kode }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="label"><span class="label-text text-xs">Hari</span></label>
            <select name="hari" class="select select-bordered w-full" required>
                @foreach (['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'] as $h)
                    <option value="{{ $h }}" @if (old('hari', $item->hari ?? '') == $h) selected @endif>{{ ucfirst($h) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="label"><span class="label-text text-xs">Jam Mulai</span></label>
            <input type="time" name="jam_mulai" value="{{ old('jam_mulai', $item->jam_mulai ?? '') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="label"><span class="label-text text-xs">Jam Selesai</span></label>
            <input type="time" name="jam_selesai" value="{{ old('jam_selesai', $item->jam_selesai ?? '') }}" class="input input-bordered w-full" required>
        </div>
    </div>
    <div class="mb-4 max-w-2xl">
        <label class="label"><span class="label-text text-xs">Ruangan</span></label>
        <input type="text" name="ruangan" value="{{ old('ruangan', $item->ruangan ?? '') }}" class="input input-bordered w-full">
    </div>
    <x-form-actions :cancelRoute="route('admin.jadwal.index')" />
</div></div></form>
@endsection
