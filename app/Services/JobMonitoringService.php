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
    public function getActiveJobsCount(): int
    {
        return $this->numberFormat(Job::query()->isActive()->count());
    }

    public function getApplicationsCount(): int
    {
        return $this->numberFormat(Application::query()->count());
    }

    public function getApplicationsCountFromRange(Carbon $from, Carbon $to): int
    {
        return $this->numberFormat(
            Application::query()
                ->whereBetween('created_at', [$from, $to])
                ->count()
        );
    }

    /**
     * @param int $year
     * @return array<string, int>
     */
    public function getApplicationsCountPerMonth(int $year): array
    {
        $applicationsPerMonthCount = Application::query()
            ->select(DB::raw("DATE_TRUNC('MONTH', created_at) as month"), DB::raw("COUNT(*) as total"))
            ->whereBetween('created_at', [now()->setYear($year)->startOfYear(), now()->setYear($year)->endOfYear()])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        /**
         * base months, value is:
         * [
         *     'Jan 2023' => 0,
         *     'Feb 2023' => 0,
         *     etc...
         *     'Oct 2023' => null,
         *     etc...
         * ]
         */
        $months = collect($this->getMonthsFromYear($year))
            ->mapWithKeys(function (string $item, int $key) use ($year) {
                if (now()->year === $year) {
                    return [$item => $key < now()->month ? 0 : null];
                }

                return [$item => 0];
            });

        // count per month in DB, structure is same as base months
        $applicationsPerMonthCount = $applicationsPerMonthCount->mapWithKeys(function ($item) {
            // key is month & date, example: Jan 2023
            $key = Carbon::parse($item->month)->format('M Y');

            return [$key => $item->total];
        });

        // merge base months and count per month
        return $months->merge($applicationsPerMonthCount)->toArray();
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

    private function numberFormat(int $value): int
    {
        return number_format($value, decimal_separator: ',', thousands_separator: '.');
    }

    /**
     * @param int $year
     * @return array<string>
     */
    private function getMonthsFromYear(int $year): array
    {
        $start = now()->setYear($year)->startOfYear();
        $end = now()->setYear($year)->endOfYear();

        $months = [];
        foreach (CarbonPeriod::create($start, '1 month', $end) as $month) {
            $months[] = $month->format('M Y');
        }

        return $months;
    }
}
