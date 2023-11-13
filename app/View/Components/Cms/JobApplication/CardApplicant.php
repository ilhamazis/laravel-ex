<?php

namespace App\View\Components\Cms\JobApplication;

use App\Models\Applicant;
use App\Models\Application;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardApplicant extends Component
{
    public function __construct(
        public Application $application,
        public Applicant   $applicant,
    )
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.cms.job-application.card-applicant');
    }
}
