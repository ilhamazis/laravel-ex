@once
    @push('styles')
        <link rel="stylesheet"
              href="{{ asset('quantum-v2.0.0-202307280002/assets/js/vendors/quill-1.3.7/dist/quill.snow.css') }}"/>
    @endpush

    @push('scripts')
        <script
            src="{{ asset('quantum-v2.0.0-202307280002/assets/js/vendors/quill-1.3.7/dist/quill.min.js') }}"></script>
    @endpush

    @push('custom-scripts')
        <script type="text/javascript"
                src="{{ asset('quantum-v2.0.0-202307280002/assets/js/utils/quill-options.js') }}"></script>
    @endpush
@endonce

<div class="text-editor" {{ $attributes }}>{{ $slot }}</div>
