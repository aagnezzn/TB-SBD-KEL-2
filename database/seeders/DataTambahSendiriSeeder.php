<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DataTambahSendiriSeeder extends Seeder
{
    public function run()
    {
        // 1. INPUT USER
        $pira = User::updateOrCreate(
            ['email' => 'pira@test.com'], 
            [
                'name' => 'Pira Cantik',
                'password' => Hash::make('Assalamualaikum'), 
                'role' => 'instructor',
                'created_at' => '2026-05-10 07:15:12',
            ]
        );

        $naruto = User::updateOrCreate(
            ['email' => 'narutoenak@gmail.com'], 
            [
                'name' => 'Uzumaki Naruto',
                'password' => Hash::make('dattebayo'),
                'role' => 'student',
                'created_at' => '2026-05-10 08:51:28',
            ]
        );

        $canvaCategory = Category::where('name', 'Canva')->first();
        $photoshopCategory = Category::where('name', 'Adobe Photoshop')->first();

        $canvaCatId = $canvaCategory ? $canvaCategory->id : 8; 
        $psCatId = $photoshopCategory ? $photoshopCategory->id : 6;

        // 2. INPUT COURSE
        $coursesToCreate = [
            [
                'title' => 'Belajar Canva Menyenangkan',
                'category_id' => $canvaCatId,
                'instructor_id' => $pira->id,
                'description' => 'Belajar trik trik canva yang jarang diketahui orang secara praktis.',
                'price' => 400000,
                'image_url' => 'https://loremflickr.com/640/360/computer,office?random=999',
                'subject' => 'Canva Design'
            ],
            [
                'title' => 'Mahir Menggunakan Photosop dalam 3 Minggu',
                'category_id' => $psCatId,
                'instructor_id' => $pira->id,
                'description' => 'Mempelajari secara mendalam dan mudah hingga anda mahir menggunakan adobe photoshop.',
                'price' => 750000,
                'image_url' => 'https://loremflickr.com/640/360/computer,office?random=998',
                'subject' => 'Photoshop Graphic'
            ]
        ];

        $studentIds = User::where('role', 'student')->pluck('id')->toArray();
        
        $pembuka = ['Materi kursus sangat', 'Penjelasan dari instruktur bener-bener', 'Kelas ini beneran', 'Modul pembelajarannya begitu'];
        $inti = [' gampang diikuti dan dipahami,', ' terstruktur rapi dari awal sampai akhir,', ' interaktif dan ga bikin bosen,', ' lengkap dengan contoh kasus nyata,'];
        $penutup = [' recommended pol buat pemula!', ' ngebantu banget buat nambah portofolio.', ' worth it parah wajib dibeli.', ' pas buat bekal kerja.'];
        $uniqueWords = ['mantap', 'keren', 'top', 'oke', 'jos', 'puas', 'sukses'];
        $paymentMethods = ['GoPay', 'OVO', 'Transfer Bank', 'Dana'];

        foreach ($coursesToCreate as $cData) {
            $course = Course::updateOrCreate(
                ['title' => $cData['title']],
                [
                    'category_id' => $cData['category_id'],
                    'instructor_id' => $cData['instructor_id'],
                    'description' => $cData['description'],
                    'price' => $cData['price'],
                    'image_url' => $cData['image_url'],
                    'created_at' => '2026-05-10 07:16:44',
                ]
            );

            // Buat Materi Bervariasi
            for ($i = 1; $i <= 3; $i++) {
                DB::table('lessons')->updateOrInsert(
                    [
                        'course_id' => $course->id,
                        'title' => "Bab $i: Modul Eksklusif Pembahasan " . $cData['subject']
                    ],
                    [
                        'content' => "Sesi materi bab $i mengupas tuntas teknik, teori fundamental, serta latihan langsung menggunakan aplikasi terkait.",
                        'duration' => rand(20, 50),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }

            // Daftarkan Uzumaki Naruto secara mutlak ke setiap kelas Pira agar data dashboard instruktur langsung terisi!
            if (isset($naruto)) {
                $narutoEnrollId = DB::table('enrollments')->insertGetId([
                    'user_id' => $naruto->id,
                    'course_id' => $course->id,
                    'status' => 'active',
                    'enrolled_at' => now()->subDays(2),
                    'created_at' => now()->subDays(2),
                    'updated_at' => now()->subDays(2),
                ]);

                DB::table('payments')->insert([
                    'enrollment_id' => $narutoEnrollId,
                    'amount' => $course->price,
                    'payment_method' => 'OVO',
                    'status' => 'success',
                    'paid_at' => now()->subDays(2),
                    'created_at' => now()->subDays(2),
                    'updated_at' => now()->subDays(2),
                ]);

                DB::table('reviews')->insert([
                    'user_id' => $naruto->id,
                    'course_id' => $course->id,
                    'rating' => 5,
                    'comment' => "Penjelasan dari instruktur bener-bener terstruktur rapi dari awal sampai akhir, recommended pol buat pemula! (mantap)",
                    'created_at' => now()->subDays(2),
                    'updated_at' => now()->subDays(2),
                ]);
            }

            // Suntik Tambahan Siswa Acak Secara Massal
            if (!empty($studentIds)) {
                $countToTake = min(50, count($studentIds));
                
                // Amankan nilai acak dari ancaman integer non-array
                $courseStudents = array_rand(array_flip($studentIds), $countToTake);
                if (!is_array($courseStudents)) {
                    $courseStudents = [$courseStudents];
                }

                foreach ($courseStudents as $studentId) {
                    // Jangan daftarkan ulang jika siswa tersebut adalah Naruto (karena sudah kita daftarkan mutlak di atas)
                    if ($studentId == $naruto->id) continue;

                    $enrolledAt = now()->subDays(rand(1, 5));

                    $enrollId = DB::table('enrollments')->insertGetId([
                        'user_id' => $studentId,
                        'course_id' => $course->id,
                        'status' => 'active',
                        'enrolled_at' => $enrolledAt,
                        'created_at' => $enrolledAt,
                        'updated_at' => $enrolledAt,
                    ]);

                    DB::table('payments')->insert([
                        'enrollment_id' => $enrollId,
                        'amount' => $course->price,
                        'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                        'status' => 'success',
                        'paid_at' => $enrolledAt,
                        'created_at' => $enrolledAt,
                        'updated_at' => $enrolledAt,
                    ]);

                    $comment = $pembuka[array_rand($pembuka)] . $inti[array_rand($inti)] . $penutup[array_rand($penutup)] . ' (' . $uniqueWords[array_rand($uniqueWords)] . ' ' . rand(10, 99) . ')';

                    DB::table('reviews')->insert([
                        'user_id' => $studentId,
                        'course_id' => $course->id,
                        'rating' => rand(4, 5),
                        'comment' => $comment,
                        'created_at' => $enrolledAt,
                        'updated_at' => $enrolledAt,
                    ]);
                }
            }
        }
    }
}