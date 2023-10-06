<?php

namespace App\Models;

use App\Enums\ApplicationStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'status' => ApplicationStatusEnum::class,
    ];

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function currentApplicationStep(): BelongsTo
    {
        return $this->belongsTo(ApplicationStep::class, 'current_application_step_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function communications(): HasMany
    {
        return $this->hasMany(Communication::class);
    }

    public function applicationSteps(): HasMany
    {
        return $this->hasMany(ApplicationStep::class);
    }

    public function salaryBefore(): Attribute
    {
        return new Attribute(
            get: fn(string $value) => $value
                ? 'Rp ' . number_format($value, decimal_separator: ',', thousands_separator: '.') . ',-'
                : '-',
        );
    }

    public function salaryExpected(): Attribute
    {
        return new Attribute(
            get: fn(string $value) => $value
                ? 'Rp ' . number_format($value, decimal_separator: ',', thousands_separator: '.') . ',-'
                : '-',
        );
    }
}
