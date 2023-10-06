<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Models\Job;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:' . PermissionEnum::VIEW_APPLICATION->value)->only(['index']);
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
