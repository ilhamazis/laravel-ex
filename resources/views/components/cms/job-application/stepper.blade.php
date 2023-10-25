<div class="grid cols-1" style="overflow-x: auto; padding: 1.5rem 0">
    <x-quantum.stepper>
        @foreach($applicationSteps as $applicationStep)
            <x-quantum.stepper-item
                :variant="\App\Enums\ApplicationStepStatusEnum::getStepperItemVariant($applicationStep->status)"
                :active="str_contains(
                             url()->current(),
                             route('managements.jobs.applications.steps.show', [
                                 $job, $application, $applicationStep
                             ]),
                         )"
            >
                @if($applicationStep->id === $currentApplicationStep->id)
                    {{ $applicationStep->step->name }}
                @else
                    <x-link
                        :href="route('managements.jobs.applications.steps.show', [
                                   $job, $application, $applicationStep
                               ])"
                        class="stepper__link">{{ $applicationStep->step->name }}</x-link>
                @endif
            </x-quantum.stepper-item>
        @endforeach

        @foreach($missingApplicationSteps as $applicationStep)
            <x-quantum.stepper-item>{{ $applicationStep }}</x-quantum.stepper-item>
        @endforeach
    </x-quantum.stepper>
</div>
