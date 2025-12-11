<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Patrion',
            'email' => 'admin@example.com',
            'phone' => '+6281234567890',
            'photo' => 'users/admin.webp',
            'status' => 'active',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Editor Patrion',
            'email' => 'editor@example.com',
            'phone' => '+6289876543210',
            'photo' => null,
            'status' => 'active',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
