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
    $comments = [
        'Materi sangat mudah dipahami, instruktur menjelaskan dengan sangat jelas!',
        'The course content is great, but the audio quality could be improved.',
        'Sangat membantu saya dalam mengerjakan tugas akhir kuliah. Terima kasih!',
        'Great course! Highly recommended for beginners who want to learn web development.',
        'Penjelasannya terlalu cepat, tapi materinya sangat lengkap dan berbobot.',
        'Excelente curso, muy bien explicado y con ejemplos prácticos.'
    ];

    return [
        'course_id' => \App\Models\Course::factory(),
        'user_id' => \App\Models\User::factory(),
        'rating' => $this->faker->numberBetween(1, 5),
        'comment' => $this->faker->randomElement($comments), // GANTI INI
    ];
}
}
