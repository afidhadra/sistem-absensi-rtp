@php
$typeClass = [
    'success' => 'alert-success',
    'error' => 'alert-error',
    'warning' => 'alert-warning',
    'info' => 'alert-info',
];
@endphp
<div x-data x-cloak class="toast toast-end toast-top z-[100]" x-show="$store.toast.items.length > 0">
    <template x-for="item in $store.toast.items" :key="item.id">
        <div class="alert shadow-lg" :class="item.type === 'success' ? 'alert-success' : item.type === 'error' ? 'alert-error' : item.type === 'warning' ? 'alert-warning' : 'alert-info'">
            <span x-text="item.message"></span>
            <button class="btn btn-ghost btn-xs" @click="$store.toast.dismiss(item.id)">x</button>
        </div>
    </template>
</div>
