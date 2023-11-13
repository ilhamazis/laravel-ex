<?php

namespace App\Services;

use App\Enums\ApplicationExperienceEnum;
use App\Enums\ApplicationStatusEnum;
use App\Enums\ApplicationStepEnum;
use App\Models\Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ApplicationManagingService
{
    /**
     * @param int $limit
     * @param string|null $query
     * @param ApplicationStepEnum|null $step
     * @param ApplicationStatusEnum|null $status
     * @return LengthAwarePaginator<Application>|Collection<Application>
     */
    public function findAll(
        int                        $limit,
        ?string                    $field = null,
        ?string                    $direction = null,
        ?string                    $query = null,
        ?ApplicationStepEnum       $step = null,
        ?ApplicationStatusEnum     $status = null,
        ?ApplicationExperienceEnum $experience = null,
    ): LengthAwarePaginator|Collection
    {
        return Application::query()
            ->with(['job', 'applicant', 'currentApplicationStep', 'currentApplicationStep.step'])
            ->when(!is_null($query), function (Builder $q) use ($query) {
                $q->whereHas('applicant', function (Builder $_q) use ($query) {
                    $_q->where('name', 'ILIKE', '%' . $query . '%');
                });
            })->when(!is_null($experience), function (Builder $q) use ($experience) {
                $q->whereHas('applicant', function (Builder $_q) use ($experience) {
                    $_q->where('experience', $experience);
                });
            })->when(!is_null($step), function (Builder $q) use ($step) {
                $q->whereHas('currentApplicationStep', function (Builder $_q) use ($step) {
                    $_q->whereHas('step', function (Builder $__q) use ($step) {
                        $__q->where('name', $step);
                    });
                });
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
