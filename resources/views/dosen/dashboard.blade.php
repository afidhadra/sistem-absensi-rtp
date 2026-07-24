@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Dosen</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300">Keluar</button>
        </form>
    </div>
    <div class="rounded-xl bg-white p-6 shadow">
        <p class="text-gray-600">Selamat datang, {{ auth()->user()->name }}</p>
        <p class="mt-2 text-sm text-gray-500">Modul dosen akan dikembangkan di Phase 2.</p>
    </div>
</div>
@endsection
