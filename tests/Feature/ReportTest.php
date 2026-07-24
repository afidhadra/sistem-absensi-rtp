<?php

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\User;

beforeEach(fn () => $this->seed());

$admin = fn () => User::where('email', 'admin')->first();

test('admin lihat laporan absensi', function () use ($admin) {
    $this->actingAs($admin())->get('/admin/report')->assertOk();
});

test('admin filter laporan by matkul', function () use ($admin) {
    $mk = MataKuliah::first();
    $this->actingAs($admin())
        ->get('/admin/report?mata_kuliah_id='.$mk->id)
        ->assertOk();
});

test('admin filter laporan by dosen', function () use ($admin) {
    $dosen = Dosen::first();
    $this->actingAs($admin())
        ->get('/admin/report?dosen_id='.$dosen->id)
        ->assertOk();
});

test('admin filter laporan by kelas', function () use ($admin) {
    $kelas = Kelas::first();
    $this->actingAs($admin())
        ->get('/admin/report?kelas_id='.$kelas->id)
        ->assertOk();
});

test('admin filter laporan by rentang tanggal', function () use ($admin) {
    $this->actingAs($admin())
        ->get('/admin/report?dari=2024-01-01&sampai=2024-12-31')
        ->assertOk();
});

test('admin download CSV', function () use ($admin) {
    $this->actingAs($admin())
        ->get('/admin/report/csv')
        ->assertOk();
});
