<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\DosenController as AdminDosenController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswaController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\TahunAkademikController;
use App\Http\Controllers\Admin\TeachingAssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', fn () => redirect()->route('login'));
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])
        ->middleware('role:admin')->name('admin.dashboard');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('fakultas', FakultasController::class)->except(['show']);
        Route::resource('prodi', ProgramStudiController::class)->parameters(['prodi' => 'prodi'])->except(['show']);
        Route::resource('semester', SemesterController::class)->except(['show']);
        Route::resource('tahun-akademik', TahunAkademikController::class)->except(['show']);
        Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kela'])->except(['show']);
        Route::resource('mata-kuliah', MataKuliahController::class)->parameters(['mata-kuliah' => 'mata_kuliah'])->except(['show']);
        Route::resource('dosen', AdminDosenController::class)->except(['show']);
        Route::resource('mahasiswa', AdminMahasiswaController::class)->except(['show']);
        Route::resource('teaching-assignment', TeachingAssignmentController::class)->parameters(['teaching-assignment' => 'teaching_assignment'])->except(['show']);
        Route::resource('jadwal', JadwalController::class)->except(['show']);
        Route::get('/report', [ReportController::class, 'index'])->name('report.index');
        Route::get('/report/csv', [ReportController::class, 'csv'])->name('report.csv');
    });

    Route::middleware('role:dosen')->prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');
        Route::post('/otp/generate', [DosenController::class, 'generateOtp'])->name('otp-generate');
        Route::get('/otp/history', [DosenController::class, 'otpHistory'])->name('otp-history');
        Route::get('/attendance/{teachingAssignment}', [DosenController::class, 'attendance'])->name('attendance');
    });

    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])
        ->middleware('role:mahasiswa')->name('mahasiswa.dashboard');
    Route::post('/mahasiswa/absensi', [MahasiswaController::class, 'absensi'])
        ->middleware('role:mahasiswa')->name('mahasiswa.absensi');
    Route::get('/mahasiswa/riwayat', [MahasiswaController::class, 'riwayat'])
        ->middleware('role:mahasiswa')->name('mahasiswa.riwayat');
});
