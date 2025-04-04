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
        // Add 'unique_id' to the 'users' table
        Schema::table('users', function (Blueprint $table) {
            $table->string('unique_id')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the 'unique_id' column if rolling back
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('unique_id');
        });
    }
};
