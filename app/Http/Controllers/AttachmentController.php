<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttachmentRequest;
use App\Services\ApplicationStepManagingService;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    private ApplicationStepManagingService $applicationStepManagingService;

    public function __construct(
        ApplicationStepManagingService $applicationStepManagingService,
    )
    {
        $this->applicationStepManagingService = $applicationStepManagingService;

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
     * Store a newly created resource in storage.
     */
    public function store(StoreAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
}
