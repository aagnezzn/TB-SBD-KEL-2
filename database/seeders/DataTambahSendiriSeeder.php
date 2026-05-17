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

        // 2. INPUT COURSE MANUAL
        $coursesData = [
            [
                'title' => 'Kuasai Canva dalam 3 Jam untuk Pemula Bisnis',
                'description' => 'Panduan praktis menggunakan Canva untuk membuat desain promosi, feed Instagram, logo, hingga presentasi bisnis tanpa perlu keahlian desain grafis.',
                'price' => 129000,
                'category_id' => $canvaCatId,
                'instructor_id' => $pira->id,
                'image_url' => 'https://loremflickr.com/640/360/design,canva/all?lock=991',
            ],
            [
                'title' => 'Panduan Lengkap Adobe Photoshop: Dari Nol Sampai Mahir',
                'description' => 'Pelajari teknik dasar manipulasi foto, penggunaan layer, selection tools, hingga color grading profesional menggunakan Adobe Photoshop.',
                'price' => 199000,
                'category_id' => $psCatId,
                'instructor_id' => $pira->id,
                'image_url' => 'https://loremflickr.com/640/360/photoshop,editor/all?lock=992',
            ]
        ];

        $paymentMethods = ['OVO', 'Transfer Bank', 'Dana', 'Gopay'];
        $pembuka = ['Materi kelas sangat', 'Penjelasan mentor benar-benar', 'Modul kelas ini tergolong', 'Materi yang dibawakan sangat'];
        $inti = [' mudah dimengerti orang awam,', ' terstruktur rapi per sub-bab,', ' interaktif dengan contoh riil,', ' mendalam dan langsung praktek,'];
        $penutup = [' highly recommended banget!', ' ngebantu upgrade skill portofolio.', ' sangat sepadan dengan biayanya.', ' memuaskan sekali cara ngajarnya.'];
        $uniqueWords = ['Hebat', 'Keren', 'Mantap', 'Rekomendasi'];

        $studentIds = User::where('role', 'student')->where('id', '!=', $naruto->id)->pluck('id')->toArray();

        foreach ($coursesData as $cData) {
            $course = Course::updateOrCreate(
                ['title' => $cData['title']],
                [
                    'description' => $cData['description'],
                    'price' => $cData['price'],
                    'category_id' => $cData['category_id'],
                    'instructor_id' => $cData['instructor_id'],
                    'image_url' => $cData['image_url'],
                    'status' => 'active',
                ]
            );

            // INPUT LESSONS MANUAL
            $lessons = [
                ['Pengenalan Interface & Workspace Utama', 'Mengenal bagian-bagian software dan setup awal lembar kerja.', 15],
                ['Alat dan Fitur Penting yang Sering Digunakan', 'Menguasai fungsi tools utama untuk efisiensi pembuatan aset.', 25],
                ['Proyek Akhir: Membuat Portofolio Pertama Anda', 'Praktik langsung membuat karya desain jadi siap pakai.', 40]
            ];

            foreach ($lessons as $index => $l) {
                DB::table('lessons')->updateOrInsert(
                    ['course_id' => $course->id, 'title' => ($index + 1) . '. ' . $l[0]],
                    ['content' => $l[1], 'duration' => $l[2], 'created_at' => now(), 'updated_at' => now()]
                );
            }

            // ENROLL N ARUTO SECARA KHUSUS
            DB::table('enrollments')->updateOrInsert(
                ['user_id' => $naruto->id, 'course_id' => $course->id],
                ['status' => 'active', 'enrolled_at' => '2026-05-12 10:00:00', 'created_at' => '2026-05-12 10:00:00', 'updated_at' => '2026-05-12 10:00:00']
            );

            // FAKTANYA: Insert payment Naruto disesuaikan ke struktur baru (user_id & course_id)
            DB::table('payments')->insert([
                'user_id'        => $naruto->id,
                'course_id'      => $course->id,
                'amount'         => $course->price,
                'payment_method' => 'Transfer Bank',
                'status'         => 'success',
                'paid_at'        => '2026-05-12 10:00:00',
                'created_at'     => '2026-05-12 10:00:00',
                'updated_at'     => '2026-05-12 10:00:00'
            ]);

            // ENROLL MASSAL MAHASISWA LAIN
            if (!empty($studentIds)) {
                $randomStudents = (array) array_rand($studentIds, min(2, count($studentIds)));
                foreach ($randomStudents as $stIdx) {
                    $studentId = $studentIds[$stIdx];
                    $enrolledAt = now()->subDays(rand(1, 5));

                    DB::table('enrollments')->updateOrInsert(
                        ['user_id' => $studentId, 'course_id' => $course->id],
                        ['status' => 'active', 'enrolled_at' => $enrolledAt, 'created_at' => $enrolledAt, 'updated_at' => $enrolledAt]
                    );

                    // FAKTANYA: Catatan keuangan mahasiswa lain disesuaikan ke struktur baru
                    DB::table('payments')->insert([
                        'user_id'        => $studentId,
                        'course_id'      => $course->id,
                        'amount'         => $course->price,
                        'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                        'status'         => 'success',
                        'paid_at'        => $enrolledAt,
                        'created_at'     => $enrolledAt,
                        'updated_at'     => $enrolledAt,
                    ]);

                    $comment = $pembuka[array_rand($pembuka)] . $inti[array_rand($inti)] . $penutup[array_rand($penutup)] . ' (' . $uniqueWords[array_rand($uniqueWords)] . ' ' . rand(10, 99) . ')';

                    DB::table('reviews')->updateOrInsert(
                        ['user_id' => $studentId, 'course_id' => $course->id],
                        ['rating' => rand(4, 5), 'comment' => $comment, 'created_at' => $enrolledAt, 'updated_at' => $enrolledAt]
                    );
                }
            }
        }
    }
}