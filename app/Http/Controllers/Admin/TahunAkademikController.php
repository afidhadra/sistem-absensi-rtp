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
        return view('admin.tahun-akademik.index', ['items' => TahunAkademik::orderByDesc('kode')->paginate(20)]);
    }

    public function create(): View
    {
        return view('admin.tahun-akademik.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge(['is_active' => $request->boolean('is_active')]);

        $data = $request->validate([
            'kode' => 'required|string|max:20|unique:tahun_akademik,kode',
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        TahunAkademik::create($data);

        return redirect()->route('admin.tahun-akademik.index')->with('success', 'Tahun Akademik ditambahkan.');
    }

    public function edit(TahunAkademik $tahunAkademik): View
    {
        return view('admin.tahun-akademik.form', ['item' => $tahunAkademik]);
    }

    public function update(Request $request, TahunAkademik $tahunAkademik): RedirectResponse
    {
        $request->merge(['is_active' => $request->boolean('is_active')]);

        $data = $request->validate([
            'kode' => 'required|string|max:20|unique:tahun_akademik,kode,'.$tahunAkademik->id,
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $tahunAkademik->update($data);

        return redirect()->route('admin.tahun-akademik.index')->with('success', 'Tahun Akademik diperbarui.');
    }

    public function destroy(TahunAkademik $tahunAkademik): RedirectResponse
    {
        $tahunAkademik->delete();

        return redirect()->route('admin.tahun-akademik.index')->with('success', 'Tahun Akademik dihapus.');
    }
}
