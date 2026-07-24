@extends('layouts.admin')

@section('content-body')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Jadwal Kuliah</h1>
    <a href="{{ route('admin.jadwal.create') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Tambah</a>
</div>
@if (session('success'))
    <div class="mb-4 rounded-lg bg-green-50 p-3 text-sm text-green-700">{{ session('success') }}</div>
@endif
<div class="overflow-hidden rounded-xl bg-white shadow">
    <table class="w-full text-left text-sm">
        <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
            <tr><th class="px-4 py-3">Hari</th><th class="px-4 py-3">Jam</th><th class="px-4 py-3">Ruangan</th><th class="px-4 py-3">Dosen</th><th class="px-4 py-3">Mata Kuliah</th><th class="px-4 py-3">Kelas</th><th class="px-4 py-3 text-right">Aksi</th></tr>
        </thead>
        <tbody class="divide-y">
            @foreach ($items as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 capitalize">{{ $item->hari }}</td>
                    <td class="px-4 py-3 font-mono">{{ substr($item->jam_mulai, 0, 5) }} - {{ substr($item->jam_selesai, 0, 5) }}</td>
                    <td class="px-4 py-3">{{ $item->ruangan ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $item->teachingAssignment?->dosen?->nama }}</td>
                    <td class="px-4 py-3">{{ $item->teachingAssignment?->mataKuliah?->nama }}</td>
                    <td class="px-4 py-3">{{ $item->teachingAssignment?->kelas?->kode }}</td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <a href="{{ route('admin.jadwal.edit', $item) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('admin.jadwal.destroy', $item) }}" class="inline ml-2" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="text-red-600 hover:underline">Hapus</button></form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
