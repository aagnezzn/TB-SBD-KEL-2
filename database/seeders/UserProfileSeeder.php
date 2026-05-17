<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use Faker\Factory as Faker;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mengambil seluruh objek entitas dari tabel induk
        $users = User::all();

        // Validasi keutuhan struktural
        if ($users->isEmpty()) {
            $this->command->error('Aborsi eksekusi: Tabel users masih kosong. Tidak ada Foreign Key yang bisa direlasikan.');
            return;
        }

        // Inisialisasi Faker Library
        $faker = Faker::create('id_ID');

        $this->command->info('Memulai sinkronisasi relasi One-to-One untuk tabel user_profiles...');

        // Iterasi sinkronisasi data
        foreach ($users as $user) {
            // Algoritma pemecahan string untuk Name -> First Name & Last Name
            $nameParts = explode(' ', $user->name);
            $firstName = $nameParts[0];
            $lastName = count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : '';

            // firstOrCreate memastikan tidak ada duplikasi profil untuk user_id yang sama
            UserProfile::firstOrCreate(
                ['user_id' => $user->id], // Kondisi pencarian (Kunci Tamu)
                [
                    // Nilai yang akan dimasukkan jika profil belum ada
                    'first_name' => $firstName,
                    'last_name'  => $lastName,
                    'headline'   => substr($faker->jobTitle, 0, 60), // Dibatasi 60 karakter sesuai limit string di migration
                    'bio'        => $faker->paragraph,
                    'website'    => $faker->url,
                    'facebook'   => 'https://facebook.com/' . $faker->userName,
                    'instagram'  => 'https://instagram.com/' . $faker->userName,
                    'twitter'    => 'https://twitter.com/' . $faker->userName,
                ]
            );
        }

        $this->command->info('Proses hidrasi data tabel user_profiles telah berhasil dikompilasi secara sinkron.');
    }
}