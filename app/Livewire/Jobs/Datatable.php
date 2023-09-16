<?php

namespace App\Livewire\Jobs;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use App\Services\JobManagingService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;

    private JobManagingService $jobManagingService;

    #[Url(as: 'q', history: true)]
    public string $query = '';

    #[Url]
    public ?string $field = null;

    #[Url]
    public ?string $direction = null;

    #[Url]
    public int $limit = 20;

    #[Url]
    public ?string $type = null;

    #[Url]
    public ?string $status = null;

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

    #[On('sortCell')]
    public function sortBy(string $column): void
    {
        if ($this->field === $column) {
            $this->direction = $this->direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->direction = 'asc';
        }

        $this->field = $column;
    }

    #[On('changeSelect')]
    public function changeSelect(string $field, string $value): void
    {
        $this->$field = $value;
    }

    public function render(): View
    {
        $jobs = $this->jobManagingService->findAll(
            limit: $this->limit,
            field: $this->field,
            direction: $this->direction,
            query: $this->query,
            type: JobTypeEnum::tryFrom($this->type),
            status: JobStatusEnum::tryFrom($this->status),
        );

        return view('livewire.jobs.datatable', ['jobs' => $jobs]);
    }
}
