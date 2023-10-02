<?php

namespace Database\Factories;

use App\Enums\ApplicationStepEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Step>
 */
class StepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => collect(ApplicationStepEnum::values())->random(),
            'order' => fake()->numberBetween(1, count(ApplicationStepEnum::values())),
        ];
    }
}
