@extends('layouts.admin')

@section('content-body')
<div class="space-y-6">
    {{-- Welcome --}}
    <div>
        <h1 class="text-2xl font-bold text-base-content">Dashboard</h1>
        <p class="text-sm text-base-content/50">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="stat bg-base-100 rounded-2xl shadow-sm">
            <div class="stat-title">Mahasiswa</div>
            <div class="stat-value text-primary">{{ $stats['mahasiswa'] ?? 0 }}</div>
        </div>
        <div class="stat bg-base-100 rounded-2xl shadow-sm">
            <div class="stat-title">Dosen</div>
            <div class="stat-value text-secondary">{{ $stats['dosen'] ?? 0 }}</div>
        </div>
        <div class="stat bg-base-100 rounded-2xl shadow-sm">
            <div class="stat-title">Mata Kuliah</div>
            <div class="stat-value text-accent">{{ $stats['mata_kuliah'] ?? 0 }}</div>
        </div>
        <div class="stat bg-base-100 rounded-2xl shadow-sm">
            <div class="stat-title">Kelas</div>
            <div class="stat-value text-info">{{ $stats['kelas'] ?? 0 }}</div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
        <a href="{{ route('admin.dosen.create') }}" class="btn btn-outline btn-sm">+ Dosen</a>
        <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-outline btn-sm">+ Mahasiswa</a>
        <a href="{{ route('admin.mata-kuliah.create') }}" class="btn btn-outline btn-sm">+ Matkul</a>
        <a href="{{ route('admin.kelas.create') }}" class="btn btn-outline btn-sm">+ Kelas</a>
        <a href="{{ route('admin.teaching-assignment.create') }}" class="btn btn-outline btn-sm">+ Penugasan</a>
        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-outline btn-sm">+ Jadwal</a>
    </div>
</div>
@endsection
