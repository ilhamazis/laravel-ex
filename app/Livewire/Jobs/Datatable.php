<?php

namespace App\Livewire\Jobs;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use App\Livewire\Master\Datatable as MasterDatatable;
use App\Services\JobManagingService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;

class Datatable extends MasterDatatable
{
    private JobManagingService $jobManagingService;

    #[Url]
    public ?string $type = null;

    #[Url]
    public ?string $status = null;

    public function boot(JobManagingService $jobManagingService): void
    {
        $this->jobManagingService = $jobManagingService;
    }

    public function render(): View
    {
        $jobs = $this->jobManagingService->findAll(
            limit: $this->limit,
            field: $this->field,
            direction: $this->direction,
            query: $this->query,
            type: JobTypeEnum::tryFrom($this->type),
            status: JobStatusEnum::tryFrom($this->status),
        );

        return view('livewire.jobs.datatable', ['jobs' => $jobs]);
    }
}
