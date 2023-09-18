<?php

namespace Common\Auth\Infrastructure\Service;

use Common\Auth\Sdk\Contract\LoginContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserPasswordCheckerImpl implements UserPasswordChecker
{
    /**
     * @throws ValidationException
     */
    public function check(LoginContract $contract): void
    {
        if (!Auth::attempt(['email' => $contract->getEmail()->getEmailAddress(), 'password' => $contract->getPassword()], $contract->isRemember())) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
    }
}
