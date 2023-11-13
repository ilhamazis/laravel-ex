<div x-data="{ deleteId: null }" class="card card_table">
    <div class="card__body">
        <div class="grid" style="grid-row-gap: 1.25rem; padding: 1rem">
            <div class="col-12 col-sm-4">
                <div class="form-control">
                    <label for="search" class="form-control__label">Cari</label>
                    <div class="form-control__group">
                        <span data-input-icon="search"></span>
                        <x-quantum.input wire:model.live.debounce.500ms="query" type="search"
                                         id="search" placeholder="Cari template..."/>
                    </div>
                </div>
            </div>
        </div>

        <x-quantum.alert variant="success" style="padding: 1rem" :message="session()->get('success')"
                         dismissable/>

        <div class="custom__data-list">
            @foreach($templates as $template)
                <div class="custom__data-item">
                    <div class="custom__data-detail">
                        <h3 class="custom__data-title">{{ $template->title }}</h3>
                        <div class="custom__data-info-wrapper">
                            <p class="custom_data-info">Dibuat oleh {{ $template->createdBy->name }}</p>
                            <span class="custom__data-info-divider"></span>
                            <p class="custom_data-info">
                                Dibuat tanggal {{ $template->created_at->toFormattedDateString() }}
                            </p>
                        </div>
                    </div>
                    <div class="custom__data-action">
                        @can(\App\Enums\PermissionEnum::UPDATE_TEMPLATE->value)
                            <x-link :href="route('managements.templates.edit', $template)"
                                    class="btn btn_outline btn_xs"
                                    data-btn-label="Edit">
                                <span class="icon icon-pencil-square-solid"></span>
                                Ubah
                            </x-link>
                        @endcan
                        @can(\App\Enums\PermissionEnum::DELETE_TEMPLATE->value)
                            <button x-on:click="deleteId = @js($template->id)" data-toggle="modal"
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

        <x-cms.pagination :limit="$limit" :items="$templates"/>
    </div>

    <x-quantum.modal-confirmation variant="danger" id="delete-modal" title="Hapus Job">
        <x-slot:body>
            <p>Apakah anda yakin ingin menghapus template ini?</p>
        </x-slot:body>

        <x-slot:footer>
            <div class="grid cols-1 cols-sm-2">
                <button class="btn btn_outline" data-dismiss="modal">Batal</button>
                <form action="{{ route('managements.templates.destroy') }}" method="post">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="id" x-bind:value="deleteId"/>
                    <button type="submit" class="btn btn_destructive" style="width: 100%">Hapus</button>
                </form>
            </div>
        </x-slot:footer>
    </x-quantum.modal-confirmation>
</div>
