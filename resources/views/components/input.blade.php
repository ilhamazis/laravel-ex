@props(['type' => 'text'])

<input {{ $attributes->merge(['class' => 'form-control__input', 'type' => $type]) }}/>
