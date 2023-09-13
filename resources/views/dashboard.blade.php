@php
    $paths = [
        ['title' => 'Dashboard'],
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb :paths="$paths"/>
    </x-slot>
    
    Authenticated.
</x-app-layout>