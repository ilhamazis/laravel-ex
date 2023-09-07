<?php

namespace App\Models;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'type' => JobTypeEnum::class,
        'status' => JobStatusEnum::class,
        'start_at' => 'date',
        'end_at' => 'date',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
