@php
    $paths = [
        ['title' => 'Jobs', 'link' => route('managements.jobs.index')],
        ['title' => 'List Pelamar', 'link' => route('managements.jobs.applications.index', $jobSlug)],
        ['title' => 'Detail Pelamar'],
    ];
@endphp

<x-app-layout>
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-breadcrumb :paths="$paths"/>
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
                                     {{
                                        $application->salary_before
                                            ? 'Rp ' . number_format($application->salary_before, decimal_separator: ',', thousands_separator: '.') . ',-'
                                            : '-'
                                     }}
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row-data">
                                <label class="row-data__name">Gaji yang Diharapkan</label>
                                <span class="row-data__value">
                                    <span class="row-data__colon">:</span>
                                     {{
                                        $application->salary_expected
                                            ? 'Rp ' . number_format($application->salary_expected, decimal_separator: ',', thousands_separator: '.') . ',-'
                                            : '-'
                                     }}
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
                        'active' => url()->current() === route('managements.jobs.applications.steps.show', [$jobSlug, $application, $applicationStep]),
                    ])>
                        @if($applicationStep->id === $currentApplicationStep->id)
                            {{ $applicationStep->step->name }}
                        @else
                            <x-link
                                :href="route('managements.jobs.applications.steps.show', [$jobSlug, $application, $applicationStep])"
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
                                <li @class(['nav-tab__item', 'active' => route('managements.jobs.applications.steps.show', [$jobSlug, $application, $currentApplicationStep])])>
                                    <x-link href="#">Kirim Email</x-link>
                                </li>
                                <li @class(['nav-tab__item', 'active' => false])>
                                    <x-link href="#">Reviews</x-link>
                                </li>
                                <li @class(['nav-tab__item', 'active' => false])>
                                    <x-link href="#">Notes</x-link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="grid">
                    @if($application->status === \App\Enums\ApplicationStatusEnum::ONGOING && $application->currentApplicationStep->id === $currentApplicationStep->id)
                        <div class="col-12">
                            <div class="grid cols-1 cols-sm-2">
                                <button class="btn btn_primary btn_full-width" data-label="Lanjutkan"
                                        data-toggle="modal" data-target="#next-step-modal">
                                    @if(\App\Enums\ApplicationStepEnum::onLastStep($currentApplicationStep->step->name))
                                        Rekrut
                                    @else
                                        Lanjutkan ke Tahap
                                        {{ \App\Enums\ApplicationStepEnum::nextStepFrom($currentApplicationStep->step->name) }}
                                    @endif
                                </button>
                                <button type="button" class="btn btn_outline btn_full-width" data-label="Eliminasi"
                                        data-toggle="modal" data-target="#reject-modal">
                                    Eliminasi
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="col-12">
                        <div class="card">
                            <div class="card__body">
                                <h2 class="card__title">Lampiran Berkas</h2>

                                <div class="grid">
                                    <div class="col-12">
                                        <div class="form-control">
                                            <div class="upload-draggable">
                                                <div class="upload-draggable__box">
                                                    <input type="file" class="upload-draggable__file-input"
                                                           name="files[]" id=""
                                                           accept="application/pdf,.ppt,.pptx,.doc,.docx,.xlsx,.xls,.zip, image/*,.mp4,.mbz,.txt,.myo,.rar"/>
                                                    <label class="upload-draggable__icon"><span
                                                            class="icon icon-cloud-arrow-up"></span></label>
                                                    <h2 class="upload-draggable__title">Klik untuk pilih file</h2>
                                                    <p class="upload-draggable__subtitle">atau seret file ke sini</p>
                                                    <p class="upload-draggable__support">SVG, PNG, JPG atau GIF (max.
                                                        800x400px)</p>
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
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-control">
                                            <div class="attachment">
                                                <div class="attachment__wrapper">
                                                    <div class="attachment__wrapper-icon">
                                                        <img
                                                            src="{{ asset('/quantum-v2.0.0-202307280002/assets/images/misc-icons/file-document/doc-solid.svg') }}">
                                                    </div>
                                                    <div class="attachment__wrapper-text">
                                                        <div class="attachment__title">
                                                            <h3 class="attachment__heading">Customers_Q4_Report.doc</h3>
                                                            <span class="attachment__description">440KB</span>
                                                        </div>
                                                        <div class="attachment__action">
                                                            <button type="button"
                                                                    class="btn btn_icon btn_outline btn_xs">
                                                                <span class="icon icon-cloud-arrow-down"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn_icon btn_outline btn_xs">
                                                                <span class="icon icon-trash"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-control">
                                            <div class="attachment">
                                                <div class="attachment__wrapper">
                                                    <div class="attachment__wrapper-icon">
                                                        <img
                                                            src="{{ asset('/quantum-v2.0.0-202307280002/assets/images/misc-icons/file-document/pdf-solid.svg') }}">
                                                    </div>
                                                    <div class="attachment__wrapper-text">
                                                        <div class="attachment__title">
                                                            <h3 class="attachment__heading">Customers_Q4_Report.pdf</h3>
                                                            <span class="attachment__description">440KB</span>
                                                        </div>
                                                        <div class="attachment__action">
                                                            <button type="button"
                                                                    class="btn btn_icon btn_outline btn_xs">
                                                                <span class="icon icon-cloud-arrow-down"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn_icon btn_outline btn_xs">
                                                                <span class="icon icon-trash"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    action="{{ route('managements.jobs.applications.steps.update', [$jobSlug, $application, $currentApplicationStep]) }}"
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
                    action="{{ route('managements.jobs.applications.steps.destroy', [$jobSlug, $application, $currentApplicationStep]) }}"
                    method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn_destructive" style="width: 100%">Eliminasi</button>
                </form>
            </div>
        </x-slot:footer>
    </x-modal-confirmation>
</x-app-layout>
