@extends('layouts.admin')

@section('content-body')
<x-page-header title="Tahun Akademik" :action="route('admin.tahun-akademik.create')" />
<x-flash />

<div class="overflow-hidden rounded-xl bg-base-100 shadow">
    <table class="table table-zebra">
        <thead>
            <tr><th>Kode</th><th>Nama</th><th>Periode</th><th>Status</th><th class="text-right">Aksi</th></tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="hover">
                    <td class="font-mono">{{ $item->kode }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="text-sm">{{ $item->tanggal_mulai }} s/d {{ $item->tanggal_selesai }}</td>
                    <td>{{ $item->is_active ? '<span class="badge badge-success badge-sm">Aktif</span>' : '<span class="badge badge-ghost badge-sm">Nonaktif</span>' }}</td>
                    <td class="text-right whitespace-nowrap">
                        <a href="{{ route('admin.tahun-akademik.edit', $item) }}" class="btn btn-ghost btn-xs">Edit</a>
                        <form method="POST" action="{{ route('admin.tahun-akademik.destroy', $item) }}" class="inline" onsubmit="return confirm('Hapus?')">
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
