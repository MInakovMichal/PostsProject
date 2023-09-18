<?php

declare(strict_types=1);

namespace Common\Auth\Sdk\Model;

final class Authenticate
{
    public function __construct(readonly AuthUser $authUser)
    {
    }

    public function getAuthUserId(): int
    {
        return $this->authUser->getId();
    }

    public function getAuthUser(): AuthUser
    {
        return $this->authUser;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->authUser->getId(),
            'email' => $this->authUser->getEmail(),
        ];
    }
}
