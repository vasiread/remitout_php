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
        Schema::table('coborrower_details', function (Blueprint $table) {
            $table->string('liability_select')->nullable(); // Add new column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coborrower_details', function (Blueprint $table) {
            $table->dropColumn('liability_select'); // Rollback by removing the column

        });
    }
};
