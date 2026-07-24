@extends('layouts.admin')

@section('content-body')
<x-page-header title="Mata Kuliah" :action="route('admin.mata-kuliah.create')" />
<x-flash />

<div class="overflow-hidden rounded-xl bg-base-100 shadow">
    <table class="table table-zebra">
        <thead>
            <tr><th>Kode</th><th>Nama</th><th>SKS</th><th>Semester</th><th>Prodi</th><th class="text-right">Aksi</th></tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="hover">
                    <td class="font-mono">{{ $item->kode }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->sks }}</td>
                    <td>{{ $item->semester?->nama ?? '-' }}</td>
                    <td>{{ $item->programStudi?->nama ?? '-' }}</td>
                    <td class="text-right whitespace-nowrap">
                        <a href="{{ route('admin.mata-kuliah.edit', $item) }}" class="btn btn-ghost btn-xs">Edit</a>
                        <form method="POST" action="{{ route('admin.mata-kuliah.destroy', $item) }}" class="inline" onsubmit="return confirm('Hapus?')">
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
