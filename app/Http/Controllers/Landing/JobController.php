<?php

namespace App\Http\Controllers\Landing;

use App\Enums\JobStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobApplyRequest;
use App\Models\Job;
use App\Services\JobApplyingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    private JobApplyingService $jobApplyingService;

    public function __construct(JobApplyingService $jobApplyingService)
    {
        $this->jobApplyingService = $jobApplyingService;

        $this->middleware(function (Request $request, \Closure $next) {
            $job = $request->route('job');

            if (
                $job->status !== JobStatusEnum::PUBLISHED
                || ($job->start_at !== null && $job->start_at > today())
                || ($job->end_at !== null && $job->end_at < today())
            ) {
                abort(404);
            }

            return $next($request);
        })->except(['index']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('jobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job): View
    {
        return view('jobs.show', ['job' => $job]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job): View
    {
        return view('jobs.apply', ['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobApplyRequest $request, Job $job): RedirectResponse
    {
        $files = [$request->file('curriculum_vitae'), $request->file('portfolio')];
        $this->jobApplyingService->apply($job, $request->validated(), $files);

        return redirect()
            ->route('jobs.apply', $job)
            ->with('success', 'Selamat! Anda berhasil melamar lowongan pekerjaan di SEVIMA');
    }
}
