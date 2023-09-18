<?php

namespace Common\ValueObject;

use InvalidArgumentException;

class RoleValueObject
{
    const ADMIN = 'admin';

    const USER = 'user';

    const AVAILABLE = [
        self::ADMIN,
        self::USER,
    ];

    public function __construct(readonly string $value)
    {
        $this->validate($value);
    }

    private function validate(string $value): void
    {
        if (!in_array($value, self::AVAILABLE, true)) {
            throw new InvalidArgumentException(
                "Value for Role is invalid: $value"
            );
        }
    }

    public static function user(): self
    {
        return new self(self::USER);
    }

    public static function admin(): self
    {
        return new self(self::ADMIN);
    }

    /**
     * @return string[]
     */
    public static function available(): array
    {
        return self::AVAILABLE;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
