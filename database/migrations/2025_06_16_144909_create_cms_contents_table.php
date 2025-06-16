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
        Schema::create('cms_contents', function (Blueprint $table) {
             $table->id();
    $table->string('page');
    $table->string('section');
    $table->string('title');
    $table->string('key_name')->nullable(); // Optional: 'field_1', 'field_2', etc.
    $table->text('content')->nullable();
    $table->string('status')->default('Active');
    $table->string('type')->default('text'); // text, media, etc.
    $table->json('constraints')->nullable(); // maxLength, mediaConstraints
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
        Schema::dropIfExists('cms_contents');
    }
};
