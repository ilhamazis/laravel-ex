<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('app.name', 'SEVIMA Career') }}</title>

    @stack('styles')
    <link href="{{ asset('/quantum-v2.0.0-202307280002/assets/release/qn-202307280002.css') }}" rel="stylesheet">
    @vite(['resources/js/app.js'])
</head>
<body {{ $attributes->merge() }}>

<x-header/>

<main class="main">
    <div class="container">
        {{ $slot }}
    </div>

    <x-footer/>
</main>

@stack('scripts')
<script type="text/javascript"
        src="{{ asset('/quantum-v2.0.0-202307280002/assets/release/qn-202307280002.js') }}"></script>
@stack('custom-scripts')
</body>
</html>
