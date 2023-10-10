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
        $totalApplicationsCount = $jobMonitoringService->getApplicationsCount();
        $lastMonthApplicationsCount = $jobMonitoringService->getApplicationsCountFromRange(
            now()->subMonth(),
            now(),
        );
        $chartApplicationsPerMonth = $jobMonitoringService->formatForChart(
            $jobMonitoringService->getApplicationsCountPerMonth(now()->year)
        );

        return view('dashboard', [
            'activeJobsCount' => $activeJobsCount,
            'totalApplicationsCount' => $totalApplicationsCount,
            'lastMonthApplicationsCount' => $lastMonthApplicationsCount,
            'chartApplicationsPerMonth' => $chartApplicationsPerMonth,
        ]);
    }
}
