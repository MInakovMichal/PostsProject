<?php

namespace Component\Post\Infrastructure\Service;

use Common\Contract\AddPostContract;
use Common\Contract\DeletePostContract;
use Component\Post\Sdk\Model\PostRead;
use Illuminate\Database\Eloquent\Collection;

interface PostService
{
    public function addPost(AddPostContract $contract): void;

    public function getAllPosts(): Collection;

    public function findByUserId(int $userId): Collection;

    public function findByIdOrFail(int $id): PostRead;

    public function deletePost(int $id): void;
}