<?php

use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

beforeEach(fn () => $this->seed());

// --- Login — valid ---
test('admin dapat login', function () {
    $this->post('/login', ['email' => 'admin', 'password' => 'admin123'])
        ->assertRedirect('/admin/dashboard');
});

test('dosen dapat login', function () {
    $this->post('/login', ['email' => 'dosen', 'password' => 'dosen123'])
        ->assertRedirect('/dosen/dashboard');
});

test('mahasiswa dapat login', function () {
    $this->post('/login', ['email' => 'mahasiswa', 'password' => 'mahasiswa123'])
        ->assertRedirect('/mahasiswa/dashboard');
});

// --- Login — invalid ---
test('password salah', function () {
    $this->post('/login', ['email' => 'admin', 'password' => 'wrong'])
        ->assertSessionHasErrors();
});

test('user tidak dikenal', function () {
    $this->post('/login', ['email' => 'nonexistent', 'password' => 'test'])
        ->assertSessionHasErrors();
});

// --- Logout ---
test('logout menghapus session', function () {
    $this->actingAs(User::where('email', 'admin')->first())
        ->post('/logout')
        ->assertRedirect('/login');
});

// --- Access control ---
test('guest redirect ke login saat akses dashboard', function () {
    $this->get('/admin/dashboard')->assertRedirect('/login');
    $this->get('/dosen/dashboard')->assertRedirect('/login');
    $this->get('/mahasiswa/dashboard')->assertRedirect('/login');
});

// --- Throttle (5 gagal berturut-turut) ---
test('login throttle — 5 gagal diblokir', function () {
    RateLimiter::clear('login:'.request()->ip());

    for ($i = 0; $i < 5; $i++) {
        $this->post('/login', ['email' => 'admin', 'password' => 'wrong'])
            ->assertSessionHasErrors();
    }

    // Attempt ke-6 harus kena throttle (429)
    $this->post('/login', ['email' => 'admin', 'password' => 'admin123'])
        ->assertStatus(429);
});
