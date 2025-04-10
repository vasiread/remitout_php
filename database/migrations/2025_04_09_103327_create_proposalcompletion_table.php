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
        Schema::create('proposalcompletion', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('nbfc_id');
            $table->boolean('proposal_accept');
            $table->foreign('user_id')->references('unique_id')->on('users')->onDelete('cascade');
            $table->foreign('nbfc_id')->references('nbfc_id')->on('nbfc')->onDelete('cascade');
            $table->unique(['user_id','nbfc_id']);


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
        Schema::dropIfExists('proposalcompletion');
    }
};
