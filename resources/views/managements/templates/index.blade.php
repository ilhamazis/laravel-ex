@php
    $paths = [
        ['title' => 'Template'],
    ];
@endphp

<x-app-layout>
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-quantum.breadcrumb :paths="$paths"/>
            </div>

            <div class="main__action">
                @can(\App\Enums\PermissionEnum::CREATE_TEMPLATE->value)
                    <x-link href="{{ route('managements.templates.create') }}" class="btn btn_primary">
                        <span class="icon icon-plus-solid"></span>
                        <span class="btn__text">Buat Template</span>
                    </x-link>
                @endcan
            </div>
        </div>

        <livewire:templates.datatable/>
    </div>
</x-app-layout>
