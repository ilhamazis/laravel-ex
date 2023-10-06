<?php

namespace App\Models;

use App\Traits\HasIdentifier;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory, SoftDeletes, HasIdentifier;

    protected $guarded = ['id'];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function fileName(): Attribute
    {
        return new Attribute(
            get: fn() => pathinfo($this->path, PATHINFO_BASENAME),
        );
    }

    public function fileExtension(): Attribute
    {
        return new Attribute(
            get: fn() => pathinfo($this->path, PATHINFO_EXTENSION),
        );
    }

    public function fileSize(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::exists($this->path)
                ? round(Storage::size($this->path) / 1000)
                : 0,
        );
    }
}
