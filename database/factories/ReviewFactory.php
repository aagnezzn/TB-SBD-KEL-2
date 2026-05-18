<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        $pembuka = ['Materi kelas sangat', 'Penjelasan mentor benar-benar', 'Modul kelas ini tergolong', 'Materi yang dibawakan sangat'];
        $inti = [' mudah dimengerti orang awam,', ' terstruktur rapi per sub-bab,', ' interaktif dengan contoh riil,', ' mendalam dan langsung praktek,'];
        $penutup = [' highly recommended banget!', ' ngebantu upgrade skill portofolio.', ' sangat sepadan dengan biayanya.', ' memuaskan sekali cara ngajarnya.'];

        $textKustom = $pembuka[array_rand($pembuka)] . $inti[array_rand($inti)] . $penutup[array_rand($penutup)];
        $suffix = ' (' . $this->faker->word() . ' ' . rand(100, 999) . ')';

        // WAJIB ambil kursus yang sudah ada
        $courseId = Course::inRandomOrder()->value('id');
        if (!$courseId) {
            $courseId = Course::factory()->create()->id;
        }

        // WAJIB ambil siswa yang sudah ada
        $studentId = User::where('role', 'student')->inRandomOrder()->value('id');
        if (!$studentId) {
            $studentId = User::factory()->create(['role' => 'student'])->id;
        }

        return [
            'course_id' => $courseId,
            'user_id'   => $studentId,
            'rating'    => $this->faker->numberBetween(4, 5),
            'comment'   => $textKustom . $suffix,
        ];
    }
}