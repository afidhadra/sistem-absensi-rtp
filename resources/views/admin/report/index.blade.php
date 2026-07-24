@extends('layouts.admin')

@section('content-body')
<h1 class="mb-6 text-2xl font-bold text-gray-800">Laporan Absensi</h1>

<form method="GET" class="mb-6 flex flex-wrap items-end gap-3 rounded-lg bg-white p-4 shadow-sm">
    <div><label class="mb-1 block text-xs font-medium text-gray-600">Matkul</label><select name="mata_kuliah_id" class="rounded-lg border border-gray-300 px-2 py-1.5 text-sm"><option value="">Semua</option>@foreach ($mataKuliah as $m)<option value="{{ $m->id }}" @if (request('mata_kuliah_id') == $m->id) selected @endif>{{ $m->kode }} - {{ $m->nama }}</option>@endforeach</select></div>
    <div><label class="mb-1 block text-xs font-medium text-gray-600">Dosen</label><select name="dosen_id" class="rounded-lg border border-gray-300 px-2 py-1.5 text-sm"><option value="">Semua</option>@foreach ($dosen as $d)<option value="{{ $d->id }}" @if (request('dosen_id') == $d->id) selected @endif>{{ $d->nama }}</option>@endforeach</select></div>
    <div><label class="mb-1 block text-xs font-medium text-gray-600">Kelas</label><select name="kelas_id" class="rounded-lg border border-gray-300 px-2 py-1.5 text-sm"><option value="">Semua</option>@foreach ($kelas as $k)<option value="{{ $k->id }}" @if (request('kelas_id') == $k->id) selected @endif>{{ $k->kode }}</option>@endforeach</select></div>
    <div><label class="mb-1 block text-xs font-medium text-gray-600">Semester</label><select name="semester_id" class="rounded-lg border border-gray-300 px-2 py-1.5 text-sm"><option value="">Semua</option>@foreach ($semesters as $s)<option value="{{ $s->id }}" @if (request('semester_id') == $s->id) selected @endif>{{ $s->nama }}</option>@endforeach</select></div>
    <div><label class="mb-1 block text-xs font-medium text-gray-600">Tahun</label><select name="tahun_akademik_id" class="rounded-lg border border-gray-300 px-2 py-1.5 text-sm"><option value="">Semua</option>@foreach ($tahunAkademik as $t)<option value="{{ $t->id }}" @if (request('tahun_akademik_id') == $t->id) selected @endif>{{ $t->kode }}</option>@endforeach</select></div>
    <div><label class="mb-1 block text-xs font-medium text-gray-600">Dari</label><input type="date" name="dari" value="{{ request('dari') }}" class="rounded-lg border border-gray-300 px-2 py-1.5 text-sm"></div>
    <div><label class="mb-1 block text-xs font-medium text-gray-600">Sampai</label><input type="date" name="sampai" value="{{ request('sampai') }}" class="rounded-lg border border-gray-300 px-2 py-1.5 text-sm"></div>
    <button type="submit" class="rounded-lg bg-blue-600 px-4 py-1.5 text-sm font-medium text-white hover:bg-blue-700">Filter</button>
    <a href="{{ route('admin.report.csv', request()->query()) }}" class="rounded-lg bg-green-600 px-4 py-1.5 text-sm font-medium text-white hover:bg-green-700">CSV</a>
</form>

<div class="overflow-hidden rounded-xl bg-white shadow">
    <div class="px-4 py-3 text-sm text-gray-500">Ditemukan {{ $attendances->count() }} data</div>
    <table class="w-full text-left text-sm">
        <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
            <tr><th class="px-4 py-3">NIM</th><th class="px-4 py-3">Mahasiswa</th><th class="px-4 py-3">Matkul</th><th class="px-4 py-3">Dosen</th><th class="px-4 py-3">Kelas</th><th class="px-4 py-3">Tanggal</th><th class="px-4 py-3">Jam</th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($attendances as $a)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono">{{ $a->mahasiswa->nim }}</td>
                    <td class="px-4 py-3">{{ $a->mahasiswa->nama }}</td>
                    <td class="px-4 py-3">{{ $a->teachingAssignment->mataKuliah->nama }}</td>
                    <td class="px-4 py-3">{{ $a->teachingAssignment->dosen->nama }}</td>
                    <td class="px-4 py-3">{{ $a->teachingAssignment->kelas->kode }}</td>
                    <td class="px-4 py-3">{{ $a->attended_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">{{ $a->attended_at->format('H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-4 py-8 text-center text-gray-400">Belum ada data absensi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
