<?php

declare(strict_types=1);

namespace Component\User\Infrastructure\Listeners;

use App\Models\User;
use Component\User\Infrastructure\Mail\CustomMail;
use Component\User\Sdk\Event\CustomUserMail;
use Component\User\Sdk\UserFacade;
use Illuminate\Support\Facades\Mail;

class SendCustomUserMailListener
{
    public function __construct(readonly UserFacade $userFacade)
    {
    }

    public function handle(CustomUserMail $event): void
    {
        $data = [];

        /** @var User $user */
        $user = $this->userFacade->findByIdOrFail($event->getUserId());

        $data['user_id'] = $user->getId();
        $data['user_email'] = $event->getAuthUserEmail()->getEmailAddress();

        if ($event->hasValue()) {
            $data['value'] = $event->getValue();
        }

        if ($event->hasImage()) {
            $image = $event->getImage();
            $imageName = $image->getClientOriginalName();/** @phpstan-ignore-line */
            $image->storeAs('/public', $imageName);/** @phpstan-ignore-line */

            $data['image'] = $imageName;
        }

        Mail::to($user->getEmail()->getEmailAddress())->send(new CustomMail($data));/** @phpstan-ignore-line */
    }
}
