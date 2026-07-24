@extends('layouts.admin')

@section('content-body')
<x-page-header title="Jadwal Kuliah" :action="route('admin.jadwal.create')" />
<x-flash />

<div class="overflow-hidden rounded-xl bg-base-100 shadow">
    <table class="table table-zebra">
        <thead>
            <tr><th>Hari</th><th>Jam</th><th>Ruangan</th><th>Dosen</th><th>Matkul</th><th>Kelas</th><th class="text-right">Aksi</th></tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="hover">
                    <td class="capitalize">{{ $item->hari }}</td>
                    <td class="font-mono">{{ substr($item->jam_mulai, 0, 5) }}-{{ substr($item->jam_selesai, 0, 5) }}</td>
                    <td>{{ $item->ruangan ?? '-' }}</td>
                    <td>{{ $item->teachingAssignment?->dosen?->nama ?? '-' }}</td>
                    <td>{{ $item->teachingAssignment?->mataKuliah?->nama ?? '-' }}</td>
                    <td>{{ $item->teachingAssignment?->kelas?->kode ?? '-' }}</td>
                    <td class="text-right whitespace-nowrap">
                        <a href="{{ route('admin.jadwal.edit', $item) }}" class="btn btn-ghost btn-xs">Edit</a>
                        <form method="POST" action="{{ route('admin.jadwal.destroy', $item) }}" class="inline" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-ghost btn-xs text-error">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
