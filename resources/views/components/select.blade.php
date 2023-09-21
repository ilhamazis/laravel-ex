@props([
    'variant' => 'default',
    'placeholder' => 'Search...',
])

@once
    @push('styles')
        <link rel="stylesheet"
              href="{{ asset('/quantum-v2.0.0-202307280002/assets/js/vendors/choices.js-10.2.0/public/assets/styles/choices.min.css') }}"/>
    @endpush

    @push('scripts')
        <script type="text/javascript"
                src="{{ asset('/quantum-v2.0.0-202307280002/assets/js/vendors/choices.js-10.2.0/public/assets/scripts/choices.min.js') }}"></script>
    @endpush
@endonce

@php
    $variant = match ($variant) {
        'single-search' => 'initChoicesSearch($el)',
        default => 'initChoices($el)',
    };
@endphp

<select
    x-init="{{ $variant }}"
    data-placeholder="{{ $placeholder }}"
    {{ $attributes }}
>
    {{ $slot }}
</select>
