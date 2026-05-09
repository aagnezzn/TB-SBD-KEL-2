<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Ambil Course secara acak agar sinkron
            'course_id' => Course::inRandomOrder()->first()->id ?? Course::factory(),
            
            'title' => function (array $attributes) {
                $course = Course::find($attributes['course_id']);
                $courseTitle = $course ? $course->title : '';

                // Logika Judul Materi yang Nyambung ke Judul Kursus
                if (Str::contains($courseTitle, ['Laravel', 'PHP', 'Web'])) {
                    $title = $this->faker->randomElement(['Instalasi Lingkungan Kerja', 'Memahami Routing & Middleware', 'Eloquent ORM Mendalam', 'Controller & View Logic']);
                } elseif (Str::contains($courseTitle, ['React', 'JavaScript', 'TypeScript'])) {
                    $title = $this->faker->randomElement(['Setup React Project', 'Hooks & State Management', 'Props and Component Lifecycle', 'Integration with API']);
                } elseif (Str::contains($courseTitle, ['English', 'Grammar', 'Bahasa', 'Tata Bahasa'])) {
                    $title = $this->faker->randomElement(['Basic Vocabulary', 'English Tenses Overview', 'Daily Conversations', 'Pronunciation Practice']);
                } elseif (Str::contains($courseTitle, ['Bisnis', 'Business', 'Kewirausahaan'])) {
                    $title = $this->faker->randomElement(['Analisis SWOT Bisnis', 'Strategi Pemasaran Digital', 'Manajemen Keuangan Dasar', 'Membangun Pitch Deck']);
                } else {
                    // Fallback Bahasa Beragam: Inggris, Spanyol, Indonesia
                    $title = $this->faker->randomElement([
                        'Introduction to ' . $courseTitle,
                        'Conceptos Básicos de ' . $courseTitle,
                        'Dasar-dasar ' . $courseTitle,
                        'Chapter 1: Getting Started'
                    ]);
                }

                // PROTEKSI MUTLAK: Potong paksa teks maksimal 150 karakter agar tidak merusak SQL!
                return Str::limit($title, 150, '...');
            },

            // Konten dalam Bahasa Indonesia
            'content' => 'Materi ini dirancang untuk memberikan pemahaman mendalam tentang topik kursus, mencakup teori dan praktik implementasi secara nyata.',
            
            // Link Video yang VALID agar tidak "Video Unavailable"
            'video_url' => $this->faker->randomElement([
                'https://www.youtube.com/embed/63vA8F9s7Ic', // Tutorial Laravel (Pasti Jalan)
                'https://www.youtube.com/embed/7W-T_p8m9_E', // Tutorial PHP (Pasti Jalan)
                'https://www.youtube.com/embed/OK_JCtrrv-c', // Tutorial English (Pasti Jalan)
                'https://www.youtube.com/embed/17XmQ_S0jBw', // Tutorial UI/UX (Pasti Jalan)
            ]),
        
            'duration' => $this->faker->numberBetween(15, 60),
        ];
    }
}