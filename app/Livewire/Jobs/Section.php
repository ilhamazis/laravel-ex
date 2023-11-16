<?php

namespace App\Livewire\Jobs;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Section extends Component
{
    public array $sections;
    public array $errors;

    public function addSection(): void
    {
        $this->sections[] = ['content' => ''];
        $this->dispatch('section-updated', $this->sections);
    }

    public function removeSection(int $index): void
    {
        array_splice($this->sections, $index, 1);
        $this->dispatch('section-updated', $this->sections);
    }

    public function render(): View
    {
        if (count($this->sections) === 0) {
            $this->sections[] = ['content' => ''];
        }

        return view('livewire.jobs.section');
    }
}
