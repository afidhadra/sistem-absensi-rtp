<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest redirect ke login', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('login'));
});

test('login page accessible', function () {
    $response = $this->get(route('login'));

    $response->assertStatus(200);
});

test('admin login redirect ke dashboard admin', function () {
    User::factory()->create([
        'email' => 'admin@rtp.test',
        'role' => 'admin',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post(route('login.store'), [
        'email' => 'admin@rtp.test',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('admin.dashboard'));
});

test('dosen login redirect ke dashboard dosen', function () {
    User::factory()->create([
        'email' => 'dosen@rtp.test',
        'role' => 'dosen',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post(route('login.store'), [
        'email' => 'dosen@rtp.test',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('dosen.dashboard'));
});

test('mahasiswa login redirect ke dashboard mahasiswa', function () {
    User::factory()->create([
        'email' => 'mhs@rtp.test',
        'role' => 'mahasiswa',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post(route('login.store'), [
        'email' => 'mhs@rtp.test',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('mahasiswa.dashboard'));
});

test('wrong password ditolak', function () {
    User::factory()->create([
        'email' => 'admin@rtp.test',
        'role' => 'admin',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post(route('login.store'), [
        'email' => 'admin@rtp.test',
        'password' => 'salah',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('admin dashboard block untuk mahasiswa', function () {
    $user = User::factory()->create([
        'email' => 'mhs@rtp.test',
        'role' => 'mahasiswa',
        'password' => bcrypt('password'),
    ]);

    $this->actingAs($user);

    $response = $this->get(route('admin.dashboard'));

    $response->assertStatus(403);
});
