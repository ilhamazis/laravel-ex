<?php

namespace Database\Factories;

use App\Enums\ApplicationExperienceEnum;
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
            'photo' => 'dummy.png',
            'name' => fake()->name(),
            'nik' => fake()->numberBetween(1000000000, 2147483647),
            'place_of_birth' => fake()->city(),
            'date_of_birth' => fake()->date(),
            'gender' => collect(['Laki-laki', 'Perempuan'])->random(),
            'is_married' => fake()->boolean(),
            'address' => fake()->address(),
            'email' => fake()->safeEmail(),
            'telephone' => fake()->numberBetween(8000000000, 8999999999),
            'education' => collect(['S3', 'S2', 'S1', 'D4', 'D3', 'D2', 'D1', 'SMK', 'SMA'])->random(),
            'school' => fake()->company(),
            'faculty' => fake()->words(asText: true),
            'major' => fake()->words(asText: true),
            'experience' => collect(ApplicationExperienceEnum::values())->random(),
            'linkedin_url' => fake()->url(),
        ];
    }
}
