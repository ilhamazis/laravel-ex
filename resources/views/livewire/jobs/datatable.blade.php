<div x-data="{ deleteId: null }" class="card card_table">
    <div class="card__body">
        <div class="box-table">
            <div class="box-table__header">
                <div class="grid" style="grid-row-gap: 1.25rem">
                    <div class="col-12 col-sm-4">
                        <div class="form-control">
                            <label for="search" class="form-control__label">Search</label>
                            <div class="form-control__group">
                                <span data-input-icon="search"></span>
                                <x-input wire:model.live.debounce.500ms="query" type="search"
                                         id="search" placeholder="Cari lowongan pekerjaan..."/>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 col-md-2">
                        <div class="form-control">
                            <label for="type" class="form-control__label">Tipe Pekerjaan</label>
                            <x-select
                                wire:change="$dispatch('changeSelect', { field: 'type', value: $event.target.value })"
                                variant="single-search" id="type" placeholder="Cari tipe pekerjaan...">
                                <option @selected(is_null($type)) disabled>Tipe Pekerjaan</option>
                                @foreach(\App\Enums\JobTypeEnum::values() as $typeEnum)
                                    <option
                                        @selected($type === $typeEnum) value="{{ $typeEnum }}">{{ $typeEnum }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 col-md-2">
                        <div class="form-control">
                            <label for="status" class="form-control__label">Status</label>
                            <x-select
                                wire:change="$dispatch('changeSelect', { field: 'status', value: $event.target.value })"
                                variant="single-search" id="status" placeholder="Cari status pekerjaan...">
                                <option @selected(is_null($status)) disabled>Status</option>
                                @foreach(\App\Enums\JobStatusEnum::values() as $statusEnum)
                                    <option
                                        @selected($status === $statusEnum) value="{{ $statusEnum }}">{{ $statusEnum }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-table__content">
                <x-alert variant="success" style="padding-bottom: 1rem" :message="session()->get('success')"
                         dismissable/>

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
                                        <x-link href="{{ route('managements.jobs.show', $job) }}"
                                                class="btn btn_outline btn_xs btn_icon" data-btn-label="Detail">
                                            <span class="icon icon-eye-solid"></span>
                                        </x-link>
                                        @can(\App\Enums\PermissionEnum::DELETE_JOB->value)
                                            <button x-on:click="deleteId = @js($job->id)" data-toggle="modal"
                                                    data-target="#delete-modal"
                                                    class="btn btn_outline btn_xs btn_icon" data-btn-label="Hapus">
                                                <span class="icon icon-trash-solid"></span>
                                            </button>
                                        @endcan
                                        <div class="dropdown">
                                            <button type="button" class="btn btn_outline btn_xs btn_icon"
                                                    data-toggle="dropdown">
                                                <span class="icon icon-ellipsis-horizontal"></span>
                                            </button>
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
                                                <button class="btn btn_outline btn_xs btn_icon">
                                                    <span class="icon icon-ellipsis-horizontal"></span>
                                                </button>
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

    <x-modal-confirmation variant="danger" id="delete-modal" title="Hapus Job">
        <x-slot:body>
            <p>Apakah anda yakin ingin menghapus data job?</p>
        </x-slot:body>

        <x-slot:footer>
            <div class="grid cols-1 cols-sm-2">
                <button class="btn btn_outline" data-dismiss="modal">Batal</button>
                <form action="{{ route('managements.jobs.destroy') }}" method="post">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="id" x-bind:value="deleteId"/>
                    <button type="submit" class="btn btn_destructive" style="width: 100%">Hapus</button>
                </form>
            </div>
        </x-slot:footer>
    </x-modal-confirmation>
</div>
