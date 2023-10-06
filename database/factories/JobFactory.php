<?php

namespace Database\Factories;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraphs(asText: true),
            'type' => collect(JobTypeEnum::values())->random(),
            'status' => collect(JobStatusEnum::values())->random(),
            'start_at' => null,
            'end_at' => null,
        ];
    }
}
