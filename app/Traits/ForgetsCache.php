<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

trait ForgetsCache
{
    protected static function forgetCache(string $key): void
    {
        static::creating(function (Model $model) use ($key) {
            Cache::forget($key);
        });

        static::updating(function (Model $model) use ($key) {
            Cache::forget($key);
        });

        static::deleting(function (Model $model) use ($key) {
            Cache::forget($key);
        });
    }
}