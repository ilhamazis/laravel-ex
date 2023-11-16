<?php

namespace App\Services;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use App\Models\Job;
use App\Models\JobSection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
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
            ->withCount('applications')
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

    public function create(array $data): Model
    {
        DB::beginTransaction();

        $job = Job::query()->create([
            'title' => $data['title'],
            'type' => $data['type'],
            'status' => $data['status'],
            'quota' => $data['quota'],
            'location' => $data['location'],
            'need_portfolio' => $data['need_portfolio'] ?? false,
            'start_at' => $data['start_at'] ?? null,
            'end_at' => $data['end_at'] ?? null,
        ]);

        $this->syncJobSections($job, $data['sections']);

        DB::commit();

        return $job;
    }

    public function update(Job $job, array $data): bool
    {
        DB::beginTransaction();

        $result = $job->update([
            'title' => $data['title'],
            'type' => $data['type'],
            'status' => $data['status'],
            'quota' => $data['quota'],
            'location' => $data['location'],
            'need_portfolio' => $data['need_portfolio'] ?? false,
            'start_at' => $data['start_at'] ?? null,
            'end_at' => $data['end_at'] ?? null,
        ]);

        $this->syncJobSections($job, $data['sections']);

        DB::commit();

        return $result;
    }

    public function delete(int $id): bool
    {
        return Job::query()->where('id', $id)->delete();
    }

    /**
     * @param Job $job
     * @param array $sections
     * @return Collection<JobSection>
     */
    private function syncJobSections(Job $job, array $sections): Collection
    {
        $order = 1;

        $sections = collect($sections)->map(function (array $section) use (&$order) {
            return [
                'order' => $order++,
                'content' => $section['content'],
            ];
        });

        $job->sections()->delete();

        return $job->sections()->createMany($sections);
    }
}
