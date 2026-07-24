import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';

window.Alpine = Alpine;
Alpine.plugin(persist);

Alpine.store('confirm', {
    message: '',
    pendingForm: null,
    ask(e, message = 'Apakah Anda yakin?') {
        e.preventDefault();
        this.message = message;
        this.pendingForm = e.target;
        document.getElementById('confirm-modal').showModal();
    },
    ok() {
        if (this.pendingForm) this.pendingForm.submit();
        this.pendingForm = null;
        document.getElementById('confirm-modal').close();
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
