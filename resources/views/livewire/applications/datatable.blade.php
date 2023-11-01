<div class="card card_table">
    <div class="card__body">
        <div class="grid" style="grid-row-gap: 1.25rem; padding: 1rem">
            <div class="col-12 col-sm-4">
                <div class="form-control">
                    <label for="search" class="form-control__label">Cari</label>
                    <div class="form-control__group">
                        <span data-input-icon="search"></span>
                        <x-quantum.input wire:model.live.debounce.500ms="query" type="search"
                                         id="search" placeholder="Cari nama pelamar..."/>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-3 col-md-2">
                <div class="form-control">
                    <label for="step" class="form-control__label">Tahap Rekrutmen</label>
                    <x-quantum.select
                        wire:change="$dispatch('changeSelect', { field: 'step', value: $event.target.value })"
                        variant="single-search" id="step" placeholder="Cari tahap rekrutmen...">
                        <option @selected(is_null($step)) disabled>Tahap Rekrutmen</option>
                        @foreach(\App\Enums\ApplicationStepEnum::values() as $stepEnum)
                            <option
                                @selected($step === $stepEnum) value="{{ $stepEnum }}">{{ $stepEnum }}</option>
                        @endforeach
                    </x-quantum.select>
                </div>
            </div>

            <div class="col-12 col-sm-3 col-md-2">
                <div class="form-control">
                    <label for="step" class="form-control__label">Status Rekrutmen</label>
                    <x-quantum.select
                        wire:change="$dispatch('changeSelect', { field: 'status', value: $event.target.value })"
                        variant="single-search" id="step" placeholder="Cari status rekrutmen...">
                        <option @selected(is_null($status)) disabled>Status Rekrutmen</option>
                        @foreach(\App\Enums\ApplicationStatusEnum::values() as $statusEnum)
                            <option
                                @selected($status === $statusEnum) value="{{ $statusEnum }}">{{ $statusEnum }}</option>
                        @endforeach
                    </x-quantum.select>
                </div>
            </div>
        </div>

        <x-quantum.alert variant="success" style="padding: 1rem" :message="session()->get('success')"
                         dismissable/>

        <div class="custom__data-list">
            @foreach($applications as $application)
                <div class="custom__data-item">
                    <div class="custom__data-detail">
                        <h3 class="custom__data-title">{{ $application->applicant->name }}</h3>
                        <p class="custom__data-desc">{{ $application->job->title }}</p>
                        <div class="custom__data-info-wrapper">
                            <p class="custom__data-info">
                                <x-quantum.badge variant="badge_secondary-warning">
                                    {{ $application->currentApplicationStep->step->name }}
                                </x-quantum.badge>
                            </p>
                            <span class="custom__data-info-divider"></span>
                            <p class="custom__data-info">
                                <x-quantum.badge
                                    :variant="\App\Enums\ApplicationStatusEnum::getBadgeVariant($application->status)">
                                    {{ $application->status }}
                                </x-quantum.badge>
                            </p>
                            <span class="custom__data-info-divider"></span>
                            <p class="jobs__item-info">
                                Melamar pada {{ $application->created_at->toFormattedDateString() }}
                            </p>
                        </div>
                    </div>
                    <div class="custom__data-action">
                        <x-link
                            :href="route('managements.jobs.applications.steps.reviews.index', [
                                $application->job, $application, $application->currentApplicationStep,
                            ])"
                            class="btn btn_outline btn_xs"
                            data-btn-label="Detail"
                        >
                            <span class="icon icon-eye-solid"></span>
                            Detail
                        </x-link>
                    </div>
                </div>
            @endforeach
        </div>

        <x-cms.pagination :limit="$limit" :items="$applications"/>
    </div>
</div>
