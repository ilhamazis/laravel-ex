<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Services\ApplicationStepManagingService;
use App\Services\JobApplicationManagingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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

    /**
     * Display the specified resource.
     */
    public function show(Job $job, string $applicationId, string $applicationStepId): View
    {
        $application = $this->applicationManagingService->findOrFail($applicationId);
        $currentApplicationStep = $this->applicationStepManagingService->findOrFail($applicationStepId);
        $applicationSteps = $this->applicationStepManagingService->findAll($application);
        $missingApplicationSteps = $this->applicationStepManagingService->getMissingSteps($applicationSteps);

        abort_if($application->job_id !== $job->id, 404);
        abort_if($currentApplicationStep->application_id !== $application->id, 404);

        return view('managements.jobs.applications.application-steps.show', [
            'jobSlug' => $job->slug,
            'application' => $application,
            'applicationSteps' => $applicationSteps,
            'missingApplicationSteps' => $missingApplicationSteps,
            'currentApplicationStep' => $currentApplicationStep,
        ]);
    }
}
