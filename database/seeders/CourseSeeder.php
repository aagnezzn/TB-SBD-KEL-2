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

        // Ambil semua kategori untuk pencarian di memori
        $categories = Category::all();
        $instructorIds = User::where('role', 'instructor')->pluck('id')->toArray();
        $studentIds = User::where('role', 'student')->pluck('id')->toArray();

        $lessonTemplates = [
            ['Pengenalan Mendasar dan Setup Lingkungan Kerja', 'Video pengenalan awal mengenai konsep dasar, instalasi tools pendukung, serta konfigurasi environment awal agar siap memulai pembelajaran.'],
            ['Konsep Inti, Arsitektur, dan Alur Kerja Utama', 'Membahas pemahaman mendalam tentang arsitektur utama, components penting, serta bagaimana alur logika sistem bekerja di dunia nyata.'],
            ['Praktik Implementation, Studi Kasus Nyata, dan Tips Terbaik', 'Sesi praktik langsung membangun sebuah mini-project, memecahkan masalah umum, serta tips optimasi performa kode di lingkungan produksi.']
        ];

        $paymentMethods = ['OVO', 'Transfer Bank', 'Dana'];
        $pembuka = ['Materi kelas sangat', 'Penjelasan mentor benar-benar', 'Modul kelas ini tergolong', 'Materi yang dibawakan sangat'];
        $inti = [' mudah dimengerti orang awam,', ' terstruktur rapi per sub-bab,', ' interaktif dengan contoh riil,', ' mendalam dan langsung praktek,'];
        $penutup = [' highly recommended banget!', ' ngebantu upgrade skill portofolio.', ' sangat sepadan dengan biayanya.', ' memuaskan sekali cara ngajarnya.'];
        $uniqueWords = ['Keren', 'Mantap', 'Top', 'Oke', 'Bagus', 'Rekomendasi', 'Puas', 'LuarBiasa'];

        while (($row = fgetcsv($open, 2000, $delimiter)) !== FALSE) {
            if (count($row) < 11) continue;

            // FAKTANYA: Ambil string nama Subject dari file CSV di indeks ke-10
            $csvCatName = trim($row[10]);
            
            // 1. Cari Kategori Level 2 (Sub-Kategori) yang namanya klop dengan CSV
            $parentCategory = $categories->whereNotNull('parent_id')->first(function ($cat) use ($csvCatName) {
                return strtolower($cat->name) === strtolower($csvCatName);
            });

            if ($parentCategory) {
                // 2. FAKTANYA: Cari anak-anak Level 3 di bawahnya secara acak (HTML & CSS, JavaScript, dll)
                $subCategory = $categories->where('parent_id', $parentCategory->id)->random(1)->first();
                
                // Jika memiliki anak di Level 3, gunakan ID-nya. Jika tidak, gunakan ID Level 2.
                $category = $subCategory ? $subCategory : $parentCategory;
            } else {
                // Fallback darurat jika ada typo kata di dalam file CSV
                $category = $categories->whereNotNull('parent_id')->first() ?? $categories->first();
            }

            $instructorId = !empty($instructorIds) ? $instructorIds[array_rand($instructorIds)] : 1;

            // Bersihkan format harga dari CSV (contoh: $199,00 atau Free)
            $rawPrice = trim($row[3]);
            if (strtolower($rawPrice) === 'free' || $rawPrice === '0' || empty($rawPrice)) {
                $coursePrice = 0;
            } else {
                // Menghilangkan simbol dolar dan spasi, lalu ambil angka depannya
                $cleanPrice = preg_replace('/[^\d]/', '', str_replace(',00', '', $rawPrice));
                
                // FAKTANYA: WAJIB DIKALIKAN 15000 AGAR NOMINAL MENJADI RUPIAH DI DATABASE
                $coursePrice = intval($cleanPrice) * 15000;
                
                // Jika hasil konversi aneh atau nol, beri harga default acak standar Rupiah
                if ($coursePrice <= 0) {
                    $coursePrice = array_rand([150000 => 1, 250000 => 1, 350000 => 1, 450000 => 1]);
                }
            }

            $randomSeedId = rand(1, 5000);

            // Ambil nilai statistik asli dari file CSV, hilangkan separator titiknya
            $csvSubscribersCount = intval(str_replace('.', '', trim($row[4])));
            $csvReviewsCount = intval(str_replace('.', '', trim($row[5])));

            // Buat record data kursus dengan menyertakan nilai statistik asli CSV
            $course = Course::create([
                'title'             => trim($row[1]),
                'description'       => 'Pelajari keahlian baru secara komprehensif mengenai ' . trim($row[1]) . '. Kelas dirancang terstruktur untuk semua level tingkatan.',
                'image_url'         => 'https://loremflickr.com/640/360/computer,office/all?lock=' . md5($randomSeedId),
                'category_id'       => $category->id,
                'instructor_id'     => $instructorId,
                'price'             => $coursePrice,
                'status'            => 'active',
                'subscribers_count' => $csvSubscribersCount, // Mengisi kolom statistik tabel courses
                'reviews_count'     => $csvReviewsCount,     // Mengisi kolom statistik tabel courses
            ]);

            // Insert data materi (lessons) secara massal
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

            // Hidrasi data transaksi mahasiswa (enrollments, payments, reviews) untuk fungsionalitas sistem web
            if (!empty($studentIds)) {
                // Batasi jumlah maksimal sampel record relasi agar database tidak overcapacity
                $enrollCount = min($csvSubscribersCount, count($studentIds), 15); 
                $reviewCount = min($csvReviewsCount, $enrollCount); 

                // Ambil sejumlah siswa acak sesuai hasil kuota sampel batas aman
                $chosenEnrollStudents = (array) array_rand($studentIds, $enrollCount);
                
                $payments = [];
                foreach ($chosenEnrollStudents as $studentIndex) {
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
                }
                if (!empty($payments)) {
                    DB::table('payments')->insert($payments);
                }

                if ($reviewCount > 0) {
                    $chosenReviewKeys = (array) array_rand($chosenEnrollStudents, $reviewCount);
                    $reviews = [];

                    foreach ($chosenReviewKeys as $key) {
                        $studentIndex = $chosenEnrollStudents[$key];
                        $studentId = $studentIds[$studentIndex];
                        $enrolledAt = now()->subDays(rand(1, 15));

                        $textKustom = $pembuka[array_rand($pembuka)] . $inti[array_rand($inti)] . $penutup[array_rand($penutup)];
                        $finalComment = $textKustom . ' (' . $uniqueWords[array_rand($uniqueWords)] . ' ' . rand(100, 999) . ')';

                        $reviews[] = [
                            'user_id'    => $studentId,
                            'course_id'  => $course->id,
                            'rating'     => rand(4, 5),
                            'comment'    => $finalComment,
                            'created_at' => $enrolledAt,
                            'updated_at' => $enrolledAt,
                        ];
                    }
                    if (!empty($reviews)) {
                        DB::table('reviews')->insert($reviews);
                    }
                }
            }
        }
        fclose($open);
    }
}