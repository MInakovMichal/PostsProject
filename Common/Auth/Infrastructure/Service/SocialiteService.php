<?php

namespace Common\Auth\Infrastructure\Service;

use Common\Auth\Sdk\Contract\LoginContract;
use Common\Auth\Sdk\Contract\RegisterContract;
use Common\Auth\Sdk\Model\Authenticate;

interface SocialiteService
{
    public function login(LoginContract $contract): void;

    public function current(): Authenticate;

    public function register(RegisterContract $contract): void;

    public function logout(): void;
}
