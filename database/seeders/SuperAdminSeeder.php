<?php
     
     // database/seeders/SuperAdminSeeder.php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $email = env('SUPERADMIN_EMAIL');
        $password = env('SUPERADMIN_PASSWORD');
        $id = env('SUPERADMIN_ID');

        if (!User::where('email', $email)->exists()) {
            User::create([
                'name' => 'Super Admin',
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'superadmin',
            ]);
        }
    }
}
