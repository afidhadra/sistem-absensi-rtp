<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Jadwal;
use App\Models\Otp;
use App\Models\TeachingAssignment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function dashboard(): View
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $kelasId = $mahasiswa->kelas_id;

        $taIds = TeachingAssignment::where('kelas_id', $kelasId)->pluck('id');

        $todaySchedule = Jadwal::with([
            'teachingAssignment.mataKuliah', 'teachingAssignment.dosen',
        ])->whereIn('teaching_assignment_id', $taIds)
            ->where('hari', strtolower(now()->locale('id')->dayName))
            ->orderBy('jam_mulai')
            ->get();

        $riwayat = Attendance::with('teachingAssignment.mataKuliah', 'teachingAssignment.dosen')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->orderByDesc('attended_at')
            ->get();

        $attendedTaIds = $riwayat->pluck('teaching_assignment_id')->toArray();

        $tids = $todaySchedule->pluck('teaching_assignment_id');
        $activeOtpsByTa = Otp::whereIn('teaching_assignment_id', $tids)
            ->where('expires_at', '>', now())
            ->where('is_used', false)
            ->get()
            ->groupBy('teaching_assignment_id');

        $totalSessions = TeachingAssignment::where('kelas_id', $kelasId)->count();
        $hadirCount = $riwayat->pluck('teaching_assignment_id')->unique()->count();
        $persentase = $totalSessions > 0 ? round(($hadirCount / $totalSessions) * 100) : 0;

        return view('mahasiswa.dashboard', compact(
            'mahasiswa', 'todaySchedule', 'riwayat', 'attendedTaIds', 'activeOtpsByTa', 'persentase'
        ));
    }

    public function absensi(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'kode' => 'required|string|size:6',
            'teaching_assignment_id' => 'required|exists:teaching_assignments,id',
        ]);

        $mahasiswa = auth()->user()->mahasiswa;

        $otp = Otp::where('kode', $data['kode'])
            ->where('teaching_assignment_id', $data['teaching_assignment_id'])
            ->first();

        if (! $otp) {
            return back()->with('error', 'Kode OTP tidak valid.');
        }
        if ($otp->isExpired()) {
            return back()->with('error', 'Kode OTP sudah kedaluwarsa.');
        }
        if ($otp->is_used) {
            return back()->with('error', 'Kode OTP sudah digunakan.');
        }

        $ta = $otp->teachingAssignment;
        if ($ta->kelas_id !== $mahasiswa->kelas_id) {
            return back()->with('error', 'Anda tidak terdaftar di kelas ini.');
        }

        $exists = Attendance::where('mahasiswa_id', $mahasiswa->id)
            ->where('teaching_assignment_id', $data['teaching_assignment_id'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah absen sebelumnya.');
        }

        Attendance::create([
            'mahasiswa_id' => $mahasiswa->id,
            'otp_id' => $otp->id,
            'teaching_assignment_id' => $ta->id,
            'attended_at' => now(),
        ]);

        $otp->update(['is_used' => true]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Absensi berhasil!');
    }

    public function riwayat(): View
    {
        return view('mahasiswa.riwayat', [
            'riwayat' => Attendance::with('teachingAssignment.mataKuliah', 'teachingAssignment.dosen')
                ->where('mahasiswa_id', auth()->user()->mahasiswa->id)
                ->orderByDesc('attended_at')
                ->paginate(20),
        ]);
    }
}
