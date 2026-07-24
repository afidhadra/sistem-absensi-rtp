import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';

window.Alpine = Alpine;
Alpine.plugin(persist);

Alpine.store('confirm', {
    message: '',
    confirmLabel: 'Hapus',
    pendingForm: null,
    ask(e, message = 'Apakah Anda yakin?', label = 'Hapus') {
        e.preventDefault();
        this.message = message;
        this.confirmLabel = label;
        this.pendingForm = e.target;
    },
    ok() {
        if (!this.pendingForm) return;
        const form = this.pendingForm;
        this.pendingForm = null;
        form.submit();
    },
    cancel() {
        this.pendingForm = null;
    },
});

Alpine.store('toast', {
    items: [],
    show(message, type = 'success') {
        const id = Date.now();
        this.items.push({ id, message, type });
        setTimeout(() => this.dismiss(id), 3000);
    },
    dismiss(id) {
        this.items = this.items.filter((i) => i.id !== id);
    },
});

Alpine.start();
