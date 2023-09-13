<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('app.name', 'SEVIMA Career') }}</title>

    @yield('styles')
    <link href="{{ asset('/quantum-v2.0.0-202307280002/assets/release/qn-202307280002.css') }}" rel="stylesheet">
</head>
<body {{ $attributes->merge() }}>

<x-header/>

<main class="main">
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-breadcrumb/>
            </div>
        </div>

        {{ $slot }}
    </div>

    <x-footer/>
</main>

@yield('scripts')
<script type="text/javascript"
        src="{{ asset('/quantum-v2.0.0-202307280002/assets/release/qn-202307280002.js') }}"></script>
</body>
</html>
