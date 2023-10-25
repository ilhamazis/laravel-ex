<?php

namespace App\View\Components\Cms\JobApplication;

use App\Models\Attachment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AttachmentItem extends Component
{
    public function __construct(public Attachment $attachment)
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.cms.job-application.attachment-item');
    }
}
