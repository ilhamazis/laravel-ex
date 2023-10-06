<?php

namespace App\View\Components;

use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Job;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class JobApplicationLayout extends Component
{
    public array $breadcrumbs;
    public Job $job;
    public Application $application;
    public ApplicationStep $currentApplicationStep;
    /** @var Collection<ApplicationStep> */
    public Collection $applicationSteps;
    public array $missingApplicationSteps;

    public function __construct(
        Job             $job,
        Application     $application,
        ApplicationStep $currentApplicationStep,
        Collection      $applicationSteps,
        array           $missingApplicationSteps = [],
        array           $breadcrumbs = [],
    )
    {
        $this->breadcrumbs = $breadcrumbs;
        $this->job = $job;
        $this->application = $application;
        $this->currentApplicationStep = $currentApplicationStep;
        $this->applicationSteps = $applicationSteps;
        $this->missingApplicationSteps = $missingApplicationSteps;
    }

    public function render(): View|Closure|string
    {
        return view('layouts.job-application');
    }
}
