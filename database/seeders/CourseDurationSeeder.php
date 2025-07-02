<?php

namespace Database\Seeders;

use App\Models\CourseDuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseDurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $durations = [12, 24, 36, 42];
        foreach ($durations as $months) {
            CourseDuration::firstOrCreate(['duration_in_months' => $months]);
        }
    }
}
