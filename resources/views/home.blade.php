<x-landing-layout>
    <section class="hero hero__home-page" style="background-image: url({{ asset('/assets/images/hero_jobs.jpeg') }})">
        <x-landing.navbar/>

        <div class="hero__content">
            <h1 class="hero__title">
                Gabung Bersama SEVIMA untuk Mencapai Puncak <span class="emphasis">Karier Anda!</span>
            </h1>
        </div>
    </section>

    <livewire:landing.datatable/>

    <x-landing.cta title="Temukan Semua yang Perlu Anda Ketahui Tentang SEVIMA">
        <x-slot:action>
            <x-link href="{{ route('about') }}" class="cta__button button button__lg button__primary">
                Pelajari Lebih Lanjut
            </x-link>
        </x-slot:action>
    </x-landing.cta>

    <x-landing.footer/>
</x-landing-layout>
