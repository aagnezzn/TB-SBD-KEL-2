<?php

namespace Database\Factories;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    return [
        // Mencari ID user yang role-nya student secara acak
        'user_id' => \App\Models\User::where('role', 'student')->inRandomOrder()->first()->id,
        
        // Mencari ID kursus secara acak
        'course_id' => \App\Models\Course::inRandomOrder()->first()->id,
        
        'status' => fake()->randomElement(['active', 'completed', 'dropped']),
        'enrolled_at' => fake()->dateTimeBetween('-1 year', 'now'),
    ];
    }
}
