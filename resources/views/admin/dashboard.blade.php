@extends('layouts.admin')

@section('content-body')
<div class="space-y-4">
    <div>
        <h1 class="text-xl font-bold text-base-content">Dashboard</h1>
        <p class="text-xs text-base-content/50">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        <div class="stat bg-primary text-primary-content rounded-xl py-3">
            <div class="stat-title text-primary-content/60 text-xs">Total Mahasiswa</div>
            <div class="stat-value text-lg">{{ $stats['mahasiswa'] ?? 0 }}</div>
        </div>
        <div class="stat border border-base-300 rounded-xl py-3">
            <div class="stat-title text-xs text-base-content/50">Dosen</div>
            <div class="stat-value text-lg text-base-content">{{ $stats['dosen'] ?? 0 }}</div>
        </div>
        <div class="stat border border-base-300 rounded-xl py-3">
            <div class="stat-title text-xs text-base-content/50">Mata Kuliah</div>
            <div class="stat-value text-lg text-base-content">{{ $stats['mata_kuliah'] ?? 0 }}</div>
        </div>
        <div class="stat border border-base-300 rounded-xl py-3">
            <div class="stat-title text-xs text-base-content/50">Kelas</div>
            <div class="stat-value text-lg text-base-content">{{ $stats['kelas'] ?? 0 }}</div>
        </div>
    </div>

    @if ($todayAttendances)
        <div>
            <h2 class="text-xs font-semibold text-base-content/70 mb-2">Absensi Hari Ini</h2>
            <div class="space-y-2">
                @foreach ($todayAttendances as $a)
                    <div class="card bg-base-100 shadow-sm">
                        <div class="card-body p-3">
                            <div class="flex items-center justify-between text-xs mb-1">
                                <span class="font-medium">{{ $a['matkul'] }} · {{ $a['kelas'] }}</span>
                                <span class="text-base-content/50">{{ $a['hadir'] }}/{{ $a['total'] }}</span>
                            </div>
                            <progress class="progress progress-primary w-full" value="{{ $a['hadir'] }}" max="{{ $a['total'] }}"></progress>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="flex flex-wrap gap-2">
        <a href="{{ route('admin.dosen.create') }}" class="btn btn-outline btn-xs">+ Dosen</a>
        <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-outline btn-xs">+ Mahasiswa</a>
        <a href="{{ route('admin.mata-kuliah.create') }}" class="btn btn-outline btn-xs">+ Matkul</a>
        <a href="{{ route('admin.kelas.create') }}" class="btn btn-outline btn-xs">+ Kelas</a>
        <a href="{{ route('admin.teaching-assignment.create') }}" class="btn btn-outline btn-xs">+ Penugasan</a>
        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-outline btn-xs">+ Jadwal</a>
    </div>
</div>
@endsection
