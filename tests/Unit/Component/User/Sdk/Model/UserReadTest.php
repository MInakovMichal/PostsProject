<?php

namespace Tests\Unit\Component\User\Sdk\Model;

use Common\ValueObject\Email;
use Component\User\Sdk\Model\UserRead;
use Tests\AppTestCase;

/**
 * @property int $id
 * @property string $name
 * @property Email $email
 * @property UserRead $userRead
 */
class UserReadTest extends AppTestCase
{
    public function test_GetId_ShouldReturnUserId(): void
    {
        $this->assertSame($this->id, $this->userRead->getId());
    }

    public function test_GetName_ShouldReturnUserName(): void
    {
        $this->assertSame($this->name, $this->userRead->getName());
    }

    public function test_GetEmail_ShouldReturnUserEmail(): void
    {
        $this->assertSame($this->email->getEmailAddress(), $this->userRead->getEmail()->getEmailAddress());
    }

    public function test_ToArray_ShouldReturnArray(): void
    {
        $expected = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ];

        $this->assertSame(json_encode($expected), json_encode($this->userRead->toArray()));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = 1;
        $this->name = $this->faker->name;
        $this->email = new Email($this->faker->email);

        $this->userRead = new UserRead(
            $this->id,
            $this->name,
            $this->email
        );
    }
}
