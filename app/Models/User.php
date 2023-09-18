<?php

namespace App\Models;

use Common\Exception\UserEmailIsNotSetException;
use Common\ValueObject\Email;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property mixed $email_verified_at
 * @property string $name
 * @property string $email
 * @property mixed $actual_language_id
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'actual_language_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        if (!$this->hasEmail()) {
            throw new UserEmailIsNotSetException($this->getId());
        }

        return new Email($this->email);
    }

    private function hasEmail(): bool
    {
        return $this->email !== null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function getActualLanguageId(): int
    {
        return $this->actual_language_id;
    }

    public function setActualLanguageId(int $id): void
    {
        $this->actual_language_id = $id;
    }
}
