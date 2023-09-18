<?php

declare(strict_types=1);

namespace Component\Language\Infrastructure\Provider;

use Component\Language\Domain\LanguageFacadeImpl;
use Component\Language\Infrastructure\Repository\LanguageRepository;
use Component\Language\Infrastructure\Repository\LanguageRepositoryImpl;
use Component\Language\Infrastructure\Service\LanguageService;
use Component\Language\Infrastructure\Service\LanguageServiceImpl;
use Component\Language\Sdk\LanguageFacade;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

final class LanguageServiceProvider extends EventServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(LanguageFacade::class, LanguageFacadeImpl::class);
        $this->app->bind(LanguageService::class, LanguageServiceImpl::class);
        $this->app->bind(LanguageRepository::class, LanguageRepositoryImpl::class);
    }
}
