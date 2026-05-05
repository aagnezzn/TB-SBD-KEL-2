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
    $titles = [
        'Pendahuluan dan Instalasi', 'Dasar-dasar Pemrograman', 'Memahami Routing',
        'Introduction to Laravel', 'Database Migration Guide', 'Mastering Blade Templates'
    ];

    $contents = [
        'Dalam materi ini kita akan mempelajari cara melakukan instalasi environment dari awal sampai jalan.',
        'Materi ini mencakup penjelasan mendalam mengenai logika dasar dan struktur data yang efisien.',
        'Learn how to set up your first project and understand the basic architecture of the framework.',
        'Esta lección cubre los conceptos básicos necesarios para empezar a desarrollar aplicaciones web.'
    ];

    return [
        'course_id' => \App\Models\Course::factory(),
        'title' => $this->faker->randomElement($titles),
        'content' => $this->faker->randomElement($contents), // GANTI INI agar tidak Latin
        'duration' => $this->faker->numberBetween(5, 60),
    ];
}
}
