<?php

namespace Component\Post\Infrastructure\Service;

use Common\Contract\AddPostContract;
use Common\Contract\DeletePostContract;
use Component\Post\Infrastructure\Repository\PostRepository;
use Component\Post\Sdk\Model\PostRead;
use Illuminate\Database\Eloquent\Collection;

class PostServiceImpl implements PostService
{
    public function __construct(private readonly PostRepository $postRepository)
    {
    }

    public function findByIdOrFail(int $id): PostRead
    {
        return $this->postRepository->findByIdOrFail($id);
    }

    public function addPost(AddPostContract $contract): void
    {
        $this->postRepository->addPost($contract);
    }

    public function findByUserId(int $userId): Collection
    {
        return $this->postRepository->findByUserId($userId);
    }

    public function getAllPosts(): Collection
    {
        return $this->postRepository->getAllPosts();
    }

    public function deletePost(int $id): void
    {
        $this->postRepository->deletePost($id);
    }
}
