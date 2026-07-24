<?php

use App\Models\Fakultas;
use App\Models\User;

beforeEach(fn () => $this->seed());

$admin = fn () => User::where('email', 'admin')->first();

test('admin lihat daftar fakultas', function () use ($admin) {
    $this->actingAs($admin())->get('/admin/fakultas')->assertOk();
});

test('admin lihat form tambah fakultas', function () use ($admin) {
    $this->actingAs($admin())->get('/admin/fakultas/create')->assertOk();
});

test('admin tambah fakultas', function () use ($admin) {
    $this->actingAs($admin())->post('/admin/fakultas', [
        'kode' => 'FH',
        'nama' => 'Fakultas Hukum',
    ])->assertRedirect('/admin/fakultas');

    $this->assertDatabaseHas('fakultas', ['kode' => 'FH']);
});

test('admin tambah fakultas — validasi kode harus unique', function () use ($admin) {
    $this->actingAs($admin())->post('/admin/fakultas', [
        'kode' => 'FTI',
        'nama' => 'Duplikat',
    ])->assertSessionHasErrors('kode');
});

test('admin tambah fakultas — validasi kode/nama required', function () use ($admin) {
    $this->actingAs($admin())->post('/admin/fakultas', [
        'kode' => '',
        'nama' => '',
    ])->assertSessionHasErrors(['kode', 'nama']);
});

test('admin edit fakultas', function () use ($admin) {
    $fakultas = Fakultas::firstWhere('kode', 'FTI');

    $this->actingAs($admin())->get("/admin/fakultas/{$fakultas->id}/edit")->assertOk();

    $this->actingAs($admin())->put("/admin/fakultas/{$fakultas->id}", [
        'kode' => 'FTI',
        'nama' => 'Fakultas Teknik dan Informatika (updated)',
    ])->assertRedirect('/admin/fakultas');

    $this->assertDatabaseHas('fakultas', ['nama' => 'Fakultas Teknik dan Informatika (updated)']);
});

test('admin hapus fakultas', function () use ($admin) {
    $fakultas = Fakultas::where('kode', 'FTI')->first();

    $this->actingAs($admin())->delete("/admin/fakultas/{$fakultas->id}")
        ->assertRedirect('/admin/fakultas');

    $this->assertDatabaseMissing('fakultas', ['id' => $fakultas->id]);
});
