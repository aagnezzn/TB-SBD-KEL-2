<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\Hash;

class DataTambahSendiriSeeder extends Seeder
{
    public function run()
    {
        // 1. INPUT USER (Pira & Naruto)
        $pira = User::updateOrCreate(
            ['id' => 1002],
            [
                'name' => 'Pira Cantik',
                'email' => 'pira@test.com',
                'password' => Hash::make('Assalamualaikum'), // Hash password otomatis
                'role' => 'instructor',
                'created_at' => '2026-05-10 07:15:12',
            ]
        );

        $naruto = User::updateOrCreate(
            ['id' => 1003],
            [
                'name' => 'Uzumaki Naruto',
                'email' => 'narutoenak@gmail.com',
                'password' => Hash::make('dattebayo'),
                'role' => 'student',
                'created_at' => '2026-05-10 08:51:28',
            ]
        );

        // 2. INPUT COURSE (Canva & Photoshop)
        $canva = Course::updateOrCreate(
            ['id' => 3684],
            [
                'category_id' => 19,
                'instructor_id' => 1002,
                'title' => 'Belajar Canva Menyenangkan',
                'description' => 'Belajar trik trik canva yang jarang diketahui orang',
                'price' => 400000,
                'image_url' => 'default-course.png',
                'created_at' => '2026-05-10 07:16:44',
            ]
        );

        $photoshop = Course::updateOrCreate(
            ['id' => 3685],
            [
                'category_id' => 17,
                'instructor_id' => 1002,
                'title' => 'Mahir Menggunakan Photosop dalam 3 Minggu',
                'description' => 'Dalam kursus ini kita akan mempelajari secara mendalam dan mudah hingga anda mahir menggunakan adobe photoshop',
                'price' => 750000,
                'image_url' => 'default-course.png',
                'created_at' => '2026-05-10 11:26:30',
            ]
        );

        // 3. INPUT LESSON
        Lesson::updateOrCreate(
            ['id' => 18384],
            [
                'course_id' => 3684,
                'title' => 'Bab 1: Mengenal Canva',
                'content' => 'Pada bab ini kita akan mulai mengenal apa itu canva terlebih dahulu',
                'duration' => 15,
                'created_at' => '2026-05-10 10:30:47',
            ]
        );

        Lesson::updateOrCreate(
            ['id' => 18385],
            [
                'course_id' => 3685,
                'title' => 'Bab 1 : Apa itu Adobe Photoshop',
                'content' => 'Mengenal pengertian adobe photoshop',
                'duration' => 15,
                'created_at' => '2026-05-10 11:27:21',
            ]
        );

        Lesson::updateOrCreate(
            ['id' => 18386],
            [
                'course_id' => 3685,
                'title' => 'Bab 2 : Langkah awal dalam menggunakan Adobe Photoshop',
                'content' => 'Di bab ini siswa akan diajarkan tips tips awal penggunaan adobe photoshop',
                'duration' => 22,
                'created_at' => '2026-05-10 11:28:39',
            ]
        );
    }
}