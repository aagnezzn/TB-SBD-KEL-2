<?php

namespace Database\Factories;

use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enrollment>
 */
class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        // FIX: Proteksi null pointer. Jika student/course kosong, sistem akan meng-generate otomatis lewat factory pendukung
        $student = User::where('role', 'student')->inRandomOrder()->first();
        $studentId = $student ? $student->id : User::factory()->create(['role' => 'student'])->id;

        $course = Course::inRandomOrder()->first();
        $courseId = $course ? $course->id : Course::factory()->create()->id;

        return [
            'user_id' => $studentId,
            'course_id' => $courseId,
            'status' => fake()->randomElement(['active', 'completed', 'dropped']),
            'enrolled_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}