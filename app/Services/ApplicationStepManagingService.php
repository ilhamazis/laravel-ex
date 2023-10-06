<?php

namespace App\Services;

use App\Enums\ApplicationStatusEnum;
use App\Enums\ApplicationStepEnum;
use App\Enums\ApplicationStepStatusEnum;
use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Step;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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

    public function moveToNextStep(ApplicationStep $applicationStep): ApplicationStep
    {
        DB::beginTransaction();

        $nextStep = Step::query()
            ->where('name', ApplicationStepEnum::nextStepFrom($applicationStep->step->name))
            ->first();

        $applicationStep->update(['status' => ApplicationStepStatusEnum::PASSED]);

        $nextApplicationStep = ApplicationStep::query()->create([
            'status' => ApplicationStepStatusEnum::ONGOING,
            'application_id' => $applicationStep->application_id,
            'step_id' => $nextStep->id,
        ]);

        $applicationStep->application()->update(['current_application_step_id' => $nextApplicationStep->id]);

        DB::commit();

        return $nextApplicationStep;
    }

    public function hire(ApplicationStep $applicationStep): void
    {
        DB::beginTransaction();

        $applicationStep->update(['status' => ApplicationStepStatusEnum::PASSED]);
        $applicationStep->application()->update(['status' => ApplicationStatusEnum::HIRED]);

        DB::commit();
    }

    public function reject(ApplicationStep $applicationStep): void
    {
        DB::beginTransaction();

        $applicationStep->update(['status' => ApplicationStepStatusEnum::REJECTED]);
        $applicationStep->application()->update(['status' => ApplicationStatusEnum::REJECTED]);

        DB::commit();
    }
}
