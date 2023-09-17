<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait HasIdentifier
{
    public static function bootHasIdentifier(): void
    {
        static::creating(function (Model $model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = Auth::user()->username;
            }

            if (!$model->isDirty('updated_by')) {
                $model->updated_by = Auth::user()->username;
            }
        });

        static::updating(function (Model $model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = Auth::user()->username;
            }
        });

        static::deleting(function (Model $model) {
            if (!$model->isDirty('deleted_by')) {
                $model->deleted_by = Auth::user()->username;
            }
        });
    }
}
