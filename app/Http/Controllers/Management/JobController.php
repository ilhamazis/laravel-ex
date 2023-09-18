<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Models\Job;
use App\Services\JobManagingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class JobController extends Controller
{
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
    public function store(StoreJobRequest $request, JobManagingService $jobManagingService)
    {
        $jobManagingService->create($request->validated());

        return redirect()
            ->route('managements.jobs.index')
            ->with('success', 'Berhasil menambahkan data job');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job): View
    {
        return view('managements.jobs.show', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(Job $job, JobManagingService $jobManagingService)
    {
        $jobManagingService->delete($job->id);

        return redirect()
            ->route('managements.jobs.index')
            ->with('success', 'Berhasil menghapus job');
    }
}
