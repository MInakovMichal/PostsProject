<?php

declare(strict_types=1);

namespace Common\ValueObject;

use Common\Exception\InvalidArgumentException;

final class Email
{
    public function __construct(readonly string $emailAddress)
    {
        $this->validate($emailAddress);
    }

    private function validate(string $emailAddress): void
    {
        if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException("Invalid email signature");
        }
    }

    public function equals(self $object): bool
    {
        return strtolower($this->emailAddress) === strtolower($object->getEmailAddress());
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }
}
