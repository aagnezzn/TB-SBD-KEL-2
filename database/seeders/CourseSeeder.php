<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Lesson;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('data/all_courses.csv');

        if (!file_exists($file)) {
            echo "Kesalahan Eksekusi: File CSV tidak ditemukan!\n";
            return;
        }

        $open = fopen($file, "r");
        
        $firstLine = fgets($open);
        $delimiter = (strpos($firstLine, ';') !== false) ? ';' : ',';
        rewind($open);

        $header = fgetcsv($open, 2000, $delimiter); 

        $categories = Category::all();
        $instructorIds = User::where('role', 'instructor')->pluck('id')->toArray();
        $studentIds = User::where('role', 'student')->pluck('id')->toArray();
        $faker = Faker::create('id_ID');

        if ($categories->isEmpty() || empty($instructorIds) || empty($studentIds)) {
            echo "Integritas Gagal: Jalankan CategorySeeder & UserSeeder terlebih dahulu!\n";
            return;
        }

        // Mapping subjek CSV ke sub-kategori agar tidak kosong di halaman kategori website
        $subjectToCategoryMap = [
            'Web Development' => 'HTML & CSS',
            'Business Finance' => 'Trading',
            'Graphic Design' => 'Adobe Photoshop',
            'Office Productivity' => 'Excel Basic',
            'Personal Development' => 'Public Speaking',
            'Musical Instruments' => 'Guitar',
            'Coding' => 'JavaScript',
        ];

        $topicTitles = [
            'coding' => [
                'Instalasi Lingkungan Kerja & Editor', 'Memahami Sintaks dan Struktur Dasar',
                'Deklarasi Variabel dan Tipe Data', 'Logika Percabangan (If-Else State)',
                'Perulangan Efektif dengan Loop', 'Fungsi dan Parameter Modular',
                'Penanganan Error (Try-Catch Exception)', 'Integrasi Database & Query Lanjutan'
            ],
            'cybersecurity' => [
                'Pengenalan Keamanan Jaringan Dasar', 'Analisis Kerentanan Sistem Operasi',
                'Simulasi Serangan Bruteforce & Proteksi', 'Konfigurasi Firewall & Port Security'
            ],
            'accounting' => [
                'Konsep Dasar Persamaan Akuntansi', 'Penyusunan Jurnal Umum & Buku Besar',
                'Analisis Neraca Saldo Akhir Periode', 'Pembuatan Laporan Laba Rugi Perusahaan'
            ],
            'trading' => [
                'Psikologi Trading & Manajemen Risiko', 'Membaca Indikator Candlestick Fundamental',
                'Analisis Tren Pasar Bullish dan Bearish', 'Strategi Swing Trading untuk Pemula'
            ],
            'excel' => [
                'Navigasi Shortcut & Formula Dasar', 'Optimasi Lookup dengan VLOOKUP & XLOOKUP',
                'Analisis Data Dinamis dengan Pivot Table', 'Visualisasi Data Menggunakan Chart Modern'
            ],
            'graphic_design' => [
                'Teori Komposisi Warna & Tata Letak', 'Manipulasi Objek dengan Photoshop',
                'Pembuatan Desain Vektor di Illustrator', 'Strategi Branding & Konsistensi Visual'
            ],
            'music' => [
                'Pengenalan Nada dan Tangga Nada Dasar', 'Latihan Penjarian (Fingering Practice)',
                'Memahami Progresi Akor Sederhana', 'Teknik Sinkronisasi Tangan Kiri & Kanan'
            ],
            'general' => [
                'Pendahuluan & Kontrak Belajar', 'Konsep Teoretis Paling Mendasar',
                'Studi Kasus Nyata di Dunia Kerja', 'Evaluasi Materi & Tips Belajar Mandiri'
            ]
        ];

        $unsplashImages = [
            'web_development' => ['1555066931-4365d14bab8c', '1542831371-29b0f74f9713', '1517694712202-14dd9538aa97'],
            'cyber_security' => ['1563986768609-322da13575f3', '1558494949-ef010cbdcc31'],
            'business_finance' => ['1454165804606-c3d57bc86b40', '1554224155-8d04cb21cd6c'],
            'graphic_design' => ['1618005182384-a83a8bd57fbe', '1561070791-2526d30994a5'],
            'public_speaking' => ['1475721027785-f74eccf877e2', '1515187029135-18ee286d815b'],
            'excel_basic' => ['1551288049-bebda4e38f71', '1586281380349-632531db7ed4'],
            'musical_instruments' => ['1511192336575-5a79af67a629', '1465847899084-d164df4dedc6']
        ];

        while (($data = fgetcsv($open, 2000, $delimiter)) !== FALSE) {
            if (!isset($data[1]) || empty($data[1])) {
                continue;
            }
            
            $title = trim(mb_convert_encoding($data[1], 'UTF-8', 'ISO-8859-1'), '"');
            $titleLower = strtolower($title);
            $subject = trim(mb_convert_encoding($data[10], 'UTF-8', 'ISO-8859-1'), '"'); 
            $level = trim(mb_convert_encoding($data[7], 'UTF-8', 'ISO-8859-1'), '"');
            $numSubscribers = (int) str_replace('.', '', $data[4]); 
            $numReviews = (int) str_replace('.', '', $data[5]);

            $priceRaw = trim($data[3], '"');
            if (strtolower($priceRaw) === 'free' || empty($priceRaw)) {
                $priceInRupiah = 0;
            } else {
                $cleanPrice = (int) preg_replace('/[^0-9]/', '', $priceRaw);
                $priceInRupiah = $cleanPrice * 150; 
                if ($priceInRupiah === 0) {
                    $priceInRupiah = 150000;
                }
            }

            // KLASIFIKASI KATEGORI SECARA DETAIL
            $targetTopicName = '';

            if ($subject === 'Web Development') {
                if (Str::contains($titleLower, ['html', 'css', 'bootstrap', 'sass', 'flexbox', 'tailwind'])) {
                    $targetTopicName = 'HTML & CSS';
                } elseif (Str::contains($titleLower, ['javascript', 'js', 'typescript', 'jquery', 'es6'])) {
                    $targetTopicName = 'JavaScript';
                } elseif (Str::contains($titleLower, ['react', 'redux', 'next.js', 'nextjs'])) {
                    $targetTopicName = 'React JS';
                } elseif (Str::contains($titleLower, ['php', 'laravel', 'wordpress', 'mysql', 'api'])) {
                    $targetTopicName = 'PHP & Laravel';
                } elseif (Str::contains($titleLower, ['python', 'django', 'flask'])) {
                    $targetTopicName = 'Python Django';
                } else {
                    $targetTopicName = collect(['HTML & CSS', 'JavaScript', 'React JS', 'PHP & Laravel', 'Python Django'])->random();
                }
            } elseif ($subject === 'Business Finance') {
                if (Str::contains($titleLower, ['stock', 'trading', 'saham', 'market', 'chart', 'technical analysis'])) {
                    $targetTopicName = 'Stock Trading';
                } elseif (Str::contains($titleLower, ['forex', 'currency'])) {
                    $targetTopicName = 'Forex Trading';
                } elseif (Str::contains($titleLower, ['tax', 'taxes', 'taxation'])) {
                    $targetTopicName = 'Taxes';
                } elseif (Str::contains($titleLower, ['accounting', 'bookkeeping', 'finance', 'ledger'])) {
                    $targetTopicName = 'Financial Accounting';
                } else {
                    $targetTopicName = collect(['Financial Accounting', 'Taxes', 'Stock Trading', 'Forex Trading'])->random();
                }
            } elseif ($subject === 'Graphic Design') {
                if (Str::contains($titleLower, ['solidworks'])) {
                    $targetTopicName = 'SOLIDWORKS';
                } elseif (Str::contains($titleLower, ['autocad', 'cad', '3d', 'fusion 360', 'modeling'])) {
                    $targetTopicName = 'AutoCAD';
                } elseif (Str::contains($titleLower, ['photoshop', 'psd', 'photo editing'])) {
                    $targetTopicName = 'Adobe Photoshop';
                } elseif (Str::contains($titleLower, ['illustrator', 'vector', 'ai', 'logo'])) {
                    $targetTopicName = 'Adobe Illustrator';
                } elseif (Str::contains($titleLower, ['canva', 'social media post'])) {
                    $targetTopicName = 'Canva';
                } else {
                    $targetTopicName = collect(['Adobe Photoshop', 'Adobe Illustrator', 'Canva', 'AutoCAD', 'SOLIDWORKS'])->random();
                }
            } elseif ($subject === 'Musical Instruments') {
                if (Str::contains($titleLower, ['vocal', 'singing', 'voice', 'sing', 'choir'])) {
                    $targetTopicName = 'Vocal & Singing';
                } elseif (Str::contains($titleLower, ['guitar', 'guitarist', 'strum', 'chords'])) {
                    $targetTopicName = 'Guitar';
                } elseif (Str::contains($titleLower, ['piano', 'keyboard', 'pianist'])) {
                    $targetTopicName = 'Piano';
                } elseif (Str::contains($titleLower, ['ukulele', 'uke'])) {
                    $targetTopicName = 'Ukulele';
                } else {
                    $targetTopicName = collect(['Guitar', 'Piano', 'Ukulele', 'Vocal & Singing'])->random();
                }
            } elseif ($subject === 'Cyber Security') {
                if (Str::contains($titleLower, ['hack', 'penetration', 'pentest', 'kali', 'ethical'])) {
                    $targetTopicName = 'Ethical Hacking';
                } else {
                    $targetTopicName = 'Cyber Security';
                }
            } elseif ($subject === 'Excel Basic') {
                if (Str::contains($titleLower, ['powerpoint', 'presentation', 'ppt'])) {
                    $targetTopicName = 'PowerPoint';
                } elseif (Str::contains($titleLower, ['word', 'document', 'writing'])) {
                    $targetTopicName = 'Microsoft Word';
                } else {
                    $targetTopicName = 'Excel Basic';
                }
            } elseif ($subject === 'Public Speaking') {
                if (Str::contains($titleLower, ['time', 'productivity', 'procrastination', 'focus', 'schedule'])) {
                    $targetTopicName = 'Time Management';
                } elseif (Str::contains($titleLower, ['interview', 'resume', 'job', 'cv', 'career'])) {
                    $targetTopicName = 'Interview Skills';
                } else {
                    $targetTopicName = 'Public Speaking';
                }
            } else {
                $targetTopicName = 'HTML & CSS';
            }

            $category = $categories->where('name', $targetTopicName)->first();
            $categoryId = $category ? $category->id : $categories->random()->id;

            $imgKey = Str::slug($subject, '_');
            $selectedImages = $unsplashImages[$imgKey] ?? $unsplashImages['web_development'];
            $randomImgId = $selectedImages[array_rand($selectedImages)];
            $imageUrl = "https://images.unsplash.com/photo-" . $randomImgId . "?auto=format&fit=crop&w=600&q=80";

            $instructorId = $instructorIds[array_rand($instructorIds)];

            // 1. Buat Kursus (ID Auto-Increment)
            $course = Course::create([
                'category_id' => $categoryId,
                'instructor_id' => $instructorId,
                'title' => Str::limit($title, 150, '...'),
                'description' => "This is a comprehensive course about " . $subject . " designed especially for " . $level . " students.",
                'price' => $priceInRupiah,
                'image_url' => $imageUrl,
                'created_at' => $data[9] . ' 00:00:00',
                'updated_at' => $data[9] . ' 00:00:00',
            ]);

            // 2. Buat Lessons Terikat Langsung
            $key = 'general';
            if (Str::contains($titleLower, ['react', 'next', 'angular', 'javascript', 'js', 'typescript', 'html', 'css', 'php', 'laravel', 'python', 'sql'])) {
                $key = 'coding';
            } elseif (Str::contains($titleLower, ['cyber', 'security', 'firewall'])) {
                $key = 'cybersecurity';
            } elseif (Str::contains($titleLower, ['accounting', 'tax'])) {
                $key = 'accounting';
            } elseif (Str::contains($titleLower, ['forex', 'trading', 'stock'])) {
                $key = 'trading';
            } elseif (Str::contains($titleLower, ['excel', 'spreadsheet'])) {
                $key = 'excel';
            } elseif (Str::contains($titleLower, ['photoshop', 'illustrator', 'canva', 'design'])) {
                $key = 'graphic_design';
            } elseif (Str::contains($titleLower, ['guitar', 'piano', 'ukulele', 'vocal'])) {
                $key = 'music';
            }

            $availableTitles = $topicTitles[$key];
            shuffle($availableTitles);
            $lessonLimit = rand(1, 2); 

            for ($i = 0; $i < $lessonLimit; $i++) {
                $lessonTitle = $availableTitles[$i] ?? ('Materi Tambahan Bagian ' . ($i + 1));
                Lesson::create([
                    'course_id' => $course->id,
                    'title' => Str::limit($lessonTitle, 200, '...'),
                    'content' => 'Pada modul pembelajaran ini, peserta didik akan diajarkan implementasi praktis dari materi ' . $lessonTitle . '.',
                    'duration' => rand(15, 60),
                ]);
            }

            // 3. Buat Enrollments & Payments
            $enrollLimit = min($numSubscribers, 3);
            for ($i = 0; $i < $enrollLimit; $i++) {
                $studentId = $studentIds[array_rand($studentIds)];

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

            // 4. Buat Reviews
            $reviewLimit = min($numReviews, 2);
            $reviewComments = [
                'Materi pembelajarannya sangat detail dan mudah diikuti.',
                'Penjelasan instrukturnya sangat jelas, cocok sekali untuk pemula!',
                'Proyek latihannya sangat membantu memahami studi kasus di dunia nyata.'
            ];

            for ($i = 0; $i < $reviewLimit; $i++) {
                $studentId = $studentIds[array_rand($studentIds)];
                Review::create([
                    'user_id' => $studentId,
                    'course_id' => $course->id,
                    'rating' => rand(4, 5), 
                    'comment' => $faker->randomElement($reviewComments),
                ]);
            }
        }

        fclose($open);
    }
}