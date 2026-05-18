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

        return [
            'title' => $title,
            'description' => "This is a specialized course about " . $catName . ". Designed for all levels.",
            'image_url' => 'https://loremflickr.com/640/360/computer,office/all?lock=' . rand(1, 1000),
            'category_id' => $category->id,
            'instructor_id' => $instructorId,
            'price' => $this->faker->randomElement([150000, 250000, 350000, 500000]),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => now(),
        ];
    }
}