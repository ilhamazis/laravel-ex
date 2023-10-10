<?php

namespace App\Models;

use App\Enums\ApplicationStepStatusEnum;
use App\Traits\HasIdentifier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationStep extends Model
{
    use HasFactory, SoftDeletes, HasIdentifier;

    protected $guarded = ['id'];

    protected $casts = [
        'status' => ApplicationStepStatusEnum::class,
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function step(): BelongsTo
    {
        return $this->belongsTo(Step::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function hasReviews(): bool
    {
        return $this->reviews()->exists();
    }
}
