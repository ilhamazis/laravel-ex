<?php

namespace App\Models;

use App\Enums\PermissionEnum;
use App\Traits\ForgetsCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory, ForgetsCache;

    protected $guarded = ['id'];

    protected $casts = [
        'name' => PermissionEnum::class,
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::forgetCache('roles_with_permissions');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
