@php
    $paths = [
        ['title' => 'Pelamar'],
    ];
@endphp

<x-app-layout>
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-quantum.breadcrumb :paths="$paths"/>
            </div>
        </div>

        <livewire:applications.datatable/>
    </div>
</x-app-layout>

