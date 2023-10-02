<?php

namespace Database\Factories;

use App\Enums\ApplicationStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => collect(ApplicationStatusEnum::values())->random(),
            'salary_before' => fake()->numberBetween(0, 1_000_000_000),
            'salary_expected' => fake()->numberBetween(0, 1_000_000_000),
        ];
    }
}
