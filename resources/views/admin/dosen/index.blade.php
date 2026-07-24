@extends('layouts.admin')

@section('content-body')
<x-page-header title="Dosen" :action="route('admin.dosen.create')" />
<x-flash />

<div class="overflow-hidden rounded-xl bg-base-100 shadow">
    <table class="table table-zebra table-sm">
        <thead>
            <tr class="text-xs uppercase text-base-content/50"><th>NIP</th><th>Nama</th><th>Email</th><th>Fakultas</th><th class="text-right">Aksi</th></tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr class="hover">
                    <td class="font-mono">{{ $item->nip }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="text-base-content/50">{{ $item->user?->email }}</td>
                    <td>{{ $item->fakultas?->nama ?? '-' }}</td>
                    <td class="text-right whitespace-nowrap">
                        <a href="{{ route('admin.dosen.edit', $item) }}" class="btn btn-ghost btn-xs"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                        <form method="POST" action="{{ route('admin.dosen.destroy', $item) }}" class="inline" x-data @submit.prevent="$store.confirm.ask($event, 'Hapus data ini?', 'Hapus')">
                            @csrf @method('DELETE')
                            <button class="btn btn-ghost btn-xs text-error"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-8"><svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg><div class="text-base-content/40 text-xs">Belum ada data.</div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $items->links() }}
</div>
@endsection

