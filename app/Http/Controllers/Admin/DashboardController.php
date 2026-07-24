<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = strtolower(now()->locale('id')->dayName);
        $jadwalHariIni = Jadwal::with(['teachingAssignment.mataKuliah', 'teachingAssignment.kelas'])
            ->where('hari', $today)
            ->get();

        $todayAttendances = [];
        foreach ($jadwalHariIni as $j) {
            $ta = $j->teachingAssignment;
            $total = $ta->kelas->mahasiswa->count();
            $hadir = Attendance::where('teaching_assignment_id', $ta->id)
                ->whereDate('attended_at', today())
                ->count();
            if ($total > 0) {
                $todayAttendances[] = [
                    'matkul' => $ta->mataKuliah->nama,
                    'kelas' => $ta->kelas->kode,
                    'hadir' => $hadir,
                    'total' => $total,
                    'pct' => round(($hadir / $total) * 100),
                ];
            }
        }

        return view('admin.dashboard', [
            'stats' => [
                'mahasiswa' => Mahasiswa::count(),
                'dosen' => Dosen::count(),
                'mata_kuliah' => MataKuliah::count(),
                'kelas' => Kelas::count(),
            ],
            'todayAttendances' => $todayAttendances,
        ]);
    }
}
