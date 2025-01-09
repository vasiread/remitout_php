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
        Schema::table('academic_details', function (Blueprint $table) {
            // Add the new columns
            $table->string('university_school_name')->nullable()->after('Others');
            $table->string('course_name')->nullable()->after('university_school_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('academic_details', function (Blueprint $table) {
            $table->dropColumn('university_school_name');
            $table->dropColumn('course_name');
        });
    }
};
