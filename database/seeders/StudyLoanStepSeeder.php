<?php

namespace Database\Seeders;

use App\Models\StudyLoanStep;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudyLoanStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $steps = [
            [
                'step_number' => 1,
                'title' => 'Profile Assessment',
                'description' => 'Our experts assess your academic and financial profile to determine the best loan options for your overseas education.',
            ],
            [
                'step_number' => 2,
                'title' => 'Perfect Match',
                'description' => 'We connect you with multiple NBFCs offering competitive study loans tailored to your profile.',
            ],
            [
                'step_number' => 3,
                'title' => 'Choose Your Loan Offers',
                'description' => 'Browse and compare personalized loan offers based on your eligibility and repayment preferences.',
            ],
            [
                'step_number' => 4,
                'title' => 'Submit Documents with Ease',
                'description' => 'Upload your required documents securely through our platform for a seamless process.',
            ],
            [
                'step_number' => 5,
                'title' => 'Fast-Track Approval',
                'description' => 'Experience quick approvals with minimal delays, ensuring you stay on track for your educational goals.',
            ],
            [
                'step_number' => 6,
                'title' => 'Guaranteed Disbursement',
                'description' => 'Once approved, your loan is disbursed directly to your institution on time, securing your admission.',
            ],
        ];

        foreach ($steps as $step) {
            StudyLoanStep::updateOrCreate(
                ['step_number' => $step['step_number']],
                $step
            );
        }
    }
}
