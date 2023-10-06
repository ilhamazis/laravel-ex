<?php

namespace App\Services;

use App\Models\ApplicationStep;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ReviewManagingService
{
    /**
     * @param ApplicationStep $applicationStep
     * @return Collection<ApplicationStep>
     */
    public function findAll(ApplicationStep $applicationStep): Collection
    {
        return Review::query()
            ->with('user')
            ->whereBelongsTo($applicationStep)
            ->get();
    }

    public function create(ApplicationStep $applicationStep, array $data): Review
    {
        return $applicationStep->reviews()->create($data + ['user_id' => Auth::id()]);
    }
}
