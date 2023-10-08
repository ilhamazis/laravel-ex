<div>
    <section class="hero hero__jobs-page" style="background-image: url({{ asset('/assets/images/hero_jobs.jpeg') }})">
        <x-landing.navbar/>

        <div class="hero__content">
            <h1 class="hero__title">
                Jelajahi tujuan pekerjaan impian Anda!
            </h1>
            <form class="hero__form">
                <div class="hero__input-row">
                    <div class="hero__input-group">
                        <div class="hero__input-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21 21L15 15M17 10C17 10.9193 16.8189 11.8295 16.4672 12.6788C16.1154 13.5281 15.5998 14.2997 14.9497 14.9497C14.2997 15.5998 13.5281 16.1154 12.6788 16.4672C11.8295 16.8189 10.9193 17 10 17C9.08075 17 8.1705 16.8189 7.32122 16.4672C6.47194 16.1154 5.70026 15.5998 5.05025 14.9497C4.40024 14.2997 3.88463 13.5281 3.53284 12.6788C3.18106 11.8295 3 10.9193 3 10C3 8.14348 3.7375 6.36301 5.05025 5.05025C6.36301 3.7375 8.14348 3 10 3C11.8565 3 13.637 3.7375 14.9497 5.05025C16.2625 6.36301 17 8.14348 17 10Z"
                                    stroke="#6F6F6F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <input wire:model="query" type="text" class="hero__input" placeholder="Cari Pekerjaanmu..."/>
                    </div>

                    <div class="hero__input-group">
                        <div class="hero__input-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21 13.255C18.1405 14.4112 15.0844 15.0038 12 15C8.817 15 5.78 14.38 3 13.255M16 6V4C16 3.46957 15.7893 2.96086 15.4142 2.58579C15.0391 2.21071 14.5304 2 14 2H10C9.46957 2 8.96086 2.21071 8.58579 2.58579C8.21071 2.96086 8 3.46957 8 4V6M12 12H12.01M5 20H19C19.5304 20 20.0391 19.7893 20.4142 19.4142C20.7893 19.0391 21 18.5304 21 18V8C21 7.46957 20.7893 6.96086 20.4142 6.58579C20.0391 6.21071 19.5304 6 19 6H5C4.46957 6 3.96086 6.21071 3.58579 6.58579C3.21071 6.96086 3 7.46957 3 8V18C3 18.5304 3.21071 19.0391 3.58579 19.4142C3.96086 19.7893 4.46957 20 5 20Z"
                                    stroke="#6F6F6F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <select wire:model="type" class="hero__select">
                            <option @selected(is_null($type)) value="">Tipe Pekerjaan</option>
                            @foreach(\App\Enums\JobTypeEnum::values() as $typeEnum)
                                <option @selected($type === $typeEnum) value="{{ $typeEnum }}">{{ $typeEnum }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button wire:click="$refresh" type="button" class="hero__button button button__md button__primary">
                    Cari Sekarang
                </button>
            </form>
        </div>
    </section>

    <section class="jobs">
        @if($jobs->isNotEmpty())
            <h3 class="jobs__count">{{ $jobs->total() }} Lowongan Pekerjaan Tersedia</h3>
        @endif

        @forelse($jobs as $job)
            <div class="jobs__wrapper">
                <div class="card">
                    <h4 class="card__title">{{ $job->title }}</h4>
                    <div class="card__badges">
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
                    <x-link href="{{ route('jobs.show', $job) }}" class="card__link button button__md button__primary">
                        See Detail
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M9.83438 4.23423C9.9844 4.08425 10.1878 4 10.4 4C10.6121 4 10.8156 4.08425 10.9656 4.23423L14.1656 7.43423C14.3156 7.58425 14.3998 7.7877 14.3998 7.99983C14.3998 8.21196 14.3156 8.41541 14.1656 8.56543L10.9656 11.7654C10.8147 11.9112 10.6126 11.9918 10.4029 11.99C10.1931 11.9881 9.99245 11.904 9.84412 11.7557C9.69579 11.6074 9.61166 11.4067 9.60984 11.1969C9.60801 10.9872 9.68865 10.7851 9.83438 10.6342L11.6688 8.79983H2.39998C2.1878 8.79983 1.98432 8.71554 1.83429 8.56551C1.68426 8.41549 1.59998 8.212 1.59998 7.99983C1.59998 7.78766 1.68426 7.58417 1.83429 7.43414C1.98432 7.28411 2.1878 7.19983 2.39998 7.19983H11.6688L9.83438 5.36543C9.6844 5.21541 9.60015 5.01196 9.60015 4.79983C9.60015 4.5877 9.6844 4.38425 9.83438 4.23423Z"
                                  fill="white"/>
                        </svg>
                    </x-link>
                </div>
            </div>
        @empty
            <h3 class="jobs__empty">Lowongan pekerjaan tidak ditemukan</h3>
        @endforelse

        @if($jobs->hasMorePages())
            <div class="jobs__pagination">
                <button type="button" class="jobs__pagination-button button button__md button__outline">
                    Muat lebih banyak
                </button>
                <p class="jobs__pagination-detail">Showing {{ $jobs->lastItem() }} out of {{ $jobs->total() }}</p>
            </div>
        @endif
    </section>
</div>
