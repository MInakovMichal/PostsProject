<?php

namespace Component\Language\Infrastructure\Service;

use Component\Language\Infrastructure\Mapper\LanguageEntityMapper;
use Component\Language\Infrastructure\Repository\LanguageRepository;
use Component\Language\Sdk\Model\LanguageRead;
use Illuminate\Database\Eloquent\Collection;

class LanguageServiceImpl implements LanguageService
{
    public function __construct(
        readonly LanguageRepository $repository,
        readonly LanguageEntityMapper $entityMapper
    ) {
    }

    public function getAllLanguages(): Collection
    {
        return $this->repository->getAllLanguages();
    }

    public function findLanguageByCodeOrFail(string $code): LanguageRead
    {
        return $this->entityMapper->mapToReadModel($this->repository->findLanguageByCodeOrFail($code));
    }
}
