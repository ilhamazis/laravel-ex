@php
    $paths = [
        ['title' => 'Lowongan Pekerjaan', 'link' => route('managements.jobs.index')],
        ['title' => $job->title],
    ];
@endphp

<x-job-layout :breadcrumbs="$paths" :job="$job">
    <div class="card__body">
        <div class="custom__ql-container">
            {!! $job->description !!}
        </div>
    </div>
</x-job-layout>
