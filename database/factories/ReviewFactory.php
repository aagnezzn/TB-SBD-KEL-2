<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
    {
    return [
        // Ambil user student secara acak
        'user_id' => \App\Models\User::where('role', 'student')->inRandomOrder()->first()->id,
        // Ambil kursus secara acak
        'course_id' => \App\Models\Course::inRandomOrder()->first()->id,
        
        'rating' => fake()->numberBetween(1, 5),
        'comment' => fake()->sentence(10),
    ];
    }
}
