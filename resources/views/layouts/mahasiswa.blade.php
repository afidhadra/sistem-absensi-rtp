@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-4 border-b border-gray-700">
            <h2 class="font-bold text-sm">RTP Mahasiswa Panel</h2>
            <p class="text-xs text-gray-400 mt-1">{{ auth()->user()->name }}</p>
        </div>
        <nav class="flex-1 py-2">
            <a href="{{ route('mahasiswa.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-700 @if(request()->routeIs('mahasiswa.dashboard')) bg-gray-700 @endif">Dashboard</a>
            <a href="{{ route('mahasiswa.riwayat') }}" class="block px-4 py-2 text-sm hover:bg-gray-700 @if(request()->routeIs('mahasiswa.riwayat')) bg-gray-700 @endif">Riwayat</a>
        </nav>
        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="text-xs text-gray-400 hover:text-white">Keluar</button></form>
        </div>
    </aside>
    <main class="flex-1 p-6 overflow-y-auto">
        @yield('content-body')
    </main>
</div>
@endsection
