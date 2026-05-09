<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Eksekusi Akun Spesifik dari tim kamu
        $this->call(UserSeeder::class);

        // 2. Injeksi Data User & Instruktur
        User::factory(100)->create(); 
        User::factory(50)->create(['role' => 'instructor']); 

        // 3. Eksekusi Seeder Utama Berdasarkan Hierarki Relasi Tabel
        $this->call([
            CategorySeeder::class, 
            CourseSeeder::class,   // Ini memasukkan 3000+ data dari CSV
            FAQSeeder::class,
        ]);

        // 4. INJEKSI DATA TRANSAKSI MUTLAK (JANGAN DIHAPUS)
        // Bagian ini yang memasukkan data "murid, materi, ulasan, dan pembayaran"
        \App\Models\Lesson::factory(1500)->create();
        \App\Models\Enrollment::factory(1000)->create();
        \App\Models\Payment::factory(1000)->create();
        \App\Models\Review::factory(1000)->create();
    }
}