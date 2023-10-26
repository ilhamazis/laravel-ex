<div class="card">
    <div class="card__body">
        <h2 class="card__title">Lampiran Berkas</h2>

        <div class="grid cols-1">
            @can(\App\Enums\PermissionEnum::CREATE_APPLICATION_ATTACHMENT->value)
                <x-cms.job-application.attachment-form/>
            @endcan

            @foreach($attachments as $attachment)
                <x-cms.job-application.attachment-item :attachment="$attachment"/>
            @endforeach
        </div>
    </div>
</div>
