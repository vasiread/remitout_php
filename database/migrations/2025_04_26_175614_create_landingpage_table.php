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
        Schema::create('landingpage', function (Blueprint $table) {
            $table->id();
            $table->string('banner_header')->nullable();
            $table->string('banner_little_quote')->nullable();
            $table->text('banner_little_description')->nullable();
            $table->string('button_textcontent')->nullable();
            $table->string('video_trigger_button')->nullable();

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
        Schema::dropIfExists('landingpage');
    }
};
