@php
    $paths = [
        ['title' => 'Dashboard'],
    ];
@endphp

<x-app-layout>
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-breadcrumb :paths="$paths"/>
            </div>
        </div>
        
        Authenticated.
    </div>
</x-app-layout>