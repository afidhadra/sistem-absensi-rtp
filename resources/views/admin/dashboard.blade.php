@extends('layouts.admin')

@section('content-body')
<div class="space-y-4">
    {{-- Welcome --}}
    <div>
        <h1 class="text-xl font-bold text-base-content">Dashboard</h1>
        <p class="text-xs text-base-content/50">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        <div class="stat bg-base-100 rounded-xl shadow-sm py-3">
            <div class="stat-title text-xs">Mahasiswa</div>
            <div class="stat-value text-lg text-primary">{{ $stats['mahasiswa'] ?? 0 }}</div>
        </div>
        <div class="stat bg-base-100 rounded-xl shadow-sm py-3">
            <div class="stat-title text-xs">Dosen</div>
            <div class="stat-value text-lg text-secondary">{{ $stats['dosen'] ?? 0 }}</div>
        </div>
        <div class="stat bg-base-100 rounded-xl shadow-sm py-3">
            <div class="stat-title text-xs">Mata Kuliah</div>
            <div class="stat-value text-lg text-accent">{{ $stats['mata_kuliah'] ?? 0 }}</div>
        </div>
        <div class="stat bg-base-100 rounded-xl shadow-sm py-3">
            <div class="stat-title text-xs">Kelas</div>
            <div class="stat-value text-lg text-info">{{ $stats['kelas'] ?? 0 }}</div>
        </div>
    </div>

    {{-- Quick Actions --}}
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
