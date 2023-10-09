<?php

namespace App\Services;

use App\Enums\ApplicationStatusEnum;
use App\Enums\ApplicationStepEnum;
use App\Enums\ApplicationStepStatusEnum;
use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Job;
use App\Models\Step;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class JobApplyingService
{
    private AttachmentManagingService $attachmentManagingService;

    public function __construct(AttachmentManagingService $attachmentManagingService)
    {
        $this->attachmentManagingService = $attachmentManagingService;
    }

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

    /**
     * @param Job $job
     * @param array $data
     * @param array<UploadedFile> $attachments
     * @return void
     */
    public function apply(Job $job, array $data, array $attachments): void
    {
        DB::beginTransaction();

        $applicant = Applicant::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'age' => $data['age'],
            'is_married' => $data['is_married'],
            'address' => $data['address'],
            'education' => $data['education'],
            'school' => $data['school'],
            'faculty' => $data['faculty'] ?? null,
            'major' => $data['major'] ?? null,
            'experience' => $data['experience'],
        ]);

        $application = Application::query()->create([
            'status' => ApplicationStatusEnum::ONGOING,
            'salary_before' => $data['salary_before'],
            'salary_expected' => $data['salary_expected'],
            'applicant_id' => $applicant->id,
            'job_id' => $job->id,
        ]);

        $folder = $job->slug . '/' . $application->id . '/' . now()->timestamp;
        foreach ($attachments as $attachment) {
            $this->attachmentManagingService->create($application, $attachment, $folder);
        }

        $step = Step::query()
            ->where('name', ApplicationStepEnum::RECRUITER_SCREEN)
            ->first();

        $applicationStep = ApplicationStep::query()->create([
            'status' => ApplicationStepStatusEnum::ONGOING,
            'application_id' => $application->id,
            'step_id' => $step->id,
        ]);

        $application->update(['current_application_step_id' => $applicationStep->id]);

        DB::commit();
    }
}
