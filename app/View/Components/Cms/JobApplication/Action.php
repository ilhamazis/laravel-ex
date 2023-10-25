<?php

namespace App\View\Components\Cms\JobApplication;

use App\Models\Application;
use App\Models\ApplicationStep;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Action extends Component
{
    public function __construct(
        public Application     $application,
        public ApplicationStep $applicationStep,
    )
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.cms.job-application.action');
    }
}
