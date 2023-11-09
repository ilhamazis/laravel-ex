<?php

namespace App\Livewire\Landing;

use App\Enums\JobTypeEnum;
use App\Livewire\Master\Datatable as MasterDatatable;
use App\Services\JobApplyingService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;

class Datatable extends MasterDatatable
{
    private JobApplyingService $jobApplyingService;

    public int $limit = 9;

    #[Url]
    public ?string $type = null;

    #[Url]
    public ?string $location = null;

    public function boot(JobApplyingService $jobApplyingService): void
    {
        $this->jobApplyingService = $jobApplyingService;
    }

    public function extendLimit(): void
    {
        $this->limit += 9;
    }

    public function render(): View
    {
        $jobs = $this->jobApplyingService->findAll(
            limit: $this->limit,
            query: $this->query,
            type: JobTypeEnum::tryFrom($this->type),
            location: $this->location ?: null,
        );

        $jobLocations = $this->jobApplyingService->getLocations();

        return view('livewire.landing.datatable', [
            'jobs' => $jobs,
            'jobLocations' => $jobLocations,
        ]);
    }
}
