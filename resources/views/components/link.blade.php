@props(['href' => '#'])

<a wire:navigate href="{{ $href }}" {{ $attributes }}>{{ $slot }}</a>
