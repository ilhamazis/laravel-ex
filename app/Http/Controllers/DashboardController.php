<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Services\JobMonitoringService;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function __invoke(JobMonitoringService $jobMonitoringService)
    {
        abort_if(Gate::denies(PermissionEnum::VIEW_DASHBOARD->value), 404);

        $activeJobsCount = $jobMonitoringService->getActiveJobsCount();
        $jobsThatDoesntHaveApplications = $jobMonitoringService->getJobsThatDoesntHaveApplications();
        $chartApplicationsByJob = $jobMonitoringService->formatForChart(
            $jobMonitoringService->getApplicationsByJob()
        );

        return view('dashboard', [
            'activeJobsCount' => $activeJobsCount,
            'jobsThatDoesntHaveApplications' => $jobsThatDoesntHaveApplications,
            'chartApplicationsByJob' => $chartApplicationsByJob,
        ]);
    }
}
