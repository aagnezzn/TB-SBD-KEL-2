<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        // Mencari ID dari tabel courses yang sudah kamu isi 1000 data tadi
        'course_id' => \App\Models\Course::inRandomOrder()->first()->id,
        
        'title' => fake()->sentence(3), // Misal: "Pengenalan Dasar Database"
        'content' => fake()->paragraphs(3, true), // Penjelasan materi teks
        'video_url' => 'https://youtube.com/embed/' . fake()->slug(1), // Simulasi link video
        'duration' => fake()->numberBetween(5, 45), // Durasi 5-45 menit
    ];
}
}
