<?php

namespace Component\User\Infrastructure\Repository;

use App\Models\User;
use Common\Auth\Sdk\Contract\RegisterContract;
use Common\Exception\UserByEmailNotFoundException;
use Common\Exception\UserNotFoundException;
use Common\ValueObject\Email;
use Common\ValueObject\RoleValueObject;
use Component\Language\Sdk\LanguageFacade;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;
use UnexpectedValueException;
use Illuminate\Database\Eloquent\Collection;

class UserEntityRepositoryImpl implements UserEntityRepository
{
    public function __construct(private readonly User $entity, readonly LanguageFacade $languageFacade)
    {
    }

    public function createUser(RegisterContract $contract): void
    {
        try {
            $languageCode = app()->getLocale();/** @phpstan-ignore-line */
            /** @phpstan-ignore-next-line */
            $user = $this->entity::create([
                'name' => $contract->getName(),
                'email' => $contract->getEmail()->getEmailAddress(),
                'password' => Hash::make($contract->getPassword()),
                'actual_language_id' => $this->languageFacade->findLanguageByCodeOrFail($languageCode)->getId(),
            ]);

            /** @var User $user */
            $user->assignRole(RoleValueObject::USER);

            event(new Registered($user));

            Auth::login($user);
        } catch (Throwable $exception) {
            throw new UnexpectedValueException($exception->getMessage());
        }
    }

    public function findByEmailOrFail(Email $email): User
    {
        try {
            /** @var User $user */
            $user = $this->entity::where('email', $email->getEmailAddress())->firstOrFail();

            return $user;
        } catch (ModelNotFoundException $exception) {
            throw new UserByEmailNotFoundException($email->getEmailAddress());
        }
    }

    public function findByIdOrFail(int $id): User
    {
        try {
            /** @var User $user */
            $user = $this->entity->findOrFail($id);

            return $user;
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException($id);
        }
    }

    public function getAllUsers(int $authUserId = null): Collection
    {
        /** @phpstan-ignore-next-line */
        $users = $this->entity::select('id', 'name')
            ->whereHas('roles', function ($query) {
                $query->where('name', '!=', 'admin');
            })
        ->whereNotNull('email_verified_at');
        if ($authUserId !== null) {
            $users->where('id', '!=', $authUserId);
        }
        return $users->get();
    }
}
