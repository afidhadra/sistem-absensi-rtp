@props(['title', 'action' => null, 'actionLabel' => 'Tambah'])
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-base-content">{{ $title }}</h1>
    @if ($action)
        <a href="{{ $action }}" class="btn btn-primary btn-sm">{{ $actionLabel }}</a>
    @endif
</div>
