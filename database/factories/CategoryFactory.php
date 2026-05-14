<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        // 7 Kategori Utama yang kamu inginkan
        $categories = [
            'Web Development', 
            'Mobile Development', 
            'Data Science', 
            'Digital Marketing', 
            'Design Graphic',
            'Artificial Intelligence',
            'Cyber Security'
        ];

        // Pakai randomElement, tapi tambahkan proteksi unik pada slug
        $name = $this->faker->randomElement($categories);

        return [
            'name' => $name,
            // PENTING: Slug harus unik total agar migrate:fresh tidak macet
            // Kita gabungkan Nama + Angka Acak + String Pendek
            'slug' => Str::slug($name) . '-' . rand(100, 999) . '-' . Str::lower(Str::random(3)),
            'parent_id' => null, 
        ];
    }
}