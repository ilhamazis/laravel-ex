<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStepEnum;
use App\Enums\ApplicationStepStatusEnum;
use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Job;
use App\Services\ApplicationStepManagingService;
use App\Services\JobApplicationManagingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class ApplicationStepController extends Controller
{
    private JobApplicationManagingService $applicationManagingService;
    private ApplicationStepManagingService $applicationStepManagingService;

    public function __construct(
        JobApplicationManagingService  $applicationManagingService,
        ApplicationStepManagingService $applicationStepManagingService,
    )
    {
        $this->applicationManagingService = $applicationManagingService;
        $this->applicationStepManagingService = $applicationStepManagingService;
    }

    public function show(Job $job, string $applicationId, string $applicationStepId): View
    {
        $application = $this->applicationManagingService->findOrFail($applicationId);
        $currentApplicationStep = $this->applicationStepManagingService->findOrFail($applicationStepId);
        $applicationSteps = $this->applicationStepManagingService->findAll($application);

        $this->validateRoute($job, $application, $currentApplicationStep);

        $missingApplicationSteps = $this->applicationStepManagingService->getMissingSteps($applicationSteps);

        return view('managements.jobs.applications.application-steps.show', [
            'jobSlug' => $job->slug,
            'application' => $application,
            'applicationSteps' => $applicationSteps,
            'missingApplicationSteps' => $missingApplicationSteps,
            'currentApplicationStep' => $currentApplicationStep,
        ]);
    }

    public function update(Job $job, Application $application, string $applicationStepId): RedirectResponse
    {
        $currentApplicationStep = $this->applicationStepManagingService->findOrFail($applicationStepId);

        $this->validateRoute($job, $application, $currentApplicationStep);
        $this->validateStepStatus($currentApplicationStep);

        if (ApplicationStepEnum::onLastStep($currentApplicationStep->step->name)) {
            $this->applicationStepManagingService->hire($currentApplicationStep);

            return redirect()
                ->route('managements.jobs.applications.steps.show', [$job, $application, $currentApplicationStep])
                ->with('success', 'Berhasil merekrut kandidat');
        } else {
            $nextApplicationStep = $this->applicationStepManagingService->moveToNextStep($currentApplicationStep);

            return redirect()
                ->route('managements.jobs.applications.steps.show', [$job, $application, $nextApplicationStep])
                ->with('success', 'Berhasil mengubah rekrutmen ke tahap selanjutnya');
        }
    }

    public function destroy(Job $job, Application $application, string $applicationStepId): RedirectResponse
    {
        $currentApplicationStep = $this->applicationStepManagingService->findOrFail($applicationStepId);

        $this->validateRoute($job, $application, $currentApplicationStep);
        $this->validateStepStatus($currentApplicationStep);

        $this->applicationStepManagingService->reject($currentApplicationStep);

        return redirect()
            ->route('managements.jobs.applications.steps.show', [$job, $application, $currentApplicationStep])
            ->with('success', 'Berhasil mengubah status rekrutmen');
    }

    private function validateRoute(Job $job, Application $application, ApplicationStep $applicationStep): void
    {
        if ($application->job_id !== $job->id || $applicationStep->application_id !== $application->id) {
            abort(404);
        }
    }

    private function validateStepStatus(ApplicationStep $applicationStep): void
    {
        if ($applicationStep->status !== ApplicationStepStatusEnum::ONGOING) {
            throw ValidationException::withMessages([
                'status' => 'Status dari Tahap Rekrutmen harus Ongoing',
            ]);
        }
    }
}
