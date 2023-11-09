<?php

namespace App\Services;

use App\Enums\ApplicationStatusEnum;
use App\Enums\ApplicationStepEnum;
use App\Enums\ApplicationStepStatusEnum;
use App\Enums\JobTypeEnum;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Attachment;
use App\Models\Job;
use App\Models\Step;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobApplyingService
{
    private AttachmentManagingService $attachmentManagingService;

    public function __construct(AttachmentManagingService $attachmentManagingService)
    {
        $this->attachmentManagingService = $attachmentManagingService;
    }

    public function findAll(
        int          $limit,
        ?string      $query = null,
        ?JobTypeEnum $type = null,
        ?string      $location = null,
    ): LengthAwarePaginator
    {
        return Job::query()
            ->with('firstSection')
            ->isActive()
            ->when(!is_null($query), function (Builder $q) use ($query) {
                $q->where('title', 'ILIKE', '%' . $query . '%');
            })->when(!is_null($type), function (Builder $q) use ($type) {
                $q->where('type', $type);
            })->when(!is_null($location), function (Builder $q) use ($location) {
                $q->where('location', $location);
            })->latest()
            ->paginate($limit);
    }

    public function getLocations(): array
    {
        return Cache::rememberForever(
            'job_locations',
            fn() => Job::query()->pluck('location')->toArray(),
        );
    }

    /**
     * @param Job $job
     * @param array $data
     * @return void
     */
    public function apply(Job $job, array $data): void
    {
        DB::beginTransaction();

        $applicant = Applicant::query()->create([
            'name' => $data['name'],
            'nik' => $data['nik'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'place_of_birth' => $data['place_of_birth'],
            'date_of_birth' => $data['date_of_birth'],
            'is_married' => $data['is_married'],
            'gender' => $data['gender'],
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

        /** @var UploadedFile $cv */
        $cv = $data['curriculum_vitae'];

        /** @var ?UploadedFile $portfolio */
        $portfolio = $data['portfolio'] ?? null;

        $this->createCV($application, $cv, $folder);

        if ($portfolio !== null) {
            $this->createPortfolio($application, $portfolio, $folder);
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

    private function createCV(Application $application, UploadedFile $cv, string $folder): Attachment
    {
        $cvFilename = Str::contains(
            strtolower($cv->getClientOriginalName()),
            ['cv', 'curriculum vitae', 'curriculum_vitae']
        )
            ? $cv->getClientOriginalName()
            : 'CV_' . $cv->getClientOriginalName();

        $cvPath = $cv->storeAs($folder, $cvFilename);

        return $application->attachments()->create(
            ['path' => $cvPath, 'created_by' => null, 'updated_by' => null],
        );
    }

    private function createPortfolio(Application $application, UploadedFile $portfolio, string $folder): Attachment
    {
        $portfolioFilename = Str::contains(
            strtolower($portfolio->getClientOriginalName()),
            ['portfolio', 'portofolio']
        )
            ? $portfolio->getClientOriginalName()
            : 'Portfolio_' . $portfolio->getClientOriginalName();

        $portfolioPath = $portfolio->storeAs($folder, $portfolioFilename);

        return $application->attachments()->create(
            ['path' => $portfolioPath, 'created_by' => null, 'updated_by' => null]
        );
    }
}
