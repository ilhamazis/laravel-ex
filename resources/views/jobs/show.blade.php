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
                <x-link href="{{ route('jobs.apply', $job) }}" class="btn btn_primary">Lamar Sekarang</x-link>
            </div>
        </div>

        <div class="jobs-detail__badges">
            <span class="custom__badge custom__badge-outline">{{ $job->type }}</span>
            <div class="custom__badge custom__badge-secondary">
                <span class="icon icon-clipboard-document-list-solid"></span>
                {{ $job->quota }} kuota
            </div>
        </div>

        <hr class="jobs-detail__divider"/>

        <div class="jobs-detail__description">
            <x-rich-text-renderer id="job-description" :content="$job->description"/>
        </div>
    </section>

    <div style="padding-top: 5rem">
        <x-landing.cta title="Belum Yakin untuk Bergabung dengan SEVIMA?">
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
