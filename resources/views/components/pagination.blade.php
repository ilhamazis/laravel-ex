<div class="box-table__action">
    <div class="box-table__action-left">
        <p class="box-table__result">
            Menampilkan
            <b>{{ $items->firstItem() }}-{{ $items->lastItem() }}</b>
            dari Total {{ $items->total() }} data
        </p>
    </div>
    <div class="box-table__action-right">
        <div class="form-control">
            <select wire:change="$dispatch('changeSelect', { field: 'limit', value: $event.target.value })"
                    x-init="initChoices($el)">
                <option @selected($limit === 20) value="20">20 Baris</option>
                <option @selected($limit === 40) value="40">40 Baris</option>
                <option @selected($limit === 100) value="100">100 Baris</option>
            </select>
        </div>
        {{ $items->withQueryString()->links('components.paginator') }}
    </div>
</div>