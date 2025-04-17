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
        Schema::create('requestedbyusers', function (Blueprint $table) {
            $table->id();
            $table->string('userid');
            $table->string('nbfcid');
            $table->timestamps();

            $table->foreign('userid')->references('unique_id')->on('users')->onDelete('cascade');
            $table->foreign('nbfcid')->references('nbfc_id')->on('nbfc')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requestedbyusers');
    }
};
