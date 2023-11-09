@props(['id', 'content'])

<div id="{{ $id }}" class="custom__ql-container" x-init="sanitize($el, @js($content))"></div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof Livewire === 'undefined') {
                sanitize(document.getElementById(@js($id)), @js($content));
            }
        });
    </script>
@endpush
