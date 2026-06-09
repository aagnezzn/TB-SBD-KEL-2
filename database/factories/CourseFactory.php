<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        // Ambil kategori acak yang sudah ada dari CategorySeeder
        $category = Category::inRandomOrder()->first();
        if (!$category) {
            $category = Category::factory()->create();
        }
        
        $catName = $category->name;

        // Penentuan judul berdasarkan kata kunci kategori
        if (Str::contains($catName, ['Web', 'JavaScript', 'PHP', 'Laravel'])) {
            $title = $this->faker->randomElement(['Fullstack ' . $catName, 'Modern ' . $catName . ' Development']);
        } else {
            $title = "Mastering " . $catName . " Comprehensive Course";
        }

        // Ambil instruktur yang mutlak sudah dibuat oleh UserSeeder
        $instructorId = User::where('role', 'instructor')->inRandomOrder()->value('id');
        
        // Fallback darurat jika seeder user belum dieksekusi
        if (!$instructorId) {
            $instructorId = User::factory()->create(['role' => 'instructor'])->id;
        }

        // FAKTA PERBAIKAN: Array gambar statis bertema coding agar tidak kembar dan nyambung dengan Idemy
        $gambarCoding = [
            'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=640&q=80',
            'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=640&q=80',
            'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=640&q=80',
            'https://images.unsplash.com/photo-1526045612212-70caf35c14df?w=640&q=80',
            'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=640&q=80',
            'https://images.unsplash.com/photo-1504639725590-34d0984388bd?w=640&q=80',
        ];

        return [
            'title' => $title,
            'description' => "This is a specialized course about " . $catName . ". Designed for all levels.",
            'image_url' => fake()->randomElement($gambarCoding), // Sistem akan mengambil acak 1 link dari array $gambarCoding di atas
            'category_id' => $category->id,
            'instructor_id' => $instructorId,
            'price' => $this->faker->randomElement([150000, 250000, 350000, 500000]),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => now(),
        ];
    }
}