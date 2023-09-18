<?php

namespace App\Models;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use App\Traits\HasIdentifier;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function createdByUser(): Attribute
    {
        return new Attribute(
            get: fn() => User::query()->where('username', $this->created_by)->first(),
        );
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
