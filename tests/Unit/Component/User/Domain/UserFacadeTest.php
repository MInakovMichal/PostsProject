<?php

namespace Tests\Unit\Component\User\Domain;

use App\Models\User;
use Common\Auth\Infrastructure\Http\Requests\RegisterRequest;
use Common\Exception\UserByEmailNotFoundException;
use Common\Exception\UserNotFoundException;
use Common\ValueObject\Email;
use Component\User\Domain\UserFacadeImpl;
use Component\User\Sdk\Model\UserRead;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Notification;
use Tests\AppTestCase;

/**
 * @property User|Collection|Model $user
 * @property \Illuminate\Contracts\Foundation\Application|Application|mixed $mock
 */
class UserFacadeTest extends AppTestCase
{
    public function test_GetAllUsers_ShouldReturnEmptyCollection(): void
    {
        $users = $this->mock->getAllUsers();

        $this->assertEmpty($users);
    }

    public function test_FindById_ShouldReturnUser_WhenUserExists(): void
    {
        $user = $this->mock->findByIdOrFail($this->user->getId());

        $this->assertInstanceOf(UserRead::class, $user);
    }

    public function test_FindById_ShouldThrowUserNotFoundException_WhenUserNotExists(): void
    {
        $this->expectException(UserNotFoundException::class);

        $this->mock->findByIdOrFail($this->user->getId() + 1);
    }

    public function test_FindByEmail_ShouldReturnUser_WhenUserExists(): void
    {
        $email = new Email(config('admin.default_admin_mail'));

        $user = $this->mock->findByEmailOrFail($email);

        $this->assertInstanceOf(UserRead::class, $user);
    }

    public function test_FindByEmail_ShouldThrowUserByEmailNotFoundException_WhenUserNotExists(): void
    {
        $email = new Email('test@email.com');
        $this->expectException(UserByEmailNotFoundException::class);

        $this->mock->findByEmailOrFail($email);
    }

    public function test_CreateUser_ShouldAddNewUser(): void
    {
        Notification::fake();
        $request = new RegisterRequest([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        $usersBefore = User::all()->count();

        $this->mock->createUser($request);

        $usersAfter = User::all()->count();

        $this->assertSame($usersBefore + 1, $usersAfter);

        Notification::assertCount(1);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->mock = app(UserFacadeImpl::class);
    }
}
