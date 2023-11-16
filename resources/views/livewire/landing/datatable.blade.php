<section class="jobs">
    <h3 class="jobs__title">Semua Pekerjaan yang Lagi Buka!</h3>

    <div class="jobs__wrapper">
        <div class="jobs__form">
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
                    <input wire:model.live.debounce.500ms="query" type="text" class="hero__input"
                           placeholder="Cari Pekerjaanmu..."/>
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
                    <select wire:model.live="type" class="hero__select">
                        <option @selected(is_null($type)) value="">Tipe Pekerjaan</option>
                        @foreach(\App\Enums\JobTypeEnum::values() as $typeEnum)
                            <option @selected($type === $typeEnum) value="{{ $typeEnum }}">{{ $typeEnum }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="hero__input-group">
                    <div class="hero__input-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_980_5906)">
                                <path
                                    d="M17.5 8.33333C17.5 14.1667 10 19.1667 10 19.1667C10 19.1667 2.5 14.1667 2.5 8.33333C2.5 6.3442 3.29018 4.43655 4.6967 3.03003C6.10322 1.6235 8.01088 0.833328 10 0.833328C11.9891 0.833328 13.8968 1.6235 15.3033 3.03003C16.7098 4.43655 17.5 6.3442 17.5 8.33333Z"
                                    stroke="#6F6F6F" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"/>
                                <path
                                    d="M10 10.8333C11.3807 10.8333 12.5 9.71404 12.5 8.33333C12.5 6.95262 11.3807 5.83333 10 5.83333C8.61929 5.83333 7.5 6.95262 7.5 8.33333C7.5 9.71404 8.61929 10.8333 10 10.8333Z"
                                    stroke="#6F6F6F" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_980_5906">
                                    <rect width="20" height="20" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <select wire:model.live="location" class="hero__select">
                        <option @selected(is_null($location)) value="">Lokasi</option>
                        @foreach($jobLocations as $jobLocation)
                            <option @selected($location === $jobLocation) value="{{ $jobLocation }}">
                                {{ $jobLocation }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="jobs__list-container">
            <div class="jobs__list-wrapper">
                <div class="jobs__container">
                    @forelse($jobs as $job)
                        <div class="card">
                            <h4 class="card__title">{{ $job->title }}</h4>
                            <div class="card__badges">
                                <div class="custom__badge custom__badge-text-primary">
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
                                <div class="custom__badge custom__badge-text-secondary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z"
                                              clip-rule="evenodd"/>
                                        <path fill-rule="evenodd"
                                              d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zM6 12a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V12zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 15a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V15zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 18a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V18zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    {{ $job->quota }} Kuota Tersisa
                                </div>

                                <div class="custom__badge custom__badge-text-secondary">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_980_5906)">
                                            <path
                                                d="M17.5 8.33333C17.5 14.1667 10 19.1667 10 19.1667C10 19.1667 2.5 14.1667 2.5 8.33333C2.5 6.3442 3.29018 4.43655 4.6967 3.03003C6.10322 1.6235 8.01088 0.833328 10 0.833328C11.9891 0.833328 13.8968 1.6235 15.3033 3.03003C16.7098 4.43655 17.5 6.3442 17.5 8.33333Z"
                                                stroke="#989898" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path
                                                d="M10 10.8333C11.3807 10.8333 12.5 9.71404 12.5 8.33333C12.5 6.95262 11.3807 5.83333 10 5.83333C8.61929 5.83333 7.5 6.95262 7.5 8.33333C7.5 9.71404 8.61929 10.8333 10 10.8333Z"
                                                stroke="#989898" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_980_5906">
                                                <rect width="20" height="20" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    {{ $job->location }}
                                </div>
                            </div>
                            <div class="card__description">
                                <x-rich-text-renderer :id="$job->slug . '-short-desc'"
                                                      :content="$job->firstSection->content"/>
                            </div>
                            <x-link href="{{ route('jobs.show', $job) }}"
                                    class="card__link button button__text-primary">
                                Lihat Detail
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M9.83438 4.23423C9.9844 4.08425 10.1878 4 10.4 4C10.6121 4 10.8156 4.08425 10.9656 4.23423L14.1656 7.43423C14.3156 7.58425 14.3998 7.7877 14.3998 7.99983C14.3998 8.21196 14.3156 8.41541 14.1656 8.56543L10.9656 11.7654C10.8147 11.9112 10.6126 11.9918 10.4029 11.99C10.1931 11.9881 9.99245 11.904 9.84412 11.7557C9.69579 11.6074 9.61166 11.4067 9.60984 11.1969C9.60801 10.9872 9.68865 10.7851 9.83438 10.6342L11.6688 8.79983H2.39998C2.1878 8.79983 1.98432 8.71554 1.83429 8.56551C1.68426 8.41549 1.59998 8.212 1.59998 7.99983C1.59998 7.78766 1.68426 7.58417 1.83429 7.43414C1.98432 7.28411 2.1878 7.19983 2.39998 7.19983H11.6688L9.83438 5.36543C9.6844 5.21541 9.60015 5.01196 9.60015 4.79983C9.60015 4.5877 9.6844 4.38425 9.83438 4.23423Z"
                                          fill="#074BB2"/>
                                </svg>
                            </x-link>
                        </div>
                    @empty
                        <h3 class="jobs__empty">Lowongan pekerjaan tidak ditemukan</h3>
                    @endforelse
                </div>
            </div>

            <div class="jobs__pagination">
                @if($jobs->hasMorePages())
                    <button wire:click="extendLimit" type="button"
                            class="jobs__pagination-button button button__md button__outline">
                        Muat lebih banyak
                    </button>
                @endif
                <p class="jobs__pagination-detail">
                    Menampilkan {{ $jobs->lastItem() }} dari {{ $jobs->total() }} lowongan pekerjaan yang tersedia
                </p>
            </div>
        </div>
    </div>
</section>
