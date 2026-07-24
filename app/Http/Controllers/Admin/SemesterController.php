<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SemesterController extends Controller
{
    public function index(): View
    {
        return view('admin.semester.index', ['items' => Semester::orderBy('kode')->paginate(20)]);
    }

    public function create(): View
    {
        return view('admin.semester.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(['kode' => 'required|string|max:10|unique:semesters,kode', 'nama' => 'required|string|max:255']);
        Semester::create($data);

        return redirect()->route('admin.semester.index')->with('success', 'Semester ditambahkan.');
    }

    public function edit(Semester $semester): View
    {
        return view('admin.semester.form', ['item' => $semester]);
    }

    public function update(Request $request, Semester $semester): RedirectResponse
    {
        $data = $request->validate(['kode' => 'required|string|max:10|unique:semesters,kode,'.$semester->id, 'nama' => 'required|string|max:255']);
        $semester->update($data);

        return redirect()->route('admin.semester.index')->with('success', 'Semester diperbarui.');
    }

    public function destroy(Semester $semester): RedirectResponse
    {
        $semester->delete();

        return redirect()->route('admin.semester.index')->with('success', 'Semester dihapus.');
    }
}
