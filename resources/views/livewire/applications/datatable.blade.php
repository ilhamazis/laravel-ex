<div class="box-table">
    <div class="box-table__header">
        <div class="grid" style="grid-row-gap: 1.25rem">
            <div class="col-12 col-sm-4">
                <div class="form-control">
                    <label for="search" class="form-control__label">Cari</label>
                    <div class="form-control__group">
                        <span data-input-icon="search"></span>
                        <x-input wire:model.live.debounce.500ms="query" type="search"
                                 id="search" placeholder="Cari nama pelamar..."/>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-3 col-md-2">
                <div class="form-control">
                    <label for="step" class="form-control__label">Tahap Rekrutmen</label>
                    <x-select
                        wire:change="$dispatch('changeSelect', { field: 'step', value: $event.target.value })"
                        variant="single-search" id="step" placeholder="Cari tahap rekrutmen...">
                        <option @selected(is_null($step)) disabled>Tahap Rekrutmen</option>
                        @foreach(\App\Enums\ApplicationStepEnum::values() as $stepEnum)
                            <option
                                @selected($step === $stepEnum) value="{{ $stepEnum }}">{{ $stepEnum }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
        </div>
    </div>

    <div class="box-table__content">
        <div wire:ignore.self class="table-max table-max_absolute">
            <table>
                <thead>
                <tr>
                    <th class="cell-check cell-center">
                        <input type="checkbox" class="check-all-item" name="group">
                    </th>
                    <x-cell-sorting column="created_at" :field="$field" :direction="$direction">
                        Tanggal Melamar
                    </x-cell-sorting>
                    <th>Nama Pelamar</th>
                    <th>Tahap Rekrutmen Saat Ini</th>
                    <th>Status</th>
                    <th class="cell-action cell-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td class="cell-check cell-center">
                            <input type="checkbox" class="form-control__checkbox check-item" name="group">
                        </td>
                        <td>{{ $application->created_at->toFormattedDateString() }}</td>
                        <td>{{ $application->applicant->name }}</td>
                        <td>{{ $application->currentApplicationStep?->step?->name->value }}</td>
                        <td>
                            <x-badge :variant="\App\Enums\ApplicationStatusEnum::getBadgeVariant($application->status)">
                                {{ $application->status }}
                            </x-badge>
                        </td>
                        <td class="cell-action">
                            @can(\App\Enums\PermissionEnum::VIEW_APPLICATION_STEP->value)
                                @if($application->currentApplicationStep)
                                    <div class="dropdown-group"
                                         style="display: flex; align-items: center; gap: 4px;">
                                        <x-link
                                            href="{{
                                                    route(
                                                        auth()->user()->can(\App\Enums\PermissionEnum::VIEW_APPLICATION_COMMUNICATION->value)
                                                            ? 'managements.jobs.applications.steps.show'
                                                            : 'managements.jobs.applications.steps.reviews.index',
                                                        [$job, $application, $application->currentApplicationStep],
                                                    )
                                                  }}"
                                            class="btn btn_outline btn_xs btn_icon" data-btn-label="Detail">
                                            <span class="icon icon-eye-solid"></span>
                                        </x-link>
                                        <div class="dropdown-group__target">
                                            <div class="dropdown-group__toggle">
                                                <button class="btn btn_outline btn_xs btn_icon">
                                                    <span class="icon icon-ellipsis-horizontal"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="box-table__footer">
        <x-pagination :limit="$limit" :items="$applications"/>
    </div>
</div>
