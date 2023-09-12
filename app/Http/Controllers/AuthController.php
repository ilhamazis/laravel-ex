<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthenticatingUserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function create(): View
    {
        return view('login');
    }

    public function store(LoginRequest $request, AuthenticatingUserService $authenticatingUserService)
    {
        $authenticatingUserService->authenticate($request->getCredentials(), $request->boolean('remember'));

        return redirect()->intended(route('dashboard'));
    }

    public function destroy(AuthenticatingUserService $authenticatingUserService)
    {
        $authenticatingUserService->logout();

        return redirect()->route('login');
    }
}
