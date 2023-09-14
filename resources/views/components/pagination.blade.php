<div class="box-table__action">
    <div class="box-table__action-left">
        <p class="box-table__result">
            Menampilkan
            <b>{{ $items->firstItem() }}-{{ $items->lastItem() }}</b>
            dari Total {{ $items->total() }} data
        </p>
    </div>
    <div class="box-table__action-right">
        {{--                            <div class="form-control">--}}
        {{--                                <select wire:model.live="limit" class="select-default">--}}
        {{--                                    <option value="20">20 Baris</option>--}}
        {{--                                    <option value="40">40 Baris</option>--}}
        {{--                                    <option value="100">100 Baris</option>--}}
        {{--                                </select>--}}
        {{--                            </div>--}}
        {{ $items->withQueryString()->links('components.paginator') }}
    </div>
</div>