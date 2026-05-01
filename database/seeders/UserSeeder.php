<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // User::create([
    //     'name' => 'Agnes Tester',
    //     'email' => 'agnes@test.com',
    //     'password' => Hash::make('12345678'), 
    // ]);

    User::create([
        'name' => 'Icha Cantik',
        'email' => 'icha@test.com',
        'password' => Hash::make('ichaimut'), 
    ]);

    User::create([
        'name' => 'Limjun Payung',
        'email' => 'liliwaalittlegirl@test.com',
        'password' => Hash::make('jenojeno'), 
    ]);

    User::create([
        'name' => 'Nadia Kabanjahe',
        'email' => 'nadialovepanji@test.com',
        'password' => Hash::make('naspaddihati'), 
    ]);

    User::create([
        'name' => 'Pitsop Anak Sabran',
        'email' => 'fityathefirst@test.com',
        'password' => Hash::make('pitsopbetrayal'), 
    ]);
}
}
