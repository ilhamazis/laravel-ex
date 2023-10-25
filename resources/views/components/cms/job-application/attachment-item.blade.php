<div class="form-control">
    <div class="attachment">
        <div class="attachment__wrapper">
            <div class="attachment__wrapper-icon">
                <img alt="Attachment Icon"
                     src="{{ asset(\App\Enums\AttachmentExtensionEnum::getIconPath($attachment->file_extension)) }}">
            </div>
            <div class="attachment__wrapper-text">
                <div class="attachment__title">
                    <h3 class="attachment__heading">{{ $attachment->file_name }}</h3>
                    <p class="attachment__description">
                        {{ $attachment->file_size }}KB
                    </p>
                    <p class="attachment__description">
                        Diupload oleh
                        {{ $attachment->createdBy->name ?? 'Pelamar' }}
                    </p>
                </div>

                <div class="attachment__action" style="margin: auto 0">
                    <x-link
                        :href="route('managements.jobs.applications.steps.attachments.show', [
                                   request()->route('job'),
                                   request()->route('application'),
                                   request()->route('step'),
                                   $attachment,
                               ])"
                        class="btn btn_icon btn_outline btn_xs">
                        <span class="icon icon-cloud-arrow-down"></span>
                    </x-link>

                    @can(\App\Enums\PermissionEnum::DELETE_APPLICATION_ATTACHMENT->value)
                        <form
                            action="{{ route('managements.jobs.applications.steps.attachments.destroy', [
                                        request()->route('job'),
                                        request()->route('application'),
                                        request()->route('step'),
                                        $attachment,
                                    ]) }}"
                            method="post"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="button"
                                    class="btn btn_icon btn_outline btn_xs"
                                    data-label="Delete Attachment"
                                    data-toggle="modal"
                                    data-target="#delete-attachment-modal">
                                <span class="icon icon-trash"></span>
                            </button>
                            <x-quantum.modal-confirmation
                                variant="danger"
                                id="delete-attachment-modal"
                                title="Konfirmasi Eliminasi">
                                <x-slot:body>
                                    <p>Apakah anda yakin ingin menghapus lampiran ini?</p>
                                </x-slot:body>

                                <x-slot:footer>
                                    <div class="grid cols-1 cols-sm-2">
                                        <button type="button"
                                                class="btn btn_outline"
                                                data-dismiss="modal">
                                            Batal
                                        </button>
                                        <button type="submit"
                                                class="btn btn_destructive">
                                            Hapus
                                        </button>
                                    </div>
                                </x-slot:footer>
                            </x-quantum.modal-confirmation>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
