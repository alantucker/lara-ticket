@props(['number'])

@php
    $name = (new App\View\Components\PriorityBadge($number))->badgeName();
@endphp

<span class="inline-flex items-center gap-x-1.5 rounded-full px-2 py-1 text-xs font-medium priority-badge-{{ $name }}">
    <svg class="h-1.5 w-1.5" viewBox="0 0 6 6" aria-hidden="true">
        <circle cx="3" cy="3" r="3" />
    </svg>
    {{ Str::upper($name) }}
</span>
