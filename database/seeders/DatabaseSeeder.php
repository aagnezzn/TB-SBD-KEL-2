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
    // 1. Buat User (1.000 data sesuai tugas)
    User::factory(1000)->create();
    User::inRandomOrder()->limit(100)->update(['role' => 'instructor']);

    // 2. Jalankan Seeder Kategori kamu yang banyak itu
    $this->call([
        CategorySeeder::class, // Menggunakan data dari CategorySeeder_2.php
        FAQSeeder::class,
    ]);

    // 3. AMBIL SEMUA TOPIK TERBAWAH
    // Kita ambil kategori yang tidak punya anak (level paling detail)
    $topics = Category::whereDoesntHave('children')->get();

    // 4. SINKRONISASI OTOMATIS
    // Kita buat setiap topik memiliki minimal 1 Course agar tidak ada yang kosong
    foreach ($topics as $topic) {
        Course::factory(1)->create([
            'category_id' => $topic->id,
        ]);
    }

    // 5. PENUHI KUOTA 1.000 DATA
    // Jika jumlah topik kurang dari 1.000, sisanya kita buat secara acak
    $remainingCourses = 1000 - $topics->count();
    if ($remainingCourses > 0) {
        Course::factory($remainingCourses)->create();
    }

    // 6. BUAT LESSON (1.000 data)
    // Lesson ini akan otomatis nempel ke Course yang sudah ada melalui LessonFactory[cite: 1]
    Lesson::factory(1000)->create();

    // 7. DATA PENDUKUNG LAINNYA (Masing-masing 1.000)[cite: 1]
    Enrollment::factory(1000)->create();
    Review::factory(1000)->create();
    Payment::factory(1000)->create();
}
}