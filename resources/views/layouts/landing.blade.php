<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('app.name', 'SEVIMA Career') }}</title>

    @yield('styles')
    <link rel="stylesheet" href="{{ asset('/quantum-v2.0.0-202307280002/assets/release/qn-202307280002.css') }}"
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body {{ $attributes->merge() }}>
{{ $slot }}

@yield('scripts')
<script type="text/javascript"
        src="{{ asset('/quantum-v2.0.0-202307280002/assets/release/qn-202307280002.js') }}"></script>
</body>
</html>
