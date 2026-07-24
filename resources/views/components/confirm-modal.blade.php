@props(['id' => 'confirm-modal'])
<dialog id="{{ $id }}" class="modal">
    <div class="modal-box rounded-2xl">
        <h3 class="text-lg font-bold text-base-content">{{ $title ?? 'Konfirmasi' }}</h3>
        <p class="py-4 text-sm text-base-content/60" x-data x-text="$store.confirm.message">{{ $message ?? 'Apakah Anda yakin?' }}</p>
        <div class="modal-action">
            <form method="dialog"><button class="btn btn-ghost btn-sm" @click="$store.confirm.cancel()">Batal</button></form>
            <button class="btn btn-error btn-sm" @click="$store.confirm.ok()">Hapus</button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop"><button @click="$store.confirm.cancel()">close</button></form>
</dialog>
