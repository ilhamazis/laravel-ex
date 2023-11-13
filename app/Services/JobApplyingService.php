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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobApplyingService
{
    private CommunicationSendingService $communicationSendingService;

    public function __construct(CommunicationSendingService $communicationSendingService)
    {
        $this->communicationSendingService = $communicationSendingService;
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

        $applicant = $this->saveApplicant($data);

        $application = $this->saveApplication($job, $applicant, $data);

        $folder = $job->slug . '/' . $application->id . '/' . now()->timestamp;

        /** @var UploadedFile $cv */
        $cv = $data['curriculum_vitae'];

        /** @var ?UploadedFile $portfolio */
        $portfolio = $data['portfolio'] ?? null;

        $this->createCV($application, $cv, $folder);

        if ($portfolio !== null) {
            $this->createPortfolio($application, $portfolio, $folder);
        }

        $applicationStep = $this->saveApplicationStep($application);

        $application->update(['current_application_step_id' => $applicationStep->id]);

        try {
            $this->communicationSendingService->create(
                $application,
                Auth::user(),
                'Congratulations on Your SEVIMA Job Application!',
                view('emails.apply-success', ['applicantName' => $applicant->name, 'jobTitle' => $job->title]),
            );
        } catch (\Exception $e) {
            logger('Error sending email: ' . $e->getMessage());
        }

        DB::commit();
    }

    private function saveApplicant(array $data): Applicant
    {
        $photoFolder = 'applicants/profiles';
        $photoFile = $data['photo'];

        $storedPhotoPath = $this->storePhoto($photoFolder, $photoFile);

        return Applicant::query()->create([
            'photo' => $storedPhotoPath,
            'name' => $data['name'],
            'nik' => $data['nik'],
            'place_of_birth' => $data['place_of_birth'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'is_married' => $data['is_married'],
            'address' => $data['address'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'linkedin_url' => $data['linkedin_url'] ?? null,
            'education' => $data['education'],
            'school' => $data['school'],
            'faculty' => $data['faculty'] ?? null,
            'major' => $data['major'] ?? null,
            'experience' => $data['experience'],
        ]);
    }

    private function saveApplication(Job $job, Applicant $applicant, array $data)
    {
        return Application::query()->create([
            'status' => ApplicationStatusEnum::ONGOING,
            'salary_before' => $data['salary_before'],
            'salary_expected' => $data['salary_expected'],
            'applicant_id' => $applicant->id,
            'job_id' => $job->id,
        ]);
    }

    private function saveApplicationStep(Application $application): ApplicationStep
    {
        $step = Step::query()
            ->where('name', ApplicationStepEnum::RECRUITER_SCREEN)
            ->first();

        return ApplicationStep::query()->create([
            'status' => ApplicationStepStatusEnum::ONGOING,
            'application_id' => $application->id,
            'step_id' => $step->id,
        ]);
    }

    private function storePhoto(string $folder, UploadedFile $image): string
    {
        return $image->store($folder);
    }

    private function createCV(Application $application, UploadedFile $cv, string $folder): Attachment
    {
        /**
         * if CV filename doesn't contain 'cv', 'curriculum vitae', or 'curriculum_vitae'
         * then add 'CV_' prefix
         */
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
        /**
         * if Portfolio filename doesn't contain 'portfolio' or 'portofolio'
         * then add 'Portfolio_' prefix
         */
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
