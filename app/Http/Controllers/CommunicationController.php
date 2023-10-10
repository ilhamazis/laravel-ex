<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Http\Requests\StoreCommunicationRequest;
use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Job;
use App\Services\CommunicationSendingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CommunicationController extends Controller
{
    private CommunicationSendingService $sendingService;

    public function __construct(CommunicationSendingService $sendingService)
    {
        $this->sendingService = $sendingService;

        $this->middleware(function (Request $request, \Closure $next) {
            $job = $request->route('job');
            $application = $request->route('application');
            $applicationStep = $request->route('step');

            if ($application->job_id !== $job->id || $applicationStep->application_id !== $application->id) {
                abort(404);
            }

            return $next($request);
        })->only(['store']);
        $this->middleware('can:' . PermissionEnum::CREATE_APPLICATION_COMMUNICATION->value)->only(['store']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreCommunicationRequest $request,
        Job                       $job,
        Application               $application,
        ApplicationStep           $step,
    ): RedirectResponse
    {
        try {
            $this->sendingService->create(
                $application,
                Auth::user(),
                $request->get('title'),
                view('emails.communication', ['data' => $request->get('content')])->render()
            );

            return redirect()
                ->route('managements.jobs.applications.steps.show', [$job, $application, $step])
                ->with('success', 'Berhasil mengirim email ke pelamar');
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'mail' => $e->getMessage(),
            ]);
        }
    }
}
