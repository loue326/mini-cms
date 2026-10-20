@props(['type' => 'info', 'title' => null])

<div class="notice notice-{{ $type }}" role="{{ $type === 'error' ? 'alert' : 'status' }}">
    @if ($title)
        <p class="notice-title">{{ $title }}</p>
    @endif

    <div>{{ $slot }}</div>
</div>