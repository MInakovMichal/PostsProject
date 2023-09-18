<?php

namespace Common\Auth\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Common\Auth\Infrastructure\Http\Requests\LoginRequest;
use Common\Auth\Sdk\AuthFacade;
use Component\User\Sdk\UserFacade;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(readonly AuthFacade $authFacade, readonly UserFacade $userFacade)
    {
    }

    public function showLoginForm(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $this->authFacade->login($request);

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->authFacade->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
