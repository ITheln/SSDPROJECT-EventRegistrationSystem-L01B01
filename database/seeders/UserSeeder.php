<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
   public function run()
    {
        // 1. SYSTEM ADMIN (Handles Logs)
        User::create([
            'name' => 'System Admin',
            'email' => 'system@example.com',
            'password' => Hash::make('System@12345'),
            'role' => 'system_admin', // <--- NEW ROLE
        ]);

        // 2. EVENT ADMIN (Handles Events)
        User::create([
            'name' => 'Event Admin',
            'email' => 'event@example.com',
            'password' => Hash::make('Event@12345'),
            'role' => 'event_admin',  // <--- NEW ROLE
        ]);

        // 3. REGULAR USER
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('User@12345'),
            'role' => 'user',
        ]);
    }
}