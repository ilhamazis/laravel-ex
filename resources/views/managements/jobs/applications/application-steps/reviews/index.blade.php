@php
    $paths = [
        ['title' => 'Jobs', 'link' => route('managements.jobs.index')],
        ['title' => $job->title, 'link' => route('managements.jobs.show', $job)],
        ['title' => 'List Pelamar', 'link' => route('managements.jobs.applications.index', $job)],
        [
            'title' => $application->applicant->name,
            'link' => route('managements.jobs.applications.steps.show', [$job, $application, $applicationStep])
        ],
        ['title' => 'Review'],
    ];
@endphp

<x-job-application-layout :breadcrumbs="$paths" :job="$job" :application="$application"
                          :current-application-step="$applicationStep"
                          :application-steps="$applicationSteps" :missing-application-steps="$missingApplicationSteps">
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
                        <label class="form-control__label">
                            Rating<span class="important">*</span>
                        </label>
                        <div @class(['form-control__group', 'error' => $errors->has('rating')])>
                            <div class="rating__group">
                                <label aria-label="1 star" class="rating__label" for="rating-1">
                                    <span class="rating__icon"></span>
                                </label>
                                <input checked class="rating__input" name="rating" id="rating-1" value="1" type="radio">

                                <label aria-label="2 stars" class="rating__label" for="rating-2">
                                    <span class="rating__icon"></span>
                                </label>
                                <input class="rating__input" name="rating" id="rating-2" value="2" type="radio">

                                <label aria-label="3 stars" class="rating__label" for="rating-3">
                                    <span class="rating__icon"></span>
                                </label>
                                <input class="rating__input" name="rating" id="rating-3" value="3" type="radio">

                                <label aria-label="4 stars" class="rating__label" for="rating-4">
                                    <span class="rating__icon"></span>
                                </label>
                                <input class="rating__input" name="rating" id="rating-4" value="4" type="radio">

                                <label aria-label="5 stars" class="rating__label" for="rating-5">
                                    <span class="rating__icon"></span>
                                </label>
                                <input class="rating__input" name="rating" id="rating-5" value="5" type="radio" checked>
                            </div>
                        </div>
                        @error('rating')
                        <div class="form-control__helper error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-control">
                        <label for="content" class="form-control__label">
                            Review<span class="important">*</span>
                        </label>
                        <x-quill id="contentQuill">{!! old('content') !!}</x-quill>
                        <textarea id="content" name="content"
                                  style="display: none">{!! old('content') !!}</textarea>
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

                <x-modal-confirmation id="review-modal" title="Konfirmasi Membuat Review">
                    <x-slot:body>
                        <p>Apakah anda yakin ingin membuat review ini?</p>
                    </x-slot:body>

                    <x-slot:footer>
                        <div class="grid cols-1 cols-sm-2">
                            <button type="button" class="btn btn_outline" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn_primary">Konfirmasi</button>
                        </div>
                    </x-slot:footer>
                </x-modal-confirmation>
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

    <div class="card__body">
        <div class="grid">
            @forelse($reviews as $review)
                <div class="col-12">
                    <div class="review__item">
                        <h6 class="review__title">{{ $review->user->name }}</h6>
                        <p class="review__description">Created on {{ $review->created_at->toFormattedDateString() }}</p>
                        <div class="rating__group" style="padding: 0.5rem 0">
                            @for($i = 1; $i <= $review->rating; $i++)
                                <span class="rating__icon-checked"></span>
                            @endfor

                            @for($i = 1; $i <= 5 - $review->rating; $i++)
                                <span class="rating__icon-unchecked"></span>
                            @endfor
                        </div>

                        <div class="custom__ql-container">
                            {!! $review->content !!}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <h4>Belum ada review</h4>
                </div>
            @endforelse
        </div>
    </div>

    @push('custom-scripts')
        <script>
            const contentQuill = document.querySelector('#contentQuill .ql-editor');
            const contentTextarea = document.querySelector('#content');

            contentQuill.addEventListener('DOMSubtreeModified', () => {
                contentTextarea.innerHTML = contentQuill.innerHTML;
            });
        </script>
    @endpush
</x-job-application-layout>
