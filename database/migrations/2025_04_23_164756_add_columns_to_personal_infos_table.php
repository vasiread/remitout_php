<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_infos', function (Blueprint $table) {
            Schema::table('personal_infos', function (Blueprint $table) {
                $table->string('gender')->nullable()->after('full_name');

                $table->string('dob')->nullable()->after('gender');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_infos', function (Blueprint $table) {
            Schema::table('personal_infos', function (Blueprint $table) {
                $table->dropColumn(['gender', 'dob']);
            });
        });
    }
};
