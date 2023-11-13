@php
    $paths = [
        ['title' => 'Lowongan Pekerjaan', 'link' => route('managements.jobs.index')],
        ['title' => $job->title, 'link' => route('managements.jobs.show', $job)],
        ['title' => 'List Pelamar'],
    ];
@endphp

<x-job-layout :breadcrumbs="$paths" :job="$job">
    <livewire:jobs.applications.datatable :job="$job"/>
</x-job-layout>
