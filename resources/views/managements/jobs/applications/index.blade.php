@php
    $paths = [
        ['title' => 'Jobs', 'link' => route('managements.jobs.index')],
        ['title' => $job->title, 'link' => route('managements.jobs.show', $job)],
        ['title' => 'List Pelamar'],
    ];
@endphp

<x-job-layout :breadcrumbs="$paths" :job="$job">
    <livewire:applications.datatable :job="$job"/>
</x-job-layout>
