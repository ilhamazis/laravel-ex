<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStepEnum;
use App\Enums\ApplicationStepStatusEnum;
use App\Enums\PermissionEnum;
use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Job;
use App\Services\ApplicationStepManagingService;
use App\Services\TemplateManagingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApplicationStepController extends Controller
{
    private ApplicationStepManagingService $applicationStepManagingService;
    private TemplateManagingService $templateManagingService;

    public function __construct(
        ApplicationStepManagingService $applicationStepManagingService,
        TemplateManagingService        $templateManagingService,
    )
    {
        $this->applicationStepManagingService = $applicationStepManagingService;
        $this->templateManagingService = $templateManagingService;

        $this->middleware(function (Request $request, \Closure $next) {
            $job = $request->route('job');
            $application = $request->route('application');
            $applicationStep = $request->route('step');

            if ($application->job_id !== $job->id || $applicationStep->application_id !== $application->id) {
                abort(404);
            }

            return $next($request);
        })->only(['show', 'update', 'destroy']);
        $this->middleware([
            'can:' . PermissionEnum::VIEW_APPLICATION_STEP->value,
            'can:' . PermissionEnum::VIEW_APPLICATION_COMMUNICATION->value],
        )->only(['show']);
        $this->middleware('can:' . PermissionEnum::UPDATE_APPLICATION_STEP->value)->only(['update', 'destroy']);
    }

    public function show(Job $job, Application $application, ApplicationStep $step): View
    {
        $application = $application->load('applicant');
        $attachments = $application->attachments()->latest()->get();
        $applicationStep = $step->load('step');
        $applicationSteps = $this->applicationStepManagingService->findAll($application);
        $missingApplicationSteps = $this->applicationStepManagingService->getMissingSteps($applicationSteps);
        $templates = $this->templateManagingService->findAll();

        return view('managements.jobs.applications.application-steps.show', [
            'job' => $job,
            'attachments' => $attachments,
            'application' => $application,
            'applicationStep' => $applicationStep,
            'applicationSteps' => $applicationSteps,
            'missingApplicationSteps' => $missingApplicationSteps,
            'templates' => $templates,
        ]);
    }

    public function update(Job $job, Application $application, ApplicationStep $step): RedirectResponse
    {
        $applicationStep = $step->load('step');

        $this->validateStepStatus($applicationStep);

        if (ApplicationStepEnum::mustHaveReview($applicationStep->step->name)) {
            $this->validateStepHasReviews($applicationStep);
        }

        if (ApplicationStepEnum::onLastStep($applicationStep->step->name)) {
            $this->applicationStepManagingService->hire($applicationStep);

            return redirect()
                ->route('managements.jobs.applications.steps.show', [$job, $application, $applicationStep])
                ->with('success', 'Berhasil merekrut kandidat');
        } else {
            $nextApplicationStep = $this->applicationStepManagingService->moveToNextStep($applicationStep);

            return redirect()
                ->route('managements.jobs.applications.steps.show', [$job, $application, $nextApplicationStep])
                ->with('success', 'Berhasil mengubah rekrutmen ke tahap selanjutnya');
        }
    }

    public function destroy(Job $job, Application $application, ApplicationStep $step): RedirectResponse
    {
        $applicationStep = $step->load('step');

        $this->validateStepStatus($applicationStep);

        $this->applicationStepManagingService->reject($applicationStep);

        return redirect()
            ->route('managements.jobs.applications.steps.show', [$job, $application, $applicationStep])
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

    private function validateStepHasReviews(ApplicationStep $applicationStep): void
    {
        if (!$applicationStep->hasReviews()) {
            throw ValidationException::withMessages([
                'status' => 'Tahap Rekrutmen harus memiliki Review',
            ]);
        }
    }
}
