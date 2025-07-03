<?php

namespace Database\Seeders;

 use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
 
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CmsContentSeeder::class,
            StudyLoanStepSeeder::class,
            SocialOptionSeeder::class,
            CourseDetailOptionSeeder::class,
            DegreeSeeder::class,
            PlanToCountrySeeder::class,
            CourseDurationSeeder::class,
            SuperAdminSeeder::class
        ]);
    }
}
