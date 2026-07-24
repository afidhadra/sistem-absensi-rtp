@extends('layouts.mahasiswa')

@section('content-body')
<x-page-header title="Riwayat Absensi" />

<div class="overflow-x-auto rounded-xl bg-base-100 shadow">
    <table class="table table-zebra table-sm">
        <thead>
            <tr><th>Tanggal</th><th>Mata Kuliah</th><th>Dosen</th><th>Waktu</th></tr>
        </thead>
        <tbody>
            @forelse ($riwayat as $att)
                <tr class="hover">
                    <td>{{ $att->attended_at->format('d/m/Y') }}</td>
                    <td>{{ $att->teachingAssignment?->mataKuliah?->nama ?? '-' }}</td>
                    <td class="text-base-content/50">{{ $att->teachingAssignment?->dosen?->nama ?? '-' }}</td>
                    <td class="font-mono">{{ $att->attended_at->format('H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-base-content/40 py-8">Belum ada riwayat absensi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $riwayat->links() }}
</div>
@endsection
