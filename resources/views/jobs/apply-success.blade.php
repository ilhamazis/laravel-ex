<x-landing-layout title="Congratulations - SEVIMA Career" style="min-height: 100vh">
    <div class="navbar__wrapper">
        <x-landing.navbar/>
    </div>

    <div class="jobs-apply-success__container">
        <img class="jobs-apply-success__image"
             src="{{ asset('/assets/images/apply_success.svg') }}" alt="Success Apply Job"/>
        <h4 class="jobs-apply-success__heading">
            Terima Kasih atas Lamaran Anda! Kami akan Mengemail Anda Kembali.
        </h4>
        <x-link href="{{ route('jobs.show', $job) }}"
                class="button button__md button__primary button__full-width">
            Kembali ke Halaman Detail Pekerjaan
        </x-link>
    </div>
</x-landing-layout>
