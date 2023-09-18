<?php

namespace Common\Auth\Infrastructure\Service;

use Common\Auth\Domain\UserProvider\UserProvider;
use Common\Auth\Infrastructure\Mapper\UserProviderMapper;
use Common\Auth\Sdk\Contract\LoginContract;
use Common\Auth\Sdk\Contract\RegisterContract;
use Common\Auth\Sdk\Model\Authenticate;
use Component\User\Sdk\UserFacade;

class SocialiteServiceImpl implements SocialiteService
{
    public function __construct(
        readonly UserProviderMapper $userProviderMapper,
        readonly UserProvider $userProvider,
        readonly UserPasswordChecker $checker,
        readonly UserFacade $userFacade
    ) {
    }


    public function login(LoginContract $contract): void
    {
        $this->checker->check($contract);
    }

    public function current(): Authenticate
    {
        return $this->userProvider->current();
    }

    public function register(RegisterContract $contract): void
    {
        $this->userFacade->createUser($contract);
    }

    public function logout(): void
    {
        /** @phpstan-ignore-next-line */
        auth()->logout();
    }
}
