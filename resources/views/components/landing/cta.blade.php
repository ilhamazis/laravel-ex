@props(['title'])

<section class="cta" {{ $attributes }}>
    <div class="cta__wrapper">
        <div class="cta__container" style="background-image: url({{ asset('/assets/images/circle_cta.svg') }})">
            <h2 class="cta__title">{{ $title }}</h2>
            {{ $action }}
        </div>
    </div>
</section>
