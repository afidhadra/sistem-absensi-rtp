@extends('layouts.mahasiswa')

@section('content-body')
<h1 class="mb-6 text-2xl font-bold text-gray-800">Riwayat Absensi</h1>

<div class="overflow-hidden rounded-xl bg-white shadow">
    <table class="w-full text-left text-sm">
        <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
            <tr><th class="px-4 py-3">Tanggal</th><th class="px-4 py-3">Mata Kuliah</th><th class="px-4 py-3">Dosen</th><th class="px-4 py-3">Waktu</th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($riwayat as $att)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $att->attended_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">{{ $att->teachingAssignment?->mataKuliah?->nama ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $att->teachingAssignment?->dosen?->nama ?? '-' }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $att->attended_at->format('H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-6 text-center text-gray-400">Belum ada riwayat absensi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
