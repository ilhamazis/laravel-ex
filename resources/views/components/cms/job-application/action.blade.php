@if(
    \App\Enums\ApplicationStepEnum::mustHaveReview($applicationStep->step->name)
    && !$applicationStep->hasReviews()
)
    <x-quantum.alert variant="helper" font-weight="normal"
                     message="Sebelum melanjutkan ke tahap selanjutnya, tahap ini harus memiliki Review"/>
@endif

@if($application->status === \App\Enums\ApplicationStatusEnum::ONGOING
    && $application->currentApplicationStep->id === $applicationStep->id)
    <div class="grid cols-1 cols-sm-2">
        <button
            @disabled(
                \App\Enums\ApplicationStepEnum::mustHaveReview($applicationStep->step->name)
                && !$applicationStep->hasReviews()
            )
            class="btn btn_primary btn_full-width" data-label="Lanjutkan"
            data-toggle="modal" data-target="#next-step-modal"
        >
            {{
                \App\Enums\ApplicationStepEnum::onLastStep($applicationStep->step->name)
                    ? 'Rekrut'
                    : 'Lanjutkan ke Tahap '
                        . \App\Enums\ApplicationStepEnum::nextStepFrom($applicationStep->step->name)
            }}
        </button>
        <button type="button" class="btn btn_outline btn_full-width" data-label="Eliminasi"
                data-toggle="modal" data-target="#reject-modal">
            Eliminasi
        </button>
    </div>
@endif
