<?php

namespace Component\Language\Infrastructure\Repository;

use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

interface LanguageRepository
{
    public function getAllLanguages(): Collection;

    public function findLanguageByCodeOrFail(string $code): Language;
}
