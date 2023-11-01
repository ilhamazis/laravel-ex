<?php

namespace App\Livewire\Applications;

use App\Enums\ApplicationStatusEnum;
use App\Enums\ApplicationStepEnum;
use App\Livewire\Master\Datatable as MasterDatatable;
use App\Services\ApplicationManagingService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;

class Datatable extends MasterDatatable
{

    private ApplicationManagingService $applicationManagingService;

    #[Url]
    public ?string $step = null;

    #[Url]
    public ?string $status = null;

    public function boot(ApplicationManagingService $applicationManagingService): void
    {
        $this->applicationManagingService = $applicationManagingService;
    }

    public function render(): View
    {
        $applications = $this->applicationManagingService->findAll(
            limit: $this->limit,
            query: $this->query,
            step: ApplicationStepEnum::tryFrom($this->step),
            status: ApplicationStatusEnum::tryFrom($this->status),
        );

        return view('livewire.applications.datatable', ['applications' => $applications]);
    }
}
