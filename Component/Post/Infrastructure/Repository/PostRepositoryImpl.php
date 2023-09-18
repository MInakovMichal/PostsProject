<?php

namespace Component\Post\Infrastructure\Repository;

use Common\Contract\AddPostContract;
use Common\Contract\DeletePostContract;
use Component\Post\Infrastructure\Mapper\PostEntityMapper;
use Component\Post\Sdk\Model\PostRead;
use Illuminate\Database\Eloquent\Collection;

class PostRepositoryImpl implements PostRepository
{
    public function __construct(readonly PostEntityRepository $entityRepository, readonly PostEntityMapper $postEntityMapper)
    {
    }

    public function findByIdOrFail(int $id): PostRead
    {
        $post = $this->entityRepository->findByIdOrFail($id);
        return $this->postEntityMapper->mapToReadModel($post);
    }

    public function addPost(AddPostContract $contract): void
    {
        $this->entityRepository->addPost($contract);
    }

    public function findByUserId(int $userId): Collection
    {
        return $this->entityRepository->findByUserId($userId);
    }

    public function getAllPosts(): Collection
    {
        return $this->entityRepository->getAllPosts();
    }

    public function deletePost(int $id): void
    {
        $this->entityRepository->deletePost($id);
    }
}
