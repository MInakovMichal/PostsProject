<?php

declare(strict_types=1);

namespace Common\Auth\Sdk\Contract;

use Common\ValueObject\Email;

interface LoginContract
{
    public function hasEmail(): bool;

    public function getEmail(): Email;

    public function getPassword(): string;

    public function isRemember(): bool;
}
