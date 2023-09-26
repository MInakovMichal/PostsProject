<?php

declare(strict_types=1);

namespace Component\Post\Sdk\Model;

use Illuminate\Contracts\Support\Arrayable;

final class PostRead implements Arrayable
{
    public function __construct(
        readonly int $id,
        readonly int $userId,
        readonly ?string $value = null,
        readonly ? string $imagePath = null
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userId,
            'value' => $this->value,
            'image_path' => $this->imagePath,
        ];
    }
}
