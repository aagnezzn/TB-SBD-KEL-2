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
            // Fakta Logika: Mengambil ID Kursus dan User yang SUDAH ADA di database secara acak
            'course_id' => \App\Models\Course::inRandomOrder()->first()->id,
            'user_id' => \App\Models\User::where('role', 'student')->inRandomOrder()->first()->id,
            
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->randomElement($comments),
        ];
    }
}