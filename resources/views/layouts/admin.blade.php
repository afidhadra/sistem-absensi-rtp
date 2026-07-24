@extends('layouts.app')

@php
    $navItems = [
        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
        ['route' => 'admin.fakultas.index', 'label' => 'Fakultas'],
        ['route' => 'admin.prodi.index', 'label' => 'Program Studi'],
        ['route' => 'admin.semester.index', 'label' => 'Semester'],
        ['route' => 'admin.tahun-akademik.index', 'label' => 'Tahun Akademik'],
        ['route' => 'admin.kelas.index', 'label' => 'Kelas'],
        ['route' => 'admin.mata-kuliah.index', 'label' => 'Mata Kuliah'],
        ['route' => 'admin.dosen.index', 'label' => 'Dosen'],
        ['route' => 'admin.mahasiswa.index', 'label' => 'Mahasiswa'],
        ['route' => 'admin.teaching-assignment.index', 'label' => 'Penugasan Dosen'],
        ['route' => 'admin.jadwal.index', 'label' => 'Jadwal'],
        ['route' => 'admin.report.index', 'label' => 'Laporan'],
    ];
@endphp

@section('content')
<div class="flex min-h-screen">
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-4 border-b border-gray-700">
            <h2 class="font-bold text-sm">RTP Admin Panel</h2>
            <p class="text-xs text-gray-400 mt-1">{{ auth()->user()->name }}</p>
        </div>
        <nav class="flex-1 py-2 overflow-y-auto">
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="block px-4 py-2 text-sm hover:bg-gray-700 @if (request()->routeIs(str_replace('.index', '.*', $item['route']))) bg-gray-700 @endif">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs text-gray-400 hover:text-white">Keluar</button>
            </form>
        </div>
    </aside>
    <main class="flex-1 overflow-y-auto">
        <div class="p-6">
            @yield('content-body')
        </div>
    </main>
</div>
@endsection
