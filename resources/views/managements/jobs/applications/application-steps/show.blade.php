@php
    $paths = [
        ['title' => 'Jobs', 'link' => route('managements.jobs.index')],
        ['title' => $job->title, 'link' => route('managements.jobs.show', $job)],
        ['title' => 'List Pelamar', 'link' => route('managements.jobs.applications.index', $job)],
        ['title' => $application->applicant->name],
    ];
@endphp

<x-job-application-layout :breadcrumbs="$paths" :job="$job" :application="$application" :attachments="$attachments"
                          :current-application-step="$applicationStep"
                          :application-steps="$applicationSteps" :missing-application-steps="$missingApplicationSteps">

</x-job-application-layout>
