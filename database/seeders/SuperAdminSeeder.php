<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'arutchezhian2@gmail.com'],
            [
                'admin_id'       => 'SUPADMIN001',
                'name'           => 'Arut',
                'email'          => 'arutchezhian2@gmail.com',
                'password'       => '$2y$10$JJ8KoaMPnb2yixI/QgBdjey4qfXszIczkbwOfrfsGY7jvzPdPaWvi', // already hashed
                'is_super_admin' => true,
            ]
        );
    }
}
