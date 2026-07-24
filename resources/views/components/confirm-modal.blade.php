<dialog id="confirm-modal" class="modal" x-data="{ open: false }" x-init="$watch(() => $store.confirm.pendingForm, v => open = !!v)" :class="open && 'modal-open'" @click.self="$store.confirm.cancel(); open = false">
    <div class="modal-box rounded-2xl">
        <h3 class="text-lg font-bold text-base-content">Konfirmasi</h3>
        <p class="py-4 text-sm text-base-content/60" x-text="$store.confirm.message">Apakah Anda yakin?</p>
        <div class="modal-action">
            <button type="button" class="btn btn-ghost btn-sm" @click="$store.confirm.cancel(); open = false">Batal</button>
            <button type="button" class="btn btn-error btn-sm" @click="$store.confirm.ok(); open = false">Hapus</button>
        </div>
    </div>
    <div class="modal-backdrop bg-black/40" @click="$store.confirm.cancel(); open = false"></div>
</dialog>
