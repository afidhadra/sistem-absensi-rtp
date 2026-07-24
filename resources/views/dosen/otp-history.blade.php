@extends('layouts.dosen')

@section('content-body')
<h1 class="mb-6 text-2xl font-bold text-gray-800">Riwayat OTP</h1>

<div class="overflow-hidden rounded-xl bg-white shadow">
    <table class="w-full text-left text-sm">
        <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
            <tr><th class="px-4 py-3">OTP</th><th class="px-4 py-3">Mata Kuliah</th><th class="px-4 py-3">Dibuat</th><th class="px-4 py-3">Berlaku Sampai</th><th class="px-4 py-3">Status</th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($otps as $otp)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono text-lg">{{ $otp->kode }}</td>
                    <td class="px-4 py-3">{{ $otp->teachingAssignment?->mataKuliah?->nama ?? '-' }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $otp->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $otp->expires_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-3">
                        @if ($otp->isExpired())
                            <span class="text-xs text-red-500">Kadaluarsa</span>
                        @elseif ($otp->is_used)
                            <span class="text-xs text-gray-500">Digunakan</span>
                        @else
                            <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs text-green-700">Aktif</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">Belum ada OTP.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
