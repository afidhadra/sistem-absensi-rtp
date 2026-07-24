<?php

use App\Models\User;

beforeEach(fn () => $this->seed());

$admin = fn () => User::where('email', 'admin')->first();
$dosen = fn () => User::where('email', 'dosen')->first();
$mhs = fn () => User::where('email', 'mahasiswa')->first();

// --- Admin routes — only admin ---
test('admin bisa akses admin dashboard', function () use ($admin) {
    $this->actingAs($admin())->get('/admin/dashboard')->assertOk();
});

test('dosen tidak bisa akses admin', function () use ($dosen) {
    $this->actingAs($dosen())->get('/admin/dashboard')->assertStatus(403);
});

test('mahasiswa tidak bisa akses admin', function () use ($mhs) {
    $this->actingAs($mhs())->get('/admin/dashboard')->assertStatus(403);
});

// --- Dosen routes — only dosen ---
test('dosen bisa akses dosen dashboard', function () use ($dosen) {
    $this->actingAs($dosen())->get('/dosen/dashboard')->assertOk();
});

test('admin tidak bisa akses dosen', function () use ($admin) {
    $this->actingAs($admin())->get('/dosen/dashboard')->assertStatus(403);
});

test('mahasiswa tidak bisa akses dosen', function () use ($mhs) {
    $this->actingAs($mhs())->get('/dosen/dashboard')->assertStatus(403);
});

// --- Mahasiswa routes — only mahasiswa ---
test('mahasiswa bisa akses dashboard', function () use ($mhs) {
    $this->actingAs($mhs())->get('/mahasiswa/dashboard')->assertOk();
});

test('admin tidak bisa akses mahasiswa', function () use ($admin) {
    $this->actingAs($admin())->get('/mahasiswa/dashboard')->assertStatus(403);
});

test('dosen tidak bisa akses mahasiswa', function () use ($dosen) {
    $this->actingAs($dosen())->get('/mahasiswa/dashboard')->assertStatus(403);
});
