<div class="navbar">
    <x-link href="{{ route('home') }}" class="navbar__logo">
        <img class="navbar__logo-image" src="{{ asset('/assets/images/logo_sevima.svg') }}" alt="Logo Sevima"/>
        <span class="navbar__logo-text">Career</span>
    </x-link>

    <x-link href="{{ route('jobs') }}" class="navbar__cta button button__md button__outline">
        Jelajahi Sekarang!
    </x-link>
</div>
