<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string|null $value
 * @property int $user_id
 * @property string|null $image_path
 * @property mixed $created_at
 * @property mixed $user
 */
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'value',
        'user_id',
        'image_path'
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getImagePath(): ?string
    {
        return $this->image_path;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    public function setUserId(int $userId): void
    {
        $this->user_id = $userId;
    }

    public function setImagePath(?string $imagePath): void
    {
        $this->image_path = $imagePath;
    }

    public function hasValue(): bool
    {
        return $this->value !== null;
    }

    public function hasImage(): bool
    {
        return $this->image_path !== null;
    }

}
