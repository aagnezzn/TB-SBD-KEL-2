<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Hubungkan semua fondasi master data & user di awal secara berurutan
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            FAQSeeder::class,
            DataTambahSendiriSeeder::class, // FIX: Pira & Naruto masuk ke DB sebelum data CSV di-load
        ]);

        // Baru eksekusi import data massal dari CSV
        $this->call(CourseSeeder::class);
    }
}