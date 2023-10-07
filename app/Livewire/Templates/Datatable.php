<?php

namespace App\Livewire\Templates;

use App\Livewire\Master\Datatable as MasterDatatable;
use App\Services\TemplateManagingService;
use Illuminate\Contracts\View\View;

class Datatable extends MasterDatatable
{
    private TemplateManagingService $templateManagingService;

    public function boot(TemplateManagingService $templateManagingService): void
    {
        $this->templateManagingService = $templateManagingService;
    }

    public function render(): View
    {
        $templates = $this->templateManagingService->findAll(
            limit: $this->limit,
            field: $this->field,
            direction: $this->direction,
            query: $this->query,
        );

        return view('livewire.templates.datatable', ['templates' => $templates]);
    }
}
