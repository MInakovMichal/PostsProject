<?php

namespace Common\Auth\Sdk;

use Common\Auth\Sdk\Contract\LoginContract;
use Common\Auth\Sdk\Contract\RegisterContract;
use Common\Auth\Sdk\Model\Authenticate;

interface AuthFacade
{
    public function current(): Authenticate;

    public function login(LoginContract $contract): void;

    public function register(RegisterContract $contract): void;

    public function logout(): void;
}
