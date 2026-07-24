@extends('layouts.dosen')

@section('content-body')
<x-flash />

<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-base-content">Dashboard</h1>
        <p class="text-sm text-base-content/50">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
    </div>

    {{-- OTP Active --}}
    @if (session('success'))
        <div class="alert alert-warning shadow-lg">
            <span class="font-mono text-2xl font-bold tracking-widest">{{ session('success') }}</span>
            <span class="alert-title">Kode OTP di atas. Bacakan ke mahasiswa.</span>
        </div>
    @endif

    {{-- Matkul Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($matkulList as $ta)
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-semibold text-base-content">{{ $ta->mataKuliah->nama }}</h3>
                            <p class="text-xs text-base-content/50 mt-0.5">{{ $ta->mataKuliah->kode }} - {{ $ta->kelas->kode }}</p>
                        </div>
                        <span class="badge badge-ghost badge-sm">{{ $ta->kelas->mahasiswa->count() }} mhs</span>
                    </div>

                    {{-- Jadwal hari ini --}}
                    @php
                        $today = strtolower(now()->locale('id')->dayName);
                        $jadwal = $ta->jadwal->where('hari', $today);
                    @endphp
                    @if ($jadwal->isNotEmpty())
                        <div class="mt-3 flex items-center gap-2 text-xs text-base-content/60">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ substr($jadwal->first()->jam_mulai, 0, 5) }}-{{ substr($jadwal->first()->jam_selesai, 0, 5) }} - {{ $jadwal->first()->ruangan ?? '-' }}
                        </div>
                    @endif

                    {{-- Active OTP --}}
                    @php
                        $active = $ta->otp->where('is_used', false)->where('expires_at', '>', now())->first();
                        $hadir = App\Models\Attendance::where('teaching_assignment_id', $ta->id)->count();
                    @endphp
                    @if ($active)
                        <div class="mt-3 bg-warning/10 border border-warning/30 rounded-lg p-3">
                            <p class="text-xs text-warning font-medium">OTP Aktif</p>
                            <p class="font-mono text-lg font-bold tracking-widest">{{ $active->kode }}</p>
                            <p class="text-xs text-base-content/50 mt-1">Expired {{ $active->expires_at->diffForHumans() }}</p>
                        </div>
                    @endif

                    {{-- Actions --}}
                    <div class="mt-4 flex items-center gap-2">
                        <form method="POST" action="{{ route('dosen.otp-generate') }}">
                            @csrf
                            <input type="hidden" name="teaching_assignment_id" value="{{ $ta->id }}">
                            <button class="btn btn-primary btn-sm">Generate OTP</button>
                        </form>
                        <a href="{{ route('dosen.attendance', $ta) }}" class="btn btn-ghost btn-sm">Absensi ({{ $hadir }})</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
