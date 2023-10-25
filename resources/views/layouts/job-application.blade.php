<x-app-layout>
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-quantum.breadcrumb :paths="$breadcrumbs"/>
            </div>
        </div>

        <x-quantum.alert variant="success" :message="session()->get('success')" dismissable/>

        @error('status')
        <x-quantum.alert variant="error" :message="$message" dismissable/>
        @enderror

        <x-cms.job-application.card-applicant
            :application="$application"
            :applicant="$application->applicant"
        />

        <x-cms.job-application.stepper
            :current-application-step="$currentApplicationStep"
            :application-steps="$applicationSteps"
            :missing-application-steps="$missingApplicationSteps"
        />

        <div class="grid">
            <div class="col-12 col-md-8">
                <div class="card">
                    <x-cms.job-application.card-navigation/>

                    {{ $slot }}
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="grid cols-1">
                    @can(\App\Enums\PermissionEnum::UPDATE_APPLICATION_STEP->value)
                        <x-cms.job-application.action
                            :application="$application"
                            :application-step="$currentApplicationStep"
                        />
                    @endcan

                    @can(\App\Enums\PermissionEnum::VIEW_APPLICATION_ATTACHMENT->value)
                        <div class="card">
                            <div class="card__body">
                                <h2 class="card__title">Lampiran Berkas</h2>

                                <div class="grid">
                                    @can(\App\Enums\PermissionEnum::CREATE_APPLICATION_ATTACHMENT->value)
                                        <div class="col-12">
                                            <x-cms.job-application.attachment-form/>
                                        </div>
                                    @endcan

                                    @foreach($attachments as $attachment)
                                        <div class="col-12">
                                            <div class="form-control">
                                                <div class="attachment">
                                                    <div class="attachment__wrapper">
                                                        <div class="attachment__wrapper-icon">
                                                            @switch($attachment->file_extension)
                                                                @case('doc')
                                                                    <img alt="DOC Icon"
                                                                         src="{{ asset('/quantum-v2.0.0-202307280002/assets/images/misc-icons/file-document/doc-solid.svg') }}">
                                                                    @break
                                                                @case('docx')
                                                                    <img alt="DOCX Icon"
                                                                         src="{{ asset('/quantum-v2.0.0-202307280002/assets/images/misc-icons/file-document/docx-solid.svg') }}">
                                                                    @break
                                                                @case('pdf')
                                                                    <img alt="PDF Icon"
                                                                         src="{{ asset('/quantum-v2.0.0-202307280002/assets/images/misc-icons/file-document/pdf-solid.svg') }}">
                                                                    @break
                                                                @default
                                                                    <img alt="TXT Icon"
                                                                         src="{{ asset('/quantum-v2.0.0-202307280002/assets/images/misc-icons/file-document/txt-solid.svg') }}">
                                                            @endswitch
                                                        </div>
                                                        <div class="attachment__wrapper-text">
                                                            <div class="attachment__title">
                                                                <h3 class="attachment__heading">{{ $attachment->file_name }}</h3>
                                                                <p
                                                                    class="attachment__description">
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
                                                                            $job, $application, $currentApplicationStep, $attachment
                                                                        ])"
                                                                    class="btn btn_icon btn_outline btn_xs">
                                                                    <span class="icon icon-cloud-arrow-down"></span>
                                                                </x-link>
                                                                @can(\App\Enums\PermissionEnum::DELETE_APPLICATION_ATTACHMENT->value)
                                                                    <form
                                                                        action="{{ route('managements.jobs.applications.steps.attachments.destroy', [
                                                                                $job, $application, $currentApplicationStep, $attachment
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
                                                                                <p>Apakah anda yakin ingin menghapus
                                                                                    lampiran ini?</p>
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
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
