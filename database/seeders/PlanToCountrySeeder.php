<?php

namespace Database\Seeders;

use App\Models\PlanToCountry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanToCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = ['USA', 'Ireland', 'Germany', 'Swedan', 'Italy', 'Australia', 'UK', 'New Zealand', 'France', 'Canada'];
        foreach ($countries as $country) {
            PlanToCountry::firstOrCreate(['country_name' => $country]);
        }
    }
}
