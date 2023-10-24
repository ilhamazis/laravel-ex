@props(['variant' => 'default', 'message', 'dismissable' => false, 'fontWeight' => 'bold'])

@php
    $variant = match ($variant) {
        'success' => 'alert_success',
        'error' => 'alert_danger',
        'helper' => 'alert_helper',
        'warning' => 'alert_warning',
        default => 'alert_default',
    };
@endphp

@if($message)
    <div {{ $attributes }}>
        <div @class(['alert', $variant])>
            <div class="alert__content">
                @if($fontWeight === 'bold')
                    <h4 class="alert__heading">{{ $message }}</h4>
                @elseif ($fontWeight === 'normal')
                    <p>{{ $message }}</p>
                @endif
            </div>
            @if($dismissable)
                <span class="icon icon-x-mark-mini" data-dismiss="alert"></span>
            @endif
        </div>
    </div>
@endif
