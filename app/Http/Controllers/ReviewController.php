<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStepStatusEnum;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Job;
use App\Services\ApplicationStepManagingService;
use App\Services\ReviewManagingService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    private ApplicationStepManagingService $applicationStepManagingService;

    private ReviewManagingService $reviewManagingService;

    public function __construct(
        ApplicationStepManagingService $applicationStepManagingService,
        ReviewManagingService          $reviewManagingService,
    )
    {
        $this->applicationStepManagingService = $applicationStepManagingService;
        $this->reviewManagingService = $reviewManagingService;

        $this->middleware(function (Request $request, \Closure $next) {
            $job = $request->route('job');
            $application = $request->route('application');
            $applicationStep = $request->route('step');

            if ($application->job_id !== $job->id || $applicationStep->application_id !== $application->id) {
                abort(404);
            }

            return $next($request);
        })->only(['index', 'store']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Job $job, Application $application, ApplicationStep $step)
    {
        $application = $application->load('applicant');
        $applicationStep = $step->load('step');
        $applicationSteps = $this->applicationStepManagingService->findAll($application);
        $missingApplicationSteps = $this->applicationStepManagingService->getMissingSteps($applicationSteps);
        $reviews = $this->reviewManagingService->findAll($applicationStep);

        return view('managements.jobs.applications.application-steps.reviews.index', [
            'job' => $job,
            'application' => $application,
            'applicationStep' => $applicationStep,
            'applicationSteps' => $applicationSteps,
            'missingApplicationSteps' => $missingApplicationSteps,
            'reviews' => $reviews,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request, Job $job, Application $application, ApplicationStep $step)
    {
        $this->validateStepStatus($step);

        $this->reviewManagingService->create($step, $request->validated());

        return redirect()
            ->route('managements.jobs.applications.steps.reviews.index', [$job, $application, $step])
            ->with('success', 'Berhasil menambah review');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
