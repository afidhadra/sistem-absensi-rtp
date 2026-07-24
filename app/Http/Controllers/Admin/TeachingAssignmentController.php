<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\Semester;
use App\Models\TahunAkademik;
use App\Models\TeachingAssignment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeachingAssignmentController extends Controller
{
    public function index(): View
    {
        $items = TeachingAssignment::with(['dosen', 'mataKuliah', 'kelas', 'semester', 'tahunAkademik'])->paginate(20);

        return view('admin.teaching-assignment.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.teaching-assignment.form', $this->dropdowns());
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'kelas_id' => 'required|exists:kelas,id',
            'semester_id' => 'required|exists:semesters,id',
            'tahun_akademik_id' => 'required|exists:tahun_akademik,id',
        ]);

        TeachingAssignment::create($data);

        return redirect()->route('admin.teaching-assignment.index')->with('success', 'Penugasan ditambahkan.');
    }

    public function edit(TeachingAssignment $teachingAssignment): View
    {
        return view('admin.teaching-assignment.form', array_merge(['item' => $teachingAssignment], $this->dropdowns()));
    }

    public function update(Request $request, TeachingAssignment $teachingAssignment): RedirectResponse
    {
        $data = $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'kelas_id' => 'required|exists:kelas,id',
            'semester_id' => 'required|exists:semesters,id',
            'tahun_akademik_id' => 'required|exists:tahun_akademik,id',
        ]);

        $teachingAssignment->update($data);

        return redirect()->route('admin.teaching-assignment.index')->with('success', 'Penugasan diperbarui.');
    }

    public function destroy(TeachingAssignment $teachingAssignment): RedirectResponse
    {
        try {
            $teachingAssignment->delete();
        } catch (\Throwable) {
            return back()->with('error', 'Penugasan tidak bisa dihapus karena masih memiliki data terkait.');
        }

        return redirect()->route('admin.teaching-assignment.index')->with('success', 'Penugasan dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function dropdowns(): array
    {
        return [
            'dosen' => Dosen::orderBy('nama')->get(),
            'mataKuliah' => MataKuliah::orderBy('kode')->get(),
            'kelas' => Kelas::orderBy('kode')->get(),
            'semesters' => Semester::orderBy('kode')->get(),
            'tahunAkademik' => TahunAkademik::orderByDesc('kode')->get(),
        ];
    }
}
