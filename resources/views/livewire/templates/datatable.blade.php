<div x-data="{ deleteId: null }" class="card card_table">
    <div class="card__body">
        <div class="grid" style="grid-row-gap: 1.25rem; padding: 1rem">
            <div class="col-12 col-sm-4">
                <div class="form-control">
                    <label for="search" class="form-control__label">Search</label>
                    <div class="form-control__group">
                        <span data-input-icon="search"></span>
                        <x-input wire:model.live.debounce.500ms="query" type="search"
                                 id="search" placeholder="Cari template..."/>
                    </div>
                </div>
            </div>
        </div>

        <x-alert variant="success" style="padding-bottom: 1rem" :message="session()->get('success')"
                 dismissable/>

        <div class="jobs__list-wrapper">
            @foreach($templates as $template)
                <div class="jobs__item">
                    <div class="jobs__item-detail">
                        <h3 class="jobs__item-title">{{ $template->title }}</h3>
                        <div class="jobs__item-info-wrapper">
                            <p class="jobs__item-info">By {{ $template->createdBy->name }}</p>
                            <div class="jobs__item-info-divider">
                                <svg width="4" height="4" viewBox="0 0 4 4" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="2" cy="2" r="2" fill="#D9D9D9"/>
                                </svg>
                            </div>
                            <p class="jobs__item-info">Created
                                on {{ $template->created_at->toFormattedDateString() }}</p>
                        </div>
                    </div>
                    <div class="jobs__item-action">
                        <x-link :href="route('managements.templates.show', $template)" class="btn btn_outline btn_xs"
                                data-btn-label="Detail">
                            <span class="icon icon-eye-solid"></span>
                            Detail
                        </x-link>
                        <button x-on:click="deleteId = @js($template->id)" data-toggle="modal"
                                data-target="#delete-modal"
                                class="btn btn_destructive btn_xs" data-btn-label="Hapus">
                            <span class="icon icon-trash-solid"></span>
                            Hapus
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <x-pagination :limit="$limit" :items="$templates"/>
    </div>

    <x-modal-confirmation variant="danger" id="delete-modal" title="Hapus Job">
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
    </x-modal-confirmation>
</div>
