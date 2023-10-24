<div class="box-table__action">
    <div class="box-table__action-left">
        <p class="box-table__result">
            Menampilkan
            <b>{{ $items->firstItem() }}-{{ $items->lastItem() }}</b>
            dari Total {{ $items->total() }} data
        </p>
    </div>
    <div class="box-table__action-right">
        <div class="grid cols-4">
            <div class="form-control">
                <x-quantum.select
                    wire:change="$dispatch('changeSelect', { field: 'limit', value: $event.target.value })">
                    <option @selected($limit === 20) value="20">20 Baris</option>
                    <option @selected($limit === 40) value="40">40 Baris</option>
                    <option @selected($limit === 100) value="100">100 Baris</option>
                </x-quantum.select>
            </div>
            <div class="col-4 col-sm-3">
                {{ $items->onEachSide(1)->withQueryString()->links('components.quantum.paginator') }}
            </div>
        </div>
    </div>
</div>
