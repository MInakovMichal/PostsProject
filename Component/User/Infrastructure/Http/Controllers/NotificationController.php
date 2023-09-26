<?php

namespace Component\User\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Common\Auth\Sdk\AuthFacade;
use Component\User\Infrastructure\Http\Requests\SendNotificationRequest;
use Component\User\Sdk\Event\CustomUserMail;
use Component\User\Sdk\UserFacade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class NotificationController extends Controller
{
    public function __construct(readonly UserFacade $userFacade, readonly AuthFacade $authFacade)
    {
    }

    public function showAddNotificationForm(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $authUserId = $this->authFacade->current()->getAuthUserId();
        $users = $this->userFacade->getAllUsers($authUserId);

        return view('notification.create')->with(['users' => $users]);
    }

    public function sendNotification(SendNotificationRequest $request): RedirectResponse
    {
        $value = $request->hasValue() ? $request->getValue() : null;
        $image = $request->hasImage() ? $request->getImage() : null;

        $authUserEmail = $this->authFacade->current()->getAuthUser()->getEmail();

        event(new CustomUserMail($request->getUserId(), $authUserEmail, $value, $image));

        return redirect()->route('notification');
    }
}
