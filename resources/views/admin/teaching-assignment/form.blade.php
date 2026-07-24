@extends('layouts.admin')

@section('content-body')
<x-form-errors />
<x-page-header title="{{ isset($item) ? 'Edit Penugasan Dosen' : 'Tambah Penugasan Dosen' }}" />

<form method="POST" action="{{ isset($item) ? route('admin.teaching-assignment.update', $item) : route('admin.teaching-assignment.store') }}"><div class="card border border-base-300 border-l-4 border-l-primary"><div class="card-body p-4 space-y-3">
    @csrf @if (isset($item)) @method('PUT') @endif
    <div class="grid grid-cols-2 gap-4 max-w-2xl mb-4">
        <div>
            <label class="label"><span class="label-text text-xs">Dosen</span></label>
            <select name="dosen_id" class="select select-bordered w-full" required>
                @foreach ($dosen as $d)
                    <option value="{{ $d->id }}" @if (old('dosen_id', $item->dosen_id ?? '') == $d->id) selected @endif>{{ $d->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="label"><span class="label-text text-xs">Mata Kuliah</span></label>
            <select name="mata_kuliah_id" class="select select-bordered w-full" required>
                @foreach ($mataKuliah as $m)
                    <option value="{{ $m->id }}" @if (old('mata_kuliah_id', $item->mata_kuliah_id ?? '') == $m->id) selected @endif>{{ $m->kode }} - {{ $m->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="label"><span class="label-text text-xs">Kelas</span></label>
            <select name="kelas_id" class="select select-bordered w-full" required>
                @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" @if (old('kelas_id', $item->kelas_id ?? '') == $k->id) selected @endif>{{ $k->kode }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="label"><span class="label-text text-xs">Semester</span></label>
            <select name="semester_id" class="select select-bordered w-full" required>
                @foreach ($semesters as $s)
                    <option value="{{ $s->id }}" @if (old('semester_id', $item->semester_id ?? '') == $s->id) selected @endif>{{ $s->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="label"><span class="label-text text-xs">Tahun Akademik</span></label>
            <select name="tahun_akademik_id" class="select select-bordered w-full" required>
                @foreach ($tahunAkademik as $t)
                    <option value="{{ $t->id }}" @if (old('tahun_akademik_id', $item->tahun_akademik_id ?? '') == $t->id) selected @endif>{{ $t->kode }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <x-form-actions :cancelRoute="route('admin.teaching-assignment.index')" />
</div></div></form>
@endsection
