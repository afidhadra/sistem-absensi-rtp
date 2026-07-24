@props(['title', 'action' => null, 'actionLabel' => 'Tambah'])
<div class="flex items-center justify-between mb-4">
    <div class="border-l-4 border-primary pl-2.5">
        <h1 class="text-sm font-bold text-base-content">{{ $title }}</h1>
    </div>
    @if ($action)
        <a href="{{ $action }}" class="btn btn-primary btn-xs">{{ $actionLabel }}</a>
    @endif
</div>
