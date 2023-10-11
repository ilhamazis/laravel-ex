<?php

namespace App\Services;

use App\Models\ApplicationStep;
use App\Models\Note;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class NoteManagingService
{
    /**
     * @param ApplicationStep $applicationStep
     * @return Collection<ApplicationStep>
     */
    public function findAll(ApplicationStep $applicationStep): Collection
    {
        return Note::query()
            ->with('user')
            ->whereBelongsTo($applicationStep)
            ->latest()
            ->get();
    }

    public function create(ApplicationStep $applicationStep, array $data): Note
    {
        return $applicationStep->notes()->create($data + ['user_id' => Auth::id()]);
    }
}
