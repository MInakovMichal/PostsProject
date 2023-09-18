<?php

namespace Component\User\Infrastructure\Repository;

use App\Models\User;
use Common\Auth\Sdk\Contract\RegisterContract;
use Common\ValueObject\Email;
use Illuminate\Database\Eloquent\Collection;

interface UserEntityRepository
{
    public function createUser(RegisterContract $contract): void;

    public function findByEmailOrFail(Email $email): User;

    public function findByIdOrFail(int $id): User;

    public function getAllUsers(int $authUserId = null): Collection;
}
