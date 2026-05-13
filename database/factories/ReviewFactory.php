<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
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

        // FIX: Proteksi null pointer murni pada database relasi review
        $course = Course::inRandomOrder()->first();
        $courseId = $course ? $course->id : Course::factory()->create()->id;

        $student = User::where('role', 'student')->inRandomOrder()->first();
        $studentId = $student ? $student->id : User::factory()->create(['role' => 'student'])->id;

        return [
            'course_id' => $courseId,
            'user_id' => $studentId,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->randomElement($comments),
        ];
    }
}