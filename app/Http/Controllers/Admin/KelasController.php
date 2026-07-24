<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\ProgramStudi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KelasController extends Controller
{
    public function index(): View
    {
        $items = Kelas::with('programStudi')->orderBy('kode')->get();

        return view('admin.kelas.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.kelas.form', ['prodi' => ProgramStudi::orderBy('kode')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'kode' => 'required|string|max:20|unique:kelas,kode',
            'nama' => 'required|string|max:255',
            'program_studi_id' => 'nullable|exists:program_studi,id',
        ]);
        Kelas::create($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas ditambahkan.');
    }

    public function edit(Kelas $kela): View
    {
        return view('admin.kelas.form', ['item' => $kela, 'prodi' => ProgramStudi::orderBy('kode')->get()]);
    }

    public function update(Request $request, Kelas $kela): RedirectResponse
    {
        $data = $request->validate([
            'kode' => 'required|string|max:20|unique:kelas,kode,'.$kela->id,
            'nama' => 'required|string|max:255',
            'program_studi_id' => 'nullable|exists:program_studi,id',
        ]);
        $kela->update($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas diperbarui.');
    }

    public function destroy(Kelas $kela): RedirectResponse
    {
        $kela->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas dihapus.');
    }
}
