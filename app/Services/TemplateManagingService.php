<?php

namespace App\Services;

use App\Models\Template;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class TemplateManagingService
{
    public function findAll(
        int     $limit,
        ?string $field = null,
        ?string $direction = null,
        ?string $query = null,
    ): LengthAwarePaginator
    {
        return Template::query()
            ->when(!is_null($query), function (Builder $q) use ($query) {
                $q->where('title', 'ILIKE', '%' . $query . '%');
            })->when(
                !is_null($field) && !is_null($direction),
                function (Builder $q) use ($field, $direction) {
                    $q->orderBy($field, $direction);
                },
                function (Builder $q) {
                    $q->latest();
                },
            )->paginate($limit);
    }

    public function create(array $data): Template
    {
        return Template::query()->create($data);
    }
}
