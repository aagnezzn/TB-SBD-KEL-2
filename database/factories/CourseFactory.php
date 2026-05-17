<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    public function definition(): array
    {
        // FIX: Amankan pencarian kategori agar tidak memicu error crash saat database kosong
        $category = Category::whereNotNull('parent_id')->with('children')->inRandomOrder()->first();
        if (!$category) {
            $category = Category::first() ?? Category::factory()->create();
        }
        
        $catName = $category->name;

        // Logika Judul & Bahasa Berdasarkan Kategori Luas
        if (Str::contains($catName, ['Web', 'JavaScript', 'PHP', 'Laravel', 'Angular', 'Node.js'])) {
            $title = $this->faker->randomElement(['Fullstack ' . $catName, 'Modern ' . $catName . ' Development', 'Mastering ' . $catName]);
            $lang = 'English';
        } 
        elseif (Str::contains($catName, ['Data', 'AI', 'Machine Learning', 'Python', 'Intelligence'])) {
            $title = $this->faker->randomElement(['Advanced ' . $catName . ' for Data Science', 'Building AI with ' . $catName, 'Deep Learning Masterclass']);
            $lang = 'English';
        }
        elseif (Str::contains($catName, ['Excel', 'Office', 'Word', 'PowerPoint'])) {
            $title = $this->faker->randomElement(['Panduan Lengkap ' . $catName, 'Shortcut Sakti ' . $catName, $catName . ' untuk Pemula']);
            $lang = 'Indonesia';
        }
        elseif (Str::contains($catName, ['Masakan', 'Cooking', 'Food', 'Baking', 'Roti'])) {
            $title = $this->faker->randomElement(['Resep Rahasia ' . $catName, 'Culinary Arts: ' . $catName, 'Mastering ' . $catName]);
            $lang = 'Spanish'; 
        }
        else {
            $title = "Comprehensive Guide to " . $catName;
            $lang = $this->faker->randomElement(['English', 'German', 'Indonesia']);
        }

        // FIX: Amankan pencarian ID Instruktur agar terikat murni ke user ber-role instructor
        $instructor = User::where('role', 'instructor')->inRandomOrder()->first();
        $instructorId = $instructor ? $instructor->id : User::factory()->create(['role' => 'instructor'])->id;

        // Membuat angka acak unik khusus untuk mengunci seed gambar
        $randomSeedId = $this->faker->unique()->numberBetween(1, 5000);

        return [
            'title' => $title,
            'description' => "This is a specialized course about " . $catName . " presented in " . $lang . ". Designed for all levels.",
            // FIX: Samakan server menggunakan LoremFlickr + parameter lock agar gambar membeku permanen dan serasi dengan Blade
            'image_url' => 'https://loremflickr.com/640/360/computer,office/all?lock=' . md5($randomSeedId),
            'category_id' => $category->id,
            'instructor_id' => $instructorId,
            'price' => $this->faker->randomElement([150000, 250000, 350000, 499000, 750000, 990000]),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => now(),
        ];
    }
}