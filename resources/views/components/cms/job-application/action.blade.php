@if($application->status === \App\Enums\ApplicationStatusEnum::ONGOING
    && $application->currentApplicationStep->id === $applicationStep->id)
    @if(
        \App\Enums\ApplicationStepEnum::mustHaveReview($applicationStep->step->name)
        && !$applicationStep->hasReviews()
    )
        <x-quantum.alert variant="helper" font-weight="normal"
                         message="Sebelum melanjutkan ke tahap selanjutnya, tahap ini harus memiliki Review"/>
    @endif
    
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
                                request()->route('job'), request()->route('application'), $applicationStep
                            ]) }}"
                    method="post">
                    @csrf
                    @method('PUT')

                    <button type="submit" class="btn btn_primary btn_full-width">Konfirmasi</button>
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
                                request()->route('job'), request()->route('application'), $applicationStep
                            ]) }}"
                    method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn_destructive btn_full-width">Eliminasi</button>
                </form>
            </div>
        </x-slot:footer>
    </x-quantum.modal-confirmation>
@endif
