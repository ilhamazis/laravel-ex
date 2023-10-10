<?php

namespace App\View\Components;

use App\Models\Job;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JobLayout extends Component
{
    public array $breadcrumbs;
    public Job $job;

    public function __construct(Job $job, array $breadcrumbs = [])
    {
        $this->breadcrumbs = $breadcrumbs;
        $this->job = $job;
    }

    public function render(): View|Closure|string
    {
        return view('layouts.job');
    }
}
