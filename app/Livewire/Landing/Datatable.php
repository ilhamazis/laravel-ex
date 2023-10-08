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

    #[Url]
    public int $limit = 9;

    #[Url]
    public ?string $type = null;

    public function boot(JobApplyingService $jobApplyingService): void
    {
        $this->jobApplyingService = $jobApplyingService;
    }

    public function render(): View
    {
        $jobs = $this->jobApplyingService->findAll(
            limit: $this->limit,
            query: $this->query,
            type: JobTypeEnum::tryFrom($this->type),
        );

        return view('livewire.landing.datatable', ['jobs' => $jobs]);
    }
}
