@extends('layouts.mahasiswa')

@section('content-body')
<x-flash />

<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-base-content">Dashboard</h1>
        <p class="text-sm text-base-content/50">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }} - {{ $mahasiswa->kelas?->kode ?? '-' }}</p>
    </div>

    {{-- Stat --}}
    <div class="flex items-center gap-4">
        <div class="radial-progress text-primary" style="--value:{{ $persentase }};" role="progressbar">
            <span class="text-sm font-bold">{{ $persentase }}%</span>
        </div>
        <div>
            <p class="text-sm text-base-content/50">Kehadiran kamu</p>
            <p class="text-xs text-base-content/40">{{ $riwayat->count() }} sesi absen</p>
        </div>
    </div>

    {{-- Today Schedule --}}
    <div>
        <h2 class="text-sm font-semibold text-base-content/70 mb-3">Jadwal Hari Ini</h2>
        <div class="space-y-3">
            @forelse ($todaySchedule as $j)
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body p-4 flex flex-row items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-sm">{{ $j->teachingAssignment->mataKuliah->nama }}</h3>
                            <p class="text-xs text-base-content/50">{{ substr($j->jam_mulai, 0, 5) }}-{{ substr($j->jam_selesai, 0, 5) }} - {{ $j->ruangan ?? '-' }}</p>
                        </div>
                        <div>
                            @if (in_array($j->teaching_assignment_id, $attendedTaIds))
                                <span class="badge badge-success badge-sm">Hadir</span>
                            @elseif (!empty($activeOtpsByTa[$j->teaching_assignment_id]))
                                <button onclick="document.getElementById('otp-{{ $j->id }}').classList.toggle('hidden')" class="btn btn-primary btn-sm">Absen</button>
                            @else
                                <span class="badge badge-ghost badge-sm">Menunggu OTP</span>
                            @endif
                        </div>
                    </div>
                    @if (!empty($activeOtpsByTa[$j->teaching_assignment_id]) && !in_array($j->teaching_assignment_id, $attendedTaIds))
                        <form id="otp-{{ $j->id }}" method="POST" action="{{ route('mahasiswa.absensi') }}" class="hidden px-4 pb-4">
                            @csrf
                            <input type="hidden" name="teaching_assignment_id" value="{{ $j->teaching_assignment_id }}">
                            <div class="join w-full">
                                <input type="text" name="kode" placeholder="Kode OTP 6 digit" maxlength="6" class="input input-bordered join-item w-full text-center font-mono tracking-widest" required>
                                <button type="submit" class="btn btn-primary join-item">Kirim</button>
                            </div>
                        </form>
                    @endif
                </div>
            @empty
                <div class="text-center py-8 text-base-content/40 text-sm">Tidak ada jadwal hari ini.</div>
            @endforelse
        </div>
    </div>

    {{-- Recent --}}
    @if ($riwayat->isNotEmpty())
        <div>
            <h2 class="text-sm font-semibold text-base-content/70 mb-3">Riwayat Terbaru</h2>
            <div class="space-y-2">
                @foreach ($riwayat->take(5) as $att)
                    <div class="flex items-center justify-between text-sm py-2 border-b border-base-200 last:border-0">
                        <span>{{ $att->teachingAssignment?->mataKuliah?->nama ?? '-' }}</span>
                        <span class="text-base-content/40">{{ $att->attended_at->format('d/m H:i') }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
