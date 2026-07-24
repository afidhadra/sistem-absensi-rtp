@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
    {{-- Left: ambient side --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-neutral-900">
        <div class="absolute inset-0 bg-gradient-to-br from-neutral-900 via-neutral-800 to-neutral-950"></div>
        <div class="absolute -top-24 -left-24 h-96 w-96 rounded-full bg-primary/10 blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-accent/10 blur-3xl"></div>
        <div class="relative z-10 flex flex-col justify-between p-12 text-neutral-100">
            <h1 class="text-3xl font-bold tracking-tight">RTP<span class="text-primary">.</span></h1>
            <div>
                <p class="text-xl font-semibold leading-snug">Absensi bukan cuma hadir.<br>Tapi hadir tepat waktu.</p>
                <p class="mt-2 text-sm text-neutral-400">OTP dibuat dosen, kamu input,<br>5 menit doang. Titip absen? Bye.</p>
            </div>
            <p class="text-xs text-neutral-500">&copy; {{ date('Y') }} Sistem Absensi RTP</p>
        </div>
    </div>

    {{-- Right: form side --}}
    <div class="flex w-full lg:w-1/2 items-center justify-center p-6 bg-base-200">
        <div class="w-full max-w-sm">
            <div class="lg:hidden mb-8 text-center">
                <h1 class="text-xl font-bold tracking-tight">RTP<span class="text-primary">.</span></h1>
            </div>

            @if ($errors->any())
                <div role="alert" class="mb-4 alert alert-error text-sm py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <h2 class="text-lg font-semibold text-base-content">Masuk</h2>
            <p class="mb-6 text-sm text-base-content/50">Selamat datang kembali.</p>

            <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="mb-1 block text-xs font-medium text-base-content/70">Username</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}"
                        class="input input-bordered w-full" placeholder="admin" required autofocus>
                </div>
                <div>
                    <label for="password" class="mb-1 block text-xs font-medium text-base-content/70">Password</label>
                    <input type="password" id="password" name="password"
                        class="input input-bordered w-full" placeholder="••••••" required>
                </div>
                <label class="flex items-center gap-2 text-xs text-base-content/60">
                    <input type="checkbox" name="remember" class="checkbox checkbox-xs">
                    Ingat saya
                </label>
                <button type="submit" class="btn btn-primary w-full">Masuk</button>
            </form>
        </div>
    </div>
</div>
@endsection
