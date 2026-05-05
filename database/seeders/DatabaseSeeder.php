<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\Review;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(1000)->create();
        
        User::inRandomOrder()->limit(50)->update(['role' => 'instructor']);

        $this->call([
            CategorySeeder::class, 
            FAQSeeder::class,
        ]);

        Course::factory(1000)->create();
        Lesson::factory(1000)->create();
        Enrollment::factory(1000)->create();
        Review::factory(1000)->create();
        Payment::factory(1000)->create();
    }
}