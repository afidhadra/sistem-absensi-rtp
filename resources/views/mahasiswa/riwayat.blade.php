@extends('layouts.mahasiswa')

@section('content-body')
<x-page-header title="Riwayat Absensi" />

<div class="overflow-x-auto rounded-xl bg-base-100 shadow">
    <table class="table table-zebra table-sm">
        <thead>
            <tr class="text-xs uppercase text-base-content/50"><th>Tanggal</th><th>Mata Kuliah</th><th>Dosen</th><th>Waktu</th></tr>
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
                <tr><td colspan="4" class="text-center py-8"><svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg><div class="text-base-content/40 text-xs">Belum ada riwayat absensi.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $riwayat->links() }}
</div>
@endsection
