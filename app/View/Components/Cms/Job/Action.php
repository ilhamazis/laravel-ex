<?php

namespace App\View\Components\Cms\Job;

use App\Models\Job;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Action extends Component
{
    public function __construct(public Job $job)
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.cms.job.action');
    }
}
