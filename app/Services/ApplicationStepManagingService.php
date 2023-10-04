<?php

namespace App\Services;

use App\Enums\ApplicationStepEnum;
use App\Models\Application;
use App\Models\ApplicationStep;
use Illuminate\Database\Eloquent\Collection;

class ApplicationStepManagingService
{
    /**
     * @param Application $application
     * @return Collection<ApplicationStep>
     */
    public function findAll(Application $application): Collection
    {
        return ApplicationStep::query()
            ->whereBelongsTo($application)
            ->get();
    }

    public function find(string $id): ApplicationStep
    {
        return ApplicationStep::with('step')->find($id);
    }

    /**
     * @param Collection<ApplicationStep> $createdApplicationSteps
     * @return array
     */
    public function getMissingSteps(Collection $createdApplicationSteps): array
    {
        $createdApplicationSteps = $createdApplicationSteps->load('step')
            ->map(fn(ApplicationStep $applicationStep) => $applicationStep->step->name->value)
            ->toArray();

        return array_diff(ApplicationStepEnum::values(), $createdApplicationSteps);
    }
}
