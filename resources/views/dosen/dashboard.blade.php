@extends('layouts.dosen')

@section('content-body')
<x-flash />

<div class="space-y-4">
    <div>
        <h1 class="text-xl font-bold text-base-content">Dashboard</h1>
        <p class="text-xs text-base-content/50">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
    </div>

    {{-- OTP Active --}}
    @if (session('success'))
        <div class="alert alert-warning shadow-sm py-2">
            <span class="font-mono text-xl font-bold tracking-widest">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Stats --}}
    <div class="flex items-center gap-3 text-xs text-base-content/50">
        <span class="font-medium text-base-content">{{ $matkulList->count() }} matkul</span>
        <span class="w-px h-3 bg-base-300"></span>
        <span>{{ $matkulList->sum(fn($t) => $t->kelas->mahasiswa->count()) }} mahasiswa</span>
        <span class="w-px h-3 bg-base-300"></span>
        <span>{{ $matkulList->sum('hadir_count') }} hadir hari ini</span>
    </div>

    {{-- Matkul Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        @forelse ($matkulList as $ta)
            @php $colors = ['border-l-primary', 'border-l-secondary', 'border-l-accent', 'border-l-info']; $c = $colors[$loop->index % 4] @endphp
            <div class="card bg-base-100 shadow-sm hover:shadow-md transition-shadow border-l-4 {{ $c }}">
                <div class="card-body p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-semibold text-sm">{{ $ta->mataKuliah->nama }}</h3>
                            <p class="text-xs text-base-content/50 mt-0.5">{{ $ta->mataKuliah->kode }} - {{ $ta->kelas->kode }}</p>
                        </div>
                        <span class="badge badge-ghost badge-sm">{{ $ta->hadir_count }}/{{ $ta->kelas->mahasiswa->count() }}</span>
                    </div>

                    {{-- Jadwal hari ini --}}
                    @php
                        $today = strtolower(now()->locale('id')->dayName);
                        $jadwal = $ta->jadwal->where('hari', $today);
                    @endphp
                    @if ($jadwal->isNotEmpty())
                        <div class="mt-2 text-xs text-base-content/60">{{ substr($jadwal->first()->jam_mulai, 0, 5) }}-{{ substr($jadwal->first()->jam_selesai, 0, 5) }} · {{ $jadwal->first()->ruangan ?? '-' }}</div>
                    @endif

                    {{-- Active OTP --}}
                    @php
                        $active = $ta->otps->where('is_used', false)->where('expires_at', '>', now())->first();
                    @endphp
                    @if ($active)
                        <div class="mt-2 bg-warning/10 border border-warning/30 rounded-lg px-3 py-2 hover:bg-warning/15 transition-colors">
                            <p class="text-xs text-warning font-medium">OTP Aktif</p>
                            <p class="font-mono text-base font-bold tracking-widest">{{ $active->kode }}</p>
                            <p class="text-xs text-base-content/50 mt-0.5">Expired {{ $active->expires_at->diffForHumans() }}</p>
                        </div>
                    @endif

                    {{-- Actions --}}
                    <div class="mt-3 flex items-center gap-2">
                        <form method="POST" action="{{ route('dosen.otp-generate') }}">
                            @csrf
                            <input type="hidden" name="teaching_assignment_id" value="{{ $ta->id }}">
                            <button class="btn btn-primary btn-xs">Generate OTP</button>
                        </form>
                        <a href="{{ route('dosen.attendance', $ta) }}" class="btn btn-ghost btn-xs">Absensi</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8 text-base-content/30 text-xs">Belum ada penugasan mata kuliah.</div>
        @endforelse
        </div>
</div>
@endsection
