@extends('layouts.dosen')

@section('content-body')
<x-page-header title="Riwayat OTP" />

<div class="overflow-x-auto rounded-xl bg-base-100 shadow">
    <table class="table table-zebra table-sm">
        <thead>
            <tr><th>Kode</th><th>Mata Kuliah</th><th>Dibuat</th><th>Expired</th><th>Status</th></tr>
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
                <tr><td colspan="5" class="text-center text-base-content/40 py-8">Belum ada OTP.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $otps->links() }}
</div>
@endsection
