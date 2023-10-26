<x-app-layout>
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-quantum.breadcrumb :paths="$breadcrumbs"/>
            </div>
        </div>

        <x-quantum.alert variant="success" :message="session()->get('success')" dismissable/>

        @error('status')
        <x-quantum.alert variant="error" :message="$message" dismissable/>
        @enderror

        <x-cms.job-application.card-applicant
            :application="$application"
            :applicant="$application->applicant"
        />

        <x-cms.job-application.stepper
            :current-application-step="$currentApplicationStep"
            :application-steps="$applicationSteps"
            :missing-application-steps="$missingApplicationSteps"
        />

        <div class="grid">
            <div class="col-12 col-md-8">
                <div class="card">
                    <x-cms.job-application.card-navigation/>

                    {{ $slot }}
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="grid cols-1">
                    @can(\App\Enums\PermissionEnum::UPDATE_APPLICATION_STEP->value)
                        <x-cms.job-application.action
                            :application="$application"
                            :application-step="$currentApplicationStep"
                        />
                    @endcan

                    @can(\App\Enums\PermissionEnum::VIEW_APPLICATION_ATTACHMENT->value)
                        <x-cms.job-application.attachment :attachments="$attachments"/>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
