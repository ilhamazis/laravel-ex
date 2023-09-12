<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function __invoke()
    {
        abort_if(Gate::denies(PermissionEnum::VIEW_DASHBOARD->value), 404);
        
        return view('dashboard');
    }
}
