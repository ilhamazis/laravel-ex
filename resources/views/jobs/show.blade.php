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
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.5999 2.39999C9.28164 2.39999 8.97642 2.52642 8.75137 2.75147C8.52633 2.97651 8.3999 3.28173 8.3999 3.59999C8.3999 3.91825 8.52633 4.22348 8.75137 4.44852C8.97642 4.67357 9.28164 4.79999 9.5999 4.79999H11.9999C12.3182 4.79999 12.6234 4.67357 12.8484 4.44852C13.0735 4.22348 13.1999 3.91825 13.1999 3.59999C13.1999 3.28173 13.0735 2.97651 12.8484 2.75147C12.6234 2.52642 12.3182 2.39999 11.9999 2.39999H9.5999Z"
                        fill="#989898"/>
                    <path
                        d="M3.6001 6.00001C3.6001 5.36349 3.85295 4.75304 4.30304 4.30295C4.75313 3.85286 5.36358 3.60001 6.0001 3.60001C6.0001 4.55479 6.37938 5.47046 7.05451 6.14559C7.72964 6.82072 8.64532 7.20001 9.6001 7.20001H12.0001C12.9549 7.20001 13.8706 6.82072 14.5457 6.14559C15.2208 5.47046 15.6001 4.55479 15.6001 3.60001C16.2366 3.60001 16.8471 3.85286 17.2972 4.30295C17.7472 4.75304 18.0001 5.36349 18.0001 6.00001V13.2H12.4969L14.0485 11.6484C14.2671 11.4221 14.388 11.119 14.3853 10.8043C14.3826 10.4897 14.2564 10.1887 14.0339 9.96622C13.8114 9.74373 13.5104 9.61753 13.1958 9.6148C12.8811 9.61206 12.578 9.73302 12.3517 9.95161L8.7517 13.5516C8.52673 13.7766 8.40035 14.0818 8.40035 14.4C8.40035 14.7182 8.52673 15.0234 8.7517 15.2484L12.3517 18.8484C12.578 19.067 12.8811 19.1879 13.1958 19.1852C13.5104 19.1825 13.8114 19.0563 14.0339 18.8338C14.2564 18.6113 14.3826 18.3103 14.3853 17.9957C14.388 17.6811 14.2671 17.3779 14.0485 17.1516L12.4969 15.6H18.0001V19.2C18.0001 19.8365 17.7472 20.447 17.2972 20.8971C16.8471 21.3472 16.2366 21.6 15.6001 21.6H6.0001C5.36358 21.6 4.75313 21.3472 4.30304 20.8971C3.85295 20.447 3.6001 19.8365 3.6001 19.2V6.00001ZM18.0001 13.2H20.4001C20.7184 13.2 21.0236 13.3264 21.2486 13.5515C21.4737 13.7765 21.6001 14.0817 21.6001 14.4C21.6001 14.7183 21.4737 15.0235 21.2486 15.2485C21.0236 15.4736 20.7184 15.6 20.4001 15.6H18.0001V13.2Z"
                        fill="#989898"/>
                </svg>
                {{ $job->applications_count }} Pelamar
            </div>
        </div>

        <hr class="jobs-detail__divider"/>

        <div class="jobs-detail__description">
            <x-rich-text-renderer id="job-description" :content="$job->description"/>
        </div>
    </section>

    <x-landing.cta/>

    <x-landing.footer/>

    @push('styles')
        <link href="{{ asset('/quantum-v2.0.0-202307280002/assets/release/qn-202307280002.css') }}" rel="stylesheet">
    @endpush

    @push('scripts')
        <script type="text/javascript"
                src="{{ asset('/quantum-v2.0.0-202307280002/assets/release/qn-202307280002.js') }}"></script>
    @endpush
</x-landing-layout>
