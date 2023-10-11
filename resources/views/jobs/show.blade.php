<x-landing-layout :title="$job->title . ' - SEVIMA Career'">
    <div class="navbar__wrapper">
        <x-landing.navbar/>
    </div>

    <section class="jobs-detail__wrapper">
        <h1 class="jobs-detail__title">{{ $job->title }}</h1>

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

        <div class="jobs-detail__buttons">
            <button type="button" onclick="copyToClipboard(this, @js(route('jobs.show', $job)))"
                    class="button button__md button__outline">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.68408 13.342C8.88608 12.938 9.00008 12.482 9.00008 12C9.00008 11.518 8.88608 11.062 8.68408 10.658M8.68408 13.342C8.38178 13.9464 7.88428 14.431 7.27217 14.7174C6.66007 15.0037 5.96921 15.075 5.31152 14.9197C4.65384 14.7644 4.06785 14.3916 3.64849 13.8617C3.22914 13.3317 3.00098 12.6758 3.00098 12C3.00098 11.3242 3.22914 10.6682 3.64849 10.1383C4.06785 9.60841 4.65384 9.2356 5.31152 9.08029C5.96921 8.92499 6.66007 8.99628 7.27217 9.28263C7.88428 9.56898 8.38178 10.0536 8.68408 10.658M8.68408 13.342L15.3161 16.658M8.68408 10.658L15.3161 7.34199M15.3161 16.658C14.9602 17.3698 14.9016 18.1939 15.1533 18.9489C15.4049 19.704 15.9462 20.3281 16.6581 20.684C17.3699 21.0399 18.194 21.0985 18.949 20.8468C19.704 20.5951 20.3282 20.0538 20.6841 19.342C21.04 18.6302 21.0986 17.8061 20.8469 17.0511C20.5952 16.296 20.0539 15.6719 19.3421 15.316C18.9896 15.1398 18.6059 15.0347 18.2128 15.0067C17.8197 14.9788 17.425 15.0286 17.0511 15.1532C16.2961 15.4049 15.672 15.9462 15.3161 16.658ZM15.3161 7.34199C15.4923 7.69439 15.7362 8.00863 16.0339 8.26677C16.3316 8.5249 16.6772 8.72188 17.051 8.84645C17.4248 8.97102 17.8195 9.02074 18.2125 8.99278C18.6055 8.96482 18.9892 8.85973 19.3416 8.68349C19.694 8.50726 20.0082 8.26334 20.2664 7.96566C20.5245 7.66798 20.7215 7.32238 20.846 6.94858C20.9706 6.57477 21.0203 6.1801 20.9924 5.78708C20.9644 5.39406 20.8593 5.01039 20.6831 4.65799C20.3272 3.94628 19.7031 3.40511 18.9482 3.15353C18.1932 2.90195 17.3693 2.96057 16.6576 3.31649C15.9459 3.67241 15.4047 4.29648 15.1531 5.05141C14.9015 5.80634 14.9602 6.63028 15.3161 7.34199Z"
                        stroke="#3955A4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Bagikan Lowongan Pekerjaan
            </button>
            <x-link href="{{ route('jobs.apply', $job) }}" class="button button__md button__primary">Lamar</x-link>
        </div>
    </section>

    <x-landing.cta/>

    <x-landing.footer/>
</x-landing-layout>
