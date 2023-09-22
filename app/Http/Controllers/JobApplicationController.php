<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Job $job)
    {
        return view('managements.jobs.applications.index', ['job' => $job]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $jobSlug, Application $application)
    {
        return view('managements.jobs.applications.show', [
            'jobSlug' => $jobSlug,
            'application' => $application,
        ]);
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
