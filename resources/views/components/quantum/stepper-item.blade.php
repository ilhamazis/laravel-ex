@props(['variant' => null, 'active' => false])

<li @class([
    'stepper__item',
    $variant,
    'active' => $active,
])>
    {{ $slot }}
</li>
