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

                    {{--                    <div class="col-12 col-sm-3 col-md-2">--}}
                    {{--                        <div class="form-control">--}}
                    {{--                            <label for="type" class="form-control__label">Tipe Pekerjaan</label>--}}
                    {{--                            <select id="type" class="select-search">--}}
                    {{--                                <option selected disabled>Tipe Pekerjaan</option>--}}
                    {{--                                <option value="List Items 1">List Items 1</option>--}}
                    {{--                                <option value="List Items 2">List Items 2</option>--}}
                    {{--                                <option value="List Items 3">List Items 3</option>--}}
                    {{--                            </select>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-12 col-sm-3 col-md-2">--}}
                    {{--                        <div class="form-control">--}}
                    {{--                            <label for="status" class="form-control__label">Status</label>--}}
                    {{--                            <select id="status" class="select-search">--}}
                    {{--                                <option selected disabled>Status</option>--}}
                    {{--                                <option value="List Items 1">List Items 1</option>--}}
                    {{--                                <option value="List Items 2">List Items 2</option>--}}
                    {{--                                <option value="List Items 3">List Items 3</option>--}}
                    {{--                            </select>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>

            <div class="box-table__content">
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
                                <td>{{ is_null($job->start_at) ? 'Tidak ada waktu mulai' : $job->start_at?->isoFormat('LL') }}</td>
                                <td>{{ is_null($job->end_at) ? 'Tidak ada deadline' : $job->end_at?->isoFormat('LL') }}</td>
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
                <x-pagination :items="$jobs"/>
            </div>
        </div>
    </div>
</div>
