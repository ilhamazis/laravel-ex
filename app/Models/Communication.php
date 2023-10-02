<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Communication extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
