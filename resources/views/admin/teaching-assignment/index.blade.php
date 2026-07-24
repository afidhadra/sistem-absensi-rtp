@extends('layouts.admin')

@section('content-body')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Penugasan Dosen</h1>
    <a href="{{ route('admin.teaching-assignment.create') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Tambah</a>
</div>
@if (session('success'))
    <div class="mb-4 rounded-lg bg-green-50 p-3 text-sm text-green-700">{{ session('success') }}</div>
@endif
<div class="overflow-hidden rounded-xl bg-white shadow">
    <table class="w-full text-left text-sm">
        <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
            <tr><th class="px-4 py-3">Dosen</th><th class="px-4 py-3">Mata Kuliah</th><th class="px-4 py-3">Kelas</th><th class="px-4 py-3">Semester</th><th class="px-4 py-3">Tahun</th><th class="px-4 py-3 text-right">Aksi</th></tr>
        </thead>
        <tbody class="divide-y">
            @foreach ($items as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $item->dosen?->nama }}</td>
                    <td class="px-4 py-3">{{ $item->mataKuliah?->nama }}</td>
                    <td class="px-4 py-3">{{ $item->kelas?->kode }}</td>
                    <td class="px-4 py-3">{{ $item->semester?->nama }}</td>
                    <td class="px-4 py-3">{{ $item->tahunAkademik?->kode }}</td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <a href="{{ route('admin.teaching-assignment.edit', $item) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('admin.teaching-assignment.destroy', $item) }}" class="inline ml-2" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="text-red-600 hover:underline">Hapus</button></form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
