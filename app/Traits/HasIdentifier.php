<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait HasIdentifier
{
    public static function bootHasIdentifier(): void
    {
        static::creating(function (Model $model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = Auth::id() ?? null;
            }

            if (!$model->isDirty('updated_by')) {
                $model->updated_by = Auth::id() ?? null;
            }
        });

        static::updating(function (Model $model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = Auth::id() ?? null;
            }
        });

        static::deleting(function (Model $model) {
            if (!$model->isDirty('deleted_by')) {
                $model->deleted_by = Auth::id() ?? null;
            }
        });
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
