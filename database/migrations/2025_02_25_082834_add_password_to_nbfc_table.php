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
        Schema::table('nbfc', function (Blueprint $table) {
            $table->string('password')->after('nbfc_email'); // Adjust 'after' to match the correct column

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nbfc', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }
};
