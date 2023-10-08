<?php

namespace App\Services;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class JobApplyingService
{
    /**
     * @return Collection<Job>
     */
    public function getFeaturedJobs(): Collection
    {
        return Job::query()
            ->where('status', JobStatusEnum::PUBLISHED)
            ->withCount('applications')
            ->orderBy('applications_count', 'desc')
            ->limit(5)
            ->get();
    }

    public function findAll(
        int          $limit,
        ?string      $query = null,
        ?JobTypeEnum $type = null,
    ): LengthAwarePaginator
    {
        return Job::query()
            ->withCount('applications')
            ->where('status', JobStatusEnum::PUBLISHED)
            ->when(!is_null($query), function (Builder $q) use ($query) {
                $q->where('title', 'ILIKE', '%' . $query . '%');
            })->when(!is_null($type), function (Builder $q) use ($type) {
                $q->where('type', $type);
            })->latest()
            ->paginate($limit);
    }
}
