<?php

namespace Component\Post\Infrastructure\Repository;

use App\Models\Post;
use Common\Contract\AddPostContract;
use Illuminate\Database\Eloquent\Collection;

interface PostEntityRepository
{
    public function addPost(AddPostContract $contract): void;

    public function getAllPosts(): Collection;

    public function findByUserId(int $userId): Collection;

    public function findByIdOrFail(int $id): Post;

    public function deletePost(int $id): void;
}
