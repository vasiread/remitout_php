<?php

namespace Database\Seeders;

use App\Models\CourseDetailOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseDetailOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['With living expenses', 'Without living expenses'];
        foreach ($data as $item) {
            CourseDetailOption::firstOrCreate(['label' => $item]);
        }
    }
}
