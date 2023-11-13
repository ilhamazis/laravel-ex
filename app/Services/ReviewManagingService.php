<?php

namespace App\Services;

use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ReviewManagingService
{
    /**
     * @param Application $application
     * @return Collection<Review>
     */
    public function findAll(Application $application): Collection
    {
        return $application->reviews()
            ->with('user', 'applicationStep.step')
            ->latest()
            ->get();
    }

    public function create(ApplicationStep $applicationStep, array $data): Review
    {
        return $applicationStep->reviews()->create($data + ['user_id' => Auth::id()]);
    }
}
