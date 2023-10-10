@props(['id', 'content'])

<div id="{{ $id }}" class="custom__ql-container"></div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('dompurify-3.0.6/purify.min.js') }}"></script>
    <script>
        document.getElementById(@js($id)).innerHTML = DOMPurify.sanitize(@js($content));
    </script>
@endpush
