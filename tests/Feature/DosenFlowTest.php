<?php

use App\Models\TeachingAssignment;
use App\Models\User;

beforeEach(fn () => $this->seed());

$dosen = fn () => User::where('email', 'dosen')->first();

test('dosen lihat dashboard', function () use ($dosen) {
    $this->actingAs($dosen())->get('/dosen/dashboard')->assertOk();
});

test('dosen lihat riwayat OTP', function () use ($dosen) {
    $this->actingAs($dosen())->get('/dosen/otp/history')->assertOk();
});

test('dosen generate OTP untuk matkulnya', function () use ($dosen) {
    $ta = TeachingAssignment::where('dosen_id', $dosen()->dosen->id)->first();
    $this->assertNotNull($ta, 'Seharusnya ada teaching assignment untuk dosen');

    $this->actingAs($dosen())
        ->from('/dosen/dashboard')
        ->post('/dosen/otp/generate', [
            'teaching_assignment_id' => $ta->id,
        ])->assertRedirect('/dosen/dashboard');

    $this->assertDatabaseHas('otps', [
        'teaching_assignment_id' => $ta->id,
        'created_by' => $dosen()->id,
        'is_used' => false,
    ]);
});

test('dosen lihat absensi matkulnya', function () use ($dosen) {
    $ta = TeachingAssignment::where('dosen_id', $dosen()->dosen->id)->first();
    $this->assertNotNull($ta);

    $this->actingAs($dosen())->get("/dosen/attendance/{$ta->id}")->assertOk();
});
