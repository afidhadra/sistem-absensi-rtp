<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        $items = Mahasiswa::with(['user', 'kelas'])->orderBy('nama')->paginate(20);

        return view('admin.mahasiswa.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.mahasiswa.form', ['kelas' => Kelas::orderBy('kode')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswa,nim',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        $user = User::create([
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'kelas_id' => $data['kelas_id'] ?? null,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa): View
    {
        return view('admin.mahasiswa.form', ['item' => $mahasiswa, 'kelas' => Kelas::orderBy('kode')->get()]);
    }

    public function update(Request $request, Mahasiswa $mahasiswa): RedirectResponse
    {
        $data = $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswa,nim,'.$mahasiswa->id,
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,'.$mahasiswa->user_id,
            'password' => 'nullable|string|min:6',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        $mahasiswa->user->update([
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => isset($data['password']) ? Hash::make($data['password']) : $mahasiswa->user->password,
        ]);

        $mahasiswa->update([
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'kelas_id' => $data['kelas_id'] ?? null,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa): RedirectResponse
    {
        $mahasiswa->user->delete(); // cascade deletes mahasiswa

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa dihapus.');
    }
}
