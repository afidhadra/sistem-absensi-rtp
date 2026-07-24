@php
$navItems = [
    ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
    ['divider' => 'Master Data'],
    ['route' => 'admin.fakultas.index', 'label' => 'Fakultas', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
    ['route' => 'admin.prodi.index', 'label' => 'Program Studi', 'icon' => 'M12 14l9-5-9-5-9 5 9 5z,M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'],
    ['route' => 'admin.semester.index', 'label' => 'Semester', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
    ['route' => 'admin.tahun-akademik.index', 'label' => 'Tahun Akademik', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
    ['divider' => 'Akademik'],
    ['route' => 'admin.kelas.index', 'label' => 'Kelas', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
    ['route' => 'admin.mata-kuliah.index', 'label' => 'Mata Kuliah', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
    ['route' => 'admin.dosen.index', 'label' => 'Dosen', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
    ['route' => 'admin.mahasiswa.index', 'label' => 'Mahasiswa', 'icon' => 'M12 14l9-5-9-5-9 5 9 5z'],
    ['divider' => 'Pengaturan'],
    ['route' => 'admin.teaching-assignment.index', 'label' => 'Penugasan Dosen', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
    ['route' => 'admin.jadwal.index', 'label' => 'Jadwal Kuliah', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
    ['divider' => 'Laporan'],
    ['route' => 'admin.report.index', 'label' => 'Laporan Absensi', 'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
];
@endphp
@extends('layouts.app')

@section('content')
<div class="drawer lg:drawer-open min-h-screen">
    <input id="nav-drawer" type="checkbox" class="drawer-toggle" />

    {{-- Sidebar --}}
    <div class="drawer-side z-40">
        <label for="nav-drawer" class="drawer-overlay"></label>
        <aside class="min-h-full w-64 bg-neutral text-neutral-content flex flex-col">
            <div class="p-5 border-b border-neutral-content/10">
                <h2 class="text-lg font-bold tracking-tight"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block -mt-0.5 mr-1.5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>RTP<span class="text-primary">.</span></h2>
                <p class="text-xs text-neutral-content/50 mt-0.5">Admin Panel</p>
            </div>
            <nav class="flex-1 p-3 space-y-0.5 overflow-y-auto scrollbar-thin">
                @foreach ($navItems as $item)
                    @isset($item['divider'])
                        <div class="px-3 pt-4 pb-1 text-[10px] font-semibold uppercase tracking-widest text-neutral-content/30">{{ $item['divider'] }}</div>
                    @else
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
                           @if (request()->routeIs(str_replace('.index', '.*', $item['route'])) || request()->routeIs($item['route']))
                               bg-primary text-primary-content
                           @else
                               text-neutral-content/70 hover:bg-neutral-content/10
                           @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/></svg>
                            {{ $item['label'] }}
                        </a>
                    @endisset
                @endforeach
            </nav>
            <div class="p-3 border-t border-neutral-content/10">
                <div class="flex items-center gap-3 px-3 py-2">
                    <div class="avatar avatar-placeholder">
                        <div class="bg-neutral-content/20 w-8 rounded-full"><span class="text-xs">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-neutral-content/40 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" x-data @submit.prevent="$store.confirm.ask($event, 'Yakin ingin keluar?', 'Keluar')">
                        @csrf
                        <button class="text-neutral-content/40 hover:text-error" title="Keluar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>
    </div>

    {{-- Main --}}
    <div class="drawer-content flex flex-col">
        <header class="lg:hidden sticky top-0 z-30 bg-base-100 border-b border-base-300 px-4 py-3 flex items-center gap-3">
            <label for="nav-drawer" class="btn btn-square btn-ghost btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </label>
            <span class="text-sm font-bold">RTP<span class="text-primary">.</span></span>
        </header>
        <main class="flex-1 p-6">
            @yield('content-body')
        </main>
    </div>
</div>
@endsection
