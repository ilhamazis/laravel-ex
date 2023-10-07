<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Http\Requests\StoreAttachmentRequest;
use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Attachment;
use App\Models\Job;
use App\Services\AttachmentManagingService;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    private AttachmentManagingService $attachmentManagingService;

    public function __construct(AttachmentManagingService $attachmentManagingService)
    {
        $this->attachmentManagingService = $attachmentManagingService;

        $this->middleware(function (Request $request, \Closure $next) {
            $job = $request->route('job');
            $application = $request->route('application');
            $applicationStep = $request->route('step');

            if ($application->job_id !== $job->id || $applicationStep->application_id !== $application->id) {
                abort(404);
            }

            return $next($request);
        })->only(['store', 'show', 'destroy']);

        $this->middleware(function (Request $request, \Closure $next) {
            $application = $request->route('application');
            $attachment = $request->route('attachment');

            if ($attachment->application_id !== $application->id) {
                abort(404);
            }

            return $next($request);
        })->only(['show', 'destroy']);

        $this->middleware('can:' . PermissionEnum::VIEW_APPLICATION_ATTACHMENT->value)->only(['show']);
        $this->middleware('can:' . PermissionEnum::CREATE_APPLICATION_ATTACHMENT->value)->only(['store']);
        $this->middleware('can:' . PermissionEnum::DELETE_APPLICATION_ATTACHMENT->value)->only(['destroy']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttachmentRequest $request, Job $job, Application $application, ApplicationStep $step)
    {
        $folder = $job->slug . '/' . $application->id . '/' . now()->timestamp;

        $this->attachmentManagingService->create($application, $request->file('file'), $folder);

        return redirect()
            ->route('managements.jobs.applications.steps.show', [$job, $application, $step])
            ->with('success', 'Berhasil menambah lampiran');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job, Application $application, ApplicationStep $step, Attachment $attachment)
    {
        return $this->attachmentManagingService->download($attachment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job, Application $application, ApplicationStep $step, Attachment $attachment)
    {
        $this->attachmentManagingService->delete($attachment);

        return redirect()
            ->route('managements.jobs.applications.steps.show', [$job, $application, $step])
            ->with('success', 'Berhasil menghapus lampiran');
    }
}
