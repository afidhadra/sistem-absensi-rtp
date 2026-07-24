@extends('layouts.admin')

@section('content-body')
<x-page-header title="Mahasiswa" :action="route('admin.mahasiswa.create')" />
<x-flash />

<div class="overflow-hidden rounded-xl bg-base-100 shadow">
    <table class="table table-zebra">
        <thead>
            <tr><th>NIM</th><th>Nama</th><th>Email</th><th>Kelas</th><th class="text-right">Aksi</th></tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="hover">
                    <td class="font-mono">{{ $item->nim }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="text-base-content/50">{{ $item->user?->email }}</td>
                    <td>{{ $item->kelas?->kode ?? '-' }}</td>
                    <td class="text-right whitespace-nowrap">
                        <a href="{{ route('admin.mahasiswa.edit', $item) }}" class="btn btn-ghost btn-xs">Edit</a>
                        <form method="POST" action="{{ route('admin.mahasiswa.destroy', $item) }}" class="inline" onsubmit="return confirm('Hapus?')">
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
