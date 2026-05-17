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
            DataTambahSendiriSeeder::class,
        ]);

        // eksekusi import data massal dari CSV
        $this->call(CourseSeeder::class);

        $this->call([
            UserProfileSeeder::class,
            CartSeeder::class,
            WishlistSeeder::class,
        ]);
    }
}