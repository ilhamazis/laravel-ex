<div x-data="{ deleteId: null }" class="card card_table">
    <div class="card__body">
        <div class="grid" style="grid-row-gap: 1.25rem; padding: 1rem">
            <div class="col-12 col-sm-4">
                <div class="form-control">
                    <label for="search" class="form-control__label">Cari</label>
                    <div class="form-control__group">
                        <span data-input-icon="search"></span>
                        <x-quantum.input wire:model.live.debounce.500ms="query" type="search"
                                         id="search" placeholder="Cari lowongan pekerjaan..."/>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-3 col-md-2">
                <div class="form-control">
                    <label for="type" class="form-control__label">Tipe Pekerjaan</label>
                    <x-quantum.select
                        wire:change="$dispatch('changeSelect', { field: 'type', value: $event.target.value })"
                        variant="single-search" id="type" placeholder="Cari tipe pekerjaan...">
                        <option @selected(is_null($type)) disabled>Tipe Pekerjaan</option>
                        @foreach(\App\Enums\JobTypeEnum::values() as $typeEnum)
                            <option
                                @selected($type === $typeEnum) value="{{ $typeEnum }}">{{ $typeEnum }}</option>
                        @endforeach
                    </x-quantum.select>
                </div>
            </div>

            <div class="col-12 col-sm-3 col-md-2">
                <div class="form-control">
                    <label for="status" class="form-control__label">Status</label>
                    <x-quantum.select
                        wire:change="$dispatch('changeSelect', { field: 'status', value: $event.target.value })"
                        variant="single-search" id="status" placeholder="Cari status pekerjaan...">
                        <option @selected(is_null($status)) disabled>Status</option>
                        @foreach(\App\Enums\JobStatusEnum::values() as $statusEnum)
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
            @foreach($jobs as $job)
                <div class="custom__data-item">
                    <div class="custom__data-detail">
                        <h3 class="custom__data-title">{{ $job->title }}</h3>
                        <div class="custom__data-info-wrapper">
                            <p class="custom__data-info">
                                <x-quantum.badge :variant="\App\Enums\JobStatusEnum::getBadgeVariant($job->status)">
                                    {{ $job->status }}
                                </x-quantum.badge>
                            </p>
                            <span class="custom__data-info-divider"></span>
                            <p class="jobs__item-info">{{ $job->type }}</p>
                            <span class="custom__data-info-divider"></span>
                            <p class="jobs__item-info">{{ $job->location }}</p>
                            <span class="custom__data-info-divider"></span>
                            <p class="jobs__item-info">{{ $job->quota }} Kuota</p>
                            <span class="custom__data-info-divider"></span>
                            <p class="jobs__item-info">{{ $job->applications_count }} Pelamar</p>
                            @if($job->start_at && is_null($job->end_at))
                                <span class="custom__data-info-divider"></span>
                                <p class="jobs__item-info">
                                    Aktif sejak {{ $job->start_at->isoFormat('LL') }}
                                </p>
                            @elseif(is_null($job->start_at) && $job->end_at)
                                <span class="custom__data-info-divider"></span>
                                <p class="jobs__item-info">
                                    Berakhir tanggal {{ $job->end_at->isoFormat('LL') }}
                                </p>
                            @elseif($job->start_at && $job->end_at)
                                <span class="custom__data-info-divider"></span>
                                <p class="jobs__item-info">
                                    {{ $job->start_at->isoFormat('LL') }}
                                    -
                                    {{ $job->end_at->isoFormat('LL') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="custom__data-action">
                        <x-link :href="route('managements.jobs.show', $job)" class="btn btn_outline btn_xs"
                                data-btn-label="Detail">
                            <span class="icon icon-eye-solid"></span>
                            Detail
                        </x-link>
                        @can(\App\Enums\PermissionEnum::DELETE_JOB->value)
                            <button x-on:click="deleteId = @js($job->id)" data-toggle="modal"
                                    data-target="#delete-modal"
                                    class="btn btn_destructive btn_xs" data-btn-label="Hapus">
                                <span class="icon icon-trash-solid"></span>
                                Hapus
                            </button>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>

        <x-cms.pagination :limit="$limit" :items="$jobs"/>
    </div>

    <x-quantum.modal-confirmation variant="danger" id="delete-modal" title="Hapus Job">
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
    </x-quantum.modal-confirmation>
</div>
