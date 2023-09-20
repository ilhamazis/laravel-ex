<?php

namespace App\Livewire\Master;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;

    #[Url(as: 'q', history: true)]
    public string $query = '';

    #[Url]
    public ?string $field = null;

    #[Url]
    public ?string $direction = null;

    #[Url]
    public int $limit = 20;

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
}
