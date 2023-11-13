<?php

namespace App\Models;

use App\Enums\ApplicationExperienceEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Applicant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'date_of_birth' => 'date',
        'experience' => ApplicationExperienceEnum::class,
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
