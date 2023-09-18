@php
    $paths = [
        ['title' => 'Jobs', 'link' => route('managements.jobs.index')],
        ['title' => 'Detail Job'],
    ];
@endphp

<x-app-layout>
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-breadcrumb :paths="$paths"/>
            </div>
        </div>

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
                        By {{ $job->created_by_user->name }}
                    </p>
                    <div class="detail__desc-divider">
                        <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="2" cy="2" r="2" fill="#D9D9D9"/>
                        </svg>
                    </div>
                    <p class="detail__desc">
                        {{ $job->type }}
                    </p>
                    <div class="detail__desc-divider">
                        <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="2" cy="2" r="2" fill="#D9D9D9"/>
                        </svg>
                    </div>
                    <p class="detail__desc">
                        Created on {{ $job->created_at->toFormattedDateString() }}
                    </p>
                    @if($job->end_at)
                        <div class="detail__desc-divider">
                            <svg width="4" height="4" viewBox="0 0 4 4" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2" cy="2" r="2" fill="#D9D9D9"/>
                            </svg>
                        </div>
                        <p class="detail__desc">
                            End at {{ $job->end_at->toFormattedDateString() }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-5 col-md-3">
                <div class="grid">
                    <div class="col-6">
                        <x-link href="{{ route('managements.jobs.edit', $job) }}" class="btn btn_outline btn_md">
                            <span class="icon icon-pencil-square-solid"></span>
                            Edit Job
                        </x-link>
                    </div>
                    <div class="col-6">
                        <x-copy-link class="btn btn_outline btn_md btn_full-width">
                            <span class="icon icon-share-solid"></span>
                            Copy Link
                        </x-copy-link>
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
                        <li @class(['nav-tab__item', 'active' => false])>
                            <x-link href="#">Data Jobseeker</x-link>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="card__body">
                {!! $job->description !!}
            </div>
        </div>
    </div>
</x-app-layout>