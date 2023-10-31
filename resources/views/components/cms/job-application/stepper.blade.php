<div class="grid cols-1" style="overflow-x: auto; padding: 1.5rem 0">
    <x-quantum.stepper>
        @foreach($applicationSteps as $applicationStep)
            <x-quantum.stepper-item
                :variant="\App\Enums\ApplicationStepStatusEnum::getStepperItemVariant($applicationStep->status)"
                :active="str_contains(
                             url()->current(),
                             route('managements.jobs.applications.steps.show', [
                                 request()->route('job'), request()->route('application'), $applicationStep
                             ]),
                         )"
            >
                {{ $applicationStep->step->name }}
            </x-quantum.stepper-item>
        @endforeach

        @foreach($missingApplicationSteps as $applicationStep)
            <x-quantum.stepper-item>{{ $applicationStep }}</x-quantum.stepper-item>
        @endforeach
    </x-quantum.stepper>
</div>
