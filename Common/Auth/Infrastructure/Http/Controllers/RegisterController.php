<?php

namespace Common\Auth\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Common\Auth\Infrastructure\Http\Requests\RegisterRequest;
use Common\Auth\Infrastructure\Service\SocialiteService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function __construct(readonly SocialiteService $socialiteService)
    {
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $this->socialiteService->register($request);

        return redirect()->route('dashboard');
    }

    public function showRegistrationForm(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('auth.register');
    }
}
