<?php

namespace Component\User\Domain;

use Common\Auth\Sdk\Contract\RegisterContract;
use Common\ValueObject\Email;
use Component\User\Infrastructure\Service\UserService;
use Component\User\Sdk\Model\UserRead;
use Component\User\Sdk\UserFacade;
use Illuminate\Database\Eloquent\Collection;

class UserFacadeImpl implements UserFacade
{
    public function __construct(readonly UserService $userService)
    {
    }

    public function createUser(RegisterContract $contract): void
    {
        $this->userService->createUser($contract);
    }

    public function findByEmailOrFail(Email $email): UserRead
    {
        return $this->userService->findByEmailOrFail($email);
    }

    public function findByIdOrFail(int $id): UserRead
    {
        return $this->userService->findByIdOrFail($id);
    }

    public function getAllUsers(int $authUserId = null): Collection
    {
        return $this->userService->getAllUsers($authUserId);
    }
}
