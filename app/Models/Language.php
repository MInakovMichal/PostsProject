<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 */
class Language extends Model
{
    use HasFactory;

    public $fillable = [
        'id',
        'name',
        'code',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function scopeFindByCode(Builder $query, string $code): void
    {
        $query->where('code', strtoupper($code));
    }
}
