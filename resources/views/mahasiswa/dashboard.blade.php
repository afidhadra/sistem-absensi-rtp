@extends('layouts.mahasiswa')

@section('content-body')
<x-flash />

<div class="space-y-4">
    <div>
        <h1 class="text-xl font-bold text-base-content">Dashboard</h1>
        <p class="text-xs text-base-content/50">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }} · {{ $mahasiswa->kelas?->kode ?? '-' }}</p>
    </div>

    {{-- Stat --}}
    <div class="flex items-center gap-3">
        <div class="radial-progress text-primary text-xs" style="--value:{{ $persentase }};" role="progressbar">
            <span class="text-xs font-bold">{{ $persentase }}%</span>
        </div>
        <div>
            <p class="text-xs text-base-content/50">Kehadiran</p>
            <p class="text-xs text-base-content/30">{{ $riwayat->count() }} sesi absen</p>
        </div>
    </div>

    {{-- Today Schedule --}}
    <div>
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-xs font-semibold text-base-content/70">Jadwal Hari Ini</h2>
            <span class="badge badge-ghost badge-xs">{{ $todaySchedule->count() }} kelas</span>
        </div>
        <div class="space-y-2">
            @forelse ($todaySchedule as $j)
                <div class="card bg-base-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="card-body p-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-semibold text-sm">{{ $j->teachingAssignment->mataKuliah->nama }}</h3>
                                <p class="text-xs text-base-content/50">{{ substr($j->jam_mulai, 0, 5) }}-{{ substr($j->jam_selesai, 0, 5) }} · {{ $j->ruangan ?? '-' }}</p>
                            </div>
                            <div class="shrink-0">
                                @if (in_array($j->teaching_assignment_id, $attendedTaIds))
                                    <span class="badge badge-success badge-sm">Hadir</span>
                                @elseif (!empty($activeOtpsByTa[$j->teaching_assignment_id]))
                                    <button onclick="document.getElementById('otp-{{ $j->id }}').classList.toggle('hidden')" class="btn btn-primary btn-xs">Absen</button>
                                @else
                                    <span class="badge badge-ghost badge-sm">Tunggu OTP</span>
                                @endif
                            </div>
                        </div>
                        @if (!empty($activeOtpsByTa[$j->teaching_assignment_id]) && !in_array($j->teaching_assignment_id, $attendedTaIds))
                            <form id="otp-{{ $j->id }}" method="POST" action="{{ route('mahasiswa.absensi') }}" class="hidden mt-2">
                                @csrf
                                <input type="hidden" name="teaching_assignment_id" value="{{ $j->teaching_assignment_id }}">
                                <div class="join w-full">
                                    <input type="text" name="kode" placeholder="6 digit" maxlength="6" class="input input-bordered join-item input-xs w-full text-center font-mono tracking-widest" required>
                                    <button type="submit" class="btn btn-primary join-item btn-xs">Kirim</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-6"><svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg><div class="text-xs text-base-content/30">Tidak ada jadwal hari ini.</div></div>
            @endforelse
        </div>
    </div>

    {{-- Recent --}}
    @if ($riwayat->isNotEmpty())
        <div>
            <h2 class="text-xs font-semibold text-base-content/70 mb-2">Riwayat Terbaru</h2>
            <div class="space-y-1">
                @foreach ($riwayat->take(5) as $att)
                    <div class="flex items-center justify-between text-xs py-1.5 border-b border-base-200 last:border-0">
                        <span>{{ $att->teachingAssignment?->mataKuliah?->nama ?? '-' }}</span>
                        <span class="text-base-content/30">{{ $att->attended_at->format('d/m H:i') }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
