<?php

namespace Component\User\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\User;
use Common\Auth\Sdk\AuthFacade;
use Component\User\Sdk\UserFacade;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct(readonly UserFacade $userFacade, readonly AuthFacade $authFacade)
    {
    }

    public function setLocale(string $locale): RedirectResponse
    {
        $newLanguage = Language::findByCode($locale)->firstOrFail();/** @phpstan-ignore-line */
        /** @var User $user */
        $user = auth()->user();/** @phpstan-ignore-line */

        if ($newLanguage->getId() !== $user->getActualLanguageId()) {
            $user->setActualLanguageId($newLanguage->getId());
            $user->save();
        }

        return redirect()->back();
    }
}
