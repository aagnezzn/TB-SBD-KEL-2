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
        
        // Deteksi Delimiter (Koma atau Titik Koma)
        $firstLine = fgets($open);
        $delimiter = (strpos($firstLine, ';') !== false) ? ';' : ',';
        rewind($open);
        
        fgetcsv($open, 2000, $delimiter); // Skip header CSV

        $categories = Category::all();
        $instructorIds = User::where('role', 'instructor')->pluck('id')->toArray();
        $studentIds = User::where('role', 'student')->pluck('id')->toArray();

        // Template pelajaran agar konten materi bervariasi
        $lessonTemplates = [
            ['Pengenalan Mendasar dan Setup Lingkungan Kerja', 'Video pengenalan awal mengenai konsep dasar, instalasi tools pendukung, serta konfigurasi environment awal agar siap memulai pembelajaran.'],
            ['Konsep Inti, Arsitektur, dan Alur Kerja Utama', 'Membahas pemahaman mendalam tentang arsitektur utama, komponen penting, serta bagaimana alur logika sistem bekerja di dunia nyata.'],
            ['Praktik Implementasi, Studi Kasus Nyata, dan Tips Terbaik', 'Sesi praktik langsung membangun sebuah mini-project, memecahkan masalah umum, disertai dengan tips and tricks optimasi performa.']
        ];

        // Variasi kalimat review bahasa Indonesia
        $pembuka = ['Materi kursus sangat', 'Penjelasan dari instruktur bener-bener', 'Kelas ini beneran', 'Modul pembelajarannya begitu', 'Penyampaian materinya sangat', 'Suka banget, kurikulumnya'];
        $inti = [' gampang diikuti dan dipahami,', ' terstruktur rapi dari awal sampai akhir,', ' interaktif dan ga bikin bosen sama sekali,', ' lengkap banget dengan contoh kasus nyata,', ' jelas dan langsung ke inti pembahasan,', ' detail banget pas bagian bedah codingan,'];
        $penutup = [' recommended pol buat pemula!', ' ngebantu banget buat nambah portofolio.', ' worth it parah sih wajib dibeli.', ' bikin makin semangat buat dalemin materi ini.', ' cocok buat yang mau ganti karir ke bidang ini.', ' dapet banyak insight baru dari studi kasusnya.'];
        $uniqueWords = ['mantap', 'keren', 'top', 'oke', 'rekomended', 'jos', 'puas', 'bintang lima', 'sukses', 'paham', 'ciamik', 'luar biasa'];
        
        $paymentMethods = ['GoPay', 'OVO', 'Transfer Bank', 'Dana', 'LinkAja'];
        
        // Buat counter untuk mengamankan keunikan seed gambar lokator
        $imageCounter = 1;

        while (($data = fgetcsv($open, 2000, $delimiter)) !== FALSE) {
            if (!isset($data[1]) || empty($data[1])) continue;
            
            $subject = (isset($data[10])) ? trim($data[10], '"') : 'General';
            
            // LOGIKA FIX: Tentukan keyword pencarian gambar berdasarkan subjek agar gambar relevan dengan tema kursus
            $keyword = 'computer,office';
            if (Str::contains(strtolower($subject), ['web', 'coding', 'programming', 'javascript', 'html', 'php', 'laravel'])) {
                $keyword = 'coding,programming';
            } elseif (Str::contains(strtolower($subject), ['design', 'graphic', 'canva', 'photoshop', 'illustrator'])) {
                $keyword = 'design,workspace';
            } elseif (Str::contains(strtolower($subject), ['business', 'finance', 'accounting', 'trading'])) {
                $keyword = 'business,chart';
            } elseif (Str::contains(strtolower($subject), ['music', 'guitar', 'piano', 'vocal'])) {
                $keyword = 'music,instrument';
            }

            // 1. BUAT KURSUS MASTER WITH DYNAMIC IMAGE LOCK
            // Menggunakan LoremFlickr dengan parameter '?lock=' + counter memastikan gambar bervariasi total tiap baris data!
            $course = Course::create([
                'category_id'   => $categories->random()->id,
                'instructor_id' => $instructorIds[array_rand($instructorIds)],
                'title'         => Str::limit(trim($data[1], '"'), 150),
                'description'   => "Pelajari keahlian baru di bidang " . $subject . " dengan materi terstruktur.",
                'price'         => rand(150000, 950000),
                'image_url'     => "https://loremflickr.com/640/360/" . $keyword . "?lock=" . $imageCounter,
                'status'        => 'active',
            ]);

            $imageCounter++; // Naikkan angka counter agar baris data kursus berikutnya mendapat gambar berbeda

            // 2. BULK INSERT LESSON BERVARIASI
            $lessons = [];
            foreach ($lessonTemplates as $index => $template) {
                $lessons[] = [
                    'course_id'  => $course->id,
                    'title'      => 'Bab ' . ($index + 1) . ': ' . $template[0] . ' - ' . $subject,
                    'content'    => $template[1] . ' Pembahasan mendalam langkah demi langkah untuk menunjang keahlian praktis Anda.',
                    'duration'   => rand(20, 60),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('lessons')->insert($lessons);

            // 3. BULK INSERT TEPAT 50 ENROLLMENTS, PAYMENTS, & REVIEWS UNIK PER KURSUS
            if (!empty($studentIds)) {
                $countToTake = min(50, count($studentIds));
                $courseStudents = array_rand(array_flip($studentIds), $countToTake);
                if (!is_array($courseStudents)) {
                    $courseStudents = [$courseStudents];
                }

                $payments = [];
                $reviews = [];

                foreach ($courseStudents as $studentId) {
                    $enrolledAt = now()->subDays(rand(1, 40))->subHours(rand(1, 23));
                    
                    $enrollId = DB::table('enrollments')->insertGetId([
                        'user_id'     => $studentId,
                        'course_id'   => $course->id,
                        'status'      => 'active',
                        'enrolled_at' => $enrolledAt,
                        'created_at'  => $enrolledAt,
                        'updated_at'  => $enrolledAt,
                    ]);

                    $payments[] = [
                        'enrollment_id'  => $enrollId,
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
                        'rating'     => rand(4, 5),
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