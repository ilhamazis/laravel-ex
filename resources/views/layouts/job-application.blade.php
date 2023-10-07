<x-app-layout>
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-breadcrumb :paths="$breadcrumbs"/>
            </div>
        </div>

        <x-alert variant="success" :message="session()->get('success')" dismissable/>

        @error('status')
        <x-alert variant="error" :message="$message" dismissable/>
        @enderror

        <div class="card card_details-primary">
            <div class="grid">
                <div class="col-12 col-md-6">
                    <div class="grid">
                        <div class="col-12">
                            <div class="row-data">
                                <label class="row-data__name">Nama Lengkap</label>
                                <span class="row-data__value">
                                    <span class="row-data__colon">:</span>
                                    {{ $application->applicant->name }}
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row-data">
                                <label class="row-data__name">Email</label>
                                <span class="row-data__value">
                                    <span class="row-data__colon">:</span>
                                    {{ $application->applicant->email }}
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row-data">
                                <label class="row-data__name">Nomor Telepon</label>
                                <span class="row-data__value">
                                    <span class="row-data__colon">:</span>
                                    {{ $application->applicant->telephone }}
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row-data">
                                <label class="row-data__name">Umur</label>
                                <span class="row-data__value">
                                    <span class="row-data__colon">:</span>
                                    {{ $application->applicant->age }} tahun
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="grid">
                        <div class="col-12">
                            <div class="row-data">
                                <label class="row-data__name">Alamat</label>
                                <span class="row-data__value">
                                    <span class="row-data__colon">:</span>
                                    {{ $application->applicant->address }}
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row-data">
                                <label class="row-data__name">Pendidikan Terakhir</label>
                                <span class="row-data__value">
                                    <span class="row-data__colon">:</span>
                                    {{ $application->applicant->education }}
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row-data">
                                <label class="row-data__name">Universitas/Sekolah</label>
                                <span class="row-data__value">
                                    <span class="row-data__colon">:</span>
                                    {{ $application->applicant->school }}
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row-data">
                                <label class="row-data__name">Status</label>
                                <span class="row-data__value">
                                    <span class="row-data__colon">:</span>
                                    {{ $application->applicant->is_married ? 'Sudah Menikah' : 'Belum Menikah' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="grid">
                        <div class="col-12">
                            <div class="row-data">
                                <label class="row-data__name">Pengalaman Kerja</label>
                                <span class="row-data__value">
                                    <span class="row-data__colon">:</span>
                                    {{ $application->applicant->experience }} tahun
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row-data">
                                <label class="row-data__name">Gaji Sebelumnya</label>
                                <span class="row-data__value">
                                    <span class="row-data__colon">:</span>
                                     {{ $application->salary_before }}
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row-data">
                                <label class="row-data__name">Gaji yang Diharapkan</label>
                                <span class="row-data__value">
                                    <span class="row-data__colon">:</span>
                                     {{ $application->salary_expected }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid cols-1" style="overflow-x: auto; padding: 1.5rem 0">
            <ul class="stepper">
                @foreach($applicationSteps as $applicationStep)
                    <li @class([
                        'stepper__item',
                        'check' => $applicationStep->status === \App\Enums\ApplicationStepStatusEnum::PASSED,
                        'current' => $applicationStep->status === \App\Enums\ApplicationStepStatusEnum::ONGOING,
                        'fail' => $applicationStep->status === \App\Enums\ApplicationStepStatusEnum::REJECTED,
                        'active' => str_contains(
                                        url()->current(),
                                        route('managements.jobs.applications.steps.show', [
                                            $job, $application, $applicationStep
                                        ]),
                                    ),
                    ])>
                        @if($applicationStep->id === $currentApplicationStep->id)
                            {{ $applicationStep->step->name }}
                        @else
                            <x-link
                                :href="route('managements.jobs.applications.steps.show', [
                                    $job, $application, $applicationStep
                                ])"
                                class="stepper__link">{{ $applicationStep->step->name }}</x-link>
                        @endif
                    </li>
                @endforeach

                @foreach($missingApplicationSteps as $applicationStep)
                    <li class="stepper__item">{{ $applicationStep }}</li>
                @endforeach
            </ul>
        </div>

        <div class="grid">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card__body">
                        <nav class="nav-tab">
                            <ul class="nav-tab__wrapper">
                                <li @class([
                                        'nav-tab__item',
                                        'active' => url()->current() ===
                                                    route('managements.jobs.applications.steps.show', [
                                                        $job, $application, $currentApplicationStep
                                                    ])
                                    ])
                                >
                                    <x-link
                                        :href="route('managements.jobs.applications.steps.show', [
                                            $job, $application, $currentApplicationStep
                                        ])"
                                    >
                                        Kirim Email
                                    </x-link>
                                </li>
                                @can(\App\Enums\PermissionEnum::VIEW_APPLICATION_REVIEW->value)
                                    <li @class([
                                        'nav-tab__item',
                                        'active' => request()->routeIs('managements.jobs.applications.steps.reviews.*'),
                                    ])>
                                        <x-link
                                            :href="route('managements.jobs.applications.steps.reviews.index', [
                                            $job, $application, $currentApplicationStep
                                        ])"
                                        >
                                            Review
                                        </x-link>
                                    </li>
                                @endcan
                            </ul>
                        </nav>
                    </div>

                    {{ $slot }}
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="grid">
                    @if(!$currentApplicationStep->hasReviews())
                        <div class="col-12">
                            <x-alert variant="helper" font-weight="normal"
                                     message="Sebelum melanjutkan ke tahap selanjutnya, tahap ini harus memiliki Review"/>
                        </div>
                    @endif

                    @can(\App\Enums\PermissionEnum::UPDATE_APPLICATION_STEP->value)
                        @if($application->status === \App\Enums\ApplicationStatusEnum::ONGOING
                            && $application->currentApplicationStep->id === $currentApplicationStep->id)
                            <div class="col-12">
                                <div class="grid cols-1 cols-sm-2">
                                    <button @disabled(!$currentApplicationStep->hasReviews())
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
                                                            <div class="upload-draggable">
                                                                <div class="upload-draggable__box">
                                                                    <input type="file"
                                                                           class="upload-draggable__file-input"
                                                                           name="file" id="file"
                                                                           accept="application/pdf,.doc,.docx"/>
                                                                    <label class="upload-draggable__icon"><span
                                                                            class="icon icon-cloud-arrow-up"></span></label>
                                                                    <h2 class="upload-draggable__title">Klik untuk pilih
                                                                        file</h2>
                                                                    <p class="upload-draggable__subtitle">atau seret
                                                                        file ke
                                                                        sini</p>
                                                                    <p class="upload-draggable__support">
                                                                        DOC, DOCX, atau PDF (max. 2MB)
                                                                    </p>
                                                                </div>
                                                                <div class="upload-draggable__uploading">
                                                                    <span class="loader"></span> sedang memuat...
                                                                </div>
                                                                <div class="upload-draggable__success">
                                                                    Berhasil
                                                                </div>
                                                                <div class="upload-draggable__error">
                                                                    Gagal
                                                                </div>
                                                            </div>
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
                                                            Upload Lampiran
                                                        </button>
                                                    </div>

                                                    <x-modal-confirmation id="create-attachment-modal"
                                                                          title="Konfirmasi Upload Lampiran">
                                                        <x-slot:body>
                                                            <p>Apakah anda yakin ingin meng-upload lampiran?</p>
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
                                                    </x-modal-confirmation>
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
                                                                    <span
                                                                        class="attachment__description">{{ $attachment->file_size }}KB</span>
                                                                </div>
                                                                <div class="attachment__action">
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
                                                                            <x-modal-confirmation variant="danger"
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
                                                                            </x-modal-confirmation>
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

    <x-modal-confirmation id="next-step-modal" title="Konfirmasi Melanjutkan Tahap">
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
    </x-modal-confirmation>

    <x-modal-confirmation variant="danger" id="reject-modal" title="Konfirmasi Eliminasi">
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
    </x-modal-confirmation>
</x-app-layout>
