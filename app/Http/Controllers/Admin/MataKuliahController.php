<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\ProgramStudi;
use App\Models\Semester;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MataKuliahController extends Controller
{
    public function index(): View
    {
        $items = MataKuliah::with(['semester', 'programStudi'])->orderBy('kode')->get();

        return view('admin.mata-kuliah.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.mata-kuliah.form', [
            'semesters' => Semester::orderBy('kode')->get(),
            'prodi' => ProgramStudi::orderBy('kode')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'kode' => 'required|string|max:15|unique:mata_kuliah,kode',
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:8',
            'semester_id' => 'nullable|exists:semesters,id',
            'program_studi_id' => 'nullable|exists:program_studi,id',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = ($data['is_active'] ?? false);

        MataKuliah::create($data);

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah ditambahkan.');
    }

    public function edit(MataKuliah $mataKuliah): View
    {
        return view('admin.mata-kuliah.form', [
            'item' => $mataKuliah,
            'semesters' => Semester::orderBy('kode')->get(),
            'prodi' => ProgramStudi::orderBy('kode')->get(),
        ]);
    }

    public function update(Request $request, MataKuliah $mataKuliah): RedirectResponse
    {
        $data = $request->validate([
            'kode' => 'required|string|max:15|unique:mata_kuliah,kode,'.$mataKuliah->id,
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:8',
            'semester_id' => 'nullable|exists:semesters,id',
            'program_studi_id' => 'nullable|exists:program_studi,id',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = ($data['is_active'] ?? false);

        $mataKuliah->update($data);

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah): RedirectResponse
    {
        $mataKuliah->delete();

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah dihapus.');
    }
}
