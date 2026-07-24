@extends('layouts.admin')

@section('content-body')
<h1 class="mb-6 text-2xl font-bold text-gray-800">{{ isset($item) ? 'Edit Penugasan' : 'Tambah Penugasan' }}</h1>
<form method="POST" action="{{ isset($item) ? route('admin.teaching-assignment.update', $item) : route('admin.teaching-assignment.store') }}">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="space-y-4 max-w-2xl">
        <div>
            <label class="mb-1 block text-sm font-medium text-gray-700">Dosen</label>
            <select name="dosen_id" class="w-full rounded-lg border border-gray-300 px-3 py-2" required>
                <option value="">Pilih Dosen</option>
                @foreach ($dosen as $d)<option value="{{ $d->id }}" @if (old('dosen_id', $item->dosen_id ?? '') == $d->id) selected @endif>{{ $d->nama }} ({{ $d->nip }})</option>@endforeach
            </select>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium text-gray-700">Mata Kuliah</label>
            <select name="mata_kuliah_id" class="w-full rounded-lg border border-gray-300 px-3 py-2" required>
                <option value="">Pilih Mata Kuliah</option>
                @foreach ($mataKuliah as $m)<option value="{{ $m->id }}" @if (old('mata_kuliah_id', $item->mata_kuliah_id ?? '') == $m->id) selected @endif>{{ $m->kode }} - {{ $m->nama }} ({{ $m->sks }} SKS)</option>@endforeach
            </select>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div><label class="mb-1 block text-sm font-medium text-gray-700">Kelas</label><select name="kelas_id" class="w-full rounded-lg border border-gray-300 px-3 py-2" required><option value="">-</option>@foreach ($kelas as $k)<option value="{{ $k->id }}" @if (old('kelas_id', $item->kelas_id ?? '') == $k->id) selected @endif>{{ $k->kode }}</option>@endforeach</select></div>
            <div><label class="mb-1 block text-sm font-medium text-gray-700">Semester</label><select name="semester_id" class="w-full rounded-lg border border-gray-300 px-3 py-2" required><option value="">-</option>@foreach ($semesters as $s)<option value="{{ $s->id }}" @if (old('semester_id', $item->semester_id ?? '') == $s->id) selected @endif>{{ $s->nama }}</option>@endforeach</select></div>
            <div><label class="mb-1 block text-sm font-medium text-gray-700">Tahun Akademik</label><select name="tahun_akademik_id" class="w-full rounded-lg border border-gray-300 px-3 py-2" required><option value="">-</option>@foreach ($tahunAkademik as $t)<option value="{{ $t->id }}" @if (old('tahun_akademik_id', $item->tahun_akademik_id ?? '') == $t->id) selected @endif>{{ $t->kode }}</option>@endforeach</select></div>
        </div>
    </div>
    <div class="flex gap-2 mt-6"><button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Simpan</button><a href="{{ route('admin.teaching-assignment.index') }}" class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300">Batal</a></div>
</form>
@endsection
