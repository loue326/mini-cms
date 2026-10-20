@props(['to', 'match' => null])

@php
    $active = request()->routeIs($match ?? $to);
@endphp

<a class="nav-link {{ $active ? 'is-active' : '' }}" href="{{ route($to) }}" @if ($active) aria-current="page" @endif>
    {{ $slot }}
</a>