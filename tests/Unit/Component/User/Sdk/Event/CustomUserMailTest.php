<?php

namespace Tests\Unit\Component\User\Sdk\Event;

use Common\ValueObject\Email;
use Component\User\Sdk\Event\CustomUserMail;
use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use Tests\AppTestCase;

/**
 * @property int $id
 * @property string $value
 * @property Email $email
 * @property File $file
 * @property CustomUserMail $userRead
 */
class CustomUserMailTest extends AppTestCase
{
    public function test_GetId_ShouldReturnUserId(): void
    {
        $this->assertSame($this->id, $this->userRead->getUserId());
    }

    public function test_GetValue_ShouldReturnValue(): void
    {
        $this->assertTrue($this->userRead->hasValue());
        $this->assertSame($this->value, $this->userRead->getValue());
    }

    public function test_GetImage_ShouldReturnImage(): void
    {
        $this->assertTrue($this->userRead->hasImage());
        $this->assertSame($this->file, $this->userRead->getImage());
    }

    public function test_GetAuthUserEmail_ShouldReturnUserEmail(): void
    {
        $this->assertSame($this->email, $this->userRead->getAuthUserEmail());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = 1;
        $this->value = $this->faker->sentence;
        $this->email = new Email($this->faker->email);
        $this->file = UploadedFile::fake()->create('image.jpg', 500);

        $this->userRead = new CustomUserMail(
            $this->id,
            $this->email,
            $this->value,
            $this->file
        );
    }
}
