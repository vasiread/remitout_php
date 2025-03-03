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
        Schema::create('traceprogress', function (Blueprint $table) {
            $table->string('nbfc_id');  
            $table->string('user_id');  

            $table->foreign('nbfc_id')->references('nbfc_id')->on('nbfc')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('unique_id')->on('users')
                ->onDelete('cascade');

            $table->enum('type', ['request', 'proposal'])->default('request');
            $table->unique(['nbfc_id', 'user_id'], 'nbfc_user_unique');

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
        Schema::dropIfExists('traceprogress');

    }
};
