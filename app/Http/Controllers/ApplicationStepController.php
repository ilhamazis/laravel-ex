<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStepEnum;
use App\Enums\ApplicationStepStatusEnum;
use App\Enums\PermissionEnum;
use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Job;
use App\Services\ApplicationStepManagingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApplicationStepController extends Controller
{
    private ApplicationStepManagingService $applicationStepManagingService;

    public function __construct(ApplicationStepManagingService $applicationStepManagingService)
    {
        $this->applicationStepManagingService = $applicationStepManagingService;

        $this->middleware(function (Request $request, \Closure $next) use ($applicationStepManagingService) {
            $job = $request->route('job');
            $application = $request->route('application');
            $applicationStep = $request->route('step');

            if ($application->job_id !== $job->id || $applicationStep->application_id !== $application->id) {
                abort(404);
            }

            return $next($request);
        })->only(['show', 'update', 'destroy']);
        $this->middleware('can:' . PermissionEnum::VIEW_APPLICATION_STEP->value)->only(['show']);
        $this->middleware('can:' . PermissionEnum::UPDATE_APPLICATION_STEP->value)->only(['update', 'destroy']);
    }

    public function show(Job $job, Application $application, ApplicationStep $step): View
    {
        $application = $application->load('applicant');
        $currentApplicationStep = $step->load('step');
        $applicationSteps = $this->applicationStepManagingService->findAll($application);
        $missingApplicationSteps = $this->applicationStepManagingService->getMissingSteps($applicationSteps);

        return view('managements.jobs.applications.application-steps.show', [
            'job' => $job,
            'application' => $application,
            'currentApplicationStep' => $currentApplicationStep,
            'applicationSteps' => $applicationSteps,
            'missingApplicationSteps' => $missingApplicationSteps,
        ]);
    }

    public function update(Job $job, Application $application, ApplicationStep $step): RedirectResponse
    {
        $currentApplicationStep = $step->load('step');

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

    public function destroy(Job $job, Application $application, ApplicationStep $step): RedirectResponse
    {
        $currentApplicationStep = $step->load('step');

        $this->validateStepStatus($currentApplicationStep);

        $this->applicationStepManagingService->reject($currentApplicationStep);

        return redirect()
            ->route('managements.jobs.applications.steps.show', [$job, $application, $currentApplicationStep])
            ->with('success', 'Berhasil mengubah status rekrutmen');
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
