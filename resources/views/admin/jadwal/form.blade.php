@extends('layouts.admin')

@section('content-body')
<h1 class="mb-6 text-2xl font-bold text-gray-800">{{ isset($item) ? 'Edit Jadwal' : 'Tambah Jadwal' }}</h1>
<form method="POST" action="{{ isset($item) ? route('admin.jadwal.update', $item) : route('admin.jadwal.store') }}">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="space-y-4 max-w-2xl">
        <div>
            <label class="mb-1 block text-sm font-medium text-gray-700">Penugasan</label>
            <select name="teaching_assignment_id" class="w-full rounded-lg border border-gray-300 px-3 py-2" required>
                <option value="">Pilih Penugasan</option>
                @foreach ($ta as $t)
                    <option value="{{ $t->id }}" @if (old('teaching_assignment_id', $item->teaching_assignment_id ?? '') == $t->id) selected @endif>
                        {{ $t->dosen->nama }} - {{ $t->mataKuliah->kode }} - {{ $t->kelas->kode }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div><label class="mb-1 block text-sm font-medium text-gray-700">Hari</label><select name="hari" class="w-full rounded-lg border border-gray-300 px-3 py-2" required>@foreach (['senin','selasa','rabu','kamis','jumat','sabtu'] as $h)<option value="{{ $h }}" @if (old('hari', $item->hari ?? '') === $h) selected @endif class="capitalize">{{ ucfirst($h) }}</option>@endforeach</select></div>
            <div><label class="mb-1 block text-sm font-medium text-gray-700">Jam Mulai</label><input type="time" name="jam_mulai" value="{{ old('jam_mulai', $item->jam_mulai ? substr($item->jam_mulai, 0, 5) : '') }}" class="w-full rounded-lg border border-gray-300 px-3 py-2" required></div>
            <div><label class="mb-1 block text-sm font-medium text-gray-700">Jam Selesai</label><input type="time" name="jam_selesai" value="{{ old('jam_selesai', $item->jam_selesai ? substr($item->jam_selesai, 0, 5) : '') }}" class="w-full rounded-lg border border-gray-300 px-3 py-2" required></div>
        </div>
        <div><label class="mb-1 block text-sm font-medium text-gray-700">Ruangan</label><input type="text" name="ruangan" value="{{ old('ruangan', $item->ruangan ?? '') }}" class="w-full max-w-md rounded-lg border border-gray-300 px-3 py-2"></div>
    </div>
    <div class="flex gap-2 mt-6"><button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Simpan</button><a href="{{ route('admin.jadwal.index') }}" class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300">Batal</a></div>
</form>
@endsection
