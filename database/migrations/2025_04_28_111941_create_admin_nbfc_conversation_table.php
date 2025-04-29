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
        Schema::create('admin_nbfc_conversation', function (Blueprint $table) {
            $table->id();
            $table->string('admin_id');
            $table->string('nbfc_id');
            $table->unique(['admin_id', 'nbfc_id']);
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
        Schema::dropIfExists('admin_nbfc_conversation');
    }
};
