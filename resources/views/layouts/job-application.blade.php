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

        <x-cms.job-application.card-applicant :application="$application" :applicant="$application->applicant"/>

        <x-cms.job-application.stepper
            :job="$job"
            :application="$application"
            :current-application-step="$currentApplicationStep"
            :application-steps="$applicationSteps"
            :missing-application-steps="$missingApplicationSteps"
        />

        <div class="grid">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card__body">
                        <x-quantum.nav-tab>
                            @can(\App\Enums\PermissionEnum::VIEW_APPLICATION_COMMUNICATION->value)
                                <x-quantum.nav-tab-item
                                    :active="url()->current() === route('managements.jobs.applications.steps.show', [
                                                 $job, $application, $currentApplicationStep
                                             ])"
                                >
                                    <x-link
                                        :href="route('managements.jobs.applications.steps.show', [
                                            $job, $application, $currentApplicationStep
                                        ])"
                                    >
                                        Kirim Email
                                    </x-link>
                                </x-quantum.nav-tab-item>
                            @endcan

                            @can(\App\Enums\PermissionEnum::VIEW_APPLICATION_REVIEW->value)
                                <x-quantum.nav-tab-item
                                    :active="request()->routeIs('managements.jobs.applications.steps.reviews.*')"
                                >
                                    <x-link
                                        :href="route('managements.jobs.applications.steps.reviews.index', [
                                            $job, $application, $currentApplicationStep
                                        ])"
                                    >
                                        Review
                                    </x-link>
                                </x-quantum.nav-tab-item>
                            @endcan
                        </x-quantum.nav-tab>
                    </div>

                    {{ $slot }}
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="grid">
                    @can(\App\Enums\PermissionEnum::UPDATE_APPLICATION_STEP->value)
                        @if(
                            \App\Enums\ApplicationStepEnum::mustHaveReview($currentApplicationStep->step->name)
                            && !$currentApplicationStep->hasReviews()
                        )
                            <div class="col-12">
                                <x-quantum.alert variant="helper" font-weight="normal"
                                                 message="Sebelum melanjutkan ke tahap selanjutnya, tahap ini harus memiliki Review"/>
                            </div>
                        @endif

                        @if($application->status === \App\Enums\ApplicationStatusEnum::ONGOING
                            && $application->currentApplicationStep->id === $currentApplicationStep->id)
                            <div class="col-12">
                                <div class="grid cols-1 cols-sm-2">
                                    <button
                                        @disabled(
                                            \App\Enums\ApplicationStepEnum::mustHaveReview($currentApplicationStep->step->name)
                                            && !$currentApplicationStep->hasReviews()
                                        )
                                        class="btn btn_primary btn_full-width" data-label="Lanjutkan"
                                        data-toggle="modal" data-target="#next-step-modal"
                                    >
                                        {{
                                            \App\Enums\ApplicationStepEnum::onLastStep($currentApplicationStep->step->name)
                                                ? 'Rekrut'
                                                : 'Lanjutkan ke Tahap ' . \App\Enums\ApplicationStepEnum::nextStepFrom($currentApplicationStep->step->name)
                                        }}
                                    </button>
                                    <button type="button" class="btn btn_outline btn_full-width" data-label="Eliminasi"
                                            data-toggle="modal" data-target="#reject-modal">
                                        Eliminasi
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endcan

                    @can(\App\Enums\PermissionEnum::VIEW_APPLICATION_ATTACHMENT->value)
                        <div class="col-12">
                            <div class="card">
                                <div class="card__body">
                                    <h2 class="card__title">Lampiran Berkas</h2>

                                    <div class="grid">
                                        @can(\App\Enums\PermissionEnum::CREATE_APPLICATION_ATTACHMENT->value)
                                            <div class="col-12">
                                                <form
                                                    class="grid"
                                                    action="{{ route('managements.jobs.applications.steps.attachments.store', [
                                                        $job, $application, $currentApplicationStep
                                                    ]) }}"
                                                    method="post"
                                                    enctype="multipart/form-data"
                                                >
                                                    @csrf
                                                    @method('POST')

                                                    <div class="col-12">
                                                        <div class="form-control">
                                                            <x-quantum.input-file
                                                                name="file" id="file"
                                                                accept="application/pdf,.doc,.docx"
                                                                support="DOC, DOCX, atau PDF (max. 2MB)"
                                                            />

                                                            @error('file')
                                                            <div class="form-control__helper error">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="button" class="btn btn_primary btn_full-width"
                                                                data-label="Upload"
                                                                data-toggle="modal"
                                                                data-target="#create-attachment-modal">
                                                            Unggah Lampiran
                                                        </button>
                                                    </div>

                                                    <x-quantum.modal-confirmation id="create-attachment-modal"
                                                                                  title="Konfirmasi Unggah Lampiran">
                                                        <x-slot:body>
                                                            <p>Apakah anda yakin ingin mengunggah lampiran?</p>
                                                        </x-slot:body>

                                                        <x-slot:footer>
                                                            <div class="grid cols-1 cols-sm-2">
                                                                <button type="button" class="btn btn_outline"
                                                                        data-dismiss="modal">
                                                                    Batal
                                                                </button>
                                                                <button type="submit" class="btn btn_primary">
                                                                    Konfirmasi
                                                                </button>
                                                            </div>
                                                        </x-slot:footer>
                                                    </x-quantum.modal-confirmation>
                                                </form>
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
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <x-quantum.modal-confirmation id="next-step-modal" title="Konfirmasi Melanjutkan Tahap">
        <x-slot:body>
            <p>Apakah anda yakin ingin melanjutkan kandidat ini ke tahap selanjutnya?</p>
            <p>Aksi ini tidak dapat dikembalikan.</p>
        </x-slot:body>

        <x-slot:footer>
            <div class="grid cols-1 cols-sm-2">
                <button class="btn btn_outline" data-dismiss="modal">Batal</button>
                <form
                    action="{{ route('managements.jobs.applications.steps.update', [
                        $job, $application, $currentApplicationStep
                    ]) }}"
                    method="post">
                    @csrf
                    @method('PUT')

                    <button type="submit" class="btn btn_primary" style="width: 100%">Konfirmasi</button>
                </form>
            </div>
        </x-slot:footer>
    </x-quantum.modal-confirmation>

    <x-quantum.modal-confirmation variant="danger" id="reject-modal" title="Konfirmasi Eliminasi">
        <x-slot:body>
            <p>Apakah anda yakin ingin mengeliminasi kandidat ini?</p>
            <p>Kandidat yang telah tereliminasi tidak dapat dikembalikan lagi.</p>
        </x-slot:body>

        <x-slot:footer>
            <div class="grid cols-1 cols-sm-2">
                <button class="btn btn_outline" data-dismiss="modal">Batal</button>
                <form
                    action="{{ route('managements.jobs.applications.steps.destroy', [
                        $job, $application, $currentApplicationStep
                    ]) }}"
                    method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn_destructive" style="width: 100%">Eliminasi</button>
                </form>
            </div>
        </x-slot:footer>
    </x-quantum.modal-confirmation>
</x-app-layout>
