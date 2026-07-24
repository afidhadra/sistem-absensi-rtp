@extends('layouts.dosen')

@section('content-body')
<a href="{{ route('dosen.dashboard') }}" class="mb-4 inline-block text-sm text-blue-600 hover:underline">&larr; Kembali</a>
<h1 class="mb-2 text-2xl font-bold text-gray-800">{{ $teachingAssignment->mataKuliah->nama }}</h1>
<p class="mb-6 text-sm text-gray-500">{{ $teachingAssignment->kelas->kode }} — {{ $teachingAssignment->semester->nama }} {{ $teachingAssignment->tahunAkademik->kode }}</p>

<div class="overflow-hidden rounded-xl bg-white shadow">
    <table class="w-full text-left text-sm">
        <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
            <tr><th class="px-4 py-3">NIM</th><th class="px-4 py-3">Nama</th><th class="px-4 py-3">Waktu</th><th class="px-4 py-3">Status</th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($attendances as $att)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono">{{ $att->mahasiswa->nim }}</td>
                    <td class="px-4 py-3">{{ $att->mahasiswa->nama }}</td>
                    <td class="px-4 py-3">{{ $att->attended_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-3"><span class="rounded-full bg-green-100 px-2 py-0.5 text-xs text-green-700">Hadir</span></td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-6 text-center text-gray-400">Belum ada absensi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
