<?php

namespace Database\Seeders;

use App\Models\SocialOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Instagram', 'Youtube', 'Friend', 'Twitter', 'Others'];
        foreach ($data as $item) {
            SocialOption::firstOrCreate(['name' => $item]);
        }
    }
}
