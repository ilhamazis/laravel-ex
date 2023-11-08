<x-landing-layout :title="$job->title . ' - SEVIMA Career'">
    <div class="navbar__wrapper">
        <x-landing.navbar/>
    </div>

    <section class="jobs-detail__wrapper">
        <div class="jobs-detail__header-wrapper">
            <div class="jobs-detail__header">
                <h1 class="jobs-detail__title">{{ $job->title }}</h1>
                <p class="jobs-detail__timestamp">Diposting {{ $job->updated_at->diffForHumans() }}</p>
            </div>

            <div class="jobs-detail__actions">
                <x-copy-link :url="route('jobs.show', $job)"
                             class="btn btn_outline">
                    <span class="icon icon-share-solid"></span>
                    Bagikan
                </x-copy-link>
            </div>
        </div>

        <div class="jobs-detail__badges">
            <div class="custom__badge custom__badge-outline">
                <svg width="16" height="16" viewBox="0 0 20 20"
                     fill="none">
                    <path
                        d="M16.668 5.83333H3.33464C2.41416 5.83333 1.66797 6.57952 1.66797 7.49999V15.8333C1.66797 16.7538 2.41416 17.5 3.33464 17.5H16.668C17.5884 17.5 18.3346 16.7538 18.3346 15.8333V7.49999C18.3346 6.57952 17.5884 5.83333 16.668 5.83333Z"
                        stroke="#3955A4" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"/>
                    <path
                        d="M13.3346 17.5V4.16667C13.3346 3.72464 13.159 3.30072 12.8465 2.98816C12.5339 2.67559 12.11 2.5 11.668 2.5H8.33464C7.89261 2.5 7.46869 2.67559 7.15612 2.98816C6.84356 3.30072 6.66797 3.72464 6.66797 4.16667V17.5"
                        stroke="#3955A4" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"/>
                </svg>
                {{ $job->type }}
            </div>
            <div class="custom__badge custom__badge-secondary">
                <span class="icon icon-clipboard-document-list-solid"></span>
                {{ $job->quota }} Kuota Tersisa
            </div>
        </div>

        <hr class="jobs-detail__divider"/>

        <div class="jobs-detail__description">
            <x-rich-text-renderer id="job-description" :content="$job->description"/>
        </div>

        <div style="padding-top: 3rem">
            <x-link href="{{ route('jobs.apply', $job) }}" class="btn btn_primary btn_full-width btn_md">
                Lamar Sekarang
            </x-link>
        </div>
    </section>

    <div style="padding-top: 5rem">
        <x-landing.cta title="Temukan Semua yang Perlu Anda Ketahui Tentang SEVIMA">
            <x-slot:action>
                <x-link href="{{ route('about') }}" class="cta__button button button__lg button__primary">
                    Pelajari Lebih Lanjut
                </x-link>
            </x-slot:action>
        </x-landing.cta>
    </div>

    <x-landing.footer/>

    @push('styles')
        <link href="{{ asset('/quantum-v2.0.0-202307280002/assets/release/qn-202307280002.css') }}" rel="stylesheet">
    @endpush

    @push('scripts')
        <script type="text/javascript"
                src="{{ asset('/quantum-v2.0.0-202307280002/assets/release/qn-202307280002.js') }}"></script>
    @endpush
</x-landing-layout>
