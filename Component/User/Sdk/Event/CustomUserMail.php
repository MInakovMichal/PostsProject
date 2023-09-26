<?php

declare(strict_types=1);

namespace Component\User\Sdk\Event;

use Common\Contract\SendNotificationContract;
use Common\Exception\ValueNotSetException;
use Common\ValueObject\Email;
use Illuminate\Http\UploadedFile;

class CustomUserMail implements SendNotificationContract
{
    public function __construct(readonly int $userId, readonly Email $authUserEmail, readonly ?string $value = null, readonly ? UploadedFile $image = null)
    {
    }

    public function getValue(): ?string
    {
        if (!$this->hasValue()) {
            throw new ValueNotSetException();
        }
        return $this->value;
    }

    public function hasValue(): bool
    {
        return $this->value !== null;
    }

    public function getImage(): ?UploadedFile
    {
        if (!$this->hasImage()) {
            throw new ValueNotSetException();
        }
        return $this->image;
    }

    public function hasImage(): bool
    {
        return $this->image !== null;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAuthUserEmail(): Email
    {
        return $this->authUserEmail;
    }
}
