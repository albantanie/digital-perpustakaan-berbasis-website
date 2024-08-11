<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin Faiz',
            'email' => 'faiz@itts.ac.id',
            'password' => Hash::make('password'), // Use a secure password
            'role' => 'admin',
        ]);

        // Create a regular user
        User::create([
            'name' => 'Faiz User',
            'email' => 'faiz@user.itts.ac.id',
            'password' => Hash::make('password'), // Use a secure password
            'role' => 'user',
        ]);
    }
}
