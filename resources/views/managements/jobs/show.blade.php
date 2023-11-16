@php
    $paths = [
        ['title' => 'Lowongan Pekerjaan', 'link' => route('managements.jobs.index')],
        ['title' => $job->title],
    ];
@endphp

<x-job-layout :breadcrumbs="$paths" :job="$job">
    <div class="card__body">
        @foreach($job->sections as $section)
            <x-rich-text-renderer id="job-section-{{ $section->order }}" :content="$section->content"/>
            @if(!$loop->last)
                <hr style="margin: 1rem 0"/>
            @endif
        @endforeach
    </div>
</x-job-layout>
