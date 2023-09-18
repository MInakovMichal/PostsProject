<?php

declare(strict_types=1);

namespace Common\Contract;

use Illuminate\Http\UploadedFile;

interface SendNotificationContract
{
    public function getValue(): ?string;

    public function hasValue(): bool;

    public function getImage(): ?UploadedFile;

    public function hasImage(): bool;

    public function getUserId(): int;
}
