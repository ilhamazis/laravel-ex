<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public bool $headerStatic;

    public function __construct(bool $headerStatic = false)
    {
        $this->headerStatic = $headerStatic;
    }

    public function render(): View|Closure|string
    {
        return view('layouts.app');
    }
}
