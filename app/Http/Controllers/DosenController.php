<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Otp;
use App\Models\TeachingAssignment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DosenController extends Controller
{
    public function dashboard(): View
    {
        $dosenId = auth()->user()->dosen->id;

        $activeOtps = Otp::with('teachingAssignment.mataKuliah')
            ->where('created_by', auth()->id())
            ->where('is_used', false)
            ->where('expires_at', '>', now())
            ->paginate(20);

        $matkulList = TeachingAssignment::with(['mataKuliah', 'kelas.mahasiswa', 'jadwal', 'otps'])
            ->withCount(['attendances as hadir_count' => fn ($q) => $q])
            ->where('dosen_id', $dosenId)
            ->paginate(20);

        return view('dosen.dashboard', compact('matkulList', 'activeOtps'));
    }

    public function generateOtp(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'teaching_assignment_id' => 'required|exists:teaching_assignments,id',
        ]);

        $ta = TeachingAssignment::findOrFail($data['teaching_assignment_id']);
        $dosenId = auth()->user()->dosen->id;

        if ($ta->dosen_id !== $dosenId) {
            abort(403, 'Bukan mata kuliah Anda.');
        }

        $kode = (string) random_int(100000, 999999);

        Otp::create([
            'teaching_assignment_id' => $ta->id,
            'kode' => $kode,
            'expires_at' => now()->addMinutes(5),
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('dosen.dashboard')
            ->with('success', "OTP: {$kode} (berlaku 5 menit)");
    }

    public function attendance(TeachingAssignment $teachingAssignment): View
    {
        $dosenId = auth()->user()->dosen->id;

        if ($teachingAssignment->dosen_id !== $dosenId) {
            abort(403);
        }

        $teachingAssignment->load(['mataKuliah', 'kelas.mahasiswa', 'semester', 'tahunAkademik']);

        $attendances = Attendance::with('mahasiswa')
            ->where('teaching_assignment_id', $teachingAssignment->id)
            ->orderByDesc('created_at')
            ->get();

        return view('dosen.attendance', compact('teachingAssignment', 'attendances'));
    }

    public function otpHistory(): View
    {
        $otps = Otp::with('teachingAssignment.mataKuliah')
            ->where('created_by', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('dosen.otp-history', compact('otps'));
    }
}
