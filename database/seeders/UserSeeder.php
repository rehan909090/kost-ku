<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat Admin
        User::create([
            'name' => 'Administrator Kost',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Membuat Customer
        User::create([
            'name' => 'Budi',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}