<?php

namespace Component\Post\Infrastructure\Repository;

use App\Models\Post;
use Common\Auth\Sdk\AuthFacade;
use Common\Contract\AddPostContract;
use Common\Exception\PostNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;
use UnexpectedValueException;

class PostEntityRepositoryImpl implements PostEntityRepository
{
    public function __construct(private readonly Post $entity, readonly AuthFacade $authFacade)
    {
    }

    public function findByUserId(int $userId): Collection
    {
        return $this->entity::where('user_id', $userId)->get();
    }

    public function addPost(AddPostContract $contract): void
    {
        try {
            $userId = $this->authFacade->current()->getAuthUserId();

            $newEntity = new $this->entity();
            $newEntity->setUserId($userId);

            if ($contract->hasValue()) {
                $newEntity->setValue($contract->getValue());
            }
            if ($contract->hasImage()) {
                $image = $contract->getImage();
                $imageName = $image->getClientOriginalName();
                $image->storeAs('/public', $imageName);

                $newEntity->setImagePath($imageName);
            }
            $newEntity->save();
        } catch (Throwable $exception) {
            throw new UnexpectedValueException($exception->getMessage());
        }
    }

    public function getAllPosts(): Collection
    {
        return $this->entity::with('user')->orderBy('created_at', 'DESC')->get();/** @phpstan-ignore-line */
    }

    public function deletePost(int $id): void
    {
        $post = $this->findByIdOrFail($id);
        $post->delete();
    }

    public function findByIdOrFail(int $id): Post
    {
        try {
            /** @var Post $post */
            $post = $this->entity->findOrFail($id);

            return $post;
        } catch (ModelNotFoundException $e) {
            throw new PostNotFoundException($id);
        }
    }
}
