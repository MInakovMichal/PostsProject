<?php

declare(strict_types=1);

namespace Component\Language\Sdk\Model;

use Illuminate\Contracts\Support\Arrayable;

final class LanguageRead implements Arrayable
{
    public function __construct(
        readonly int $id,
        readonly string $name,
        readonly string $code,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
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
            'code' => $this->code,
        ];
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
