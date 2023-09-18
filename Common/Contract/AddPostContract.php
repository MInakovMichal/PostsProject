<?php

declare(strict_types=1);

namespace Common\Contract;

use Illuminate\Http\UploadedFile;

interface AddPostContract
{
    public function getValue(): string;

    public function hasValue(): bool;

    public function getImage(): UploadedFile;

    public function hasImage(): bool;
}
