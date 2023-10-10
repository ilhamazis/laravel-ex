<?php

namespace App\Services;

use App\Models\Template;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TemplateManagingService
{
    public function findAll(
        ?int    $limit = null,
        ?string $field = null,
        ?string $direction = null,
        ?string $query = null,
    ): Collection|LengthAwarePaginator
    {
        $templates = Template::query()
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
            );

        if (is_null($limit)) {
            return $templates->get();
        } else {
            return $templates->paginate($limit);
        }
    }

    public function findOrFail(string $id): Template
    {
        return Template::query()->findOrFail($id);
    }

    public function create(array $data): Template
    {
        return Template::query()->create($data);
    }

    public function update(Template $template, array $data): bool
    {
        return $template->update($data);
    }

    public function delete(int $id): int
    {
        return Template::query()->where('id', $id)->delete();
    }
}
