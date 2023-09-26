<?php

namespace Common\ValueObject;

use InvalidArgumentException;

class PermissionValueObject
{
    const CAN_DELETE_POST = 'can_delete_post';

    const AVAILABLE = [
        self::CAN_DELETE_POST,
    ];

    public function __construct(readonly string $value)
    {
        $this->validate($value);
    }

    private function validate(string $value): void
    {
        if (!in_array($value, self::AVAILABLE, true)) {
            throw new InvalidArgumentException(
                "Value for permission is invalid: $value"
            );
        }
    }

    public static function canDeletePost(): self
    {
        return new self(self::CAN_DELETE_POST);
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
