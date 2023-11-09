@props(['id', 'name', 'value'])

@php
    $quillId = $id . 'Quill';
@endphp

<x-quantum.quill id="{{ $quillId }}" x-init="sanitize($el, @js($value))"></x-quantum.quill>

<textarea id="{{ $id }}" name="{{ $name }}"
          x-init="sanitize($el, @js($value))"
          style="display: none"></textarea>

@push('custom-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof Livewire === 'undefined') {
                sanitize(document.getElementById(@js($quillId)).querySelector('.ql-editor'), @js($value));
                sanitize(document.getElementById(@js($id)), @js($value));
            }
        });

        document.getElementById(@js($quillId))
            .querySelector('.ql-editor')
            .addEventListener('DOMSubtreeModified', () => {
                document.getElementById(@js($id)).innerHTML = document.getElementById(@js($quillId))
                    .querySelector('.ql-editor')
                    .innerHTML;
            });
    </script>
@endpush
