<x-app-layout>
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-breadcrumb :paths="$breadcrumbs"/>
            </div>
        </div>

        <x-alert variant="success" :message="session()->get('success')"
                 dismissable/>

        <div class="grid">
            <div class="col-12">
                <x-badge :variant="\App\Enums\JobStatusEnum::getBadgeVariant($job->status)">
                    {{ $job->status }}
                </x-badge>
            </div>
            <div class="col-12 col-sm-7 col-md-9">
                <h2>{{ $job->title }}</h2>
                <div class="detail__desc-wrapper">
                    <p class="detail__desc">
                        Dibuat oleh {{ $job->createdBy->name }}
                    </p>
                    <div class="detail__desc-divider">
                        <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="2" cy="2" r="2" fill="#D9D9D9"/>
                        </svg>
                    </div>
                    <p class="detail__desc">
                        {{ $job->type }}
                    </p>
                    @if ($job->start_at)
                        <div class="detail__desc-divider">
                            <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2" cy="2" r="2" fill="#D9D9D9"/>
                            </svg>
                        </div>
                        <p class="detail__desc">
                            Mulai tanggal {{ $job->start_at->toFormattedDateString() }}
                        </p>
                    @endif
                    @if($job->end_at)
                        <div class="detail__desc-divider">
                            <svg width="4" height="4" viewBox="0 0 4 4" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2" cy="2" r="2" fill="#D9D9D9"/>
                            </svg>
                        </div>
                        <p class="detail__desc">
                            Selesai tanggal {{ $job->end_at->toFormattedDateString() }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-5 col-md-3">
                <div class="grid">
                    <div class="col-6">
                        @if($job->status === \App\Enums\JobStatusEnum::PUBLISHED)
                            <x-copy-link :url="route('jobs.show', $job)" class="btn btn_outline btn_md btn_full-width">
                                <span class="icon icon-clipboard-document-mini"></span>
                                Salin Link
                            </x-copy-link>
                        @endif
                    </div>
                    <div class="col-6">
                        @can(\App\Enums\PermissionEnum::UPDATE_JOB->value)
                            <x-link href="{{ route('managements.jobs.edit', $job) }}" class="btn btn_outline btn_md">
                                <span class="icon icon-pencil-square-solid"></span>
                                Ubah Data
                            </x-link>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card__body">
                <nav class="nav-tab">
                    <ul class="nav-tab__wrapper">
                        <li @class(['nav-tab__item', 'active' => request()->routeIs('managements.jobs.show')])>
                            <x-link :href="route('managements.jobs.show', $job)">Deskripsi</x-link>
                        </li>
                        @can(\App\Enums\PermissionEnum::VIEW_APPLICATION->value)
                            <li @class([
                                'nav-tab__item', 'active' => request()->routeIs('managements.jobs.applications.index'),
                            ])>
                                <x-link :href="route('managements.jobs.applications.index', $job)">List Pelamar</x-link>
                            </li>
                        @endcan
                    </ul>
                </nav>
            </div>

            {{ $slot }}
        </div>
    </div>
</x-app-layout>
