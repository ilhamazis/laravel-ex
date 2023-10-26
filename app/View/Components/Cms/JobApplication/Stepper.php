<?php

namespace App\View\Components\Cms\JobApplication;

use App\Models\ApplicationStep;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Stepper extends Component
{
    public ApplicationStep $currentApplicationStep;

    /** @var Collection<ApplicationStep> */
    public Collection $applicationSteps;

    /** @var array<string> */
    public array $missingApplicationSteps;

    public function __construct(
        ApplicationStep $currentApplicationStep,
        Collection      $applicationSteps,
        array           $missingApplicationSteps,
    )
    {
        $this->currentApplicationStep = $currentApplicationStep;
        $this->applicationSteps = $applicationSteps;
        $this->missingApplicationSteps = $missingApplicationSteps;
    }

    public function render(): View|Closure|string
    {
        return view('components.cms.job-application.stepper');
    }
}
