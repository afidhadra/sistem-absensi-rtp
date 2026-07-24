<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\TeachingAssignment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JadwalController extends Controller
{
    public function index(): View
    {
        $items = Jadwal::with('teachingAssignment.dosen', 'teachingAssignment.mataKuliah', 'teachingAssignment.kelas')
            ->orderByRaw("FIELD(hari,'senin','selasa','rabu','kamis','jumat','sabtu')")
            ->orderBy('jam_mulai')
            ->get();

        return view('admin.jadwal.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.jadwal.form', ['ta' => TeachingAssignment::with(['dosen', 'mataKuliah', 'kelas'])->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'teaching_assignment_id' => 'required|exists:teaching_assignments,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ruangan' => 'nullable|string|max:50',
        ]);
        Jadwal::create($data);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal ditambahkan.');
    }

    public function edit(Jadwal $jadwal): View
    {
        return view('admin.jadwal.form', ['item' => $jadwal, 'ta' => TeachingAssignment::with(['dosen', 'mataKuliah', 'kelas'])->get()]);
    }

    public function update(Request $request, Jadwal $jadwal): RedirectResponse
    {
        $data = $request->validate([
            'teaching_assignment_id' => 'required|exists:teaching_assignments,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ruangan' => 'nullable|string|max:50',
        ]);
        $jadwal->update($data);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal diperbarui.');
    }

    public function destroy(Jadwal $jadwal): RedirectResponse
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal dihapus.');
    }
}
