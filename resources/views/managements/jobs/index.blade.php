@php
    $paths = [
        ['title' => 'Jobs'],
    ];
@endphp

<x-app-layout>
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-breadcrumb :paths="$paths"/>
            </div>

            <div class="main__action">
                <x-link href="{{ route('managements.jobs.create') }}" class="btn btn_primary">
                    <span class="icon icon-plus-solid"></span>
                    <span class="btn__text">Create New Jobs</span>
                </x-link>
            </div>
        </div>

        <livewire:jobs.datatable/>
    </div>
</x-app-layout>