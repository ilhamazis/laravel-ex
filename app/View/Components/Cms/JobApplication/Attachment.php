<?php

namespace App\View\Components\Cms\JobApplication;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Attachment extends Component
{
    /** @var Collection<\App\Models\Attachment> */
    public Collection $attachments;

    public bool $showForm;

    public function __construct(Collection $attachments, bool $showForm)
    {
        $this->attachments = $attachments;
        $this->showForm = $showForm;
    }

    public function render(): View|Closure|string
    {
        return view('components.cms.job-application.attachment');
    }
}
