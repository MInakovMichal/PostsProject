<?php

namespace Component\User\Sdk;

use Common\Auth\Sdk\Contract\RegisterContract;
use Common\ValueObject\Email;
use Component\User\Sdk\Model\UserRead;
use Illuminate\Database\Eloquent\Collection;

interface UserFacade
{
    public function createUser(RegisterContract $contract): void;

    public function findByEmailOrFail(Email $email): UserRead;

    public function findByIdOrFail(int $id): UserRead;

    public function getAllUsers(int $authUserId = null): Collection;
}
