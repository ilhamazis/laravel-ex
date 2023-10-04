<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Services\JobApplicationManagingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    private JobApplicationManagingService $applicationManagingService;

    public function __construct(JobApplicationManagingService $applicationManagingService)
    {
        $this->applicationManagingService = $applicationManagingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Job $job): View
    {
        return view('managements.jobs.applications.index', ['job' => $job]);
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
}
