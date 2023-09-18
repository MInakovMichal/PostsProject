<?php

declare(strict_types=1);

namespace Common\Auth\Infrastructure\UserProvider;

use Common\Auth\Domain\UserProvider\UserProvider;
use Common\Auth\Infrastructure\Mapper\UserProviderMapper;
use Common\Auth\Sdk\Model\Authenticate;
use Common\Exception\UnauthorizedException;
use Component\User\Sdk\UserFacade;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

final class UserProviderImpl implements UserProvider
{
    public function __construct(
        readonly AuthFactory $auth,
        readonly UserProviderMapper $userProviderMapper,
        readonly UserFacade $userFacade
    ) {
    }


    /**
     * @return bool
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedMethodCall
     */
    public function isLoggedIn(): bool
    {
        return $this->auth->guard('web')->check();
    }

    /**
     * @return Authenticate
     * @psalm-suppress UndefinedInterfaceMethod
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedMethodCall
     */
    public function current(): Authenticate
    {
        $guard = $this->auth->guard('web');

        $authUser = $guard->user();
        if ($authUser === null) {
            throw new UnauthorizedException();
        }

        /** @var int $id */
        $id = $authUser->getAuthIdentifier();

        $user = $this->userFacade->findByIdOrFail($id);

        return $this->userProviderMapper->mapToAuthenticate($user);
    }
}
