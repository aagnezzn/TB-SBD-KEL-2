<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Lesson;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Eksekusi Seeder Utama (UserSeeder menghasilkan tepat 1.000 User)
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            FAQSeeder::class,
            DataTambahSendiriSeeder::class,
        ]);

        // 2. Baca CSV Kedua Kalinya Khusus untuk Menghubungkan Transaksi Secara Akurat
        $file = database_path('data/all_courses.csv');
        if (!file_exists($file)) {
            echo "Gagal: File CSV tidak ditemukan!\n";
            return;
        }

        // Jalankan CourseSeeder terlebih dahulu untuk mengisi data kursus dasar
        $this->call(CourseSeeder::class);

        $courses = Course::all();
        $studentIds = User::where('role', 'student')->pluck('id')->toArray();

        if ($courses->isEmpty() || empty($studentIds)) {
            echo "Gagal membuat transaksi: Data kursus atau siswa kosong!\n";
            return;
        }

        $open = fopen($file, "r");
        $header = fgetcsv($open, 2000, ";"); 

        $index = 0;
        while (($data = fgetcsv($open, 2000, ";")) !== FALSE) {
            if (!isset($data[1]) || empty($data[1])) {
                continue;
            }

            $course = $courses[$index] ?? null;
            if (!$course) {
                continue;
            }

            // SINKRONISASI MATEMATIKA: Bersihkan tanda titik agar PHP membaca ribuan asli!
            $numSubscribers = (int) str_replace('.', '', $data[4]); 
            $numReviews = (int) str_replace('.', '', $data[5]);     
            $numLectures = (int) str_replace('.', '', $data[6]);    

            $cleanCourseTitle = Str::limit(trim($course->title), 100, '...');

            // A. Sinkronisasi Lessons (Berdasarkan jumlah Lectures asli di CSV - Batasi maks 5 agar hemat memori)
            $lessonLimit = min($numLectures, 5);
            for ($i = 1; $i <= $lessonLimit; $i++) {
                Lesson::create([
                    'course_id' => $course->id,
                    'title' => Str::limit('Bab ' . $i . ': Pengenalan ' . $cleanCourseTitle, 200, '...'),
                    'content' => 'Pada bab ini, kita akan mempelajari konsep dasar, metodologi kerja, serta implementasi nyata dari materi ' . $cleanCourseTitle . ' secara mendalam.',
                    'duration' => rand(15, 45), 
                ]);
            }

            // B. Sinkronisasi Enrollments & Payments (Berdasarkan jumlah Subscribers asli di CSV - Batasi maks 3)
            $enrollLimit = min($numSubscribers, 3);
            for ($i = 0; $i < $enrollLimit; $i++) {
                $studentId = $studentIds[array_rand($studentIds)];

                $exists = Enrollment::where('user_id', $studentId)
                                    ->where('course_id', $course->id)
                                    ->exists();
                if ($exists) {
                    continue;
                }

                $enrollment = Enrollment::create([
                    'user_id' => $studentId,
                    'course_id' => $course->id,
                    'status' => 'active',
                    'enrolled_at' => now()->subDays(rand(1, 30)),
                ]);

                if ($course->price > 0) {
                    Payment::create([
                        'enrollment_id' => $enrollment->id,
                        'amount' => $course->price,
                        'payment_method' => $faker->randomElement(['Bank Transfer', 'E-Wallet', 'Credit Card']),
                        'status' => 'success',
                        'paid_at' => $enrollment->enrolled_at,
                    ]);
                }
            }

            // C. Sinkronisasi Reviews (Berdasarkan jumlah Reviews asli di CSV - Batasi maks 2)
            $reviewLimit = min($numReviews, 2);
            $reviewComments = [
                'Materi pembelajarannya sangat detail dan mudah diikuti.',
                'Penjelasan instrukturnya sangat jelas, cocok sekali untuk pemula seperti saya!',
                'Proyek latihannya sangat membantu memahami studi kasus di dunia nyata.',
                'Sangat direkomendasikan! Penjelasan konsep teorinya sangat matang.'
            ];

            for ($i = 0; $i < $reviewLimit; $i++) {
                $studentId = $studentIds[array_rand($studentIds)];

                $exists = Review::where('user_id', $studentId)
                                ->where('course_id', $course->id)
                                ->exists();
                if ($exists) {
                    continue;
                }

                Review::create([
                    'user_id' => $studentId,
                    'course_id' => $course->id,
                    'rating' => rand(4, 5), 
                    'comment' => $faker->randomElement($reviewComments),
                ]);
            }

            $index++;
        }

        fclose($open);
    }
}