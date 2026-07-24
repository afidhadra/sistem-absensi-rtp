<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TahunAkademikController extends Controller
{
    public function index(): View
    {
        return view('admin.tahun-akademik.index', ['items' => TahunAkademik::orderByDesc('kode')->get()]);
    }

    public function create(): View
    {
        return view('admin.tahun-akademik.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'kode' => 'required|string|max:20|unique:tahun_akademik,kode',
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = ($data['is_active'] ?? false);

        TahunAkademik::create($data);

        return redirect()->route('admin.tahun-akademik.index')->with('success', 'Tahun Akademik ditambahkan.');
    }

    public function edit(TahunAkademik $tahunAkademik): View
    {
        return view('admin.tahun-akademik.form', ['item' => $tahunAkademik]);
    }

    public function update(Request $request, TahunAkademik $tahunAkademik): RedirectResponse
    {
        $data = $request->validate([
            'kode' => 'required|string|max:20|unique:tahun_akademik,kode,'.$tahunAkademik->id,
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = ($data['is_active'] ?? false);

        $tahunAkademik->update($data);

        return redirect()->route('admin.tahun-akademik.index')->with('success', 'Tahun Akademik diperbarui.');
    }

    public function destroy(TahunAkademik $tahunAkademik): RedirectResponse
    {
        $tahunAkademik->delete();

        return redirect()->route('admin.tahun-akademik.index')->with('success', 'Tahun Akademik dihapus.');
    }
}
