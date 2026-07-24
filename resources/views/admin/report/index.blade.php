@extends('layouts.admin')

@section('content-body')
<x-page-header title="Laporan Absensi" />

<form method="GET" class="mb-6 flex flex-wrap items-end gap-3">
    <select name="mata_kuliah_id" class="select select-bordered select-sm">
        <option value="">Semua Matkul</option>
        @foreach ($mataKuliah as $m)
            <option value="{{ $m->id }}" @if (request('mata_kuliah_id') == $m->id) selected @endif>{{ $m->kode }} - {{ $m->nama }}</option>
        @endforeach
    </select>
    <select name="dosen_id" class="select select-bordered select-sm">
        <option value="">Semua Dosen</option>
        @foreach ($dosen as $d)
            <option value="{{ $d->id }}" @if (request('dosen_id') == $d->id) selected @endif>{{ $d->nama }}</option>
        @endforeach
    </select>
    <select name="kelas_id" class="select select-bordered select-sm">
        <option value="">Semua Kelas</option>
        @foreach ($kelas as $k)
            <option value="{{ $k->id }}" @if (request('kelas_id') == $k->id) selected @endif>{{ $k->kode }}</option>
        @endforeach
    </select>
    <select name="semester_id" class="select select-bordered select-sm">
        <option value="">Semua Semester</option>
        @foreach ($semesters as $s)
            <option value="{{ $s->id }}" @if (request('semester_id') == $s->id) selected @endif>{{ $s->nama }}</option>
        @endforeach
    </select>
    <select name="tahun_akademik_id" class="select select-bordered select-sm">
        <option value="">Semua Tahun</option>
        @foreach ($tahunAkademik as $t)
            <option value="{{ $t->id }}" @if (request('tahun_akademik_id') == $t->id) selected @endif>{{ $t->kode }}</option>
        @endforeach
    </select>
    <input type="date" name="dari" value="{{ request('dari') }}" class="input input-bordered input-sm">
    <input type="date" name="sampai" value="{{ request('sampai') }}" class="input input-bordered input-sm">
    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
    <a href="{{ route('admin.report.csv', request()->query()) }}" class="btn btn-success btn-sm">CSV</a>
</form>

<div class="overflow-hidden rounded-xl bg-base-100 shadow">
    <div class="px-4 py-3 text-sm text-base-content/50">Ditemukan {{ $attendances->count() }} data</div>
    <table class="table table-zebra table-sm">
        <thead>
            <tr class="text-xs uppercase text-base-content/50"><th>NIM</th><th>Mahasiswa</th><th>Matkul</th><th>Dosen</th><th>Kelas</th><th>Tanggal</th><th>Jam</th></tr>
        </thead>
        <tbody>
            @forelse ($attendances as $a)
                <tr class="hover">
                    <td class="font-mono">{{ $a->mahasiswa->nim }}</td>
                    <td>{{ $a->mahasiswa->nama }}</td>
                    <td>{{ $a->teachingAssignment->mataKuliah->nama }}</td>
                    <td>{{ $a->teachingAssignment->dosen->nama }}</td>
                    <td>{{ $a->teachingAssignment->kelas->kode }}</td>
                    <td>{{ $a->attended_at->format('d/m/Y') }}</td>
                    <td>{{ $a->attended_at->format('H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center py-8"><svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg><div class="text-base-content/40 text-xs">Belum ada data absensi.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $attendances->links() }}
</div>
@endsection

