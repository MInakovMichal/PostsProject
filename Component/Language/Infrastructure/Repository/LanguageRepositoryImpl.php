<?php

namespace Component\Language\Infrastructure\Repository;

use App\Models\Language;
use Common\Exception\LanguageByCodeNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LanguageRepositoryImpl implements LanguageRepository
{
    /**
     * @param Language $entity
     */
    public function __construct(
        readonly Language $entity,
    ) {
    }

    public function getAllLanguages(): Collection
    {
        return $this->entity->all();
    }

    public function findLanguageByCodeOrFail(string $code): Language
    {
        try {
            /** @var Language $language */
            $language = $this->entity::where('code', $code)->firstOrFail();

            return $language;
        } catch (ModelNotFoundException $exception) {
            throw new LanguageByCodeNotFoundException($code);
        }
    }
}
