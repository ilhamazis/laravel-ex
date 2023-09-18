@props(['url' => url()->current()])

<button type="button" {{ $attributes }} onclick="copyToClipboard(this, @js($url))">
    {{ $slot }}
</button>
