<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Cart;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mengekstraksi seluruh nilai Primary Key dari entitas induk
        $userIds = User::pluck('id');
        $courseIds = Course::pluck('id');

        // Validasi keutuhan data: Mencegah eksekusi jika data induk tidak eksis
        if ($userIds->isEmpty() || $courseIds->isEmpty()) {
            $this->command->error('Aborsi eksekusi: Tabel users atau courses tidak berisi entitas. Lakukan seeding pada relasi induk terlebih dahulu.');
            return;
        }

        $this->command->info('Inisialisasi proses hidrasi 1000 record ke tabel carts...');
        
        // Iterasi komputasi untuk menghasilkan data dummy
        for ($i = 0; $i < 1000; $i++) {
            Cart::firstOrCreate([
                'user_id' => $userIds->random(),
                'course_id' => $courseIds->random(),
            ]);
        }

        $this->command->info('Proses hidrasi tabel carts telah berhasil dikompilasi.');
    }
}