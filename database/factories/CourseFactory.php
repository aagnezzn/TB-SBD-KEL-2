<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
    $category = \App\Models\Category::whereNotNull('parent_id')->inRandomOrder()->first();
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
    elseif (Str::contains($catName, ['Bahasa', 'English', 'Grammar', 'Deutsch', 'Français', 'Spanish'])) {
        $title = $this->faker->randomElement([$catName . ' level A1-C2', 'Practical ' . $catName . ' Conversation', 'Advanced ' . $catName . ' Grammar']);
        $lang = $this->faker->randomElement(['English', 'German', 'Spanish', 'French']);
    }
    elseif (Str::contains($catName, ['Desain', 'Design', 'Figma', 'UI', 'UX', 'Photoshop', 'Graphic'])) {
        $title = $this->faker->randomElement([$catName . ' for Creative Professionals', 'Design Thinking & ' . $catName, 'Visual Branding with ' . $catName]);
        $lang = $this->faker->randomElement(['English', 'Indonesia']);
    }
    elseif (Str::contains($catName, ['Bisnis', 'Business', 'Kewirausahaan', 'Marketing', 'Sales'])) {
        $title = $this->faker->randomElement(['Strategi ' . $catName . ' 2026', $catName . ' for Startups', 'Modern ' . $catName . ' Techniques']);
        $lang = 'Indonesia';
    }
    elseif (Str::contains($catName, ['Musik', 'Music', 'Gitar', 'Piano', 'Vokal'])) {
        $title = $this->faker->randomElement(['Belajar ' . $catName . ' Dasar', 'Advanced ' . $catName . ' Techniques', 'Professional ' . $catName . ' Course']);
        $lang = 'Indonesia';
    }
    elseif (Str::contains($catName, ['Masakan', 'Cooking', 'Food', 'Baking', 'Roti'])) {
        $title = $this->faker->randomElement(['Resep Rahasia ' . $catName, 'Culinary Arts: ' . $catName, 'Mastering ' . $catName]);
        $lang = 'Spanish'; // Biar makin bervariasi
    }
    else {
        // Fallback untuk kategori yang tidak terdeteksi di atas
        $title = "Comprehensive Guide to " . $catName;
        $lang = $this->faker->randomElement(['English', 'German', 'Indonesia']);
    }

    return [
        'title' => $title . ' ' . $this->faker->unique()->numberBetween(1, 10000),
        'description' => "This is a specialized course about " . $catName . " presented in " . $lang . ". Designed for all levels.",
        'image_url' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3',
        'category_id' => $category->id,
        'instructor_id' => \App\Models\User::where('role', 'instructor')->inRandomOrder()->first()->id ?? \App\Models\User::factory(),
        'price' => $this->faker->numberBetween(150000, 2500000),
    ];
}
}