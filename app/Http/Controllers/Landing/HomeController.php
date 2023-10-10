<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Services\JobApplyingService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(JobApplyingService $jobApplyingService): View
    {
        $featuredJobs = $jobApplyingService->getFeaturedJobs();

        return view('home', ['featuredJobs' => $featuredJobs]);
    }
}
