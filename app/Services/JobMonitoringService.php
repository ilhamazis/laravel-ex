<?php

namespace App\Services;

use App\Enums\JobStatusEnum;
use App\Models\Application;
use App\Models\Job;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class JobMonitoringService
{
    public function getActiveJobsCount(): string
    {
        return $this->numberFormat(Job::query()->isActive()->count());
    }

    public function getJobsThatDoesntHaveApplications(): string
    {
        return $this->numberFormat(
            Job::query()
                ->whereDoesntHave('applications')
                ->count()
        );
    }

    public function getApplicationsByJob(): array
    {
        $applicationsByJob = Job::query()
            ->withCount('applications')
            ->isActive()
            ->orderBy('updated_at')
            ->get();

        return $applicationsByJob
            ->mapWithKeys(fn(Job $job) => [$job->title => $job->applications_count])
            ->toArray();
    }

    /**
     * @param array<string, int> $data
     * @return array<string, array<int>>
     */
    public function formatForChart(array $data): array
    {
        return [
            'labels' => array_keys($data),
            'data' => array_values($data),
        ];
    }

    private function numberFormat(int $value): string
    {
        return number_format($value, decimal_separator: ',', thousands_separator: '.');
    }
}
