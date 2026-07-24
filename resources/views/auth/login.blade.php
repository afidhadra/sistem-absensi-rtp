@extends('layouts.app')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-base-200 to-base-300 px-4">
    <div class="w-full max-w-md">
        <div class="mb-6 text-center">
            <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-2xl bg-primary text-primary-content shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-base-content">Sistem Absensi RTP</h1>
            <p class="mt-1 text-sm text-base-content/60">Real-Time Password Attendance</p>
        </div>

        @if ($errors->any())
            <div role="alert" class="mb-4 alert alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <fieldset class="fieldset">
                        <label class="floating-label">
                            <span>Email</span>
                            <input type="email" name="email" value="{{ old('email') }}" class="input input-bordered w-full validator" placeholder="nama@email.com" required autofocus />
                            <div class="validator-hint">Masukkan email yang valid</div>
                        </label>

                        <label class="floating-label mt-2">
                            <span>Password</span>
                            <input type="password" name="password" class="input input-bordered w-full" placeholder="••••••" required />
                        </label>

                        <label class="label mt-2 justify-start gap-2">
                            <input type="checkbox" name="remember" class="checkbox checkbox-sm checkbox-primary" />
                            <span class="label-text">Ingat saya</span>
                        </label>
                    </fieldset>

                    <button type="submit" class="btn btn-primary w-full mt-4">Masuk</button>
                </form>
            </div>
        </div>

        <div class="mt-4 collapse collapse-arrow bg-base-100/50">
            <input type="checkbox" />
            <div class="collapse-title text-xs font-medium text-base-content/60">Akun Demo</div>
            <div class="collapse-content text-xs text-base-content/50">
                <div class="font-mono space-y-1">
                    <div>Admin — admin@rtp.test / password</div>
                    <div>Dosen — dosen@rtp.test / password</div>
                    <div>Mahasiswa — mhs@rtp.test / password</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
