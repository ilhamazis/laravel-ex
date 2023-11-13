<div x-data="{ attachmentPreviewUrl: null }" class="card">
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

    <x-quantum.modal-confirmation
        id="preview-attachment-modal"
        title="Preview Lampiran Berkas">
        <x-slot:body>
            <iframe title="Preview Attachment"
                    x-bind:src="attachmentPreviewUrl"
                    style="width: 100%; height: 450px"></iframe>
        </x-slot:body>

        <x-slot:footer>
            <div class="grid cols-1">
                <button type="button"
                        class="btn btn_outline"
                        data-dismiss="modal">
                    Tutup
                </button>
            </div>
        </x-slot:footer>
    </x-quantum.modal-confirmation>
</div>

@once
    @push('scripts')
        @livewireScripts
    @endpush
@endonce
