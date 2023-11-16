<?php

namespace App\Services;

use App\Models\Application;
use App\Models\ApplicationStep;
use App\Models\Note;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class NoteManagingService
{
    /**
     * @param Application $application
     * @return Collection<Review>
     */
    public function findAll(Application $application): Collection
    {
        return $application->notes()
            ->with('user', 'applicationStep.step')
            ->latest()
            ->get();
    }

    public function create(ApplicationStep $applicationStep, array $data): Note
    {
        return $applicationStep->notes()->create($data + ['user_id' => Auth::id()]);
    }
}
