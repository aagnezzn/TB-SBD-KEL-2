<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        // Ambil ID kategori secara acak dari yang sudah kamu seeder tadi
        'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
        // Ambil user ID yang rolenya 'instructor' secara acak
        'instructor_id' => \App\Models\User::where('role', 'instructor')->inRandomOrder()->first()->id,
        
        'title' => fake()->sentence(4),
        'description' => fake()->paragraph(),
        'price' => fake()->numberBetween(100000, 1000000), // Range harga 100rb - 1jt
        'image_url' => 'course_default.jpg',
    ];
}
}
