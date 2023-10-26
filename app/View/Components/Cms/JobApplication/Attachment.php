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

    public function __construct(Collection $attachments)
    {
        $this->attachments = $attachments;
    }

    public function render(): View|Closure|string
    {
        return view('components.cms.job-application.attachment');
    }
}
