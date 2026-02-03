<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@mockupkredit.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jakarta, Indonesia',
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'user@mockupkredit.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567891',
            'address' => 'Bandung, Indonesia',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567892',
            'address' => 'Surabaya, Indonesia',
        ]);
    }
}
