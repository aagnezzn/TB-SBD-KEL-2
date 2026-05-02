<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'title' => '[NEW] Ultimate AWS Certified Cloud Practitioner CLF-C02...',
                'author' => 'Stephane Maarek | AWS Certified',
                'rating' => '4,7',
                'reviews' => '287.117',
                'price' => 169000,
                'img' => 'https://img-c.udemycdn.com/course/240x135/3142166_a637_3.jpg',
            ],
            [
                'title' => '100 Days of Code: The Complete Python Pro Bootcamp',
                'author' => 'Dr. Angela Yu',
                'rating' => '4,7',
                'reviews' => '421.133',
                'price' => 129000,
                'img' => 'https://img-c.udemycdn.com/course/240x135/2776760_f176_10.jpg',
            ],
            [
                'title' => 'Master Laravel 11 - Bikin Website E-Learning E-Commerce',
                'author' => 'Icha & Tim PWL',
                'rating' => '4,9',
                'reviews' => '12.500',
                'price' => 149000,
                'img' => 'https://img-c.udemycdn.com/course/240x135/1565838_e54e_16.jpg',
            ],
            [
                'title' => 'The Complete Web Developer in 2026: Zero to Mastery',
                'author' => 'Andrei Neagoie',
                'rating' => '4,6',
                'reviews' => '150.000',
                'price' => 159000,
                'img' => 'https://img-c.udemycdn.com/course/240x135/1430746_2f43_10.jpg',
            ],
            [
                'title' => 'UI/UX Design Bootcamp: Menguasai Figma untuk Pemula',
                'author' => 'Budi Santoso',
                'rating' => '4,8',
                'reviews' => '45.200',
                'price' => 99000,
                'img' => 'https://img-c.udemycdn.com/course/240x135/394676_ce3d_5.jpg',
            ]
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}