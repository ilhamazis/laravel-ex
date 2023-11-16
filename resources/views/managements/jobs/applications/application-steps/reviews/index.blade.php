@php
    $paths = [
        ['title' => 'Lowongan Pekerjaan', 'link' => route('managements.jobs.index')],
        ['title' => $job->title, 'link' => route('managements.jobs.show', $job)],
        ['title' => 'List Pelamar', 'link' => route('managements.jobs.applications.index', $job)],
        ['title' => $application->applicant->name . ' - Review'],
    ];
@endphp

<x-job-application-layout :breadcrumbs="$paths" :job="$job" :application="$application" :attachments="$attachments"
                          :current-application-step="$applicationStep"
                          :application-steps="$applicationSteps" :missing-application-steps="$missingApplicationSteps">
    @can(\App\Enums\PermissionEnum::CREATE_APPLICATION_REVIEW->value)
        @if($applicationStep->status === \App\Enums\ApplicationStepStatusEnum::ONGOING)
            <form
                class="card__body"
                action="{{ route('managements.jobs.applications.steps.reviews.store', [
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
                                Penilaian<span class="important">*</span>
                            </label>
                            <div @class(['form-control__group', 'error' => $errors->has('is_liked')])>
                                <div class="radio-button__group">
                                    <input class="radio-button" type="radio" id="like" name="is_liked" value="1"/>
                                    <label class="like-icon" for="like">
                                        <span class="icon icon-hand-thumb-up-solid"></span>
                                    </label>
                                </div>
                                <div class="radio-button__group">
                                    <input class="radio-button" type="radio" id="dislike" name="is_liked" value="0"/>
                                    <label class="dislike-icon" for="dislike">
                                        <span class="icon icon-hand-thumb-down-solid"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('is_liked')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="form-control">
                            <label for="content" class="form-control__label">
                                Review<span class="important">*</span>
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
                            Buat Review
                        </button>
                    </div>

                    <x-quantum.modal-confirmation id="review-modal" title="Konfirmasi Membuat Review">
                        <x-slot:body>
                            <p>Apakah anda yakin ingin membuat review ini?</p>
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
                        <h2 class="header__title">Review yang telah dibuat</h2>
                    </div>
                </div>
            </div>
        @endif
    @endcan

    <div class="card__body">
        <div class="grid">
            @forelse($reviews as $review)
                <div class="col-12">
                    <div class="review__item">
                        <div class="review__header">
                            <h6 class="review__title">{{ $review->user->name }}</h6>
                            <p class="review__step">Tahap {{ $review->applicationStep->step->name }}</p>
                        </div>
                        <p class="review__description">
                            Dibuat tanggal {{ $review->created_at->isoFormat('lll') }}
                        </p>
                        <div class="radio-button__group" style="margin: 0.5rem 0">
                            @if($review->is_liked)
                                <div class="like-item">
                                    <span class="icon icon-hand-thumb-up-solid"></span>
                                </div>
                            @else
                                <div class="dislike-item">
                                    <span class="icon icon-hand-thumb-down-solid"></span>
                                </div>
                            @endif
                        </div>

                        <x-rich-text-renderer id="{{ 'review-content-' . $loop->index }}" :content="$review->content"/>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <h4>Belum ada review</h4>
                </div>
            @endforelse
        </div>
    </div>
</x-job-application-layout>
