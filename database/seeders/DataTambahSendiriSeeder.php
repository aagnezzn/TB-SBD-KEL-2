<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class DataTambahSendiriSeeder extends Seeder
{
    public function run()
    {
        // 1. INPUT USER (Pira & Naruto)
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

        // 2. AMBIL ID KATEGORI SECARA DINAMIS
        $canvaCategory = Category::where('name', 'Canva')->first();
        $photoshopCategory = Category::where('name', 'Adobe Photoshop')->first();

        $canvaCatId = $canvaCategory ? $canvaCategory->id : Category::first()->id;
        $psCatId = $photoshopCategory ? $photoshopCategory->id : Category::first()->id;

        // 3. INPUT COURSE
        $canva = Course::updateOrCreate(
            ['title' => 'Belajar Canva Menyenangkan'], 
            [
                'category_id' => $canvaCatId,
                'instructor_id' => $pira->id, 
                'description' => 'Belajar trik trik canva yang jarang diketahui orang',
                'price' => 400000,
                'image_url' => 'default-course.png',
                'created_at' => '2026-05-10 07:16:44',
            ]
        );

        $photoshop = Course::updateOrCreate(
            ['title' => 'Mahir Menggunakan Photosop dalam 3 Minggu'], 
            [
                'category_id' => $psCatId,
                'instructor_id' => $pira->id, 
                'description' => 'Dalam kursus ini kita akan mempelajari secara mendalam dan mudah hingga anda mahir menggunakan adobe photoshop',
                'price' => 750000,
                'image_url' => 'default-course.png',
                'created_at' => '2026-05-10 11:26:30',
            ]
        );

        // 4. INPUT LESSON
        Lesson::updateOrCreate(
            [
                'course_id' => $canva->id, 
                'title' => 'Bab 1: Mengenal Canva'
            ],
            [
                'content' => 'Pada bab ini kita akan mulai mengenal apa itu canva terlebih dahulu secara mendasar.',
                'duration' => 15,
                'created_at' => '2026-05-10 10:30:47',
            ]
        );

        Lesson::updateOrCreate(
            [
                'course_id' => $photoshop->id, 
                'title' => 'Bab 1 : Apa itu Adobe Photoshop'
            ],
            [
                'content' => 'Mengenal pengertian adobe photoshop secara mendalam.',
                'duration' => 15,
                'created_at' => '2026-05-10 11:27:21',
            ]
        );

        Lesson::updateOrCreate(
            [
                'course_id' => $photoshop->id, 
                'title' => 'Bab 2 : Langkah awal dalam menggunakan Adobe Photoshop'
            ],
            [
                'content' => 'Di bab ini siswa akan diajarkan tips tips awal penggunaan adobe photoshop.',
                'duration' => 22,
                'created_at' => '2026-05-10 11:28:39',
            ]
        );
    }
}