<?php

namespace App\Models;

use App\Enums\RoleEnum;
use App\Traits\ForgetsCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory, ForgetsCache;

    protected $guarded = ['id'];

    protected $casts = [
        'name' => RoleEnum::class,
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::forgetCache('roles_with_permissions');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
