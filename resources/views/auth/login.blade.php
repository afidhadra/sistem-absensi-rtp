@extends('layouts.app')

@section('content')
<div class="flex min-h-screen items-center justify-center">
    <div class="w-full max-w-md rounded-xl bg-white p-8 shadow-lg">
        <h1 class="mb-1 text-center text-2xl font-bold text-gray-800">Sistem Absensi RTP</h1>
        <p class="mb-6 text-center text-sm text-gray-500">Masuk untuk melanjutkan</p>

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 p-3 text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="mb-1 block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    required autofocus>
            </div>
            <div class="mb-4">
                <label for="password" class="mb-1 block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    required>
            </div>
            <div class="mb-6 flex items-center">
                <input type="checkbox" id="remember" name="remember" class="rounded border-gray-300">
                <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya</label>
            </div>
            <button type="submit"
                class="w-full rounded-lg bg-blue-600 px-4 py-2 font-medium text-white hover:bg-blue-700">
                Masuk
            </button>
        </form>

        <div class="mt-6 rounded-lg bg-gray-50 p-3 text-xs text-gray-500">
            <p class="font-medium">Akun Demo:</p>
            <p>Admin: admin@rtp.test / password</p>
            <p>Dosen: dosen@rtp.test / password</p>
            <p>Mahasiswa: mhs@rtp.test / password</p>
        </div>
    </div>
</div>
@endsection
