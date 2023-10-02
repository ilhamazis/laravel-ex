<?php

namespace App\Models;

use App\Enums\ApplicationStepEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Step extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'name' => ApplicationStepEnum::class,
    ];

    public function applicationSteps(): HasMany
    {
        return $this->hasMany(ApplicationStep::class);
    }
}
