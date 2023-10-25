<?php

namespace App\Models;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use App\Traits\HasIdentifier;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Job extends Model
{
    use HasFactory, SoftDeletes, HasIdentifier, HasSlug;

    protected $guarded = ['id'];

    protected $casts = [
        'type' => JobTypeEnum::class,
        'status' => JobStatusEnum::class,
        'start_at' => 'date',
        'end_at' => 'date',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function scopeIsActive(Builder $query): void
    {
        $query->where('status', JobStatusEnum::PUBLISHED)
            ->where(function (Builder $q) {
                $q->whereNull('start_at')
                    ->orWhereDate('start_at', '<=', today());
            })->where(function (Builder $q) {
                $q->whereNull('end_at')
                    ->orWhereDate('end_at', '>=', today());
            });
    }
}
