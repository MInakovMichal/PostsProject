<?php

declare(strict_types=1);

namespace Component\User\Sdk\Model;

use Common\ValueObject\Email;
use Illuminate\Contracts\Support\Arrayable;

final class UserRead implements Arrayable
{
    public function __construct(
        readonly int $id,
        readonly string $name,
        readonly Email $email,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
