<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Spesifik Tim (Admin)
        $teamUsers = [
            [
                'name' => 'Icha Cantik',
                'email' => 'icha@test.com',
                'password' => Hash::make('ichaimut'),
                'role' => 'admin',
            ],
            [
                'name' => 'Limjun Payung',
                'email' => 'liliwaalittlegirl@test.com',
                'password' => Hash::make('jenojeno'),
                'role' => 'admin',
            ],
            [
                'name' => 'Nadia Kabanjahe',
                'email' => 'nadialovepanji@test.com',
                'password' => Hash::make('naspaddihati'),
                'role' => 'admin',
            ],
            [
                'name' => 'Agnes',
                'email' => 'agnes@test.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ],
        ];

        foreach ($teamUsers as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role' => $user['role'],
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        }

        // 2. Buat 996 User Dummy (Campuran Instruktur & Siswa)
        $faker = Faker::create('id_ID');
        $batchData = [];

        for ($i = 0; $i < 996; $i++) {
            $role = ($i % 7 === 0) ? 'instructor' : 'student';

            $batchData[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'role' => $role,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($batchData) === 200) {
                User::insert($batchData);
                $batchData = [];
            }
        }

        if (count($batchData) > 0) {
            User::insert($batchData);
        }
    }
}