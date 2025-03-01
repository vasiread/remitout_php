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
        Schema::table('nbfc', function (Blueprint $table) {
            $table->string('nbfc_email')->unique()->after('nbfc_id'); // Adjust 'after' to match the correct column

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
            $table->dropColumn('nbfc_email');
        });
    }
};
