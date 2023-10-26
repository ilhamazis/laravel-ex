<div class="grid">
    <div class="col-6">
        @if($job->status === \App\Enums\JobStatusEnum::PUBLISHED)
            <x-copy-link :url="route('jobs.show', $job)"
                         class="btn btn_outline btn_md btn_full-width">
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
