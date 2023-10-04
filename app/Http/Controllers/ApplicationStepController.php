<?php

namespace App\Http\Controllers;

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
    public function show(string $jobSlug, string $applicationId, string $applicationStepId): View
    {
        $application = $this->applicationManagingService->find($applicationId);
        $applicationSteps = $this->applicationStepManagingService->findAll($application);
        $missingApplicationSteps = $this->applicationStepManagingService->getMissingSteps($applicationSteps);
        $currentApplicationStep = $this->applicationStepManagingService->find($applicationStepId);

        return view('managements.jobs.applications.application-steps.show', [
            'jobSlug' => $jobSlug,
            'application' => $application,
            'applicationSteps' => $applicationSteps,
            'missingApplicationSteps' => $missingApplicationSteps,
            'currentApplicationStep' => $currentApplicationStep,
        ]);
    }
}
