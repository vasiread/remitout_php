<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_details_formdata', function (Blueprint $table) {
            $table->renameColumn('plan-to-study', 'plan_to_study');
            $table->renameColumn('degree-type', 'degree_type');
            $table->renameColumn('course-duration', 'course_duration');
            $table->renameColumn('course-details', 'course_details');

            $table->renameColumn('loan-amount-in-lakhs', 'loan_amount_in_lakhs');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_details_formdata', function (Blueprint $table) {
            $table->renameColumn('plan_to_study', 'plan-to-study');
            $table->renameColumn('degree_type', 'degree-type');
            $table->renameColumn('course_duration', 'course-duration');
            $table->renameColumn('course_details', 'course-details');

            $table->renameColumn('loan-amount-in-lakhs', 'loan-amount-in-lakhs');
        });
    }
};
