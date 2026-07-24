@extends('layouts.dosen')

@section('content-body')
<x-page-header title="Riwayat OTP" />

<div class="overflow-x-auto rounded-xl bg-base-100 shadow">
    <table class="table table-zebra table-sm">
        <thead>
            <tr class="text-xs uppercase text-base-content/50"><th>Kode</th><th>Mata Kuliah</th><th>Dibuat</th><th>Expired</th><th>Status</th></tr>
        </thead>
        <tbody>
            @forelse ($otps as $otp)
                <tr class="hover">
                    <td class="font-mono font-bold">{{ $otp->kode }}</td>
                    <td>{{ $otp->teachingAssignment?->mataKuliah?->nama ?? '-' }}</td>
                    <td class="text-xs text-base-content/50">{{ $otp->created_at->format('d/m/Y H:i') }}</td>
                    <td class="text-xs text-base-content/50">{{ $otp->expires_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if ($otp->is_used)
                            <span class="badge badge-success badge-sm">Digunakan</span>
                        @elseif ($otp->isExpired())
                            <span class="badge badge-ghost badge-sm">Kedaluwarsa</span>
                        @else
                            <span class="badge badge-warning badge-sm">Aktif</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-8"><svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg><div class="text-base-content/40 text-xs">Belum ada OTP.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $otps->links() }}
</div>
@endsection
