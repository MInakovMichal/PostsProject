<?php

namespace Component\User\Infrastructure\Service;

use Common\Auth\Sdk\Contract\RegisterContract;
use Common\ValueObject\Email;
use Component\User\Infrastructure\Repository\UserRepository;
use Component\User\Sdk\Model\UserRead;
use Illuminate\Database\Eloquent\Collection;

class UserServiceImpl implements UserService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function createUser(RegisterContract $contract): void
    {
        $this->userRepository->createUser($contract);
    }

    public function findByEmailOrFail(Email $email): UserRead
    {
        return $this->userRepository->findByEmailOrFail($email);
    }

    public function findByIdOrFail(int $id): UserRead
    {
        return $this->userRepository->findByIdOrFail($id);
    }

    public function getAllUsers(int $authUserId = null): Collection
    {
        return $this->userRepository->getAllUsers($authUserId);
    }
}
