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
        Schema::create('course_details_formdata', function (Blueprint $table) {
            $table->id();
            $table->json('plan-to-study')->nullable();
            $table->string('degree-type')->nullable();
            $table->string('course-duration')->nullable();
            $table->string('course-details')->nullable();
            $table->string('loan-amount-in-lakhs')->nullable();
            $table->string('user_id');
            $table->foreign('user_id')->references('unique_id')->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('course_details_formdata');
    }
};
