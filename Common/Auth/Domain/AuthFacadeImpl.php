<?php

namespace Common\Auth\Domain;

use Common\Auth\Infrastructure\Service\SocialiteService;
use Common\Auth\Sdk\AuthFacade;
use Common\Auth\Sdk\Contract\LoginContract;
use Common\Auth\Sdk\Contract\RegisterContract;
use Common\Auth\Sdk\Model\Authenticate;

class AuthFacadeImpl implements AuthFacade
{
    private SocialiteService $socialiteService;

    /**
     * @param SocialiteService $socialiteService
     */
    public function __construct(SocialiteService $socialiteService)
    {
        $this->socialiteService = $socialiteService;
    }

    public function current(): Authenticate
    {
        return $this->socialiteService->current();
    }

    public function login(LoginContract $contract): void
    {
        $this->socialiteService->login($contract);
    }

    public function register(RegisterContract $contract): void
    {
        $this->socialiteService->register($contract);
    }

    public function logout(): void
    {
        $this->socialiteService->logout();
    }
}
