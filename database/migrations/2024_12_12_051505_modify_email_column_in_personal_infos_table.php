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
        Schema::table('personal_infos', function (Blueprint $table) {
            // Drop the unique constraint on the email column
            $table->dropUnique('personal_infos_email_unique'); // The index name follows {table}_{column}_unique
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
            // Re-add the unique constraint on the email column
            $table->unique('email');
        });
    }
};
