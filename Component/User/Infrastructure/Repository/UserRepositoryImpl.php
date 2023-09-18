<?php

namespace Component\User\Infrastructure\Repository;

use Common\Auth\Sdk\Contract\RegisterContract;
use Common\ValueObject\Email;
use Component\User\Infrastructure\Mapper\UserEntityMapper;
use Component\User\Sdk\Model\UserRead;
use Illuminate\Database\Eloquent\Collection;

class UserRepositoryImpl implements UserRepository
{
    public function __construct(readonly UserEntityRepository $entityRepository, readonly UserEntityMapper $userEntityMapper)
    {
    }

    public function createUser(RegisterContract $contract): void
    {
        $this->entityRepository->createUser($contract);
    }

    public function findByEmailOrFail(Email $email): UserRead
    {
        $user = $this->entityRepository->findByEmailOrFail($email);
        return $this->userEntityMapper->mapToReadModel($user);
    }

    public function findByIdOrFail(int $id): UserRead
    {
        $user = $this->entityRepository->findByIdOrFail($id);
        return $this->userEntityMapper->mapToReadModel($user);
    }

    public function getAllUsers(int $authUserId = null): Collection
    {
        return $this->entityRepository->getAllUsers($authUserId);
    }
}
