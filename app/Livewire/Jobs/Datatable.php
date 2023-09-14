<?php

namespace App\Livewire\Jobs;

use App\Services\JobManagingService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;

    private JobManagingService $jobManagingService;

    #[Url(as: 'q', history: true)]
    public string $query = '';

    public function boot(JobManagingService $jobManagingService): void
    {
        $this->jobManagingService = $jobManagingService;
    }

    public function updated(mixed $property): void
    {
        if ($property === 'query') {
            $this->resetPage();
        }
    }

    public function render(): View
    {
        $jobs = $this->jobManagingService->findAll(limit: 20, query: $this->query);

        return view('livewire.jobs.datatable', ['jobs' => $jobs]);
    }
}
