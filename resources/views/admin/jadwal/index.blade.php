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
                        <a href="{{ route('admin.jadwal.edit', $item) }}" class="btn btn-ghost btn-xs"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                        <form method="POST" action="{{ route('admin.jadwal.destroy', $item) }}" class="inline" x-data @submit.prevent="$store.confirm.ask($event, 'Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-ghost btn-xs text-error"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
