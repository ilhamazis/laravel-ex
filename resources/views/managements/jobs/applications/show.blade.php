@php
    $paths = [
        ['title' => 'Jobs', 'link' => route('managements.jobs.index')],
        ['title' => 'List Pelamar', 'link' => route('managements.jobs.applications.index', $jobSlug)],
        ['title' => 'Detail Pelamar'],
    ];

    $applicationSteps = $application->applicationSteps->map(function (\App\Models\ApplicationStep $applicationStep) {
        return $applicationStep->step->name->value;
    })->toArray();

    $missingSteps = array_diff(\App\Enums\ApplicationStepEnum::values(), $applicationSteps);
@endphp

<x-app-layout>
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-breadcrumb :paths="$paths"/>
            </div>
        </div>

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
                @foreach($application->applicationSteps as $applicationStep)
                    <li @class([
                        'stepper__item',
                        'check' => $applicationStep->status === \App\Enums\ApplicationStepStatusEnum::PASSED,
                        'active' => $applicationStep->status === \App\Enums\ApplicationStepStatusEnum::ONGOING,
                        'fail' => $applicationStep->status === \App\Enums\ApplicationStepStatusEnum::REJECTED,
                    ])>{{ $applicationStep->step->name }}</li>
                @endforeach

                @foreach($missingSteps as $step)
                    <li class="stepper__item">{{ $step }}</li>
                @endforeach
            </ul>
        </div>

        <div class="grid">
            <div class="col-12 col-md-3">
                <button type="submit" class="btn btn_primary btn_full-width">
                    Lanjutkan ke Tahap
                    {{ \App\Enums\ApplicationStepEnum::nextStepFrom($application->currentApplicationStep->step->name) }}
                </button>
            </div>
            <div class="col-12 col-md-1">
                <button type="button" class="btn btn_outline btn_full-width">Eliminasi</button>
            </div>
        </div>

        <div class="card">
            <div class="card__body">
                <nav class="nav-tab">
                    <ul class="nav-tab__wrapper">
                        <li @class(['nav-tab__item', 'active' => route('managements.jobs.applications.show', [$jobSlug, $application])])>
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
</x-app-layout>
