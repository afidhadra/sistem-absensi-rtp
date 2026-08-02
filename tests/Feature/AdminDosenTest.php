<?php

use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\User;

beforeEach(fn () => $this->seed());

$admin = fn () => User::where('email', 'admin')->first();

test('admin lihat daftar dosen', function () use ($admin) {
    $this->actingAs($admin())->get('/admin/dosen')->assertOk();
});

test('admin tambah dosen — creates user + dosen', function () use ($admin) {
    $fakultas = Fakultas::firstWhere('kode', 'FTI');

    $this->actingAs($admin())->post('/admin/dosen', [
        'nidn' => '199001012020011001',
        'nama' => 'Dr. Siti Rahayu',
        'email' => 'siti@test.com',
        'password' => 'password123',
        'fakultas_id' => $fakultas->id,
    ])->assertRedirect('/admin/dosen');

    $this->assertDatabaseHas('users', ['email' => 'siti@test.com']);
    $this->assertDatabaseHas('dosen', ['nidn' => '199001012020011001']);
});

test('admin tambah dosen — validasi duplicate email', function () use ($admin) {
    $fakultas = Fakultas::firstWhere('kode', 'FTI');
    // Buat user dulu
    $this->actingAs($admin())->post('/admin/dosen', [
        'nidn' => '199001012020011001',
        'nama' => 'Dr. Siti Rahayu',
        'email' => 'dosen',  // same as existing dosen
        'password' => 'password123',
        'fakultas_id' => $fakultas->id,
    ])->assertSessionHasErrors('email'); // unique violation
});

test('admin edit dosen', function () use ($admin) {
    $dosen = Dosen::firstWhere('nidn', '198501012010011001');
    $fakultas = Fakultas::firstWhere('kode', 'FTI');

    $this->actingAs($admin())->put("/admin/dosen/{$dosen->id}", [
        'nidn' => '198501012010011001',
        'nama' => 'Dr. Budi Santoso (updated)',
        'email' => 'dosen',
        'password' => 'dosen123',
        'fakultas_id' => $fakultas->id,
    ])->assertRedirect('/admin/dosen');

    $this->assertDatabaseHas('dosen', ['nama' => 'Dr. Budi Santoso (updated)']);
});

test('admin hapus dosen — cascade ke user', function () use ($admin) {
    $dosen = Dosen::firstWhere('nidn', '198501012010011001');
    $userId = $dosen->user_id;

    $this->actingAs($admin())->delete("/admin/dosen/{$dosen->id}")
        ->assertRedirect('/admin/dosen');

    $this->assertDatabaseMissing('dosen', ['id' => $dosen->id]);
    $this->assertDatabaseMissing('users', ['id' => $userId]);
});
