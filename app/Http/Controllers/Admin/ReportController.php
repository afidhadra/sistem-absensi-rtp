<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\Semester;
use App\Models\TahunAkademik;
use App\Models\TeachingAssignment;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $query = Attendance::with([
            'mahasiswa',
            'teachingAssignment.mataKuliah',
            'teachingAssignment.dosen',
            'teachingAssignment.kelas',
        ]);

        if ($mk = $request->input('mata_kuliah_id')) {
            $taIds = TeachingAssignment::where('mata_kuliah_id', $mk)->pluck('id');
            $query->whereIn('teaching_assignment_id', $taIds);
        }
        if ($d = $request->input('dosen_id')) {
            $taIds = TeachingAssignment::where('dosen_id', $d)->pluck('id');
            $query->whereIn('teaching_assignment_id', $taIds);
        }
        if ($k = $request->input('kelas_id')) {
            $taIds = TeachingAssignment::where('kelas_id', $k)->pluck('id');
            $query->whereIn('teaching_assignment_id', $taIds);
        }
        if ($s = $request->input('semester_id')) {
            $taIds = TeachingAssignment::where('semester_id', $s)->pluck('id');
            $query->whereIn('teaching_assignment_id', $taIds);
        }
        if ($ta = $request->input('tahun_akademik_id')) {
            $taIds = TeachingAssignment::where('tahun_akademik_id', $ta)->pluck('id');
            $query->whereIn('teaching_assignment_id', $taIds);
        }
        if ($dari = $request->input('dari')) {
            $query->whereDate('attended_at', '>=', $dari);
        }
        if ($sampai = $request->input('sampai')) {
            $query->whereDate('attended_at', '<=', $sampai);
        }

        $attendances = $query->orderByDesc('attended_at')->paginate(20);

        return view('admin.report.index', [
            'attendances' => $attendances,
            'mataKuliah' => MataKuliah::orderBy('nama')->get(),
            'dosen' => Dosen::orderBy('nama')->get(),
            'kelas' => Kelas::orderBy('kode')->get(),
            'semesters' => Semester::orderBy('kode')->get(),
            'tahunAkademik' => TahunAkademik::orderByDesc('kode')->get(),
        ]);
    }

    public function csv(Request $request): StreamedResponse
    {
        $data = $this->fetch($request);

        $callback = function () use ($data) {
            $fh = fopen('php://output', 'w');
            fputcsv($fh, ['NIM', 'Mahasiswa', 'Matkul', 'Dosen', 'Kelas', 'Tanggal', 'Jam']);
            foreach ($data as $a) {
                fputcsv($fh, [
                    $a->mahasiswa->nim,
                    $a->mahasiswa->nama,
                    $a->teachingAssignment->mataKuliah->nama,
                    $a->teachingAssignment->dosen->nama,
                    $a->teachingAssignment->kelas->kode,
                    $a->attended_at->format('d/m/Y'),
                    $a->attended_at->format('H:i'),
                ]);
            }
            fclose($fh);
        };

        return response()->streamDownload($callback, 'laporan-absensi-'.now()->format('Ymd').'.csv');
    }

    private function fetch(Request $request)
    {
        $q = Attendance::with([
            'mahasiswa',
            'teachingAssignment.mataKuliah',
            'teachingAssignment.dosen',
            'teachingAssignment.kelas',
        ]);

        foreach (['mata_kuliah_id', 'dosen_id', 'kelas_id', 'semester_id', 'tahun_akademik_id'] as $f) {
            if ($v = $request->input($f)) {
                $ids = TeachingAssignment::where(str_replace('_id', '', $f).'_id', $v)->pluck('id');
                $q->whereIn('teaching_assignment_id', $ids);
            }
        }
        if ($dari = $request->input('dari')) {
            $q->whereDate('attended_at', '>=', $dari);
        }
        if ($sampai = $request->input('sampai')) {
            $q->whereDate('attended_at', '<=', $sampai);
        }

        return $q->orderByDesc('attended_at')->get();
    }
}
