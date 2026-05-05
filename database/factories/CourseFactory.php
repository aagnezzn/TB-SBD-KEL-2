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
    // Kita buat daftar judul dalam berbagai bahasa
    $judulCampur = [
        // Bahasa Indonesia
        'Belajar Laravel 11 dari Nol', 
        'Mastering Database System untuk Mahasiswa',
        // Bahasa Inggris
        'Complete Web Development Bootcamp 2026',
        'Data Science with Python for Professionals',
        // Bahasa Spanyol
        'Aprender Programación desde Cero',
        'Curso de Diseño Gráfico Profesional',
        // Bahasa Jepang
        'ゼロから始めるプログラミング入門',
        '日本語の基礎マスターコース',
        // Bahasa Thailand
        'เรียนรู้การสร้างเว็บไซต์ด้วยตัวเอง',
    ];

    // Kita buat daftar nama pengajar yang campur juga
    $pengajarCampur = [
        'Agus Pratama', 'John Doe', 'Juan Carlos', 'Akira Tanaka', 'Somchai'
    ];

    return [
        // Kita suruh Laravel pilih secara acak dari daftar di atas
        'title' => fake()->randomElement($judulCampur), 
        'description' => fake()->paragraph(3), // Ini akan tetap bahasa random (latin/inggris)
        'price' => fake()->numberBetween(100000, 2000000),
        'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
        'instructor_id' => \App\Models\User::inRandomOrder()->first()->id,
    ];
}
}
