<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $pembuka = ['Materi kelas sangat', 'Penjelasan mentor benar-benar', 'Modul kelas ini tergolong', 'Materi yang dibawakan sangat'];
        $inti = [' mudah dimengerti orang awam,', ' terstruktur rapi per sub-bab,', ' interaktif dengan contoh riil,', ' mendalam dan langsung praktek,'];
        $penutup = [' highly recommended banget!', ' ngebantu upgrade skill portofolio.', ' sangat sepadan dengan biayanya.', ' memuaskan sekali cara ngajarnya.'];

        $textKustom = $pembuka[array_rand($pembuka)] . $inti[array_rand($inti)] . $penutup[array_rand($penutup)];
        $suffix = ' (' . $this->faker->word() . ' ' . rand(100, 999) . ')';

        $course = Course::inRandomOrder()->first();
        $courseId = $course ? $course->id : Course::factory()->create()->id;

        $student = User::where('role', 'student')->inRandomOrder()->first();
        $studentId = $student ? $student->id : User::factory()->create(['role' => 'student'])->id;

        return [
            'course_id' => $courseId,
            'user_id'   => $studentId,
            'rating'    => $this->faker->numberBetween(4, 5),
            'comment'   => $textKustom . $suffix,
        ];
    }
}