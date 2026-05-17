<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('data/all_courses.csv');
        if (!file_exists($file)) {
            echo "File CSV tidak ditemukan di: " . $file;
            return;
        }

        $open = fopen($file, "r");
        
        $firstLine = fgets($open);
        $delimiter = (strpos($firstLine, ';') !== false) ? ';' : ',';
        rewind($open);
        
        fgetcsv($open, 2000, $delimiter);

        $categories = Category::all();
        $instructorIds = User::where('role', 'instructor')->pluck('id')->toArray();
        $studentIds = User::where('role', 'student')->pluck('id')->toArray();

        $lessonTemplates = [
            ['Pengenalan Mendasar dan Setup Lingkungan Kerja', 'Video pengenalan awal mengenai konsep dasar, instalasi tools pendukung, serta konfigurasi environment awal agar siap memulai pembelajaran.'],
            ['Konsep Inti, Arsitektur, dan Alur Kerja Utama', 'Membahas pemahaman mendalam tentang arsitektur utama, komponen penting, serta bagaimana alur logika sistem bekerja di dunia nyata.'],
            ['Praktik Implementation, Studi Kasus Nyata, dan Tips Terbaik', 'Sesi praktik langsung membangun sebuah mini-project, memecahkan masalah umum, serta tips optimasi performa kode di lingkungan produksi.']
        ];

        $paymentMethods = ['OVO', 'Transfer Bank', 'Dana'];
        $pembuka = ['Materi kelas sangat', 'Penjelasan mentor benar-benar', 'Modul kelas ini tergolong', 'Materi yang dibawakan sangat'];
        $inti = [' mudah dimengerti orang awam,', ' terstruktur rapi per sub-bab,', ' interaktif dengan contoh riil,', ' mendalam dan langsung praktek,'];
        $penutup = [' highly recommended banget!', ' ngebantu upgrade skill portofolio.', ' sangat sepadan dengan biayanya.', ' memuaskan sekali cara ngajarnya.'];
        $uniqueWords = ['Keren', 'Mantap', 'Top', 'Oke', 'Bagus', 'Rekomendasi', 'Puas', 'LuarBiasa'];

        while (($row = fgetcsv($open, 2000, $delimiter)) !== FALSE) {
            if (count($row) < 4) continue;

            $csvCatName = trim($row[2]);
            $category = $categories->first(function ($cat) use ($csvCatName) {
                return strtolower($cat->name) === strtolower($csvCatName);
            });

            if (!$category) {
                $category = $categories->first();
            }

            $instructorId = !empty($instructorIds) ? $instructorIds[array_rand($instructorIds)] : 1;

            $coursePrice = intval(trim($row[3]));
            if ($coursePrice <= 0) {
                $coursePrice = array_rand([150000 => 1, 250000 => 1, 350000 => 1, 450000 => 1]);
            }

            $randomSeedId = rand(1, 5000);

            $course = Course::create([
                'title'         => trim($row[0]),
                'description'   => trim($row[1]),
                'image_url'     => 'https://loremflickr.com/640/360/computer,office/all?lock=' . md5($randomSeedId),
                'category_id'   => $category->id,
                'instructor_id' => $instructorId,
                'price'         => $coursePrice,
                'status'        => 'active',
            ]);

            $lessons = [];
            foreach ($lessonTemplates as $index => $template) {
                $lessons[] = [
                    'course_id'  => $course->id,
                    'title'      => ($index + 1) . '. ' . $template[0],
                    'content'    => $template[1],
                    'duration'   => rand(15, 45),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('lessons')->insert($lessons);

            if (!empty($studentIds)) {
                $chosenStudents = (array) array_rand($studentIds, min(3, count($studentIds)));
                
                $payments = [];
                $reviews = [];

                foreach ($chosenStudents as $studentIndex) {
                    $studentId = $studentIds[$studentIndex];
                    $enrolledAt = now()->subDays(rand(1, 30));

                    DB::table('enrollments')->insert([
                        'user_id'     => $studentId,
                        'course_id'   => $course->id,
                        'status'      => 'active',
                        'enrolled_at' => $enrolledAt,
                        'created_at'  => $enrolledAt,
                        'updated_at'  => $enrolledAt,
                    ]);

                    // FAKTANYA: Disinkronkan dengan membuang enrollment_id dan memasukkan user_id & course_id
                    $payments[] = [
                        'user_id'        => $studentId,
                        'course_id'      => $course->id,
                        'amount'         => $course->price,
                        'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                        'status'         => 'success',
                        'paid_at'        => $enrolledAt,
                        'created_at'     => $enrolledAt,
                        'updated_at'     => $enrolledAt,
                    ];

                    $textKustom = $pembuka[array_rand($pembuka)] . $inti[array_rand($inti)] . $penutup[array_rand($penutup)];
                    $finalComment = $textKustom . ' (' . $uniqueWords[array_rand($uniqueWords)] . ' ' . rand(100, 999) . ')';

                    $reviews[] = [
                        'user_id'    => $studentId,
                        'course_id'  => $course->id,
                        'rating'     => rand(3, 5),
                        'comment'    => $finalComment,
                        'created_at' => $enrolledAt,
                        'updated_at' => $enrolledAt,
                    ];
                }

                DB::table('payments')->insert($payments);
                DB::table('reviews')->insert($reviews);
            }
        }
        fclose($open);
    }
}