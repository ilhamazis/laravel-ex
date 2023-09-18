@props(['variant' => null, 'size' => 'badge_sm'])

<span @class(['badge', $variant, $size])>
     {{ $slot }}
</span>
