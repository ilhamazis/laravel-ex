@props(['id', 'name', 'value'])

@php
    $quillId = $id . 'Quill';
@endphp

<x-quantum.quill id="{{ $quillId }}"></x-quantum.quill>

<textarea id="{{ $id }}" name="{{ $name }}"
          style="display: none"></textarea>

@once
    @push('scripts')
        <script type="text/javascript" src="{{ asset('dompurify-3.0.6/purify.min.js') }}"></script>
    @endpush
@endonce

@push('custom-scripts')
    <script>
        document.getElementById(@js($quillId))
            .querySelector('.ql-editor').innerHTML = DOMPurify.sanitize(@js($value));

        document.getElementById(@js($id)).innerHTML = DOMPurify.sanitize(@js($value));

        document.getElementById(@js($quillId))
            .querySelector('.ql-editor')
            .addEventListener('DOMSubtreeModified', () => {
                document.getElementById(@js($id)).innerHTML = document.getElementById(@js($quillId))
                    .querySelector('.ql-editor')
                    .innerHTML;
            });
    </script>
@endpush
