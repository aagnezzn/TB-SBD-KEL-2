<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Wishlist;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mengekstraksi kumpulan nilai Primary Key yang absolut dan valid dari memori database
        $userIds = User::pluck('id');
        $courseIds = Course::pluck('id');

        // Validasi keutuhan struktural: Aborsi eksekusi jika entitas induk tidak eksis
        if ($userIds->isEmpty() || $courseIds->isEmpty()) {
            $this->command->error('Aborsi eksekusi: Tabel users atau courses kosong. Lakukan seeding pada relasi induk terlebih dahulu.');
            return;
        }

        $this->command->info('Inisialisasi proses hidrasi 1000 record ke tabel wishlists...');
        
        // Iterasi komputasi untuk menghasilkan data tanpa redundansi
        for ($i = 0; $i < 1000; $i++) {
            Wishlist::firstOrCreate([
                'user_id' => $userIds->random(),
                'course_id' => $courseIds->random(),
            ]);
        }

        $this->command->info('Proses hidrasi tabel wishlists telah berhasil dikompilasi.');
    }
}