<?php

declare(strict_types=1);

namespace Component\Post\Infrastructure\Provider;

use Component\Post\Domain\PostFacadeImpl;
use Component\Post\Infrastructure\Repository\PostEntityRepository;
use Component\Post\Infrastructure\Repository\PostEntityRepositoryImpl;
use Component\Post\Infrastructure\Repository\PostRepository;
use Component\Post\Infrastructure\Repository\PostRepositoryImpl;
use Component\Post\Infrastructure\Service\PostService;
use Component\Post\Infrastructure\Service\PostServiceImpl;
use Component\Post\Sdk\PostFacade;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

final class PostServiceProvider extends EventServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(PostFacade::class, PostFacadeImpl::class);
        $this->app->bind(PostService::class, PostServiceImpl::class);
        $this->app->bind(PostRepository::class, PostRepositoryImpl::class);
        $this->app->bind(PostEntityRepository::class, PostEntityRepositoryImpl::class);
    }
}
