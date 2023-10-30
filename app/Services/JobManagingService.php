<?php

namespace App\Services;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

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

    public function create(array $data, UploadedFile $banner): Model
    {
        $bannerFilepath = $banner->store('banners', ['disk' => 'public']);

        $data['banner'] = $bannerFilepath;
        $data['need_portfolio'] = $data['need_portfolio'] ?? false;

        return Job::query()->create($data);
    }

    public function update(Job $job, array $data, ?UploadedFile $newBanner = null): bool
    {
        if ($newBanner !== null) {
            $bannerFilepath = $newBanner->store('banners', ['disk' => 'public']);
            Storage::disk('public')->delete($job->banner);

            $data['banner'] = $bannerFilepath;
        }

        $data['need_portfolio'] = $data['need_portfolio'] ?? false;

        return $job->update($data);
    }

    public function delete(int $id): bool
    {
        $job = Job::query()->where('id', $id)->first();
        
        Storage::disk('public')->delete($job->banner);

        return $job->delete();
    }
}
