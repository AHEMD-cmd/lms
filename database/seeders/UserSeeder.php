<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Assuming you have a User model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create three users manually
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'photo' => null, // Nullable in migration
            'phone' => '01234567890', // Optional, nullable
            'address' => 'Cairo, Egypt', // Optional, nullable
            'status' => true, // Default 1 (true) in migration
            'role' => 'admin', // From enum ['admin', 'user', 'instructor']
            'email_verified_at' => now(), // Nullable, set to now for verified
            'password' => Hash::make('asdasdas'), // Hashed password
            'remember_token' => null, // Laravel handles this automatically if needed
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'photo' => null,
            'phone' => '01234567891',
            'address' => 'Alexandria, Egypt',
            'status' => true,
            'role' => 'user',
            'email_verified_at' => null, // Not verified
            'password' => Hash::make('asdasdas'),
            'remember_token' => null,
        ]);

        User::create([
            'name' => 'Instructor User',
            'email' => 'instructor@example.com',
            'photo' => 'instructor.jpg', 
            'phone' => '01234567892',
            'address' => 'Giza, Egypt',
            'status' => true,
            'role' => 'instructor',
            'email_verified_at' => now(),
            'password' => Hash::make('asdasdas'),
            'remember_token' => null,
        ]);
    }
}