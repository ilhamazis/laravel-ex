<?php

namespace Database\Factories;

use App\Enums\ApplicationStepStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApplicationStep>
 */
class ApplicationStepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => collect(ApplicationStepStatusEnum::values())->random(),
        ];
    }
}
