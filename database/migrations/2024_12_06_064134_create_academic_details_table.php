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
        Schema::create('academic_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->foreign('user_id')->references('unique_id')->on('users')
                ->onDelete('cascade');
            $table->string("gap_in_academics")->nullable();
            $table->text("reason_for_gap");
            $table->text("work_experience")->nullable();
            $table->string("ILETS");
            $table->string("GRE");
            $table->string("TOFEL");
            $table->json('Others');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_details');
    }
};