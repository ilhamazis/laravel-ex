@props(['field', 'column', 'direction'])
<th wire:click="$dispatch('sortCell', { column: @js($column) })"
    @class([
        'cell-sorting',
        'cell-sorting_active-desc' => $field === $column && $direction === 'desc',
        'cell-sorting_active-asc' => $field === $column && $direction === 'asc',
    ])>
    {{ $slot }}
</th>
