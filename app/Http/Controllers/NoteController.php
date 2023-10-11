<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStepStatusEnum;
use App\Enums\PermissionEnum;
use App\Http\Requests\StoreNoteRequest;
use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Job;
use App\Services\ApplicationStepManagingService;
use App\Services\NoteManagingService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NoteController extends Controller
{
    private ApplicationStepManagingService $applicationStepManagingService;

    private NoteManagingService $noteManagingService;

    public function __construct(
        ApplicationStepManagingService $applicationStepManagingService,
        NoteManagingService            $noteManagingService,
    )
    {
        $this->applicationStepManagingService = $applicationStepManagingService;
        $this->noteManagingService = $noteManagingService;

        $this->middleware(function (Request $request, \Closure $next) {
            $job = $request->route('job');
            $application = $request->route('application');
            $applicationStep = $request->route('step');

            if ($application->job_id !== $job->id || $applicationStep->application_id !== $application->id) {
                abort(404);
            }

            return $next($request);
        })->only(['index', 'store']);
        $this->middleware('can:' . PermissionEnum::VIEW_APPLICATION_NOTE->value)->only('index');
        $this->middleware('can:' . PermissionEnum::CREATE_APPLICATION_NOTE->value)->only('store');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Job $job, Application $application, ApplicationStep $step)
    {
        $application = $application->load('applicant');
        $attachments = $application->attachments()->latest()->get();
        $applicationStep = $step->load('step');
        $applicationSteps = $this->applicationStepManagingService->findAll($application);
        $missingApplicationSteps = $this->applicationStepManagingService->getMissingSteps($applicationSteps);
        $notes = $this->noteManagingService->findAll($applicationStep);

        return view('managements.jobs.applications.application-steps.notes.index', [
            'job' => $job,
            'application' => $application,
            'attachments' => $attachments,
            'applicationStep' => $applicationStep,
            'applicationSteps' => $applicationSteps,
            'missingApplicationSteps' => $missingApplicationSteps,
            'notes' => $notes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request, Job $job, Application $application, ApplicationStep $step)
    {
        $this->validateStepStatus($step);

        $this->noteManagingService->create($step, $request->validated());

        return redirect()
            ->route('managements.jobs.applications.steps.notes.index', [$job, $application, $step])
            ->with('success', 'Berhasil menambah catatan');
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
