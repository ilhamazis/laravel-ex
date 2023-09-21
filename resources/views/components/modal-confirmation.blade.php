@props(['variant' => 'default', 'id' => 'modal', 'title' => 'Are you sure?'])

@php
    $variant = match ($variant) {
        'success' => 'modal_confirmation-success',
        'warning' => 'modal_confirmation-warning',
        'danger' => 'modal_confirmation-error',
        default => 'modal_confirmation-primary',
    };
@endphp

<div wire:ignore.self id="{{ $id }}" @class(['modal', $variant])>
    <div class="modal__overlay" data-dismiss="modal"></div>
    <div class="modal__wrapper">
        <div class="modal__header">
            <div class="modal__header-wrapper">
                <h3 class="modal__title">{{ $title }}</h3>
            </div>
            <span class="icon icon-x-mark-mini" data-dismiss="modal"></span>
        </div>
        <div class="modal__body">
            {{ $body }}
        </div>
        <div class="modal__footer">
            {{ $footer }}
        </div>
    </div>
</div>
