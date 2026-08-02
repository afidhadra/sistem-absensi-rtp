@extends('layouts.app')

@php
$navItems = [
    ['route' => 'mahasiswa.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
    ['route' => 'mahasiswa.riwayat', 'label' => 'Riwayat', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
];
@endphp

@section('content')
<div class="drawer lg:drawer-open min-h-screen">
    <input id="nav-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-side z-40">
        <label for="nav-drawer" class="drawer-overlay"></label>
        <aside class="min-h-full w-64 bg-neutral text-neutral-content flex flex-col">
            <div class="p-5 border-b border-neutral-content/10">
                <h2 class="text-lg font-bold tracking-tight"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block -mt-0.5 mr-1.5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>RTP<span class="text-primary">.</span></h2>
                <p class="text-xs text-neutral-content/50 mt-0.5">Mahasiswa Panel</p>
            </div>
            <nav class="flex-1 p-3 space-y-0.5">
                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
                       @if (request()->routeIs(str_replace('.dashboard', '.*', $item['route'])) || request()->routeIs($item['route']))
                           bg-primary text-primary-content
                       @else
                           text-neutral-content/70 hover:bg-neutral-content/10
                       @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/></svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
            <div class="p-3 border-t border-neutral-content/10">
                <div class="flex items-center gap-3 px-3 py-2">
                    <div class="avatar avatar-placeholder">
                        <div class="bg-neutral-content/20 w-8 rounded-full"><span class="text-xs">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-neutral-content/40">{{ auth()->user()->mahasiswa?->npm }}</p>
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
