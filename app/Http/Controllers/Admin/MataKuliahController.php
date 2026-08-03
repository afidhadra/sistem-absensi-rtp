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
        $items = MataKuliah::with(['semester', 'programStudi'])->orderBy('kode')->paginate(20);

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
        $request->merge(['is_active' => $request->boolean('is_active')]);

        $data = $request->validate([
            'kode' => 'required|string|max:15|unique:mata_kuliah,kode',
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:8',
            'semester_id' => 'nullable|exists:semesters,id',
            'program_studi_id' => 'nullable|exists:program_studi,id',
            'is_active' => 'boolean',
        ]);

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
        $request->merge(['is_active' => $request->boolean('is_active')]);

        $data = $request->validate([
            'kode' => 'required|string|max:15|unique:mata_kuliah,kode,'.$mataKuliah->id,
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:8',
            'semester_id' => 'nullable|exists:semesters,id',
            'program_studi_id' => 'nullable|exists:program_studi,id',
            'is_active' => 'boolean',
        ]);

        $mataKuliah->update($data);

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah): RedirectResponse
    {
        $mataKuliah->delete();

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah dihapus.');
    }
}
