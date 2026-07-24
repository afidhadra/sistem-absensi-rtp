@extends('layouts.dosen')

@section('content-body')
@if (session('success'))
    <div class="mb-4 rounded-lg bg-green-50 p-4 text-center text-lg font-bold text-green-700">{{ session('success') }}</div>
@endif

<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    <section>
        <h2 class="mb-3 text-lg font-semibold text-gray-800">Mata Kuliah Diampu</h2>
        @forelse ($assignments as $ta)
            <div class="mb-3 rounded-lg border bg-white p-4 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $ta->mataKuliah->nama }} ({{ $ta->mataKuliah->kode }})</h3>
                        <p class="text-sm text-gray-500">{{ $ta->kelas->kode }} — {{ $ta->semester->nama }} {{ $ta->tahunAkademik->kode }}</p>
                        @if ($ta->jadwal->isNotEmpty())
                            <p class="text-xs text-gray-400 mt-1">
                                @foreach ($ta->jadwal as $j)
                                    <span class="capitalize">{{ $j->hari }} {{ substr($j->jam_mulai, 0, 5) }}-{{ substr($j->jam_selesai, 0, 5) }} ({{ $j->ruangan ?? '-' }})@if (!$loop->last), @endif</span>
                                @endforeach
                            </p>
                        @endif
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('dosen.attendance', $ta) }}" class="rounded bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-200">Absensi</a>
                        <form method="POST" action="{{ route('dosen.otp-generate') }}">
                            @csrf
                            <input type="hidden" name="teaching_assignment_id" value="{{ $ta->id }}">
                            <button type="submit" class="rounded bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">Generate OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="rounded-lg bg-white p-4 text-sm text-gray-500 shadow-sm">Belum ada penugasan.</p>
        @endforelse
    </section>

    <section>
        <h2 class="mb-3 text-lg font-semibold text-gray-800">OTP Aktif</h2>
        @forelse ($activeOtps as $otp)
            <div class="mb-3 rounded-lg border border-yellow-200 bg-yellow-50 p-4 shadow-sm">
                <p class="text-lg font-bold text-gray-800">{{ $otp->kode }}</p>
                <p class="text-xs text-gray-500">{{ $otp->teachingAssignment->mataKuliah->nama }} — berlaku sampai {{ $otp->expires_at->format('H:i:s') }}</p>
            </div>
        @empty
            <p class="rounded-lg bg-white p-4 text-sm text-gray-500 shadow-sm">Tidak ada OTP aktif.</p>
        @endforelse
    </section>
</div>
@endsection
