<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    protected $fillable = ['name','email','password'];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $v) => bcrypt($v)
        );
    }

    // JWTSubject
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
