<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // PENTING: Pastikan baris ini ada di atas!

class CategoryFactory extends Factory
{
    public function definition(): array
{
    $name = $this->faker->randomElement([
        'Web Development', 
        'Mobile Development', 
        'Data Science', 
        'Digital Marketing', 
        'Design Graphic',
        'Artificial Intelligence',
        'Cyber Security'
    ]);

    return [
        'name' => $name,
        // Ditambah angka di belakang biar DB tidak protes 'Duplicate Entry'
        'slug' => \Illuminate\Support\Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1, 9999), 
    ];
}
}