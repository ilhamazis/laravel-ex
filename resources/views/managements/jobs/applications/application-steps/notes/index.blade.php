@php
    $paths = [
        ['title' => 'Lowongan Pekerjaan', 'link' => route('managements.jobs.index')],
        ['title' => $job->title, 'link' => route('managements.jobs.show', $job)],
        ['title' => 'List Pelamar', 'link' => route('managements.jobs.applications.index', $job)],
        [
            'title' => $application->applicant->name,
            'link' => route('managements.jobs.applications.steps.show', [$job, $application, $applicationStep])
        ],
        ['title' => 'Catatan']
    ];
@endphp

<x-job-application-layout :breadcrumbs="$paths" :job="$job" :application="$application" :attachments="$attachments"
                          :current-application-step="$applicationStep"
                          :application-steps="$applicationSteps" :missing-application-steps="$missingApplicationSteps">
    @can(\App\Enums\PermissionEnum::CREATE_APPLICATION_NOTE->value)
        @if($applicationStep->status === \App\Enums\ApplicationStepStatusEnum::ONGOING)
            <form
                class="card__body"
                action="{{ route('managements.jobs.applications.steps.notes.store', [
                    $job, $application, $applicationStep
                ]) }}"
                method="post"
            >
                @csrf
                @method('POST')

                <div class="grid">
                    <div class="col-12">
                        <div class="form-control">
                            <label for="content" class="form-control__label">
                                Isi Catatan<span class="important">*</span>
                            </label>
                            <x-quantum.rich-text-editor id="content" name="content"
                                                        :value="old('content')"/>
                            @error('content')
                            <div class="form-control__helper error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="button" class="btn btn_primary btn_full-width"
                                data-label="Buat Review" data-toggle="modal" data-target="#review-modal">
                            Buat Catatan
                        </button>
                    </div>

                    <x-quantum.modal-confirmation id="review-modal" title="Konfirmasi Membuat Review">
                        <x-slot:body>
                            <p>Apakah anda yakin ingin membuat catatan ini?</p>
                        </x-slot:body>

                        <x-slot:footer>
                            <div class="grid cols-1 cols-sm-2">
                                <button type="button" class="btn btn_outline" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn_primary">Konfirmasi</button>
                            </div>
                        </x-slot:footer>
                    </x-quantum.modal-confirmation>
                </div>
            </form>

            <div class="card__header" style="padding-top: 2rem">
                <div class="card__header-left">
                    <div class="card__header-icon">
                        <span class="icon icon-cube-solid"></span>
                    </div>
                    <div class="card__header-block">
                        <h2 class="header__title">Catatan yang telah dibuat</h2>
                    </div>
                </div>
            </div>
        @endif
    @endcan

    <div class="card__body">
        <div class="grid">
            @forelse($notes as $note)
                <div class="col-12">
                    <div class="review__item">
                        <div class="review__header">
                            <h6 class="review__title">{{ $note->user->name }}</h6>
                            <p class="review__step">Tahap {{ $note->applicationStep->step->name }}</p>
                        </div>
                        <p class="review__description">
                            Dibuat tanggal {{ $note->created_at->toFormattedDateString() }}
                        </p>
                        <div style="padding: 1rem 0">
                            <x-rich-text-renderer id="{{ 'note-content-' . $loop->index }}" :content="$note->content"/>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <h4>Belum ada catatan</h4>
                </div>
            @endforelse
        </div>
    </div>
</x-job-application-layout>
