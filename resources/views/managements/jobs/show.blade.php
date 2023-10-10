@php
    $paths = [
        ['title' => 'Jobs', 'link' => route('managements.jobs.index')],
        ['title' => $job->title],
    ];
@endphp

<x-job-layout :breadcrumbs="$paths" :job="$job">
    <div class="card__body">
        <x-rich-text-renderer id="job-description" :content="$job->description"/>
    </div>
</x-job-layout>
