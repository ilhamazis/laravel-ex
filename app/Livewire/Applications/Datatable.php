<?php

namespace App\Livewire\Applications;

use App\Enums\ApplicationExperienceEnum;
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
    public ?string $field = 'created_at';

    #[Url]
    public ?string $direction = 'desc';

    #[Url]
    public ?string $step = null;

    #[Url]
    public ?string $status = null;

    #[Url]
    public ?string $experience = null;

    public function boot(ApplicationManagingService $applicationManagingService): void
    {
        $this->applicationManagingService = $applicationManagingService;
    }

    public function render(): View
    {
        $applications = $this->applicationManagingService->findAll(
            limit: $this->limit,
            field: $this->field,
            direction: $this->direction,
            query: $this->query,
            step: ApplicationStepEnum::tryFrom($this->step),
            status: ApplicationStatusEnum::tryFrom($this->status),
            experience: ApplicationExperienceEnum::tryFrom($this->experience),
        );

        return view('livewire.applications.datatable', ['applications' => $applications]);
    }
}
