<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Http\Requests\StoreJobRequest;
use App\Models\Job;
use App\Services\JobManagingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    private JobManagingService $jobManagingService;

    public function __construct(JobManagingService $jobManagingService)
    {
        $this->jobManagingService = $jobManagingService;

        $this->middleware('can:' . PermissionEnum::VIEW_JOB->value)->only(['index', 'show']);
        $this->middleware('can:' . PermissionEnum::CREATE_JOB->value)->only(['create', 'store']);
        $this->middleware('can:' . PermissionEnum::UPDATE_JOB->value)->only(['edit', 'update']);
        $this->middleware('can:' . PermissionEnum::DELETE_JOB->value)->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('managements.jobs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('managements.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request): RedirectResponse
    {
        $this->jobManagingService->create($request->validated());

        return redirect()
            ->route('managements.jobs.index')
            ->with('success', 'Berhasil menambahkan data job');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job): View
    {
        return view('managements.jobs.show', [
            'job' => $job->load('sections')
                ->loadCount('applications'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('managements.jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreJobRequest $request, Job $job)
    {
        $this->jobManagingService->update($job, $request->validated());

        return redirect()
            ->route('managements.jobs.show', $job)
            ->with('success', 'Berhasil mengubah data job');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->validate(['id' => ['required', Rule::exists(Job::class, 'id')]]);

        $this->jobManagingService->delete($data['id']);

        return redirect()
            ->route('managements.jobs.index')
            ->with('success', 'Berhasil menghapus job');
    }
}
