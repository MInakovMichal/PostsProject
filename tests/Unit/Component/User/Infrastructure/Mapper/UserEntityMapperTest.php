<?php

namespace Tests\Unit\Component\User\Infrastructure\Mapper;

use App\Models\User;
use Component\User\Infrastructure\Mapper\UserEntityMapper;
use Component\User\Sdk\Model\UserRead;
use Tests\AppTestCase;

class UserEntityMapperTest extends AppTestCase
{
    public function test_MapToReadModel_ShouldReturnUserRead(): void
    {
        $mapper = new UserEntityMapper();

        $user = User::factory()->make(['id' => 1]);
        $userRead = $mapper->mapToReadModel($user);

        $this->assertInstanceOf(UserRead::class, $userRead);
    }
}
