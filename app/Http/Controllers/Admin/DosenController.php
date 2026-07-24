<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DosenController extends Controller
{
    public function index(): View
    {
        $items = Dosen::with(['user', 'fakultas'])->orderBy('nama')->get();

        return view('admin.dosen.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.dosen.form', ['fakultas' => Fakultas::orderBy('kode')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nip' => 'required|string|max:20|unique:dosen,nip',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'fakultas_id' => 'nullable|exists:fakultas,id',
        ]);

        $user = User::create([
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'dosen',
        ]);

        Dosen::create([
            'user_id' => $user->id,
            'nip' => $data['nip'],
            'nama' => $data['nama'],
            'fakultas_id' => $data['fakultas_id'] ?? null,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen ditambahkan.');
    }

    public function edit(Dosen $dosen): View
    {
        return view('admin.dosen.form', ['item' => $dosen, 'fakultas' => Fakultas::orderBy('kode')->get()]);
    }

    public function update(Request $request, Dosen $dosen): RedirectResponse
    {
        $data = $request->validate([
            'nip' => 'required|string|max:20|unique:dosen,nip,'.$dosen->id,
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$dosen->user_id,
            'password' => 'nullable|string|min:6',
            'fakultas_id' => 'nullable|exists:fakultas,id',
        ]);

        $dosen->user->update([
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => isset($data['password']) ? Hash::make($data['password']) : $dosen->user->password,
        ]);

        $dosen->update([
            'nip' => $data['nip'],
            'nama' => $data['nama'],
            'fakultas_id' => $data['fakultas_id'] ?? null,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen diperbarui.');
    }

    public function destroy(Dosen $dosen): RedirectResponse
    {
        $dosen->user->delete(); // cascade deletes dosen

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen dihapus.');
    }
}
