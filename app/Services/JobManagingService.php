<?php

namespace App\Services;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class JobManagingService
{
    public function findAll(
        int            $limit,
        ?string        $field = null,
        ?string        $direction = null,
        ?string        $query = null,
        ?JobTypeEnum   $type = null,
        ?JobStatusEnum $status = null,
    ): LengthAwarePaginator|Collection
    {
        return Job::query()
            ->when(!is_null($query), function (Builder $q) use ($query) {
                $q->where('title', 'ILIKE', '%' . $query . '%');
            })->when(!is_null($type), function (Builder $q) use ($type) {
                $q->where('type', $type);
            })->when(!is_null($status), function (Builder $q) use ($status) {
                $q->where('status', $status);
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
}