@extends('layouts.admin')

@section('content-body')
<div class="mx-auto max-w-7xl px-4 py-8">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300">Keluar</button>
        </form>
    </div>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl bg-white p-6 shadow">
            <p class="text-sm text-gray-500">Total Mahasiswa</p>
            <p class="mt-2 text-3xl font-bold text-gray-800">{{ $stats['mahasiswa'] ?? 0 }}</p>
        </div>
        <div class="rounded-xl bg-white p-6 shadow">
            <p class="text-sm text-gray-500">Total Dosen</p>
            <p class="mt-2 text-3xl font-bold text-gray-800">{{ $stats['dosen'] ?? 0 }}</p>
        </div>
        <div class="rounded-xl bg-white p-6 shadow">
            <p class="text-sm text-gray-500">Total Mata Kuliah</p>
            <p class="mt-2 text-3xl font-bold text-gray-800">{{ $stats['mata_kuliah'] ?? 0 }}</p>
        </div>
        <div class="rounded-xl bg-white p-6 shadow">
            <p class="text-sm text-gray-500">Total Kelas</p>
            <p class="mt-2 text-3xl font-bold text-gray-800">{{ $stats['kelas'] ?? 0 }}</p>
        </div>
    </div>
</div>
@endsection
