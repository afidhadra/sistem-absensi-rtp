<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgramStudiController extends Controller
{
    public function index(): View
    {
        $items = ProgramStudi::with('fakultas')->orderBy('kode')->get();

        return view('admin.prodi.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.prodi.form', ['fakultas' => Fakultas::orderBy('kode')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'kode' => 'required|string|max:10|unique:program_studi,kode',
            'nama' => 'required|string|max:255',
        ]);
        ProgramStudi::create($data);

        return redirect()->route('admin.prodi.index')->with('success', 'Program Studi ditambahkan.');
    }

    public function edit(ProgramStudi $prodi): View
    {
        return view('admin.prodi.form', ['item' => $prodi, 'fakultas' => Fakultas::orderBy('kode')->get()]);
    }

    public function update(Request $request, ProgramStudi $prodi): RedirectResponse
    {
        $data = $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'kode' => 'required|string|max:10|unique:program_studi,kode,'.$prodi->id,
            'nama' => 'required|string|max:255',
        ]);
        $prodi->update($data);

        return redirect()->route('admin.prodi.index')->with('success', 'Program Studi diperbarui.');
    }

    public function destroy(ProgramStudi $prodi): RedirectResponse
    {
        $prodi->delete();

        return redirect()->route('admin.prodi.index')->with('success', 'Program Studi dihapus.');
    }
}
