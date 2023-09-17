@once
    @push('styles')
        <link rel="stylesheet"
              href="{{ asset('/quantum-v2.0.0-202307280002/assets/js/vendors/choices.js-10.2.0/public/assets/styles/choices.min.css') }}"/>
    @endpush

    @push('scripts')
        <script type="text/javascript"
                src="{{ asset('/quantum-v2.0.0-202307280002/assets/js/vendors/choices.js-10.2.0/public/assets/scripts/choices.min.js') }}"></script>
    @endpush
@endonce

<div class="card card_table">
    <div class="card__body">
        <div class="box-table">
            <div class="box-table__header">
                <div class="grid" style="grid-row-gap: 1.25rem">
                    <div class="col-12 col-sm-4">
                        <div class="form-control">
                            <label for="search" class="form-control__label">Search</label>
                            <div class="form-control__group">
                                <span data-input-icon="search"></span>
                                <input wire:model.live.debounce.500ms="query" id="search" type="search"
                                       class="form-control__input"
                                       placeholder="Cari lowongan pekerjaan...">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 col-md-2">
                        <div class="form-control">
                            <div class="form-control">
                                <label for="type" class="form-control__label">Tipe Pekerjaan</label>
                                <select
                                    wire:change="$dispatch('changeSelect', { field: 'type', value: $event.target.value })"
                                    x-init="initChoicesSearch($el)"
                                    data-placeholder="Cari tipe pekerjaan..."
                                    id="type"
                                >
                                    <option @selected(is_null($type)) disabled>Tipe Pekerjaan</option>
                                    @foreach(\App\Enums\JobTypeEnum::values() as $typeEnum)
                                        <option
                                            @selected($type === $typeEnum) value="{{ $typeEnum }}">{{ $typeEnum }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 col-md-2">
                        <div class="form-control">
                            <div class="form-control">
                                <label for="status" class="form-control__label">Status</label>
                                <select
                                    wire:change="$dispatch('changeSelect', { field: 'status', value: $event.target.value })"
                                    x-init="initChoicesSearch($el)"
                                    data-placeholder="Cari status pekerjaan..."
                                    id="status"
                                >
                                    <option @selected(is_null($status)) disabled>Status</option>
                                    @foreach(\App\Enums\JobStatusEnum::values() as $statusEnum)
                                        <option
                                            @selected($status === $statusEnum) value="{{ $statusEnum }}">{{ $statusEnum }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-table__content">
                <x-alert variant="success" :message="session()->get('success')" dismissable/>

                <div class="table-max table-max_absolute">
                    <table>
                        <thead>
                        <tr>
                            <th class="cell-check cell-center">
                                <input type="checkbox" class="check-all-item" name="group">
                            </th>
                            <x-cell-sorting column="title" :field="$field" :direction="$direction">
                                Posisi
                            </x-cell-sorting>
                            <th>Tipe Pekerjaan</th>
                            <x-cell-sorting column="start_at" :field="$field" :direction="$direction">
                                Mulai
                            </x-cell-sorting>
                            <x-cell-sorting column="end_at" :field="$field" :direction="$direction">
                                Selesai
                            </x-cell-sorting>
                            <th>Status</th>
                            <th class="cell-action cell-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <td class="cell-check cell-center">
                                    <input type="checkbox" class="form-control__checkbox check-item" name="group">
                                </td>
                                <td>{{ $job->title }}</td>
                                <td>{{ $job->type }}</td>
                                <td>{{ is_null($job->start_at) ? 'Tidak ada waktu mulai' : $job->start_at->isoFormat('LL') }}</td>
                                <td>{{ is_null($job->end_at) ? 'Tidak ada deadline' : $job->end_at->isoFormat('LL') }}</td>
                                <td>{{ $job->status }}</td>
                                <td class="cell-action">
                                    <div class="dropdown-group" style="display: flex; align-items: center; gap: 4px;">
                                        <a href="#"
                                           class="btn btn_outline btn_xs btn_icon" data-btn-label="Detail">
                                            <span class="icon icon-eye-solid"></span>
                                        </a>
                                        <a href="#" class="btn btn_outline btn_xs btn_icon" data-btn-label="Hapus">
                                            <span class="icon icon-trash-solid"></span>
                                        </a>
                                        <div class="dropdown">
                                            <a href="#" class="btn btn_outline btn_xs btn_icon" data-toggle="dropdown">
                                                <span class="icon icon-ellipsis-horizontal"></span>
                                            </a>
                                            <ul class="dropdown__list dropdown__list_menu-end">
                                                <li class="dropdown__item">
                                                    <a href="#">Lainnya 1</a>
                                                </li>
                                                <li class="dropdown__item">
                                                    <a href="#">Lainnya 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-group__target">
                                            <div class="dropdown-group__toggle">
                                                <a href="#" class="btn btn_outline btn_xs btn_icon">
                                                    <span class="icon icon-ellipsis-horizontal"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box-table__footer">
                <x-pagination :limit="$limit" :items="$jobs"/>
            </div>
        </div>
    </div>
</div>
