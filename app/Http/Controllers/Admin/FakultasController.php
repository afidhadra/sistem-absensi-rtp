<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FakultasController extends Controller
{
    public function index(): View
    {
        return view('admin.fakultas.index', ['items' => Fakultas::orderBy('kode')->get()]);
    }

    public function create(): View
    {
        return view('admin.fakultas.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(['kode' => 'required|string|max:10|unique:fakultas,kode', 'nama' => 'required|string|max:255']);
        Fakultas::create($data);

        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas ditambahkan.');
    }

    public function edit(Fakultas $fakulta): View
    {
        return view('admin.fakultas.form', ['item' => $fakulta]);
    }

    public function update(Request $request, Fakultas $fakulta): RedirectResponse
    {
        $data = $request->validate(['kode' => 'required|string|max:10|unique:fakultas,kode,'.$fakulta->id, 'nama' => 'required|string|max:255']);
        $fakulta->update($data);

        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas diperbarui.');
    }

    public function destroy(Fakultas $fakulta): RedirectResponse
    {
        $fakulta->delete();

        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas dihapus.');
    }
}
