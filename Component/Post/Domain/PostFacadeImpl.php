<?php

namespace Component\Post\Domain;

use Common\Contract\AddPostContract;
use Common\Contract\DeletePostContract;
use Component\Post\Infrastructure\Service\PostService;
use Component\Post\Sdk\Model\PostRead;
use Component\Post\Sdk\PostFacade;
use Illuminate\Database\Eloquent\Collection;

class PostFacadeImpl implements PostFacade
{
    public function __construct(readonly PostService $postService)
    {
    }

    public function findByIdOrFail(int $id): PostRead
    {
        return $this->postService->findByIdOrFail($id);
    }

    public function addPost(AddPostContract $contract): void
    {
        $this->postService->addPost($contract);
    }

    public function findByUserId(int $userId): Collection
    {
        return $this->postService->findByUserId($userId);
    }

    public function getAllPosts(): Collection
    {
        return $this->postService->getAllPosts();
    }

    public function deletePost(int $id): void
    {
        $this->postService->deletePost($id);
    }
}
