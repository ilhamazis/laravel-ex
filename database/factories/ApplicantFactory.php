<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Applicant>
 */
class ApplicantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'telephone' => fake()->phoneNumber(),
            'age' => fake()->numberBetween(18, 100),
            'is_married' => fake()->boolean(),
            'address' => fake()->address(),
            'education' => collect(['S3', 'S2', 'S1', 'SMK', 'SMA', 'SMP', 'SD'])->random(),
            'school' => fake()->company(),
            'faculty' => fake()->words(asText: true),
            'major' => fake()->words(asText: true),
            'experience' => fake()->randomNumber(100),
        ];
    }
}
