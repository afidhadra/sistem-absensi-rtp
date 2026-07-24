<?php

use App\Models\Otp;
use App\Models\TeachingAssignment;
use App\Models\User;

beforeEach(fn () => $this->seed());

$mhs = fn () => User::where('email', 'mahasiswa')->first();

test('mahasiswa lihat dashboard', function () use ($mhs) {
    $this->actingAs($mhs())->get('/mahasiswa/dashboard')->assertOk();
});

test('mahasiswa lihat riwayat absensi', function () use ($mhs) {
    $this->actingAs($mhs())->get('/mahasiswa/riwayat')->assertOk();
});

test('mahasiswa absen dengan OTP valid', function () use ($mhs) {
    $dosen = User::where('email', 'dosen')->first();
    $ta = TeachingAssignment::where('dosen_id', $dosen->dosen->id)->first();

    $otp = Otp::create([
        'teaching_assignment_id' => $ta->id,
        'kode' => '123456',
        'created_by' => $dosen->id,
        'expires_at' => now()->addMinutes(5),
    ]);

    $this->actingAs($mhs())
        ->from('/mahasiswa/dashboard')
        ->post('/mahasiswa/absensi', [
            'teaching_assignment_id' => $ta->id,
            'kode' => '123456',
        ])->assertRedirect('/mahasiswa/dashboard');

    $this->assertDatabaseHas('attendances', [
        'mahasiswa_id' => $mhs()->mahasiswa->id,
        'teaching_assignment_id' => $ta->id,
        'otp_id' => $otp->id,
    ]);

    $this->assertDatabaseHas('otps', [
        'id' => $otp->id,
        'is_used' => true,
    ]);
});

test('mahasiswa absen dengan OTP salah ditolak', function () use ($mhs) {
    $dosen = User::where('email', 'dosen')->first();
    $ta = TeachingAssignment::where('dosen_id', $dosen->dosen->id)->first();

    Otp::create([
        'teaching_assignment_id' => $ta->id,
        'kode' => '123456',
        'created_by' => $dosen->id,
        'expires_at' => now()->addMinutes(5),
    ]);

    $this->actingAs($mhs())
        ->from('/mahasiswa/dashboard')
        ->post('/mahasiswa/absensi', [
            'teaching_assignment_id' => $ta->id,
            'kode' => '000000', // valid format (6 digit), wrong value
        ])->assertRedirect('/mahasiswa/dashboard');

    $this->assertDatabaseMissing('attendances', [
        'mahasiswa_id' => $mhs()->mahasiswa->id,
        'teaching_assignment_id' => $ta->id,
    ]);
});

test('mahasiswa absen dengan OTP expired ditolak', function () use ($mhs) {
    $dosen = User::where('email', 'dosen')->first();
    $ta = TeachingAssignment::where('dosen_id', $dosen->dosen->id)->first();

    Otp::create([
        'teaching_assignment_id' => $ta->id,
        'kode' => '123456',
        'created_by' => $dosen->id,
        'expires_at' => now()->subMinutes(10),
    ]);

    $this->actingAs($mhs())
        ->from('/mahasiswa/dashboard')
        ->post('/mahasiswa/absensi', [
            'teaching_assignment_id' => $ta->id,
            'kode' => '123456',
        ])->assertRedirect('/mahasiswa/dashboard');

    $this->assertDatabaseMissing('attendances', [
        'mahasiswa_id' => $mhs()->mahasiswa->id,
        'teaching_assignment_id' => $ta->id,
    ]);
});
