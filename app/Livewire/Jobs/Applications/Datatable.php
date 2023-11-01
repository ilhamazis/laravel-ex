<?php

namespace App\Livewire\Jobs\Applications;

use App\Enums\ApplicationStatusEnum;
use App\Enums\ApplicationStepEnum;
use App\Livewire\Master\Datatable as MasterDatatable;
use App\Models\Job;
use App\Services\JobApplicationManagingService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;

class Datatable extends MasterDatatable
{
    private JobApplicationManagingService $applicationManagingService;

    public Job $job;

    #[Url]
    public ?string $field = 'created_at';

    #[Url]
    public ?string $direction = 'desc';

    #[Url]
    public ?string $step = null;

    #[Url]
    public ?string $status = null;

    public function boot(JobApplicationManagingService $applicationManagingService): void
    {
        $this->applicationManagingService = $applicationManagingService;
    }

    public function render(): View
    {
        $applications = $this->applicationManagingService->findAll(
            job: $this->job,
            limit: $this->limit,
            field: $this->field,
            direction: $this->direction,
            query: $this->query,
            step: ApplicationStepEnum::tryFrom($this->step),
            status: ApplicationStatusEnum::tryFrom($this->status),
        );

        return view('livewire.jobs.applications.datatable', ['applications' => $applications]);
    }
}
