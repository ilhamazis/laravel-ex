@php
    $paths = [
        ['title' => 'Jobs'],
    ];
@endphp

<x-app-layout>
    <div class="main__header">
        <div class="main__location">
            <x-breadcrumb :paths="$paths"/>
        </div>

        <div class="main__action">
            <a href="#" class="btn btn_primary">
                <span class="icon icon-plus-solid"></span>
                <span class="btn__text">Create New Jobs</span>
            </a>
        </div>
    </div>

    <livewire:jobs.datatable/>
</x-app-layout>