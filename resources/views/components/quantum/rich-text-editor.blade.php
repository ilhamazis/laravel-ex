@props(['id', 'name', 'value'])

@php
    $quillId = $id . '-quill';

    $quillSelector = '#' . $quillId;
    $textareaSelector = '#' . $id;
@endphp

<div wire:ignore>
    <div id="{{ $quillId }}"
         x-init="
            initQuill(@js($quillSelector));
            syncQuillToTextarea(@js($quillSelector), @js($textareaSelector));
            sanitize($el.querySelector('.ql-editor'), @js($value));
         "></div>
</div>

<textarea {{ $attributes }}
          id="{{ $id }}" name="{{ $name }}"
          x-init="sanitize($el, @js($value))"
          style="display: none"></textarea>

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

@push('custom-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof Livewire === 'undefined') {
                initQuill(@js($quillSelector));
                syncQuillToTextarea(@js($quillSelector), @js($textareaSelector));
                sanitize(document.getElementById(@js($quillId)).querySelector('.ql-editor'), @js($value));
                sanitize(document.getElementById(@js($id)), @js($value));
            }
        });
    </script>
@endpush
