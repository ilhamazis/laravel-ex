<?php

namespace App\Services;

use App\Enums\ApplicationStepEnum;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class JobApplicationManagingService
{
    public function findAll(
        Job                  $job,
        int                  $limit,
        ?string              $field = null,
        ?string              $direction = null,
        ?string              $query = null,
        ?ApplicationStepEnum $step = null,
    ): LengthAwarePaginator|Collection
    {
        return Application::query()
            ->with(['applicant', 'currentApplicationStep', 'currentApplicationStep.step'])
            ->whereBelongsTo($job)
            ->when(!is_null($query), function (Builder $q) use ($query) {
                $q->whereHas('applicant', function (Builder $_q) use ($query) {
                    $_q->where('name', 'ILIKE', '%' . $query . '%');
                });
            })->when(!is_null($step), function (Builder $q) use ($step) {
                $q->whereHas('currentApplicationStep', function (Builder $_q) use ($step) {
                    $_q->whereHas('step', function (Builder $__q) use ($step) {
                        $__q->where('name', $step);
                    });
                });
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

    public function findOrFail(string $id): Application
    {
        return Application::query()
            ->with(['applicant'])
            ->findOrFail($id);
    }
}
