<div class="grid">
    <div class="col-12">
        <div style="display: flex; gap: 0.5rem">
            <x-quantum.badge :variant="\App\Enums\JobStatusEnum::getBadgeVariant($job->status)">
                {{ $job->status }}
            </x-quantum.badge>

            <x-quantum.badge variant="badge_secondary-default">
                <span class="icon icon-clipboard-document-list-solid"></span>
                {{ $job->quota }} Kuota
            </x-quantum.badge>

            <x-quantum.badge variant="badge_secondary-default">
                <span class="icon icon-clipboard-document-check-solid"></span>
                {{ $job->applications_count }} Pelamar
            </x-quantum.badge>
        </div>
    </div>

    <div class="col-12 col-sm-7 col-md-9">
        <h2>{{ $job->title }}</h2>
        <div class="detail__desc-wrapper">
            <p class="detail__desc">
                Dibuat oleh {{ $job->createdBy->name }}
            </p>
            <span class="detail__desc-divider"></span>
            <p class="detail__desc">
                {{ $job->type }}
            </p>
            <span class="detail__desc-divider"></span>
            <p class="detail__desc">
                {{ $job->location }}
            </p>
            @if($job->start_at && is_null($job->end_at))
                <span class="detail__desc-divider"></span>
                <p class="detail__desc">
                    Aktif sejak {{ $job->start_at->toFormattedDateString() }}
                </p>
            @elseif(is_null($job->start_at) && $job->end_at)
                <span class="detail__desc-divider"></span>
                <p class="detail__desc">
                    Berakhir tanggal {{ $job->end_at->toFormattedDateString() }}
                </p>
            @elseif($job->start_at && $job->end_at)
                <span class="detail__desc-divider"></span>
                <p class="detail__desc">
                    {{ $job->start_at->toFormattedDateString() }}
                    -
                    {{ $job->end_at->toFormattedDateString() }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-12 col-sm-5 col-md-3">
        <x-cms.job.action :job="$job"/>
    </div>
</div>
