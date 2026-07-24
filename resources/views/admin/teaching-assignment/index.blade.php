@extends('layouts.admin')

@section('content-body')
<x-page-header title="Penugasan Dosen" :action="route('admin.teaching-assignment.create')" />
<x-flash />

<div class="overflow-hidden rounded-xl bg-base-100 shadow">
    <table class="table table-zebra">
        <thead>
            <tr><th>Dosen</th><th>Matkul</th><th>Kelas</th><th>Semester</th><th>Tahun</th><th class="text-right">Aksi</th></tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="hover">
                    <td>{{ $item->dosen?->nama ?? '-' }}</td>
                    <td>{{ $item->mataKuliah?->nama ?? '-' }}</td>
                    <td>{{ $item->kelas?->kode ?? '-' }}</td>
                    <td>{{ $item->semester?->nama ?? '-' }}</td>
                    <td>{{ $item->tahunAkademik?->kode ?? '-' }}</td>
                    <td class="text-right whitespace-nowrap">
                        <a href="{{ route('admin.teaching-assignment.edit', $item) }}" class="btn btn-ghost btn-xs">Edit</a>
                        <form method="POST" action="{{ route('admin.teaching-assignment.destroy', $item) }}" class="inline" onsubmit="return confirm('Hapus?')">
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
