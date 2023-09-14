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

    @push('styles')
        <link rel="stylesheet"
              href="{{ asset('quantum-v2.0.0-202307280002/assets/js/vendors/choices.js-10.2.0/public/assets/styles/choices.min.css') }}"/>
    @endpush

    @push('scripts')
        <script type="text/javascript"
                src="{{ asset('quantum-v2.0.0-202307280002/assets/js/vendors/choices.js-10.2.0/public/assets/scripts/choices.min.js') }}"></script>
    @endpush
</x-app-layout>