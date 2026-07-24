@extends('layouts.admin')

@section('content-body')
<x-page-header title="Kelas" :action="route('admin.kelas.create')" />
<x-flash />

<div class="overflow-hidden rounded-xl bg-base-100 shadow max-w-5xl mx-auto">
    <table class="table table-zebra table-sm">
        <thead>
            <tr><th>Kode</th><th>Nama</th><th>Prodi</th><th class="text-right">Aksi</th></tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="hover">
                    <td class="font-mono">{{ $item->kode }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->programStudi?->nama ?? '-' }}</td>
                    <td class="text-right whitespace-nowrap">
                        <a href="{{ route('admin.kelas.edit', $item) }}" class="btn btn-ghost btn-xs"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                        <form method="POST" action="{{ route('admin.kelas.destroy', $item) }}" class="inline" x-data @submit.prevent="$store.confirm.ask($event, 'Hapus data ini?', 'Hapus')">
                            @csrf @method('DELETE')
                            <button class="btn btn-ghost btn-xs text-error"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $items->links() }}
</div>
@endsection

