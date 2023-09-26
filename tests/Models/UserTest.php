<?php

namespace Tests\Models;

use App\Models\Language;
use App\Models\User;
use Common\Exception\UserEmailIsNotSetException;
use Common\ValueObject\Email;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Tests\AppTestCase;

/**
 * @property int $id
 * @property User|Collection|Model $user
 * @property string $name
 * @property Email $email
 */
class UserTest extends AppTestCase
{
    public function test_GetId_ShouldReturnUserId(): void
    {
        $this->assertSame($this->id, $this->user->getId());
    }

    public function test_GetName_ShouldReturnUserName(): void
    {
        $this->assertSame($this->name, $this->user->getName());
    }

    public function test_IsVerified_ShouldReturnTrue_WhenUserVerifiedEmail(): void
    {
        $this->user->email_verified_at = Carbon::now();
        $this->assertTrue($this->user->isVerified());
    }

    public function test_IsVerified_ShouldReturnFalse_WhenUserNotVerifiedEmail(): void
    {
        $this->user->email_verified_at = null;
        $this->assertFalse($this->user->isVerified());
    }

    public function test_GetEmail_ShouldReturnUserEmail(): void
    {
        $this->assertSame($this->email->getEmailAddress(), $this->user->getEmail()->getEmailAddress());
    }

    public function test_GetEmail_ShouldThrowUserEmailIsNotSetException_WhenUserHasNoEmail(): void
    {
        $this->user->email = null;
        $this->expectException(UserEmailIsNotSetException::class);
        $this->user->getEmail();
    }

    public function test_SetActualLanguageId_ShouldUpdateActualLanguageId(): void
    {
        $language = Language::findByCode('pl')->first();
        $this->user->setActualLanguageId($language->getId());

        $this->assertSame($language->getId(), $this->user->getActualLanguageId());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = 1;
        $this->name = $this->faker->name;
        $this->email = new Email($this->faker->email);

        $this->user = User::factory()->make([
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email->getEmailAddress(),
        ]);
    }
}
