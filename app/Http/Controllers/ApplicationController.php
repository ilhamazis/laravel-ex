<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:' . PermissionEnum::VIEW_APPLICATION->value)->only(['index']);
    }
    
    public function index(): View
    {
        return view('managements.applications.index');
    }
}
