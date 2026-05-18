<?php

namespace Database\Factories;

use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    protected $model = Enrollment::class;

    public function definition(): array
    {
        // WAJIB cari student yang sudah ada dari UserSeeder
        $studentId = User::where('role', 'student')->inRandomOrder()->value('id');
        if (!$studentId) {
            $studentId = User::factory()->create(['role' => 'student'])->id;
        }

        // WAJIB cari kursus yang sudah di-import dari CSV
        $courseId = Course::inRandomOrder()->value('id');
        if (!$courseId) {
            $courseId = Course::factory()->create()->id;
        }

        return [
            'user_id' => $studentId,
            'course_id' => $courseId,
            'status' => $this->faker->randomElement(['active', 'completed', 'dropped']),
            'enrolled_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}